<?php
if(!defined('PART'))exit;
global $_;
if (empty($_['member']) || $_['member']['rank'] <> '3') {
    _alerturl('您没有权限访问！',_u('/person/index/'));
}
function __order() {
    global $_wrap;

    $webid=_session('webid');

    $p=_v(3);
    if(empty($p)){
        $p=0;
    }

    $sql = PRE . "cart as c inner join " . PRE . "ware as w on c.wid=w.id inner join " . PRE . "order as o on c.orderid=o.id where w.uid='".intval($webid)."' group by o.id order by o.addtime desc, o.id desc";
    Page::select($sql, 'o.*', $p);

    $sql = "select c.* from " . PRE . "cart as c inner join " . PRE . "ware as w on c.wid=w.id inner join " . PRE . "order as o on c.orderid=o.id where w.uid='".intval($webid)."'";
    foreach (Page::$arr as $k => $order) {
        Page::$arr[$k]['goods'] = _sqlselect($sql . " and o.id = '".$order['id']."'");
    }

    _c('title','订单管理');
    _c('order_state', $_wrap['order_state']);
    _tpl();
}

function __order_view(){
    global $_wrap;
    $webid=_session('webid');
    $order = _sqlone('order', 'id='.intval(_v(3)));
    if (empty($order)) {
        _alerturl('订单不存在！', _u('//order/'.intval(_v(4))));
    }

    $sql = "select c.* from " . PRE . "cart as c inner join " . PRE . "ware as w on c.wid=w.id inner join " . PRE . "order as o on c.orderid=o.id where w.uid='".intval($webid)."'";
    $order['goods'] = _sqlselect($sql . " and o.id = '".$order['id']."'");
    if (empty($order['goods'])) {
        _alerturl('订单不存在！', _u('//order/'.intval(_v(4))));
    }

    $order['state'] = $order['goods'][0]['state'];
    $order['status'] = $_wrap['order_state'][$order['state']];

    _c('order', $order);
    _c('page', intval(_v(4)));
    _c('title','订单详细');
    _tpl();
}

function __order_ship(){
    global $_wrap;
    $webid=_session('webid');
    $order = _sqlone('order', 'id='.intval(_v(3)));
    if (empty($order)) {
        _alerturl('订单不存在！', _u('//order/'.intval(_v(4))));
    }

    $sql = "select c.* from " . PRE . "cart as c inner join " . PRE . "ware as w on c.wid=w.id inner join " . PRE . "order as o on c.orderid=o.id where w.uid='".intval($webid)."'";
    $order['goods'] = _sqlselect($sql . " and o.id = '".$order['id']."'");
    if (empty($order['goods'])) {
        _alerturl('订单不存在！', _u('//order/'.intval(_v(4))));
    }

    $order['state'] = $order['goods'][0]['state'];
    $order['status'] = $_wrap['order_state'][$order['state']];

    if ($order['state'] <> '2') {
        _alerturl('订单当前状态不允许此操作！', _u('//order_view/'.intval(_v(3))));
    } else {
        $ids = array();
        foreach ($order['goods'] as $goods) {
            if ($goods['state'] <> '2') continue;
            $ids[] = $goods['id'];
        }

        if ($ids) {
            if (_sqldo("update ".PRE."cart set state='3', ship_time='".time()."' where id in ('".join("','", $ids)."')")) {
                $shiped = _sqlnum('cart', "orderid='".$order['id']."' and state='3'");
                if ($shiped == $order['cates']) {
                    _sqldo("update ".PRE."order set state='3', ship_time='".time()."' where id='".$order['id']."'");
                }
                _alerturl('订单发货成功！', _u('//order_view/'.intval(_v(3))));
            } else {
                _alerturl('订单发货失败！', _u('//order_view/'.intval(_v(3))));
            }
        }
    }

    _alerturl('订单当前状态不允许此操作！', _u('//order_view/'.intval(_v(3))));
}

?>