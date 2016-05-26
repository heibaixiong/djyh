<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $_['title'];?></title>
    <?php
    _css('aui');
    _css('commons');
    ?>
    <style>
        body{background-color: #f9f9f9;}
        .state{margin:10px auto;font-size:14px;padding:0 10px;border-bottom:1px solid #eee;line-height:24px;font-size:12px;background-color: #fff;}
        .state p{font-size:12px;}
        .state span{color:#333;}
        .pay-form-btn{margin:15px 0;}
        .return-btn{background-color:#f03232;color:#fff;text-align: center;border-radius:3px;display: block;padding:5px 0;font-size:14px;}
        .back-btn{background-color: #f1f1f1;color:#666;display: block;text-align:center;padding:5px 0;border:1px solid #ccc;margin-top:15px;font-size:14px;}
        
        .detail{border-bottom:1px solid #eee;border-top:1px solid #eee;padding:10px;background-color: #fff;line-height:24px;}
        .detail p{font-size:12px;}
        .detail span{color:#333;}
    </style>
</head>
<body>
<div class="state">
    <p>订单状态：<span style="color:#3a94c8;"><?php echo $_['user_order_status'][$_['order']['state']]; ?></span></p>
    <p>订单编号：<span><?php echo $_['order']['id']; ?></span></p>
    <p>下单时间：<span><?php echo date('Y-m-d H:i:s', $_['order']['addtime']); ?></span></p>
    <div class="">
        <!-- <p class="fl pay-form-btn"><a class="return-btn" href="javascript:void(0);" onclick="callpay()" id="btn-cart-pay">立即支付</a></p> -->
        <?php echo $_['order']['payment_data']; ?>
        <p class="fl pay-form-btn"><a class="back-btn" href="<?php echo _u('/person/order/'); ?>">稍后支付</a></p>
    </div>

</div>

<div class="detail">
    <p>商品金额：<span style="color:#f00;;">￥<?php echo $_['order']['total']; ?></span></p>
    <p>收货地址：<span><?php echo $_['order']['pro_n'].$_['order']['cit_n'].$_['order']['cou_n'].$_['order']['adr']; ?></span></p>
    <p>收货人：<span><?php echo $_['order']['nam'] . ' '. $_['order']['phn']; ?></span></p>
</div>
</body>
</html>