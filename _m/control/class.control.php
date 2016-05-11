<?php
if(!defined('PART'))exit;
_power();
function __list(){
	$p=_v(3);
	$r=_v(4);
	if(empty($p)){
		$p=0;
	}
	if(empty($r)){
		$r=0;
	}
	if(empty($r)){
		$r=0;
		_c('title','一级分类');
	}else{
		$rs=_sqlone('class','id='.$r);
		_c('title',$rs['title']);
	}
	Page::start('class',$p,'pid='.$r,'px desc');
	_tpl('/list');
}
function __edit(){
	_power('0,1');
	$title=_post('title');
	if(!empty($title)){
		$data=array();
		$data['pid']=_post('pid');
	    $data['title']=_post('title');
		$data['img']=_post('img');
		$data['img_ad_1']=_post('img_ad_1');
		$data['url_ad_1']=_post('url_ad_1');
		$data['img_ad_2']=_post('img_ad_2');
		$data['url_ad_2']=_post('url_ad_2');
		$data['attri']=_post('attri');
	    $data['para']=_post('para');
	    $data['unit']=_post('unit');
		$data['show']=_post('show');
		$data['state']=_post('state');
	    $data['px']=_post('px');
	    _sqlupdate('class',$data,'id='._post('id'));
	    _adminlogs('编辑分类 '._post('title'));
	    _alerturl('成功编辑分类！',_u('//list//'.$data['pid']));
	}else{
		_c('rs',_sqlone('class','id='._v(3)));
		_c('attri',_sqlall('attri','pid=0 and state=0 order by px desc'));
		_c('para',_sqlall('para','pid=0 and state=0 order by px desc'));
		_c('unit',_sqlall('unit','state=0 order by px desc'));
		_tpl('/edit');
	}
}
function __add(){
	_power('0,1');
	$p=_v(3);
	if(empty($p)){
		$p=0;
		_c('title','一级分类');
	}else{
		$rs=_sqlone('class','id='.$p);
		_c('title',$rs['title']);
	}
	$title=_post('title');
	if(!empty($title)){
		$data=array();
		$data['pid']=_post('pid');
	    $data['title']=_post('title');
	    $data['img']=_post('img');
		$data['img_ad_1']=_post('img_ad_1');
		$data['url_ad_1']=_post('url_ad_1');
		$data['img_ad_2']=_post('img_ad_2');
		$data['url_ad_2']=_post('url_ad_2');
		$data['attri']=_post('attri');
	    $data['para']=_post('para');
	    $data['unit']=_post('unit');
		$data['show']=_post('show');
		$data['state']=_post('state');
	    $data['px']=_post('px');
	    _sqlinsert('class',$data);
	    _adminlogs('添加分类 '._post('title'));
	    _alerturl('成功添加分类！',_u('//list//'.$data['pid']));
	}else{
		_c('attri',_sqlall('attri','pid=0 and state=0 order by px desc'));
		_c('para',_sqlall('para','pid=0 and state=0 order by px desc'));
		_c('unit',_sqlall('unit','state=0 order by px desc'));
		_tpl('/add');
	}
}
function __del(){
	_power('0,1');
	$id=_v(3);
	if(!empty($id)){
		$rs=_sqlone('class','id='.$id);
		_adminlogs('删除分类 '.$rs['title']);
	    _sqldelete('class','id='.$id);
	    _alerturl('成功删除分类！',_u('//list/'.$rs['pid']));
	}else{
		_tpl('/list');
	}
}
function __state(){
	_power('0,1');
	$id=_v(4);
	if(!empty($id)){
		$rs=_sqlone('class','id='.$id);
		$state=$rs['state']==1?0:1;
		$state_str=$state==1?'隐藏':'开启';
		$data=array();
		$data['state']=$state;
		_sqlupdate('class',$data,'id='.$id);
		_adminlogs('更改分类 '.$rs['title'].' 显示隐藏状态：'.$state_str);
	    _alerturl('成功更改分类 '.$rs['title'].' 显示隐藏状态：'.$state_str,_u('//list/'.$rs['pid']));
	}else{
		_tpl('/list');
	}
}
function __up(){
	_power('0,1');
	$arr=_sqlall('class');
	foreach($arr as $k=>$v){
		$data=array();
		if(0==$v['pid']){
			$data['pname']='一级分类';
			$data['rank']=0;
		}else{
			$rs=_sqlone('class','id='.$v['pid']);
			$data['pname']=$rs['title'];
			$data['rank']=$rs['rank']+1;
		}
		_sqlupdate('class',$data,'id='.$v['id']);
	}
	_adminlogs('更新分类');
	class_pid();
	class_count();
	ware_attri();
	_alerturl('成功更新分类！',_u('//list/'));
	_tpl('/list');
}
function __brand(){
	_power('0,1');
	$brand=_post('brand');
	if(!empty($brand)){
		$data=array();
	    $data['brand']=_post('brand');
	    $data['price']=_post('price');
	    _sqlupdate('class',$data,'id='._post('id'));
	    _adminlogs('编辑分类下 品牌/价格区间 '._sqlfield('class','title','id='._post('id')));
	    _alerturl('成功编辑分类下 品牌/价格区间！',_u('//list/'));
	}else{
		_c('rs',_sqlone('class','id='._v(3)));
		_tpl('/brand');
	}	
}
?>