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
    <li>店铺信息</li>
    <li>基本信息</li>
    </ul>
    </div>    
    <div class="formbody">    
    <div class="formtitle"><span>基本信息</span></div>
    <form action="<?php echo _u('/work/configedit/');?>" method="post" id="form1">  
    <ul class="forminfo">
    <li><label>代理产品</label><input name="product" type="text" class="dfinput" value="<?php echo $_['rs']['product'];?>" /></li>
    <li><label>配送条件</label><input name="if" type="text" class="dfinput" value="<?php echo $_['rs']['if'];?>" /></li>
    <li><label>配送范围</label><input name="zone" type="text" class="dfinput" value="<?php echo $_['rs']['zone'];?>" /></li>
    <li><label>优惠政策</label><input name="good" type="text" class="dfinput" value="<?php echo $_['rs']['good'];?>" /></li>
    <li><label>&nbsp;</label><input name="" id="btn" type="button" class="btn" value="确认保存"/></li>
    </ul>
    </form>
    </div>
</body>
</html>