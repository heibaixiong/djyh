<?php
if(!defined('PART'))exit;
global $_;
if (empty($_['member']) || $_['member']['rank'] <> '3') {
    _alerturl('您没有权限访问！',_u('/person/index/'));
}
function __order() {
    global $_;

    $webid=_session('webid');

    $where = 'w.uid='.$webid;
    $sql = PRE . "cart as c inner join " . PRE . "ware as w on c.wid=w.id inner join " . PRE . "order as o on c.orderid=o.id where ".$where;
    $total = _sqlselect('select count(DISTINCT c.orderid) as total from ' . $sql);
    _c('total_all', $total[0]['total']);

    $sql = PRE . "cart as c inner join " . PRE . "ware as w on c.wid=w.id inner join " . PRE . "order as o on c.orderid=o.id where ".$where." and c.state=1";
    $total = _sqlselect('select count(DISTINCT c.orderid) as total from ' . $sql);
    _c('total_1', $total[0]['total']);


    $sql = PRE . "cart as c inner join " . PRE . "ware as w on c.wid=w.id inner join " . PRE . "order as o on c.orderid=o.id where ".$where." and c.state=2";
    $total = _sqlselect('select count(DISTINCT c.orderid) as total from ' . $sql);
    _c('total_2', $total[0]['total']);

    $sql = PRE . "cart as c inner join " . PRE . "ware as w on c.wid=w.id inner join " . PRE . "order as o on c.orderid=o.id where ".$where." and c.state=3";
    $total = _sqlselect('select count(DISTINCT c.orderid) as total from ' . $sql);
    _c('total_3', $total[0]['total']);

    $sql = PRE . "cart as c inner join " . PRE . "ware as w on c.wid=w.id inner join " . PRE . "order as o on c.orderid=o.id where ".$where." and c.state=4";
    $total = _sqlselect('select count(DISTINCT c.orderid) as total from ' . $sql);
    _c('total_4', $total[0]['total']);

    $sql = PRE . "cart as c inner join " . PRE . "ware as w on c.wid=w.id inner join " . PRE . "order as o on c.orderid=o.id where ".$where." and c.state=12";
    $total = _sqlselect('select count(DISTINCT c.orderid) as total from ' . $sql);
    _c('total_12', $total[0]['total']);

    $p=_v(3);
    if(empty($p)){
        $p=0;
    }

    $where = 'w.uid='.$webid;
    if (in_array(_v(4), array(1,2,3,4,12))) {
        $where .= ' and c.state = \''.intval(_v(4)).'\'';
    }

    $sql = PRE . "cart as c inner join " . PRE . "ware as w on c.wid=w.id inner join " . PRE . "order as o on c.orderid=o.id where ".$where;
    Page::select($sql, 'o.*', 'o.id', 'o.addtime desc, o.id desc', $p, 10);

    $sql_total = "select sum(c.mark * c.num) as total from " . PRE . "cart as c inner join " . PRE . "ware as w on c.wid=w.id inner join " . PRE . "order as o on c.orderid=o.id where ".$where;
    $sql = "select c.* from " . PRE . "cart as c inner join " . PRE . "ware as w on c.wid=w.id inner join " . PRE . "order as o on c.orderid=o.id where ".$where;
    foreach (Page::$arr as $k => $order) {
        Page::$arr[$k]['goods'] = _sqlselect($sql . " and o.id = '".$order['id']."' order by c.addtime,id");
        $total = _sqlselect($sql_total . " and o.id = '".$order['id']."'");
        Page::$arr[$k]['total'] = $total ? $total[0]['total'] / 100 : 0;
    }

    _c('title','订单管理');
    _c('order_state', $_['seller_order_status']);
    _tpl();
}

function __order_view(){
    global $_;
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
    $order['status'] = $_['seller_order_status'][$order['state']];

    _c('order', $order);
    _c('page', intval(_v(4)));
    _c('title','订单详细');
    _tpl();
}

