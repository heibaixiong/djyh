<?php
if(!defined('PART'))exit;
$key=explode(',',$_['config']['search']);
?>
<nav class="navbar navbar-default nav_new01" role="navigation">
    <div>
        <ul class="nav navbar-nav navbar-right visible-lg">
            <?php if (!empty($_['member'])) { ?>
                <li class="nav_icon01"><a href="<?php echo _u('/person/index/')?>"><?php echo $_['member']['user']; ?></a></li>
            <?php } else { ?>
            <li class="nav_icon01"><a href="<?php echo _u('/index/login/')?>">登录&注册</a></li>
            <?php } ?>
            <li class="nav_icon02"><a href="<?php echo _u('/person/index/')?>">个人中心</a></li>
            <li class="nav_icon03"><a href="<?php echo _u('/person/order/')?>">我的订单</a></li>
            <li class="nav_icon04"><a href="<?php echo _u('/article/index/')?>">帮助中心</a></li>
            <li class="nav_icon05"><a href="<?php echo _u('/article/show/5/')?>">在线客服</a></li>
            <li><a href="<?php echo _u('/user/out/')?>">退出</a></li>
        </ul>
        <ul class="navbar-right02" >
            <?php if (!empty($_['member'])) { ?>
                <li class="nav_icon01"><a href="<?php echo _u('/person/index/')?>"></a></li>
            <?php } else { ?>
                <li class="nav_icon01"><a href="<?php echo _u('/index/login/')?>"></a></li>
            <?php } ?>
            <li class="nav_icon02"><a href="<?php echo _u('/person/index/')?>"></a></li>
            <li class="nav_icon03"><a href="<?php echo _u('/person/order/')?>"></a></li>
            <li class="nav_icon04"><a href="<?php echo _u('/article/index/')?>"></a></li>
            <li class="nav_icon05"><a href="<?php echo _u('/article/show/5/')?>"></a></li>
            <li class="nav_icon06"><a href="<?php echo _u('/cart/index/')?>"></a></li>
        </ul>
    </div>
    <div class="navbar-header navbar-right">
        <a class="navbar-brand nav_tittle visible-lg" href="#">您好，欢迎光临东家要货B2B购物平台！</a>
    </div>

</nav>
<nav class="navbar navbar-default nav_new02" role="navigation">
    <div class="nav_logo visible-lg">
        <a href="<?php echo _u('/index/index/'); ?>"><img src="<?php echo _img('new/nav_logo.png'); ?>"></a>
        <a href="<?php echo _u('/index/index/'); ?>" class="nav_logo02"><img src="<?php echo _img('new/nav_logo02.png'); ?>"></a>
    </div>
    <!--<a href="#" class="visible-sm" style=" margin-top:28px;margin-bottom:47px;"><img src="<?php echo _img('new/nav_logo.png'); ?>"></a>-->
    <a href="<?php echo _u('/index/index/'); ?>" class="hidden-lg" style="height:50px;float:left;margin-top:20px;margin-bottom:47px;"><img src="<?php echo _img('new/nav_logo02.png'); ?>"></a>
    <div>
        <form action="<?php echo _u('/shop/search/');?>" method="post" id="top_search_form">
            <input type="hidden" name="cate" value="goods" />
        <ul class="nav navbar-nav nav_hright">
            <li class="nav_line01"><a href="/" class="search_type" data-cate="shop">商家查询</a></li>
            <li class="nav_line02"><a href="/" class="search_type" data-cate="goods">商品检索</a></li>
            <li class="dropdown nav_line05" >
                <a href="#"  class="zk dropdown-toggle" data-toggle="dropdown"></a>
                <ul class="dropdown-menu" style="width:88px;">
                    <li  style="border-bottom: solid 1px #bfbfbf;"><a href="#" class="search_type" data-cate="goods">商品检索</a></li>
                    <li><a href="#" class="search_type" data-cate="shop">商家查询</a></li>
                </ul>
            </li>
            <li class="nav_line03 new_nav_line03">
                <input type="text" value="<?php echo $key[0];?>" name="key" />
                <a href="javascript:void(0);" onclick="$(this).closest('form').submit();">搜 索</a>
            </li>

            <li class="nav_line03 nav_line04"><a href="<?php echo _u('/cart/index/');?>" target="_blank" id="shopping-amount" data-items="<?php echo $_['cartnum'];?>">我的购物车</a><span><?php echo $_['cartnum'];?></span></li>
        </ul>
        </form>
    </div>
</nav>
<div class="big_nav">
    <div class="container">
        <div class="row big_nav_top">
            <div class="col-md-2 left_box visible-lg visible-md visible-xs"><a style="font-size:18px;">全部商品分类</a></div>
            <div class="big_nav_new hidden-xs">
                <div class="col-sm-1 col-md-1 "><a href="<?php echo _u('/index/index/');?>">首页</a></div>
                <div class="col-sm-1 col-md-1 current_bignav_a"><a href="<?php echo _u('/shop/special/');?>">推荐商品</a></div>
                <div class="col-sm-1 col-md-1 "><a href="<?php echo _u('/shop/hot/');?>">热卖商品</a></div>
                <div class="col-sm-1 col-md-1"><a href="<?php echo _u('/shop/new/');?>">最新上架</a></div>
                <div class="col-sm-1 col-md-1"><a href="<?php echo _u('/news/index/');?>">最新公告</a></div>
                <div class="col-sm-1 col-md-1"><a href="<?php echo _u('/article/index/');?>">关于我们</a></div>
            </div>
            <div class="col-md-2 hidden-lg right_box"><a style="float: right;"></a></div>

        </div>
    </div>
    <div class="f_zk hidden-lg" style="clear: both">
        <div class="container">
            <ul class="f_zk01">
                <?php
                $_i = 0;
                foreach($_['oneclass'] as $k=>$v){
                    $_i++;
                    if ($_i > 8) break;
                    ?>
                    <li class="f_zk01_icon0<?php echo $_i; ?>"<?php if (is_file(DIR.$v['img'])) echo ' style="background:url(\''._resize($v['img'],18,18).'\') no-repeat left center;"'; ?>><a href="<?php echo _u('/shop/index/'.$v['id'].'/'); ?>"><?php echo $v['title']; ?></a></li>
                <?php } ?>
            </ul>
            <ul class="f_zk02">
                <li><a href="<?php echo _u('/index/index/');?>">首页</a></li>
                <li><a href="<?php echo _u('/shop/special/');?>">推荐商品</a></li>
                <li><a href="<?php echo _u('/shop/hot/');?>">热卖商品</a></li>
                <li><a href="<?php echo _u('/shop/new/');?>">最新上架</a></li>
                <li><a href="<?php echo _u('/news/index/');?>">最新公告</a></li>
                <li><a href="<?php echo _u('/article/index/');?>">关于我们</a></li>
            </ul>
        </div>

    </div>
</div>