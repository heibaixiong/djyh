<?php
if(!defined('PART'))exit;
if(!function_exists('_file')){
	_fun('file');
}
function _cache_url_set($url,$name){
    _file(CACHE.V0);
    $str=file_get_contents($url);
    $f=fopen(CACHE.V0.'/'.$name,'w');
    fwrite($f,$str);
    fclose($f);
}
function _cache_url_get($name){
    $a=file_get_contents('http://'.$_SERVER['HTTP_HOST'].'/'.CACHE.V0.'/'.$name);
    return $a;
}
function _cache($t=10000){
    $url=$_SERVER['QUERY_STRING'];
    $name=_md5($url);
    if(!strpos($url,'/shangyun/')){
        if(_cache_isset($name)&&(time()-_cache_time($name))/3600<$t){
            echo _cache_url_get($name);
            exit;
        }else{
            _cache_url_set('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'/shangyun/',$name);
        }
    }
}
?>