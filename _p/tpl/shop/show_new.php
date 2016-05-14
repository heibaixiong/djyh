<?php
if(!defined('PART'))exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="zh_cn">
    <meta charset="UTF-8">
    <title><?php echo $_['title'];?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <?php
    _css('bootstrap.min');
    _css('base');
    _css('common');
    _css('detail');
    _js('jquery');
    _js('bootstrap.min');
    _js('detail');
    ?>
</head>
<body>
<?php
_part('top_new');
?>
<!--分类-->
<div class="list_main" style="position: relative;">
    <div class="container" >
        <div class="row list_main_box">
            <div class="col-md-2 col-sm-2 col-xs-2 list_lf01"><a>全部商品分类</a></div>
            <div class="list_lf02 col-md-10 col-sm-10 visible-md visible-lg">
                <div class="col-sm-1 col-md-1 "><a href="<?php echo _u('/index/index/');?>">首页</a></div>
                <div class="col-sm-1 col-md-1 "><a href="<?php echo _u('/shop/special/');?>">推荐商品</a></div>
                <div class="col-sm-1 col-md-1 "><a href="<?php echo _u('/shop/hot/');?>">热卖商品</a></div>
                <div class="col-sm-1 col-md-1 "><a href="<?php echo _u('/shop/new/');?>">最新上架</a></div>
                <div class="col-sm-1 col-md-1 "><a href="<?php echo _u('/news/index/');?>">最新公告</a></div>
                <div class="col-sm-1 col-md-1"><a href="<?php echo _u('/article/index/');?>">关于我们</a></div>
            </div>
            <div class="col-md-2 list_rig visible-xs visible-sm"><a></a></div>
        </div>
    </div>
    <div class="f_zk  hidden-lg hidden-md" style="clear: both">
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
<div class="container">
    <div class="row list_node">
        <a href="#" class="node_special"><?php echo $_['rs']['class1name']; ?></a>
        <a href="#"><?php echo $_['rs']['class2name']; ?></a>
        <a href="#" style="background: none;"><?php echo htmlspecialchars($_['rs']['title']); ?></a>
    </div>
    <div class="row">
        <div class="col-md-2 visible-md visible-lg" style="padding:0;">
            <ul class="detail_home">
                <li class="detail_home_lin01"><a href="<?php echo _u('/user/index/'.$_['rs']['uid'].'/'); ?>"><img src="<?php echo _img('new/detail_left_icon01.png'); ?>"><?php echo $_['rs']['uname']; ?></a></li>
                <li class="detail_home_lin02"><a><img src="<?php echo _img('new/detail_left_icon02.png'); ?>">金牌信誉店</a></li>
                <li class="detail_home_lin03">
                    <div class="detail_lin03_item">
                        <div class="detail_lin03_item_tex">描 述</div>
                        <div class="detail_lin03_item_num">
                            <span >4.8</span>
                        </div>
                    </div>
                    <div class="detail_lin03_item">
                        <div class="detail_lin03_item_tex">服 务</div>
                        <div class="detail_lin03_item_num ">
                            <span>4.8</span>
                        </div>
                    </div>
                    <div class="detail_lin03_item">
                        <div class="detail_lin03_item_tex">物 流</div>
                        <div class="detail_lin03_item_num">
                            <span>4.8</span>
                        </div>
                    </div>
                </li>
                <li class="detail_home_lin04">
                    <a class="detail_lin04_d01" href="<?php echo _u('/user/index/'.$_['rs']['uid'].'/'); ?>">进店逛逛</a>
                    <a class="detail_lin04_d02" href="#">收藏店铺</a>
                </li>
            </ul>
            <div class="detail_hot">
                <div class="detail_hot_tex">热门推荐<span>NEW</span></div>
                <ul class="detail_hot_min">
                    <?php foreach ($_['list'] as $k => $v) { ?>
                        <li>
                            <div class="detail_hot_img">
                                <a href="<?php echo _u('//show/'.$v['id'].'/'); ?>"><img src="<?php echo _resize($v['img'], 210, 210); ?>"></a>
                                <?php if ($v['recommend'] == 1) { ?>
                                    <span class="store_one">推荐<br>商品</span>
                                <?php } ?>
                            </div>
                            <p class="detail_hot_wz"><a href="<?php echo _u('//show/'.$v['id'].'/'); ?>"><?php echo _left(htmlspecialchars($v['title']), 0, 26, '...'); ?></a></p>
                            <p class="detail_hot_wz02">
                                <span class="detail_hot_pice">￥<?php echo _rmb($v['mark']/100); ?></span>
                                <span class="detail_hot_num">已售<em><?php echo $v['sale']; ?></em>件</span>
                            </p>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="col-sm-12 col-xs-12 col-md-10" style="padding:0;">
            <div class="detail_left" >
                <div class="detail_box">
                    <div class="detail_box_left">
                        <div class="detail_big_img">

                            <img src="<?php echo _resize($_['rs']['img'], 450, 450); ?>">

                        </div>
                        <ul class="detail_sml_img">
                            <li>
                                <img src="<?php echo _resize($_['rs']['img'], 68, 68); ?>" data-image="<?php echo _resize($_['rs']['img'], 450, 450); ?>" />
                            </li>
                            <?php foreach ($_['img'] as $k=>$v) { ?>
                                <li>
                                    <img src="<?php echo _resize($v, 68, 68); ?>" data-image="<?php echo _resize($v, 450, 450); ?>" />
                                </li>
                            <?php } ?>
                        </ul>
                        <div class="detail_share">
                            <a href="#" class="detail_share_01">分享</a>
                            <a href="#" class="detail_share_02">收藏商品</a>
                        </div>

                    </div>
                    <dd class="detail_box_right">
                        <ul>
                            <li>
                                <p class="detail_rig01"><a href="<?php echo _u('//show/'.$v['id'].'/'); ?>"><?php echo htmlspecialchars($_['rs']['title']); ?></a></p>
                                <p class="detail_rig02"><?php echo _left(strip_tags($_['rs']['content']), 0, 50, '...'); ?></p>
                            </li>
                            <li class="detail_rig03">
                                <a><span>价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;格：</span><em>￥<?php echo _rmb($_['rs']['mark']/100); ?></em></a>
                            </li>
                            <li class="detail_rig04">
                                <a><span>销&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;量：</span><em><?php echo $_['rs']['sale']; ?>件</em></a>
                            </li>
                            <li class="detail_rig04 current_dot">
                                <a><span>累计评价：</span><em>1026</em></a>
                            </li>
                            <?php
                            $_group = '';
                            foreach ($_['attr_info'] as $attr) {
                                if ($attr['wname'] <> $_group) {
                                    if ($_group <> '') echo '</dl></li>';
                                    $_group = $attr['wname'];
                                    echo '<li class="detail_rig07"><a class="detail_rig07_tit">'.$_group.'</a><dl class="detail_rig07_rig">';
                                }
                                ?>
                                    <dd class="select_box" data-attr="<?php echo $attr['id']; ?>">
                                        <p class="select_box_in">
                                            <span class="dui" style="display: none"></span>
                                            <span><?php echo $attr['model']; ?></span>
                                        </p>
                                    </dd>
                                <?php
                            }
                            if (!empty($_['attr_info'])) echo '</dl></li>';
                            ?>

                    <li class="detail_rig07" style="display: none;">
                        <a class="detail_rig07_tit">颜色分类</a>
                        <dl class="detail_rig07_rig">
                            <dd class="select_box">
                                <p class="select_cor_in">
                                    <span class="dui" style="display: none"></span>
                                    <img src="<?php echo _img('new/fd_pro01.png'); ?>">
                                </p>
                            </dd>
                            <dd class="select_box">
                                <p class="select_cor_in">
                                    <span class="dui" style="display: none"></span>
                                    <img src="<?php echo _img('new/foot_ewm.png'); ?>">
                                </p>
                            </dd>
                            <dd class="select_box">
                                <p class="select_cor_in">
                                    <span class="dui" style="display: none"></span>
                                    <img src="<?php echo _img('new/nav_logo02.png'); ?>">
                                </p>
                            </dd>
                            <dd class="select_box">
                                <p class="select_cor_in">
                                    <span class="dui" style="display: none"></span>
                                    <img src="<?php echo _img('new/list_pro01.png'); ?>">
                                </p>
                            </dd>
                            <dd class="select_box">
                                <p class="select_cor_in">
                                    <span class="dui" style="display: none"></span>
                                    <img src="<?php echo _img('new/fd_pro01.png'); ?>">
                                </p>
                            </dd>

                        </dl>
                    </li>
                    <li class="detail_rig05">
                        <a>数&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;量：</a>
                        <div class="detail_sl">
                            <span class="detail_jian"></span>
                            <input type="text" value="1" minnum="1" maxnum="<?php echo $_['rs']['stock'];?>" orinum="1" id="goodsnum" />
                            <span class="detail_jia"></span>
                        </div>
                        <a style="margin-left:18px;">（库存：<em><?php echo $_['rs']['stock']; ?></em>）</a>
                    </li>
                    <li class="detail_rig06">
                        <a class="detail_btn01" href="javascript:void(0);" id="btn-add-buy">立即购买</a>
                        <a class="detail_btn02" href="javascript:void(0);" data="<?php echo $_['rs']['id'];?>" data-option="" id="btn-add-cart">加入购物车</a>
                    </li>
                    </ul>
                </div>
                <ul class="detail_main_lin02">
                    <li class="current_detlin01"><a>商品详情</a></li>
                    <li style="display: none;"><a>评价详情</a></li>
                    <div style="clear: both"></div>
                </ul>
                <!-- tab01-->
                <div class="d_tab" >
                    <!--<a href="#"><img style="width: 100%;" src="<?php /*echo _img('new/detail_main_pro01.png'); */?>"></a>-->
                    <div class="d_tab_main">
                        <?php if (!empty($_['para_info'])) { ?>
                        <div class="d_tab_list">
                            <!--<p>品牌名称：<span>Nestle/雀巢</span></p>-->
                                <p>产品参数：</p>
                                <ul class="d_tab_list02">
                                    <?php foreach ($_['para_info'] as $para) { ?>
                                        <li><?php echo $para['paraname'].'：'.$para['value']; ?></li>
                                    <?php } ?>
                                </ul>

                        </div>
                        <?php } ?>
                        <!--<div class="d_tab_data">
                            <p> 生产日期: 2016-01-08 至 2016-02-04</p>
                        </div>-->
                        <div class="d_tab_img">
                            <?php echo $_['rs']['content']; ?>
                        </div>
                    </div>
                </div>
                <!-- tab02-->
                <div class="d_tab" style="display: none;">
                    <div class="d_coment">
                        <p class="d_coment_praise">商品好评度<span>100%</span></p>
                        <dl>
                            <dt>店铺评分（共收<em>500</em>人评分）</dt>
                            <dd><span>描述一致：</span><a></a><span>4.8</span></dd>
                            <dd><span>质量满意：</span><a></a><span>4.8</span></dd>
                            <dd><span>服务态度：</span><a></a><span>4.8</span></dd>
                            <dd><span>发货速度：</span><a></a><span>4.8</span></dd>
                        </dl>
                    </div>

                    <ul class="d_coment_tittle d_coment_cor hidden-xs">
                        <li class="current_l_first">全部评价(<em>500</em>)</li>
                        <li>好评(<em>420</em>)</li>
                        <li>中评(<em>50</em>)</li>
                        <li>差评(<em>500</em>)</li>
                        <li>追评(<em>200</em>)</li>
                    </ul>

                    <ul class="d_coment_tittle visible-xs">
                        <li class="current_l_first02"><span>查看评价</span></li>
                        <ul class="d_zk_incoment">
                            <li>所有评价(<em>500</em>)</li>
                            <li>好评(<em>400</em>)</li>
                            <li>中评(<em>50</em>)</li>
                            <li>差评(<em>200</em>)</li>
                            <li>追评(<em>500</em>)</li>
                        </ul>
                    </ul>
                    <!-- 全评-->

                    <div class="d_coment_content row">
                        <div class="d_coment_box">
                            <a class="d_coment_tx col-sm-1 col-xs-1">
                                <img class="people_fix01" src="<?php echo _img('new/detail_bg.png'); ?>">
                                <img class="people_fix02" src="<?php echo _img('new/detail_left_pro01.png'); ?>">
                            </a>
                            <ul class="d_coment_cont col-sm-11 col-xs-12">
                                <li class="d_coment_cont_lin01">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <a>好评</a>
                                </li>
                                <li class="d_coment_cont_lin02">
                                    买两三事家的衣服从没失望过，真是太赞了，现在衣柜里的衣服春夏秋冬基本都出自你家了，绝对的对VIP！这件牛仔超男朋友风，肩膀是落肩的，
                                    绝对超肥大，本人身高170 体重108，平时偏爱休闲，买它家的衣服一直都是买L号，可这件差点hold不住，有点太大太肥了，懒得换货了休闲着穿
                                    吧，建议亲们s m 就够了
                                </li>
                                <li  class="d_coment_cont_lin03" style="border-bottom: solid 1px #b5b5b5;">
                                    <a>套餐：2盒装 </a>
                                    <a style="margin-left: 30px;">05月03日 18.44</a>
                                </li>
                                <li class="d_coment_cont_lin04">
                                    <p class="cont_lin04_in01">[追加评论]</p>
                                    <p class="cont_lin04_in02">买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，</p>
                                    <p class="cont_lin04_in03">确认收货后  2天追加评价</p>
                                </li>
                            </ul>
                        </div>
                        <div class="d_coment_box">
                            <a class="d_coment_tx col-sm-1 col-xs-1">
                                <img class="people_fix01" src="<?php echo _img('new/detail_bg.png'); ?>">
                                <img class="people_fix02" src="<?php echo _img('new/detail_left_pro01.png'); ?>">
                            </a>
                            <ul class="d_coment_cont col-sm-11 col-xs-12">
                                <li class="d_coment_cont_lin01">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <a>中评</a>
                                </li>
                                <li class="d_coment_cont_lin02">
                                    买两三事家的衣服从没失望过，真是太赞了，现在衣柜里的衣服春夏秋冬基本都出自你家了，绝对的对VIP！这件牛仔超男朋友风，肩膀是落肩的，
                                    绝对超肥大，本人身高170 体重108，平时偏爱休闲，买它家的衣服一直都是买L号，可这件差点hold不住，有点太大太肥了，懒得换货了休闲着穿
                                    吧，建议亲们s m 就够了
                                </li>
                                <li  class="d_coment_cont_lin03" style="border-bottom: solid 1px #b5b5b5;">
                                    <a>套餐：2盒装 </a>
                                    <a style="margin-left: 30px;">05月03日 18.44</a>
                                </li>

                            </ul>
                        </div>
                        <div class="d_coment_box">
                            <a class="d_coment_tx col-sm-1 col-xs-1">
                                <img class="people_fix01" src="<?php echo _img('new/detail_bg.png'); ?>">
                                <img class="people_fix02" src="<?php echo _img('new/detail_left_pro01.png'); ?>">
                            </a>
                            <ul class="d_coment_cont col-sm-11 col-xs-12">
                                <li class="d_coment_cont_lin01">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <a>差评</a>
                                </li>
                                <li class="d_coment_cont_lin02">
                                    买两三事家的衣服从没失望过，真是太赞了，现在衣柜里的衣服春夏秋冬基本都出自你家了，绝对的对VIP！这件牛仔超男朋友风，肩膀是落肩的，
                                    绝对超肥大，本人身高170 体重108，平时偏爱休闲，买它家的衣服一直都是买L号，可这件差点hold不住，有点太大太肥了，懒得换货了休闲着穿
                                    吧，建议亲们s m 就够了
                                </li>
                                <li  class="d_coment_cont_lin03" style="border-bottom: solid 1px #b5b5b5;">
                                    <a>套餐：2盒装 </a>
                                    <a style="margin-left: 30px;">05月03日 18.44</a>
                                </li>
                                <li class="d_coment_cont_lin04">
                                    <p class="cont_lin04_in01">[追加评论]</p>
                                    <p class="cont_lin04_in02">买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，</p>
                                    <p class="cont_lin04_in03">确认收货后  2天追加评价</p>
                                </li>
                            </ul>
                        </div>
                        <div class="d_coment_box">
                            <a class="d_coment_tx col-sm-1 col-xs-1">
                                <img class="people_fix01" src="<?php echo _img('new/detail_bg.png'); ?>">
                                <img class="people_fix02" src="<?php echo _img('new/detail_left_pro01.png'); ?>">
                            </a>
                            <ul class="d_coment_cont col-sm-11 col-xs-12">
                                <li class="d_coment_cont_lin01">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <a>差评</a>
                                </li>
                                <li class="d_coment_cont_lin02">
                                    买两三事家的衣服从没失望过，真是太赞了，现在衣柜里的衣服春夏秋冬基本都出自你家了，绝对的对VIP！这件牛仔超男朋友风，肩膀是落肩的，
                                    绝对超肥大，本人身高170 体重108，平时偏爱休闲，买它家的衣服一直都是买L号，可这件差点hold不住，有点太大太肥了，懒得换货了休闲着穿
                                    吧，建议亲们s m 就够了
                                </li>
                                <li  class="d_coment_cont_lin03" style="border-bottom: solid 1px #b5b5b5;">
                                    <a>套餐：2盒装 </a>
                                    <a style="margin-left: 30px;">05月03日 18.44</a>
                                </li>
                                <li class="d_coment_cont_lin04">
                                    <p class="cont_lin04_in01">[追加评论]</p>
                                    <p class="cont_lin04_in02">买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，</p>
                                    <p class="cont_lin04_in03">确认收货后  2天追加评价</p>
                                </li>
                            </ul>
                        </div>
                        <div class="d_coment_box">
                            <a class="d_coment_tx col-sm-1 col-xs-1">
                                <img class="people_fix01" src="<?php echo _img('new/detail_bg.png'); ?>">
                                <img class="people_fix02" src="<?php echo _img('new/detail_left_pro01.png'); ?>">
                            </a>
                            <ul class="d_coment_cont col-sm-11 col-xs-12">
                                <li class="d_coment_cont_lin01">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <a>差评</a>
                                </li>
                                <li class="d_coment_cont_lin02">
                                    买两三事家的衣服从没失望过，真是太赞了，现在衣柜里的衣服春夏秋冬基本都出自你家了，绝对的对VIP！这件牛仔超男朋友风，肩膀是落肩的，
                                    绝对超肥大，本人身高170 体重108，平时偏爱休闲，买它家的衣服一直都是买L号，可这件差点hold不住，有点太大太肥了，懒得换货了休闲着穿
                                    吧，建议亲们s m 就够了
                                </li>
                                <li  class="d_coment_cont_lin03" style="border-bottom: solid 1px #b5b5b5;">
                                    <a>套餐：2盒装 </a>
                                    <a style="margin-left: 30px;">05月03日 18.44</a>
                                </li>
                                <li class="d_coment_cont_lin04">
                                    <p class="cont_lin04_in01">[追加评论]</p>
                                    <p class="cont_lin04_in02">买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，</p>
                                    <p class="cont_lin04_in03">确认收货后  2天追加评价</p>
                                </li>
                            </ul>
                        </div>
                        <div class="d_coment_box">
                            <a class="d_coment_tx col-sm-1 col-xs-1">
                                <img class="people_fix01" src="<?php echo _img('new/detail_bg.png'); ?>">
                                <img class="people_fix02" src="<?php echo _img('new/detail_left_pro01.png'); ?>">
                            </a>
                            <ul class="d_coment_cont col-sm-11 col-xs-12">
                                <li class="d_coment_cont_lin01">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <a>差评</a>
                                </li>
                                <li class="d_coment_cont_lin02">
                                    买两三事家的衣服从没失望过，真是太赞了，现在衣柜里的衣服春夏秋冬基本都出自你家了，绝对的对VIP！这件牛仔超男朋友风，肩膀是落肩的，
                                    绝对超肥大，本人身高170 体重108，平时偏爱休闲，买它家的衣服一直都是买L号，可这件差点hold不住，有点太大太肥了，懒得换货了休闲着穿
                                    吧，建议亲们s m 就够了
                                </li>
                                <li  class="d_coment_cont_lin03" style="border-bottom: solid 1px #b5b5b5;">
                                    <a>套餐：2盒装 </a>
                                    <a style="margin-left: 30px;">05月03日 18.44</a>
                                </li>
                                <li class="d_coment_cont_lin04">
                                    <p class="cont_lin04_in01">[追加评论]</p>
                                    <p class="cont_lin04_in02">买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，</p>
                                    <p class="cont_lin04_in03">确认收货后  2天追加评价</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- 好评-->
                    <div class="d_coment_content row" style="display: none">
                        <div class="d_coment_box">
                            <a class="d_coment_tx col-sm-1 col-xs-1">
                                <img class="people_fix01" src="<?php echo _img('new/detail_bg.png'); ?>">
                                <img class="people_fix02" src="<?php echo _img('new/detail_left_pro01.png'); ?>">
                            </a>
                            <ul class="d_coment_cont col-sm-11 col-xs-12">
                                <li class="d_coment_cont_lin01">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <a>好评</a>
                                </li>
                                <li class="d_coment_cont_lin02">
                                    买两三事家的衣服从没失望过，真是太赞了，现在衣柜里的衣服春夏秋冬基本都出自你家了，绝对的对VIP！这件牛仔超男朋友风，肩膀是落肩的，
                                    绝对超肥大，本人身高170 体重108，平时偏爱休闲，买它家的衣服一直都是买L号，可这件差点hold不住，有点太大太肥了，懒得换货了休闲着穿
                                    吧，建议亲们s m 就够了
                                </li>
                                <li  class="d_coment_cont_lin03" style="border-bottom: solid 1px #b5b5b5;">
                                    <a>套餐：2盒装 </a>
                                    <a style="margin-left: 30px;">05月03日 18.44</a>
                                </li>
                                <li class="d_coment_cont_lin04">
                                    <p class="cont_lin04_in01">[追加评论]</p>
                                    <p class="cont_lin04_in02">买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，</p>
                                    <p class="cont_lin04_in03">确认收货后  2天追加评价</p>
                                </li>
                            </ul>
                        </div>
                        <div class="d_coment_box">
                            <a class="d_coment_tx col-sm-1 col-xs-1">
                                <img class="people_fix01" src="<?php echo _img('new/detail_bg.png'); ?>">
                                <img class="people_fix02" src="<?php echo _img('new/detail_left_pro01.png'); ?>">
                            </a>
                            <ul class="d_coment_cont col-sm-11 col-xs-12">
                                <li class="d_coment_cont_lin01">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <a>好评</a>
                                </li>
                                <li class="d_coment_cont_lin02">
                                    买两三事家的衣服从没失望过，真是太赞了，现在衣柜里的衣服春夏秋冬基本都出自你家了，绝对的对VIP！这件牛仔超男朋友风，肩膀是落肩的，
                                    绝对超肥大，本人身高170 体重108，平时偏爱休闲，买它家的衣服一直都是买L号，可这件差点hold不住，有点太大太肥了，懒得换货了休闲着穿
                                    吧，建议亲们s m 就够了
                                </li>
                                <li  class="d_coment_cont_lin03" style="border-bottom: solid 1px #b5b5b5;">
                                    <a>套餐：2盒装 </a>
                                    <a style="margin-left: 30px;">05月03日 18.44</a>
                                </li>
                                <li class="d_coment_cont_lin04">
                                    <p class="cont_lin04_in01">[追加评论]</p>
                                    <p class="cont_lin04_in02">买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，</p>
                                    <p class="cont_lin04_in03">确认收货后  2天追加评价</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- 中评-->
                    <div class="d_coment_content row" style="display: none">
                        <div class="d_coment_box">
                            <a class="d_coment_tx col-sm-1 col-xs-1">
                                <img class="people_fix01" src="<?php echo _img('new/detail_bg.png'); ?>">
                                <img class="people_fix02" src="<?php echo _img('new/detail_left_pro01.png'); ?>">
                            </a>
                            <ul class="d_coment_cont col-sm-11 col-xs-12">
                                <li class="d_coment_cont_lin01">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <a>中评</a>
                                </li>
                                <li class="d_coment_cont_lin02">
                                    买两三事家的衣服从没失望过，真是太赞了，现在衣柜里的衣服春夏秋冬基本都出自你家了，绝对的对VIP！这件牛仔超男朋友风，肩膀是落肩的，
                                    绝对超肥大，本人身高170 体重108，平时偏爱休闲，买它家的衣服一直都是买L号，可这件差点hold不住，有点太大太肥了，懒得换货了休闲着穿
                                    吧，建议亲们s m 就够了
                                </li>
                                <li  class="d_coment_cont_lin03" style="border-bottom: solid 1px #b5b5b5;">
                                    <a>套餐：2盒装 </a>
                                    <a style="margin-left: 30px;">05月03日 18.44</a>
                                </li>

                            </ul>
                        </div>
                        <div class="d_coment_box">
                            <a class="d_coment_tx col-sm-1 col-xs-1">
                                <img class="people_fix01" src="<?php echo _img('new/detail_bg.png'); ?>">
                                <img class="people_fix02" src="<?php echo _img('new/detail_left_pro01.png'); ?>">
                            </a>
                            <ul class="d_coment_cont col-sm-11 col-xs-12">
                                <li class="d_coment_cont_lin01">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <a>中评</a>
                                </li>
                                <li class="d_coment_cont_lin02">
                                    买两三事家的衣服从没失望过，真是太赞了，现在衣柜里的衣服春夏秋冬基本都出自你家了，绝对的对VIP！这件牛仔超男朋友风，肩膀是落肩的，
                                    绝对超肥大，本人身高170 体重108，平时偏爱休闲，买它家的衣服一直都是买L号，可这件差点hold不住，有点太大太肥了，懒得换货了休闲着穿
                                    吧，建议亲们s m 就够了
                                </li>
                                <li  class="d_coment_cont_lin03" style="border-bottom: solid 1px #b5b5b5;">
                                    <a>套餐：2盒装 </a>
                                    <a style="margin-left: 30px;">05月03日 18.44</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- 差评-->
                    <div class="d_coment_content row" style="display: none">
                        <div class="d_coment_box">
                            <a class="d_coment_tx col-sm-1 col-xs-1">
                                <img class="people_fix01" src="<?php echo _img('new/detail_bg.png'); ?>">
                                <img class="people_fix02" src="<?php echo _img('new/detail_left_pro01.png'); ?>">
                            </a>
                            <ul class="d_coment_cont col-sm-11 col-xs-12">
                                <li class="d_coment_cont_lin01">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <a>差评</a>
                                </li>
                                <li class="d_coment_cont_lin02">
                                    买两三事家的衣服从没失望过，真是太赞了，现在衣柜里的衣服春夏秋冬基本都出自你家了，绝对的对VIP！这件牛仔超男朋友风，肩膀是落肩的，
                                    绝对超肥大，本人身高170 体重108，平时偏爱休闲，买它家的衣服一直都是买L号，可这件差点hold不住，有点太大太肥了，懒得换货了休闲着穿
                                    吧，建议亲们s m 就够了
                                </li>
                                <li  class="d_coment_cont_lin03" style="border-bottom: solid 1px #b5b5b5;">
                                    <a>套餐：2盒装 </a>
                                    <a style="margin-left: 30px;">05月03日 18.44</a>
                                </li>
                                <li class="d_coment_cont_lin04">
                                    <p class="cont_lin04_in01">[追加评论]</p>
                                    <p class="cont_lin04_in02">买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，</p>
                                    <p class="cont_lin04_in03">确认收货后  2天追加评价</p>
                                </li>
                            </ul>
                        </div>
                        <div class="d_coment_box">
                            <a class="d_coment_tx col-sm-1 col-xs-1">
                                <img class="people_fix01" src="<?php echo _img('new/detail_bg.png'); ?>">
                                <img class="people_fix02" src="<?php echo _img('new/detail_left_pro01.png'); ?>">
                            </a>
                            <ul class="d_coment_cont col-sm-11 col-xs-12">
                                <li class="d_coment_cont_lin01">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <a>差评</a>
                                </li>
                                <li class="d_coment_cont_lin02">
                                    买两三事家的衣服从没失望过，真是太赞了，现在衣柜里的衣服春夏秋冬基本都出自你家了，绝对的对VIP！这件牛仔超男朋友风，肩膀是落肩的，
                                    绝对超肥大，本人身高170 体重108，平时偏爱休闲，买它家的衣服一直都是买L号，可这件差点hold不住，有点太大太肥了，懒得换货了休闲着穿
                                    吧，建议亲们s m 就够了
                                </li>
                                <li  class="d_coment_cont_lin03" style="border-bottom: solid 1px #b5b5b5;">
                                    <a>套餐：2盒装 </a>
                                    <a style="margin-left: 30px;">05月03日 18.44</a>
                                </li>
                                <li class="d_coment_cont_lin04">
                                    <p class="cont_lin04_in01">[追加评论]</p>
                                    <p class="cont_lin04_in02">买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，</p>
                                    <p class="cont_lin04_in03">确认收货后  2天追加评价</p>
                                </li>
                            </ul>
                        </div>
                        <div class="d_coment_box">
                            <a class="d_coment_tx col-sm-1 col-xs-1">
                                <img class="people_fix01" src="<?php echo _img('new/detail_bg.png'); ?>">
                                <img class="people_fix02" src="<?php echo _img('new/detail_left_pro01.png'); ?>">
                            </a>
                            <ul class="d_coment_cont col-sm-11 col-xs-12">
                                <li class="d_coment_cont_lin01">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <a>差评</a>
                                </li>
                                <li class="d_coment_cont_lin02">
                                    买两三事家的衣服从没失望过，真是太赞了，现在衣柜里的衣服春夏秋冬基本都出自你家了，绝对的对VIP！这件牛仔超男朋友风，肩膀是落肩的，
                                    绝对超肥大，本人身高170 体重108，平时偏爱休闲，买它家的衣服一直都是买L号，可这件差点hold不住，有点太大太肥了，懒得换货了休闲着穿
                                    吧，建议亲们s m 就够了
                                </li>
                                <li  class="d_coment_cont_lin03" style="border-bottom: solid 1px #b5b5b5;">
                                    <a>套餐：2盒装 </a>
                                    <a style="margin-left: 30px;">05月03日 18.44</a>
                                </li>
                                <li class="d_coment_cont_lin04">
                                    <p class="cont_lin04_in01">[追加评论]</p>
                                    <p class="cont_lin04_in02">买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，</p>
                                    <p class="cont_lin04_in03">确认收货后  2天追加评价</p>
                                </li>
                            </ul>
                        </div>
                        <div class="d_coment_box">
                            <a class="d_coment_tx col-sm-1 col-xs-1">
                                <img class="people_fix01" src="<?php echo _img('new/detail_bg.png'); ?>">
                                <img class="people_fix02" src="<?php echo _img('new/detail_left_pro01.png'); ?>">
                            </a>
                            <ul class="d_coment_cont col-sm-11 col-xs-12">
                                <li class="d_coment_cont_lin01">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <a>差评</a>
                                </li>
                                <li class="d_coment_cont_lin02">
                                    买两三事家的衣服从没失望过，真是太赞了，现在衣柜里的衣服春夏秋冬基本都出自你家了，绝对的对VIP！这件牛仔超男朋友风，肩膀是落肩的，
                                    绝对超肥大，本人身高170 体重108，平时偏爱休闲，买它家的衣服一直都是买L号，可这件差点hold不住，有点太大太肥了，懒得换货了休闲着穿
                                    吧，建议亲们s m 就够了
                                </li>
                                <li  class="d_coment_cont_lin03" style="border-bottom: solid 1px #b5b5b5;">
                                    <a>套餐：2盒装 </a>
                                    <a style="margin-left: 30px;">05月03日 18.44</a>
                                </li>
                                <li class="d_coment_cont_lin04">
                                    <p class="cont_lin04_in01">[追加评论]</p>
                                    <p class="cont_lin04_in02">买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，</p>
                                    <p class="cont_lin04_in03">确认收货后  2天追加评价</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- 追评-->
                    <div class="d_coment_content row" style="display: none">
                        <div class="d_coment_box">
                            <a class="d_coment_tx col-sm-1 col-xs-1">
                                <img class="people_fix01" src="<?php echo _img('new/detail_bg.png'); ?>">
                                <img class="people_fix02" src="<?php echo _img('new/detail_left_pro01.png'); ?>">
                            </a>
                            <ul class="d_coment_cont col-sm-11 col-xs-12">
                                <li class="d_coment_cont_lin01">
                                    <img src="<?php echo _img('new/detail_xing.png'); ?>">
                                    <a>差评</a>
                                </li>
                                <li class="d_coment_cont_lin02">
                                    买两三事家的衣服从没失望过，真是太赞了，现在衣柜里的衣服春夏秋冬基本都出自你家了，绝对的对VIP！这件牛仔超男朋友风，肩膀是落肩的，
                                    绝对超肥大，本人身高170 体重108，平时偏爱休闲，买它家的衣服一直都是买L号，可这件差点hold不住，有点太大太肥了，懒得换货了休闲着穿
                                    吧，建议亲们s m 就够了
                                </li>
                                <li  class="d_coment_cont_lin03" style="border-bottom: solid 1px #b5b5b5;">
                                    <a>套餐：2盒装 </a>
                                    <a style="margin-left: 30px;">05月03日 18.44</a>
                                </li>
                                <li class="d_coment_cont_lin04">
                                    <p class="cont_lin04_in01">[追加评论]</p>
                                    <p class="cont_lin04_in02">买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，买两三事家的衣服从没失望过，真是太赞了，</p>
                                    <p class="cont_lin04_in03">确认收货后  2天追加评价</p>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!--页码-->
                    <div class="row" >
                        <div class="list-page">
                            <div class="list_bom_page">
                                <a href="#">1</a>
                                <a href="#">2</a>
                                <a href="#" class="current_page">3</a>
                                <a href="#"  class="hidden-xs">4</a>
                                <a href="#" class="hidden-xs">5</a>
                                <a href="#" class="hidden-xs">6</a>
                                <a href="#" class="hidden-xs">7</a>
                                <a href="#" class="hidden-xs">8</a>
                                <a href="#" class="hidden-xs">9</a>
                                <a href="#" class="hidden-xs">10</a>
                                <a href="#">…</a>
                                <a href="#">100</a>
                                <a  href="#">下一页</a>
                                <a  href="#">末页</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>



        </div>
    </div>
</div>

</div>

<?php
_part('footer_new');
_part('footer3');
?>

</body>
</html>