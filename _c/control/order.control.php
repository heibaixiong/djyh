<?php
if(!defined('PART'))exit;

function __search(){
	global $_;
	$s=_v(3);
	$p=_v(4);
	if(strlen($s) > 0 && !array_key_exists(intval($s), $_['order_status'])){
		$s = '';
	}
	if(empty($p)){
		$p=0;
	}
	$key=_post('key');
	$session_key=_session('key');
	if(!empty($key)){
		_session('key',$key);
	}
	if(empty($key)&&!empty($session_key)){
		$key=_session('key');
	}
	$_['key']=$key;
	$sql = '1=1';
	if(!empty($key)){
		$sql .= ' and (ship_number like \'%'._escape($key).'%\' or ship_phone like \'%'._escape($key).'%\' or ship_name like \'%'._escape($key).'%\')';
	}
	if ($s <> '') {
		$sql .= ' and status = \''.$s.'\'';
	}
	Page::start('ship_order', $p, $sql, 'id desc');

	foreach (Page::$arr as $k => $order) {

	}

	_c('title', $s==''?'全部':$_['order_status'][$s]);

	_tpl('/search');
}

function __statics() {
	_c('title', '');

	$days = array();
	for ($i=14;$i>=0;$i--) {
		$days[] = date('m.d', strtotime('-'.$i.' days'));
	}

	_c('x-labels', "'".join("', '", $days)."'");

	_tpl('/statics');
}

function __list(){
	global $_;
	$s=_v(3);
	$p=_v(4);
	if(strlen($s) > 0 && !array_key_exists(intval($s), $_['order_status'])){
		$s = '';
	}
	if(empty($p)){
		$p=0;
	}
	$key=_post('key');
	$session_key=_session('key');
	if(!empty($key)){
		_session('key',$key);
	}
	if(empty($key)&&!empty($session_key)){
		$key=_session('key');
	}
	$_['key']=$key;
	$sql = '1=1';
	if(!empty($key)){
		$sql .= ' and (ship_number like \'%'._escape($key).'%\' or ship_phone like \'%'._escape($key).'%\' or ship_name like \'%'._escape($key).'%\')';
	}
	if ($s <> '') {
		$sql .= ' and status = \''.$s.'\'';
	}
	Page::start('ship_order', $p, $sql, 'id desc');

	foreach (Page::$arr as $k => $order) {
		Page::$arr[$k]['detail_url'] = strlen(_session('adminrank'))>0 && _session('adminrank')=='0' ? _u('/order/edit/'.$order['id'].'/'._v(3).'/'._v(4).'/') : _u('/order/show/'.$order['id'].'/'._v(3).'/'._v(4).'/');
	}

	_c('title', $s==''?'全部':$_['order_status'][$s]);

	_tpl('/list');
}

function __add() {
	_c('order', array());
	_c('form_action', _u('//save//'._v(3).'/'._v(4).'/'));

	_tpl('/order_form');
}

function __edit(){
	if (!(strlen(_session('adminrank')) > 0 && _session('adminrank') == '0')) {
		_header(_u('/order/view/'._v(3).'/'._v(4).'/'._v(5).'/'));
		die();
	}

	$order =  _sqlone('ship_order','id='.intval(_v(3)));

	if (empty($order)) {
		_alerturl('记录不存在', _u('//list/'._v(4).'/'._v(5).'/'));
		die();
	}

	/*if (!empty($order['wx_open_id'])) {
		_header(_u('//show/'._v(3).'/'._v(4).'/'._v(5).'/'));
		die();
	}*/

	$order['rob_name'] = '';
	if (!empty($order['rob_open_id'])) {
		$uid = _sqlfield('ship_user', 'id', "wx_open_id='{$order['rob_open_id']}'");
		$order['rob_name'] = _sqlfield('ship_user_info', 'real_name', "uid='{$uid}'");
	}
	if (empty($order['rob_name']) && $order['mid'] > 0) {
		$order['rob_name'] = _sqlfield('ship_company', 'name', 'id=\''.(int)$order['mid'].'\'');
	}

	$order['ship_status'] = array();
	if ($order['status'] > 3) {
		$sql = "select s.* from "._pre('ship_to_stowage')." as s2s inner join "._pre('ship_stowage')." as s on s2s.stowage_id=s.id where s2s.ship_number='{$order['ship_number']}' and s.status>0 order by s.id desc";
		$res = _sqlselect($sql);
		$order['ship_status'] = $res;
	}

	_c('order', $order);
	_c('form_action', _u('//save/'._v(3).'/'._v(4).'/'._v(5).'/'));

	_tpl('/order_form');
}

