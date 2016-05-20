<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
    <title><?php echo $_['title'];?></title>
    <?php
    _css('aui');
    _css('commons');
    ?>
</head>
<body>
<!-- 主体 -->
<div class="main-Body">
    <div class="main-content">
        <div class="main-body-w" style="margin:0 10px;">
            <div class="hBorder" style="color:#ff0000;text-align: center;line-height:100px;font-size:16px;">订单提交成功</div>
            <div id="orderTotalInfo" class="gross-price-js">
                <div class="fl gross-left">
                您的订单已成功提交！我们会尽快为您安排处理！
                </div>
                <?php if (isset($_['payment_data'])) { ?>
                <div class="fr gross-right" style="margin-top:20px;">
                    <div class="fl">
                        <p class="fl" style="line-height:30px;text-align:center;">总金额：<b class="red font18"><strong>￥90<?php echo _rmb($_['order']['total']); ?></strong></b></p>
                    </div>
                    <div style="background-color: #ff5656;height:30px;color:#fff;text-align: center;border-radius:3px;line-height:30px;">
                        <?php echo $_['payment_data']; ?>
                    </div>
                    <p class="fl" style="margin-top:30px;text-align: right;"><a class="return-btn" href="<?php echo _u('/person/order/');?>" id="btn-cart-wait">稍后支付</a></p>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- //主体 -->
<?php
_part('footer');
?>
</body>
</html>