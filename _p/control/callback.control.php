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

    if (empty($openId)) {
        if (_session('weixin_redirect_url')) {
            _header(_session('weixin_redirect_url'));
        } else {
            _header(_u('/cart/checkout/'));
        }
        die();
    }

    _session('weixin_openid', $openId);

    if (!empty(_session('weixin_redirect_url')) && preg_match('/[^?]*\?d\/.*/i', _session('weixin_redirect_url'))) {
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
    }

    if (!empty(_session('weixin_redirect_url')) && preg_match('/[^?]*\?w\/.*/i', _session('weixin_redirect_url'))) {
        $wx_user = _sqlone('admin_bind', 'openid=\'' . _escape($openId) . '\'');
        //var_dump($wx_user);exit;
        if (empty($wx_user)) {
            $data1 = array(
                'openid' => $openId,
                'from' => 'weixin',
                'add_time' => time()
            );
            $wx_id = _sqlinsert('admin_bind', $data1);  //insert bindinfo to admin_bind

            $data2 = array(
                'user' => 'w' . _random(8, 'num'),
                'rank' => '5',
                'regtime' => time(),
                'updatetime' => time(),
                'login' => '1',
                'state' => '0'
            );
            if($user_id = _sqlinsert('admin', $data2)) {  //insert userinfo to admin_bind
                _sqldo('update ' . _pre('admin_bind') . ' set user_id=' . $user_id . ' where id=' . $wx_id);  //update userinfo to admin_bind
                _session('webid', $user_id);
            }
        } else {
            //get table admin info
            $user = _sqlone('admin', 'id = '.$wx_user['user_id']);
            if(empty($user)){	//add user info to table of admin
                $data['user'] = 'w' . _random(8, 'num');
                $data['rank'] = '5';
                $data['regtime'] = time();
                $data['updatetime'] = time();
                $data['login'] = 1;
                $data['state'] = 0;
                if($user_id = _sqlinsert('admin', $data)) {  //insert userinfo to admin_bind
                    _sqldo('update ' . _pre('admin_bind') . ' set user_id=' . $user_id . ' where id=' . $wx_user['id']);  //update userinfo to admin_bind
                    _session('webid', $user_id);
                }
            }else{
                _sqldo('update ' . _pre('admin') . ' set updatetime=' . time() . ', login = login + 1 where id=' . $user['id']);	//update userinfo(updatetime,login) to admin
                _session('webid', $wx_user['user_id']);
            }
        }
    }

    if (_session('weixin_redirect_url')) {
        _header(_session('weixin_redirect_url'));
    } else {
        _header(_u('/cart/checkout/'));
    }

}