<?php
if(!defined('PART'))exit;
$webid=_session('webid');
if(empty($webid)){
	//_url(_u('/index/auth/'));
	//die();
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
	global $_;
	global $_wrap;

	$webid = _session('webid');

	_c('total_all', _sqlnum('order', 'uid='.$webid));	//所有订单
	_c('total_1', _sqlnum('order', 'uid='.$webid.' and state=1'));	//等待付款
	_c('total_2', _sqlnum('order', 'uid='.$webid.' and state=2'));	//已付款
	_c('total_3', _sqlnum('order', 'uid='.$webid.' and state=3'));	//已发货
	_c('total_4', _sqlnum('order', 'uid='.$webid.' and state=4'));	//已完成
	_c('total_12', _sqlnum('order', 'uid='.$webid.' and state=12'));	//已关闭

	$p = _v(3);	//分页
	if(empty($p)){
		$p = 0;
	}

	$where = 'uid='.$webid;
	if (in_array(_v(4), array(1,2,3,4,12))) {		//订单状态
		$where .= ' and state = \''.intval(_v(4)).'\'';
	}

	Page::start('order', $p, $where, 'addtime desc, id desc', 10);
	//var_dump(Page::$arr);exit;
	foreach (Page::$arr as $k => $order) {
		/*
		 *第一步：获取订单下的购物车中所有商品
		 *第二部：获取每个产品的详情
		 *第三部：获取产品所属的公司信息
		*/
		$sql = "select og.*, c.id as company_id, c.compony as company, g.uid as seller_id, g.class1name from " . PRE . "cart as og left join " . PRE . "ware as g on og.wid = g.id left join " . PRE . "compony as c on g.uid = c.aid" .
			" where og.orderid = " . $order['id'] .
			" order by c.id, og.addtime, og.id" ;
		//var_dump($sql);exit;
		$order_goods = _sqlselect($sql);
		Page::$arr[$k]['goods'] = $order_goods;
		Page::$arr[$k]['status'] = $_['user_order_status'][$order['state']];
		if ($order['state'] == '2') {
			foreach (Page::$arr[$k]['goods'] as $goods) {
				if ($goods['state'] == '3') {
					Page::$arr[$k]['status'] = $_['user_order_status']['3'] . '(部分)';
					break;
				}
			}
		} elseif ($order['state'] == '1') {
			Page::$arr[$k]['payment_data'] = '';
			/*if (file_exists(APP_PATH.'function/'.$order['payment_code'].'.php')) {
				_fun($order['payment_code']);
				if (function_exists('_getPaymentForm')) {
					Page::$arr[$k]['payment_data'] = call_user_func('_getPaymentForm', $order['id']);
				}
			}*/
		}
	}
	//echo '<pre>';
	//print_r(Page::$arr);exit;
	_c('title','我的订单');
	_c('order_state', $_['user_order_status']);
	_c('payment_method', $_wrap['payment_method']);
	_tpl();
}

function __order_view(){
	global $_;
	$webid=_session('webid');
	$order = _sqlone('order', 'id='.intval(_v(3)).' and uid='.$webid);
	if (empty($order) || empty(_v(5))) {
		_alerturl('订单不存在！', _u('//order/'.intval(_v(4))));
	}

	//$order['goods'] = _sqlall('cart','orderid='.$order['id']);
	$order['status'] = $_['user_order_status'][$order['state']];

	$sql = "select og.*, c.id as company_id, c.compony as company, g.uid as seller_id from " . PRE . "cart as og left join " . PRE . "ware as g on og.wid = g.id left join " . PRE . "compony as c on g.uid = c.aid" .
		" where og.orderid = " . $order['id'] . " and g.uid = " . intval(_v(5)) .
		" order by c.id, og.addtime, og.id"
	;

	$order['goods'] = _sqlselect($sql);

	if (empty($order['goods'])) {
		_alerturl('订单不存在！', _u('//order/'.intval(_v(4))));
	}

	$order['status'] = $_['user_order_status'][$order['goods'][0]['state']];

	$order['payment_data'] = '';
	if ($order['state'] == '1' && !empty($order['payment_code'])) {
		if (file_exists(APP_PATH.'function/'.$order['payment_code'].'.php')) {
			_fun($order['payment_code']);
			if (function_exists('_getPaymentForm')) {
				$order['payment_data'] = call_user_func('_getPaymentForm', $order['id']);
			}
		}
	}

	_c('order', $order);
	_c('order_state', $_['user_order_status']);
	_c('page', intval(_v(4)));
	_c('title','订单详细');
	_tpl();
}

