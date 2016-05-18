<?php
if(!defined('PART'))exit;
_power('0,');
function __list(){
	global $_;
	$s=_v(3);
	$p=_v(4);
	if(strlen($s) > 0 && !array_key_exists(intval($s), $_['user_ranks'])){
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
		$sql .= ' and (name like \'%'._escape($key).'%\' or company like \'%'._escape($key).'%\' or phone like \'%'._escape($key).'%\')';
	}
	if ($s <> '') {
		$sql .= ' and rank = \''.$s.'\'';
	}
	Page::start('ship_admin', $p, $sql, 'id desc');

	/*foreach (Page::$arr as $k => $order) {

	}*/

	_c('title', $s==''?'全部':$_['user_ranks'][$s]);

	_tpl('/list');
}

function __company(){
	global $_;
	$s=_v(3);
	$p=_v(4);
	if(strlen($s) > 0 && !array_key_exists(intval($s), $_['user_ranks'])){
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
		$sql .= ' and (name like \'%'._escape($key).'%\' or address like \'%'._escape($key).'%\' or phone like \'%'._escape($key).'%\')';
	}
	if ($s <> '') {
		$sql .= ' and rank = \''.$s.'\'';
	}
	Page::start('ship_company', $p, $sql, 'id desc');

	/*foreach (Page::$arr as $k => $order) {

	}*/

	_c('title', $s==''?'全部':$_['user_ranks'][$s]);

	_tpl('/company_list');
}

function __add() {
	_c('user', array());
	_c('form_action', _u('//save//'._v(3).'/'._v(4).'/'));

	_c('company', _sqlall('ship_company', '1=1', 'id asc'));

	_tpl('/user_form');
}

function __edit() {
	$user = _sqlone('ship_admin', "id='".intval(_v(3))."'");

	if (empty($user)) {
		_alerturl('记录不存在', _u('//list/'._v(4).'/'._v(5).'/'));
		die();
	}

	_c('user', $user);
	_c('form_action', _u('//save/'._v(3).'/'._v(4).'/'._v(5).'/'));

	_c('company', _sqlall('ship_company', '1=1', 'id asc'));

	_tpl('/user_form');
}

function __save(){
	$user = _sqlone('ship_admin', "id='".intval(_v(3))."'");

	$data = array();
	if (empty($user)) {
		if (!empty(_post('user'))) {
			$exist = _sqlone('ship_admin', "user='"._escape(_post('user'))."'");
			if ($exist) {
				_alertback('账号已存在！');
				die();
			} else {
				$data['user'] = _post('user');
			}
		} else {
			$data['user'] = 's' . _random(8, 'num');
		}

		if (empty(_post('pass'))) {
			_alertback('密码不能为空！');
			die();
		} else {
			$data['pass']=_md5(_post('pass'));
		}
	} else {
		if(!empty(_post('pass'))){
			$data['pass']=_md5(_post('pass'));
		}
	}

	if (empty(_post('name'))) {
		_alertback('请输入姓名！');
		die();
	}
	if (empty(_post('company'))) {
		_alertback('请选择网点！');
		die();
	}
	if (empty(_post('prov')) || empty(_post('city')) || empty(_post('area'))) {
		_alertback('请选择完整所在地！');
		die();
	}
	if (empty(_post('address'))) {
		_alertback('请输入地址！');
		die();
	}
	if (empty(_post('phone'))) {
		_alertback('请输入电话！');
		die();
	}

	$data['name'] = _post('name');
	$data['company'] = _post('company');
	$data['code'] = intval(_post('code'));
	$data['prov'] = _post('prov');
	$data['city'] = _post('city');
	$data['area'] = _post('area');
	$data['address'] = _post('address');
	$data['phone'] = _post('phone');
	$data['rank'] = _post('rank');
	$data['state'] = _post('state');
	$data['updatetime'] = time();

	if (empty($user)) {
		$data['regtime'] = time();
		if ($id = _sqlinsert('ship_admin', $data)) {
			_alerturl('保存成功！', _u('/user/list/'._v(4).'/'._v(5).'/'));
		} else {
			_alertback('保存失败，请稍后再试！');
		}
	} else {
		if ($id = _sqlupdate('ship_admin', $data, "id='{$user['id']}'")) {
			_alerturl('保存成功！', _u('/user/list/'._v(4).'/'._v(5).'/'));
		} else {
			_alertback('保存失败，请稍后再试！');
		}
	}
}

function __add_company() {
	_c('user', array());
	_c('form_action', _u('//save_company//'._v(3).'/'._v(4).'/'));

	_tpl('/company_form');
}

function __edit_company() {
	$user = _sqlone('ship_company', "id='".intval(_v(3))."'");

	if (empty($user)) {
		_alerturl('记录不存在', _u('//company/'._v(4).'/'._v(5).'/'));
		die();
	}

	_c('user', $user);
	_c('form_action', _u('//save_company/'._v(3).'/'._v(4).'/'._v(5).'/'));

	_tpl('/company_form');
}

function __save_company(){
	$user = _sqlone('ship_company', "id='".intval(_v(3))."'");

	$data = array();

	if (empty(_post('name'))) {
		_alertback('请输入网点名称！');
		die();
	}
	if (empty(_post('prov')) || empty(_post('city')) || empty(_post('area'))) {
		_alertback('请选择完整所在地！');
		die();
	}
	if (empty(_post('address'))) {
		_alertback('请输入地址！');
		die();
	}
	if (empty(_post('phone'))) {
		_alertback('请输入电话！');
		die();
	}

	$data['name']=_post('name');
	$data['prov']=_post('prov');
	$data['city']=_post('city');
	$data['area']=_post('area');
	$data['address']=_post('address');
	$data['phone']=_post('phone');
	$data['rank']=_post('rank');
	$data['status']=_post('status');
	$data['mod_time'] = time();

	if (empty($user)) {
		$data['add_time'] = time();
		if ($id = _sqlinsert('ship_company', $data)) {
			_alerturl('保存成功！', _u('/user/company/'._v(4).'/'._v(5).'/'));
		} else {
			_alertback('保存失败，请稍后再试！');
		}
	} else {
		if ($id = _sqlupdate('ship_company', $data, "id='{$user['id']}'")) {
			_alerturl('保存成功！', _u('/user/company/'._v(4).'/'._v(5).'/'));
		} else {
			_alertback('保存失败，请稍后再试！');
		}
	}
}