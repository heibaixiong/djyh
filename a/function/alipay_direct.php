<?php
function _getPaymentForm($order_id = 0) {
	global $_wrap;
	global $_;
	_fun('alipay_dt_core');
	_fun('alipay_dt_md');

	$alipay_config = $_wrap['alipay_config'];

	$order_info = _sqlone('order', 'id='.intval($order_id).' and state=1 and payment_code = \''.$_wrap['payment_method']['alipay']['code'].'\'');

	if (empty($order_info)) return false;

	$item_name = $_['config']['name'];

	$fullname = $order_info['nam'];

	$payment_type = "1";

	$notify_url = $alipay_config['transport'].'callback/payment/alipay_direct.php';

	$return_url = _u('/cart/success/');

	$seller_email = $alipay_config['seller_email'];

	$out_trade_no = $order_id;

	$subject = $item_name . ' 订单 '. $order_id;

	$amount = $order_info['total'];

	$total_fee = number_format($amount,2,'.','');

	$body =  '购买者 ' . $fullname;

	$show_url = $alipay_config['transport'];

	$anti_phishing_key = "";

	$exter_invoke_ip = "";

	$parameter = array(
		"service" => "create_direct_pay_by_user",
		"partner" => trim($alipay_config['partner']),
		"payment_type"	=> $payment_type,
		"notify_url"	=> $notify_url,
		"return_url"	=> $return_url,
		"seller_email"	=> $seller_email,
		"out_trade_no"	=> $out_trade_no,
		"subject"	=> $subject,
		"total_fee"	=> $total_fee,
		"body"	=> $body,
		"show_url"	=> $show_url,
		"anti_phishing_key"	=> $anti_phishing_key,
		"exter_invoke_ip"	=> $exter_invoke_ip,
		"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
	);

	include_once(APP_PATH.'library/alipaydtsubmit.php');

	$alipaydtsubmit = new Alipaydtsubmit($alipay_config);

	$data = $alipaydtsubmit->buildRequestForm($parameter, "post", '立即支付');

	return $data;
}

function _doPaymentCallback() {
	global $_wrap;

	_fun('alipay_dt_core');
	_fun('alipay_dt_md');

	$alipay_config = $_wrap['alipay_config'];

	$log = true;

	if($log) {
		_logs('Alipay_Direct :: One: ', 'callback');
	}

	include_once(APP_PATH.'library/alipaydtnotify.php');

	$alipayNotify = new Alipaydtnotify($alipay_config);
	$verify_result = $alipayNotify->verifyNotify();

	if($log) {
		_logs('Alipay_Direct :: Two: ' . $verify_result, 'callback');
	}

	if($verify_result) {

		$out_trade_no = _post('out_trade_no');

		$order_id   = $out_trade_no;

		$trade_no = _post('trade_no');

		$trade_status = _post('trade_status');

		$order_status_id = 2;

		$this->load->model('checkout/order');

		$order_info = _sqlone('order', 'id='.intval($order_id));

		if($log) {
			_logs('Alipay_Direct :: Three: ', 'callback');
		}

		if ($order_info) {

			if($log) {
				_logs('Alipay_Direct :: Four: ', 'callback');
			}

			if($_POST['trade_status'] == 'TRADE_FINISHED') {

				if($log) {
					_logs('Alipay_Direct :: Five: ', 'callback');
				}

				$order_status_id = 2;

				if ($order_info['state'] == '1') {

					$data = array('state' => $order_status_id, 'pay_time' => time());
					if ($updated = _sqlupdate('order', $data, 'state=1 and id='.intval($order_id))) {
						_sqldo('update '.PRE.'cart set state = '.$order_status_id.', uptime='.time().' where orderid='.intval($order_id).' and (state=1)');
						_logs('Alipay_Direct :: TRADE_FINISHED: ' . $order_id, 'callback');
						_weblogs('Alipay_Direct 订单支付成功！' . $order_id);
					} else {
						_logs('Alipay_Direct :: TRADE_FINISHED : Update State Faild ' . $order_id, 'callback');
						_weblogs('Alipay_Direct 订单支付成功！更新状态失败：' . $order_id);
					}

				} else {

					_logs('Alipay_Direct :: TRADE_FINISHED : Order State Error ' . $order_id, 'callback');
					_weblogs('Alipay_Direct 订单支付成功！订单状态异常：' . $order_id . ' - ' . $order_info['state']);

				}

				echo "success";

			} else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {

				if($log) {
					_logs('Alipay_Direct :: Six: ', 'callback');
				}

				$order_status_id = 2;

				if ($order_info['state'] == '1') {

					$data = array('state' => $order_status_id, 'pay_time' => time());
					if ($updated = _sqlupdate('order', $data, 'state=1 and id='.intval($order_id))) {
						_sqldo('update '.PRE.'cart set state = '.$order_status_id.', uptime='.time().' where orderid='.intval($order_id).' and (state=1)');
						if ($log) _logs('Alipay_Direct :: TRADE_SUCCESS: ' . $order_id, 'callback');
						_weblogs('Alipay_Direct 订单支付成功！' . $order_id);
					} else {
						if ($log) _logs('Alipay_Direct :: TRADE_SUCCESS : Update State Faild ' . $order_id, 'callback');
						_weblogs('Alipay_Direct 订单支付成功！更新状态失败：' . $order_id);
					}

				} else {

					if ($log) _logs('Alipay_Direct :: TRADE_SUCCESS : Order State Error ' . $order_id, 'callback');
					_weblogs('Alipay_Direct 订单支付成功！订单状态异常：' . $order_id . ' - ' . $order_info['state']);

				}

				echo "success";

			}

		}else{

			if ($log) _logs('Alipay_Direct :: Order Not Exist: ' . $order_id, 'callback');
			_weblogs('Alipay_Direct 订单不存在！' . $order_id);

			echo "fail";

		}

	} else {

		if ($log) _logs('Alipay_Direct :: Verify Result Error', 'callback');
		_weblogs('Alipay_Direct 支付返回异常！');

		echo "fail";

	}

}