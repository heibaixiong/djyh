<?php
if(!defined('PART'))exit;
function _jq_qr(){
	echo '<script src="http://apps.bdimg.com/libs/jquery-qrcode/1.0.0/jquery.qrcode.min.js" type="text/javascript"></script>'."\n";
}
function _js_my97(){
	echo '<script language="javascript" type="text/javascript" src="'._w('path').'My97DatePicker/WdatePicker.js"></script>'."\n";
}
function _alert($str){
	echo '<script>alert(\''.$str.'\');</script>';
	exit;
}
function _alertback($str){
	echo '<script>alert(\''.$str.'\');history.go(-1);</script>';
	exit;
}
function _alertback2($str){
	echo '<script>alert(\''.$str.'\');history.go(-2);</script>';
	exit;
}
function _back(){
	echo '<script>history.go(-1);</script>';
	exit;
}
function _alerturl($str,$url,$parent=false){
	if(_isiphone()){
		_header($url);
	}else{
		if($parent){
			echo '<script>alert(\''.$str.'\');parent.location=\''.$url.'\';</script>';
		}else{
			echo '<script>alert(\''.$str.'\');location=\''.$url.'\';</script>';
		}
	}
	exit;
}
function _url($url,$parent=false){
	if(_isiphone()){
		_header($url);
	}else{
		if($parent){
			echo '<script>parent.location=\''.$url.'\';</script>';
		}else{
			echo '<script>location=\''.$url.'\';</script>';
		}
	}
	exit;
}
function _chklen($str,$len,$alert){
	if(!isset($str{$len-1})){
		_alertback($alert.' 长度不够 '.$len.' 位，请重新输入');
	}
}
function _chknum($str,$alert){
	if(!is_numeric($str)){
		_alertback($alert.' 必须为数字，请重新输入');
	}
}
?>