<?php
if(!defined('PART'))exit;
function _chat($uid,$adminid,$adminname,$content,$ft=1){
	$data=array();
	$data['uid']=$uid;
	$data['adminid']=$adminid;
	$data['adminname']=$adminname;
	$data['content']=$content;
	$data['addtime']=time();
	$data['ft']=$ft;
	_sqlinsert('chat',$data);
}
?>