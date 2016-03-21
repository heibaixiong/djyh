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
    <li>商城管理</li>
    <li>搜索设置</li>
    </ul>
    </div>    
    <div class="formbody">    
    <div class="formtitle"><span>搜索设置</span></div>
    <form action="<?php echo _u('/config/searchedit/');?>" method="post" id="form1">  
    <ul class="forminfo">
    <li><label>搜索词</label><input name="search" type="text" class="dfinput" value="<?php echo $_['rs']['search'];?>" /><i>多个搜索词用英文逗号隔开</i></li>
    <li><label>&nbsp;</label><input name="" id="btn" type="button" class="btn" value="确认保存"/></li>
    </ul>
    </form>
    </div>
</body>
</html>