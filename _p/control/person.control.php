<?php
if(!defined('PART'))exit;
$webid=_session('webid');
if(empty($webid)){
	_url(_u('/index/login/'));
}
function __index(){
	/*$webid=_session('webid');
	_c('rs',_sqlone('admin','id='.$webid));
	_c('address',_sqlone('caradd','uid='.$webid));
	_c('title','个人中心');
	_tpl();*/
	_header(_u('/person/account/'));
}

function __account() {
	$webid=_session('webid');
	_c('company', _sqlone('compony','aid='.$webid));
	_c('title', '基本信息');
	_tpl();
}

function __address(){
	$webid=_session('webid');
	_c('rs',_sqlone('admin','id='.$webid));
	_c('address',_sqlone('caradd','uid='.$webid));
	_c('title','收货地址');
	_tpl();
}

function __order(){
	global $_wrap;
	$webid=_session('webid');
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}

	Page::start('order', $p, 'uid='.$webid, 'addtime desc, id desc');

	//$orders = _sqlall('order','uid='.$webid);
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

	_c('title','我的订单');
	_c('order_state', $_wrap['order_state']);
	_tpl();
}

function __order_view(){
	global $_wrap;
	$webid=_session('webid');
	$order = _sqlone('order', 'id='.intval(_v(3)).' and uid='.$webid);
	if (empty($order)) {
		_alerturl('订单不存在！', _u('//order/'.intval(_v(4))));
	}

	$order['goods'] = _sqlall('cart','orderid='.$order['id']);
	$order['status'] = $_wrap['order_state'][$order['state']];

	if ($order['state'] == '2') {
		foreach ($order['goods'] as $goods) {
			if ($goods['state'] == '3') {
				$order['status'] = $_wrap['order_state']['3'] . '(部分)';
				break;
			}
		}
	}

	_c('order', $order);
	_c('order_state', $_wrap['order_state']);
	_c('page', intval(_v(4)));
	_c('title','订单详细');
	_tpl();
}

function __addressedit(){
	$nam=_post('nam');
	$webid=_session('webid');
	if(!empty($nam)){
		$data=array();
		$data['nam']=_post('nam');
		$data['phn']=_post('phn');
		$data['pro_n']=_post('pro_n');
		$data['cit_n']=_post('cit_n');
		$data['cou_n']=_post('cou_n');
		$data['adr']=_post('adr');
		$data['tel']=_post('tel');
		$addr=_sqlone('caradd','uid='.$webid);
		if(!empty($addr)){
			_sqlupdate('caradd',$data,'uid='.$webid);
			_weblogs('修改收货地址 '._post('nam'));
			_alerturl('成功修改收货地址！',_u('//index/'));
		}else{
			$data['uid']=$webid;
			_sqlinsert('caradd',$data);
		}		
	}
}
function __passedit(){
	$oldpass=_post('oldpass');
	$pass1=_post('pass1');
	$pass2=_post('pass2');
	if($pass1<>$pass2){
		_alerturl('输入的两次密码不一致，请重新输入！',_u('//passedit/'));
	}
	$webid=_session('webid');
	if(!empty($oldpass)){		
		$pass=_sqlfield('admin','pass','id='.$webid);
		if($pass<>_md5($oldpass)){
			_weblogs('修改密码失败，原密码错误！');
			_alerturl('修改密码失败，原密码错误！',_u('//passedit/'));
		}else{
			$data=array();
			$data['pass']=_md5(_post('pass1'));
			_sqlupdate('admin',$data,'id='.$webid);
			_weblogs('修改密码成功 '.$webid);
			_alerturl('修改密码成功！',_u('//index/'));
		}
	}else{
		_c('title','登录密码');
		_tpl();
	}
}
function __zhifupassedit(){
	$oldpass=_post('oldpass');
	$pass1=_post('pass1');
	$pass2=_post('pass2');
	if($pass1<>$pass2){
		_alerturl('输入的两次密码不一致，请重新输入！',_u('//zhifupassedit/'));
	}
	$webid=_session('webid');
	if(!empty($pass1)){
		$pass=_sqlfield('admin','zhifupass','id='.$webid);
		if($pass==_md5($oldpass) || $pass == ''){
			$data=array();
			$data['zhifupass']=_md5(_post('pass1'));
			_sqlupdate('admin',$data,'id='.$webid);
			_weblogs('修改支付密码成功 '.$webid);
			_alerturl('修改支付密码成功！',_u('//index/'));

		}else{
			_weblogs('修改支付密码失败，原密码错误');
			_alerturl('修改支付密码失败，原密码错误！',_u('//zhifupassedit/'));
		}
	}else{
		_c('title','支付密码');
		_tpl();
	}
}
?>