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
    _js('distpicker.data');
    _js('distpicker');
    ?>
</head>
<body>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li>首页</li>
        <li>账号信息</li>
        <li>设置</li>
    </ul>
</div>
<div class="formbody">
    <div class="formtitle"><span>修改密码</span></div>
    <form action="<?php echo $_['form_action']; ?>" method="post" id="form1">
        <ul class="forminfo">
            <li>
                <label>原 密 码</label>
                <input name="old_pass" type="password" class="dfinput" />
            </li>
            <li>
                <label>新 密 码</label>
                <input name="new_pass" type="password" class="dfinput" />
            </li>
            <li>
                <label>再次输入</label>
                <input name="conf_pass" type="password" class="dfinput" />
            </li>
            <li><label>&nbsp;</label><input type="submit" class="btn" value="确认保存"/></li>
        </ul>
    </form>
</div>
</body>
</html>