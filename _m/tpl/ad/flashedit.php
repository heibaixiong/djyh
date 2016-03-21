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
    <li>幻灯片管理</li>
    <li>编辑幻灯片</li>
    </ul>
    </div>    
    <div class="formbody">    
    <div class="formtitle"><span>编辑幻灯片</span></div>
    <form action="<?php echo _u('//edit/');?>" method="post" id="form1" name="form1">
        <ul class="forminfo">
        <li><label>地区</label><input name="code" type="text" class="dfinput" value="<?php echo $_['rs']['code'];?>" /><input type="hidden" value="<?php echo $_['rs']['id'];?>" name="id" /><i>0 为所有地区</i></li>
        <li><label>文字</label><input name="title" type="text" class="dfinput" value="<?php echo $_['rs']['title'];?>" /></li>
        <li><label>图片</label><input name="img" type="text" class="dfinput" value="<?php echo $_['rs']['img'];?>" /><?php echo _upload('img','form1');?></li>
        <li><label>连接</label><input name="url" type="text" class="dfinput" value="<?php echo $_['rs']['url'];?>" /></li>
        <li><label>显示/隐藏</label><input type="radio" name="state" value="0" <?php if($_['rs']['state']==0)echo 'checked'?> /> 开 <input type="radio" name="state" value="1" <?php if($_['rs']['state']==1)echo 'checked'?> /> 关</li>
        <li><label>排序</label><input name="px" type="text" class="dfinput" value="<?php echo $_['rs']['px'];?>" /></li>
        <li><label>&nbsp;</label><input name="" id="btn" type="button" class="btn" value="确认编辑"/></li>
        </ul>
    </form>
    </div>
</body>
</html>