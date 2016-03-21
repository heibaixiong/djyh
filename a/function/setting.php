<?php
if(!defined('PART'))exit;
if(!file_exists('setting')||V1=='install'){
	$file=glob(PROJECT_PRE.'config/*.autoload.php');
	$str='';
	if(is_array($file)){
		foreach($file as $v){
			$str.='include(\''.$v.'\');'."\n";
		}
	}
	_autofile(PROJECT_PRE.'config/setting.config.php',$str);
	$file=glob(PROJECT_PRE.'function/*.autoload.php');
	$str='';
	if(is_array($file)){
		foreach($file as $v){
			$str.='include(\''.$v.'\');'."\n";
		}
	}
	_autofile(PROJECT_PRE.'function/setting.config.php',$str);
	$project=explode(',',PROJECT);
	foreach($project as $k){
		$file=glob(PROJECT_PRE.$k.'/config/*.autoload.php');
		$str='';
		if(is_array($file)){
			foreach($file as $v){
				$str.='include(\''.$v.'\');'."\n";
			}
		}
		_autofile(PROJECT_PRE.$k.'/config/setting.config.php',$str);
		$file=glob(PROJECT_PRE.$k.'/function/*.autoload.php');
		$str='';
		if(is_array($file)){
			foreach($file as $v){
				$str.='include(\''.$v.'\');'."\n";
			}
		}
		_autofile(PROJECT_PRE.$k.'/function/setting.config.php',$str);		
	}
	$config=fopen('setting','w');
	fclose($config);
	echo '<br />网站环境已经配置！请使用网站！';
}else{
	echo '网站环境已经配置，如果需要重新配置请删除根目录下\'wrap\'文件';
}
?>