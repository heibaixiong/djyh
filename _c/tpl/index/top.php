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
	//顶部导航切换
	$(".nav li a").click(function(){
		$(".nav li a.selected").removeClass("selected")
		$(this).addClass("selected");
	})
})
</script>
</head>
<body style="background:url(<?php echo _img('topbg.gif');?>) repeat-x;">
    <div class="topleft">
    <a href="<?php echo _u('/index/index/');?>" target="_parent"><img src="<?php echo _img('logo.png');?>" title="系统首页" /></a>
    </div>
    <ul class="nav">
    <li><a href="<?php echo _u('/index/query/');?>" target="leftFrame"><img src="<?php echo _img('icon14.png');?>" title="查询统计" /><h2>查询统计</h2></a></li>
        <li><a href="<?php echo _u('/index/order/');?>"  target="leftFrame"><img src="<?php echo _img('icon16.png');?>" title="业务管理" /><h2>业务管理</h2></a></li>
        <li><a href="<?php echo _u('/index/work/');?>"  target="leftFrame"><img src="<?php echo _img('icon13.png');?>" title="员工管理" /><h2>员工管理</h2></a></li>
    <?php
    if(_session('adminrank')<5){
    ?>
<!--    <li><a href="<?php /*echo _u('/index/shop/');*/?>"  target="leftFrame"><img src="<?php /*echo _img('icon04.png');*/?>" title="商城管理" /><h2>商城管理</h2></a></li>
-->    <?php
    }
    ?>
    <?php
    if(_session('adminrank')<3){
    ?>
<!--    <li><a href="<?php /*echo _u('/index/ad/');*/?>" target="leftFrame"><img src="<?php /*echo _img('icon09.png');*/?>" title="广告管理" /><h2>广告管理</h2></a></li>
-->    <?php
    }
    ?>
    <?php
    if(_session('adminrank')<2){
    ?>
<!--    <li><a href="<?php /*echo _u('/index/article/');*/?>" target="leftFrame"><img src="<?php /*echo _img('icon01.png');*/?>" title="文章/公告" /><h2>文章公告新闻</h2></a></li>
    <li><a href="<?php /*echo _u('/index/logs/');*/?>" target="leftFrame"><img src="<?php /*echo _img('icon05.png');*/?>" title="网站日志" /><h2>网站日志</h2></a></li>-->
    <li><a href="<?php echo _u('/index/user/');?>"  target="leftFrame"><img src="<?php echo _img('icon08.png');?>" title="网点管理" /><h2>网点管理</h2></a></li>
    <?php
    }
    ?>
        <li><a href="<?php echo _u('/index/config/');?>"  target="leftFrame"><img src="<?php echo _img('icon06.png');?>" title="基本设置" /><h2>基本设置</h2></a></li>
    </ul>
    <div class="topright">
    <ul>
    <li><span><img src="<?php echo _img('help.png');?>" title="帮助" class="helpimg"/></span><a href="#">帮助</a></li>
    <li><a href="#">关于</a></li>
    <li><a href="<?php echo _u('/login/out/');?>" target="_parent">退出</a></li>
    </ul>     
    <div class="user">
    <span><?php echo _session('adminuser');?></span>
    <i>消息</i>
    <b>5</b>
    </div>
    </div>
</body>
</html>