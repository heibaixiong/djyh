<?php
if(!defined('PART'))exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="zh_cn">
    <meta charset="utf-8">
    <title><?php echo $_['title']; ?></title>
    <meta  content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <?php
    _js('jquery');
    _js('index');
    _css('base');
    _css('commons');
    _css('sale_order');
    ?>
</head>
<body>
<!-- 顶部-->
<div class="dev_top">
    <div class="dev_top_list">
        <a href="<?php echo _u('/ship/list/'); ?>">我要抢单</a>
    </div>
    <a class="dev_tittle">订单管理</a>
    <a href="<?php echo _u('/ship/list/'); ?>" class="dev_order">个人中心</a>
</div>
<!-- 内容-->
<div class="dev_main">
    <div class="sale_top_box">
        <a href="<?php echo _u('/order/manage/'); ?>"<?php if (strlen(_v(3)) == 0) echo ' class="current_cosiga"'; ?>>全部</a>
        <a href="<?php echo _u('/order/manage/2/'); ?>"<?php if (intval(_v(3)) == 2) echo ' class="current_cosiga"'; ?>><?php echo $_['seller_order_status']['2']; ?></a>
        <a href="<?php echo _u('/order/manage/3/'); ?>"<?php if (intval(_v(3)) == 3) echo ' class="current_cosiga"'; ?>><?php echo $_['seller_order_status']['3']; ?></a>
        <a href="<?php echo _u('/order/manage/4/'); ?>"<?php if (intval(_v(3)) == 4) echo ' class="current_cosiga"'; ?>><?php echo $_['seller_order_status']['4']; ?></a>
        <a href="<?php echo _u('/order/manage/12/'); ?>"<?php if (intval(_v(3)) == 12) echo ' class="current_cosiga"'; ?>><?php echo $_['seller_order_status']['12']; ?></a>
    </div>
    <div>
        <?php foreach (Page::$arr as $order) { ?>
            <ul class="sale_main_list">
                <li class="sale_lin01">
                    <a class="sale_lin01_in01" href="<?php echo _u('/order/detail/'.$order['id'].'/'._v(3).'/'.Page::$p.'/'); ?>">订单号：<em><?php echo str_repeat('0', 12-strlen($order['id'])).$order['id']; ?></em></a>
                    <span><?php echo $_['seller_order_status'][$order['status']]; ?></span>
                </li>
                <li class="sale_lin02">
                    <a class="sale_lin02_in01"><?php echo $order['ship_area'].$order['ship_address']; ?></a>
                    <!--<a class="sale_lin02_in02"><?php /*echo isset($order['distance']) ? $order['distance'].' Km' : ''; */?></a>-->
                    <a class="sale_lin02_in03"><?php echo _shortTime($order['mod_time']); ?></a>
                </li>
                <li class="sale_lin03">
                    <a class="sale_lin03_in01">发货人：<em><?php echo $order['ship_name']; ?></em></a>
                    <a class="sale_lin03_in02"><?php echo $order['ship_phone']; ?></a>
                </li>
                <li class="sale_lin04">
                    <a class="sale_lin03_in01">运费：<em>￥<?php echo _rmb($order['ship_amount']); ?></em></a>
                    <div class="sale_lin03_in02">
                        <?php if ($order['status'] == 2) { ?>
                            <a href="<?php echo _u('/order/cancel/'.$order['id'].'/'._v(3).'/'._v(4).'/'); ?>">放弃订单</a>
                            <a href="<?php echo _u('/order/detail/'.$order['id'].'/'._v(3).'/'._v(4).'/'); ?>">揽件</a>
                        <?php } ?>
                    </div>
                </li>
            </ul>
        <?php } ?>
        <ul class="sale_main_list" id="div-loading-more" style="display: none;">
            <li class="sale_lin01" style="text-align: center;">
                <a class="cosig_lin03_in01" style="width: 100%;">加载中...</a>
            </li>
        </ul>
    </div>

</div>

<script type="text/javascript">
    var page_now = <?php echo Page::$p; ?>;
    var page_i = 1;
    $(document).ready(function(){
        $(window).scroll(function(){
            if ($('#div-loading-more').hasClass('working')) return false;
            if (page_i >= <?php echo Page::$pnum; ?>) {
                $('#div-loading-more a').html('没有更多数据...');
                $('#div-loading-more').show();
                return false;
            }
            // document 文档高度
            var docHeight = $(document).height();//console.log('Dh: '+docHeight);

            // window 可视区高度
            var rollHeight = $(window).height();//console.log('Wh: '+rollHeight);

            //window 滚动条高度
            var scrHeight = $(window).scrollTop();//console.log('Sh: '+scrHeight);

            //如果内容区域 小于等于 可视区高度加滚动条的高度的话那么就进行加载...
            if (docHeight-50 <= (rollHeight+scrHeight)) {
                if (page_i == page_now) page_i++;
                console.log('loading page: '+page_i);
                $.ajax({
                    url: '<?php echo _u('/order/load/'._v(3).'/'); ?>'+page_i+'/',
                    type: 'get',
                    dataType: 'json',
                    data: '',
                    beforeSend: function() {
                        $('#div-loading-more').addClass('working');
                        $('#div-loading-more').show();
                    },
                    complete: function() {
                        $('#div-loading-more').removeClass('working');
                        $('#div-loading-more').hide();
                        page_i++;
                    },
                    success: function(res) {
                        var _html = '';
                        if (res.length > 0) {
                            for (var i=0; i<res.length; i++) {
                                _html += '<ul class="sale_main_list">';
                                _html += '    <li class="sale_lin01">';
                                _html += '        <a class="sale_lin01_in01" href="'+res[i]['url_view']+'">订单号：<em>'+res[i]['order_number']+'</em></a>';
                                _html += '        <span>'+res[i]['status_label']+'</span>';
                                _html += '    </li>';
                                _html += '    <li class="sale_lin02">';
                                _html += '        <a class="sale_lin02_in01">'+res[i]['ship_area']+res[i]['ship_address']+'</a>';
                                //_html += '        <a class="sale_lin02_in02">';
                                if (res[i]['distance']) {
                                    //_html += res[i]['distance']+' Km';
                                }
                                //_html += '        </a>';
                                _html += '        <a class="sale_lin02_in03">'+res[i]['short_time']+'</a>';
                                _html += '    </li>';
                                _html += '    <li class="sale_lin03">';
                                _html += '        <a class="sale_lin03_in01">发货人：<em>'+res[i]['ship_name']+'</em></a>';
                                _html += '    <a class="sale_lin03_in02">'+res[i]['ship_phone']+'</a>';
                                _html += '    </li>';
                                _html += '    <li class="sale_lin04">';
                                _html += '        <a class="sale_lin03_in01">运费：<em>￥'+res[i]['ship_amount_label']+'</em></a>';
                                _html += '        <div class="sale_lin03_in02">';
                                if (res[i]['status'] == 2) {
                                    _html += '            <a href="'+res[i]['url_cancel']+'">放弃订单</a>';
                                    _html += '            <a href="'+res[i]['url_view']+'">揽件</a>';
                                }
                                _html += '        </div>';
                                _html += '    </li>';
                                _html += '</ul>';
                            }
                        }

                        $('#div-loading-more').before(_html);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            };
        });
    });
</script>

</body>
</html>

