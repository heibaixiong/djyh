<?php
if(!defined('PART'))exit;
if(!file_exists('lock')){
	if(strlen(SALT)<10){
		echo 'salt 长度不够10位，请重新设置!';
		//exit;
	}
	$install_dir=array(UPLOAD,PROJECT_PRE.'config',PROJECT_PRE.'function',PUB,CACHE,LOGS);
	foreach($project as $k){
		$install_dir[]=PUB.$k;
		$install_dir[]=PUB.$k.'/images';
		$install_dir[]=PUB.$k.'/style';
		$install_dir[]=PUB.$k.'/js';
		$install_dir[]=PROJECT_PRE.$k;
		$install_dir[]=PROJECT_PRE.$k.'/config';
		$install_dir[]=PROJECT_PRE.$k.'/function';
		$install_dir[]=PROJECT_PRE.$k.'/tpl';
		$install_dir[]=PROJECT_PRE.$k.'/control';

	}
	foreach($install_dir as $k){
		if(!is_dir($k)){
			mkdir($k);
		}
	}
	$config=array();
	foreach($project as $k){
		$config[]=PROJECT_PRE.$k.'/config/setting.config.php';
	}
	$function=array();
	foreach($project as $k){
		$function[]=PROJECT_PRE.$k.'/function/setting.config.php';
	}
	$install_file=array(PROJECT_PRE.'config/setting.config.php',PROJECT_PRE.'function/setting.config.php');
	$install_file=array_merge($install_file,$config,$function);
	foreach($install_file as $k){
		if(!file_exists($k)){
			$file=fopen($k,'w');
			fclose($file);
		}
	}
	if(file_exists(DOSQL.'.php')){
		include(DOSQL.'.php');
		foreach($sql as $value){
			_sqldo($value);
			}
	}	
	$lock=fopen('lock','w');
	fclose($lock);
	echo '<br />网站已经创建！请使用网站！';
}else{
	echo '网站已经创建，如果需要重装请删除根目录下\'lock\'文件';
}
?>