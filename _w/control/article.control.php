<?php
if(!defined('PART'))exit;
function __show(){
	_c('rs',_sqlone('article','id='.floatval(_v(3))));
	_c('title','帮助中心');
	_tpl();
}
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
		_c('title','帮助中心');
		Page::start('article',$p);
	}else{
		_c('title',_sqlfield('articleclass','title','id='.$r).'-'.$_['config']['title']);
		Page::start('article',$p,'classid='.$r);
	}	
	_tpl('/index');
}
?>