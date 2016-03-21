<?php
if(!defined('PART'))exit;
_power('0,');
function __config(){
	_fdel('config');
	_tpl('/cache');
}
function __oneclass(){
	_fdel('oneclass');
	_tpl('/cache');
}
function __index(){
	_fdel('index');
	_tpl('/cache');
}
function __indexad(){
	_fdel('indexad');
	_tpl('/cache');
}
function __duilian(){
	_fdel('duilian');
	_tpl('/cache');
}
function __article(){
	_fdel('article');
	_tpl('/cache');
}
function __temai(){
	_fdel('temai');
	_tpl('/cache');
}
?>