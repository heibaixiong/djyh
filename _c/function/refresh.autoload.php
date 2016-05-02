<?php
if(!defined('PART'))exit;
function class_pid(){
    $rs=_sqlall('ware','class1=0');
    foreach($rs as $k=>$v){
        $data=array();
        $data['class1']=_sqlfield('class','pid','id='.$v['class2']);
        _sqlupdate('ware',$data,'id='.$v['id']);
    }
    $arr=_sqlall('ware','class2name=class1name');
    foreach($arr as $k=>$v){
        $data=array();
        $data['class2name']=class_id_name($v['class2']);
        $data['class1name']=class_id_name($v['class1']);
        _sqlupdate('ware',$data,'id='.$v['id']);
    }
}
function class_count(){
    $arr=_sqlselect('select count(*) as cou,class2 from '._pre('ware').' group by class2');
    foreach($arr as $k=>$v){
        $data=array();
        $data['hits']=$v['cou'];
        _sqlupdate('class',$data,'id='.$v['class2']);
    }
    $arr=_sqlselect('select count(*) as cou,class1 from '._pre('ware').' group by class1');
    foreach($arr as $k=>$v){
        $data=array();
        $data['hits']=$v['cou'];
        _sqlupdate('class',$data,'id='.$v['class1']);
    }
}
function ware_attri(){
    _sqldo('update '._pre('ware').' set '._pre('ware').'.attri=(select '._pre('class').'.attri from '._pre('class').' where '._pre('class').'.id='._pre('ware').'.class2)');
}
?>