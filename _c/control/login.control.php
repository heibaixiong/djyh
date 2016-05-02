<?php
if(!defined('PART'))exit;
function __index(){
	_tpl('/index');
}
function __login(){
	$loginuser=_post('loginuser');
	$loginpwd=_post('loginpwd');
	if(!empty($loginuser)){
		$arr=_sqlone('ship_admin','user="'.$loginuser.'" and pass="'._md5($loginpwd).'"');
		if(empty($arr)){
			_adminlogs($loginuser.' 试图管理后台系统，密码错误');
			_alerturl('账号不存在或者密码错误！',_u('/login/index'));
		}else{
			_adminlogin($arr);
		}
	}
}
function __out(){
	_adminout();
}
?>