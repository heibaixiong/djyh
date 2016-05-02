<?php
if(!defined('PART'))exit;

function __driver(){
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
	$sql = "1=1";
	if(!empty($key)){
		$sql .= ' and (real_name like \'%'._escape($key).'%\' or phone like \'%'._escape($key).'%\')';
	}
	if ($s <> '') {
		$sql .= ' and status = \''.$s.'\'';
	}
	Page::start('ship_driver', $p, $sql, 'id desc');

	/*foreach (Page::$arr as $k => $order) {

	}*/

	_c('title', $s==''?'全部':$_['order_status'][$s]);
	_c('order_status', $_['order_status']);

	_tpl('/driver_list');
}

function __add_driver() {
	_c('driver', array());
	_c('form_action', _u('//save_driver//'._v(3).'/'._v(4).'/'));

	_tpl('/driver_form');
}

function __edit_driver() {
	$driver = _sqlone('ship_driver', "id='".intval(_v(3))."'");

	if (empty($driver)) {
		_alerturl('记录不存在', _u('//driver/'._v(4).'/'._v(5).'/'));
		die();
	}

	_c('driver', $driver);
	_c('form_action', _u('//save_driver/'._v(3).'/'._v(4).'/'._v(5).'/'));

	_tpl('/driver_form');
}

function __save_driver() {
	if (empty(_post('real_name'))) {
		_alertback('请输入承运人姓名！');
		die();
	}

	$driver = _sqlone('ship_driver', "id='".intval(_v(3))."'");

	$data = array();
	$data['real_name'] = _post('real_name');
	$data['prov'] = _post('prov');
	$data['city'] = _post('city');
	$data['area'] = _post('area');
	$data['sex'] = _post('sex');
	$data['age'] = _post('age');
	$data['edu'] = _post('edu');
	$data['exp'] = _post('exp');
	$data['phone'] = _post('phone');
	$data['id_card'] = _post('id_card');
	$data['note'] = _post('note');
	$data['status'] = _post('status');
	$data['mod_time'] = time();

	if (empty($driver)) {
		$data['add_time'] = time();
		$data['mid'] = floatval(_session('adminid'));
		if ($id = _sqlinsert('ship_driver', $data)) {
			_alerturl('操作成功！', _u('//driver/'._v(4).'/'._v(5).'/'));
		} else {
			_alertback('操作失败，请稍后再试！');
		}
	} else {
		if ($id = _sqlupdate('ship_driver', $data, "id='".$driver['id']."'")) {
			_alerturl('操作成功！', _u('//driver/'._v(4).'/'._v(5).'/'));
		} else {
			_alertback('操作失败，请稍后再试！');
		}
	}
}

function __car() {
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
	$sql = "1=1";
	if(!empty($key)){
		$sql .= ' and (number like \'%'._escape($key).'%\')';
	}
	if ($s <> '') {
		$sql .= ' and status = \''.$s.'\'';
	}
	Page::start('ship_car', $p, $sql, 'id desc');

	/*foreach (Page::$arr as $k => $order) {

	}*/

	_c('title', $s==''?'全部':$_['order_status'][$s]);
	_c('order_status', $_['order_status']);

	_tpl('/car_list');
}

function __add_car() {
	_c('driver', array());
	_c('form_action', _u('//save_car//'._v(3).'/'._v(4).'/'));

	_tpl('/car_form');
}

function __edit_car() {
	$driver = _sqlone('ship_car', "id='".intval(_v(3))."'");

	if (empty($driver)) {
		_alerturl('记录不存在', _u('//car/'._v(4).'/'._v(5).'/'));
		die();
	}

	_c('driver', $driver);
	_c('form_action', _u('//save_car/'._v(3).'/'._v(4).'/'._v(5).'/'));

	_tpl('/car_form');
}

function __save_car() {
	if (empty(_post('number'))) {
		_alertback('请输入车辆牌照！');
		die();
	}

	$driver = _sqlone('ship_car', "id='".intval(_v(3))."'");

	$data = array();
	$data['number'] = _post('number');
	$data['prov'] = _post('prov');
	$data['city'] = _post('city');
	$data['area'] = _post('area');
	$data['ship_weight'] = _post('ship_weight');
	$data['desc'] = _post('desc');
	if (strlen(_session('adminrank')) > 0 && _session('adminrank') == '0') $data['status'] = _post('status');
	$data['mod_time'] = time();

	if (empty($driver)) {
		$data['add_time'] = time();
		$data['mid'] = floatval(_session('adminid'));
		if (!isset($data['status'])) $data['status'] = 0;
		if ($id = _sqlinsert('ship_car', $data)) {
			_alerturl('操作成功！', _u('//car/'._v(4).'/'._v(5).'/'));
		} else {
			_alertback('操作失败，请稍后再试！');
		}
	} else {
		if ($id = _sqlupdate('ship_car', $data, "id='".$driver['id']."'")) {
			_alerturl('操作成功！', _u('//car/'._v(4).'/'._v(5).'/'));
		} else {
			_alertback('操作失败，请稍后再试！');
		}
	}
}
