<?php
if(!defined('PART'))exit;
if(_ftime('config')>CACHETIME){
	_f('config',_sqlone('config'));
}
_c('config',_f('config'));
//这里加上search
//
if(_ftime('oneclass')>CACHETIME){
	_f('oneclass',_sqlall('class','pid=0 and state=0 order by px'));
}
_c('oneclass',_f('oneclass'));
if(_ftime('duilian')>CACHETIME){
	_f('duilian',_sqlall('ad','postion="对联" and state=0 order by px limit 2'));
}
_c('duilian',_f('duilian'));
if(_ftime('indexad')>CACHETIME){
	_f('indexad',_sqlall('ad','postion="首页通栏" and state=0 order by px limit 2'));
}
_c('indexad',_f('indexad'));
if(_ftime('article')>CACHETIME){
	$article=_sqlall('articleclass','state=0 order by px');
	foreach($article as $k=>$v){
		$article[$k]['article']=_sqlall('article','classid='.$v['id'].' and state=0 order by px');
	}
	_f('article',$article);
}
_c('article',_f('article'));
if(_ftime('newsclass')>CACHETIME){
	_f('newsclass',_sqlall('newsclass','state=0 order by px'));
}
_c('newsclass',_f('newsclass'));
/*if(_ftime('cartnum')>CACHETIME){
	_f('cartnum',_sqlnum('cart','uid='._session('webid').' and state<2'));
}
_c('cartnum',_f('cartnum'));*/
_c('cartnum',_sqlnum('cart','uid='._session('webid').' and (state=0 or state=1)'));

$member = _sqlone('admin','id='.intval(_session('webid')));
if (empty($member)) _session('webid', '');

global $_wrap;
if (array_key_exists($member['rank'], $_wrap['user_rank'])) {
	$member['rank_name'] = $_wrap['user_rank'][$member['rank']];
}
_c('member', $member);
?>