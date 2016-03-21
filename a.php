<?php
define('PART',1);
define('DIR',dirname(__FILE__).'/');
define('DOSQL','');
define('APP_PATH','a/');
define('PROJECT','p,m');
define('PROJECT_PRE','_');
define('PUB','public/');
define('UPLOAD','upload/');
define('CACHE',DIR.'cache/');
define('LOGS',DIR.'logs/');
define('ERR',true);
define('AUTO_LOAD',true);
define('AUTO_CREATFILE',true);
define('DB_MYSQL','mysqli');
define('PRE','hbx_');
define('SALT','@#@$$%%%$$#@');
define('INDEX','');
define('HTML','php');
define('CACHETIME',1000);
$_wrap['db']['host']='localhost';
$_wrap['db']['user']='root';
$_wrap['db']['pass']='';
$_wrap['db']['database']='hb_dev';
// $_wrap['db']['host']='t5gozcz5.zzcdb.dnstoo.com:5504';
// $_wrap['db']['user']='zhiluw_f';
// $_wrap['db']['pass']='gY827NfpHv';
// $_wrap['db']['database']='zhiluw';

$_wrap['sms']['user'] = 'hnhbx';
$_wrap['sms']['pass'] = 'heibaixiong0201';

$_wrap['order_state'] = array(
    '2' => '已付款',
    '3' => '已发货',
    '4' => '已完成',
    '5' => '申请退款',
    '6' => '申请退货',
    '7' => '已退款',
    '11' => '已退货退货',
);

$_wrap['user_rank'] = array(
    '0' => '总管理员',
    '1' => '一般管理员',
    '2' => '服务站',
    '3' => '全商家',
    '4' => '县区商家',
    '5' => '网点',
    '6' => '线下营销人员',
);

include(DIR.APP_PATH.'a.php');
?>