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
    <li>区域管理</li>
    <li>编辑区域</li>
    </ul>
    </div>    
    <div class="formbody">    
    <div class="formtitle"><span>编辑区域</span></div>
    <form action="<?php echo _u('///');?>" method="post" id="form1">  
    <ul class="forminfo">
    <li><label>账号</label><input name="code" type="text" class="dfinput" value="<?php echo $_['rs']['code'];?>" /><input type="hidden" value="<?php echo $_['rs']['id'];?>" name="id" /></li>
    <li><label>地址</label><input name="title" type="text" class="dfinput" value="<?php echo $_['rs']['title'];?>" /><i>请勿任意修改</i></li>
    <li><label>代理id</label><input name="uid" type="text" class="dfinput" value="<?php echo $_['rs']['uid'];?>" /></li>
    <li><label>排序</label><input name="px" type="text" class="dfinput" value="<?php echo $_['rs']['px'];?>" /><i>数越小越靠前</i></li>
    <li><label>&nbsp;</label><input name="" id="btn" type="button" class="btn" value="确认保存"/></li>
    </ul>
    </form>
    </div>
</body>
</html>