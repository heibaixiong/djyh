<?php
if(!defined('PART'))exit;
function __index(){
	$r = intval(_v(3));
	if(empty($r)){
		$r=0;
	}
	$p = intval(_v(4));
	if(empty($p)){
		$p=0;
	}
	global $_;
	if(0==$r){
		_c('title','新闻中心');
		Page::start('news',$p);
	}else{
		_c('title',_sqlfield('newsclass','title','id='.$r));
		Page::start('news',$p,'classid='.$r);
	}	
	_tpl('/index');
}
function __show(){
	_c('rs',_sqlone('news','id='.floatval(_v(3))));
	_c('title','新闻中心');
	_tpl();
}
?>