<?php
if(!defined('PART'))exit;
_power('0,');
function __user(){
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}
	Page::start('userlogs',$p);
	_c('title','后台日志');
	_tpl('/user');
}
function __web(){
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}
	Page::start('weblogs',$p);
	_c('title','后台日志');
	_tpl('/web');
}
function __cash(){
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}
	Page::start('cashlogs',$p);
	_c('title','后台日志');
	_tpl('/cash');
}
function __admin(){
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}
	Page::start('adminlogs',$p);
	_c('title','后台日志');
	_tpl('/admin');
}
?>