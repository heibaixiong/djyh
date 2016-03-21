<?php
if(!defined('PART'))exit;
function _api_qr($text,$w='200',$m='3',$bg='ffffff',$fg='000000',$gc='cc00000'){
	return 'http://qr.liantu.com/api.php?bg='.$bg.'&fg='.$fg.'&gc='.$gc.'&el=l&w='.$w.'&m='.$m.'&text='.$text;
}
function _api_kuaidi($code,$express,$url){
	return 'http://m.kuaidi100.com/index_all.html?type='.$code.'&postid='.$express.'&callbackurl='.$url;
}
?>