<?php
if(!defined('PART'))exit;
$webid=_session('webid');
if(empty($webid)){
	_session('weixin_redirect_url', 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
	_header('http://'.$_SERVER['HTTP_HOST'] . '/callback/wxpay_openid/index.php');
	exit();
}
//购物车商品列表
function __index(){
	$webid=_session('webid');
	/*查询说明
	 * 1.获取购物车中所有商品
	 * 2.获取商品详情
	 * 3.获取公司详情
	 * */
	$sql = "select og.*, c.id as company_id, c.compony as company, g.uid as seller_id, g.class1name from " . PRE . "cart as og left join " . PRE . "ware as g on og.wid = g.id left join " . PRE . "compony as c on g.uid = c.aid" .
		" where og.uid = " . $webid . " and og.state = 0 and g.state = 0" .
		" order by c.id, og.addtime, og.id"
	;

	$goods = _sqlselect($sql);
	//var_dump($goods);exit;
	$mark=0;
	$num=0;
	//计算商品总价
	foreach($goods as $k => $v){
		$mark+=$v['mark']*$v['num'];
		$num+=$v['num'];
	}
	_c('arr', $goods);
	_c('mark', $mark);
	_c('num', $num);
	_c('title', '购物车');

	_c('foot_nav', 3);	//脚部样式控制
	_tpl();
}

//结算
function __checkout(){
	$webid=intval(_session('webid'));

	$tmp = explode(',', _v(3));
	$cids = '';
	foreach($tmp as $k){
		if(intval($k) > 0){
			$cids .= $k . ',';
		}
	}
	_session('cart_jiesuan', $cids);
	$sql = "select og.*, c.id as company_id, c.compony as company, g.uid as seller_id from " . PRE . "cart as og left join " . PRE . "ware as g on og.wid = g.id left join " . PRE . "compony as c on g.uid = c.aid" .
		" where og.uid = " . $webid . " and og.state = 0 and og.id in (" . trim($cids, ',') . ") and g.state = 0" .
		" order by c.id, og.addtime, og.id"
	;

	$goods = _sqlselect($sql);
	if(empty($goods)){
		_alerturl('没有选择要结算的商品！',_u('/cart/index/'));
	}
//var_dump($goods);exit;
	$mark=0;
	$num=0;
	foreach($goods as $k=>$v){
		$mark+=$v['mark']*$v['num'];
		$num+=$v['num'];
	}

	_c('arr', $goods);
	_c('mark', $mark);
	_c('num', $num);
	_c('title', '确认订单');
	//var_dump(_sqlone('caradd','uid='.$webid));exit;
	_c('address', _sqlone('caradd','uid='.$webid));

	_c('foot_nav', 3);	//脚部样式控制
	_tpl();
}

//commit orders and pay
function __submit(){
	global $_wrap;

	$webid=_session('webid');
	$cids = trim(_session('cart_jiesuan'), ',');

	if(!isset($cids) || $cids == ''){
		//_alerturl('没有选择要结算的商品！',_u('/cart/index/'));
		echo 1;
		exit;
	}
	$arr=_sqlall('cart','uid='.$webid.' and (state=0) and id in ('.$cids.')');

	if (empty($arr)) {
		//_alerturl('没有选择要结算的商品！',_u('/cart/index/'));
		echo 1;
		exit;
	}

	$address = _sqlone('caradd','uid='.$webid);
	if (empty($address)) {
		//_alerturl('请先设置收货地址！',_u('/person/address/'));
		echo 2;
		exit;
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
	//$order['state'] = 2;
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

	$order['payment_code'] = 'wxpay';
	$order['payment'] = '微信';
	$order['state'] = 1;

	$order_id = _sqlinsert('order', $order);	//insert record to orders
	if ($order_id) {
		$content = _post('content');
		_sqldo('update '.PRE.'cart set orderid = '.$order_id.', state = '.$order['state'].', uptime = '.time().', content = "'.$content.'" where uid='.$webid.' and (state=0) and id in('.$cids.')');
		if ($order['state'] == 1) {
			_c('payment_data', '');
			if (file_exists(APP_PATH.'function/'.$order['payment_code'].'.php')) {
				_fun($order['payment_code']);
				if (function_exists('_getPaymentForm')) {
					$payment_data = call_user_func('_getPaymentForm', $order_id);
					echo $payment_data;
					exit;
				}
			}
		}
	} else {
		//_alerturl('订单提交失败！', _u('/cart/index/'));
	}
	echo 3;
	exit;
}

function __success() {
	_c('title', '支付成功');

	_tpl();
}

function __qrcode() {
	_c('title', '微信扫码支付');
	_c('code_url', _session('wx_code_url'));

	_tpl();
}

function __add(){
	$json = array();
	$webid=_session('webid');
	$rc=_sqlall('cart','uid='.$webid.' and wid='.floatval(_v(3)).' and (state=0)');	//获取购物车中此商品所有列表
	$rs=_sqlone('ware','id='.floatval(_v(3)).' and state=0');	//获取商品详情
	$r = array();

	if ($rs) {
		$attr_info = _sqlall('attri_info', 'wid='.$rs['id'], 'wname,id');	//获取商品属性
		$real_select = array();

		if ($attr_info) {
			$attr_select = explode(',', _v(5));	//用户选择的属性ID
			$attr_types = 0;
			$group = '';

			foreach ($attr_info as $attr) {
				if ($attr['wname'] <> $group) {
					$attr_types++;
					$group = $attr['wname'];
				}
				foreach ($attr_select as $value) {
					if ($value == $attr['id']) {
						$real_select[$attr['wname']] = array(
							'id' => $attr['id'],
							'name' => $attr['wname'],
							'value' => $attr['model']
						);
						break;
					}
				}
			}

			if (empty($real_select)) {
				$json['error'] = '请先选择商品属性！';
				$json['redirect'] = _u('/shop/show/'.floatval(_v(3)).'/');
			} elseif (count($real_select) <> $attr_types) {
				$json['error'] = '请选择完整商品属性！';
				$json['redirect'] = _u('/shop/show/'.floatval(_v(3)).'/');
			} else {
				if ($rc) {
					foreach ($rc as $cart) {
						$options = unserialize($cart['model']);
						if ($options && is_array($options) && count($options) == $attr_types) {	//如果添加的商品属性与购物车中某一个有相同的属性数量
							$check = true;
							foreach ($options as $option) {
								$ex = false;
								foreach ($real_select as $select) {
									if ($option['id'] == $select['id']) {
										$ex = true;
										break;
									}
								}
								if ($ex == false) {
									$check = false;
									break;
								}
							}
							if ($check) {
								$r = $cart;
							}
						} else {
							_sqldelete('cart', 'state=0 and id='.$cart['id']);
						}
					}
				}
			}
		} elseif ($rc) {
			foreach ($rc as $cart) {
				if ($r) {
					_sqldelete('cart', 'state=0 and id='.$cart['id']);	//删除购物车中此种商品多余的商品
				} else {
					$r = $cart;
					_sqldo('update '.PRE.'cart set model = \'\' where state=0 and id = '.$r['id']);	//更新购物车中产品属性信息
				}
			}
		}

		if (empty($json)) {
			if ($r) {
				if ($r['num'] + _v(4) > $rs['stock']) {
					$json['error'] = '库存不足！';
				} else {
					_sqldo('update '.PRE.'cart set num ='.intval($r['num'] + _v(4)).' where state=0 and id = '.$r['id']);
				}
			} else {
				if (_v(4) > $rs['stock']) {
					$json['error'] = '库存不足！';
				} else {
					$data=array();
					$data['uid']=$webid;
					$data['wid']=_v(3);
					$data['wtitle']=$rs['title'];
					$data['model'] = serialize($real_select);
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

	} else {
		$json['error'] = '商品已下架或不存在！';
	}

	$json['msg'] = isset($json['error']) ? '加入购物车失败：'.$json['error'] : '加入购物车成功！';
	$json['total'] = _sqlnum('cart','uid='.$webid.' and (state=0)');

	echo json_encode($json);
}
function __del(){
	$webid=_session('webid');
	_sqldelete('cart', 'uid='.$webid.' and id='._v(3).' and (state=0)');
	_url(_u('//index/'));

	/*$r=_sqlone('cart','uid='.$webid.' and id='._v(3).' and (state=0)');
	if($r){
		$data=array();
		$data['state']=-1;
		$data['uptime']=time();
		_sqlupdate('cart',$data,'id='._v(3));
	}
	_url(_u('//index/'));*/
}

//edit cart
function __edit(){
	$id = _post('cid');	//cart id
	$uid = _session('webid');

	$r = _sqlone('cart','uid=' . $uid . ' and id=' . $id . ' and (state=0)');
	//echo json_encode($id);exit;
	$data = array();
	if(!$r){
		$data = array('errCode' => 1, 'errMsg' => '购物车中不存在此商品');
	}else{
		$type = _post('type');

		if($type == 1){	//add one to cart
			if(_sqldo('update '.PRE.'cart set num = num + 1, uptime = '. time() .' where id = '.$id)){
				$data = array('errCode' => 0, 'errMsg' => '修改成功');
			}else{
				$data = array('errCode' => -1, 'errMsg' => '修改失败');
			}
		}else{	//reduce one to cart
			if($r['num'] == 1){		//delete from cart
				if(_sqldelete('cart', 'id='. $id )){
					$data = array('errCode' => 2, 'errMsg' => '修改成功');
				}else{
					$data = array('errCode' => -1, 'errMsg' => '修改失败');
				}
			}else{
				if(_sqldo('update '.PRE.'cart set num = num - 1 and uptime = '.time().' where id = '.$id)){
					$data = array('errCode' => 0, 'errMsg' => '修改成功');
				}else{
					$data = array('errCode' => -1, 'errMsg' => '修改失败');
				}
			}
		}
	}
	header('Content-Type:application/json; charset=utf-8');
	echo json_encode($data);
}
?>