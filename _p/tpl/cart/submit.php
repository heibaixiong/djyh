<?php
if(!defined('PART'))exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_['title'];?></title>
<?php
_css('default');
_css('v1.0');
_css('style');
_jq();
?>
</head>
<body>
<?php
_part('top');
_part('head');
_part('nav');
?>
<!-- 主体 -->
<div class="main-Body">
    <div class="main-content">
        <div class="main-body-w">
            <h4 class="hBorder">订单提交成功</span>
                <div class="progress-jhd3"></div>
            </h4>
            <div id="orderTotalInfo" class="gross-price-js">
                <div class="fl gross-left">
                您的订单已成功提交！我们会尽快为您安排处理！
                </div>
                <?php if (isset($_['payment_data'])) { ?>
                <div class="fr gross-right">
                    <div class="fl">
                        <p class="fl">总金额：<b class="red font18"><strong>￥<?php echo _rmb($_['order']['total']); ?></strong></b></p>
                    </div>
                    <?php echo $_['payment_data']; ?>
                    <p class="fl"><a class="return-btn" href="<?php echo _u('/cart/checkout/');?>" id="btn-cart-wait">稍后支付</a></p>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- //主体 -->
<?php
_part('footer1');
_part('footer2');
_part('footer3');
?>
</body>
</html>