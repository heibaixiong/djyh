<?php
if(!defined('PART'))exit;
function _sql($host,$dbuser,$dbpwd,$dbname){
	$conn=mysqli_connect($host,$dbuser,$dbpwd);
	mysqli_select_db($conn,$dbname);
	mysqli_query($conn,'set names utf8');
	return $conn;
}
function _pre($table){
	return PRE.$table;
}
function _sqldo($sql,$str=''){
	_logs($sql,'mysqli');
	if($str){
		_echo($sql);
	}
	global $_wrap;
	if(empty($_wrap['mysqli_conn'])){
		$_wrap['mysqli_conn']=_sql($_wrap['db']['host'],$_wrap['db']['user'],$_wrap['db']['pass'],$_wrap['db']['database']);
	}
	return mysqli_query($_wrap['mysqli_conn'],$sql);
}
function _sqlnum($table,$condition='1',$str=''){
	$q=_sqldo('select count(*) from '.PRE.$table.' where '.$condition,$str);
	if(!$q){
		$n=0;
	}else{
		$rs=mysqli_fetch_row($q);
		mysqli_free_result($q);
		$n=$rs[0];
	}
	return $n;
}
function _sqlselect($sql,$str=''){
	$q=_sqldo($sql,$str);
	$arr=array();
	if($q){
		while($rs=mysqli_fetch_assoc($q)){
			$arr[]=$rs;
			}
		mysqli_free_result($q);
	}
	return $arr;
}
function _sqlall($table,$condition='1',$order='',$limit='',$str=''){
	$sql='select * from '.PRE.$table.' where '.$condition;
	if(!empty($order)){
		$sql.=' order by '.$order;
	}
	if(!empty($limit)){
		$sql.=' limit '.$limit;
	}
	$q=_sqldo($sql,$str);
	$arr=array();
	if($q){
		while($rs=mysqli_fetch_assoc($q)){
			$arr[]=$rs;
			}
		mysqli_free_result($q);
	}	
	return $arr;
}
function _sqlone($table,$condition='1',$str=''){
	$q=_sqldo('select * from '.PRE.$table.' where '.$condition.' limit 1',$str);
	$rs=mysqli_fetch_assoc($q);
	mysqli_free_result($q);
	return $rs;
}
function _sqlfield($table,$field,$condition='1',$str=''){
	$q=_sqldo('select '.$field.' from '.PRE.$table.' where '.$condition.' limit 1',$str);
	$rs=mysqli_fetch_row($q);
	mysqli_free_result($q);
	return $rs[0];
}
function _sqlupdate($table,$data,$condition='',$str=''){
	global $_wrap;
	if(empty($table)||!is_array($data)||empty($condition)){
		return false;
	}
	$s='';
	foreach($data as $key=>$value){
		$s.=!empty($s)?(',`'.$key.'`=\''.$value.'\''):('`'.$key.'`=\''.$value.'\'');
	}
	_sqldo('update '.PRE.$table.' set '.$s.' where '.$condition,$str);
	$n=mysqli_affected_rows($_wrap['mysqli_conn']);
	return $n;
}
function _sqlinsert($table,$data,$str=''){
	global $_wrap;
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
	$n=mysqli_insert_id($_wrap['mysqli_conn']);
	return $n;
}
function _sqldelete($table,$condition='',$str=''){
	global $_wrap;
	if(empty($table)||empty($condition)){
		return false;
	}	
	_sqldo('delete from '.PRE.$table.' where '.$condition,$str);
	$n=mysqli_affected_rows($_wrap['mysqli_conn']);
	return $n;
}
function _sqladdone($table,$id,$field='hits',$str=''){
	global $_wrap;
	_sqldo('update '.PRE.$table.' set '.$field.'='.$field.'+1 where id='.$id,$str);
	$n=mysqli_affected_rows($_wrap['mysqli_conn']);
	return $n;
}
function _sqldelone($table,$id,$field='id',$str=''){
	global $_wrap;
	_sqldo('delete from '.PRE.$table.' where '.$field.'='.$id,$str);
	$n=mysqli_affected_rows($_wrap['mysqli_conn']);
	return $n;
}
class Page{
	public static $num;
	public static $pnum;
	public static $p;
	public static $pre;
	public static $next;
	public static $arr;
	public static function start($table,$page=1,$action='1',$index='id desc',$enum=16,$str=''){
		self::$num=_sqlnum($table,$action);
		self::$pnum=ceil(self::$num/$enum);
		if(!$page){
			self::$p=1;
		}else{
			self::$p=$page;
		}
		self::$pre=self::$p-1;
		self::$next=self::$p+1;
		if(self::$p<2){
			self::$p=1;
			self::$pre=1;
			self::$next=(self::$pnum==1)?1:2;
		}
		if(self::$p>self::$pnum-1){
			self::$p=self::$pnum;
			self::$pre=(self::$pnum==1)?1:(self::$pnum-1);
			self::$next=self::$pnum;
		}
		if(self::$p<2){
			self::$p=1;
		}
		self::$arr=_sqlselect('select * from '.PRE.$table.' where '.$action.' order by '.$index.' limit '.(self::$p-1)*$enum.','.$enum,$str);
	}

	public static function select($sql, $fields='*', $page=1, $enum=16, $str=''){
		$q = _sqldo('select count(*) from '.$sql);
		$rs=mysqli_fetch_row($q);
		mysqli_free_result($q);
		self::$num = $rs[0];
		self::$pnum=ceil(self::$num/$enum);
		if(!$page){
			self::$p=1;
		}else{
			self::$p=$page;
		}
		self::$pre=self::$p-1;
		self::$next=self::$p+1;
		if(self::$p<2){
			self::$p=1;
			self::$pre=1;
			self::$next=(self::$pnum==1)?1:2;
		}
		if(self::$p>self::$pnum-1){
			self::$p=self::$pnum;
			self::$pre=(self::$pnum==1)?1:(self::$pnum-1);
			self::$next=self::$pnum;
		}
		if(self::$p<2){
			self::$p=1;
		}
		self::$arr=_sqlselect('select ' . $fields . ' from ' . $sql . ' limit '.(self::$p-1)*$enum.','.$enum, $str);
	}
}
?>