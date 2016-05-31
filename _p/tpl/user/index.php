<?php
if(!defined('PART'))exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_['title'];?></title>
<?php
_jq();
_css('default');
_css('v1.0');
_css('style');
?>
</head>
<body>
<?php
_part('top');
_part('head');
_part('nav');
?>
<div class="layout_main">
    <div class="layout_wrap">
            <!--S=供应商信息-->
            <div class="ghs-detailBox">
                <div class="ghsNameBox">
                    <em class="listIcon listIcon1"></em>
                    <h4 class="ghsName"><?php echo $_['rs']['compony'];?></h4>
                    <div class="clear"></div>
                </div>
                <div>
                    <ul class="ghsList-ul1">
                        <li>
                            <div class="contenName">
                                <em class="listIcon listIcon2"></em>
                                <span class="fl">代理产品：</span><?php echo $_['rs']['product'];?>
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                        </li>
                        <li class="Noneborder">
                            <div class="contenName">
                                <em class="listIcon listIcon3"></em>
                                <span class="fl">优惠政策：</span><?php echo $_['rs']['if'];?>
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                        </li>
                        <li style="border-bottom: 0;">
                            <div class="contenName">
                                <em class="listIcon listIcon4"></em>
                                <span class="fl">配送条件：</span><?php echo $_['rs']['zone'];?>
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                        </li>
                        <li class="Noneborder" style="border-bottom: 0;">
                            <div class="contenName">
                                <em class="listIcon listIcon4"></em>
                                <span class="fl">配送范围：</span><?php echo $_['rs']['good'];?>
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                        </li>
                        <div class="clear"></div>
                    </ul>
                </div>
            </div>
            <div class="clear"></div>
        <div class="clearfix">
                <div class="list_left mt10">
                    <h3 lang="sli"><span class="bg_sprite icon_filter icon_open"></span><?php echo $_['classtitle'];?></h3>
                    <div style="display:block;" class="list_son">
                        <ul>
                            <?php
                            foreach($_['shopclass'] as $k=>$v){
                            ?>
                            <li><a href="<?php echo _u('/shop/index/'.$v['id'].'/')?>"><?php echo $v['title'];?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>                
                <script>
                    $(".mt10 h3").click(function(){
                        $(this).addClass("icon_open").next("div.list_son").slideToggle(300).siblings("div.list_son").slideUp("slow");
                        $(this).siblings().removeClass("icon_open");
                    });
                </script>
                <div class="list_main mt10">
                    <div>
                        <div class="list_condition clearfix mt10">
                            <ul class="list_condition_main clearfix" id="ulTab">
                                <li id="isDefault" class="cur">默认排序</li>
                                <li id="isSale" class="">销量<i class="bg_sprite"></i></li>
                                <li id="isPrice" class="">价格<i class="bg_sprite"></i></li>
                            </ul>
                            <div class="list_page">
                                <div class="page_num">
                                </div>
                            </div>
                        </div>
                        <div class="search_table">
                            <div class="search_list ">
                                <ul class="clearfix">
                                    <?php
                                    foreach(Page::$arr as $k=>$v){
                                    ?>
                                    <li class="search_item">
                                        <div class="pro-activiyIco">超值</div>
                                        <div class="search_item_box">
                                            <div class="prod_img">
                                                <a target="_blank" href="<?php echo _u('/shop/show/'.$v['id'].'/');?>">
                                                    <img class="imgload lazy" src="<?php echo _resize($v['img'], 224, 224); ?>" width="200" height="200" alt="" />
                                                </a>
                                            </div>
                                            <div style="position: relative;">
                                                    <p class="prod_price"><span class="prod_price_up"><span>¥<?php echo _rmb($v['mark']/100);?></span></span></p>                                    
                                            </div>
                                            <div class="clear"></div>
                                            <p class="prod_title"><a target="_blank" href="<?php echo _u('/shop/show/'.$v['id'].'/');?>"><?php echo $v['title'];?></a></p>
                                            <div class="clear"></div>
                                            <div class="prod_num">
                                                
                                                <div class="fl c_999">销量：<?php echo $v['sale'];?></div>
                                               <div class="fr c_999">库存：<?php echo $v['stock'];?></div>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="prod_btn">
                                                <div class="num_box fl" style="margin-top: 3px;">
                                                    <input lang="sub" class="minusDisable num-ico" type="text">
                                                    <input id='txt_0' class="minicart_num" type="text" lang="1" value="1" orinum="1" count="0">
                                                    <input lang="add" class="plusDisable  num-ico" type="text">
                                                </div>
                                                    <input type="button" value="加入购物车" class="buy-btn fr livebuy" />
                                                <div class="clear"></div>
                                            </div>
                                            <div class="clear"></div>
                                            <p class="pro_address"><a href="<?php echo _u('/user/index/'.$v['uid'].'/');?>"><?php echo $v['uname'];?></a></p>
                                            <div class="clear"></div>
                                        </div>
                                    </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="pageWrap">
            <div class="turn_page clearfix"><a disabled="disabled" href="<?php echo _u('///'._v(3).'/0/');?>">首页</a>&nbsp;&nbsp;<a disabled="disabled" href="<?php echo _u('///'._v(3).'/'.Page::$pre.'/');?>">上一页</a>&nbsp;&nbsp;<a class="page_cur"><?php echo Page::$p;?></a>&nbsp;&nbsp;<a href="<?php echo _u('///'._v(3).'/'.Page::$next.'/');?>">下一页</a>&nbsp;&nbsp;<a href="<?php echo _u('///'._v(3).'/'.Page::$pnum.'/');?>">末页</a></div>
        </div>
    </div>
</div>
<!-- //主体 -->
<?php
_part('footer1');
_part('footer2');
_part('footer3');
?>
</body>
</html>