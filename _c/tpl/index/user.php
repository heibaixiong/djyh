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
		});
		$('#rightFrame', window.parent.document).attr('src', '<?php echo _u('/user/list//');?>');
	</script>
</head>
<body style="background:#f0f9fd;">
<div class="lefttop"><span></span>网点管理</div>
<dl class="leftmenu">
	<dd>
		<div class="title">
			<span><img src="<?php echo _img('leftico02.png');?>" /></span>账号
		</div>
		<ul class="menuson">
			<li><cite></cite><a href="<?php echo _u('/user/list//');?>" target="rightFrame">全部</a><i></i></li>
			<?php foreach ($_['user_ranks'] as $k => $rank) { ?>
				<li><cite></cite><a href="<?php echo _u('/user/list/'.$k.'/');?>" target="rightFrame"><?php echo $rank; ?></a><i></i></li>
			<?php } ?>
		</ul>
	</dd>
	<dd>
		<div class="title">
			<span><img src="<?php echo _img('leftico02.png');?>" /></span>网点
		</div>
		<ul class="menuson">
			<li><cite></cite><a href="<?php echo _u('/user/company//');?>" target="rightFrame">全部</a><i></i></li>
			<?php foreach ($_['user_ranks'] as $k => $rank) { ?>
				<li><cite></cite><a href="<?php echo _u('/user/company/'.$k.'/');?>" target="rightFrame"><?php echo $rank; ?></a><i></i></li>
			<?php } ?>
		</ul>
	</dd>
</dl>
</body>
</html>