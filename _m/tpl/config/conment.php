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
    <li>系统设置</li>
    <li>访客评论开关</li>
    </ul>
    </div>    
    <div class="formbody">    
    <div class="formtitle"><span>访客评论开关</span></div>
    <form action="<?php echo _u('/config/conmentedit/');?>" method="post" id="form1">  
    <ul class="forminfo">
    <li><input type="radio" name="conment" value="0" <?php if($_['rs']['conment']==0)echo 'checked'?> /><i>访客评论开启</i></li>
    <li><input type="radio" name="conment" value="1" <?php if($_['rs']['conment']==1)echo 'checked'?> /><i>访客评论关闭</i></li>
    <li><label>&nbsp;</label><input name="" id="btn" type="button" class="btn" value="确认保存"/></li>
    </ul>
    </form>
    </div>
</body>
</html>