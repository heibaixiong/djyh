<?php
function _getPaymentForm($order_id = 0) {
	global $_wrap;
	global $_;

	require_once(APP_PATH . 'library/wxpayexception.php');

	define('APPID', $_wrap['wxpay_config']['wxpay_appid']);
	define('MCHID', $_wrap['wxpay_config']['wxpay_mchid']);
	define('KEY', $_wrap['wxpay_config']['wxpay_key']);
	define('APPSECRET', $_wrap['wxpay_config']['wxpay_appsecret']);

	require_once(APP_PATH . 'library/wxpayconfig.php');
	require_once(APP_PATH . 'library/wxpaydata.php');
	require_once(APP_PATH . 'library/wxpayapi.php');
	require_once(APP_PATH . 'library/wxpaynativepay.php');

	$order_info = _sqlone('order', 'id='.intval($order_id).' and state=1 and payment_code = \''.$_wrap['payment_method']['wxcode']['code'].'\'');

	if (empty($order_info)) return false;

	$item_name = $_['config']['name'];

	$fullname = $order_info['nam'];

	$notify_url = 'http://'.$_SERVER['HTTP_HOST'] . '/callback/payment/wxpay_qrcode.php';

	$return_url = _u('/cart/success/');

	$out_trade_no = $order_id;

	$subject = $item_name . ' 订单 '. $order_id;

	$amount = $order_info['total'];

	$total_fee = number_format($amount,2,'.','');

	$total_fee = $total_fee * 100;//乘100去掉小数点，以传递整数给微信支付

	$body =  '购买者 ' . $fullname;

	$notify = new NativePay();
	$input = new WxPayUnifiedOrder();
	$input->SetBody($subject);
	$input->SetAttach($body);
	$input->SetOut_trade_no($order_id);
	$input->SetTotal_fee($total_fee);
	$input->SetTime_start(date("YmdHis"));
	$input->SetTime_expire(date("YmdHis", time() + 600));
	$input->SetGoods_tag($item_name);
	$input->SetNotify_url($notify_url);
	$input->SetTrade_type("NATIVE");
	$input->SetProduct_id($order_id);
	$result = $notify->GetPayUrl($input);
	//$url2 = $result["code_url"];

	_session('wx_code_url', $result['code_url']);

	return '<p class="fl pay-form-btn"><a class="return-btn" href="javascript:void(0);" onclick="location.href=\''._u('/cart/qrcode/').'\';" id="btn-cart-pay">立即支付</a></p>';
}

function _doPaymentCallback() {
	global $_wrap;

	$log = true;

	require_once(APP_PATH . 'library/wxpayexception.php');

	define('APPID', $_wrap['wxpay_config']['wxpay_appid']);
	define('MCHID', $_wrap['wxpay_config']['wxpay_mchid']);
	define('KEY', $_wrap['wxpay_config']['wxpay_key']);
	define('APPSECRET', $_wrap['wxpay_config']['wxpay_appsecret']);

	require_once(APP_PATH . 'library/wxpayconfig.php');
	require_once(APP_PATH . 'library/wxpaydata.php');
	require_once(APP_PATH . 'library/wxpayapi.php');
	require_once(APP_PATH . 'library/wxpaynotify.php');
	require_once(APP_PATH . 'library/qrcode_wxpay_notify.php');

	if($log) {
		_logs('QrcodeWxPay :: One ', 'callback');
	}

	$notify = new PayNotifyCallBack();

	$notify->Handle(false);

	if($log) {
		_logs('QrcodeWxPay :: Two ', 'callback');
	}

	$getxml = $GLOBALS['HTTP_RAW_POST_DATA'];

	libxml_disable_entity_loader(true);

	$result= json_decode(json_encode(simplexml_load_string($getxml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

	if($notify->GetReturn_code() == "SUCCESS") {

		if ($result["return_code"] == "FAIL") {

			_logs("QrcodeWxPay ::【通信出错】:\n".$getxml."\n", 'callback');

		}elseif($result["result_code"] == "FAIL"){

			_logs("QrcodeWxPay ::【业务出错】:\n".$getxml."\n", 'callback');

		}else{

			$order_id = $result['out_trade_no'];

			if($log) {
				_logs('QrcodeWxPay :: Order ID: '.$order_id, 'callback');
			}

			$order_info = _sqlone('order', 'id='.intval($order_id));

			if ($order_info) {

				if($log) {
					_logs('QrcodeWxPay :: 1: ', 'callback');
				}

				$order_status_id = 2;

				if ($order_info['state'] == '1') {

					$data = array('state' => $order_status_id, 'pay_time' => time());
					if ($updated = _sqlupdate('order', $data, 'state=1 and id='.intval($order_id))) {
						_sqldo('update '.PRE.'cart set state = '.$order_status_id.', uptime='.time().' where orderid='.intval($order_id).' and (state=1)');
						_logs('QrcodeWxPay :: 2: ' . $order_id, 'callback');
						_weblogs('QrcodeWxPay 订单支付成功！' . $order_id);
					} else {
						_logs('QrcodeWxPay :: 3 : Update State Faild ' . $order_id, 'callback');
						_weblogs('QrcodeWxPay 订单支付成功！更新状态失败：' . $order_id);
					}

				} else {

					_logs('QrcodeWxPay :: 4 : Order State Error ' . $order_id, 'callback');
					_weblogs('QrcodeWxPay 订单支付成功！订单状态异常：' . $order_id . ' - ' . $order_info['state']);

				};

				if (!is_null(_session('cs_shipfrom'))) _session('cs_shipfrom', null);
				if (!is_null(_session('personal_card'))) _session('personal_card', null);
				if (!is_null(_session('wx_code_url'))) _session('wx_code_url', null);

			}else{

				if($log) {
					_logs('QrcodeWxPay :: Three: ', 'callback');
				}
				_weblogs('QrcodeWxPay 订单不存在！' . $order_id);

			}

		}


	}else{

		_logs('QrcodeWxPay :: Four: '.$result, 'callback');
		_weblogs('QrcodeWxPay 支付返回异常！');

	}

}