<?php
if(!defined('PART'))exit;
if(_ftime('config')>CACHETIME){
	_f('config',_sqlone('config'));
}
_c('config',_f('config'));
//这里加上search
//
if(_ftime('oneclass')>CACHETIME){
	$all_class = array();
	$categories = _sqlall('class','pid=0 and state=0 order by px');
	foreach ($categories as $category) {
		$category['child'] = _sqlall('class','pid='.$category['id'].' and state=0 order by px');
		$all_class[$category['id']] = $category;
	}
	_f('oneclass', $all_class);
}
_c('oneclass', _f('oneclass'));

if(_ftime('duilian')>CACHETIME){
	_f('duilian',_sqlall('ad','postion="对联" and state=0 order by px limit 2'));
}
_c('duilian',_f('duilian'));

if(_ftime('indexad')>CACHETIME){
	$index_ad = array();
	$index_ad['index_top_1'] = _sqlall('ad', 'postion="index_top_1" and state=0 order by px limit 4');
	$index_ad['index_top_2'] = _sqlall('ad', 'postion="index_top_2" and state=0 order by px limit 2');
	_f('indexad', $index_ad);
}
_c('indexad', _f('indexad'));

if(_ftime('article')>CACHETIME){
	$article=_sqlall('articleclass','state=0 order by px');
	foreach($article as $k=>$v){
		$article[$k]['article']=_sqlall('article','classid='.$v['id'].' and state=0 order by px limit 8');
	}
	_f('article',$article);
}
_c('article',_f('article'));

if(_ftime('newsclass')>CACHETIME){
	_f('newsclass',_sqlall('newsclass','state=0 order by px'));
}
_c('newsclass',_f('newsclass'));

if(_ftime('goods_attributes')>CACHETIME){
	$attr_data = array();
	$attributes = _sqlall('attri', 'pid=0 and state=0 order by px desc');
	foreach ($attributes as $attribute) {
		$children = _sqlall('attri', 'pid='.$attribute['id'].' and state=0 order by px desc');
		$attribute['children'] = $children;
		$attr_data[$attribute['id']] = $attribute;
	}
	_f('goods_attributes', $attr_data);
}
_c('goods_attributes', _f('goods_attributes'));

if(_ftime('goods_params')>CACHETIME){
	$attr_data = array();
	$attributes = _sqlall('para', 'pid=0 and state=0 order by px desc');
	foreach ($attributes as $attribute) {
		$children = _sqlall('para', 'pid='.$attribute['id'].' and state=0 order by px desc');
		$attribute['children'] = $children;
		$attr_data[$attribute['id']] = $attribute;
	}
	_f('goods_params', $attr_data);
}
_c('goods_params', _f('goods_params'));

/*if(_ftime('cartnum')>CACHETIME){
	_f('cartnum',_sqlnum('cart','uid='._session('webid').' and state<2'));
}
_c('cartnum',_f('cartnum'));*/
_c('cartnum',_sqlnum('cart','uid='._session('webid').' and (state=0)'));

$member = _sqlone('admin','id='.intval(_session('webid')));
if (empty($member)) _session('webid', '');

global $_wrap;
if (array_key_exists($member['rank'], $_wrap['user_rank'])) {
	$member['rank_name'] = $_wrap['user_rank'][$member['rank']];
}
_c('member', $member);

_c('state',array('上架','下架'));
_c('status',array('开启','关闭'));
_c('user_order_status', array(
	'1' => '等待买家付款',
	'2' => '等待卖家发货',
	'3' => '卖家已发货',
	'4' => '交易成功',
	'5' => '申请退款',
	'6' => '申请退货',
	'7' => '已退款',
	'11' => '已退货退货',
	'12' => '订单已关闭',
));
_c('seller_order_status', array(
	'1' => '等待买家付款',
	'2' => '买家已付款',
	'3' => '卖家已发货',
	'4' => '交易成功',
	'5' => '申请退款',
	'6' => '申请退货',
	'7' => '已退款',
	'11' => '已退货退货',
	'12' => '订单已关闭',
));
?>