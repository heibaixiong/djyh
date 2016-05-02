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
    <li>公告管理</li>
    <li>编辑公告</li>
    </ul>
    </div>    
    <div class="formbody">
    <div id="usual1" class="usual">
        <form action="<?php echo _u('//noticeedit/');?>" method="post" id="form1" name="form1">
            <div id="tab1" class="tabson">    
                    <ul class="forminfo">
                        <li><label>公告标题<b>*</b></label><input name="title" type="text" class="dfinput" value="<?php echo $_['rs']['title'];?>" /><input type="hidden" value="<?php echo $_['rs']['id'];?>" name="id" /></li>
                        <li><label>公告内容</label><textarea name="mess" id="mess" width="600" height="600" class="textinput"><?php echo $_['rs']['mess'];?></textarea></li>
                        <li><label>&nbsp;</label><input name="" id="btn" type="button" class="btn" value="确认保存"/></li>
                    </ul>   
            </div>
        </form>
    </div> 
    </div>
</body>
</html>