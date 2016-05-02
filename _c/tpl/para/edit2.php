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
    <li>子参数管理</li>
    <li>编辑子参数</li>
    </ul>
    </div>    
    <div class="formbody">    
    <div class="formtitle"><span>编辑子参数</span></div>
    <form action="<?php echo _u('//edit/'); ?>" method="post" id="form1">
        <ul class="forminfo">
        <li><label>子参数名称</label><input name="title" type="text" class="dfinput" value="<?php echo $_['rs']['title'];?>" /><input name="pid" type="hidden" class="dfinput" value="<?php echo $_['rs']['pid'];?>" /><input type="hidden" value="<?php echo $_['rs']['id'];?>" name="id" /></li>
        <li><label>显示/隐藏</label><input type="radio" name="state" value="0" <?php if($_['rs']['state']==0)echo 'checked'?> /> 开 <input type="radio" name="state" value="1" <?php if($_['rs']['state']==1)echo 'checked'?> /> 关</li>
        <li><label>排序</label><input name="px" type="text" class="dfinput" value="<?php echo $_['rs']['px'];?>" /><i>数越大越靠前</i></li>
        <li><label>&nbsp;</label><input name="" id="btn" type="button" class="btn" value="确认编辑"/></li>
        </ul>
    </form>
    </div>
</body>
</html>