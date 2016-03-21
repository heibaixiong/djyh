<?php
if(!defined('PART'))exit;
function class_id($id){
	return _sqlone('class','id='.$id);
}
function class_id_name($id){
	$rs=_sqlone('class','id='.$id);
	return $rs['title'];
}
?>