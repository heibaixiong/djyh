<?php
if(!defined('PART'))exit;
_power();
function __list(){
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}
	Page::start('unit',$p);
	_tpl('/list');
}
function __edit(){
	$title=_post('title');
	if(!empty($title)){
		$data=array();
	    $data['title']=_post('title');
	    $data['content']=_post('content');
	    $data['state']=_post('state');
	    $data['px']=_post('px');
	    _sqlupdate('unit',$data,'id='._post('id'));
	    _adminlogs('编辑单位 '._post('title'));
	    _alerturl('成功编辑单位！',_u('//list/'));
	}else{
		_c('rs',_sqlone('unit','id='._v(3)));
		_tpl('/edit');
	}
}
function __add(){
	$title=_post('title');
	if(!empty($title)){
		$data=array();
	    $data['title']=_post('title');
	    $data['content']=_post('content');
	    $data['state']=_post('state');
	    $data['px']=_post('px');
	    _sqlinsert('unit',$data);
	    _adminlogs('添加单位 '._post('title'));
	    _alerturl('成功添加单位！',_u('//list/'));
	}else{
		_tpl('/add');
	}
}
function __del(){
	$id=_v(3);
	if(!empty($id)){
		$rs=_sqlone('unit','id='.$id);
		_adminlogs('删除单位 '.$rs['title']);
	    _sqldelete('unit','id='.$id);
	    _alerturl('成功删除单位！',_u('//list/'));
	}else{
		_tpl('/list');
	}
}
?>