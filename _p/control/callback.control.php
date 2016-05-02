<?php
if(!defined('PART'))exit;

function __payment() {
    $model = _v(3);

    if (file_exists(APP_PATH.'function/'.$model.'.php')) {
        _fun($model);
        if (function_exists('_doPaymentCallback')) {
            call_user_func('_doPaymentCallback');
        } else {
            die('callback function not exist.');
        }
    } else {
        die('callback model not exist.');
    }
}

function __wxpay_openid() {
    global $_wrap;

    require_once(APP_PATH . 'library/wxpayexception.php');

    define('APPID', $_wrap['wxpay_config']['wxpay_appid']);
    define('MCHID', $_wrap['wxpay_config']['wxpay_mchid']);
    define('KEY', $_wrap['wxpay_config']['wxpay_key']);
    define('APPSECRET', $_wrap['wxpay_config']['wxpay_appsecret']);
    define('SSLCERT_PATH', $_wrap['wxpay_config']['sslcert_path']);
    define('SSLKEY_PATH', $_wrap['wxpay_config']['sslkey_path']);
    define('CURL_PROXY_HOST', '0.0.0.0');
    define('CURL_PROXY_PORT', 0);
    define('REPORT_LEVENL', 1);


    require_once(APP_PATH . 'library/wxpaydata.php');
    require_once(APP_PATH . 'library/wxpayapi.php');
    require_once(APP_PATH . 'library/wxpayconfig.php');
    require_once(APP_PATH . 'library/wxpayjsapipay.php');

    $tools = new JsApiPay();

    $openId = $tools->GetOpenid();

    _session('weixin_openid', $openId);

    //if (!empty(_session('weixin_redirect_url')) && strpos(_session('weixin_redirect_url'), '/?d/') !== false) {
        $wx_user = _sqlone('ship_user', 'wx_open_id=\''._escape($openId).'\'');
        if (empty($wx_user)) {
            $data = array(
                'wx_open_id' => $openId,
                'user_name' => 'u'._random(8, 'num'),
                'pass_word' => _md5(_random(8)),
                'role' => '0',
                'add_time' => time(),
                'mod_time' => time(),
                'last_time' => time(),
                'logins' => '1',
                'status' => '1',
            );
            $uid = _sqlinsert('ship_user', $data);
            _session('wx_uid', $uid);
        } else {
            $data = array(
                'last_time' => time(),
                'logins' => $wx_user['logins'] + 1,
            );
            _sqlupdate('ship_user', $data, 'id=\''.$wx_user['id'].'\'');
            _session('wx_uid', $wx_user['id']);
        }
    //}

    if (_session('weixin_redirect_url')) {
        _header(_session('weixin_redirect_url'));
    } else {
        _header(_u('/cart/checkout/'));
    }

}