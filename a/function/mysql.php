<?php
if(!defined('PART'))exit;
function _sql($host,$dbuser,$dbpwd,$dbname){
	$conn=mysql_connect($host,$dbuser,$dbpwd);
	mysql_select_db($dbname,$conn);
	mysql_query('set names utf8');
	return $conn;
}
function _pre($table){
	return PRE.$table;
}
function _sqldo($sql,$str=''){
	_logs($sql,'mysql');
	if($str){
		_echo($sql);
	}
	global $_wrap;
	if(empty($_wrap['mysql_conn'])){
		$_wrap['mysql_conn']=_sql($_wrap['db']['host'],$_wrap['db']['user'],$_wrap['db']['pass'],$_wrap['db']['database']);
	}
	return mysql_query($sql);
}
function _sqlnum($table,$condition='1',$str=''){
	$q=_sqldo('select count(*) from '.PRE.$table.' where '.$condition,$str);
	if(!$q){
		$n=0;
	}else{
		$rs=mysql_fetch_row($q);
		$n=$rs[0];
	}
	return $n;
}
function _sqlselect($sql,$str=''){
	$q=_sqldo($sql,$str);
	$arr=array();
	if($q){
		while($rs=mysql_fetch_assoc($q)){
			$arr[]=$rs;
			}
	}
	return $arr;
}
function _sqlall($table,$condition='1',$order,$limit,$str=''){
	$sql='select * from '.PRE.$table.' where '.$condition;
	if(!empty($order)){
		$sql.='order by '.$order;
	}
	if(!empty($limit)){
		$sql.='limit '.$limit;
	}
	$q=_sqldo($sql,$str);
	$arr=array();
	if($q){
		while($rs=mysql_fetch_assoc($q)){
			$arr[]=$rs;
			}
	}
	return $arr;
}
function _sqlone($table,$condition='1',$str=''){
	$q=_sqldo('select * from '.PRE.$table.' where '.$condition.' limit 1',$str);
	$rs=mysql_fetch_assoc($q);
	return $rs;
}
function _sqlfield($table,$field,$condition='1',$str=''){
	$q=_sqldo('select '.$field.' from '.PRE.$table.' where '.$condition.' limit 1',$str);
	$rs=mysql_fetch_row($q);
	return $rs[0];
}
function _sqlupdate($table,$data,$condition,$str=''){
	if(empty($table)||!is_array($data)||empty($condition)){
		return false;
	}
	$s='';
	foreach($data as $key=>$value){
		$s.=!empty($s)?(',`'.$key.'`=\''.$value.'\''):('`'.$key.'`=\''.$value.'\'');
	}
	_sqldo('update '.PRE.$table.' set '.$s.' where '.$condition,$str);
	return mysql_affected_rows();
}
function _sqlinsert($table,$data,$str=''){
	if(empty($table)||!is_array($data)){
		return false;
	}
	$str1='';
	$str2='';
	foreach($data as $key=>$value){
		$str1.=!empty($str1)?(',`'.$key.'`'):'`'.$key.'`';
		$str2.=!empty($str2)?(',\''.$value.'\''):('\''.$value.'\'');
	}
	_sqldo('insert into '.PRE.$table.'('.$str1.')values('.$str2.')',$str);
	global $_wrap;
	$n=mysql_insert_id($_wrap['mysqli_conn']);
	return $n;
}
function _sqldelete($table,$condition='',$str=''){
	if(empty($table)||empty($condition)){
		return false;
	}	
	_sqldo('delete from '.$table.' where '.$condition,$str);
	return mysql_affected_rows();
}
function _sqladdone($table,$id,$field='hits',$str=''){
	_sqldo('update '.PRE.$table.' set '.$field.'='.$field.'+1 where id='.$id,$str);
	return mysql_affected_rows();
}
function _sqldelone($table,$id,$field='id',$str=''){
	_sqldo('delete from '.PRE.$table.' where '.$field.'='.$id,$str);
	return mysql_affected_rows();
}
function _page($table,$page,$index='id desc',$enum=16,$action='1'){
	global $_wrap;
	$_wrap['page']['num']=_sqlnum('select * from '.PRE.$table.' where '.$action);
	$_wrap['page']['pnum']=ceil($_wrap['page']['num']/$enum);
	if(!$page){
		$_wrap['page']['p']=1;
	}
	else{
		$_wrap['page']['p']=$page;
	}
	$_wrap['page']['pre']=$_wrap['page']['p']-1;
	$_wrap['page']['next']=$_wrap['page']['p']+1;
	if($_wrap['page']['p']<=1){
		$_wrap['page']['p']=1;
		$_wrap['page']['pre']=1;
		$_wrap['page']['next']=($_wrap['page']['pnum']==1)?1:2;
	}
	if($_wrap['page']['p']>=$_wrap['page']['pnum']){
		$_wrap['page']['p']=$_wrap['page']['pnum'];
		$_wrap['page']['pre']=($_wrap['page']['pnum']==1)?1:($_wrap['page']['pnum']-1);
		$_wrap['page']['next']=$_wrap['page']['pnum'];
	}
	return _sqlselect('select * from '.PRE.$table.' where '.$action.' order by '.$index.' limit '.($_wrap['page']['p']-1)*$enum.','.$enum);
}
?>