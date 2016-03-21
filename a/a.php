<?php
if(!defined('PART'))exit;
session_start();
date_default_timezone_set('PRC');
header("Content-type: text/html; charset=utf-8");
include_once(APP_PATH.'config/wrap.php');
define('V0',_v(0));
define('V1',_v(1));
define('V2',_v(2));
$project=explode(',',PROJECT);
if(!in_array(V0,$project)){
	if(file_exists(APP_PATH.'function/'.V0.'.php')){
		include_once(APP_PATH.'function/'.V0.'.php');
	}else{
		echo '项目或者程序不存在！';
	}
}else{
	if(!ERR){
		error_reporting(NULL);
		ini_set('display_errors','Off');
	}
	if(file_exists('lock')&&AUTO_LOAD){
		include_once(PROJECT_PRE.'config/setting.config.php');
		include_once(PROJECT_PRE.'function/setting.config.php');
		include_once(PROJECT_PRE.V0.'/config/setting.config.php');
		include_once(PROJECT_PRE.V0.'/function/setting.config.php');
	}
	if(AUTO_CREATFILE&&!file_exists(PROJECT_PRE.V0.'/control/'.V1.'.control.php')){
		_autofile(PROJECT_PRE.V0.'/control/'.V1.'.control.php');
	}
	if(AUTO_CREATFILE&&!is_dir(PROJECT_PRE.V0.'/tpl/'.V1)){
		mkdir(PROJECT_PRE.V0.'/tpl/'.V1);
	}
	if(file_exists(PROJECT_PRE.V0.'/control/'.V1.'.control.php')){
		include_once(PROJECT_PRE.V0.'/control/'.V1.'.control.php');
	}
	$fun='__'.V2;
	if (function_exists($fun)) {
		//_logs(V0.'/'.V1.'/'.V2.'control');
		call_user_func($fun);
	} else {
		if (function_exists('__index')) call_user_func('__index');
	}
	if(('mysqli'==DB_MYSQL)&&!empty($_wrap['mysqli_conn'])){
		mysqli_close($_wrap['mysqli_conn']);
	}
	if(('mysql'==DB_MYSQL)&&!empty($_wrap['mysql_conn'])){
		mysql_close($_wrap['mysql_conn']);
	}
}
?>