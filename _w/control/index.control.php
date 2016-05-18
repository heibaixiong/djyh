<?php
if(!defined('PART'))exit;

if(!_session('weixin_openid') || !_session('webid')){
	_url(_u('/index/auth'));
}

//微信端首页面
function __index(){
	//幻灯片
	if(_ftime('flash')>CACHETIME){
		_f('flash',_sqlall('ad','class=1 and state=0','px,id desc',5));
	}
	_c('flash',_f('flash'));

	if(_ftime('wx_index')>CACHETIME){
		$index['goods_hot']=_sqlall('ware','length(`img`)>3 and state=0 and hot=1', 'px,id desc', 5);	//热门
		$index['goods_rec']=_sqlall('ware','length(`img`)>3 and state=0 and recommend=1', 'px,id desc', 5);	//推荐
		_f('wx_index',$index);
	}
	_c('wx_index',_f('wx_index'));

	_c('notice',_sqlone('notice','1 order by px'));

	_tpl('index');
}

//广告链接跳转，统计广告点击次数
function __ads(){
	$id = intval(_v(3));
	$info = _sqlone('ad','id = '.$id);
	if($info){
		$sql = 'update `'. PRE . 'ad` set `hits` = `hits` + 1 where `id` = '.$id;	//点击次数+1
		_sqlselect($sql);
		if($info['url']){
			header('Location:'.$info['url']);
			exit;
		}
	}
}

//微信端自动登录注册
function auth(){
	global $_wrap;
	require_once(APP_PATH . 'library/wxpayexception.php');
	define('APPID', $_wrap['wxpay_config']['wxpay_appid']);
	define('MCHID', $_wrap['wxpay_config']['wxpay_mchid']);
	define('KEY', $_wrap['wxpay_config']['wxpay_key']);
	define('APPSECRET', $_wrap['wxpay_config']['wxpay_appsecret']);
	define('SSLCERT_PATH', $_wrap['wxpay_config']['sslcert_path']);
	define('SSLKEY_PATH', $_wrap['wxpay_config']['sslkey_path']);
	define('CURL_PROXY_HOST', '0.0.0.0');
	define('CURL_PROXY_PORT', 0);
	define('REPORT_LEVENL', 1);

	require_once(APP_PATH . 'library/wxpaydata.php');
	require_once(APP_PATH . 'library/wxpayapi.php');
	require_once(APP_PATH . 'library/wxpayconfig.php');
	require_once(APP_PATH . 'library/wxpayjsapipay.php');

	$tools = new JsApiPay();
	$openId = $tools->GetOpenid();
	//var_dump($openId);exit;
	_session('weixin_openid', $openId);

	$wx_user = _sqlone('admin_bind', 'openid=\'' . _escape($openId) . '\'');
	if (empty($wx_user)) {
		$data1 = array(
				'openid' => $openId,
				'from' => 'weixin',
				'add_time' => time()
		);
		$wx_id = _sqlinsert('admin_bind', $data1);  //插入绑定表

		$data2 = array(
				'user' => 'w' . _random(8, 'num'),
				'rank' => '5',
				'reg_time' => time(),
				'updatetime' => time(),
				'login' => '1',
				'state' => '0'
		);
		$user_id = _sqlinsert('admin', $data2); //插入用户表
		_sqldo('update ' . _pre('admin_bind') . ' set user_id=' . $user_id . ' where id=' . $wx_id);  //更新绑定表

		_session('webid', $user_id);
	} else {
		_session('webid', $wx_user['user_id']);
	}

	if (_session('weixin_redirect_url')) {
		_header(_session('weixin_redirect_url'));
	} else {
		_header(_u('/index/index/'));
	}
}