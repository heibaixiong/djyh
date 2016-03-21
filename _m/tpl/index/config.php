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
	<div class="lefttop"><span></span>系统设置</div>    
    <dl class="leftmenu">
    <dd>
    <div class="title">
    <span><img src="<?php echo _img('leftico02.png');?>" /></span>网站信息
    </div>
        <ul class="menuson">
        <li><cite></cite><a href="<?php echo _u('/config/config/');?>" target="rightFrame">基本信息</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/config/link/');?>" target="rightFrame">联系方式</a><i></i></li>
        </ul>
    </dd>
    <dd>
    <div class="title">
    <span><img src="<?php echo _img('leftico01.png');?>" /></span>系统设置
    </div>
    	<ul class="menuson">
        <li><cite></cite><a href="<?php echo _u('/config/web/');?>" target="rightFrame">网站开关</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/config/sms/');?>" target="rightFrame">短信开关</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/config/conment/');?>" target="rightFrame">评论开关</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/config/smsset/');?>" target="rightFrame">短信接口设置</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/config/playset/');?>" target="rightFrame">支付接口设置</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/config/shareset/');?>" target="rightFrame">服务站分润比例设置</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/config/cashset/');?>" target="rightFrame">商家提现最低金额设置</a><i></i></li>
        </ul>
    </dd>
    <dd>
    <div class="title">
    <span><img src="<?php echo _img('leftico02.png');?>" /></span>更新缓存
    </div>
        <ul class="menuson">
        <li><cite></cite><a href="<?php echo _u('/cache/config/');?>" target="rightFrame">网站配置</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/cache/oneclass/');?>" target="rightFrame">网站分类</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/cache/index/');?>" target="rightFrame">首页展示</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/cache/duilian/');?>" target="rightFrame">对联广告</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/cache/temai/');?>" target="rightFrame">首页特卖</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/cache/indexad/');?>" target="rightFrame">首页通栏广告</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/cache/article/');?>" target="rightFrame">文章列表</a><i></i></li>
        </ul>
    </dd>
    </dl>
</body>
</html>