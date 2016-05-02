<?php
if(!defined('PART'))exit;

function __list() {
    global $_;
    $s=_v(3);
    $p=_v(4);
    if(strlen($s) > 0 && !array_key_exists(intval($s), $_['stowage_status'])){
        $s = '';
    }
    if(empty($p)){
        $p=0;
    }
    $key=_post('key');
    $session_key=_session('key');
    if(!empty($key)){
        _session('key',$key);
    }
    if(empty($key)&&!empty($session_key)){
        $key=_session('key');
    }
    $_['key']=$key;
    $sql = "1=1";
    if(!empty($key)){
        $sql .= ' and (prov like \'%'._escape($key).'%\' or city like \'%'._escape($key).'%\' or area like \'%'._escape($key).'%\')';
    }
    if ($s <> '') {
        $sql .= ' and status = \''.$s.'\'';
    }
    Page::start('ship_stowage', $p, $sql, 'id desc');

    foreach (Page::$arr as $k => $stowage) {
        Page::$arr[$k]['total_quantity'] = 0;
        Page::$arr[$k]['total_weight'] = 0;
        $sql = "select sum(o.ship_quantity) as total_quantity, sum(o.ship_weight) as total_weight from "._pre('ship_to_stowage')." as s2s inner join "._pre('ship_order')." as o on s2s.ship_number=o.ship_number where s2s.stowage_id='{$stowage['id']}'";
        $res = _sqlselect($sql);
        if (!empty($res)) {
            Page::$arr[$k]['total_quantity'] = $res[0]['total_quantity'];
            Page::$arr[$k]['total_weight'] = $res[0]['total_weight'];
        }
        Page::$arr[$k]['car_number'] = _sqlfield('ship_car', 'number', "id='{$stowage['car_id']}'");
    }

    _c('title', $s==''?'全部':$_['order_status'][$s]);
    _c('stowage_status', $_['stowage_status']);

    _tpl('/list');
}

function __add() {
    _c('driver', array());
    _c('form_action', _u('//save//'._v(3).'/'._v(4).'/'));

    $drivers = _sqlall('ship_driver', 'status=1', 'id');
    $cars = _sqlall('ship_car', 'status=1', 'id');

    _c('drivers', $drivers);
    _c('cars', $cars);

    $ship_order = _sqlall('ship_order', 'status in (3,4)', 'id');
    _c('ship_order', $ship_order);

    _c('stowage_ship', array());

    _tpl('/add_form');
}

function __edit() {
    $stowage = _sqlone('ship_stowage', "id='".intval(_v(3))."'");

    if (empty($stowage)) {
        _alerturl('记录不存在', _u('//list/'._v(4).'/'._v(5).'/'));
        die();
    }

    $drivers = _sqlall('ship_driver', 'status=1', 'id');
    $cars = _sqlall('ship_car', 'status=1', 'id');

    _c('drivers', $drivers);
    _c('cars', $cars);

    $ship_order = _sqlall('ship_order', 'status in (3,4)', 'id');
    _c('ship_order', $ship_order);

    $stowage_ship = array();
    $stowage_order = _sqlall('ship_to_stowage', 'stowage_id=\''.$stowage['id'].'\'', 'ship_number');
    foreach ($stowage_order as $value) {
        $stowage_ship[$value['ship_number']] = $value;
    }
    _c('stowage_ship', $stowage_ship);

    //$stowage['status_history'] = _sqlall('ship_stowage_status', "stowage_id='{$stowage['id']}'", 'add_time desc');
    $sql = "select s.*, a.name as admin_name, a.company as admin_part from "._pre('ship_stowage_status')." as s left join "._pre('ship_admin')." as a on s.mid=a.id where s.stowage_id='{$stowage['id']}' order by s.add_time desc, id desc";
    $stowage['status_history'] = _sqlselect($sql);

    _c('driver', $stowage);
    _c('form_action', _u('//save/'._v(3).'/'._v(4).'/'._v(5).'/'));

    _tpl('/add_form');
}

