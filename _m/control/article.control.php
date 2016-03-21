<?php
if(!defined('PART'))exit;
function __notice(){
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}
	Page::start('notice',$p);
	_tpl('/notice');
}
function __noticeedit(){
	$title=_post('title');
	if(!empty($title)){
		$data=array();
	    $data['title']=_post('title');
	    $data['mess']=_post('mess');
	    $data['state']=_post('state');
	    $data['px']=_post('px');
	    _sqlupdate('notice',$data,'id='._post('id'));
	    _adminlogs('编辑公告 '._post('title'));
	    _alerturl('成功编辑公告！',_u('//notice/'));
	}else{
		_c('rs',_sqlone('notice','id='._v(3)));
		_tpl('/noticeedit');
	}	
}
function __noticeadd(){
	$title=_post('title');
	if(!empty($title)){
		$data=array();
	    $data['title']=_post('title');
	    $data['mess']=_post('mess');
	    $data['addtime']=_post('addtime');
	    $data['state']=_post('state');
	    $data['px']=_post('px');
	    _sqlinsert('notice',$data);
	    _adminlogs('添加公告 '._post('title'));
	    _alerturl('成功添加公告！',_u('//notice/'));
	}else{
		_tpl('/noticeadd');
	}
}
function __noticedel(){
	$id=_v(3);
	if(!empty($id)){
		$rs=_sqlone('notice','id='.$id);
		_adminlogs('删除公告 '.$rs['title']);
	    _sqldelete('notice','id='.$id);
	    _alerturl('成功删除公告！',_u('//notice/'));
	}else{
		_tpl('/notice');
	}
}
function __articleclass(){
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}
	Page::start('articleclass',$p);
	_tpl('/articleclass');
}
function __article(){
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}
	Page::start('article',$p);
	_tpl('/article');
}
function __articleclassedit(){
	$title=_post('title');
	if(!empty($title)){
		$data=array();
	    $data['title']=_post('title');
	    $data['state']=_post('state');
	    $data['px']=_post('px');
	    _sqlupdate('articleclass',$data,'id='._post('id'));
	    _adminlogs('编辑文章分类 '._post('title'));
	    _alerturl('成功编辑文章分类！',_u('//articleclass/'));
	}else{
		_c('rs',_sqlone('articleclass','id='._v(3)));
		_tpl('/articleclassedit');
	}
}
function __articleedit(){
	$title=_post('title');
	if(!empty($title)){
		$data=array();
		$data['classid']=_post('classid');
	    $data['title']=_post('title');
	    $data['img']=_post('img');
	    $data['mess']=_post('mess');
	    $data['state']=_post('state');
	    $data['px']=_post('px');
	    _sqlupdate('article',$data,'id='._post('id'));
	    _adminlogs('编辑文章 '._post('title'));
	    _alerturl('成功编辑文章！',_u('//article/'));
	}else{
		_c('rs',_sqlone('article','id='._v(3)));
		_c('classid',_sqlall('articleclass','state=0 order by px'));
		_tpl('/articleedit');
	}
}
function __articleclassadd(){
	$title=_post('title');
	if(!empty($title)){
		$data=array();
	    $data['title']=_post('title');
	    $data['state']=_post('state');
	    $data['px']=_post('px');
	    _sqlinsert('articleclass',$data);
	    _adminlogs('添加文章分类 '._post('title'));
	    _alerturl('成功添加文章分类！',_u('//articleclass/'));
	}else{
		_tpl('/articleclassadd');
	}
}
function __articleadd(){
	$title=_post('title');
	if(!empty($title)){
		$data=array();
		$data['classid']=_post('classid');
	    $data['title']=_post('title');
	    $data['img']=_post('img');
	    $data['mess']=_post('mess');
	    $data['addtime']=_post('addtime');
	    $data['state']=_post('state');
	    $data['px']=_post('px');
	    _sqlinsert('article',$data);
	    _adminlogs('添加文章 '._post('title'));
	    _alerturl('成功添加文章！',_u('//article/'));
	}else{
		_c('classid',_sqlall('articleclass','state=0 order by px'));
		_tpl('/articleadd');
	}
}
function __articleclassdel(){
	$id=_v(3);
	if(!empty($id)){
		$rs=_sqlone('article','id='.$id);
		_adminlogs('删除文章分类 '.$rs['title']);
	    _sqldelete('articlecalss','id='.$id);
	    _alerturl('成功删除文章分类！',_u('//articleclass/'));
	}else{
		_tpl('/articleclass');
	}
}
function __articledel(){
	$id=_v(3);
	if(!empty($id)){
		$rs=_sqlone('article','id='.$id);
		_adminlogs('删除文章 '.$rs['title']);
	    _sqldelete('article','id='.$id);
	    _alerturl('成功删除文章！',_u('//article/'));
	}else{
		_tpl('/article');
	}
}
function __articlestate(){
	_power('0,1');
	$id=_v(3);
	if(!empty($id)){
		$rs=_sqlone('article','id='.$id);
		$state=$rs['state']==1?0:1;
		$state_str=$state==1?'隐藏':'开启';
		$data=array();
		$data['state']=$state;
		_sqlupdate('article',$data,'id='.$id);
		_adminlogs('更改文章 '.$rs['title'].' 显示隐藏状态：'.$state_str);
	    _alerturl('成功更改文章 '.$rs['title'].' 显示隐藏状态：'.$state_str,_u('//article/'.$rs['pid']));
	}else{
		_tpl('/article');
	}
}
function __articleclassstate(){
	_power('0,1');
	$id=_v(3);
	if(!empty($id)){
		$rs=_sqlone('articleclass','id='.$id);
		$state=$rs['state']==1?0:1;
		$state_str=$state==1?'隐藏':'开启';
		$data=array();
		$data['state']=$state;
		_sqlupdate('articleclass',$data,'id='.$id);
		_adminlogs('更改文章分类 '.$rs['title'].' 显示隐藏状态：'.$state_str);
	    _alerturl('成功更改文章分类 '.$rs['title'].' 显示隐藏状态：'.$state_str,_u('//articleclass/'.$rs['pid']));
	}else{
		_tpl('/articleclass');
	}
}
function __newsclass(){
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}
	Page::start('newsclass',$p);
	_tpl('/newsclass');
}
function __news(){
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}
	Page::start('news',$p);
	_tpl('/news');
}
function __newsclassedit(){
	$title=_post('title');
	if(!empty($title)){
		$data=array();
	    $data['title']=_post('title');
	    $data['state']=_post('state');
	    $data['px']=_post('px');
	    _sqlupdate('newsclass',$data,'id='._post('id'));
	    _adminlogs('编辑新闻分类 '._post('title'));
	    _alerturl('成功编辑新闻分类！',_u('//newsclass/'));
	}else{
		_c('rs',_sqlone('newsclass','id='._v(3)));
		_tpl('/newsclassedit');
	}
}
function __newsedit(){
	$title=_post('title');
	if(!empty($title)){
		$data=array();
		$data['classid']=_post('classid');
	    $data['title']=_post('title');
	    $data['img']=_post('img');
	    $data['mess']=_post('mess');
	    $data['state']=_post('state');
	    $data['px']=_post('px');
	    _sqlupdate('news',$data,'id='._post('id'));
	    _adminlogs('编辑新闻 '._post('title'));
	    _alerturl('成功编辑新闻！',_u('//news/'));
	}else{
		_c('rs',_sqlone('news','id='._v(3)));
		_c('classid',_sqlall('newsclass','state=0 order by px'));
		_tpl('/newsedit');
	}
}
function __newsclassadd(){
	$title=_post('title');
	if(!empty($title)){
		$data=array();
	    $data['title']=_post('title');
	    $data['state']=_post('state');
	    $data['px']=_post('px');
	    _sqlinsert('newsclass',$data);
	    _adminlogs('添加新闻分类 '._post('title'));
	    _alerturl('成功添加新闻分类！',_u('//newsclass/'));
	}else{
		_tpl('/newsclassadd');
	}
}
function __newsadd(){
	$title=_post('title');
	if(!empty($title)){
		$data=array();
		$data['classid']=_post('classid');
	    $data['title']=_post('title');
	    $data['img']=_post('img');
	    $data['mess']=_post('mess');
	    $data['addtime']=_post('addtime');
	    $data['state']=_post('state');
	    $data['px']=_post('px');
	    _sqlinsert('news',$data);
	    _adminlogs('添加新闻 '._post('title'));
	    _alerturl('成功添加新闻！',_u('//news/'));
	}else{
		_c('classid',_sqlall('newsclass','state=0 order by px'));
		_tpl('/newsadd');
	}
}
function __newsclassdel(){
	$id=_v(3);
	if(!empty($id)){
		$rs=_sqlone('news','id='.$id);
		_adminlogs('删除新闻分类 '.$rs['title']);
	    _sqldelete('newscalss','id='.$id);
	    _alerturl('成功删除新闻分类！',_u('//newsclass/'));
	}else{
		_tpl('/newsclass');
	}
}
function __newsdel(){
	$id=_v(3);
	if(!empty($id)){
		$rs=_sqlone('news','id='.$id);
		_adminlogs('删除新闻 '.$rs['title']);
	    _sqldelete('news','id='.$id);
	    _alerturl('成功删除新闻！',_u('//news/'));
	}else{
		_tpl('/news');
	}
}
function __newsstate(){
	_power('0,1');
	$id=_v(3);
	if(!empty($id)){
		$rs=_sqlone('news','id='.$id);
		$state=$rs['state']==1?0:1;
		$state_str=$state==1?'隐藏':'开启';
		$data=array();
		$data['state']=$state;
		_sqlupdate('news',$data,'id='.$id);
		_adminlogs('更改新闻 '.$rs['title'].' 显示隐藏状态：'.$state_str);
	    _alerturl('成功更改新闻 '.$rs['title'].' 显示隐藏状态：'.$state_str,_u('//news/'.$rs['pid']));
	}else{
		_tpl('/news');
	}
}
function __newsclassstate(){
	_power('0,1');
	$id=_v(3);
	if(!empty($id)){
		$rs=_sqlone('newsclass','id='.$id);
		$state=$rs['state']==1?0:1;
		$state_str=$state==1?'隐藏':'开启';
		$data=array();
		$data['state']=$state;
		_sqlupdate('newsclass',$data,'id='.$id);
		_adminlogs('更改新闻分类 '.$rs['title'].' 显示隐藏状态：'.$state_str);
	    _alerturl('成功更改新闻分类 '.$rs['title'].' 显示隐藏状态：'.$state_str,_u('//newsclass/'.$rs['pid']));
	}else{
		_tpl('/newsclass');
	}
}
?>