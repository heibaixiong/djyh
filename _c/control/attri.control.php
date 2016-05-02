<?php
if(!defined('PART'))exit;
_power();
function __list(){
	$p=_v(3);
	$r=_v(4);
	if(empty($p)){
		$p=0;
	}
	if(empty($r)){
		$r=0;
	}
	Page::start('attri',$p,'pid='.$r,'px desc');
	if(0==$r){
		_tpl('/list');
	}else{
		_tpl('/list2');
	}	
}
function __edit(){
	$title=_post('title');
	if(!empty($title)){
		$data=array();
		$data['pid']=_post('pid');
	    $data['title']=_post('title');
	    $data['content']=_post('content');
	    $data['state']=_post('state');
	    $data['px']=_post('px');
	    _sqlupdate('attri',$data,'id='._post('id'));
	    _adminlogs('编辑属性 '._post('title'));
	    _alerturl('成功编辑属性！',_u('//list/0/'._post('pid').'/'));
	}else{
		_c('rs',_sqlone('attri','id='._v(3)));
		if(0==_v(3)){
			_tpl('/edit');
		}else{
			_tpl('/edit2');
		}
	}	
}
function __add(){
	$id=_v(3);
	if(empty($id)){
		$id=0;
	}
	$title=_post('title');
	if(!empty($title)){
		$data=array();
		$data['pid']=_post('pid');
	    $data['title']=_post('title');
	    $data['content']=_post('content');
	    $data['state']=_post('state');
	    $data['px']=_post('px');
	    _sqlinsert('attri',$data);
	    _adminlogs('添加属性 '._post('title'));
	    _alerturl('成功添加属性！',_u('//list/0/'._post('pid').'/'));
	}else{
		if(0==_v(3)){
			_tpl('/add');
		}else{
			_tpl('/add2');
		}
	}
}
function __del(){
	$id=_v(3);
	if(!empty($id)){
		$rs=_sqlone('attri','id='.$id);
		_adminlogs('删除属性 '.$rs['title']);
	    _sqldelete('attri','id='.$id);
	    _alerturl('成功删除属性！',_u('//list/'));
	}else{
		_tpl('/list');
	}
}
function __up(){
	$arr=_sqlall('attri');
	foreach($arr as $k=>$v){
		if(0==$v['pid']){
			$pname='一级属性';
		}else{
			$rs=_sqlone('attri','id='.$v['pid']);
			$pname=$rs['title'];
		}
		$data=array();
		$data['pname']=$pname;
		_sqlupdate('attri',$data,'id='.$v['id']);
	}
	_adminlogs('更新属性');
	_alerturl('成功更新属性！',_u('//list/'));
	_tpl('/list');
}
?>