<?php
if(!defined('PART'))exit;
function __ad(){
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}
	Page::start('ad',$p,'class=0');
	_tpl('/ad');
}
function __adedit(){
	$img=_post('img');
	if(!empty($img)){
		$data=array();
		$data['code']=_post('code');
		$data['postion']=_post('postion');
	    $data['title']=_post('title');
	    $data['img']=_post('img');
	    $data['url']=_post('url');
	    $data['state']=_post('state');
	    $data['px']=_post('px');
	    _sqlupdate('ad',$data,'id='._post('id'));
	    _adminlogs('编辑广告 '._post('title'));
	    _alerturl('成功编辑广告！',_u('//ad/'));
	}else{
		_c('rs',_sqlone('ad','id='._v(3)));
		_tpl('/adedit');
	}	
}
function __adadd(){
	$img=_post('img');
	if(!empty($img)){
		$data=array();
		$data['class']=0;
		$data['code']=_post('code');
		$data['postion']=_post('postion');
	    $data['title']=_post('title');
	    $data['img']=_post('img');
	    $data['url']=_post('url');
	    $data['state']=_post('state');
	    $data['px']=_post('px');
	    _sqlinsert('ad',$data);
	    _adminlogs('添加广告 '._post('title'));
	    _alerturl('成功添加广告！',_u('//ad/'));
	}else{
		_tpl('/adadd');
	}
}
function __addel(){
	$id=_v(3);
	if(!empty($id)){
		$rs=_sqlone('ad','id='.$id);
		_adminlogs('删除广告 '.$rs['title']);
	    _sqldelete('ad','id='.$id);
	    _alerturl('成功删除广告！',_u('//ad/'));
	}else{
		_tpl('/ad');
	}
}
function __flash(){
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}
	Page::start('ad',$p,'class=1');
	_tpl('/flash');
}
function __flashedit(){
	$title=_post('title');
	if(!empty($title)){
		$data=array();
		$data['code']=_post('code');
	    $data['title']=_post('title');
	    $data['img']=_post('img');
	    $data['url']=_post('url');
	    $data['state']=_post('state');
	    $data['px']=_post('px');
	    _sqlupdate('ad',$data,'id='._post('id'));
	    _adminlogs('编辑幻灯片 '._post('title'));
	    _alerturl('成功编辑幻灯片！',_u('//flash/'));
	}else{
		_c('rs',_sqlone('ad','id='._v(3)));
		_tpl('/flashedit');
	}	
}
function __flashadd(){
	$title=_post('title');
	if(!empty($title)){
		$data=array();
		$data['class']=1;
		$data['code']=_post('code');
	    $data['title']=_post('title');
	    $data['img']=_post('img');
	    $data['url']=_post('url');
	    $data['state']=_post('state');
	    $data['px']=_post('px');
	    _sqlinsert('ad',$data);
	    _adminlogs('添加幻灯片 '._post('title'));
	    _alerturl('成功添加幻灯片！',_u('//flash/'));
	}else{
		_tpl('/flashadd');
	}
}
function __flashel(){
	$id=_v(3);
	if(!empty($id)){
		$rs=_sqlone('ad','id='.$id);
		_adminlogs('删除幻灯片 '.$rs['title']);
	    _sqldelete('ad','id='.$id);
	    _alerturl('成功删除幻灯片！',_u('//flash/'));
	}else{
		_tpl('/flash');
	}
}
function __cache(){
	_f('ad',_sqlall('ad'));
	_tpl();
}
?>