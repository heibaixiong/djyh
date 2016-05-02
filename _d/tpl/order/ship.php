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
    _css('base');
    _css('commons');
    _css('order_detail');
    ?>
</head>
<body>
<!-- 顶部-->
<div class="dev_top">
    <div class="dev_top_list">
        <a href="<?php echo _u('/order/list/'._v(4).'/'._v(5).'/'); ?>"></a>
    </div>
    <a class="dev_tittle">物流跟踪</a>
    <a href="<?php echo _u('/ship/index/'); ?>" class="dev_order">我要发货</a>
</div>
<div class="dev_main">
    <div class="order_top_box">
        <div class="order_top_in">
            <?php if (strlen($_['ship_order']['ship_status']) > 0) { ?>
            <p class="order_top_tex01">【<?php echo $_['stowage_status'][$_['ship_order']['ship_status']]; ?>】<?php echo $_['ship_order']['ship_states'][0]['prov_e'].'/'.$_['ship_order']['ship_states'][0]['city_e'].'/'.$_['ship_order']['ship_states'][0]['area_e']; ?></p>
            <p class="order_top_tex02"><a><?php echo date('Y-m-d', $_['ship_order']['ship_states'][0]['mod_time']); ?> </a><a style="margin-left:0.51rem;"><?php echo date('H:m:s', $_['ship_order']['ship_states'][0]['mod_time']); ?></a> </p>
            <?php } ?>
        </div>
    </div>
    <div class="order_top_box02">
        <div class="order_top_in02">
            <p class="order_top_tex03"><a class="order_top_t01">收货人：<?php echo $_['ship_order']['consignee_name']; ?></a><a class="order_top_t02"><?php echo $_['ship_order']['consignee_phone']; ?></a></p>
            <p class="order_top_tex04">收货地址：</p>
            <p class="order_top_tex05"><?php echo $_['ship_order']['consignee_prov'].$_['ship_order']['consignee_city'].$_['ship_order']['consignee_area'].$_['ship_order']['consignee_address']; ?></p>
        </div>
    </div>
    <div>
        <ul class="cosig_main_list">
            <li class="cosig_lin01">
                <a class="cosig_lin01_in01"></a>
                <a class="cosig_lin01_in02"><?php echo $_['ship_order']['consignee_name']; ?></a>
            </li>
            <li class="cosig_lin02">
                <?php
                if (!empty($_['ship_order']['ship_image']) && is_file(DIR.$_['ship_order']['ship_image'])) echo '<a class="cosig_lin02_in01"><img src="'._resize($_['ship_order']['ship_image'], 151, 151).'"></a>';
                ?>
                <div class="cosig_lin02_in02">
                    <p class="cosig_pro_title"><a><?php echo $_['ship_order']['ship_desc']; ?></a></p>
                    <p class="cosig_pro_txt">
                        <a class="cosig_pro_sl">数量：<span><?php echo $_['ship_order']['ship_quantity']; ?>件</span></a>
                        <a class="cosig_pro_yf">运费：<span>￥<?php echo _rmb($_['ship_order']['ship_amount']); ?></span></a>
                    </p>
                </div>
            </li>
            <li class="order_lin01">
                <p>订单编号：<em><?php echo str_repeat('0', 12-strlen($_['ship_order']['id'])).$_['ship_order']['id']; ?></em></p>
                <p>物流单号：<em><?php echo $_['ship_order']['ship_number']; ?></em></p>
                <p>下单时间：<em><?php echo _time($_['ship_order']['mod_time']); ?></em></p>
                <p>发货时间：<em><?php echo _time($_['ship_order']['ship_time']); ?></em></p>
            </li>
        </ul>
        <div class="order_wl_list" >
            <p class="order_wl_title"><a >物流信息</a></p>
            <div class="order_big_box" >
                <ul style="position: relative;">
                    <?php foreach ($_['ship_order']['ship_states'] as $k => $state) { ?>
                    <li class="order_wl_box">
                        <p class="order_wl_time"><a><?php echo date('Y-m-d', $state['mod_time']); ?></a></p>
                        <div class="order_wl_time02">
                            <p class="clearFloat<?php if ($k==0) echo ' current_zp'; ?>"><a class="wl_time02_in01"><?php echo date('H:m:s', $state['mod_time']); ?></a><a class="wl_time02_in02">发往：<?php echo $state['prov_e'].'/'.$state['city_e'].'/'.$state['area_e']; ?></a><span></span></p>
                            <p class="clearFloat"><a class="wl_time02_in01"><?php echo date('H:m:s', $state['add_time']); ?></a><a class="wl_time02_in02">上一站：<?php echo $state['prov_s'].'/'.$state['city_s'].'/'.$state['area_s']; ?></a><span></span></p>
                        </div>
                    </li>
                    <?php } ?>
                    <li class="order_wl_box">
                        <p class="order_wl_time"><a><?php echo date('Y-m-d', $_['ship_order']['rob_time']); ?></a></p>
                        <div class="order_wl_time02">
                            <p class="clearFloat"><a class="wl_time02_in01"><?php echo date('H:m:s', $_['ship_order']['rob_time']); ?></a><a class="wl_time02_in02"><?php echo $_['ship_order']['rob_name']; ?> 已揽件</a><span></span></p>
                        </div>
                    </li>
                    <div style="width:1px; height: 100%;position: absolute;border-left: dashed 1px #818182;left:-1.15rem;margin-top:1rem;"></div>
                    <div style="width:1px; height: 1.2rem;position: absolute;border-left: solid 1px #fff;left:-1.15rem;bottom:0;"> </div>
                </ul>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

</script>
</body>
</html>

