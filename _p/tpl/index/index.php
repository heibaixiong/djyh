<?php
if(!defined('PART'))exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_['config']['title'];?></title>
<?php
_css('default');
_css('v1.0');
?>
</head>
<body>
<?php
_part('duilian');
_part('top');
_part('head');
?>
<div class="jd-content">
    <!--主导航-->
    <div class="main-nav">
        <div class="navbar">
            <ul>
                <li class="cur"><a href="<?php echo _u('/index/index/');?>">首页</a></li>
                <li><a href="<?php echo _u('/shop/special/');?>">推荐商品</a></li>
                <li><a href="<?php echo _u('/shop/hot/');?>">热卖商品</a></li>
                <li><a href="<?php echo _u('/shop/new/');?>">最新上架</a></li>
                <li><a href="<?php echo _u('/news/');?>">新闻中心</a></li>
                <li><a href="<?php echo _u('/article/');?>">关于我们</a></li>
            </ul>
        </div>
    </div>
    <div class="jd_category">
        <!--商品分类-->
        <div class="category-list">
            <div class="tle"><h2>全部商品分类</h2><i></i></div>
            <div class="category-detail">
               <h3>主题市场</h3>
                <div class="ct-items">
                    <?php
                    foreach($_['oneclass'] as $k=>$v){
                    ?>
                    <div class="item">
                        <h4><a target="_blank" href="<?php echo _u('/shop//'.$v['id'].'/');?>"><?php echo $v['title'];?></a></h4>
                        <i></i>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <!--商品分类 END-->
        <!--轮播图-->
        <div class="banner-slider">
           <div class="slider-pannel">
               <?php
               foreach ($_['flash'] as $flash) {
                   //echo '<a href="'.$flash['url'].'" class="bg-1" title="'.$flash['title'].'"><img src="'.$flash['img'].'" /></a>';
               }
               ?>
               <a href="<?php echo _u(); ?>" class="bg-1"></a>
           </div>
        </div>
        <!--轮播图 END-->
    </div>

    <div class="mid-con">
        <div class="recharge">
            <div class="notice">
                <h3>公告栏</h3>
                <div class="notice-info"><a href="<?php echo _u('/notice/show/'.$_['notice']['id']);?>" target="_blank"><?php echo $_['notice']['title'];?></a> </div>
            </div>
        </div>
        <span class="arr kl"></span>
        <span class="arr kr"></span>
    </div>
    <div class="index-main">
       <!--特卖品-->
        <div class="sales-good clearfix">
            <div class="title"></div>
            <ul>
                <?php
                foreach($_['temai'] as $k=>$v){
                ?>
                <li>
                    <a href="<?php echo _u('/shop/show/'.$v['id'].'/');?>" target="_blank">
                        <h5><?php echo _left($v['title'],0,8);?></h5>
                        <p class="c1">清仓囤货季</p>
                        <img src="<?php echo _resize($v['img'], 130, 130); ?>" alt=""/>
                    </a>
                </li>
                <?php
                }
                ?>
            </ul>
        </div>
       <!--特卖品 END-->
        <!--广告区-->
        <div class="ad-zoom">
          <a href="<?php echo $_['indexad'][0]['url'];?>" target="_blank"><img src="<?php echo _resize($_['indexad'][0]['img'], 1169);?>" alt="<?php echo $_['indexad'][0]['title'];?>" /></a>
        </div>
        <!--广告区 -->
        <?php
        foreach($_['index'] as $k=>$v){
        ?>
        <div class="stytitle">
            <h2><?php echo $k+1;?>F</h2><span><?php echo $v['title']?></span>
            <em class="arr kl"></em>
            <em class="arr kr"></em>
        </div>
        <div class="product-list clearfix">
            <ul>
                <?php
                foreach($_['index'][$k]['ware'] as $k0=>$v0){
                    $youjiao=0;
                    if($v0['recommend']==1){
                        $youjiao=1;
                    }
                    if($v0['new']==1){
                        $youjiao=2;
                    }
                    if($v0['hot']==1){
                        $youjiao=3;
                    }
                ?>
                <li>
                    <?php
                    if($youjiao>0){
                    ?>
                    <em class="ad"><?php echo $_['youjiao'][$youjiao];?></em>
                    <?php
                    }
                    ?>
                    <a href="<?php echo _u('/shop/show/'.$v0['id'].'/');?>" target="_blank">
                        <img src="<?php echo _resize($v0['img'], 150, 150); ?>" alt=""/>
                    </a>
                    <p class="t1"><a href="<?php echo _u('/shop/show/'.$v0['id'].'/');?>"><?php echo _left($v0['title'],0,12);?></a></p>
                    <p class="t2">好评率：<span>100%</span></p>
                    <p class="t3"><span>￥<?php echo _rmb($v0['mark']/100);?>元</span></p>
                </li>
                <?php
                }
                ?>
            </ul>
        </div>
        <?php
        }
        ?>
        <div class="stytitle">
            <h2>8F</h2><span>热门供应商</span>
            <em class="arr kl"></em>
            <em class="arr kr"></em>
        </div>
        <div class="hot-supplier clearfix">
           <ul>
               <?php
               foreach($_['user'] as $k=>$v){
                ?>
               <li><a href="" target="_blank"><?php echo $v['compony']?></a></li>
               <?php
               }
               ?>
           </ul>
        </div>
        <div class="bt-img"></div>
    </div>
</div>
<?php
_part('footer1');
_part('footer2');
_part('footer3');
?> 
</body>
</html>