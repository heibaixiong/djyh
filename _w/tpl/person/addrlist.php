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
    _css('store_pay');
    ?>
</head>

<body>
<!--头部-->
<header class="aui-nav aui-bar aui-bar-nav aui-bar-dark" id="top_nav">
    <a class="aui-pull-left">
        <span class="aui-iconfont aui-icon-left"></span>
    </a>
    <div class="aui-title">确认支付</div>
    <a class="aui-pull-right confirm_addr">
        <span>确认</span>
    </a>
</header>
<div style="position: absolute;top: 50px;bottom: 55px;overflow-y: scroll;-webkit-overflow-scrolling: touch; width:100%; ">

    <!--main-->
    <div class="big_main">
        <ul class="pay_box">
            <?php
            foreach($_['address'] as $k => $v) {
                ?>
                <li>
                    <div class="aui-border-b pay_main">
                        <div style="width:83.3%;overflow: hidden;float: left">
                            <a class="pay_yuan <?php if($v['def'] == 1) echo 'current_a' ?>"><span></span></a>

                            <div class="pay_text">
                                <p class="pay_p01"><?php echo $v['pro_n'].$v['cit_n'].$v['cou_n'].$v['adr']; ?></p>

                                <p class="pay_p02">
                                    <a><?php echo $v['nam']; ?></a>
                                    <a><?php echo $v['phn']; ?></a>
                                </p>
                            </div>
                        </div>
                        <div class="right_wrapper" data-id="<?php echo $v['id']; ?>">删除</div>
                    </div>
                    <input type="radio" name="def" value="<?php echo $v['id']; ?>" <?php if($v['def'] == 1) echo 'checked'; ?> style="display: none;" />
                </li>
                <?php
            }
            ?>
        </ul>
        <div class="pay_add aui-border-b"><a href="<?php echo _u('/person/address/0/'); ?>">新增收货地址</a></div>

    </div>
</div>

<?php
_part('footer');
_js('jquery.mobile.custom.min');
?>
<script>
    // 选择
    $('.pay_box').find('li').bind('tap',function(){
        $(this).find('.pay_yuan').addClass('current_a').parents('li').siblings('li').find('.pay_yuan').removeClass('current_a');
        $(this).find("input").click();
    })


    /*手势操作*/
    var moveW=parseInt($('.right_wrapper').eq(0).css('width'));

    /*遍历每个聊天对话*/
    $('.pay_box li').each(function()
    {
        /*向左滑动时*/
        $(this).on('swipeleft',function()
        {
            $(this).animate({
                'left':-moveW+'px'
            },100);


            /*向右滑动时*/
            $(this).on('swiperight',function()
            {
                $(this).animate({
                    'left':0+'px'
                },100)
            })
        })
    })

    //delete address
    $(".right_wrapper").click(function(){
        var id = $(this).attr("data-id");
        $.post("<?php echo _u('/person/addrdel'); ?>", {id:id}, function(data){
            location.reload();
        });
    });

    //set default addr
    $(".confirm_addr").click(function(){
        var id = $("input[name='def']:checked").val();
        $.post("<?php echo _u('/person/addrdef'); ?>", {id:id}, function(data){
            history.go(-1);
        });
    });
</script>
</body>
</html>