function __order_ship(){
    global $_wrap;
    $webid=_session('webid');

    if (empty(_post('ship_name')) || empty(_post('ship_number'))) {
        _alerturl('请输入完整发货物流信息！', _u('//order_view/'.intval(_v(3)).'/'.intval(_v(4)).'/'));
    }

    $order = _sqlone('order', 'id='.intval(_v(3)));
    if (empty($order)) {
        _alerturl('订单不存在！', _u('//order/'.intval(_v(4)).'/'));
    }

    $sql = "select c.* from " . PRE . "cart as c inner join " . PRE . "ware as w on c.wid=w.id inner join " . PRE . "order as o on c.orderid=o.id where w.uid='".intval($webid)."'";
    $order['goods'] = _sqlselect($sql . " and o.id = '".$order['id']."'");
    if (empty($order['goods'])) {
        _alerturl('订单不存在！', _u('//order/'.intval(_v(4)).'/'));
    }

    $order['state'] = $order['goods'][0]['state'];
    $order['status'] = $_wrap['order_state'][$order['state']];

    if ($order['state'] <> '2') {
        _alerturl('订单当前状态不允许此操作！', _u('//order_view/'.intval(_v(3)).'/'.intval(_v(4)).'/'));
    } else {
        $ids = array();
        foreach ($order['goods'] as $goods) {
            if ($goods['state'] <> '2') continue;
            $ids[] = $goods['id'];
        }

        if ($ids) {
            if (_sqldo("update ".PRE."cart set state='3', express='"._escape(_post('ship_name'))."', expressid='".floatval(_post('ship_number'))."', ship_time='".time()."' where id in ('".join("','", $ids)."')")) {
                //$shiped = _sqlnum('cart', "orderid='".$order['id']."' and state='3'");
                $shiped = count($ids) + $order['ship_cates'];
                if ($shiped  == $order['cates']) {
                    _sqldo("update ".PRE."order set state='3', ship_cates='".$shiped."', ship_time='".time()."' where id='".$order['id']."'");
                } else {
                    _sqldo("update ".PRE."order set ship_cates='".$shiped."' where id='".$order['id']."'");
                }
                _alerturl('订单发货成功！', _u('//order_view/'.intval(_v(3))));
            } else {
                _alerturl('订单发货失败！', _u('//order_view/'.intval(_v(3))));
            }
        }
    }

    _alerturl('订单当前状态不允许此操作！', _u('//order_view/'.intval(_v(3))));
}

function __goods() {
    $uid=_session('webid');

    $p=_v(3);
    if(empty($p)){
        $p=0;
    }

    $s = !is_null(_post('search')) ? _post('search') : _session('seller_search_key');

    if (empty($s)) {
        _session('seller_search_key', null);
    } else {
        _session('seller_search_key', $s);
    }


    $sql = "uid='".intval($uid)."'";
    if (!empty($s)) {
        $sql .= " and (title like '%"._escape($s)."%' OR number like '%"._escape($s)."%')";
    }

    Page::start('ware', $p, $sql, 'id desc');

    _c('title', '商品管理');
    _c('search_key', $s);
    _tpl();
}

