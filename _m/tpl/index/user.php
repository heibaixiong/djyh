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
	<div class="lefttop"><span></span>会员管理</div>    
    <dl class="leftmenu">    
    <dd>
    <div class="title">
    <span><img src="<?php echo _img('leftico02.png');?>" /></span>区域管理
    </div>
        <ul class="menuson">
        <?php
        if(_session('adminrank')<2){
        ?>
        <li><cite></cite><a href="<?php echo _u('/user/area/');?>" target="rightFrame">区域管理</a><i></i></li>
        <?php
        }
        ?>
        <li><cite></cite><a href="<?php echo _u('/user/join/');?>" target="rightFrame">加盟区域</a><i></i></li>
        </ul>
    </dd>    
    <dd>
    <div class="title">
    <span><img src="<?php echo _img('leftico02.png');?>" /></span>会员管理
    </div>
        <ul class="menuson">
        <li><cite></cite><a href="<?php echo _u('/user/list/0/');?>" target="rightFrame">总管理员</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/user/list/1/');?>" target="rightFrame">一般管理员</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/user/list/2/');?>" target="rightFrame">服务站</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/user/list/3/');?>" target="rightFrame">全商家</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/user/list/4/');?>" target="rightFrame">县区商家</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/user/list/5/');?>" target="rightFrame">网点</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/user/list/6/');?>" target="rightFrame">线下营销人员</a><i></i></li>
        </ul>
    </dd>
    <dd>
    <div class="title">
    <span><img src="<?php echo _img('leftico02.png');?>" /></span>限制会员管理
    </div>
        <ul class="menuson">
        <li><cite></cite><a href="<?php echo _u('/user/nolist/0/');?>" target="rightFrame">总管理员</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/user/nolist/1/');?>" target="rightFrame">一般管理员</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/user/nolist/2/');?>" target="rightFrame">服务站</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/user/nolist/3/');?>" target="rightFrame">全商家</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/user/nolist/4/');?>" target="rightFrame">县区商家</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/user/nolist/5/');?>" target="rightFrame">网点</a><i></i></li>
        <li><cite></cite><a href="<?php echo _u('/user/nolist/6/');?>" target="rightFrame">线下营销人员</a><i></i></li>
        </ul>
    </dd>
    </dl>
</body>
</html>