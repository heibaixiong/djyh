<?php
//version 2.0.1.2 for wl.
define('PART',1);
define('DIR',dirname(__FILE__).'/');
define('DOSQL','');
define('APP_PATH','a/');
define('PROJECT','d,c');
define('PROJECT_PRE','_');
define('PUB','public/');
define('UPLOAD','upload/');
define('CACHE',DIR.'cache/');
define('LOGS',DIR.'logs/');
define('ERR',true);
define('AUTO_LOAD',true);
define('AUTO_CREATFILE',false);
define('DB_MYSQL','mysqli');
define('PRE','hbx_');
define('SALT','@#@$$%%%$$#@');
define('INDEX','');
define('HTML','php');
define('CACHETIME',1800);

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

$_wrap['payment_method'] = array(
    /*'cod' => array('code' => 'cod', 'title' => '货到付款', 'state' => 2),*/
    'alipay' => array('code' => 'alipay_direct', 'title' => '支付宝', 'state' => 1),
    'weixin' => array('code' => 'wxpay', 'title' => '微信', 'state' => 1),
    'wxcode' => array('code' => 'wxpay_qrcode', 'title' => '微信', 'state' => 1),
);

$_wrap['order_state'] = array(
    '1' => '等待付款',
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

$_wrap['alipay_config'] = array(
    'partner' => '2088711440026023',
    'key' => 'vfqnizrbr9wjp665zrc7h2tj7yojdpqz',
    'sign_type' => strtoupper('MD5'),
    'input_charset' => strtolower('utf-8'),
    'cacert' => getcwd().'\\cacert.pem',
    'transport' => 'http://lgs.dongjiayaohuo.com/',
    'seller_email' => 'm18503781888@163.com'
);

$_wrap['wxpay_config'] = array(
    'wxpay_appid' => 'wx8998712bfee215e7',
    'wxpay_mchid' => '1346867401',
    'wxpay_key' => 'c8564671e3ef3dtd7fb6262a5da56698',
    'wxpay_appsecret' => '7c0d39bfe295a119bd29f29b8171e166',
    'sslcert_path' => DIR . APP_PATH . 'cert/apiclient_cert.pem',
    'sslkey_path' => DIR . APP_PATH . 'cert/apiclient_key.pem',
    'curl_proxy_host' => '',
    'curl_proxy_port' => '',
    'report_level' => '',
);

include(DIR.APP_PATH.'a.php');