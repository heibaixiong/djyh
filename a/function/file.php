<?php
if(!defined('PART'))exit;
function _file_expand($str){
	$types=explode(".",$str);
	if(count($types)<2){
		return false;
	}else{
		return strtolower($types[count($types)-1]);
	}
}
function _file_load($file){
    $savePath=UPLOAD.date('Y')."/".date('m')."/".date('d')."/";
    _mkdir($savePath);
    $str=date('His')._random(3);
    if($_FILES[$file]['name']!=''){
        $tmp_file=$_FILES[$file]['tmp_name'];
        $file_type=_file_expand($_FILES['strPhoto']['name']);
        if(!in_array($file_type,array('jpg'))){
            _alertback('格式不正确');
        }
        $file_name=$str.".".$file_type;
        if(copy($tmp_file,$savePath.$file_name)){
            return $savePath.$file_name;
        }else{
            return '';
        }
    }
}
function _file_execelto($txt,$table,$field,$str=''){
	if(!file_exists($txt)){
		echo '导入文件不存在或者路径错误！';
		exit;
	}
	$f=fopen($txt,'r');
	$d=explode(',',$field);
	while(!feof($f)){
		$r=explode("\t",fgets($f));
		$i=0;
		foreach($d as $k){
			$arr[$k]=$r[$i];
			$i++;
		}
		_sqlinsert($table,$arr,$str='');
	}
}
?>