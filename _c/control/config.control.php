<?php
if(!defined('PART'))exit;

function __basic() {
	$user = _sqlone('ship_admin', "id='".intval(_session('adminid'))."'");

	if (empty($user)) {
		_alerturl('记录不存在', _u('/index/main/'));
		die();
	}

	if (!empty(_post())) {
		if (empty(_post('name'))) {
			_alertback('请输入姓名！');
			die();
		}
		if (empty(_post('company'))) {
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

		$data = array();
		$data['name']=_post('name');
		$data['company']=_post('company');
		$data['prov']=_post('prov');
		$data['city']=_post('city');
		$data['area']=_post('area');
		$data['address']=_post('address');
		$data['phone']=_post('phone');

		if ($id = _sqlupdate('ship_admin', $data, "id='{$user['id']}'")) {
			_alerturl('保存成功！', _u('//basic/'));
		} else {
			_alertback('保存失败，请稍后再试！');
		}
	}

	_c('user', $user);
	_c('form_action', _u('//basic/'));

	_tpl('/basic_form');
}

function __password() {
	$user = _sqlone('ship_admin', "id='".intval(_session('adminid'))."'");

	if (empty($user)) {
		_alerturl('记录不存在', _u('/index/main/'));
		die();
	}

	if (!empty(_post())) {
		if (empty(_post('old_pass'))) {
			_alertback('请输入原密码！');
			die();
		}
		if (empty(_post('new_pass'))) {
			_alertback('请输入新密码！');
			die();
		}
		if (_post('conf_pass') <> _post('new_pass')) {
			_alertback('两次输入密码不一致！');
			die();
		}

		$data = array();
		$data['pass']=_md5(_post('conf_pass'));

		if ($id = _sqlupdate('ship_admin', $data, "id='{$user['id']}'")) {
			_alerturl('保存成功！', _u('/login/out/'), true);
		} else {
			_alertback('保存失败，请稍后再试！');
		}
	}

	_c('user', $user);
	_c('form_action', _u('//password/'));

	_tpl('/pass_form');
}