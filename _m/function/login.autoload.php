<?php
if(!defined('PART'))exit;
function _adminlogs($str){
    $data=array();
    $data['uid']=_session('adminid')?_session('adminid'):0;
    $data['uname']=_session('adminuser')?_session('adminuser'):'';
    $data['content']=$str;
    $data['addtime']=time();
    $data['ip']=_ip();
    _sqlinsert('adminlogs',$data);
}
function _adminlogin($arr){
    if($arr['state']>0){
        _adminlogs($arr['user'].' 试图管理后台系统，失败');
        _alertback('您的账户存在问题，请您联系网站管理员');
    }
    _session('adminid',$arr['id']);
    _session('adminuser',$arr['user']);
    _session('admincompony',$arr['compony']);
    _session('adminrank',$arr['rank']);
    _session('code',$arr['code']);
    _session('admincode',$arr['admincode']);
    _sqldo('update '._pre('admin').' set updatetime='.time().',hits=hits+1 where id='.$arr['id']);
    _adminlogs('成功登陆管理后台系统');
    _url(_u('/index/index'));
}
function _adminout(){
    _adminlogs('成功退出管理后台系统');
    _session('adminid','unset');
    _session('adminuser','unset');
    _session('admincompony','unset');
    _session('adminrank','unset');
    _session('code','unset');
    _session('admincode','unset');
    _url(_u('/login/index'),true);
}
?>