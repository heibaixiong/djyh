<?php
if(!defined('PART'))exit;
function __shoplist(){
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}
	$key=_post('key');
	$session_key=_session('key');
	if(!empty($key)){
		_session('key',$key);
	}
	if(empty($key)&&!empty($session_key)){
		$key=_session('key');
	}
	_c('key',$key);
	$sql='';
	if(!empty($key)){
		$sql.=' and (title like \'%'.$key.'%\' or number like \'%'.$key.'%\')';
	}
	Page::start('ware',$p,'type=0'.$sql,'id desc');
	_tpl('/list');
}
function __list_class(){
	$p=_v(3);
	$r=_v(4);
	if(empty($p)){
		$p=0;
	}
	if(empty($r)){
		$r=0;
	}
	_c('title',_sqlfield('class','title','id='.$p));
	Page::start('ware',$r,'(class1='.$p.' or class2='.$p.')','id desc');
	_tpl('/list4');
}
function __seckilllist(){
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}
	$key=_post('key');
	$session_key=_session('key');
	if(!empty($key)){
		_session('key',$key);
	}
	if(empty($key)&&!empty($session_key)){
		$key=_session('key');
	}
	_c('key',$key);
	$sql='';
	if(!empty($key)){
		$sql.=' and (title like \'%'.$key.'%\' or number like \'%'.$key.'%\')';
	}
	Page::start('adwaremin',$p,'type=1'.$sql,'id desc');
	_tpl('/list');
}
function __hiddenlist(){
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}
	$key=_post('key');
	$session_key=_session('key');
	if(!empty($key)){
		_session('key',$key);
	}
	if(empty($key)&&!empty($session_key)){
		$key=_session('key');
	}
	_c('key',$key);
	$sql='';
	if(!empty($key)){
		$sql.=' and (title like \'%'.$key.'%\' or number like \'%'.$key.'%\')';
	}
	Page::start('ware',$p,'state=1'.$sql,'id desc');
	_tpl('/list');
}
function __pricelist(){
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}
	$key=_post('key');
	$session_key=_session('key');
	if(!empty($key)){
		_session('key',$key);
	}
	if(empty($key)&&!empty($session_key)){
		$key=_session('key');
	}
	_c('key',$key);
	$sql='';
	if(!empty($key)){
		$sql.=' and (title like \'%'.$key.'%\' or number like \'%'.$key.'%\')';
	}
	Page::start('ware',$p,'mark+1<share+store+price+vou'.$sql,'id desc');
	_tpl('/list');
}
function __speciallist(){
	$arr=_sqlall('ware','class2name=class1name limit 100');
	foreach($arr as $k=>$v){
		$data=array();
		$data['class2name']=class_id_name($v['class2']);
		$data['class1name']=class_id_name($v['class1']);
		_sqlupdate('ware',$data,'id='.$v['id']);
	}
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}
	$key=_post('key');
	$session_key=_session('key');
	if(!empty($key)){
		_session('key',$key);
	}
	if(empty($key)&&!empty($session_key)){
		$key=_session('key');
	}
	_c('key',$key);
	$sql='';
	if(!empty($key)){
		$sql.=' and (title like \'%'.$key.'%\' or number like \'%'.$key.'%\')';
	}
	Page::start('ware',$p,'type=2'.$sql,'id desc','a');
	_tpl('/list');
}
function __noimglist(){
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}
	$key=_post('key');
	$session_key=_session('key');
	if(!empty($key)){
		_session('key',$key);
	}
	if(empty($key)&&!empty($session_key)){
		$key=_session('key');
	}
	_c('key',$key);
	Page::start('ware',$p,'img=\'\' or img is null','id desc');
	_tpl('/list');
}
function __stock(){
	$data=array();
	$data['stock']=0;
	_sqlupdate('ware',$data,'1=1');
	echo '计算完毕！请勿频繁计算！';
}
function __stocklist(){
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}
	$arr=_sqlall('ware','stock=0 limit 100');
	$data=array();
	foreach($arr as $k=>$v){		
		$data['stock']=_sqlfield('attri_info','sum(stock)','wid='.$v['id']);
		_sqlupdate('ware',$data,'id='.$v['id']);
	}
	$n=_sqlnum('ware','stock=0');
	if($n!=_session('n')){
		_session('n',$n);
		_url(_u('///'));
	}
	$key=_post('key');
	$session_key=_session('key');
	if(!empty($key)){
		_session('key',$key);
	}
	if(empty($key)&&!empty($session_key)){
		$key=_session('key');
	}
	_c('key',$key);
	Page::start('ware',$p,'stock=0','id desc');
	_tpl('/list');
}
function __pxstocklist(){
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}
	$key=_post('key');
	$session_key=_session('key');
	if(!empty($key)){
		_session('key',$key);
	}
	if(empty($key)&&!empty($session_key)){
		$key=_session('key');
	}
	$sql='';
	if(!empty($key)){
		$sql.=' and (title like \'%'.$key.'%\' or number like \'%'.$key.'%\')';
	}
	_c('key',$key);
	Page::start('ware',$p,'realsale>0','id desc');
	_tpl('/list');
}
function __add(){
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}else{
		$rs=_sqlone('class','id='.$p);
		_c('title',$rs['title']);
	}
	$title=_post('title');
	if(!empty($title)){
		$data=array();
		$data['uid']=_session('adminid');
		$data['uname']=_session('admincompony');
		$data['code']=_session('code');
		$data['title']=_post('title');
		$data['class2']=_post('class2');
		$data['class1']=_sqlfield('class','pid','id='._post('class2'));
	    $data['number']=_post('number');
	    $data['type']=_post('type');
	    $data['style']=_post('style');
	    $data['img']=_post('img');
	    $data['img1']=_post('img1');
	    $data['img2']=_post('img2');
	    $data['img3']=_post('img3');
	    $data['img4']=_post('img4');
	    $data['mark']=_post('mark')*100;
	    if(_session('adminrank')<3){
		    $data['share']=_post('share');
		    $data['store']=_post('store');
		    $data['vou']=_post('vou');
		    $data['postage']=_post('postage');
		    $data['price']=_post('price');
		    $data['sale']=_post('sale');
		    $data['stock']=_post('stock');
		    $data['recommend']=_post('recommend');
		    $data['new']=_post('new');
		    $data['hot']=_post('hot');
		    $data['state']=_post('state');
		    $data['state']=1;
		    $data['px']=_post('px');
		}
	    $data['content']=_post('mess');
	    $id=_sqlinsert('ware',$data);
	    $paraid=_post('paraid');
	    $para=_post('para');
	    for($i=0;$i<count($paraid);$i++){
	    	$data=array();
	    	$data['wid']=$id;
	    	$data['wname']=_post('title');
	    	$data['paraname']=$paraid[$i];
	    	$data['value']=$para[$i];
	    	_sqlinsert('para_info',$data);
	    }
	    $attri=_post('attri');
	    $attrivalues=_post('attrivalues');
	    for($i=0;$i<count($attri);$i++){
	    	if(empty($attrivalues[$i])||0==$attrivalues[$i])continue;
	    	$data=array();
	    	$data['wid']=$id;
	    	$data['wname']=_post('title');
	    	$data['model']=$attri[$i];
	    	$data['stock']=$attrivalues[$i];
	    	_sqlinsert('attri_info',$data);
	    }
	    _adminlogs('添加商品 '._post('title'));
	    _alerturl('成功添加商品！',_u('//list/'));
	}else{
		$rs=_sqlone('class','id='._v(3));
		$_['para']=array();
		$_['attri']=array();
		if(0!=$rs['para']){
			$_['para']=_sqlall('para','pid='.$rs['para'].' and state=0 order by px desc');
		}
		if(0!=$rs['attri']){
			$_['attri']=_sqlall('attri','pid='.$rs['attri'].' and state=0 order by px desc');
		}
		_c('para',$_['para']);
		_c('attri',$_['attri']);
		_tpl('/add');
	}	
}
function __edit(){
	$title=_post('title');
	if(!empty($title)){
		$data=array();
		$data['title']=_post('title');
	    $data['number']=_post('number');
	    $data['type']=_post('type');
	    $data['style']=_post('style');
	    $data['img']=_post('img');
	    $data['img1']=_post('img1');
	    $data['img2']=_post('img2');
	    $data['img3']=_post('img3');
	    $data['img4']=_post('img4');	    
	    $data['mark']=_post('mark');
	    if(_session('adminrank')<3){
	    	$data['price']=_post('price');
		    $data['share']=_post('share');
		    $data['store']=_post('store');
		    $data['vou']=_post('vou');
		    $data['postage']=_post('postage');
		    $data['mark']=_post('mark')*100;
		    $data['sale']=_post('sale');
		    $data['stock']=_post('stock');
		    $data['recommend']=_post('recommend');
		    $data['new']=_post('new');
		    $data['hot']=_post('hot');
		    $data['state']=_post('state');
		    $data['state']=1;
		    $data['px']=_post('px');
	    }
	    $data['content']=_post('mess');
	    _sqlupdate('ware',$data,'id='._post('id'));
	    $paraid=_post('paraid');
	    $para=_post('para');
	    for($i=0;$i<count($paraid);$i++){
	    	$data=array();
	    	$data['wid']=_post('id');
	    	$data['wname']=_post('title');
	    	$data['paraname']=$paraid[$i];
	    	$data['value']=$para[$i];
	    	$r=_sqlone('para_info','wid='._post('id').' and paraname="'.$paraid[$i].'"');
	    	if(empty($r)){
	    		_sqlinsert('para_info',$data);
	    	}else{
	    		_sqlupdate('para_info',$data,'wid='._post('id').' and paraname="'.$paraid[$i].'"');
	    	}
	    }
	    $attri=_post('attri');
	    $attrivalues=_post('attrivalues');
	    _sqldelete('attri_info','wid='._post('id'));
	    for($i=0;$i<count($attri);$i++){
	    	if(empty($attrivalues[$i])||0==$attrivalues[$i])continue;
	    	$data=array();
	    	$data['wid']=_post('id');
	    	$data['wname']=_post('title');
	    	$data['model']=$attri[$i];
	    	$data['stock']=$attrivalues[$i];
	    	_sqlinsert('attri_info',$data);
	    }
	    _adminlogs('编辑商品 '._post('title'));
	    _alertback2('成功编辑商品！');
	}else{
		$_['rs']=_sqlone('ware','id='._v(3));
		_c('rs',$_['rs']);
		$rs=_sqlone('class','id='.$_['rs']['class2']);
		_c('para',_sqlall('para','pid='.$rs['para'].' and state=0 order by px desc'));
		_c('attri',_sqlall('attri','pid='.$rs['attri'].' and state=0 order by px desc'));
		_c('rs_para',_sqlall('para_info','wid='.$_['rs']['id'].' order by id'));
		_c('rs_attri',_sqlall('attri_info','wid='.$_['rs']['id'].' order by id'));
		_tpl('/edit');
	}
}
function __state(){
	$id=_v(4);
	if(!empty($id)){
		$rs=_sqlone('ware','id='.$id);
		$state=$rs['state']==1?0:1;
		$state_str=$state==1?'隐藏':'开启';
		$data=array();
		$data['state']=$state;
		_sqlupdate('ware',$data,'id='.$id);
		_adminlogs('更改商品 '.$rs['title'].' 显示隐藏状态：'.$state_str);
		_alertback('成功更改商品 '.$rs['title'].' 显示隐藏状态：'.$state_str);
	}else{
		_tpl('/list');
	}
}
function __del(){
	$p=_v(3);
	if(empty($p)){
		$p=0;
	}
	$title=_sqlfield('ware','title','id='.$p);
	_adminlogs('删除商品 '.$p.'-'.$title);
	_sqldelete('ware','id='.$p);
	_alertback('成功删除商品 '.$title);
}
?>