function __save() {
	$order =  _sqlone('ship_order','id='.intval(_v(3)));

	if (!(strlen(_session('adminrank')) > 0 && _session('adminrank') == '0') && $order) {
		_header(_u('/order/view/'._v(3).'/'._v(4).'/'._v(5).'/'));
		die();
	}

	if (empty(_post('ship_prov')) || empty(_post('ship_city')) || empty(_post('ship_area'))) {
		_alertback('请选择完整发货地！');
		die();
	} elseif (empty(_post('ship_address'))) {
		_alertback('请输入发货人详细地址！');
		die();
	} elseif (empty(_post('ship_name'))) {
		_alertback('请输入发货人名称！');
		die();
	} elseif (empty(_post('ship_phone'))) {
		_alertback('请输入发货人电话！');
		die();
	} elseif (empty(_post('cons_prov')) || empty(_post('cons_city')) || empty(_post('cons_area'))) {
		_alertback('请选择完整发货人所在地区！');
		die();
	} elseif (empty(_post('cons_address'))) {
		_alertback('请输入收货人详细地址！');
		die();
	} elseif (empty(_post('cons_name'))) {
		_alertback('请输入收货人名称！');
		die();
	} elseif (empty(_post('cons_phone'))) {
		_alertback('请输入收货人电话！');
		die();
	} elseif (empty(_post('ship_weight')) || floatval(_post('ship_weight')) <> _post('ship_weight')) {
		_alertback('请正确输入货物重量！');
		die();
	} elseif (empty(_post('ship_cubic')) || floatval(_post('ship_cubic')) <> _post('ship_cubic')) {
		_alertback('请正确输入货物体积！');
		die();
	} elseif (empty(_post('ship_quantity')) || intval(_post('ship_quantity')) <> _post('ship_quantity')) {
		_alertback('请正确输入货物件数！');
		die();
	} elseif (empty(_post('ship_desc'))) {
		_alertback('请输入货物内容描述！');
		die();
	}/* elseif (empty(_post('ship_image')) || (empty(_post('ship_image')[0]) && empty(_post('ship_image')[1]) && empty(_post('ship_image')[2]))) {
		_alertback('请至少上传一张货物照片！');
		die();
	}*/ elseif (empty(_post('ship_amount')) || floatval(_post('ship_amount')) <> _post('ship_amount')) {
		_alertback('请正确输入运费！');
		die();
	}

	if (!empty(_post('ship_number'))) {
		if ($order) {
			if ($check = _sqlone('ship_order', 'ship_number=\''._escape(_post('ship_number')).'\' and id != \''.$order['id'].'\'')) {
				_alertback('运单号已被使用，请核对重新输入！');
				die();
			}
		} else {
			if ($check = _sqlone('ship_order', 'ship_number=\''._escape(_post('ship_number')).'\'')) {
				_alertback('运单号已被使用，请核对重新输入！');
				die();
			}
		}
	}

	$data = array();
	$data['ship_number'] = _post('ship_number');
	$data['ship_prov'] = _post('ship_prov');
	$data['ship_city'] = _post('ship_city');
	$data['ship_area'] = _post('ship_area');
	$data['ship_address'] = _post('ship_address');
	$data['ship_name'] = _post('ship_name');
	$data['ship_phone'] = _post('ship_phone');
	$data['consignee_prov'] = _post('cons_prov');
	$data['consignee_city'] = _post('cons_city');
	$data['consignee_area'] = _post('cons_area');
	$data['consignee_address'] = _post('cons_address');
	$data['consignee_zipcode'] = _post('cons_zipcode');
	$data['consignee_name'] = _post('cons_name');
	$data['consignee_phone'] = _post('cons_phone');
	$data['ship_weight'] = floatval(_post('ship_weight'));
	$data['ship_cubic'] = floatval(_post('ship_cubic'));
	$data['ship_quantity'] = intval(_post('ship_quantity'));
	$data['ship_desc'] = _post('ship_desc');

	foreach (_post('ship_image') as $k => $image) {
		$key = 'ship_image';
		$key .= $k > 0 ? $k : '';
		$data[$key] = $image;
	}

	$data['pay_method'] = _post('pay_method');
	$data['ship_cod'] = floatval(_post('ship_cod'));
	$data['ship_amount'] = floatval(_post('ship_amount'));
	$data['ship_note'] = strip_tags(_post('ship_note'));

	$data['mod_time'] = time();
	$data['status'] = intval(_post('status'));

	if (empty($order)) {
		$data['add_time'] = time();
		$data['mid'] = intval(_session('code'));
		$data['sys'] = 1;

		if ($data['status'] > 1) {
			$data['rob_time'] = time();
		}
		if ($data['status'] > 2) {
			$data['pick_time'] = time();
		}
		if ($data['status'] > 3) {
			$data['ship_time'] = time();
		}

		if ($id = _sqlinsert('ship_order', $data)) {
			_sqlinsert('ship_order_status', array(
				'ship_number' => floatval($data['ship_number']),
				'status_before' => $data['status'],
				'status_after' => $data['status'],
				'content' => '已揽件：【'._session('admincompany').'】',
				'mid' => floatval(_session('adminid')),
				'add_time' => time(),
				'sys' => 1
			));
			_sqlinsert('ship_order_status', array(
				'ship_number' => floatval($data['ship_number']),
				'status_before' => $data['status'],
				'status_after' => $data['status'],
				'content' => '已到达：【'._session('admincompany').'】',
				'mid' => floatval(_session('adminid')),
				'add_time' => time(),
				'sys' => 1
			));
			_alerturl('操作成功！', _u('//list/'._v(4).'/'._v(5).'/'));
		} else {
			_alertback('操作失败，请稍后再试！');
		}
	} else {
		if ($id = _sqlupdate('ship_order', $data, 'id=\''.$order['id'].'\'')) {
			_alerturl('操作成功！', _u('//list/'._v(4).'/'._v(5).'/'));
		} else {
			_alertback('操作失败，请稍后再试！');
		}
	}
}

function __show(){
	$order =  _sqlone('ship_order','id='.intval(_v(3)));

	if (empty($order)) {
		_alerturl('记录不存在', _u('//list/'._v(4).'/'._v(5).'/'));
		die();
	}

	$order['rob_name'] = '';
	if (!empty($order['rob_open_id'])) {
		$uid = _sqlfield('ship_user', 'id', "wx_open_id='{$order['rob_open_id']}'");
		$order['rob_name'] = _sqlfield('ship_user_info', 'real_name', "uid='{$uid}'");
	}
	if (empty($order['rob_name']) && $order['mid'] > 0) {
		$order['rob_name'] = _sqlfield('ship_company', 'name', 'id=\''.(int)$order['mid'].'\'');
	}

	$order['ship_status'] = array();
	if ($order['status'] > 3) {
		$sql = "select s.* from "._pre('ship_to_stowage')." as s2s inner join "._pre('ship_stowage')." as s on s2s.stowage_id=s.id where s2s.ship_number='{$order['ship_number']}' and s.status>0 order by s.id desc";
		$res = _sqlselect($sql);
		$order['ship_status'] = $res;
	}

	_c('order', $order);

	_tpl('/show');
}