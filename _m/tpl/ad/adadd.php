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
    <li>广告管理</li>
    <li>增加广告</li>
    </ul>
    </div>    
    <div class="formbody">    
    <div class="formtitle"><span>增加广告</span></div>
    <form action="<?php echo _u('//adadd/');?>" method="post" id="form1" name="form1">  
    <ul class="forminfo">
    <li><label>地区</label><input name="code" type="text" class="dfinput" /><i>0 为所有地区</i></li>
    <li><label>位置</label><input name="postion" type="text" class="dfinput" /><i>位置写法，请参照广告位置清单</i></li>
    <li><label>文字</label><input name="title" type="text" class="dfinput" /></li>
    <li><label>图片</label><input name="img" type="text" class="dfinput" /><?php echo _upload('img','form1');?></li>
    <li><label>连接</label><input name="url" type="text" class="dfinput" /></li>
    <li><label>显示/隐藏</label><input type="radio" name="state" value="0" />开 <input type="radio" name="state" value="1" />关</li>
    <li><label>排序</label><input name="px" type="text" class="dfinput" /></li>
    <li><label>&nbsp;</label><input name="" id="btn" type="button" class="btn" value="确认保存"/></li>
    </ul>
    </form>
    </div>
</body>
</html>