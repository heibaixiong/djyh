<?php
if(!defined('PART'))exit;
_power('0,');
function __list(){
	global $_;

	$r=_v(3);
	if(empty($r)){
		$r=0;
	}

	$p=_v(4);
	if(empty($p)){
		$p=0;
	}

	Page::start('admin',$p,'rank='.$r);

	_c('title', $_['rank'][$r]);
	_tpl('/list');
}
function __area(){
	$r=_v(3);
	if(empty($r)){
		$sql='length(`code`)=4';
	}else{
		if(strlen($r)>5){
			$sql='code>'.($r*1000).' and code<'.($r*1000+1000);
		}else{
			$sql='code>'.($r*100).' and code<'.($r*100+100);
		}
	}
	$p=_v(4);
	if(empty($p)){
		$p=0;
	}	
	Page::start('area',$p,$sql,'px',20);
	_c('title','区域管理');
	_tpl('/area');
}
function __areaedit(){
	$title=_post('title');
	if(!empty($title)){
		$data=array();
	    $data['title']=_post('title');
	    $data['uid']=_post('uid');
	    $data['px']=_post('px');
	    _sqlupdate('area',$data,'id='._post('id'));
	    _adminlogs('编辑区域 '._post('title'));
	    _alerturl('成功编辑区域！',_u('//area/'));
	}else{
		_c('rs',_sqlone('area','id='._v(3)));
		_tpl('/areaedit');
	}
}
function __join(){
	$r=_v(3);
	if(empty($r)){
		$sql='length(`code`)=4';
	}else{
		if(strlen($r)>5){
			$sql='code>'.($r*1000).' and code<'.($r*1000+1000);
		}else{
			$sql='code>'.($r*100).' and code<'.($r*100+100);
		}
	}
	$p=_v(4);
	if(empty($p)){
		$p=0;
	}
	Page::start('area',$p,'uid>0 and '.$sql);
	_c('title','加盟区域管理');
	_tpl('/join');
}
function __nolist(){
	$r=_v(3);
	if(empty($r)){
		$r=0;
	}
	$p=_v(4);
	if(empty($p)){
		$p=0;
	}
	Page::start('admin',$p,'state=1 and rank='.$r);
	_c('title','限制会员管理');
	_tpl('/nolist');
}
function __edit(){
	$user=_post('user');
	if(!empty($user)){
		$data=array();
	    $data['user']=_post('user');
	    $pass=_post('pass');
	    if(!empty($pass)){
	    	$data['pass']=_md5(_post('pass'));
	    }
	    $data['name']=_post('name');
	    $data['compony']=_post('compony');
	    $data['address']=_post('address');
	    $data['tel']=_post('tel');
	    $data['code']=_post('code');
	    $data['admincode']=_post('admincode');
	    $data['rank']=_post('rank');
	    $data['rate']=_post('rate');
	    $data['state']=_post('state');
	    $data['px']=_post('px');
	    _sqlupdate('admin',$data,'id='._post('id'));
	    _adminlogs('编辑会员 '._post('user'));
	    _alerturl('成功编辑会员！',_u('//list/'));
	}else{
		_c('rs',_sqlone('admin','id='._v(3)));
		_c('company',_sqlone('compony','aid='._v(3)));
		_tpl('/edit');
	}
}
function __add(){
	$user=_post('user');
	if(!empty($user)){
		$data=array();
	    $data['user']=_post('user');
	    $data['pass']=_md5(_post('pass'));
	    $data['name']=_post('name');
	    $data['compony']=_post('compony');
	    $data['address']=_post('address');
	    $data['tel']=_post('tel');
	    $data['code']=_post('code');
	    $data['admincode']=_post('admincode');
	    $data['rank']=_post('rank');
	    $data['rate']=_post('rate');
	    $data['state']=_post('state');
	    $data['px']=_post('px');
	    $data['regtime']=time();
	    _sqlinsert('admin',$data);
	    _adminlogs('添加会员 '._post('user'));
	    _alerturl('成功添加会员！',_u('//list/'));
	}else{
		_tpl('/add');
	}
}
function __del(){
	exit;
	global $_vew,$_wrap,$_;
	$id=$_vew[3];
	if(!empty($id)){
		$rs=_sqlone(_pre('admin'),'id='.$id);
		_adminlogs('删除公司员工 '.$rs['title']);
	    _sqldelete(_pre('admin'),'id='.$id);
	    _alerturl('成功删除公司员工！',$_wrap['ctrl_url'].$_vew[1].'/list');
	}else{
		_tpl('/list');
	}
}
?>