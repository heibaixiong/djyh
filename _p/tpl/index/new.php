<?php
if(!defined('PART'))exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="zh_cn">
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $_['config']['title'];?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <?php
    _css('bootstrap.min');
    _css('index');
    _css('iphone');
    _css('base');
    _js('jquery');
    _js('bootstrap.min');
    _js('jquery.SuperSlide.2.1');
    _js('index');
    ?>
</head>
<body>
<?php
_part('top_new');
?>

<!--轮播-->
<div id="myCarousel" class="carousel slide">
    <div class="container visible-lg" style="height:599px;position:absolute;width:1200px;left:50%;margin-left:-600px;">
        <div class="row" >
            <div class="banner_sz">
                <?php $i=0; ?>
                <?php foreach($_['indexad']['index_top_1'] as $k => $ad) { ?>
                    <?php if (!is_file(DIR.$ad['img'])) continue; ?>
                    <?php if ($i > 2) break; ?>
                    <a href="<?php echo $ad['url']?$ad['url']:'javascript:void(0);'; ?>" ><img src="<?php echo _resize($ad['img'], 238, 140); ?>"></a>
                    <?php $i++; ?>
                <?php } ?>
            </div>
            <div class="banner_sy_bg">
                <div class="banner_sy" style="min-height: 440px;">
                    <div class="banner_sy_top">
                        <a>新闻公告</a>
                        <a href="<?php echo _u('/news/index/'); ?>" class="banner_sy_mor">更多</a>
                    </div>
                    <ul class="banner_sy_box">
                        <?php
                        foreach ($_['article'] as $value) {
                            echo '<li><a href="'._u('/news/show/'.$value['id'].'/').'"><span>[公告]</span>'.$value['title'].'</a></li>';
                        }
                        ?>
                    </ul>
                </div>
                <ul class="banner_sc" style="display: none;">
                    <li style="text-align: center;padding-top:20px;">
                        <a>
                            <img class="people_fix01" src="<?php echo _img('new/yuan.png'); ?>">
                            <img class="people_fix02" src="<?php echo _img('new/picture.png'); ?>">
                        </a>
                        <p>Hi,你好</p>
                    </li>
                    <li class="banner_sc_02">
                        <a href="#">登录</a>
                        <a href="#">注册</a>
                        <a href="#">入驻</a>
                    </li>
                </ul>
                <div style="margin-top:11px;">
                    <?php if (isset($_['indexad']['index_top_1'][$i]) && is_file(DIR.$_['indexad']['index_top_1'][$i]['img'])) { ?>
                    <a href="<?php echo $_['indexad']['index_top_1'][$i]['url']?$_['indexad']['index_top_1'][$i]['url']:'javascript:void(0);'; ?>"><img src="<?php echo _resize($_['indexad']['index_top_1'][$i]['img'], 238, 140); ?>"></a>
                    <?php } ?>
                </div>
            </div>
            <div class="banner">
                <ul id="nav">
                    <?php
                    $_i = 0;
                    foreach($_['oneclass'] as $k=>$v){
                    $_i++;
                        if ($_i > 8) break;
                    ?>
                        <li id="mainCate-<?php echo $_i; ?>" class="mainCate">
                            <h3><a href="<?php echo _u('/shop/index/'.$v['id'].'/'); ?>" class="big_nav_icon0<?php echo $_i; ?>"<?php if (is_file(DIR.$v['img'])) echo ' style="background:url(\''._resize($v['img'],18,18).'\') no-repeat left center;"'; ?>><?php echo $v['title']; ?></a></h3>
                            <p>
                                <?php foreach ($v['child'] as $child) { ?>
                                    <a href="<?php echo _u('/shop/index/'.$child['id'].'/'); ?>"><?php echo $child['title']; ?></a>
                                <?php } ?>
                            </p>
                            <div class="subCate" style="display: none;">
                                <ul id="sub-ul-1">
                                    <li>
                                        <span><?php echo $v['title']; ?></span>
                                        <div class="main_text">
                                            <?php foreach ($v['child'] as $child) { ?>
                                                <a href="<?php echo _u('/shop/index/'.$child['id'].'/'); ?>"><?php echo $child['title']; ?></a>
                                            <?php } ?>
                                        </div>
                                    </li>
                                </ul>
                                <div class="nav_bom">
                                    <a href="#"><img src="<?php echo _img('new/nav_bom.png'); ?>"></a>
                                </div>

                            </div>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- 轮播（Carousel）指标 -->
    <ol class="carousel-indicators my_lb">
        <?php
        for ($_i=0; $_i<count($_['flash']); $_i++) {
            echo '<li data-target="#myCarousel" data-slide-to="'.$_i.'"'.($_i==0?' class="active"':'').'></li>';
        }
        ?>
    </ol>
    <!-- 轮播（Carousel）项目 -->
    <div class="carousel-inner carousel_lb">
        <?php
        foreach ($_['flash'] as $k => $flash) {
            //echo '<a href="'.$flash['url'].'" class="bg-1" title="'.$flash['title'].'"><img src="'.$flash['img'].'" /></a>';
        ?>
            <div class="item<?php echo $k==0?' active':''; ?>">
                <a href="<?php echo empty($flash['url'])?'javascript:void(0);':$flash['url']; ?>"><img src="<?php echo _resize($flash['img'], 1904, 599); ?>" /></a>
            </div>
        <?php
        }
        ?>
    </div>

</div>
<!--横导航-->
<div class="h_nav">
    <div class="container">
        <div class="row h_nav_box visible-md visible-lg">
            <?php
            foreach($_['index'] as $k=>$v) {
                echo '<a href="#floor_' . ($k + 1) . '">' . $v['title'] . '</a>';
            }
            ?>
        </div>
        <div class="row new_h_nav hidden-md hidden-lg">
            <?php
            foreach($_['index'] as $k=>$v) {
                echo '<a href="#floor_' . ($k + 1) . '" class="h_nav_icon0'.($k+1).'"'.(is_file(DIR.$v['img'])?' style="background:url(\''._resize($v['img'],18,18).'\') no-repeat center center;"':'').'></a>';
            }
            ?>
        </div>
    </div>
</div>

<!--楼层上广告-->
<div class="container">
    <div class="row big_pro">
        <div class="col-sm-12 col-xs-12" style="padding:0 8px;">
            <?php foreach($_['indexad']['index_top_2'] as $ad) { ?>
                <?php if (!is_file(DIR.$ad['img'])) continue; ?>
                <a href="<?php echo $ad['url']?$ad['url']:'javascript:void(0);'; ?>" ><img class="img-responsive" src="<?php echo _resize($ad['img'], 1200, 146); ?>"></a>
            <?php } ?>
        </div>
    </div>
    <div class="row small_pro" style="display: none;">
        <div class="col-lg-12" style="padding:0 8px;padding-right:0;">
            <a href="#" ><img style="width:100%;" src="<?php echo _img('new/new_pro02.png'); ?>"></a>
            <a href="#"><img style="width:100%;"  src="<?php echo _img('new/new_pro03.png'); ?>"></a>
            <a href="#" class="visible-lg"><img style="width:100%;" src="<?php echo _img('new/new_pro04.png'); ?>"></a>
            <a href="#" class="visible-lg"><img style="width:100%;" src="<?php echo _img('new/new_pro05.png'); ?>"></a>
            <a href="#" class="visible-lg" style="float: right;"><img style="width:100%;" src="<?php echo _img('new/new_pro06.png'); ?>"></a>
        </div>

    </div>
</div>
<!--全楼-->
<div class="container big_lou"  id="main" style="padding:0;position: relative;">
    <div style="float:right;">
        <ul class="left_nav "<?php if (count($_['index'])<8) echo ' style="height:'.floor(count($_['index'])/8*312).'px;"';?>>
            <?php
            foreach($_['index'] as $k=>$v){
            ?>
            <li><a class="pro0<?php echo $k+1;?>" data-floor="floor_<?php echo $k+1;?>"<?php if (is_file(DIR.$v['img'])) echo ' style="background:url(\''._resize($v['img'],18,18).'\') no-repeat center center #ff0000;"'; ?>></a></li>
            <?php } ?>
            <li class="pro09"></li>
            <div class="left_nav_wz">
                <?php
                foreach($_['index'] as $k=>$v){
                ?>
                    <span><a><?php echo $v['title']?></a></span>
                <?php } ?>
            </div>
        </ul>
    </div>

    <?php
    foreach($_['index'] as $k=>$v){
        echo '<!--'.$k.'楼-->';
    ?>
    <div id="floor_<?php echo $k+1; ?>" class="container lou_big_box">
        <div class="row">
            <div class="col-xs-12 col-md-12" style="padding:0 5px;">
                <div class="lou_01_top">
                    <a class="lou_01_title"<?php if (is_file(DIR.$v['img'])) echo ' style="background:url(\''._resize($v['img'],36,36).'\') no-repeat left center;"'; ?>><?php echo $v['title']?></a>
                    <a href="<?php echo _u('/shop/index/'.$v['id'].'/'); ?>" class="lou_01_more">更多好货</a>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-xs-12  col-md-3 col-sm-6 lou_01_boxleft" >
                <div style=" background:#fff;">
                    <a href="<?php echo empty($v['url_ad_1']) ? 'javascript:void(0);':$v['url_ad_1']; ?>" ><img style="width:288px;min-height:329px;margin:auto;"  class="img-responsive" src="<?php echo is_file(DIR.$v['img_ad_1'])?_resize($v['img_ad_1'], 288, 329):_img('new/lou_pro03.png'); ?>" ></a>
                    <ul class="row lou_01_fl">
                        <?php
                        foreach ($_['oneclass'][$v['id']]['child'] as $ky => $class) {
                            if ($ky > 5) break;
                        ?>
                            <li class="col-xs-4 col-md-4 " href="<?php echo _u('/shop/index/'.$class['id'].'/'); ?>"><a href="<?php echo _u('/shop/index/'.$class['id'].'/'); ?>"><?php echo $class['title']?></a> </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-6  lou_01_boxcenter visible-md visible-lg " ><a href="<?php echo empty($v['url_ad_2']) ? 'javascript:void(0);':$v['url_ad_2']; ?>" ><img  style="min-height:501px;"  class="img-responsive"  src="<?php echo is_file(DIR.$v['img_ad_2'])?_resize($v['img_ad_2'], 592, 491):_img('new/lou_pro01.png'); ?>"></a></div>
            <div class="col-xs-12 col-md-3 col-sm-6 lou_01_boxright">
                <div style="background:#fff;">
                    <ul  class="store_list">
                        <li class="list-tittle">最新热卖</li>
                        <?php foreach ($v['goods_hot'] as $hot) { ?>
                            <li class="store_box">
                                <a href="<?php echo _u('/shop/show/'.$hot['id'].'/'); ?>" class="store_photo"><img src="<?php echo _resize($hot['img'], 75, 75); ?>"></a>
                                <div class="store_sm">
                                    <p class="store_sm_text01">
                                        <a href="<?php echo _u('/shop/show/'.$hot['id'].'/'); ?>"><?php echo _left($hot['title'], 0, 26); ?></a>
                                    </p>
                                    <p class="store_sm_text02">
                                        <a class="pice_01">￥<?php echo _rmb($hot['mark']/100);?></a>
                                        <a class="pice_02">￥<?php echo _rmb($hot['mark']*1.24/100);?></a>
                                    </p>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row lou_01_bom" >
            <?php foreach ($v['goods_rec'] as $rec) { ?>
            <div class="col-md-6 col-lg-3 col-sm-6" style="padding:0 5px;">
                <ul>
                    <li class="lou_01_bom_line01"><a href="<?php echo _u('/shop/show/'.$rec['id'].'/'); ?>" style="height:282.5px;width:282.5px;margin:auto;display: block;"><img style="width:100%" class="img-responsive" src="<?php echo _resize($rec['img'], 300, 300); ?>"></a></li>
                    <li class="big_text_box">
                        <div class="text_box01">
                            <p class="lou_01_bom_text01"><a href="<?php echo _u('/shop/show/'.$rec['id'].'/'); ?>"><?php echo _left($rec['title'], 0, 40); ?></a></p>
                            <p class="lou_01_bom_text02"><a><?php echo _left(strip_tags($rec['content']), 0, 62, '...'); ?></a></p>
                            <p class="lou_01_bom_text05"><a style="float: left;">￥<?php echo _rmb($rec['mark']/100);?></a><a class="lou_01_bom_text03" style="float: left;">￥<?php echo _rmb($rec['mark']*1.24/100);?></a></p>
                            <p class="lou_01_bom_text04"><a>已售<?php echo $rec['sale'];?>件</a></p>
                        </div>
                        <div class="text_box02" style="display: none;">
                            <!--<p class="lou_01_bom_text05"><a>￥39</a></p>-->
                            <p class="lou_01_bom_text06"><a href="#"></a></p>
                        </div>
                    </li>
                    <li class="store_one">推荐<br>商品</li>
                </ul>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
</div>
<!--底部-->
<div class="footer">
    <div class="container" >
        <div class="row">
            <a href="#" class="visible-lg visible-md"><img class="img-responsive" src="<?php echo _img('new/footer_img.png'); ?>"></a>
            <a class="visible-sm visible-xs" href="#"><img class="img-responsive" src="<?php echo _img('new/footer_img02.png'); ?>"></a>
        </div>
    </div>
</div>
<?php
_part('footer_new');
_part('footer3');
?>
</body>
</html>