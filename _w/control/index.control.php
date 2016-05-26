<?php
if(!defined('PART'))exit;
if(!_session('weixin_openid') || !_session('webid')){
	_session('webid', '84');
	_session('weixin_openid', 'oivF8wVNcYmaPoOTbX11lgA1oqCo');
	//_session('weixin_redirect_url', 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
	//_header('http://'.$_SERVER['HTTP_HOST'] . '/callback/wxpay_openid/index.php');
	//exit();
}

//微信端首页面
function __index(){
	//幻灯片
	if(_ftime('flash')>CACHETIME){
		_f('flash',_sqlall('ad','class=1 and state=0','px,id desc',5));
	}
	_c('flash',_f('flash'));

/*	if(_ftime('wx_index')>CACHETIME){
		$index['goods_hot']=_sqlall('ware','length(`img`)>3 and state=0 and hot=1', 'px,id desc', 5);	//热门
		$index['goods_rec']=_sqlall('ware','length(`img`)>3 and state=0 and recommend=1', 'px,id desc', 5);	//推荐
		_f('wx_index',$index);
	}
	_c('wx_index',_f('wx_index'));*/

	if(_ftime('wx_index')>CACHETIME){
		$index=_sqlall('class','pid=0 and state=0 and `show`=1', 'px, id desc', 8);
		foreach($index as $k=>$v){
			//$index[$k]['ware']=_sqlall('ware','class1='.$v['id'].' and length(`img`)>3 and state=0', 'px,id desc', 10);
			$index[$k]['goods_hot']=_sqlall('ware','class1='.$v['id'].' and length(`img`)>3 and state=0 and hot=1', 'px,id desc', 5);
			$index[$k]['goods_rec']=_sqlall('ware','class1='.$v['id'].' and length(`img`)>3 and state=0 and recommend=1', 'px,id desc', 5);
		}
		_f('wx_index',$index);
	}
	_c('wx_index',_f('wx_index'));

	_c('notice',_sqlone('notice','1 order by px'));

	_c('foot_nav', 1);	//脚部样式控制

	_tpl('index');
}

//广告链接跳转，统计广告点击次数
function __ads(){
	$id = intval(_v(3));
	$info = _sqlone('ad','id = '.$id);
	if($info){
		$sql = 'update `'. PRE . 'ad` set `hits` = `hits` + 1 where `id` = '.$id;	//点击次数+1
		_sqldo($sql);
		if($info['url']){
			header('Location:'.$info['url']);
			exit;
		}
	}
}

//weixin login and register
function __auth(){
	//_session('weixin_openid', 'oivF8wVNcYmaPoOTbX11lgA1oqCo');
	$openId = _session('weixin_openid');
	if(!$openId || $openId == ''){
		exit;
	}
	$wx_user = _sqlone('admin_bind', 'openid=\'' . _escape($openId) . '\'');
	//var_dump($wx_user);exit;
	if (empty($wx_user)) {
		$data1 = array(
				'openid' => $openId,
				'from' => 'weixin',
				'add_time' => time()
		);
		//var_dump($data1);exit;
		$wx_id = _sqlinsert('admin_bind', $data1);  //insert bindinfo to admin_bind

		$data2 = array(
				'user' => 'w' . _random(8, 'num'),
				'rank' => '5',
				'regtime' => time(),
				'updatetime' => time(),
				'login' => '1',
				'state' => '0'
		);
		if($user_id = _sqlinsert('admin', $data2)) {  //insert userinfo to admin_bind
			_sqldo('update ' . _pre('admin_bind') . ' set user_id=' . $user_id . ' where id=' . $wx_id);  //update userinfo to admin_bind
			_session('webid', $user_id);
		}
	} else {
		//get table admin info
		$user = _sqlone('admin', 'id = '.$wx_user['user_id']);
		if(empty($user)){	//add user info to table of admin
			$data['user'] = 'w' . _random(8, 'num');
			$data['rank'] = '5';
			$data['regtime'] = time();
			$data['updatetime'] = time();
			$data['login'] = 1;
			$data['state'] = 0;
			if($user_id = _sqlinsert('admin', $data)) {  //insert userinfo to admin_bind
				_sqldo('update ' . _pre('admin_bind') . ' set user_id=' . $user_id . ' where id=' . $wx_user['id']);  //update userinfo to admin_bind
			}
		}else{
			_sqldo('update ' . _pre('admin') . ' set updatetime=' . time() . ', login = login + 1 where id=' . $user['id']);	//update userinfo(updatetime,login) to admin
			_session('webid', $wx_user['user_id']);
		}
	}
	if (_session('weixin_redirect_url')) {
		_header(_session('weixin_redirect_url'));
	} else {
		_header(_u('/index/index/'));
	}
}