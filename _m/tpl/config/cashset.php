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
    <li>商家提现最低金额设置</li>
    </ul>
    </div>    
    <div class="formbody">    
    <div class="formtitle"><span>商家提现最低金额设置</span></div>
    <form action="<?php echo _u('/config/cashsetedit/');?>" method="post" id="form1">  
    <ul class="forminfo">
    <li><label>金额</label><input name="smsuser" type="text" class="dfinput" value="<?php echo $_['rs']['cash'];?>" /> 元</li>
    <li><label>&nbsp;</label><input name="" id="btn" type="button" class="btn" value="确认保存"/></li>
    </ul>
    </form>
    </div>
</body>
</html>