<?php
if(!defined('PART'))exit;
function _power($rank='',$str=''){
	if(!_session('adminid')||strlen(_session('adminuser'))<3){
		//_u('/login/index');
		_url(_u('/login/index'),true);
	}
	$rs=_sqlone('ship_admin', 'id='._session('adminid'));
	if((_session('adminuser')!=$rs['user'])||($rs['state']==0)){
		_adminlogs('试图进入后台');
		_alerturl('您的账户有问题，请确认您的信息！',_u('/login/index'),true);
	}
	if(!empty($rank)){
		$dengji=explode(',',$rank);
		if(!in_array(_session('adminrank'),$dengji)){
			_adminlogs('试图进入 '.$str.' 板块，权限不足');
			_alertback('您的权限不足！');
		}
	}
}
?>