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
    _css('my_index');
    ?>
</head>
<body>
<!-- 顶部-->
<div class="dev_top">
    <div class="dev_top_list">
        <a>郑州市</a>
    </div>
    <a class="dev_tittle">抢单列表</a>
    <a class="dev_order" href="<?php echo _u('/order/manage/'); ?>">管理订单</a>
</div>
<div class="dev_main">
    <div class="cot_top_box">
        <form action="<?php echo _u('/ship/list/'); ?>" method="post">
        <div class="cot_top_left">
            <input type="hidden" name="distance" value="<?php echo $_['distance_set']; ?>" />
            <a class="cot_top_in01 "><<?php echo $_['distance_set']; ?>km<span></span></a>
            <ul class="cot_top_in_list">
                <li data-distance="3"><a><3km</a></li>
                <li data-distance="5"><a><5km</a></li>
                <li data-distance="10"><a><10km</a></li>
                <li data-distance="20"><a><20km</a></li>
            </ul>
        </div>
        <div class="cot_top_center">
            <input type="text" name="keywords" value="<?php echo $_['keywords_set']; ?>" placeholder="地址关键字" />
            <a href="javascript:void(0);" onclick="$(this).closest('form').submit();">搜索</a>
        </div>
        <div class="cot_top_right">
            <a href="<?php echo $_['url_geo']; ?>" class="current_zd">定位</a>
            <a href="javascript:void(0);" onclick="$(this).closest('form').submit();">刷新</a>
        </div>
        <div style="clear: both;"></div>
        </form>
    </div>
    <div class="cot_main_box">
        <div class="cot_main_title">
            <a class="cot_tittle_01">发货地</a>
            <a class="cot_tittle_02"><span>距离</span></a>
            <a class="cot_tittle_04"><span>运费</span></a>
            <a class="cot_tittle_03"><span>时间</span></a>
        </div>
        <ul class="cot_list">
            <?php foreach ($_['orders'] as $k => $order) { ?>
                <li class="<?php echo $k%2==0?'w_bg':'c_bg'; ?>">
                    <a class="cot_list_lin01" href="<?php echo _u('/ship/rob/'.$order['id'].'/'); ?>"><?php echo $order['ship_area'].$order['ship_address']; ?></a>
                    <a class="cot_list_lin02"><?php echo round($order['distance']/100)/10; ?> Km</a>
                    <a class="cot_list_lin04">￥<?php echo _rmb($order['ship_amount']); ?></a>
                    <a class="cot_list_lin03"><?php echo $order['short_time']; ?></a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>
<!--弹出市-->
<div class="slide-mask"></div>
<div class="slide-wrapper" id="slide_top" >
    <ul class="slide_city">
        <li class="current_city ">郑州市</li>
        <li>洛阳市</li>
        <li>开封市</li>
        <li>许昌市</li>
        <li>平顶山市</li>
        <li>安阳市</li>
        <li>焦作市</li>
        <li>新乡市</li>
        <li>濮阳市</li>
        <li>驻马店市</li>
        <li>济源市</li>
        <li>漯河市</li>
        <li>商丘市</li>
        <li>周口市</li>
        <li>南阳市</li>
        <li>信阳市</li>
        <li>三门峡市</li>
        <li>鹤壁市</li>
    </ul>
    <div class="slide_city_bom">
        <div class="slide_city_pos">
            <a>当前选择城市：<span>郑州</span></a>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        if ($('.cot_top_right a.current_zd').length > 0) {
            $('.cot_top_right a.current_zd').first().trigger('click');
        } else {
            $('.cot_top_right a').first().trigger('click');
        }
    });
</script>

</body>
</html>

