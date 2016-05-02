<?php
if(!defined('PART'))exit;
if (empty(_session('weixin_openid'))) {
    _session('weixin_redirect_url', 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
    _header('http://'.$_SERVER['HTTP_HOST'] . '/callback/wxpay_openid/index.php');
    exit();
}

function __index() {
    die('User Center is under building.');
}

function __tobe() {
    $user = _sqlone('ship_user_info', 'uid=\''._session('wx_uid').'\'');

    if ($user && $user['status'] == '1') {
        _header(_u('/ship/list/'));
        die();
    }

    if (!empty(_post('cons_prov'))) {
        $json = array();
        if (empty(_post('cons_prov')) || empty(_post('cons_city')) || empty(_post('cons_area'))) {
            $json['error'] = '请选择完整所在地区！';
        } elseif (empty(_post('cons_name'))) {
            $json['error'] = '请输入您身份证上的姓名！';
        } elseif (empty(_post('cons_phone')) || !_phone(_post('cons_phone'))) {
            $json['error'] = '请输入正确的手机号码！';
        } elseif (empty(_post('cons_identify'))) {
            $json['error'] = '请输入您的身份证号码！';
        }

        if (empty($json)) {
            $data = array();
            if (empty($user)) $data['uid'] = floatval(_session('wx_uid'));
            $data['real_name'] = _post('cons_name');
            $data['phone'] = _post('cons_phone');
            $data['prov'] = _post('cons_prov');
            $data['city'] = _post('cons_city');
            $data['area'] = _post('cons_area');
            $data['id_card'] = _post('cons_identify');
            $data['sex'] = _post('ship_sex');
            $data['age'] = _post('ship_age');
            $data['edu'] = _post('ship_edu');
            $data['exp'] = _post('ship_exp');
            $data['image'] = _post('ship_image');
            $data['note'] = _post('ship_note');
            $data['tobe'] = 1;
            if (empty($user)) $data['add_time'] = time();
            $data['mod_time'] = time();
            $data['status'] = 0;

            if (empty($user)) {
                if ($id = _sqlinsert('ship_user_info', $data)) {
                    $json['success'] = true;
                } else {
                    $json['error'] = '申请提交失败，请稍后再试！';
                }
            } else {
                _sqlupdate('ship_user_info', $data, 'id=\''.$user['id'].'\'');
                $json['success'] = true;
            }
        }

        die(json_encode($json));
    }

    _c('user_info', $user);

    _c('title', '我要抢单');
    _tpl();
}