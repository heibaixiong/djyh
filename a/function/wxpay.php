<?php
function _getPaymentForm($order_id = 0) {
	global $_wrap;
	global $_;

	require_once(APP_PATH . 'library/wxpayexception.php');
	require_once(APP_PATH . 'library/wxpayconfig.php');
	require_once(APP_PATH . 'library/wxpaydata.php');
	require_once(APP_PATH . 'library/wxpayapi.php');
	require_once(APP_PATH . 'library/wxpayjsapipay.php');

	$order_info = _sqlone('order', 'id='.intval($order_id).' and state=1 and payment_code = \''.$_wrap['payment_method']['weixin']['code'].'\'');

	if (empty($order_info)) return false;

	$item_name = $_['config']['name'];

	$fullname = $order_info['nam'];

	$notify_url = 'http://'.$_SERVER['HTTP_HOST'] . '/callback/payment/wxpay.php';

	$return_url = _u('/cart/success/');

	$out_trade_no = $order_id;

	$subject = $item_name . ' 订单 '. $order_id;

	$amount = $order_info['total'];

	$total_fee = number_format($amount,2,'.','');

	$total_fee = $total_fee * 100;//乘100去掉小数点，以传递整数给微信支付

	$body =  '购买者 ' . $fullname;

	//①、获取用户openid
	$tools = new JsApiPay();
	//$openId = $tools->GetOpenid();
	$openId = _session('weixin_openid');

	//②、统一下单
	$input = new WxPayUnifiedOrder();

	$input->SetBody($subject);
	$input->SetAttach($body);
	$input->SetOut_trade_no($order_id);
	$input->SetTotal_fee($total_fee);
	$input->SetTime_start(date("YmdHis"));
	$input->SetTime_expire(date("YmdHis", time() + 600));
	$input->SetGoods_tag("test goods tags");
	$input->SetNotify_url($notify_url);
	$input->SetTrade_type("JSAPI");
	$input->SetOpenid($openId);

	//echo "4";

	$order = WxPayApi::unifiedOrder($input);
	print_r($order);

	//echo "5";
	//echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
	//printf_info($order);
	$data['jsApiParameters'] = $tools->GetJsApiParameters($order);

	//echo "6";
	//获取共享收货地址js函数参数
	$data['editAddress'] = $tools->GetEditAddressParameters();
	//echo "7";

	$data['return_url'] = $this->url->link('checkout/success');
	$data['checkout_url'] = $this->url->link('checkout/checkout');

	extract($data);

	ob_start();

	require(PROJECT_PRE.V0.'/tpl/payment/wxpay.tpl');

	$output = ob_get_contents();

	ob_end_clean();

	return $output;
}

function _doPaymentCallback() {
	global $_wrap;

	$log = true;

	if($log) {
		_logs('WxPay :: One: ', 'callback');
	}

	require_once(APP_PATH . 'library/wxpayexception.php');

	if($log) {
		_logs('WxPay :: Two: ', 'callback');
	}

	require_once(APP_PATH . 'library/wxpayconfig.php');

	if($log) {
		_logs('WxPay :: Three: ', 'callback');
	}

	require_once(APP_PATH . 'library/wxpaydata.php');

	if($log) {
		_logs('WxPay :: Four: ', 'callback');
	}

	require_once(APP_PATH . 'library/wxpaynotify.php');

	if($log) {
		_logs('WxPay :: Five: ', 'callback');
	}

	require_once(APP_PATH . 'library/wxpayapi.php');

	if($log) {
		_logs('WxPay :: Six: ', 'callback');
	}

	require_once(APP_PATH . 'library/wxpaynotifycallback.php');

	if($log) {
		_logs('WxPay :: Seven: ', 'callback');
	}

	$notify = new PayNotifyCallBack();

	if($log) {
		_logs('WxPay :: Eight: ', 'callback');
	}


	$notify->Handle(false);

	$getxml = $GLOBALS['HTTP_RAW_POST_DATA'];
	//$getxml = file_get_contents('php://input');

	libxml_disable_entity_loader(true);

	$result= json_decode(json_encode(simplexml_load_string($getxml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

	if($notify->GetReturn_code() == "SUCCESS") {


		if ($result["return_code"] == "FAIL") {

			_logs("WxPay ::【通信出错】:\n".$getxml."\n", 'callback');

		}elseif($result["result_code"] == "FAIL"){

			_logs("WxPay ::【业务出错】:\n".$getxml."\n", 'callback');

		}else{

			$order_id = $result['out_trade_no'];

			if($log) {
				_logs('WxPay :: Order ID: '.$order_id, 'callback');
			}

			$order_info = _sqlone('order', 'id='.intval($order_id));

			if ($order_info) {

				if($log) {
					_logs('WxPay :: 1: ', 'callback');
				}

				$order_status_id = 2;

				if ($order_info['state'] == '1') {

					$data = array('state' => $order_status_id, 'pay_time' => time());
					if ($updated = _sqlupdate('order', $data, 'state=1 and id='.intval($order_id))) {
						_sqldo('update '.PRE.'cart set state = '.$order_status_id.', uptime='.time().' where orderid='.intval($order_id).' and (state=1)');
						_logs('WxPay :: 2: ' . $order_id, 'callback');
						_weblogs('WxPay 订单支付成功！' . $order_id);
					} else {
						_logs('WxPay :: 3 : Update State Faild ' . $order_id, 'callback');
						_weblogs('WxPay 订单支付成功！更新状态失败：' . $order_id);
					}

				} else {

					_logs('WxPay :: 4 : Order State Error ' . $order_id, 'callback');
					_weblogs('WxPay 订单支付成功！订单状态异常：' . $order_id . ' - ' . $order_info['state']);

				}

				if (!is_null(_session('cs_shipfrom'))) _session('cs_shipfrom', null);
				if (!is_null(_session('personal_card'))) _session('personal_card', null);

			}else{

				if($log) {
					_logs('WxPay :: Seven: ', 'callback');
				}
				_weblogs('WxPay 订单不存在！' . $order_id);

			}

		}

	}else{

		if($log) {
			_logs('WxPay :: Nine: '.$result, 'callback');
		}
		_weblogs('WxPay 支付返回异常！');

	}

}