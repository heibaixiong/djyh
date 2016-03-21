<?php
if(!defined('PART'))exit;
// if(empty($_wrap['sms'])){
// 	_echo('没有设置短信账号');
// }
function _sms_send($phone,$content){
	global $_wrap;
	$back=_curlget('http://api.smsbao.com/sms?u='.$_wrap['sms']['user'].'&p='.md5($_wrap['sms']['pass']).'&m='.$phone.'&c='.urlencode($content));
	if(0==$back){
		return true;
	}else{
		return false;
	}
}
function _sms_remain(){
	global $_wrap;
	$back=_curlget('http://www.smsbao.com/query?u='.$_wrap['sms']['user'].'&p='.md5($_wrap['sms']['pass']));
	$back=explode("\n",$back);
	if(0==$back[0]){
		$r=explode(",",$back[1]);
		return $r[1];
	}else{
		$arr=array('30'=>'密码错误','40'=>'账号不存在','41'=>'余额不足','42'=>'帐号过期','43'=>'IP地址限制','50'=>'内容含有敏感词','51'=>'手机号码不正确');
		return $arr[$back[0]];
	}
}
?>