<?php
if(!defined('PART'))exit;
function __index(){
	$r=_v(3);
	if(empty($r)){
		$r=0;
	}
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}
	global $_;
	if(0==$r){
		_c('title','新闻中心-'.$_['config']['title']);
		Page::start('news',$p);
	}else{
		_c('title',_sqlfield('newsclass','title','id='.$r).'-'.$_['config']['title']);
		Page::start('news',$p,'classid='.$r);
	}	
	_tpl('/index');
}
function __show(){
	_c('rs',_sqlone('news','id='._v(3)));
	_tpl();
}
?>