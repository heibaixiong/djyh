<?php
if(!defined('PART'))exit;
function __index(){
	if(!_session('webid')){
		_url(_u('/index/login'));
	}
	if(_ftime('temai')>CACHETIME){
		_f('temai',_sqlall('ware','length(`img`)>3 and hot=1 and state=0','px,id desc',10));
	}
	_c('temai',_f('temai'));
	if(_ftime('flash')>CACHETIME){
		_f('flash',_sqlall('ad','class=1 and state=0','px,id desc',1));
	}
	_c('flash',_f('flash'));
	if(_ftime('index')>CACHETIME){
		$index=_sqlall('class','pid=0 and state=0 order by px limit 7');
		foreach($index as $k=>$v){
			$index[$k]['ware']=_sqlall('ware','class1='.$v['id'].' and length(`img`)>3 and state=0 order by px,id desc limit 10');
			//$index[$k]['ware']=_sqlall('ware','class1='.$v['id'].' and length(`img`)>3 and state=0 limit 10');
		}
		_f('index',$index);
	}
	_c('index',_f('index'));
	_c('youjiao',array('','推荐','最新','热门'));
	_c('notice',_sqlone('notice','1 order by px'));
	if(_ftime('user')>CACHETIME){
		_f('user',_sqlall('admin','state=0 and (rank=3 or rank=3)','px,id desc',12));
	}
	_c('user',_f('user'));
	_tpl();
}
function __login(){
	_tpl();
}
?>