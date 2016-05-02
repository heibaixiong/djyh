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
    <div class="formtitle"><span>基本信息</span></div>
    <form action="<?php echo $_['form_action']; ?>" method="post" id="form1">
        <ul class="forminfo">
            <li>
                <label>账号</label>
                <p style="padding-top: 10px;"><?php echo isset($_['user']['user'])?$_['user']['user']:''; ?></p>
            </li>
            <li><label>姓名</label><input name="name" type="text" class="dfinput" value="<?php echo isset($_['user']['name'])?$_['user']['name']:''; ?>" /></li>
            <li><label>网点</label><input name="company" type="text" class="dfinput" value="<?php echo isset($_['user']['company'])?$_['user']['company']:''; ?>" /></li>
            <li data-toggle="distpicker"><label>所 在 地：</label><p>
                    <select id="pro_n" data-province="<?php echo isset($_['user']['prov'])?$_['user']['prov']:'河南省'; ?>" name="prov">

                    </select>
                    <select id="cit_n" data-city="<?php echo isset($_['user']['city'])?$_['user']['city']:''; ?>" name="city">

                    </select>
                    <select id="cou_n" data-district="<?php echo isset($_['user']['area'])?$_['user']['area']:''; ?>" name="area">

                    </select>
                </p></li>
            <li><label>地址</label><input name="address" type="text" class="dfinput" value="<?php echo isset($_['user']['address'])?$_['user']['address']:''; ?>" /></li>
            <li><label>电话</label><input name="phone" type="text" class="dfinput" value="<?php echo isset($_['user']['phone'])?$_['user']['phone']:''; ?>" /></li>
            <li><label>登记时间</label><p style="padding-top: 10px;"><?php echo isset($_['user']['regtime'])?_time($_['user']['regtime']):''; ?></p></li>
            <li><label>最后登录</label><p style="padding-top: 10px;"><?php echo isset($_['user']['updatetime'])?_time($_['user']['updatetime']):''; ?></p></li>
            <li><label>&nbsp;</label><input type="submit" class="btn" value="确认保存"/></li>
        </ul>
    </form>
</div>
</body>
</html>