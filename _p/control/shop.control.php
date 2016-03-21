<?php
if(!defined('PART'))exit;
function __index(){
	$r=_v(3);
	if(empty($r)){
		$r=0;
	}
	$p=_v(4);
	if(empty($p)){
		$p=0;
	}
	$px=_v(5);
	if(empty($px)){
		$px=0;
	}
	$pxsql='px,id desc';
	if($px==1){
		$pxsql='sale desc';
	}
	if($px==2){
		$pxsql='mark';
	}
	global $_;
	if(0==$r){
		_c('title','所有商品');
		_c('classtitle','所有分类');
		_c('shopclass',_f('oneclass'));
		Page::start('ware',$p,'1',$pxsql);
	}else{
		_c('title',_sqlfield('class','title','id='.$r));
		$pid=_sqlfield('class','pid','id='.$r);
		if(0==$pid){
			_c('shopclass',_sqlall('class','pid='.$r,'px'));
			_c('classtitle',_sqlfield('class','title','pid='.$r));
		}else{
			_c('shopclass',_sqlall('class','pid='.$pid,'px'));
			_c('classtitle',_sqlfield('class','title','id='.$pid));
		}
		Page::start('ware',$p,'class1='.$r.' or class2='.$r.' and state=0',$pxsql);
	}	
	_tpl('/index');
}
function __search(){
    if(_post('key')){
    	_url(_u('///'.urlencode(_post('key')).'/'));
    }    
    $p=_v(4);
	if(empty($p)){
		$p=0;
	}
	$px=_v(5);
	if(empty($px)){
		$px=0;
	}
	$pxsql='px,id desc';
	if($px==1){
		$pxsql='sale desc';
	}
	if($px==2){
		$pxsql='mark';
	}
    $key=urldecode(_v(3));
    _c('title',$key);
	_c('classtitle','所有分类');
	_c('shopclass',_f('oneclass'));
	$sql='';
    if(!empty($key)){
        $sql.='state=0 and (title like \'%'.$key.'%\' or number like \'%'.$key.'%\')';
    }
	Page::start('ware',$p,$sql,$pxsql);
    _tpl('/index');
}
function __special(){
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}
	_c('title','推荐商品');
	_c('classtitle','所有分类');
	_c('shopclass',_f('oneclass'));
	Page::start('ware',$p,'recommend=1 and state=0','px,id desc');
	_tpl('/index');
}
function __hot(){
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}
	_c('title','热销商品');
	_c('classtitle','所有分类');
	_c('shopclass',_f('oneclass'));
	Page::start('ware',$p,'hot=1 and state=0','px,id desc');
	_tpl('/index');
}
function __new(){
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}
	_c('title','最新上架');
	_c('classtitle','所有分类');
	_c('shopclass',_f('oneclass'));
	Page::start('ware',$p,'new=1 and state=0','px,id desc');
	_tpl('/index');
}
function __show(){
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}
	$arr=_sqlone('ware','id='.$p);
	_c('rs',$arr);
	_c('rs0',_sqlone('compony','aid='.$arr['uid']));
	$img=array();
	if(!empty($arr['img1'])){
		$img[]=$arr['img1'];
	}
	if(!empty($arr['img2'])){
		$img[]=$arr['img2'];
	}
	if(!empty($arr['img3'])){
		$img[]=$arr['img3'];
	}
	if(!empty($arr['img4'])){
		$img[]=$arr['img4'];
	}
	_c('img',$img);
	_c('title',$arr['title']);
	_c('youjiao',array('','推荐','最新','热门'));
	_c('list',_sqlall('ware','uid='.$arr['uid'],'px,id desc',10));
	_tpl('/show');
}
?>