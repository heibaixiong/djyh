<?php
if(!defined('PART'))exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
_css('style');
_jq();
?>
<script type="text/javascript">
$(function(){
	//导航切换
	$(".menuson .header").click(function(){
		var $parent = $(this).parent();
		$(".menuson>li.active").not($parent).removeClass("active open").find('.sub-menus').hide();
		$parent.addClass("active");
		if(!!$(this).next('.sub-menus').size()){
			if($parent.hasClass("open")){
				$parent.removeClass("open").find('.sub-menus').hide();
			}else{
				$parent.addClass("open").find('.sub-menus').show();	
			}
		}
	});	
	// 三级菜单点击
	$('.sub-menus li').click(function(e) {
        $(".sub-menus li.active").removeClass("active")
		$(this).addClass("active");
    });	
	$('.title').click(function(){
		var $ul = $(this).next('ul');
		$('dd').find('.menuson').slideUp();
		if($ul.is(':visible')){
			$(this).next('.menuson').slideUp();
		}else{
			$(this).next('.menuson').slideDown();
		}
	});
})	
</script>
</head>
<body style="background:#f0f9fd;">
	<div class="lefttop"><span></span>商城管理</div>
    <dl class="leftmenu">
    <?php
    if(_session('adminrank')<2){
    ?>
    <dd>
    <div class="title">
    <span><img src="<?php echo _img('leftico03.png');?>" /></span>商城设置
    </div>
        <ul class="menuson">        
        <li><cite></cite><a href="<?php echo _u('/config/search/');?>" target="rightFrame">搜索设置</a></li>
        </ul>
    </dd>
    <?php
    }
    ?>
    <dd>
    <div class="title">
    <span><img src="<?php echo _img('leftico01.png');?>" /></span>商品管理
    </div>
    	<ul class="menuson">        
        <li><cite></cite><a href="<?php echo _u('/class/list/');?>" target="rightFrame">分类列表</a></li>
        <?php
        if(_session('adminrank')<2){
        ?>
        <li><cite></cite><a href="<?php echo _u('/class/up/');?>" target="rightFrame">更新分类信息</a></li>
        <li><cite></cite><a href="<?php echo _u('/attri/list/');?>" target="rightFrame">属性列表</a></li>
        <li><cite></cite><a href="<?php echo _u('/attri/up/');?>" target="rightFrame">更新属性信息</a></li>
        <li><cite></cite><a href="<?php echo _u('/para/list/');?>" target="rightFrame">参数列表</a></li>
        <li><cite></cite><a href="<?php echo _u('/para/up/');?>" target="rightFrame">更新参数信息</a></li>
        <li><cite></cite><a href="<?php echo _u('/unit/list/');?>" target="rightFrame">单位列表</a></li>
        <li><cite></cite><a href="<?php echo _u('/unit/up/');?>" target="rightFrame">更新单位信息</a></li>
        <?php
        }
        ?>
        </ul>
    </dd>
    <?php
    if(_session('adminrank')<5){
    ?>
    <dd>
    <div class="title">
    <span><img src="<?php echo _img('leftico02.png');?>" /></span>商品列表
    </div>
        <ul class="menuson">
        <li><cite></cite><a href="<?php echo _u('/shop/shoplist/');?>" target="rightFrame">全商品列表</a></li>
        <li><cite></cite><a href="<?php echo _u('/shop/shoplist/');?>" target="rightFrame">县区商品列表</a></li>
        </ul>
    </dd>
    <dd>
    <div class="title">
    <span><img src="<?php echo _img('leftico03.png');?>" /></span>问题商品
    </div>
        <ul class="menuson">
        <li><cite></cite><a href="<?php echo _u('/shop/noimglist/');?>" target="rightFrame">商品无主图</a></li>
        <li><cite></cite><a href="<?php echo _u('/shop/hiddenlist/');?>" target="rightFrame">隐藏商品列表</a></li>
        <li><cite></cite><a href="<?php echo _u('/shop/pricelist/');?>" target="rightFrame">价格异议商品列表</a></li>
        <li><cite></cite><a href="<?php echo _u('/shop/stock/');?>" target="rightFrame">重新计算库存</a></li>
        <li><cite></cite><a href="<?php echo _u('/shop/stocklist/');?>" target="rightFrame">库存为0商品列表</a></li>
        </ul>
    </dd>
    <dd>
    <div class="title">
    <span><img src="<?php echo _img('leftico04.png');?>" /></span>数据分析
    </div>
        <ul class="menuson">
        <li><cite></cite><a href="<?php echo _u('/shop/pxstocklist/');?>" target="rightFrame">销量排行榜</a></li>
        <li><cite></cite><a href="<?php echo _u('/shop/pxhotlist/');?>" target="rightFrame">关注排行榜</a></li>
        </ul>
    </dd>
    <?php
    }
    ?>
    </dl>
</body>
</html>