function __order_receipt() {
	global $_;
	$webid=_session('webid');
	$order = _sqlone('order', 'id='.intval(_v(3)).' and uid='.$webid);
	if (empty($order) || empty(_v(5))) {
		_alerturl('订单不存在！', _u('//order/'.intval(_v(4))));
	}

	//$order['goods'] = _sqlall('cart','orderid='.$order['id']);
	$order['status'] = $_['user_order_status'][$order['state']];

	$sql = "select og.*, c.id as company_id, c.compony as company, g.uid as seller_id from " . PRE . "cart as og left join " . PRE . "ware as g on og.wid = g.id left join " . PRE . "compony as c on g.uid = c.aid" .
		" where og.orderid = " . $order['id'] . " and g.uid = " . intval(_v(5)) .
		" order by c.id, og.addtime, og.id"
	;

	$order['goods'] = _sqlselect($sql);

	if (empty($order['goods'])) {
		_alerturl('订单不存在！', _u('//order/'.intval(_v(4))));
	}

	if ($order['state'] <> '3' || $order['goods'][0]['state'] <> '3') {
		_alerturl('订单当前状态不允许此操作！', _u('//order/'.intval(_v(4))));
	} else {
		$ids = array();
		foreach ($order['goods'] as $goods) {
			if ($goods['state'] <> '3') continue;
			$ids[] = $goods['id'];
		}

		if (_sqldo("update ".PRE."cart set state='4', receipt_time='".time()."' where id in ('".join("','", $ids)."')")) {
			//$shiped = _sqlnum('cart', "orderid='".$order['id']."' and state='4'");
			$shiped = count($ids) + $order['receipt_cates'];
			if ($shiped == $order['cates']) {
				_sqldo("update ".PRE."order set state='4', receipt_cates='".$shiped."', receipt_time='".time()."' where id='".$order['id']."'");
			} else {
				_sqldo("update ".PRE."order set receipt_cates='".$shiped."' where id='".$order['id']."'");
			}
			_weblogs('确认收货成功：'.$order['id'].' - '.intval(_v(5)).' - '.$webid);
			_alerturl('订单确认收货成功！', _u('//order/'.intval(_v(4))));
		} else {
			_alerturl('订单确认收货失败！', _u('//order/'.intval(_v(4))));
		}
	}

	_header( _u('//order/'.intval(_v(4))));
}

//微信支付部分 -- 公众号支付
function __order_pay(){
	global $_;
	global $_wrap;

	$webid=_session('webid');

	$order = _sqlone('order', 'state=1 and id='.intval(_v(3)).' and uid='.$webid);	//查询订单
	if (empty($order)) {
		_alerturl('订单不存在或状态不允许！', _u('//order/'._v(4).'/'));
	}

	$order['goods'] = _sqlall('cart','orderid='.$order['id']);	//查询订单中的商品列表
	$order['status'] = $_['user_order_status'][$order['state']];

	if (empty($order['goods'])) {
		_alerturl('订单不存在！', _u('//order/'._v(4).'/'));
	}

	//$order['status'] = $_['user_order_status'][$order['state']];

	$order['payment_data'] = '';
	if ($order['state'] == '1' && !is_null(_post('payment_method')) && array_key_exists(_post('payment_method'), $_wrap['payment_method'])) {
		if (file_exists(APP_PATH.'function/'.$_wrap['payment_method'][_post('payment_method')]['code'].'.php')) {
			_fun($_wrap['payment_method'][_post('payment_method')]['code']);
			if (function_exists('_getPaymentForm')) {
				$order['payment_data'] = call_user_func('_getPaymentForm', $order['id']);
			}
		} else {
			if ($_wrap['payment_method'][_post('payment_method')]['code'] == 'cod') {
				$data = array();
				$data['payment_code'] = $_wrap['payment_method'][_post('payment_method')]['code'];
				$data['payment'] = $_wrap['payment_method'][_post('payment_method')]['title'];
				$data['state'] = 2;
				$data['pay_time'] = time();
				if (_sqlupdate('order', $data, 'state=1 and id='.intval(_v(3)).' and uid='.$webid)) {
					_sqldo('update '.PRE.'cart set state = 2, uptime='.time().' where orderid='.intval(_v(3)).' and (state=1)');
					_alertclose('支付成功！');
				}
			}
		}
	}

	if (empty($order['payment_data'])) {
		_alerturl('支付方式异常，请选择其它支付方式或稍后再试！', _u('//order/'._v(4).'/'));
	} else {
		$data = array();
		$data['payment_code'] = $_wrap['payment_method'][_post('payment_method')]['code'];
		$data['payment'] = $_wrap['payment_method'][_post('payment_method')]['title'];
		$data['uptime'] = time();
		if (!_sqlupdate('order', $data, 'state=1 and id='.intval(_v(3)).' and uid='.$webid)) {
			_alerturl('支付方式更新异常，请稍后再试！', _u('//order/'._v(4).'/'));
		}
	}

	$order['payment'] = $_wrap['payment_method'][_post('payment_method')]['title'];
	$order['payment_code'] = $_wrap['payment_method'][_post('payment_method')]['code'];

	_c('order', $order);
	_c('order_state', $_['user_order_status']);
	_c('page', intval(_v(4)));
	_c('title','订单支付');
	_tpl();
}

function __order_close() {
	$webid=_session('webid');

	$order = _sqlone('order', 'state=1 and id='.intval(_v(3)).' and uid='.$webid);
	if (empty($order)) {
		_alerturl('订单不存在或状态不允许！', _u('//order/'._v(4).'/'));
	}

	if (_sqlupdate('order', array('state' => '12', 'uptime' => time()), 'state=1 and id='.intval(_v(3)).' and uid='.$webid)) {
		_sqlupdate('cart', array('state' => '12', 'uptime' => time()), 'state=1 and orderid='.intval(_v(3)));
		_weblogs('订单关闭成功：'.intval(_v(3)).' - '.$webid);
		_alerturl('订单关闭成功！', _u('//order/'._v(4).'/'));
	} else {
		_alerturl('订单关闭失败！请稍后再试！', _u('//order/'._v(4).'/'));
	}

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
			_alerturl('成功修改收货地址！',_u('//address/'));
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
			_alerturl('修改密码成功！',_u('//passedit/'));
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
			_alerturl('修改支付密码成功！',_u('//zhifupassedit/'));

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