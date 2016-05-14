<?php
if(!defined('PART'))exit;
if(!_session('webid')){
	_url(_u('/index/login'));
	die();
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
	$px = intval(_v(5));
	if(empty($px)){
		$px=0;
	}
	$pxsql='';
	if($px==1){
		$pxsql='sale desc';
	}
	if($px==2){
		$pxsql='mark';
	}
	if($px==3){
		$pxsql='addtime desc';
	}
	$pxsql .= ',px,id desc';
	$pxsql = ltrim($pxsql, ',');

	global $_;
	if(0==$r){
		_c('title','所有商品');
		_c('cate_title','所有商品');
		_c('classtitle','所有分类');
		//_c('shopclass',_f('oneclass'));
		Page::start('ware',$p,'state=0',$pxsql);
	}else{
		$title = _sqlfield('class','title','id='.$r);
		_c('title', $title);
		_c('cate_title', $title);
		$pid=_sqlfield('class','pid','id='.$r);
		_c('p_id', $pid);
		if(0==$pid){
			//_c('shopclass', _sqlall('class','pid='.$r,'px'));
			_c('classtitle', $title);
			_c('cate_title', '全部');
		}else{
			//_c('shopclass', _sqlall('class','pid='.$pid,'px'));
			_c('classtitle', _sqlfield('class','title','id='.$pid));
		}
		Page::start('ware',$p,'(class1='.$r.' or class2='.$r.') and state=0',$pxsql);
	}	
	_tpl('/index_new');
}
function __search(){
    if(_post('key')){
    	_url(_u('///'.urlencode(_post('key')).'/'));
    }    
    $p = intval(_v(4));
	if(empty($p)){
		$p=0;
	}
	$px = intval(_v(5));
	if(empty($px)){
		$px=0;
	}
	$pxsql='';
	if($px==1){
		$pxsql='sale desc';
	}
	if($px==2){
		$pxsql='mark';
	}
	if($px==3){
		$pxsql='addtime desc';
	}
	$pxsql .= ',px,id desc';
	$pxsql = ltrim($pxsql, ',');

	$key=urldecode(_v(3));
	_c('title',$key);
	_c('cate_title',$key);
	_c('classtitle','搜索');
	//_c('shopclass',_f('oneclass'));
	_c('p_id', '');
	$sql='';
    if(!empty($key)){
        $sql.='state=0 and (title like \'%'._escape($key).'%\' or number like \'%'._escape($key).'%\')';
    }
	Page::start('ware',$p,$sql,$pxsql);
    _tpl('/index_new');
}
function __special(){
	$p = intval(_v(3));
	if(empty($p)){
		$p=0;
	}
	$px = intval(_v(5));
	if(empty($px)){
		$px=0;
	}
	$pxsql='';
	if($px==1){
		$pxsql='sale desc';
	}
	if($px==2){
		$pxsql='mark';
	}
	if($px==3){
		$pxsql='addtime desc';
	}
	$pxsql .= ',px,id desc';
	$pxsql = ltrim($pxsql, ',');

	_c('title','推荐商品');
	_c('cate_title','推荐商品');
	_c('classtitle','所有分类');
	_c('p_id', '');
	//_c('shopclass',_f('oneclass'));
	Page::start('ware',$p,'recommend=1 and state=0', $pxsql);
	_tpl('/index_new');
}
function __hot(){
	$p = intval(_v(3));
	if(empty($p)){
		$p=0;
	}
	$px = intval(_v(5));
	if(empty($px)){
		$px=0;
	}
	$pxsql='';
	if($px==1){
		$pxsql='sale desc';
	}
	if($px==2){
		$pxsql='mark';
	}
	if($px==3){
		$pxsql='addtime desc';
	}
	$pxsql .= ',px,id desc';
	$pxsql = ltrim($pxsql, ',');

	_c('title','热销商品');
	_c('cate_title','热销商品');
	_c('classtitle','所有分类');
	_c('p_id', '');
	//_c('shopclass',_f('oneclass'));
	Page::start('ware',$p,'hot=1 and state=0', $pxsql);
	_tpl('/index_new');
}
function __new(){
	$p = intval(_v(3));
	if(empty($p)){
		$p=0;
	}
	$px = intval(_v(5));
	if(empty($px)){
		$px=0;
	}
	$pxsql='';
	if($px==1){
		$pxsql='sale desc';
	}
	if($px==2){
		$pxsql='mark';
	}
	if($px==3){
		$pxsql='addtime desc';
	}
	$pxsql .= ',px,id desc';
	$pxsql = ltrim($pxsql, ',');

	_c('title','最新上架');
	_c('cate_title','最新上架');
	_c('classtitle','所有分类');
	_c('p_id', '');
	//_c('shopclass',_f('oneclass'));
	Page::start('ware',$p,'new=1 and state=0', $pxsql);
	_tpl('/index_new');
}
function __show(){
	$p = floatval(_v(3));
	if(empty($p)){
		$p=0;
	}

	$arr=_sqlone('ware','id='.$p.' and state=0');
	if (empty($arr)) _alertback('商品已下架或不存在！');

	_c('rs',$arr);
	_c('rs0',_sqlone('compony','aid='.$arr['uid']));

	_c('attr_info', _sqlall('attri_info', 'wid='.$arr['id'], 'id'));
	_c('para_info', _sqlall('para_info', 'wid='.$arr['id'], 'id'));

	$img=array();
	if(!empty($arr['img1']) && is_file(DIR.$arr['img1'])){
		$img[]=$arr['img1'];
	}
	if(!empty($arr['img2']) && is_file(DIR.$arr['img2'])){
		$img[]=$arr['img2'];
	}
	if(!empty($arr['img3']) && is_file(DIR.$arr['img3'])){
		$img[]=$arr['img3'];
	}
	if(!empty($arr['img4']) && is_file(DIR.$arr['img4'])){
		$img[]=$arr['img4'];
	}
	_c('img',$img);
	_c('title',$arr['title']);
	_c('youjiao',array('', '推荐', '最新', '热门'));
	_c('list',_sqlall('ware', 'state=0 and uid='.$arr['uid'].' and id !='.$arr['id'], 'px,id desc', 10));
	_tpl('/show_new');
}