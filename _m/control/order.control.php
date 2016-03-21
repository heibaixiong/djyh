<?php
if(!defined('PART'))exit;

function __list(){
	global $_wrap;
	$p=_v(3);
	$r=_v(4);
	if(empty($p)){
		$p=0;
	}
	if(empty($r)){
		$r=0;
	}
	$key=_post('key');
	$session_key=_session('key');
	if(!empty($key)){
		_session('key',$key);
	}
	if(empty($key)&&!empty($session_key)){
		$key=_session('key');
	}
	$_['key']=$key;
	$sql='';
	if(!empty($key)){
		$sql.=' and (wtitle like \'%'.$key.'%\' or number like \'%'.$key.'%\' or nam like \'%'.$key.'%\')';
	}
	Page::start('order',$p,'state='.$p.$sql,'uptime desc');

	foreach (Page::$arr as $k => $order) {
		Page::$arr[$k]['goods'] = _sqlall('cart', 'orderid='.$order['id'], 'addtime, id');
		Page::$arr[$k]['status'] = $_wrap['order_state'][$order['state']];
		if ($order['state'] == '2') {
			foreach (Page::$arr[$k]['goods'] as $goods) {
				if ($goods['state'] == '3') {
					Page::$arr[$k]['status'] = $_wrap['order_state']['3'] . '(部分)';
					break;
				}
			}
		}
	}

	_c('title',$_wrap['order_state'][$p]);
	_c('order_state', $_wrap['order_state']);
	$url=array('','','edit','show','show','show','show','show','show','show','show','show','show');
	_c('do',$url[$p]);
	_tpl('/list');
}
function __edit(){
	$express=_post('express');
	if(!empty($express)){
		$data=array();
		$data['expressid']=_post('expressid');
		$data['expressprice']=_post('expressprice');
		$data['express']=_post('express');
		$data['state']=3;
		_sqlupdate('cart',$data,'id='._post('id'));
		_fun('sms');
		$a=_sqlfield('express','title','id='._post('expressid'));
		$text='【东家要货】亲，您的宝贝已经发出，'.$a.'：'._post('express').'，请注意查收！Q3327641679';
		_sms_send(_post('phn'),$text);
		$uid=_sqlfield('cart','uid','id='._post('id'));
		_chat($uid,_session('adminid'),'发货通知','亲，您的宝贝已经发出，'.$a.'：'._post('express').'，请注意查收！');
		_adminlogs('成功发货 '._post('express'));
		_alerturl('成功发货！',$_wrap['ctrl_url'].$_vew[1].'/list/2');
	}else{
		$_['rs']=_sqlone('order','id='._v(3));
		$_['express']=_sqlall('express','state=0 order by px desc');
		_tpl('/edit');
	}
}
function __content(){
	$content=_post('content');
	if(!empty($content)){
		$data=array();
		$data['content']=_post('content');
		$data['state']=7;
		_sqlupdate('cart',$data,'id='._post('id'));
		_fun('sms');
		$text='【东家要货】亲，您的退款申请已通过，请注意账户变动！Q3327641679';
		_sms_send(_post('phn'),$text);
		$uid=_sqlfield('cart','uid','id='._post('id'));
		_chat($uid,_session('adminid'),'退款通知','亲，您的退款申请已通过，请注意账户变动！');
		_adminlogs('ID:'._post('id').' 退款成功 ');
		_alerturl('成功退款！',$_wrap['ctrl_url'].$_vew[1].'/list/1');
	}else{
		$_['rs']=_sqlone('cart','id='.$_vew[3]);
		$_['express']=_sqlall('express','state=0 order by px desc');
		_tpl('/content');
	}
}
function __show(){
	global $_wrap;

	$order =  _sqlone('order','id='._v(3));
	$order['goods'] = _sqlall('cart','orderid='._v(3));

	$order['status'] = $_wrap['order_state'][$order['state']];
	if ($order['state'] == '2') {
		foreach ($order['goods'] as $goods) {
			if ($goods['state'] == '3') {
				$order['status'] = $_wrap['order_state']['3'] . '(部分)';
				break;
			}
		}
	}

	_c('order_state', $_wrap['order_state']);
	_c('order', $order);

	_tpl('/show');
}
function __no(){
	$rs=_sqlone('cart','id='._v(3));
	_sqldo('update '._pre('cart').' set state=7 where id='._v(3));
	_adminlogs('成功退款 '._v(3));
	_alerturl('成功退款！',_wrap['ctrl_url']._v(1).'/list/1/');
}
?>