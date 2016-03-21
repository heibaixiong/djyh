<?php
if(!defined('PART'))exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
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
    <li>属性子管理</li>
    <li>添加子属性</li>
    </ul>
    </div>    
    <div class="formbody">    
    <div class="formtitle"><span>添加子属性</span></div>
    <form action="<?php echo _u('//add/');?>" method="post" id="form1">
        <ul class="forminfo">
        <li><label>子属性名称</label><input name="title" type="text" class="dfinput" /><input name="pid" type="hidden" class="dfinput" value="<?php echo _v(3);?>" /></li>
        <li><label>属性值</label><input name="content" type="text" class="dfinput" /><i>多个值用英文逗号隔开</i></li>
        <li><label>显示/隐藏</label><input type="radio" name="state" value="0" checked="checked" />开 <input type="radio" name="state" value="1" />关</li>
        <li><label>排序</label><input name="px" type="text" class="dfinput" value="0" /></li>
        <li><label>&nbsp;</label><input name="" id="btn" type="button" class="btn" value="确认保存"/></li>
        </ul>
    </form>
    </div>
</body>
</html>