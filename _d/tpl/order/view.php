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
    _css('rob_page');
    ?>
</head>
<body>
<!-- 顶部-->
<div class="dev_top">
    <div class="dev_top_list">
        <a href="<?php echo _u('/order/list/'._v(4).'/'._v(5).'/'); ?>"></a>
    </div>
    <a class="dev_tittle">查看订单</a>
    <a href="<?php echo _u('/ship/index/'); ?>" class="dev_order">我要发货</a>
</div>
<div class="dev_main">

    <!--发货地址-->
    <ul class="dev_ares_box">
        <li class="dev_ares_lin01">
            <a class="dev_lin01_in01 textellipsis">
                <?php
                if (!empty($_['ship_order']['ship_prov'])) echo $_['ship_order']['ship_prov'];
                if (!empty($_['ship_order']['ship_city'])) echo '/'.$_['ship_order']['ship_city'];
                if (!empty($_['ship_order']['ship_area'])) echo '/'.$_['ship_order']['ship_area'];
                ?>
            </a>
        </li>
        <li class="dev_ares_lin01 dev_ares_lin02">
            <a class="dev_lin02_in01"><input type="text"  value="<?php echo $_['ship_order']['ship_address']; ?>" readonly></a>
        </li>
        <li class="dev_ares_lin03">
            <a class="dev_lin03_in01"><input type="text"  value="<?php echo $_['ship_order']['ship_name']; ?>" readonly></a>
            <a class="dev_lin03_in02"><input type="text"  value="<?php echo $_['ship_order']['ship_phone']; ?>" readonly></a>
        </li>
        <li class="dev_ares_lin01 dev_ares_lin04">
            <a class="dev_lin04_in01 textellipsis">
                <?php
                if (!empty($_['ship_order']['consignee_prov'])) echo $_['ship_order']['consignee_prov'];
                if (!empty($_['ship_order']['consignee_city'])) echo '/'.$_['ship_order']['consignee_city'];
                if (!empty($_['ship_order']['consignee_area'])) echo '/'.$_['ship_order']['consignee_area'];
                ?>
            </a>
        </li>
        <li class="dev_ares_lin01 dev_ares_lin05">
            <a class="dev_lin05_in01"><input type="text"  value="<?php echo $_['ship_order']['consignee_address']; ?>" readonly></a>
        </li>
        <li class="dev_ares_lin03 dev_ares_lin06">
            <a class="dev_lin03_in01 dev_lin06_in01"><input type="text"  value="<?php echo $_['ship_order']['consignee_name']; ?>" readonly></a>
            <a class="dev_lin03_in02 dev_lin06_in02"><input type="text"  value="<?php echo $_['ship_order']['consignee_phone']; ?>" readonly></a>
        </li>
        <li class="dev_ares_lin07">
            <div class="dev_lin07_in01">
                <div class="dev_weight">
                    <a>重量</a>
                    <input type="text" value="<?php echo $_['ship_order']['ship_weight']; ?>(kg)" readonly>
                </div>
                <div class="dev_volume">
                    <a>体积</a>
                    <input type="text" value="<?php echo $_['ship_order']['ship_cubic']; ?>(m³)" readonly>
                </div>
                <div class="dev_volume">
                    <a>数量</a>
                    <input type="text" value="<?php echo $_['ship_order']['ship_quantity']; ?>件" readonly />
                </div>
                <div class="dev_volume">
                    <a>内容</a>
                    <input type="text" value="<?php echo $_['ship_order']['ship_desc']; ?>" readonly />
                </div>
            </div>
        </li>
        <li class="dev_ares_lin08">
            <div class="dev_lin08_in01">
                <a class="dev_photo">照片</a>
                <div class="dev_add_photo">
                    <?php
                    if (!empty($_['ship_order']['ship_image']) && is_file(DIR.$_['ship_order']['ship_image'])) echo '<a><img src="'._resize($_['ship_order']['ship_image'], 151, 151).'"></a>';
                    if (!empty($_['ship_order']['ship_image1']) && is_file(DIR.$_['ship_order']['ship_image1'])) echo '<a><img src="'._resize($_['ship_order']['ship_image1'], 151, 151).'"></a>';
                    if (!empty($_['ship_order']['ship_image2']) && is_file(DIR.$_['ship_order']['ship_image2'])) echo '<a><img src="'._resize($_['ship_order']['ship_image2'], 151, 151).'"></a>';
                    ?>
                </div>
            </div>
        </li>
        <li class="dev_ares_lin09">
            <div class="dev_lin09_in01">
                <div class="dev_pay">
                    <p class="dev_pay_set">付款方式</p>
                    <div class="dev_selt">
                        <?php if ($_['ship_order']['pay_method'] == 'cash') { ?>
                            <p class="current_p"><a>现付</a><span>（现金/网银）</span><i class="dev_dui"></i></p>
                            <p class="no_currentp" style="float: right"><a>到付</a><span>（现金/网银）</span><i></i></p>
                        <?php } else { ?>
                            <p class="no_currentp"><a>现付</a><span>（现金/网银）</span><i></i></p>
                            <p class="current_p" style="float: right"><a>到付</a><span>（现金/网银）</span><i class="dev_dui"></i></p>
                        <?php } ?>
                    </div>
                </div>
                <div class="dev_pay02">
                    <p class="dev_pay_set">代收货款</p>
                    <div class="dev_selt">
                        <?php if ($_['ship_order']['ship_cod'] > 0) { ?>
                            <p class="current_p"><a>是</a><span>（小哥收款）</span><i class="dev_dui"></i></p>
                            <p class="no_currentp" style="float: right"><a>否</a><span>（其他转账）</span><i></i></p>
                        <?php } else { ?>
                            <p class="no_currentp"><a>是</a><span>（小哥收款）</span><i></i></p>
                            <p class="current_p" style="float: right"><a>否</a><span>（其他转账）</span><i class="dev_dui"></i></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="dev_pay03">
                <p class="dev_pay_set02"><a>运费出价</a></p>
                <div class="dev_selt02">
                    <input type="text" value="￥<?php echo _rmb($_['ship_order']['ship_amount']); ?>" readonly>
                </div>
            </div>
        </li>
        <li class="dev_ares_lin10">
            <div class="dev_lin10_in01">
                <a>备注</a>
            </div>
            <input type="text" value="<?php echo $_['ship_order']['ship_note']; ?>" readonly>
            <?php if ($_['ship_order']['status'] > 2) { ?>
                <div class="dev_lin10_in01">
                    <a>运单号</a>
                </div>
                <input type="text" value="<?php echo $_['ship_order']['ship_number']; ?>" readonly />
            <?php } ?>
        </li>
    </ul>
</div>
<script type="text/javascript">

</script>
</body>
</html>