function __goods_add() {
    $uid=_session('webid');
    global $_;

    if (!is_null(_post('title'))) {
        $data = array();
        $data['uid'] = $uid;
        $data['uname'] = $_['member']['compony'] ? $_['member']['compony'] : $_['member']['name'];

        if (empty(_post('title'))) {
            _alerturl('请输入商品名称！', _u('////'._v(4).'/'));
        }
        $data['title'] = _post('title');

        $class = _sqlone('class', 'state=0 and pid>0 and id='.intval(_post('category')));
        if (empty($class)) {
            _alerturl('请选择商品分类！', _u('////'._v(4).'/'));
        }
        $data['class1'] = $class['pid'];
        $data['class1name'] = $class['pname'];
        $data['class2'] = $class['id'];
        $data['class2name'] = $class['title'];

        $data['number'] = _post('number');

        if (!is_numeric(_post('mark'))) {
            _alerturl('请输入正确的商品单价！', _u('////'._v(4).'/'));
        }
        $data['mark'] = _post('mark') * 100;

        if (!is_numeric(_post('stock'))) {
            _alerturl('请输入正确的商品库存！', _u('////'._v(4).'/'));
        }
        $data['stock'] = intval(_post('stock'));

        if (!is_file(DIR . _post('goods_image'))) {
            _alerturl('请输入至少上传第一张商品图片！', _u('////'._v(4).'/'));
        }
        $data['img'] = _post('goods_image');

        if (is_file(DIR . _post('goods_image1'))) $data['img1'] = _post('goods_image1');
        if (is_file(DIR . _post('goods_image2'))) $data['img2'] = _post('goods_image2');
        if (is_file(DIR . _post('goods_image3'))) $data['img3'] = _post('goods_image3');
        if (is_file(DIR . _post('goods_image4'))) $data['img4'] = _post('goods_image4');

        $data['state'] = intval(_post('state'));
        $data['content'] = _post('desc');
        $data['addtime'] = time();
        $data['uptime'] = time();

        if ($id = _sqlinsert('ware', $data)) {
            if (!empty(_post('attributes')) && is_array(_post('attributes'))) {
                //_sqldelete('attri_info','wid='.$id);
                $attributes = _post('attributes');
                ksort($attributes, 2);
                foreach ($attributes as $aid => $values) {
                    if ($attr = _sqlone('attri', 'id='.intval($aid))) {
                        foreach ($values as $value) {
                            $data=array();
                            $data['wid'] = $id;
                            $data['wname'] = $attr['title'];
                            $data['model'] = $value['name'];
                            $data['stock'] = intval($value['stock']);
                            _sqlinsert('attri_info', $data);
                        }
                    } elseif (!empty($custom_attr = _post('custom_attr')) && is_array($custom_attr) && isset($custom_attr[$aid])) {
                        foreach ($values as $value) {
                            $data=array();
                            $data['wid'] = $id;
                            $data['wname'] = $custom_attr[$aid];
                            $data['model'] = $value['name'];
                            $data['stock'] = intval($value['stock']);
                            _sqlinsert('attri_info', $data);
                        }
                    }
                }
            }

            if (!empty(_post('params')) && is_array(_post('params'))) {
                //_sqldelete('para_info','wid='.$id);
                foreach (_post('params') as $para) {
                    $data=array();
                    $data['wid'] = $id;
                    $data['wname'] = _post('title');
                    $data['paraname'] = $para['name'];
                    $data['value'] = $para['value'];
                    _sqlinsert('para_info', $data);
                }
            }
            _alerturl('商品发布成功！', _u('//goods/'._v(4).'/'));
            _weblogs('商品发布成功！'.$uid.' - '.$id);
        } else {
            _alerturl('商品发布失败！', _u('////'._v(4).'/'));
            _weblogs('商品发布失败！'.$uid);
        }
    }

    $categories = _sqlall('class', 'state=0 and pid=0', 'rank, id desc');
    foreach ($categories as $k => $category) {
        $children = _sqlall('class', 'state=0 and pid='.intval($category['id']), 'rank, id desc');
        $categories[$k]['children'] = $children;
    }

    _c('categories', $categories);
    _c('title', '发布商品');
    _c('goods', _sqlone('ware', 'id=-1'));
    _tpl('seller/goods_form');
}

