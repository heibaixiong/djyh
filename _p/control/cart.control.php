<?php
if(!defined('PART'))exit;
$webid=_session('webid');
if(empty($webid)){
	_url(_u('/index/login/'));
}
function __index(){
	$webid=_session('webid');
	$arr=_sqlall('cart','uid='.$webid.' and (state=1 or state=0)');
	//$list=_sqlall('cart','uid='.$webid.' and (state=1 or state=0)');
	$mark=0;
	$num=0;
	foreach($arr as $k=>$v){
		$mark+=$v['mark']*$v['num'];
		$num+=$v['num'];
	}
	_c('arr',$arr);
	_c('mark',$mark);
	_c('num',$num);
	_c('title','购物车');
	_tpl();
}

function __checkout(){
	$webid=_session('webid');
	$arr=_sqlall('cart','uid='.$webid.' and (state=1 or state=0)');
	//$list=_sqlall('cart','uid='.$webid.' and (state=1 or state=0)');
	$mark=0;
	$num=0;
	foreach($arr as $k=>$v){
		$mark+=$v['mark']*$v['num'];
		$num+=$v['num'];
	}
	_c('arr',$arr);
	_c('mark',$mark);
	_c('num',$num);
	_c('title','确认订单');

	_c('address',_sqlone('caradd','uid='.$webid));

	_tpl();
}

function __submit(){
	$webid=_session('webid');
	$arr=_sqlall('cart','uid='.$webid.' and (state=1 or state=0)');
	//$list=_sqlall('cart','uid='.$webid.' and (state=1 or state=0)');

	if (empty($arr)) {
		_alerturl('购物车中没有商品！',_u('/cart/index/'));
	}

	$address = _sqlone('caradd','uid='.$webid);
	if (empty($address)) {
		_alerturl('请先设置收货地址！',_u('/person/address/'));
	}

	$mark=0;
	$num=0;
	foreach($arr as $k=>$v){
		$mark+=$v['mark']*$v['num'];
		$num+=$v['num'];
	}

	$order = array();
	$order['uid'] = $webid;
	$order['cates'] = count($arr);
	$order['quantity'] = $num;
	$order['total'] = $mark/100;
	$order['state'] = 2;
	$order['addtime'] = time();
	$order['uptime'] = time();

	$order['nam']=$address['nam'];
	$order['phn']=$address['phn'];
	$order['pro_n']=$address['pro_n'];
	$order['cit_n']=$address['cit_n'];
	$order['cou_n']=$address['cou_n'];
	$order['adr']=$address['adr'];
	$order['tel']=$address['tel'];

	$order['express'] = '东家物流';
	$order['expressprice'] = 0;
	$order['payment_code'] = 'cod';
	$order['payment'] = '货到付款';

	$order_id = _sqlinsert('order', $order);
	if ($order_id) {
		_sqldo('update '.PRE.'cart set orderid = '.$order_id.', state = 2, uptime='.time().' where uid='.$webid.' and (state=1 or state=0)');
	}

	_c('arr',$arr);
	_c('mark',$mark);
	_c('num',$num);
	_c('title','提交订单');

	_tpl();
}

function __add(){
	$json = array();
	$webid=_session('webid');
	$r=_sqlone('cart','uid='.$webid.' and wid='._v(3).' and (state=1 or state=0)');
	$rs=_sqlone('ware','id='._v(3));

	if ($rs) {
		if ($r) {
			if ($r['num'] + _v(4) > $rs['stock']) {
				$json['error'] = '库存不足！';
			} else {
				_sqldo('update '.PRE.'cart set num ='.intval($r['num'] + _v(4)).' where id = '.$r['id']);
			}
		} else {
			if (_v(4) > $rs['stock']) {
				$json['error'] = '库存不足！';
			} else {
				$data=array();
				$data['uid']=$webid;
				$data['wid']=_v(3);
				$data['wtitle']=$rs['title'];
				$data['number']=$rs['number'];
				$data['img']=$rs['img'];
				$data['price']=$rs['price'];
				$data['mark']=$rs['mark'];
				$data['num']=_v(4);
				$data['addtime']=time();
				_sqlinsert('cart',$data);
			}
		}
	}

	$json['msg'] = isset($json['error']) ? '加入购物车失败：'.$json['error'] : '加入购物车成功！';
	$json['total'] = _sqlnum('cart','uid='.$webid.' and (state=1 or state=0)');

	echo json_encode($json);
}
function __del(){
	$webid=_session('webid');
	$r=_sqlone('cart','uid='.$webid.' and id='._v(3).' and (state=1 or state=0)');
	if($r){
		$data=array();
		$data['state']=-1;
		$data['uptime']=time();
		_sqlupdate('cart',$data,'id='._v(3));
	}
	_url(_u('//index/'));
}
?>