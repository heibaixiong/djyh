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
    <li>分类管理</li>
    <li>编辑品牌/价格区间</li>
    </ul>
    </div>    
    <div class="formbody">    
    <div class="formtitle"><span>编辑品牌/价格区间</span></div>
    <form action="<?php echo $_wrap['ctrl_url'].$_vew[1].'/'.$_vew[2];?>" method="post" id="form1">
        <ul class="forminfo"><input type="hidden" value="<?php echo $_['rs']['id'];?>" name="id" />
        <li><label>品牌</label><textarea name="brand" rows="5" cols="60"><?php echo $_['rs']['brand'];?></textarea></li>
        <li><label>价格区间</label><textarea name="price" rows="5" cols="60"><?php echo $_['rs']['price'];?></textarea></li>
        <li><label>&nbsp;</label><input name="" id="btn" type="button" class="btn" value="确认保存"/></li>
        </ul>
    </form>
    </div>
</body>
</html>