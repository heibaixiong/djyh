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
    _css('cosig_order');
    ?>
</head>
<body>
<!-- 顶部-->
<div class="dev_top">
    <div class="dev_top_list">
        <a href="<?php echo _u('/ship/index/'); ?>">我要发货</a>
    </div>
    <a class="dev_tittle">我的订单</a>
    <a href="<?php echo _u('/ship/index/'); ?>" class="dev_order">个人中心</a>
</div>
<!-- 内容-->
<div class="dev_main">
    <div class="cosig_top_box">
        <a href="<?php echo _u('/order/list/'); ?>"<?php if (strlen(_v(3)) == 0) echo ' class="current_cosiga"'; ?>>全部</a>
        <a href="<?php echo _u('/order/list/1/'); ?>"<?php if (intval(_v(3)) == 1) echo ' class="current_cosiga"'; ?>><?php echo $_['user_order_status']['1']; ?></a>
        <a href="<?php echo _u('/order/list/2/'); ?>"<?php if (intval(_v(3)) == 2) echo ' class="current_cosiga"'; ?>><?php echo $_['user_order_status']['2']; ?></a>
        <a href="<?php echo _u('/order/list/3/'); ?>"<?php if (intval(_v(3)) == 3) echo ' class="current_cosiga"'; ?>><?php echo $_['user_order_status']['3']; ?></a>
        <a href="<?php echo _u('/order/list/4/'); ?>"<?php if (intval(_v(3)) == 4) echo ' class="current_cosiga"'; ?>><?php echo $_['user_order_status']['4']; ?></a>
        <a href="<?php echo _u('/order/list/12/'); ?>"<?php if (intval(_v(3)) == 12) echo ' class="current_cosiga"'; ?>><?php echo $_['user_order_status']['12']; ?></a>
        <a href="<?php echo _u('/order/list/0/'); ?>"<?php if (_v(3) == '0') echo ' class="current_cosiga"'; ?>><?php echo $_['user_order_status']['0']; ?></a>
    </div>
    <div>
        <?php foreach (Page::$arr as $order) { ?>
            <ul class="cosig_main_list">
                <li class="cosig_lin01">
                    <a class="cosig_lin01_in01"></a>
                    <a class="cosig_lin01_in02" href="<?php echo _u('/order/view/'.$order['id'].'/'._v(3).'/'.Page::$p.'/'); ?>">
                        [<?php echo $order['consignee_prov']; ?>/<?php echo $order['consignee_city']; ?>]
                        <span style="padding-left: 10px;"><?php echo $order['consignee_name']; ?></span>
                    </a>
                    <span><?php echo $_['user_order_status'][$order['status']]; ?></span>
                </li>
                <li class="cosig_lin02">
                    <?php if (is_file(DIR.$order['ship_image'])) { ?>
                    <a class="cosig_lin02_in01" href="<?php echo _u('/order/view/'.$order['id'].'/'._v(3).'/'.Page::$p.'/'); ?>">
                        <img src="<?php echo _resize($order['ship_image'], 175, 175); ?>" />
                    </a>
                    <?php } ?>
                    <div class="cosig_lin02_in02">
                        <p class="cosig_pro_title">
                            <a href="<?php echo _u('/order/view/'.$order['id'].'/'._v(3).'/'.Page::$p.'/'); ?>">
                                <?php echo $order['ship_desc']; ?>
                            </a>
                        </p>
                        <p class="cosig_pro_txt">
                            <a class="cosig_pro_sl">数量：<span><?php echo $order['ship_quantity']; ?>件</span></a>
                            <a class="cosig_pro_yf">运费：<span>￥<?php echo _rmb($order['ship_amount']); ?></span></a>
                        </p>
                    </div>
                </li>
                <?php if (strlen($order['ship_status']) > 0) { ?>
                <li class="cosig_lin03">
                    <a class="cosig_lin03_in01" href="<?php echo _u('/order/ship/'.$order['id'].'/'._v(3).'/'._v(4).'/'); ?>">物流动态：发往->[<?php echo $order['ship_states']['prov_e'].'/'.$order['ship_states']['city_e'].'/'.$order['ship_states']['area_e']; ?>]</a>
                    <span class="cosig_lin03_in02"><?php echo $_['stowage_status'][$order['ship_status']]?></span>
                </li>
                <?php } ?>
                <li class="cosig_lin04">
                    <div class="cosig_lin04_in01">
                        <?php if ($order['status'] > 0 && $order['status'] < 3) { ?>
                            <a href="<?php echo _u('/ship/cancel/'.$order['id'].'/'._v(3).'/'._v(4).'/'); ?>">取消订单</a>
                            <a href="<?php echo _u('/ship/edit/'.$order['id'].'/'._v(3).'/'._v(4).'/'); ?>">修改订单</a>
                        <?php } ?>
                        <?php if ($order['status'] == 4) { ?>
                            <a href="<?php echo _u('/ship/complete/'.$order['id'].'/'._v(3).'/'._v(4).'/'); ?>">确认收货</a>
                        <?php } ?>
                    </div>
                </li>
            </ul>
        <?php } ?>
        <ul class="cosig_main_list" id="div-loading-more" style="display: none;">
            <li class="cosig_lin03" style="text-align: center;">
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
                    url: '<?php echo _u('/order/more/'._v(3).'/'); ?>'+page_i+'/',
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
                                _html += '<ul class="cosig_main_list">';
                                _html += '    <li class="cosig_lin01">';
                                _html += '        <a class="cosig_lin01_in01"></a>';
                                _html += '        <a class="cosig_lin01_in02" href="'+res[i]['url_view']+'">';
                                _html += '['+res[i]['consignee_prov']+'/'+res[i]['consignee_city']+']';
                                _html += '<span style="padding-left: 10px;">'+res[i]['consignee_name']+'</span>';
                                _html += '        </a>';
                                _html += '        <span>'+res[i]['status_label']+'</span>';
                                _html += '    </li>';
                                _html += '    <li class="cosig_lin02">';
                                if (res[i]['ship_thumb'] != '') {
                                    _html += '        <a class="cosig_lin02_in01" href="'+res[i]['url_view']+'"><img src="'+res[i]['ship_thumb']+'" /></a>';
                                }
                                _html += '<div class="cosig_lin02_in02">';
                                _html += '    <p class="cosig_pro_title">';
                                _html += '        <a href="'+res[i]['url_view']+'">';
                                _html += '            '+res[i]['ship_desc'];
                                _html += '        </a>';
                                _html += '    </p>';
                                _html += '    <p class="cosig_pro_txt">';
                                _html += '        <a class="cosig_pro_sl">数量：<span>'+res[i]['ship_quantity']+'件</span></a>';
                                _html += '        <a class="cosig_pro_yf">运费：<span>￥'+res[i]['ship_amount_label']+'</span></a>';
                                _html += '    </p>'
                                _html += '</div>'
                                _html += '    </li>';
                                if (res[i]['ship_status'] != '') {
                                    _html += '    <li class="cosig_lin03">';
                                    _html += '        <a  class="cosig_lin03_in01">物流动态：发往->['+res[i]['ship_states']['prov_e']+'/'+res[i]['ship_states']['city_e']+'/'+res[i]['ship_states']['area_e']+']</a>';
                                    _html += '        <span class="cosig_lin03_in02">'+res[i]['ship_states_label']+'</span>';
                                    _html += '    </li>';
                                }
                                _html += '    <li class="cosig_lin04">';
                                _html += '        <div class="cosig_lin04_in01">';
                                if (res[i]['status'] > 0 && res[i]['status'] < 3) {
                                    _html += '            <a href="'+res[i]['url_cancel']+'">取消订单</a>';
                                    _html += '            <a href="'+res[i]['url_edit']+'">修改订单</a>';
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

