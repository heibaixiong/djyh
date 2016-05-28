<?php
if(!defined('PART'))exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <title><?php echo $_['config']['title'];?></title>
<?php
_css('aui');
_css('swiper.min');
_css('index');
_css('commons');
?>
</head>
<body>
<!--头部-->
<header class="aui-nav aui-bar aui-bar-nav aui-bar-dark" id="top_nav">
    <div class="aui-col-xs-2" style="width:18%;">
        <span class="aui-pull-left" style="padding-left: 5px;">
            <a class="index_fl"><img src="<?php echo _img('logo.png');?>"></a>
        </span>
    </div>
    <div class="aui-col-xs-8" style="width:62%">
        <div class="aui-searchbar" id="search">
            <form action="<?php echo _u('/shop/index/'); ?>" style="width:100%;">
                <input type="search" placeholder="请输入搜索内容" id="search-input">
                <a href="#" class="aui-iconfont aui-icon-search search_icon"></a>
            </form>
        </div>
    </div>
    <div class="aui-col-xs-2" style="width:20%;">
        <span class="aui-pull-right" style="padding-right:5px;padding-top:2px;">
            <a class="index_car good-search">搜索</a>
        </span>
    </div>
</header>
<div style="position: absolute;top: 50px;bottom: 55px;overflow-y: scroll;-webkit-overflow-scrolling: touch; width:100%; ">
    <!--轮播start-->
    <?php
        if(isset($_['flash']) && count($_['flash']) > 0) {
    ?>
    <div class="es-poster swiper-container">
        <div class="swiper-wrapper">
            <?php
            foreach ($_['flash'] as $k => $v) {
                echo '<div class="swiper-slide" ><a href="' . ($v['url'] ? _u('/index/ads/' . $v['id'] . '/') : '#') . '" ><img  src="' . _resize($v['img'], 640, 200) . '" /></a></div>';
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
        <?php foreach ($_['wx_index'] as $item) { ?>
            <!-- 推荐商品start -->
            <div class="aui-content">
                <p class="aui-text-center index_kx aui-border-b"><span><?php echo $item['title']; ?></span></p>
                <?php if (is_file(DIR.$item['img_ad_2'])) { ?>
                <!-- 推荐位广告start -->
                <p class="aui-text-center index_pro01"><a href="<?php echo empty($item['url_ad_2']) ? 'javascript:void(0);':$item['url_ad_2']; ?>"><img src="<?php echo is_file(DIR.$item['img_ad_2'])?_resize($item['img_ad_2'], 690, 364):_img('new/lou_pro03.png'); ?>"></a></p>
                <!-- 推荐位广告end -->
                <?php } ?>
                <!-- 商品列表start -->
                <?php
                foreach($item['goods_rec'] as $k => $v){
                    ?>

                    <div class="aui-content index_content">
                        <div class="aui-col-xs-5" >
                            <a href="<?php echo _u('/shop/show/'.$v['id']); ?>" class="index_pro02">
                                <img src="<?php echo _resize($v['img']); ?>" >
                                <?php if ($v['recommend'] == 1) { ?>
                                    <span>推荐<br>商品</span>
                                <?php } elseif ($v['hot'] == 1) { ?>
                                    <span>热门<br>商品</span>
                                <?php } ?>
                            </a>
                        </div>
                        <div class="aui-col-xs-7" >
                            <div class="index_bleft">
                                <p class="index_text01"><a href="<?php echo _u('/shop/show/'.$v['id']); ?>"><?php echo $v['title']; ?></a></p>
                                <p class="index_text02"><?php echo _left(strip_tags($v['content']), 0, 48, '...'); ?></p>
                                <p class="index_text03">￥<?php echo _rmb($v['mark']/100);?></p>
                                <div class="index_text04">
                                    <div class="idnex_gw" data-id="<?php echo $v['id']; ?>">加入购物车</div>
                                    <div class="index_pl">
                                        <span>好评<em><?php echo $v['sale']; ?></em>条</span>
                                        <span>已售<em><?php echo $v['sale']; ?></em>件</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                }
                ?>
                <!-- 商品列表end -->
                <?php
                foreach($item['goods_hot'] as $k => $v){
                    ?>

                    <div class="aui-content index_content">
                        <div class="aui-col-xs-5" >
                            <a href="<?php echo _u('/shop/show/'.$v['id']); ?>" class="index_pro02">
                                <img src="<?php echo _resize($v['img']); ?>" >
                                <span>热门<br>商品</span>
                            </a>
                        </div>
                        <div class="aui-col-xs-7" >
                            <div class="index_bleft">
                                <p class="index_text01"><a href="<?php echo _u('/shop/show/'.$v['id']); ?>"><?php echo $v['title']; ?></a></p>
                                <p class="index_text02"><?php echo _left(strip_tags($v['content']), 0, 48, '...'); ?></p>
                                <p class="index_text03">￥<?php echo _rmb($v['mark']/100);?></p>
                                <div class="index_text04">
                                    <div class="idnex_gw" data-id="<?php echo $v['id']; ?>">加入购物车</div>
                                    <div class="index_pl">
                                        <span>好评<em><?php echo $v['sale']; ?></em>条</span>
                                        <span>已售<em><?php echo $v['sale']; ?></em>件</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <!-- 推荐商品end -->
        <?php } ?>

        <div style="height: 60px;"></div>

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

    //购物车点击操作
    $(".idnex_gw").click(function(){
        var tag = is_login();
        if(tag === true){
            var id = parseInt($(this).attr('data-id'));
            var num = 1;
            //addCart(id, num, '');
            addCart({id:id, num:num, option:''}, function(data){
                alert(data.msg);
            });
        }
    });
    //goods search
    document.onkeydown = function(e){
        if(event.keyCode == 13){
            searchGoods();
        }
    }
</script>
</body>
</html>