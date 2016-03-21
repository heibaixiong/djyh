<?php
if(!defined('PART'))exit;
_power('0,');
function __index(){
	_tpl('/index');
}
function __web(){
	_c('rs',_sqlone('config'));
	_tpl('/web');
}
function __webedit(){
	$data=array();
    $data['state']=_post('state');
    _sqlupdate('config',$data,'1');
    _adminlogs('设置网站开关');
    _alerturl('成功设置网站开关！',_u('/config/web/'));
}
function __sms(){
	_c('rs',_sqlone('config'));
	_tpl('/sms');
}
function __smsedit(){
	$data=array();
    $data['smsstate']=_post('smsstate');
    _sqlupdate('config',$data,'1');
    _adminlogs('设置短信开关');
    _alerturl('成功设置短信开关！',_u('/config/sms/'));
}
function __smsset(){
	_c('rs',_sqlone('config'));
	_tpl('/smsset');
}
function __smssetedit(){
	$data=array();
    $data['smsuser']=_post('smsuser');
    $data['smspass']=_post('smspass');
    _sqlupdate('config',$data,'1');
    _adminlogs('设置短信接口');
    _alerturl('成功设置短信接口！',_u('/config/smsset/'));
}
function __playset(){
	_c('rs',_sqlone('config'));
	_tpl('/playset');
}
function __playsetedit(){
	$data=array();
    $data['playuser']=_post('playuser');
    $data['playpass']=_post('playpass');
    _sqlupdate('config',$data,'1');
    _adminlogs('设置支付接口');
    _alerturl('成功设置支付接口！',_u('/config/playset/'));
}
function __shareset(){
	_c('rs',_sqlone('config'));
	_tpl('/shareset');
}
function __sharesetedit(){
	$data=array();
    $data['share']=_post('share');
    _sqlupdate('config',$data,'1');
    _adminlogs('设置服务站分润比例');
    _alerturl('成功设置服务站分润比例！',_u('/config/shareset/'));
}
function __cashset(){
	_c('rs',_sqlone('config'));
	_tpl('/cashset');
}
function __cashsetedit(){
	$data=array();
    $data['cash']=_post('cash');
    _sqlupdate('config',$data,'1');
    _adminlogs('设置商家提现最低金额');
    _alerturl('成功设置商家提现最低金额！',_u('/config/cashset/'));
}
function __conment(){
	_c('rs',_sqlone('config'));
	_tpl('/conment');
}
function __conmentedit(){
	$data=array();
    $data['conment']=_post('conment');
    _sqlupdate('config',$data,'1');
    _adminlogs('设置访客评论开关');
    _alerturl('成功设置访客评论开关！',_u('/config/conment/'));
}
function __config(){
	$title=_post('title');
	if(!empty($title)){
		$data=array();
	    $data['title']=_post('title');
	    $data['keyword']=_post('keyword');
	    $data['descri']=_post('descri');
	    $data['name']=_post('name');
	    $data['compony']=_post('compony');
	    $data['icp']=_post('icp');
	    $data['dummy']=_post('dummy');
	    $data['url']=_post('url');
	    _sqlupdate('config',$data,'1');
	    _adminlogs('编辑网站信息 '._post('title'));
	    _alerturl('成功编辑网站信息！',_u('/config/config/'));
	}else{
		_c('rs',_sqlone('config'));
		_tpl('/config');
	}
}
function __link(){
	$qq=_post('qq');
	if(!empty($qq)){
		$data=array();
	    $data['qq']=_post('qq');
	    $data['tel']=_post('tel');
	    $data['address']=_post('address');
	    $data['email']=_post('email');
	    _sqlupdate('config',$data,'1');
	    _adminlogs('编辑联系方式 '._post('qq'));
	    _alerturl('成功编辑联系方式！',_u('/config/link/'));
	}else{
		_c('rs',_sqlone('config'));
		_tpl('/link');
	}
}
function __search(){
	_c('rs',_sqlone('config'));
	_tpl('/search');
}
function __searchedit(){
	$data=array();
    $data['search']=_post('search');
    _sqlupdate('config',$data,'1');
    _adminlogs('设置搜索词');
    _alerturl('成功设置搜索词！',_u('/config/search/'));
}
?>