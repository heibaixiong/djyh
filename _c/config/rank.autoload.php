<?php
if(!defined('PART'))exit;
$_['config']=_f('config');
_c('state',array('上架','下架'));
_c('status',array('停用','启用'));
_c('user_ranks',array(0=>'总公司',1=>'分拣中心',2=>'分理处',3=>'县级分公司'));
_c('shopclass',array('全区商品','县区商品'));
_c('order_status', array(
    '0' => '已取消',
    '1' => '已下单',
    '2' => '已接单',
    '3' => '已揽件',
    '4' => '已发货',
    '5' => '派件中',
    '6' => '已签收',
    '7' => '拒收',
    '8' => '退回中',
    '11' => '已退回',
    '12' => '已完成',
));
_c('stowage_status', array(
    '0' => '待命中',
    '1' => '运输中',
    '2' => '中转中',
    '3' => '已到达',
));