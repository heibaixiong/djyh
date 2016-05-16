<?php
if(!defined('PART'))exit;

//微信端首页面
function __index(){
	/*
	if(!_session('webid')){
		_url(_u('/index/login'));
	}
	*/

	//幻灯片
	if(_ftime('flash')>CACHETIME){
		_f('flash',_sqlall('ad','class=1 and state=0','px,id desc',5));
	}
	_c('flash',_f('flash'));

	if(_ftime('wx_index')>CACHETIME){
		$index['goods_hot']=_sqlall('ware','length(`img`)>3 and state=0 and hot=1', 'px,id desc', 5);	//热门
		$index['goods_rec']=_sqlall('ware','length(`img`)>3 and state=0 and recommend=1', 'px,id desc', 5);	//推荐
		_f('wx_index',$index);
	}
	_c('wx_index',_f('wx_index'));

	_c('notice',_sqlone('notice','1 order by px'));

	_tpl('index');
}

//广告链接跳转，统计广告点击次数
function __ads(){
	$id = intval(_v(3));
	$info = _sqlone('ad','id = '.$id);
	if($info){
		$sql = 'update `'. PRE . 'ad` set `hits` = `hits` + 1 where `id` = '.$id;	//点击次数+1
		_sqlselect($sql);
		if($info['url']){
			header('Location:'.$info['url']);
			exit;
		}
	}
}

function __login(){
	_tpl();
}

function __register(){
	$uid = _session('web_uid');
	$user = _sqlone('admin', 'rank in (3,4,5) and state > 0 and id='.intval($uid));
	if (empty($user)) {
		_header(_u('/index/login/'));
	}

	_c('user', $user);
	_c('company', _sqlone('compony', 'aid='.$user['id']));

	_tpl();
}