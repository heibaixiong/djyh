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
_js('shop');
?>
</head>
<body>
<?php
_part('top');
_part('head');
_part('nav');
?>
<div class="layout_wrap">
        <div class="clearfix">
            <div id="cat" class="list_left mt10">
					<h3 lang="sli"><span class="bg_sprite icon_filter icon_open"></span><?php echo $_['classtitle'];?></h3>
					<div style="display:block;" class="list_son">
						<ul>
							<?php
							foreach($_['shopclass'] as $k=>$v){
							?>
							<li><a href="<?php echo _u('//index/'.$v['id'].'/')?>"><?php echo $v['title'];?></a></li>
							<?php
							}
							?>
						</ul>
					</div>
				</div>
				<script>
					$("#cat h3").click(function(){
						$(this).addClass("icon_open").next("div.list_son").slideToggle(300).siblings("div.list_son").slideUp("slow");
						$(this).siblings().removeClass("icon_open");
					});
				</script>
            <div class="list_main mt10">
                <div id="tabList" class="mod_search_crumb clearfix"><span class="crumb_ico bg_sprite"></span><span class="crumb_list"><?php echo $_['classtitle']?></span><span class="crumb_triangle bg_sprite"></span><span class="crumb_list"><?php echo $_['title']?></span></div>
                <div>
                    <div class="list_condition clearfix mt10">
                        <ul id="ulTab" class="list_condition_main clearfix">
                            <li class="cur" id="isDefault"><a href="<?php echo _u('///'._v(3).'/'._v(4).'/0/');?>">默认排序</a></li>
                            <li class="" id="isSale"><a href="<?php echo _u('///'._v(3).'/'._v(4).'/1/');?>">销量</a><i class="bg_sprite"></i></li>
                            <li class="" id="isPrice"><a href="<?php echo _u('///'._v(3).'/'._v(4).'/2/');?>">价格</a><i class="bg_sprite"></i></li>
                        </ul>
                        <div class="list_page">
                            <div class="page_num">
                            </div>
                        </div>
                    </div>
                    <div class="search_table">
                        <div class="search_list ">
                                <ul>
                                	<?php
                                	foreach(Page::$arr as $k=>$v){
                                	?>
                                        <li class="search_item search_item240">
                                           <div class="search_item_box">
                                                <div class="prod_img">
                                                    <a href="<?php echo _u('//show/'.$v['id'].'/');?>" target="_blank">
                                                        <img style="display: inline;" alt="" src="<?php echo _resize($v['img'], 210, 210); ?>">
                                                    </a>
                                                </div>
                                                <div style="position: relative;">
                                                        <p class="prod_price"><span class="prod_price_up"><span>¥<?php echo _rmb($v['mark']/100);?></span></span></p>
                                                </div>
                                                <div class="clear"></div>
                                                <p class="prod_title"><a href="<?php echo _u('//show/'.$v['id'].'/');?>" target="_blank"><?php echo $v['title'];?></a></p>
                                                <div class="clear"></div>
                                                <div class="prod_num">                                                    
                                                    <div class="fl c_999">销量：<?php echo $v['sale'];?></div>
                                                    <div class="fr c_999">库存：<?php echo $v['stock'];?></div>
                                                </div>
                                                <div class="clear"></div>
                                                <div class="prod_btn">
                                                    <div style="margin-top: 3px;" class="num_box fl">
                                                        <input type="text" class="minusDisable num-ico sub">
                                                        <input lang="1" type="text" count="<?php echo $v['stock'];?>" orinum="1" value="1" class="minicart_num">
                                                        <input type="text" class="plusDisable  num-ico add">
                                                    </div>
                                                        <input type="button" class="buy-btn fr" value="加入购物车" data="<?php echo $v['id'];?>">
                                                    <div class="clear"></div>
                                                </div>
                                                <div class="clear"></div>                                                
                                                <a href="<?php echo _u('/user/index/'.$v['uid'].'/');?>" class="pro_address"><?php echo $v['uname'];?></a>
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
        <div style="float: right" class="pageWrap">
                <div class='turn_page clearfix'>
                    <div class="fr"><a disabled="disabled" href="<?php echo _u('///'._v(3).'/0/');?>">首页</a><a disabled="disabled" href="<?php echo _u('///'._v(3).'/'.Page::$pre.'/');?>">上一页</a><a class="page_cur"><?php echo Page::$p.'/'.Page::$pnum;?></a><a href="<?php echo _u('///'._v(3).'/'.Page::$next.'/');?>">下一页</a><a href="<?php echo _u('///'._v(3).'/'.Page::$pnum.'/');?>">尾页</a></div>
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