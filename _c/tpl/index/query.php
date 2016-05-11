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
	<div class="lefttop"><span></span>查询统计</div>
	<dl class="leftmenu">
		<dd>
			<div class="title">
				<span><img src="<?php echo _img('leftico01.png');?>" /></span>订单
			</div>
			<ul class="menuson">
				<li><cite></cite><a href="<?php echo _u('/order/search/');?>" target="rightFrame">查询</a></li>
				<li><cite></cite><a href="<?php echo _u('/order/statics/');?>" target="rightFrame">统计</a></li>
			</ul>
		</dd>
		<dd>
			<div class="title">
				<span><img src="<?php echo _img('leftico01.png');?>" /></span>运单
			</div>
			<ul class="menuson">
				<li><cite></cite><a href="<?php echo _u('/ship/list//');?>" target="rightFrame">查询</a></li>
				<li><cite></cite><a href="<?php echo _u('/ship/list//');?>" target="rightFrame">统计</a></li>
			</ul>
		</dd>
		<dd>
			<div class="title">
				<span><img src="<?php echo _img('leftico01.png');?>" /></span>配载单
			</div>
			<ul class="menuson">
				<li><cite></cite><a href="<?php echo _u('/stowage/list/');?>" target="rightFrame">查询</a></li>
				<li><cite></cite><a href="<?php echo _u('/stowage/list/');?>" target="rightFrame">统计</a></li>
			</ul>
		</dd>
		<dd>
			<div class="title">
				<span><img src="<?php echo _img('leftico01.png');?>" /></span>车辆
			</div>
			<ul class="menuson">
				<li><cite></cite><a href="<?php echo _u('/carrier/car/');?>" target="rightFrame">车辆查询</a></li>
				<li><cite></cite><a href="<?php echo _u('/carrier/driver/');?>" target="rightFrame">承运人查询</a></li>
			</ul>
		</dd>
		<dd>
			<div class="title">
				<span><img src="<?php echo _img('leftico01.png');?>" /></span>业务员
			</div>
			<ul class="menuson">
				<li><cite></cite><a href="<?php echo _u('/work/query/');?>" target="rightFrame">查询</a></li>
				<li><cite></cite><a href="<?php echo _u('/work/count/');?>" target="rightFrame">统计</a></li>
			</ul>
		</dd>
	</dl>
</body>
</html>