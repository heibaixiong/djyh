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
_editor('mess');
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
    <li>新闻分类管理</li>
    <li>添加新闻分类</li>
    </ul>
    </div>    
    <div class="formbody">
    <div id="usual1" class="usual">
        <form action="<?php echo _u('//newsclassadd/');?>" method="post" id="form1" name="form1">
            <div id="tab1" class="tabson">    
                    <ul class="forminfo">
                        <li><label>新闻分类名称<b>*</b></label><input name="title" type="text" class="dfinput" /></li>
                        <li><label>显示/隐藏</label><input type="radio" name="state" value="0" checked="checked" />开 <input type="radio" name="state" value="1" />关</li>
                        <li><label>排序</label><input name="px" type="text" class="dfinput" value="0" /></li>
                        <li><label>&nbsp;</label><input name="" id="btn" type="button" class="btn" value="确认保存"/></li>
                    </ul>   
            </div>
        </form>
    </div> 
    </div>
</body>
</html>