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
    _css('my_car');
    ?>
</head>
<body>
<!-- 头部start -->
<header class="aui-nav aui-bar aui-bar-nav aui-bar-dark" id="top_nav">
    <div class="aui-col-xs-2" onclick="history.go(-1)">
        <span class="aui-pull-left" style="padding-left: 5px;">
           <span class="aui-iconfont aui-icon-left"></span>
        </span>
    </div>
    <div class="aui-col-xs-8" style="text-align: center;width:62%;">
        <a class="car_icon01" style="">购物车</a>
    </div>
    <div class="aui-col-xs-2" style="width:20%;">
        <span class="aui-pull-right" style="padding-right:5px;padding-top:2px;">
             <a href="#" class="index_car">编辑</a>
        </span>
    </div>
</header>
<div>
<!-- 头部end -->

<div style="position: absolute;top: 50px;bottom: 55px;overflow-y: scroll;-webkit-overflow-scrolling: touch; width:100%; ">
    <!--main-->
    <div class="big_main">
        <div class="aui-content">

            <!-- 购物车商品列表start -->
            <?php
            foreach($_['arr'] as $k => $v){
            ?>
            <div class="aui-content order_content" >
                <div class="detail_home_lin01"><a href="#"><?php echo $v['company']; ?></a></div>
                <div class="index_content">
                    <div class="aui-col-xs-4" >
                        <a href="#" class="index_pro02">
                            <img src="<?php echo _resize($v['img'], 210, 210); ?>" >
                        </a>

                    </div>
                    <div class="aui-col-xs-8" >
                        <div class="index_bleft">
                            <p class="index_text01"><a href="#"><?php echo $v['wtitle']; ?></a></p>
                            <p class="index_text02"><?php echo $v['class1name']; ?></p>
                            <div class="index_text03">
                                <a>￥<?php echo _rmb($v['mark']/100);?></a>
                                <div class="detail_sl">
                                    <span class="detail_jian"></span>
                                    <input type="text" value="<?php echo $v['num']; ?>">
                                    <span class="detail_jia"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
                <!-- 购物车商品列表end -->

                <ul class="order_linbox">
                    <li class="order_lin01">
                        <a>应付：<em>￥<?php echo _rmb($_['mark']/100);?></em></a>
                        <a>已选<em><?php echo $_['num']; ?></em>件商品</a>
                    </li>

                </ul>
            </div>
        </div>
        <div class="car_bom">
            <a class="car_bom_qx">全选</a>
            <div class="car_bom_rig">
                <a>合计：<em>￥<?php echo _rmb($_['mark']/100);?></em></a>
                <a href="<?php echo _u('/cart/submit/'); ?>">结算(<em><?php echo $_['num']; ?></em>件)</a>
            </div>
        </div>
    </div>
</div>

<?php
_part('footer');
?>
<script>

    var arr_old_bgp = ["footer_icon01","footer_icon02","footer_icon03","footer_icon04"],
        arr_new_bgp = ["footer_bh01","footer_bh02","footer_bh03",'footer_bh04',];
    $('.aui-bar-tab li').click(function(){
        var guide =$(this).index();
        var $this = $(this),
            index = $this.index();
        $this.parent().find('li').each(function(i,e){
            $(this).find('span').removeClass(arr_new_bgp[i]);
        });
        $(this).find('span').addClass(arr_new_bgp[index]).siblings("p").css("color","#ff0000").parents("li").siblings("li").find("span").removeClass(arr_new_bgp[index]).siblings("p").css("color","#3c3c3c");
    });
    // 单独店铺全选 取消全选
    $(".detail_home_lin01 ").click(function(){
        if($(this).find("a").hasClass("select_true") == true){

            $(this).find("a").removeClass("select_true");
            $(this).siblings(".index_content").find(".index_pro02").removeClass("select_true");
        }else{
            $(this).find("a").addClass("select_true");
            $(this).siblings(".index_content").find(".index_pro02").addClass("select_true");
        }

    })
    // 单个商品的选择
    $(".index_pro02").click(function(){

        if($(this).hasClass("select_true") == true){

            $(this).removeClass("select_true");
        }else{
            $(this).addClass("select_true");
        }
    })
    // 全选 取消全选
    $(".car_bom_qx").click(function(){
        if($(this).hasClass("select_true") == true){
            $(this).removeClass("select_true");
            $(".detail_home_lin01 a").removeClass("select_true");
            $(".index_pro02").removeClass("select_true");
        }else{
            $(this).addClass("select_true");
            $(".detail_home_lin01 a").addClass("select_true");
            $(".index_pro02").addClass("select_true");
        }

    });
</script>
</body>
</html>
