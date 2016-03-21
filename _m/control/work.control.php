<?php
if(!defined('PART'))exit;
function __config(){
	$rs=_sqlone('compony','aid='._session('adminid'));
	if(empty($rs)){
		$data=array();
		$data['aid']=_session('adminid');
		_adminlogs('首次开通店铺');
		_sqlinsert('compony',$data);
	}
	_c('rs',$rs);
	_tpl('/config');
}
function __configedit(){
	$data=array();
    $data['product']=_post('product');
    $data['if']=_post('if');
    $data['zone']=_post('zone');
    $data['good']=_post('good');
    _sqlupdate('compony',$data,'aid='._session('adminid'));
    _adminlogs('设置店铺信息');
    _alerturl('成功设置店铺信息！',_u('/work/config/'));
}
?>