function __goods_edit() {
    $uid=_session('webid');
    global $_;

    _c('goods', _sqlone('ware', 'uid='.intval($uid).' and id='.intval(_v(3))));

    if (empty($_['goods'])) _alerturl('商品不存在！', _u('//goods/'._v(4).'/'));

    if (!is_null(_post('title'))) {
        $data = array();

        if (empty(_post('title'))) {
            _alerturl('请输入商品名称！', _u('///'._v(3).'/'._v(4).'/'));
        }
        $data['title'] = _post('title');

        $class = _sqlone('class', 'state=0 and pid>0 and id='.intval(_post('category')));
        if (empty($class)) {
            _alerturl('请选择商品分类！', _u('///'._v(3).'/'._v(4).'/'));
        }
        $data['class1'] = $class['pid'];
        $data['class1name'] = $class['pname'];
        $data['class2'] = $class['id'];
        $data['class2name'] = $class['title'];

        $data['number'] = _post('number');

        if (!is_numeric(_post('mark'))) {
            _alerturl('请输入正确的商品单价！', _u('///'._v(3).'/'._v(4).'/'));
        }
        $data['mark'] = _post('mark') * 100;

        if (!is_numeric(_post('stock'))) {
            _alerturl('请输入正确的商品库存！', _u('///'._v(3).'/'._v(4).'/'));
        }
        $data['stock'] = intval(_post('stock'));

        if (!is_file(DIR . _post('goods_image'))) {
            _alerturl('请输入至少上传第一张商品图片！', _u('///'._v(3).'/'._v(4).'/'));
        }
        $data['img'] = _post('goods_image');

        if (is_file(DIR . _post('goods_image1'))) $data['img1'] = _post('goods_image1');
        if (is_file(DIR . _post('goods_image2'))) $data['img2'] = _post('goods_image2');
        if (is_file(DIR . _post('goods_image3'))) $data['img3'] = _post('goods_image3');
        if (is_file(DIR . _post('goods_image4'))) $data['img4'] = _post('goods_image4');

        $data['state'] = intval(_post('state'));
        $data['content'] = _post('desc');
        $data['uptime'] = time();

        if ($id = _sqlupdate('ware', $data, 'uid='.intval($uid).' and id='.intval(_v(3)))) {
            if (!empty(_post('attributes')) && is_array(_post('attributes'))) {
                _sqldelete('attri_info','wid='.intval(_v(3)));
                $attributes = _post('attributes');
                ksort($attributes, 2);
                foreach ($attributes as $aid => $values) {
                    if ($attr = _sqlone('attri', 'id='.intval($aid))) {
                        foreach ($values as $value) {
                            $data=array();
                            $data['wid'] = intval(_v(3));
                            $data['wname'] = $attr['title'];
                            $data['model'] = $value['name'];
                            $data['stock'] = intval($value['stock']);
                            _sqlinsert('attri_info', $data);
                        }
                    } elseif (!empty($custom_attr = _post('custom_attr')) && is_array($custom_attr) && isset($custom_attr[$aid])) {
                        foreach ($values as $value) {
                            $data=array();
                            $data['wid'] = intval(_v(3));
                            $data['wname'] = $custom_attr[$aid];
                            $data['model'] = $value['name'];
                            $data['stock'] = intval($value['stock']);
                            _sqlinsert('attri_info', $data);
                        }
                    }
                }
            }

            if (!empty(_post('params')) && is_array(_post('params'))) {
                _sqldelete('para_info','wid='.intval(_v(3)));
                foreach (_post('params') as $para) {
                    $data=array();
                    $data['wid'] = intval(_v(3));
                    $data['wname'] = _post('title');
                    $data['paraname'] = $para['name'];
                    $data['value'] = $para['value'];
                    _sqlinsert('para_info', $data);
                }
            }
            _alerturl('商品编辑成功！', _u('//goods/'._v(4).'/'));
            _weblogs('商品编辑成功！'.$uid.' - '.intval(_v(3)));
        } else {
            _alerturl('商品编辑失败！', _u('///'._v(3).'/'._v(4).'/'));
            _weblogs('商品编辑失败！'.$uid);
        }
    }

    $categories = _sqlall('class', 'state=0 and pid=0', 'rank, id desc');
    foreach ($categories as $k => $category) {
        $children = _sqlall('class', 'state=0 and pid='.intval($category['id']), 'rank, id desc');
        $categories[$k]['children'] = $children;
    }

    _c('categories', $categories);

    $_['goods']['attr'] = _sqlall('attri_info','wid='.intval(_v(3)).' order by id');
    $_['goods']['para'] = _sqlall('para_info','wid='.intval(_v(3)).' order by id');

    _c('title', '编辑商品');
    _tpl('seller/goods_form');
}

function __goods_mess() {
    $uid=_session('webid');
    $action = array('onsale' => 0, 'unsale' => 1);

    if (!array_key_exists(_post('mess_action'), $action)) {
        _alerturl('请选择正确的批量操作！', _u('//goods/'._v(3).'/'));
    }

    $goods = array();
    foreach (_post('checkbox') as $gid) {
        $goods[] = intval($gid);
    }
    if (empty($goods)) {
        _alerturl('请选择要批量操作的商品！', _u('//goods/'._v(3).'/'));
    }

    $data = array('state' => $action[_post('mess_action')], 'uptime' => time());
    if ($ids = _sqlupdate('ware', $data, 'uid='.intval($uid).' and state <> '.$data['state'].' and id in (\''.join("','", $goods).'\')')) {
        _alerturl('批量操作成功！', _u('//goods/'._v(3).'/'));
        _weblogs('批量操作成功！'.$uid.' - '._post('mess_action').'['.join(',', $goods).']');
    } else {
        _alerturl('批量操作失败！', _u('//goods/'._v(3).'/'));
        _weblogs('批量操作成功！'.$uid.' - '._post('mess_action').'['.join(',', $goods).']');
    }
}

?>