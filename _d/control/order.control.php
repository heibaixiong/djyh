<?php
if(!defined('PART'))exit;
if (empty(_session('weixin_openid'))) {
    _session('weixin_redirect_url', 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
    _header('http://'.$_SERVER['HTTP_HOST'] . '/callback/wxpay_openid/index.php');
    exit();
}

function __index() {
    die('access denied!');
}

function __list() {
    global $_;

    $_p = _v(4);
    $_c = _v(3);

    if (empty($_p)) $_p = 1;

    if (strlen($_c) > 0 && !array_key_exists($_c, $_['user_order_status'])) {
        _header(_u('///'));
    }

    $where = 'wx_open_id=\''._session('weixin_openid').'\'';
    if (strlen($_c) > 0) {
        $where .= ' and status = \''.intval($_c).'\'';
    }

    Page::start('ship_order', $_p, $where, 'id desc', 10);

    foreach (Page::$arr as $k => $order) {
        Page::$arr[$k]['ship_status'] = '';
        if ($order['status'] > 3) {
            $sql = "select s.* from "._pre('ship_to_stowage')." as s2s inner join "._pre('ship_stowage')." as s on s2s.stowage_id=s.id where s2s.ship_number='{$order['ship_number']}' and s.status>0 order by s.id desc";
            $res = _sqlselect($sql);
            if (!empty($res)) {
                Page::$arr[$k]['ship_status'] = $res[0]['status'];
                Page::$arr[$k]['ship_states'] = $res[0];
            }
        }
    }

    _c('title', '我的订单');

    _tpl('order/list');
}

function __more() {
    global $_;

    $_p = _v(4);
    $_c = _v(3);

    if (empty($_p)) $_p = 1;

    if (strlen($_c) > 0 && !array_key_exists($_c, $_['user_order_status'])) {
        die(json_encode(array()));
    }

    $where = 'wx_open_id=\''._session('weixin_openid').'\'';
    if (strlen($_c) > 0) {
        $where .= ' and status = \''.intval($_c).'\'';
    }

    Page::start('ship_order', $_p, $where, 'id desc', 10);

    $orders = array();
    foreach (Page::$arr as $order) {
        $order['ship_thumb'] = '';
        if (is_file(DIR.$order['ship_image'])) {
            $order['ship_thumb'] = _resize($order['ship_image'], 175, 175);
        }
        $order['ship_thumb1'] = '';
        if (is_file(DIR.$order['ship_image1'])) {
            $order['ship_thumb1'] = _resize($order['ship_image1'], 175, 175);
        }
        $order['ship_thumb2'] = '';
        if (is_file(DIR.$order['ship_image2'])) {
            $order['ship_thumb2'] = _resize($order['ship_image2'], 175, 175);
        }

        $order['ship_status'] = '';
        if ($order['status'] > 3) {
            $sql = "select s.* from "._pre('ship_to_stowage')." as s2s inner join "._pre('ship_stowage')." as s on s2s.stowage_id=s.id where s2s.ship_number='{$order['ship_number']}' and s.status>0 order by s.id desc";
            $res = _sqlselect($sql);
            if (!empty($res)) {
                $order['ship_status'] = $res[0]['status'];
                $order['ship_status_label'] = $_['stowage_status'][$res[0]['status']];
                $order['ship_states'] = $res[0];
            }
        }

        $order['ship_amount_label'] = _rmb($order['ship_amount']);
        $order['status_label'] = $_['user_order_status'][$order['status']];
        $order['url_view'] = _u('/order/view/'.$order['id'].'/'._v(3).'/'._v(4).'/');
        $order['url_cancel'] = _u('/ship/cancel/'.$order['id'].'/'._v(3).'/'._v(4).'/');
        $order['url_edit'] = _u('/ship/edit/'.$order['id'].'/'._v(3).'/'._v(4).'/');

        $orders[] = $order;
    }

    die(json_encode($orders));
}

function __view() {
    $order_id = intval(_v(3));
    $order = _sqlone('ship_order', 'id=\''.$order_id.'\' and wx_open_id=\''._session('weixin_openid').'\'');

    if (empty($order)) {
        _alerturl('订单不存在！', _u('/order/list/'._v(4).'/'._v(5).'/'));
    }

    _c('ship_order', $order);
    _c('title', '我的订单');

    _tpl();
}

function __ship() {
    $order_id = intval(_v(3));
    $order = _sqlone('ship_order', 'id=\''.$order_id.'\' and wx_open_id=\''._session('weixin_openid').'\'');

    if (empty($order)) {
        _alerturl('订单不存在！', _u('/order/list/'._v(4).'/'._v(5).'/'));
    }

    $order['rob_name'] = '';
    if ($order['status'] > 2) {
        $sql = "select i.* from "._pre('ship_user')." as u inner join "._pre('ship_user_info')." as i on u.id=i.uid where u.wx_open_id='{$order['rob_open_id']}'";
        $res = _sqlselect($sql);
        if (!empty($res)) {
            $order['rob_name'] = $res[0]['real_name'];
        }
    }

    $order['ship_status'] = '';
    if ($order['status'] > 3) {
        $sql = "select s.* from "._pre('ship_to_stowage')." as s2s inner join "._pre('ship_stowage')." as s on s2s.stowage_id=s.id where s2s.ship_number='{$order['ship_number']}' and s.status>0 order by s.id desc";
        $res = _sqlselect($sql);
        if (!empty($res)) {
            $order['ship_status'] = $res[0]['status'];
            $order['ship_states'] = $res;
        }
    }

    _c('ship_order', $order);
    _c('title', '我的订单');

    _tpl();
}

function __manage() {
    global $_;

    if (!isset($_['member']['role']) || $_['member']['role'] <> '1') {
        _alerturl('您没有权限进行此操作！', _u('/user/tobe/1/'));
        die();
    }

    $_p = _v(4);
    $_c = _v(3);

    if (empty($_p)) $_p = 1;

    $status_denied = array('0', '1');
    if (in_array($_c, $status_denied) || (strlen($_c) > 0 && !array_key_exists($_c, $_['seller_order_status']))) {
        _header(_u('///'));
    }

    $where = 'rob_open_id=\''._session('weixin_openid').'\' and status not in (\''.join("','", $status_denied).'\')';
    if (strlen($_c) > 0) {
        $where .= ' and status = \''.intval($_c).'\'';
    }

    Page::start('ship_order', $_p, $where, 'id desc', 10);

    foreach (Page::$arr as $k => $order) {
        if (!empty(_session('auto_gps_location'))) {
            list($gps_lng, $gps_lat) = explode(',', _session('auto_gps_location'));
            //Page::$arr[$k]['distance'] = number_format(_distanceBetween($gps_lat, $gps_lng, $order['ship_lat'], $order['ship_lng'])/1000, 1);
        }
    }

    _c('title', '订单管理');

    _tpl();
}

function __load() {
    global $_;

    if (!isset($_['member']['role']) || $_['member']['role'] <> '1') {
        die(json_encode(array()));
    }

    $_p = _v(4);
    $_c = _v(3);

    if (empty($_p)) $_p = 1;

    $status_denied = array('0', '1');
    if (in_array($_c, $status_denied) || (strlen($_c) > 0 && !array_key_exists($_c, $_['seller_order_status']))) {
        die(json_encode(array()));
    }

    $where = 'rob_open_id=\''._session('weixin_openid').'\' and status not in (\''.join("','", $status_denied).'\')';
    if (strlen($_c) > 0) {
        $where .= ' and status = \''.intval($_c).'\'';
    }

    Page::start('ship_order', $_p, $where, 'id desc', 10);

    $orders = array();
    foreach (Page::$arr as $order) {
        $order['ship_thumb'] = '';
        if (is_file(DIR.$order['ship_image'])) {
            $order['ship_thumb'] = _resize($order['ship_image'], 175, 175);
        }
        $order['ship_thumb1'] = '';
        if (is_file(DIR.$order['ship_image1'])) {
            $order['ship_thumb1'] = _resize($order['ship_image1'], 175, 175);
        }
        $order['ship_thumb2'] = '';
        if (is_file(DIR.$order['ship_image2'])) {
            $order['ship_thumb2'] = _resize($order['ship_image2'], 175, 175);
        }

        if (!empty(_session('auto_gps_location'))) {
            list($gps_lng, $gps_lat) = explode(',', _session('auto_gps_location'));
            $order['distance'] = number_format(_distanceBetween($gps_lat, $gps_lng, $order['ship_lat'], $order['ship_lng'])/1000, 1);
        }

        $order['order_number'] = strlen($order['id'])<12 ? str_repeat('0', 12-strlen($order['id'])).$order['id'] : $order['id'];
        $order['short_time'] = _shortTime($order['mod_time']);
        $order['ship_amount_label'] = _rmb($order['ship_amount']);
        $order['status_label'] = $_['seller_order_status'][$order['status']];
        $order['url_view'] = _u('/order/detail/'.$order['id'].'/'._v(3).'/'._v(4).'/');
        $order['url_cancel'] = _u('/order/cancel/'.$order['id'].'/'._v(3).'/'._v(4).'/');
        $order['url_pick'] = _u('/order/picked/'.$order['id'].'/'._v(3).'/'._v(4).'/');

        $orders[] = $order;
    }

    die(json_encode($orders));
}

function __detail() {
    global $_;

    if (!isset($_['member']['role']) || $_['member']['role'] <> '1') {
        _alerturl('您没有权限进行此操作！', _u('/user/tobe/1/'));
        die();
    }

    $order_id = intval(_v(3));
    $order = _sqlone('ship_order', 'id=\''.$order_id.'\' and rob_open_id=\''._session('weixin_openid').'\'');

    if (empty($order)) {
        _alerturl('订单不存在！', _u('/order/list/'._v(4).'/'._v(5).'/'));
    }

    _c('ship_order', $order);
    _c('title', '订单管理');

    _tpl();
}

function __abort() {
    global $_;

    if (!isset($_['member']['role']) || $_['member']['role'] <> '1') {
        _alerturl('您没有权限进行此操作！', _u('/user/tobe/1/'));
        die();
    }

    $order_id = intval(_v(3));
    $order = _sqlone('ship_order', 'id=\''.$order_id.'\' and rob_open_id=\''._session('weixin_openid').'\' and status = \'2\' and sys = \'0\'');

    if (empty($order)) {
        _alerturl('订单不存在或无法放弃！', _u('/order/manage/'._v(4).'/'._v(5).'/'));
    }

    if ($id = _sqlupdate('ship_order', array('rob_open_id' => '', 'status' => 1, 'rob_time' => time()), 'id=\''.$order_id.'\' and rob_open_id=\''._session('weixin_openid').'\' and status = \'2\' and sys = \'0\'')) {
        _sendWxMsg($order['wx_open_id'], '您的订单：['.str_repeat('0', 12-strlen($order['id'])).$order['id'].'], 已被小哥弃单！555...');
        _alerturl('放弃订单成功！', _u('/order/manage/'._v(4).'/'._v(5).'/'));
    } else {
        _alerturl('放弃订单失败！', _u('/order/manage/'._v(4).'/'._v(5).'/'));
    }
}

function __picked() {
    global $_;

    $json = array();

    if (!isset($_['member']['role']) || $_['member']['role'] <> '1') {
        $json['error'] = '您没有权限进行此操作！';
        die(json_encode($json));
    }

    $order_id = intval(_v(3));
    $order = _sqlone('ship_order', 'id=\''.$order_id.'\' and rob_open_id=\''._session('weixin_openid').'\' and status = \'2\'');

    if (empty($order)) {
        $json['error'] = '订单不存在或无法揽件！';
        //_alerturl('订单不存在或无法揽件！', _u('/order/manage/'._v(4).'/'._v(5).'/'));
    } elseif (empty(_post('ship_number')) || floatval(_post('ship_number')) <> _post('ship_number')) {
        $json['error'] = '请输入正确运单号！';
    } elseif ($sid = _sqlone('ship_order', 'ship_number=\''._escape(_post('ship_number')).'\'')) {
        $json['error'] = '运单号已被使用，请核对！';
    }

    if (empty($json)) {
        if ($id = _sqlupdate('ship_order', array('ship_number' => _escape(_post('ship_number')), 'status' => 3, 'pick_time' => time()), 'id=\''.$order_id.'\' and rob_open_id=\''._session('weixin_openid').'\' and status = \'2\'')) {
            $json['success'] = '订单揽件成功！';
            _sendWxMsg($order['wx_open_id'], '您的订单：['.str_repeat('0', 12-strlen($order['id'])).$order['id'].'], 已被小哥揽件成功！');
            //_alerturl('订单揽件成功！', _u('/order/manage/'._v(4).'/'._v(5).'/'));
        } else {
            $json['error'] = '订单揽件失败！';
            //_alerturl('订单揽件失败！', _u('/order/manage/'._v(4).'/'._v(5).'/'));
        }
    }

    die(json_encode($json));
}