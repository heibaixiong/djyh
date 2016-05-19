<?php
if(!defined('PART'))exit;

if(!_session('weixin_openid') || !_session('webid')){
	_session('weixin_redirect_url', 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
	_header('http://'.$_SERVER['HTTP_HOST'] . '/callback/wxpay_openid/index.php');
	exit();
}


//商品列表页
function __index(){
	$cid = intval(_v(3));	//分类ID
	if(empty($cid)){
		$cid = 0;
	}
	$page = intval(_v(4));	//第几页
	if(empty($page)){
		$page = 1;
	}
	$paixu = intval(_v(5));	//排序方式
	if(empty($paixu)){
		$paixu = 0;
	}

	$keyword = '';
	if(_v(6) && trim(_v(6)) != ''){
		$keyword = urldecode(_v(6));
	}

	global $_;
	$_['good_list'] = get_good_list($cid, $page, $paixu, $keyword);

	//如果是AJAX提交，则返回JSON数据
	if(isAjax()){
		header('Content-Type:application/json; charset=utf-8');
		foreach ($_['good_list'] as $k => $item) {
			$_['good_list'][$k]['thumb_img'] = _resize($item['img'], 210, 210);
			$_['good_list'][$k]['url_show'] = _u('/shop/show/'.$item['id'].'/');
			$_['good_list'][$k]['short_desc'] = _left(strip_tags($item['content']), 0, 46);
			$_['good_list'][$k]['mark_price'] = _rmb($item['mark']/100);
		}
		exit(json_encode($_['good_list']));
	}

	_c('title', '商品列表');
	_c('ajax_url', _u('/shop/index'));

	_c('foot_nav', 2);	//脚部样式控制
	_tpl();
}

//商品详情页
function __show(){
	$p = floatval(_v(3));
	if(empty($p)){
		$p=0;
	}
	//获取商品详情
	$arr=_sqlone('ware','id='.$p.' and state=0');
	//var_dump($arr);exit;
	if (empty($arr)) _alertback('商品已下架或不存在！');
	//var_dump(_sqlone('compony','aid='.$arr['uid']));exit;
	_c('rs',$arr);
	_c('rs0',_sqlone('compony','aid='.$arr['uid']));

	_c('attr_info', _sqlall('attri_info', 'wid='.$arr['id'], 'id'));
	_c('para_info', _sqlall('para_info', 'wid='.$arr['id'], 'id'));

	/*
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
	*/

	_c('title',$arr['title']);
	_c('youjiao',array('', '推荐', '最新', '热门'));
	//该供货商的其他商品
	_c('list',_sqlall('ware', 'state=0 and uid='.$arr['uid'].' and id !='.$arr['id'], 'px,id desc', 6));

	_c('foot_nav', 2);	//脚部样式控制
	_tpl();
}

/*综合商品搜索
 * 1.$cid商品分类ID，cid = 0，则所有商品
 * 2.$page页数，默认第一页
 * 3.$paixu,排序方式：0ID降序；1销量升序;2销量降序;3价格升序;4价格降序；5时间升序;6时间降序
 * */
function get_good_list($cid = 0, $page = 1, $paixu = 0, $keyword = ''){
	//return $paixu;
	//条件整合
	$condition = 'state = 0';
	if(is_int($cid) && $cid > 0){
		$condition .= ' and ( class1 = '.$cid .' or class2 = ' . $cid . ')';
	}
	if($keyword != ''){
		$condition .= ' and title like "%' . $keyword . '%"';
	}
	//return $condition;

	//排序方式
	if(!is_int($paixu) || $paixu < 0){
		$paixu = 0;
	}
	$paixusql = '';
	if($paixu == 1 || $paixu == 2){
		$paixusql .= 'sale';
	}else if($paixu == 3 || $paixu == 4){
		$paixusql .= 'mark';
	}else if($paixu == 5 || $paixu == 6){
		$paixusql .= 'addtime';
	}else{
		$paixusql .= 'id';
	}
	if($paixusql != ''){
		if($paixu % 2 == 0){
			$paixusql .= ' desc';
		}else{
			$paixusql .= ' asc';
		}
	}
	//return $paixusql;

	Page::start('ware', $page, $condition, $paixusql, 10);
	//return Page::$pnum;
	//判断当前页与总页数
	if(Page::$pnum < $page){
		return '';
	}
	return Page::$arr;
}