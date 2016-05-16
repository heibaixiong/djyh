<?php
if(!defined('PART'))exit;
function _weblogs($str){
    $data=array();
    $data['uid']=_session('webid')?_session('webid'):0;
    $data['uname']=_session('webuser')?_session('webuser'):'';
    $data['content']=$str;
    $data['addtime']=time();
    $data['ip']=_ip();
    _sqlinsert('weblogs',$data);
}
?>