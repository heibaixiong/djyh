<?php
if(!defined('PART'))exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_['title'];?></title>
<?php
_css('aui');
_css('swiper.min');
_css('index');
_css('commons');
?>
</head>
<body>
<!--头部start-->
<header class="aui-nav aui-bar aui-bar-nav aui-bar-dark" id="top_nav">
    <div class="aui-col-xs-2" style="width:18%;">
        <span class="aui-pull-left" style="padding-left: 5px;">
           <span class="aui-iconfont aui-icon-left"></span>
        </span>
    </div>
    <div class="aui-col-xs-8" style="width:62%">
        <div class="aui-searchbar" id="search">
            <form style="width:100%;">
                <input type="search" placeholder="请输入搜索内容" id="search-input">
                <a href="#" class="aui-iconfont aui-icon-search search_icon" ></a>
            </form>
        </div>
    </div>
    <div class="aui-col-xs-2" style="width:20%;">
        <span class="aui-pull-right" style="padding-right:5px;padding-top:2px;">
            <a class="index_car" style="background:none;font-size:20px;color:#fff;">筛选</a>
        </span>
    </div>
</header>
<!--头部end-->

<div style="position: absolute;top: 50px;bottom: 55px;overflow-y: scroll;-webkit-overflow-scrolling: touch; width:100%; ">

    <!--轮播start-->
    <?php
    if(isset($_['flash']) && count($_['flash']) > 0) {
        ?>
        <div class="es-poster swiper-container">
            <div class="swiper-wrapper">
                <?php
                foreach ($_['flash'] as $k => $v) {
                    echo '<div class="swiper-slide" ><a href="' . ($v['url'] ? _u('/index/ads/' . $v['id'] . '/') : '#') . '" ><img  src="' . $v['img'] . '" /></a></div>';
                }
                ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <?php
    }
    ?>
    <!--轮播end-->

    <!--main-->
    <div class="big_main"  >
        <div class="aui-content">
            <p class="aui-text-center index_kx aui-border-b"><span>快消品</span></p>
            <p class="aui-text-center index_pro01"><a href="#"><img src="images/index_lou1.png"></a></p>
            <div class="aui-content index_content">
                <div class="aui-col-xs-5" >
                    <a href="#" class="index_pro02">
                        <img src="images/index_lou2.png" >
                        <span>推荐<br>商品</span>
                    </a>

                </div>
                <div class="aui-col-xs-7" >
                    <div class="index_bleft">
                        <p class="index_text01"><a href="#">老杨家正宗逍遥镇胡辣汤河南特产 麻辣味汤料70g*20袋</a></p>
                        <p class="index_text02">逍遥胡辣汤 河南特产 逍遥老杨家</p>
                        <p class="index_text03">￥39</p>
                        <div class="index_text04">
                            <div class="idnex_gw">加入购物车</div>
                            <div class="index_pl">
                                <span>好评<em>5000</em>条</span>
                                <span>已售<em>500</em>件</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="aui-content index_content">
                <div class="aui-col-xs-5" >
                    <a href="#" class="index_pro02">
                        <img src="images/index_lou2.png" >
                        <span>推荐<br>商品</span>
                    </a>

                </div>
                <div class="aui-col-xs-7" >
                    <div class="index_bleft">
                        <p class="index_text01"><a href="#">老杨家正宗逍遥镇胡辣汤河南特产 麻辣味汤料70g*20袋</a></p>
                        <p class="index_text02">逍遥胡辣汤 河南特产 逍遥老杨家</p>
                        <p class="index_text03">￥39</p>
                        <div class="index_text04">
                            <div class="idnex_gw">加入购物车</div>
                            <div class="index_pl">
                                <span>好评<em>5000</em>条</span>
                                <span>已售<em>500</em>件</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="aui-content index_content">
                <div class="aui-col-xs-5" >
                    <a href="#" class="index_pro02">
                        <img src="images/index_lou2.png" >
                        <span>推荐<br>商品</span>
                    </a>

                </div>
                <div class="aui-col-xs-7" >
                    <div class="index_bleft">
                        <p class="index_text01"><a href="#">老杨家正宗逍遥镇胡辣汤河南特产 麻辣味汤料70g*20袋</a></p>
                        <p class="index_text02">逍遥胡辣汤 河南特产 逍遥老杨家</p>
                        <p class="index_text03">￥39</p>
                        <div class="index_text04">
                            <div class="idnex_gw">加入购物车</div>
                            <div class="index_pl">
                                <span>好评<em>5000</em>条</span>
                                <span>已售<em>500</em>件</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="aui-content index_content">
                <div class="aui-col-xs-5" >
                    <a href="#" class="index_pro02">
                        <img src="images/index_lou2.png" >
                        <span>推荐<br>商品</span>
                    </a>

                </div>
                <div class="aui-col-xs-7" >
                    <div class="index_bleft">
                        <p class="index_text01"><a href="#">老杨家正宗逍遥镇胡辣汤河南特产 麻辣味汤料70g*20袋</a></p>
                        <p class="index_text02">逍遥胡辣汤 河南特产 逍遥老杨家</p>
                        <p class="index_text03">￥39</p>
                        <div class="index_text04">
                            <div class="idnex_gw">加入购物车</div>
                            <div class="index_pl">
                                <span>好评<em>5000</em>条</span>
                                <span>已售<em>500</em>件</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="aui-content">
            <p class="aui-text-center index_kx aui-border-b"><span>快消品</span></p>
            <p class="aui-text-center index_pro01"><a href="#"><img src="images/index_lou1.png"></a></p>
            <div class="aui-content index_content">
                <div class="aui-col-xs-5" >
                    <a href="#" class="index_pro02">
                        <img src="images/index_lou2.png" >
                        <span>推荐<br>商品</span>
                    </a>

                </div>
                <div class="aui-col-xs-7" >
                    <div class="index_bleft">
                        <p class="index_text01"><a href="#">老杨家正宗逍遥镇胡辣汤河南特产 麻辣味汤料70g*20袋</a></p>
                        <p class="index_text02">逍遥胡辣汤 河南特产 逍遥老杨家</p>
                        <p class="index_text03">￥39</p>
                        <div class="index_text04">
                            <div class="idnex_gw">加入购物车</div>
                            <div class="index_pl">
                                <span>好评<em>5000</em>条</span>
                                <span>已售<em>500</em>件</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="aui-content index_content">
                <div class="aui-col-xs-5" >
                    <a href="#" class="index_pro02">
                        <img src="images/index_lou2.png" >
                        <span>推荐<br>商品</span>
                    </a>

                </div>
                <div class="aui-col-xs-7" >
                    <div class="index_bleft">
                        <p class="index_text01"><a href="#">老杨家正宗逍遥镇胡辣汤河南特产 麻辣味汤料70g*20袋</a></p>
                        <p class="index_text02">逍遥胡辣汤 河南特产 逍遥老杨家</p>
                        <p class="index_text03">￥39</p>
                        <div class="index_text04">
                            <div class="idnex_gw">加入购物车</div>
                            <div class="index_pl">
                                <span>好评<em>5000</em>条</span>
                                <span>已售<em>500</em>件</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="aui-content index_content">
                <div class="aui-col-xs-5" >
                    <a href="#" class="index_pro02">
                        <img src="images/index_lou2.png" >
                        <span>推荐<br>商品</span>
                    </a>

                </div>
                <div class="aui-col-xs-7" >
                    <div class="index_bleft">
                        <p class="index_text01"><a href="#">老杨家正宗逍遥镇胡辣汤河南特产 麻辣味汤料70g*20袋</a></p>
                        <p class="index_text02">逍遥胡辣汤 河南特产 逍遥老杨家</p>
                        <p class="index_text03">￥39</p>
                        <div class="index_text04">
                            <div class="idnex_gw">加入购物车</div>
                            <div class="index_pl">
                                <span>好评<em>5000</em>条</span>
                                <span>已售<em>500</em>件</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="aui-content index_content">
                <div class="aui-col-xs-5" >
                    <a href="#" class="index_pro02">
                        <img src="images/index_lou2.png" >
                        <span>推荐<br>商品</span>
                    </a>

                </div>
                <div class="aui-col-xs-7" >
                    <div class="index_bleft">
                        <p class="index_text01"><a href="#">老杨家正宗逍遥镇胡辣汤河南特产 麻辣味汤料70g*20袋</a></p>
                        <p class="index_text02">逍遥胡辣汤 河南特产 逍遥老杨家</p>
                        <p class="index_text03">￥39</p>
                        <div class="index_text04">
                            <div class="idnex_gw">加入购物车</div>
                            <div class="index_pl">
                                <span>好评<em>5000</em>条</span>
                                <span>已售<em>500</em>件</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
_part('footer');
?>

<script>
    var mySwiper = new Swiper ('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        loop: true,
        autoplay: 3000,
        autoplayDisableOnInteraction: false
    })

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


</script>
</body>
</html>