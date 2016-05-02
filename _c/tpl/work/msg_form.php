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
</head>
<body>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li>首页</li>
        <li>员工管理</li>
        <li>消息</li>
    </ul>
</div>
<div class="formbody">
    <div class="formtitle"><span>微信消息</span></div>
    <form action="<?php echo $_['form_action']; ?>" method="post" id="form1">
        <ul class="forminfo">
            <li>
                <label>Open Id</label>
                <input name="open_id" type="text" class="dfinput" value="" />
            </li>
            <li>
                <label>Message</label>
                <input name="message" type="text" class="dfinput" value="" />
            </li>
            <li><label>&nbsp;</label><input type="submit" class="btn" value="发送"/></li>
        </ul>
    </form>
</div>
</body>
</html>