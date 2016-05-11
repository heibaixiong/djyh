<?php
if(!defined('PART'))exit;
$_['config']=_f('config');
_c('state',array('上架','下架'));
_c('status',array('开启','关闭'));
_c('rank',array(0=>'总管理员',1=>'一般管理员',2=>'服务站',3=>'全商家',4=>'县区商家',5=>'网点',6=>'线下营销人员'));
_c('shopclass',array('全区商品','县区商品'));
_c('ad_position',array(
    'index_top_1' => '首页顶部(238px*140px)',
    'index_top_2' => '首页通栏(1200px*146px)',
));