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
    _css('store_zhifu');
    ?>
</head>

<body>
<!--头部-->
<header class="aui-nav aui-bar aui-bar-nav aui-bar-dark" id="top_nav">
    <a class="aui-pull-left" onclick="history.go(-1)">
        <span class="aui-iconfont aui-icon-left"></span>
    </a>
    <div class="aui-title">确认订单</div>
    <a class="aui-pull-right">
        <span></span>
    </a>
</header>
<div style="position: absolute;top: 50px;bottom: 55px;overflow-y: scroll;-webkit-overflow-scrolling: touch; width:100%; ">
    <!--main-->
    <div class="big_main">
        <form action="<?php echo _u('/cart/submit/'); ?>" method="post">
        <ul class="pay_box">
            <li>
                <div class=" pay_main" >
                    <div style="width:83.3%;overflow: hidden;float: left">
                        <a class="pay_yuan">送至</a>
                        <div class="pay_text">
                            <p class="pay_p01">
                                <?php
                                if($_['address'] && $_['address']['pro_n'] != '' && $_['address']['adr'] != ''){
                                    echo '<a href="'. _u('/person/addrlist') .'">'.$_['address']['pro_n'].$_['address']['cit_n'].$_['address']['cou_n'].$_['address']['adr'] . '</a>';
                                    $addr = 1;
                                }else{
                                    echo '<a href="'. _u('/person/addrlist/') .'">请选择收货地址</a>';
                                    $addr = 0;
                                }

                                ?>
                                <input type="hidden" name="address" value="<?php if($_['address']) echo $_['address']['id']; else echo 0; ?>" />
                            </p>
                            <p class="pay_p02">
                                <a><?php echo $_['address']['nam']; ?></a>
                                <a><?php echo $_['address']['phn']; ?></a>
                            </p>
                        </div>
                    </div>

                </div>
            </li>

        </ul>
        <!-- 订单信息-->
        <div class="aui-content" style="margin-top:15px;">
            <div class="aui-content order_content" >
                <div class="detail_home_lin01 aui-border-b"><a href="#">订单信息</a></div>
                <?php
                foreach($_['arr'] as $k => $v) {
                    ?>
                    <div class="index_content">
                        <div class="aui-col-xs-4">
                            <a href="#" class="index_pro02">
                                <img src="<?php echo _resize($v['img'], 210, 210); ?>" >
                            </a>
                        </div>
                        <div class="aui-col-xs-8">
                            <div class="index_bleft">
                                <p class="index_text01"><a href="#"><?php echo $v['wtitle']; ?></a></p>

                                <p class="index_text02">价格：<span style="color:#ff0000; ">￥<?php echo $v['mark']*$v['num']/100; ?></span></p>

                                <p class="index_text02">数量：<span><?php echo $v['num']; ?></span></p>

                                <p><input type="text" name="content[<?php echo $v['id']; ?>]" placeholder="给卖家留言" style="padding:2px;" /></p>
                                <input type="hidden" name="cart[<?php echo $v['id']; ?>]" value="<?php echo $v['id']; ?>" />
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <!--
                <div class="zf_pay aui-border-t">
                    运费：<em>0</em>
                </div>
                -->
            </div>
        </div>
        <div class="pay_zj">总价：<span>￥<?php echo $_['mark']/100; ?></span></div>
        <div class="pay_zf"><a>立即下单</a></div>
        </form>
    </div>
</div>
<!--footer-->
<?php
_part('footer');
?>
<div class="paybox" style="display: none;"></div>
<script>
$(".pay_zf").click(function(){
    var addr = parseInt($("input[name='address']").val());
    if(addr == 0){
        alert('请选择收货地址');
        return false;
    }
    console.log($("form").serialize());
    $("form").submit();
});
</script>
</body>
</html>
