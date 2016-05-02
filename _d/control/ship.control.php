<?php
if(!defined('PART'))exit;
if (empty(_session('weixin_openid'))) {
    _session('weixin_redirect_url', 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
    _header('http://'.$_SERVER['HTTP_HOST'] . '/callback/wxpay_openid/index.php');
    exit();
}
function __index() {
    _session('geo_form_url', _u('/ship/index/'));
    _session('gps_redirect_url', _u('/index/auto/'));

    $address = array();
    $bd_lng = '113.748932';
    $bd_lat = '34.72449';
    if (!empty(_post('address')) && !empty(_post('bd_lng')) && !empty(_post('bd_lat'))) {
        $address = explode(', ', _post('address'));
        $bd_lng = _post('bd_lng');
        $bd_lat = _post('bd_lat');
    } elseif (!empty(_session('last_bd_gps')) && !empty(_session('last_bd_address'))) {
        list($bd_lng, $bd_lat) = explode(',', _session('last_bd_gps'));
        $address = explode(', ', _session('last_bd_address'));
    } else {
        _header(_u('/index/index/auto/'));
        exit();
    }

    _session('last_bd_address', join(', ', $address));
    _session('last_bd_gps', $bd_lng.','.$bd_lat);

    //$address = explode(', ', _post('address'));
    $address_first = '';
    $address_last = '';
    foreach ($address as $k => $v) {
        if ($k < 3) {
            $address_first .= empty($address_first) ? $v : '/'.$v;
        } else {
            $address_last .= $v;
        }
    }

    //$bd_lng = _post('bd_lng');
    //$bd_lat = _post('bd_lat');
    $gps_str = _BD09LLtoWGS84($bd_lng.','.$bd_lat);
    list($gps_lng, $gps_lat) = explode(',', $gps_str);

    $gps_square = _geoSquarePoint($gps_lng, $gps_lat, 5);
    $where = 'active_time > \''.time().'\' and gps_lat > '.$gps_square['right-bottom']['lat'].' and gps_lat < '.$gps_square['left-top']['lat'].' and gps_lng > '.$gps_square['left-top']['lng'].' and gps_lng < '.$gps_square['right-bottom']['lng'];
    $user_online = _sqlnum('ship_user_online', $where);

    _c('user_online', $user_online);

    _c('gps_loction', array(
        'bd_lng' => $bd_lng,
        'bd_lat' => $bd_lat,
        'gps_lng' => $gps_lng,
        'gps_lat' => $gps_lat
    ));

    if (empty($address)) {
        _c('url_geo', _u('/index/index/'));
    } else {
        _c('url_geo', _u('/index/geo/'.$gps_lng.'/'.$gps_lat.'/'));
    }

    _c('ship_address', empty($address)?array('', '', ''):$address);
    _c('address_first', $address_first);
    _c('address_last', $address_last);
    _c('title', '我要发货');
    _c('openid', _session('weixin_openid'));

    _tpl();
}

function __edit() {
    _session('geo_form_url', _u('/ship/edit/'._v(3).'/'._v(4).'/'._v(5).'/'));

    $order_id = intval(_v(3));
    $order = _sqlone('ship_order', 'id=\''.$order_id.'\' and wx_open_id=\''._session('weixin_openid').'\' and status<3');

    if (empty($order)) {
        _alerturl('订单不存在或无法编辑！', _u('/order/list/'._v(4).'/'._v(5).'/'));
    }

    $bd_lng = $order['ship_bd_lng'];
    $bd_lat = $order['ship_bd_lat'];
    $gps_lng = $order['ship_lng'];
    $gps_lat = $order['ship_lat'];

    $address = array();
    $address_first = '';
    $address_last = '';

    if (!empty(_post('address')) && !empty(_post('bd_lng')) && !empty(_post('bd_lat'))) {
        $address = explode(', ', _post('address'));
    } else {
        $address[] = $order['ship_prov'];
        $address[] = $order['ship_city'];
        $address[] = $order['ship_area'];
    }

    foreach ($address as $k => $v) {
        if ($k < 3) {
            $address_first .= empty($address_first) ? $v : '/'.$v;
        } else {
            $address_last .= $v;
        }
    }

    _c('ship_address', $address);
    _c('address_first', $address_first);
    _c('address_last', $address_last);

    _c('order_info', $order);

    _c('title', '我要发货');
    _c('openid', _session('weixin_openid'));

    _c('gps_loction', array(
        'bd_lng' => $bd_lng,
        'bd_lat' => $bd_lat,
        'gps_lng' => $gps_lng,
        'gps_lat' => $gps_lat
    ));
    _c('url_geo', _u('/index/geo/'.$gps_lng.'/'.$gps_lat.'/'));

    _tpl('ship/index');
}

function __cancel() {
    $order_id = intval(_v(3));
    $order = _sqlone('ship_order', 'id=\''.$order_id.'\' and wx_open_id=\''._session('weixin_openid').'\' and status > 0 and status<3');

    if (empty($order)) {
        _alerturl('订单不存在或无法取消！', _u('/order/list/'._v(4).'/'._v(5).'/'));
    }

    if ($id = _sqlupdate('ship_order', array('rob_open_id' => '', 'status' => 0, 'mod_time' => time()), 'id=\''.$order_id.'\' and wx_open_id=\''._session('weixin_openid').'\' and status > 0 and status<3')) {
        if ($order['status'] == '2') {
            _sendWxMsg($order['rob_open_id'], '订单：['.str_repeat('0', 12-strlen($order['id'])).$order['id'].'], 已被用户取消！');
        }
        _alerturl('订单取消成功！', _u('/order/list/'._v(4).'/'._v(5).'/'));
    } else {
        _alerturl('订单取消失败！', _u('/order/list/'._v(4).'/'._v(5).'/'));
    }
}

function __complete() {
    $order_id = intval(_v(3));
    $order = _sqlone('ship_order', 'id=\''.$order_id.'\' and wx_open_id=\''._session('weixin_openid').'\' and status = 4');

    if (empty($order)) {
        _alerturl('订单不存在或当前状态不允许此操作！', _u('/order/list/'._v(4).'/'._v(5).'/'));
    }

    if ($id = _sqlupdate('ship_order', array('rob_open_id' => '', 'status' => 12, 'complete_time' => time()), 'id=\''.$order_id.'\' and wx_open_id=\''._session('weixin_openid').'\' and status = 4')) {
        _alerturl('订单取消成功！', _u('/order/list/'._v(4).'/'._v(5).'/'));
    } else {
        _alerturl('订单取消失败！', _u('/order/list/'._v(4).'/'._v(5).'/'));
    }
}

function __post() {
    $json = array();

    if (empty(_post('ship_bd_lng')) || empty(_post('ship_bd_lat')) || empty(_post('ship_lng')) || empty(_post('ship_lat')) ||
        empty(_post('ship_prov')) || empty(_post('ship_city')) || empty(_post('ship_area'))) {
        $json['error'] = '发货位置不明，请点击[修改位置]重新定位！';
    } elseif (empty(_post('ship_address'))) {
        $json['error'] = '请输入发货人详细地址！';
    } elseif (empty(_post('ship_name'))) {
        $json['error'] = '请输入发货人名称！';
    } elseif (empty(_post('ship_phone'))) {
        $json['error'] = '请输入发货人电话！';
    } elseif (empty(_post('cons_prov')) || empty(_post('cons_city')) || empty(_post('cons_area'))) {
        $json['error'] = '请选择完整发货人所在地区！';
    } elseif (empty(_post('cons_address'))) {
        $json['error'] = '请输入收货人详细地址！';
    } elseif (empty(_post('cons_name'))) {
        $json['error'] = '请输入收货人名称！';
    } elseif (empty(_post('cons_phone'))) {
        $json['error'] = '请输入收货人电话！';
    } elseif (empty(_post('ship_weight')) || floatval(_post('ship_weight')) <> _post('ship_weight')) {
        $json['error'] = '请正确输入货物重量！';
    } elseif (empty(_post('ship_cubic')) || floatval(_post('ship_cubic')) <> _post('ship_cubic')) {
        $json['error'] = '请正确输入货物体积！';
    } elseif (empty(_post('ship_quantity')) || intval(_post('ship_quantity')) <> _post('ship_quantity')) {
        $json['error'] = '请正确输入货物件数！';
    } elseif (empty(_post('ship_desc'))) {
        $json['error'] = '请输入货物内容描述！';
    } elseif (empty(_post('ship_image')) || (empty(_post('ship_image')[0]) && empty(_post('ship_image')[1]) && empty(_post('ship_image')[2]))) {
        $json['error'] = '请至少上传一张货物照片！';
    } elseif (empty(_post('ship_amount')) || floatval(_post('ship_amount')) <> _post('ship_amount')) {
        $json['error'] = '请正确输入运费出价！';
    }

    $order = array();
    if (!empty(_post('order_id'))) {
        $order = _sqlone('ship_order', 'id=\''.intval(_post('order_id')).'\' and wx_open_id=\''._session('weixin_openid').'\' and status<3');
        if (empty($order)) {
            $json['error'] = '订单不存在或不可修改！';
        }
    }

    if (empty($json)) {
        $data = array();
        if (empty($order)) $data['wx_open_id'] = _session('weixin_openid');
        $data['ship_bd_lng'] = floatval(_post('ship_bd_lng'));
        $data['ship_bd_lat'] = floatval(_post('ship_bd_lat'));
        $data['ship_lng'] = floatval(_post('ship_lng'));
        $data['ship_lat'] = floatval(_post('ship_lat'));
        $data['ship_prov'] = _post('ship_prov');
        $data['ship_city'] = _post('ship_city');
        $data['ship_area'] = _post('ship_area');
        $data['ship_address'] = _post('ship_address');
        $data['ship_name'] = _post('ship_name');
        $data['ship_phone'] = _post('ship_phone');
        $data['consignee_prov'] = _post('cons_prov');
        $data['consignee_city'] = _post('cons_city');
        $data['consignee_area'] = _post('cons_area');
        $data['consignee_address'] = _post('cons_address');
        $data['consignee_zipcode'] = _post('cons_zipcode');
        $data['consignee_name'] = _post('cons_name');
        $data['consignee_phone'] = _post('cons_phone');
        $data['ship_weight'] = floatval(_post('ship_weight'));
        $data['ship_cubic'] = floatval(_post('ship_cubic'));
        $data['ship_quantity'] = intval(_post('ship_quantity'));
        $data['ship_desc'] = _post('ship_desc');

        foreach (_post('ship_image') as $k => $image) {
            $key = 'ship_image';
            $key .= $k > 0 ? $k : '';
            $data[$key] = $image;
        }

        $data['pay_method'] = _post('pay_method');
        $data['ship_cod'] = floatval(_post('ship_cod'));
        $data['ship_amount'] = floatval(_post('ship_amount'));
        $data['ship_note'] = strip_tags(_post('ship_note'));

        $data['mod_time'] = time();

        if (empty($order)) {
            $data['add_time'] = time();
            $data['status'] = 1;

            if ($id = _sqlinsert('ship_order', $data)) {
                $json['success'] = true;
            } else {
                $json['error'] = '订单提交失败，请稍后再试！';
            }
        } else {
            if ($id = _sqlupdate('ship_order', $data, 'id=\''.$order['id'].'\' and wx_open_id=\''._session('weixin_openid').'\' and status<3')) {
                $json['success'] = true;
            } else {
                $json['error'] = '订单提交失败，请稍后再试！';
            }
        }
    }

    die(json_encode($json));
}

function __rob() {
    global $_;

    if (!isset($_['member']['role']) || $_['member']['role'] <> '1') {
        _alerturl('您没有权限进行此操作！', _u('/user/tobe/1/'));
        die();
    }

    $order_id = intval(_v(3));
    $order = _sqlone('ship_order', 'id=\''.$order_id.'\' and status=1');

    if (!empty(_post('rob'))) {
        $json = array();
        if (empty($order)) {
            $json['error'] = '订单不存在或已被抢！';
        } else {
            $data = array(
                'rob_open_id' => _session('weixin_openid'),
                'rob_time' => time(),
                'status' => 2
            );
            if ($id = _sqlupdate('ship_order', $data, 'id=\''.$order_id.'\' and status=1')) {
                $json['success'] = true;
                _sendWxMsg($order['wx_open_id'], '您的订单：['.str_repeat('0', 12-strlen($order['id'])).$order['id'].'], 已被小哥接单成功哦！');
            } else {
                $json['error'] = '抢单失败，请稍后再试！';
            }
        }

        die(json_encode($json));
    }

    if (empty($order)) {
        _alerturl('订单不存在或已被抢！', _u('/ship/list/'));
    }

    _c('ship_order', $order);
    _c('title', '我要抢单');

    _tpl();
}

function __list() {
    global $_;

    if (!isset($_['member']['role']) || $_['member']['role'] <> '1') {
        _alerturl('您没有权限进行此操作！', _u('/user/tobe/1/'));
        die();
    }

    $gps_lng = '';
    $gps_lat = '';

    if ((empty(_v(3)) || empty(_v(4))) && (empty(_post('bd_lng')) || empty(_post('bd_lat'))) && empty(_session('auto_gps_location'))) {
        _session('geo_form_url', _u('/ship/list/'));
        _session('gps_redirect_url', _u('/ship/list/'));
        _header(_u('/index/index/auto/'));
        die();
    }

    _session('geo_form_url', _u('/ship/list/'));

    if (!empty(_v(3)) && !empty(_v(4))) {
        $gps_lng = _v(3);
        $gps_lat = _v(4);
        _session('auto_gps_location', $gps_lng.','.$gps_lat);
    } elseif (!empty(_post('bd_lng')) && !empty(_post('bd_lat'))) {
        list($gps_lng, $gps_lat) = explode(',', _BD09LLtoWGS84(_post('bd_lng').','._post('bd_lat')));
        _session('auto_gps_location', $gps_lng.','.$gps_lat);
    } else {
        list($gps_lng, $gps_lat) = explode(',', _session('auto_gps_location'));
    }

    _c('url_geo', _u('/index/geo/'.$gps_lng.'/'.$gps_lat.'/'));

    $user = _sqlone('ship_user_online', "uid='"._escape(_session('wx_uid'))."'");
    $data = array();
    $data['wx_open_id'] = _session('weixin_openid');
    $data['gps_lng'] = floatval($gps_lng);
    $data['gps_lat'] = floatval($gps_lat);
    $data['active_time'] = time() + 1800;
    if (empty($user)) {
        $data['uid'] = _session('wx_uid');
        _sqlinsert('ship_user_online', $data);
    } else {
        _sqlupdate('ship_user_online', $data, "id='{$user['id']}'");
    }

    $search_type = 1;
    /*if (!empty(_post('type'))) {
        $search_type = intval(_post('type'));
    } elseif (!empty(_session('order_list_type'))) {
        $search_type = intval(_session('order_list_type'));
    }
    _session('order_list_type', $search_type);
    _c('type_set', $search_type);*/

    $search_distance = 3;
    if (!empty(_post('distance'))) {
        $search_distance = intval(_post('distance'));
    } elseif (!empty(_session('order_list_distance'))) {
        $search_distance = intval(_session('order_list_distance'));
    }
    _session('order_list_distance', $search_distance);
    _c('distance_set', $search_distance);

    $search_area = '';
    /*if (!empty(_post('area'))) {
        $search_area = _post('area');
    } elseif (!empty(_session('order_list_area'))) {
        $search_area = _session('order_list_area');
    }
    _session('order_list_area', $search_area);
    _c('area_set', $search_area);*/

    $keywords = '';
    if (!empty(_post('keywords'))) {
        $keywords = _post('keywords');
    }
    _c('keywords_set', $keywords);

    $where = 'status=1';
    if ($search_type == 1) {
        $gps_square = _geoSquarePoint($gps_lng, $gps_lat, $search_distance);
        $where .= ' and ship_lat > '.$gps_square['right-bottom']['lat'].' and ship_lat < '.$gps_square['left-top']['lat'].' and ship_lng > '.$gps_square['left-top']['lng'].' and ship_lng < '.$gps_square['right-bottom']['lng'];
    } else {
        //if (!empty($search_area)) $where .= " and ship_area = '"._escape($search_area)."'";
    }
    if (!empty($keywords)) {
        $where .= " and (ship_address like '%"._escape($keywords)."%')";
    }
    $order_list = _sqlall('ship_order', $where, 'id desc', '20');

    foreach ($order_list as $k => $order) {
        $order_list[$k]['distance'] = _distanceBetween($gps_lat, $gps_lng, $order['ship_lat'], $order['ship_lng']);
        $order_list[$k]['short_time'] = _shortTime($order['mod_time']);
    }

    function sortByDistance($a, $b) {
        if ($a['distance'] == $b['distance']) return 0;
        return $a['distance'] > $b['distance'] ? 1 : -1;
    }
    usort($order_list, 'sortByDistance');

    _c('orders', $order_list);

    _c('title', '抢单列表');

    _tpl();
}