function __save() {
    if (empty(_post('driver'))) {
        _alertback('请选择承运人！');
        die();
    }
    if (empty(_post('car'))) {
        _alertback('请选择车辆！');
        die();
    }

    $stowage = _sqlone('ship_stowage', "id='".intval(_v(3))."'");

    $data = array();
    $data['driver_id'] = floatval(_post('driver'));
    $data['car_id'] = floatval(_post('car'));
    $data['prov_s'] = _post('prov_s');
    $data['city_s'] = _post('city_s');
    $data['area_s'] = _post('area_s');
    $data['prov_e'] = _post('prov_e');
    $data['city_e'] = _post('city_e');
    $data['area_e'] = _post('area_e');
    $data['note'] = _post('note');
    $data['status'] = _post('status');
    $data['mod_time'] = time();

    if (empty($stowage)) {
        $data['add_time'] = time();
        $data['mid'] = floatval(_session('adminid'));
        if ($id = _sqlinsert('ship_stowage', $data)) {
            if (is_array(_post('ship_order')) && !empty(_post('ship_order'))) {
                foreach (_post('ship_order') as $value) {
                    _sqlinsert('ship_to_stowage', array(
                        'ship_number' => floatval($value),
                        'stowage_id' => $id
                    ));
                    if ($data['status'] > 0 && $data['status'] < 3) {
                        $done = _sqlupdate('ship_order', array(
                            'status' => 4,
                            'ship_time' => time()
                        ), 'status=3 and ship_number=\''.floatval($value).'\'');
                        if ($done) {
                            _sqlinsert('ship_order_status', array(
                                'ship_number' => floatval($value),
                                'status_before' => 3,
                                'status_after' => 4,
                                'content' => '状态变更',
                                'mid' => floatval(_session('adminid')),
                                'add_time' => time(),
                                'sys' => 1
                            ));
                            $order = _sqlone('ship_order', 'status=4 and ship_number=\''.floatval($value).'\'');
                            if ($order) {
                                _sendWxMsg($order['wx_open_id'], '您的订单：['.str_repeat('0', 12-strlen($order['id'])).$order['id'].'], 已成功发货！');
                            }
                        }

                        if (_post('notice') == '1') {
                            _sqlinsert('ship_order_status', array(
                                'ship_number' => floatval($value),
                                'status_before' => 4,
                                'status_after' => 4,
                                'content' => '正发往：【'.$data['prov_e'].'/'.$data['city_e'].'/'.$data['area_e'].'】',
                                'mid' => floatval(_session('adminid')),
                                'add_time' => time(),
                                'sys' => 0
                            ));
                            $order = _sqlone('ship_order', 'status=4 and ship_number=\''.floatval($value).'\'');
                            if ($order) {
                                _sendWxMsg($order['wx_open_id'], '您的订单：['.str_repeat('0', 12-strlen($order['id'])).$order['id'].'], 正发往：【'.$data['prov_e'].'/'.$data['city_e'].'/'.$data['area_e'].'】');
                            }
                        }

                    }
                    if ($data['status'] == '3') {
                        _sqlinsert('ship_order_status', array(
                            'ship_number' => floatval($value),
                            'status_before' => 4,
                            'status_after' => 4,
                            'content' => '已到达：【'.$data['prov_e'].'/'.$data['city_e'].'/'.$data['area_e'].'】',
                            'mid' => floatval(_session('adminid')),
                            'add_time' => time(),
                            'sys' => 0
                        ));
                        $order = _sqlone('ship_order', 'status=4 and ship_number=\''.floatval($value).'\'');
                        if ($order) {
                            _sendWxMsg($order['wx_open_id'], '您的订单：['.str_repeat('0', 12-strlen($order['id'])).$order['id'].'], 已到达：【'.$data['prov_e'].'/'.$data['city_e'].'/'.$data['area_e'].'】');
                        }
                    }
                }
            }
            _sqlinsert('ship_stowage_status', array(
                'stowage_id' => $id,
                'status_before' => intval($data['status']),
                'status_after' => intval($data['status']),
                'content' => '创建配载单',
                'mid' => floatval(_session('adminid')),
                'add_time' => time(),
                'sys' => 1
            ));
            _alerturl('操作成功！', _u('//list/'._v(4).'/'._v(5).'/'));
        } else {
            _alertback('操作失败，请稍后再试！');
        }
    } else {
        if ($id = _sqlupdate('ship_stowage', $data, "id='".$stowage['id']."'")) {
            /*$stowage_order = _sqlall('ship_to_stowage', 'stowage_id=\''.$stowage['id'].'\'', 'ship_number');
            foreach ($stowage_order as $value) {
                _sqlupdate('ship_order', array(
                    'status' => 3,
                    'ship_time' => ''
                ), 'status=4 and ship_number=\''.$value['ship_number'].'\'');
            }*/
            _sqldelete('ship_to_stowage', 'stowage_id=\''.$stowage['id'].'\'');
            if (is_array(_post('ship_order')) && !empty(_post('ship_order'))) {
                foreach (_post('ship_order') as $value) {
                    _sqlinsert('ship_to_stowage', array(
                        'ship_number' => floatval($value),
                        'stowage_id' => $stowage['id']
                    ));
                    if ($data['status'] > 0 && $data['status'] < 3) {
                        $done = _sqlupdate('ship_order', array(
                            'status' => 4,
                            'ship_time' => time()
                        ), 'status=3 and ship_number=\''.floatval($value).'\'');
                        if ($done) {
                            _sqlinsert('ship_order_status', array(
                                'ship_number' => floatval($value),
                                'status_before' => 3,
                                'status_after' => 4,
                                'content' => '状态变更',
                                'mid' => floatval(_session('adminid')),
                                'add_time' => time(),
                                'sys' => 1
                            ));
                            $order = _sqlone('ship_order', 'status=4 and ship_number=\''.floatval($value).'\'');
                            if ($order) {
                                _sendWxMsg($order['wx_open_id'], '您的订单：['.str_repeat('0', 12-strlen($order['id'])).$order['id'].'], 已成功发货！');
                            }
                        }

                        if (_post('notice') == '1') {
                            _sqlinsert('ship_order_status', array(
                                'ship_number' => floatval($value),
                                'status_before' => 4,
                                'status_after' => 4,
                                'content' => '正发往：【'.$data['prov_e'].'/'.$data['city_e'].'/'.$data['area_e'].'】',
                                'mid' => floatval(_session('adminid')),
                                'add_time' => time(),
                                'sys' => 0
                            ));
                            $order = _sqlone('ship_order', 'status=4 and ship_number=\''.floatval($value).'\'');
                            if ($order) {
                                _sendWxMsg($order['wx_open_id'], '您的订单：['.str_repeat('0', 12-strlen($order['id'])).$order['id'].'], 正发往：【'.$data['prov_e'].'/'.$data['city_e'].'/'.$data['area_e'].'】');
                            }
                        }

                    }
                    if ($data['status'] <> $stowage['status'] && $data['status'] == '3') {
                        _sqlinsert('ship_order_status', array(
                            'ship_number' => floatval($value),
                            'status_before' => 4,
                            'status_after' => 4,
                            'content' => '已到达：【'.$data['prov_e'].'/'.$data['city_e'].'/'.$data['area_e'].'】',
                            'mid' => floatval(_session('adminid')),
                            'add_time' => time(),
                            'sys' => 0
                        ));
                        $order = _sqlone('ship_order', 'status=4 and ship_number=\''.floatval($value).'\'');
                        if ($order) {
                            _sendWxMsg($order['wx_open_id'], '您的订单：['.str_repeat('0', 12-strlen($order['id'])).$order['id'].'], 已到达：【'.$data['prov_e'].'/'.$data['city_e'].'/'.$data['area_e'].'】');
                        }
                    }
                    /*if ($data['status'] == 0) {
                        _sqlupdate('ship_order', array(
                            'status' => 3,
                            'ship_time' => ''
                        ), 'status=4 and ship_number=\''.floatval($value).'\'');
                    }*/
                }
            }

            if ($data['status'] <> $stowage['status']) {
                _sqlinsert('ship_stowage_status', array(
                    'stowage_id' => $id,
                    'status_before' => $stowage['status'],
                    'status_after' => intval($data['status']),
                    'content' => '状态变更',
                    'mid' => floatval(_session('adminid')),
                    'add_time' => time(),
                    'sys' => 1
                ));
            }

            _alerturl('操作成功！', _u('//list/'._v(4).'/'._v(5).'/'));
        } else {
            _alertback('操作失败，请稍后再试！');
        }
    }
}