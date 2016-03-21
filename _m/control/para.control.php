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
	Page::start('para',$p,'pid='.$r,'px desc');
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
	    $data['img']=_post('img');
	    $data['state']=_post('state');
	    $data['px']=_post('px');
	    _sqlupdate('para',$data,'id='._post('id'));
	    _adminlogs('编辑参数 '._post('title'));
	    _alerturl('成功编辑参数！',_u('//list/0/'._post('pid').'/'));
	}else{
		_c('rs',_sqlone('para','id='._v(3)));
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
	    $data['img']=_post('img');
	    $data['state']=_post('state');
	    $data['px']=_post('px');
	    _sqlinsert('para',$data);
	    _adminlogs('添加参数 '._post('title'));
	    _alerturl('成功添加参数！',_u('//list/0/'._post('pid').'/'));
	}else{
		if(0==$id){
			_tpl('/add');
		}else{
			_tpl('/add2');
		}
	}
}
function __del(){
	$id=_v(3);
	if(!empty($id)){
		$rs=_sqlone('para','id='.$id);
		_adminlogs('删除参数 '.$rs['title']);
	    _sqldelete('para','id='.$id);
	    _alerturl('成功删除参数！',_u('//list/0/'._post('pid').'/'));
	}else{
		_tpl('/list');
	}
}
function __up(){
	$arr=_sqlall('para');
	foreach($arr as $k=>$v){
		if(0==$v['pid']){
			$pname='一级参数';
		}else{
			$rs=_sqlone('para','id='.$v['pid']);
			$pname=$rs['title'];
		}
		$data=array();
		$data['pname']=$pname;
		_sqlupdate('para',$data,'id='.$v['id']);
	}
	_adminlogs('更新参数');
	_alerturl('成功更新参数！',_u('//list/'));
	_tpl('/list');
}
?>