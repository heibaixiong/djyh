<?php
if(!defined('PART'))exit;
function _vou($uid,$vou,$content,$addtime,$state=1,$uptime=null){
	$data=array();
	$data['uid']=$uid;
	$data['vou']=$vou;
	$data['content']=$content;
	$data['addtime']=$addtime;
	$data['state']=$state;
	$data['uptime']=$uptime?$uptime:0;
	if(1==$state){
		if($vou>0){
			_sqldo('update '._pre('user').' set vou=vou+'.$vou.' where id='.$uid);
		}else{
			_sqldo('update '._pre('user').' set vou=vou'.$vou.' where id='.$uid);
		}
	}
	_sqlinsert(_pre('voulogs'),$data);
}
?>