<?php
if(!defined('PART'))exit;

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
	$sql = "tobe='1'";
	if (!(strlen(_session('adminrank')) > 0 && _session('adminrank') == '0')) $sql .= " and (mid='"._session('code')."' OR status=0)";

	if(!empty($key)){
		$sql .= ' and (real_name like \'%'._escape($key).'%\' or phone like \'%'._escape($key).'%\' or id_card like \'%'._escape($key).'%\')';
	}
	if ($s <> '') {
		//$sql .= ' and status = \''.$s.'\'';
	}
	Page::start('ship_user_info', $p, $sql, 'id desc');

	foreach (Page::$arr as $k => $worker) {
		Page::$arr[$k]['user_company'] = _sqlfield('ship_company', 'name', "id='{$worker['mid']}'");
	}

	_c('title', $s==''?'全部':$_['order_status'][$s]);
	_c('order_status', $_['order_status']);

	_tpl('/list');
}

function __add() {
	_c('user', array());
	_c('form_action', _u('//save//'._v(3).'/'._v(4).'/'));

	if (!(strlen(_session('adminrank')) > 0 && _session('adminrank') == '0')) {
		_c('company', _sqlall('ship_company', "id='".floatval(_session('code'))."'", 'id asc'));
	} else {
		_c('company', _sqlall('ship_company', '1=1', 'id asc'));
	}

	_tpl('/work_form');
}

function __edit() {
	$user = _sqlone('ship_user_info', "id='".intval(_v(3))."'");

	if (empty($user)) {
		_alerturl('记录不存在', _u('//list/'._v(4).'/'._v(5).'/'));
		die();
	}

	if (!(strlen(_session('adminrank')) > 0 && _session('adminrank') == '0') && $user && $user['status'] == '1' && $user['mid'] <> _session('code')) {
		_alerturl('您暂无权限进行此操作！', _u('//list/'._v(4).'/'._v(5).'/'));
		die();
	}

	_c('user', $user);
	_c('form_action', _u('//save/'._v(3).'/'._v(4).'/'._v(5).'/'));

	if (!(strlen(_session('adminrank')) > 0 && _session('adminrank') == '0')) {
		_c('company', _sqlall('ship_company', "id='".floatval(_session('code'))."'", 'id asc'));
	} else {
		_c('company', _sqlall('ship_company', '1=1', 'id asc'));
	}
	_tpl('/work_form');
}

function __save(){
	$user = _sqlone('ship_user_info', "id='".intval(_v(3))."'");

	if (!(strlen(_session('adminrank')) > 0 && _session('adminrank') == '0') && $user && $user['status'] == '1' && $user['mid'] <> _session('code')) {
		_alerturl('您暂无权限进行此操作！', _u('//list/'._v(4).'/'._v(5).'/'));
		die();
	}

	if (empty(_post('real_name'))) {
		_alertback('请输入姓名！');
		die();
	}
	if (empty(_post('id_card'))) {
		_alertback('请输入身份证号码！');
		die();
	}
	if (empty(_post('prov')) || empty(_post('city')) || empty(_post('area'))) {
		_alertback('请选择完整所在地！');
		die();
	}
	if (empty(_post('phone'))) {
		_alertback('请输入电话！');
		die();
	}
	if (empty(_post('mid'))) {
		_alertback('请选择所属网点！');
		die();
	}

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

	if (!(strlen(_session('adminrank')) > 0 && _session('adminrank') == '0')) {
		$data['mid'] = floatval(_session('code'));
	} else {
		$data['mid'] = floatval(_post('mid'));
	}
	$data['status'] = _post('status');
	$data['mod_time'] = time();

	if (empty($user)) {
		$data['add_time'] = time();
		$data['tobe'] = 1;
//		if ($id = _sqlinsert('ship_user_info', $data)) {
//			_alerturl('保存成功！', _u('//list/'._v(4).'/'._v(5).'/'));
//		} else {
			_alertback('保存失败，请稍后再试！');
//		}
	} else {
		if ($id = _sqlupdate('ship_user_info', $data, "id='{$user['id']}'")) {
			if ($user['tobe'] == '1') {
				if ($data['status'] == '1') {
					_sqlupdate('ship_user', array('role' => '1'), "id='{$user['uid']}'");
					$open_id = _sqlfield('ship_user', 'wx_open_id', "id='{$user['uid']}'");
					if ($open_id) _sendWxMsg($open_id, '恭喜您成功成为业务小哥，现在可以开始抢单了哦！');
				} else {
					_sqlupdate('ship_user', array('role' => '0'), "id='{$user['uid']}'");
					$open_id = _sqlfield('ship_user', 'wx_open_id', "id='{$user['uid']}'");
					if ($open_id) _sendWxMsg($open_id, '很遗憾，您的业务小哥身份已被取消！');
				}
			}
			_alerturl('保存成功！', _u('//list/'._v(4).'/'._v(5).'/'));
		} else {
			_alertback('保存失败，请稍后再试！');
		}
	}
}

function __msg() {
	if (!empty(_post())) {
		if (empty(_post('open_id'))) {
			_alertback('请输入微信账号！');
		}
		if (empty(_post('message'))) {
			_alertback('请输入消息内容！');
		}

		if (_sendWxMsg(_post('open_id'), _post('message'))) {
			_alerturl('发送成功！', _u('//msg/'));
		} else {
			_alertback('发送失败！');
		}
	}

	_c('form_action', _u('//msg/'));
	_tpl('/msg_form');
}