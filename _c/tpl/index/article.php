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
	<div class="lefttop"><span></span>公告管理</div>    
    <dl class="leftmenu">
    <dd>
    <div class="title">
    <span><img src="<?php echo _img('leftico01.png');?>" /></span>公告管理
    </div>
        <ul class="menuson">
        <li><cite></cite><a href="<?php echo _u('/article/notice/');?>" target="rightFrame">公告列表</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/article/noticeadd/');?>" target="rightFrame">增加公告</a><i></i></li>
        </ul>
    </dd>
    <dd>
    <div class="title">
    <span><img src="<?php echo _img('leftico02.png');?>" /></span>文章管理
    </div>
        <ul class="menuson">
        <li><cite></cite><a href="<?php echo _u('/article/articleclass/');?>" target="rightFrame">文章分类列表</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/article/articleclassadd/');?>" target="rightFrame">增加文章分类</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/article/article/');?>" target="rightFrame">文章列表</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/article/articleadd/');?>" target="rightFrame">增加文章</a><i></i></li>
        </ul>
    </dd>
    <dd>
    <div class="title">
    <span><img src="<?php echo _img('leftico03.png');?>" /></span>新闻管理
    </div>
        <ul class="menuson">
        <li><cite></cite><a href="<?php echo _u('/article/newsclass/');?>" target="rightFrame">新闻分类列表</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/article/newsclassadd/');?>" target="rightFrame">增加新闻分类</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/article/news/');?>" target="rightFrame">新闻列表</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/article/newsadd/');?>" target="rightFrame">增加新闻</a><i></i></li>
        </ul>
    </dd>
    <dd>
    <div class="title">
    <span><img src="<?php echo _img('leftico03.png');?>" /></span>更新文章分类缓存
    </div>
        <ul class="menuson">
        <li><cite></cite><a href="<?php echo _u('/article/cache/');?>" target="rightFrame">更新文章分类</a><i></i></li>
        </ul>
    </dd>
    </dl>
</body>
</html>