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
    $("#btn").click(function(){
        $("#form1").submit();
    });
});
</script>
</head>
<body>
	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li>首页</li>
    <li>网站信息</li>
    <li>基本信息</li>
    </ul>
    </div>    
    <div class="formbody">    
    <div class="formtitle"><span>基本信息</span></div>
    <form action="<?php echo _u('/config/config/');?>" method="post" id="form1">  
    <ul class="forminfo">
    <li><label>网站标题</label><input name="title" type="text" class="dfinput" value="<?php echo $_['rs']['title'];?>" /></li>
    <li><label>网址</label><input name="url" type="text" class="dfinput" value="<?php echo $_['rs']['url'];?>" /></li>
    <li><label>网站关键词</label><input name="keyword" type="text" class="dfinput" value="<?php echo $_['rs']['keyword'];?>" /></li>
    <li><label>网站描述</label><textarea name="descri" rows="5" cols="60"><?php echo $_['rs']['descri'];?></textarea></li>
    <li><label>商城名称</label><input name="name" type="text" class="dfinput" value="<?php echo $_['rs']['name'];?>" /></li>
    <li><label>虚拟币名称</label><input name="dummy" type="text" class="dfinput" value="<?php echo $_['rs']['dummy'];?>" /></li>
    <li><label>公司名称</label><input name="compony" type="text" class="dfinput" value="<?php echo $_['rs']['compony'];?>" /></li>
    <li><label>ICP备案</label><input name="icp" type="text" class="dfinput" value="<?php echo $_['rs']['icp'];?>" /></li>
    <li><label>&nbsp;</label><input name="" id="btn" type="button" class="btn" value="确认保存"/></li>
    </ul>
    </form>
    </div>
</body>
</html>