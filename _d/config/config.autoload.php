<?php
if(!defined('PART'))exit;
if(_ftime('config')>CACHETIME){
	_f('config',_sqlone('config'));
}
_c('config', _f('config'));

global $_wrap;
if ($_wrap['db']['database'] == 'hb_dev') {
	_session('weixin_openid', 'oivF8wVNcYmaPoOTbX11lgA1oqCo'); //for local test
}

$member = array();
if (!empty(_session('weixin_openid'))) {
	$member = _sqlone('ship_user', 'wx_open_id=\''._escape(_session('weixin_openid')).'\'');
	if (empty($member)) {
		$data = array(
			'wx_open_id' => _session('weixin_openid'),
			'user_name' => 'u'._random(8, 'num'),
			'pass_word' => _md5(_random(8)),
			'role' => '0',
			'add_time' => time(),
			'mod_time' => time(),
			'last_time' => time(),
			'logins' => '1',
			'status' => '1',
		);
		$uid = _sqlinsert('ship_user', $data);
		$member = $data;
		$member['id'] = $uid;
		_session('wx_uid', $uid);
	} else {
		_session('wx_uid', $member['id']);
	}
}

_c('member', $member);

_c('label_state',array('上架','下架'));
_c('label_status',array('开启','关闭'));
_c('user_order_status', array(
	'0' => '已取消',
	'1' => '已下单',
	'2' => '已接单',
	'3' => '已揽件',
	'4' => '已发货',
	'5' => '申请退货',
	'6' => '拒绝退货',
	'7' => '退货中',
	'11' => '已退货',
	'12' => '已完成',
));
_c('seller_order_status', array(
	'0' => '已取消',
	'1' => '可抢单',
	'2' => '待揽件',
	'3' => '待发货',
	'4' => '已发货',
	'5' => '申请退货',
	'6' => '拒绝退货',
	'7' => '退货中',
	'11' => '已退货',
	'12' => '已完成',
));
_c('stowage_status', array(
	'0' => '待命中',
	'1' => '运输中',
	'2' => '中转中',
	'3' => '已到达',
));