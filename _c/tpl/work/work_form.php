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
        <li>业务小哥</li>
        <li><?php echo isset($_['user']['id'])?'编辑':'新增'; ?></li>
    </ul>
</div>
<div class="formbody">
    <div class="formtitle"><span>小哥信息</span></div>
    <form action="<?php echo $_['form_action']; ?>" method="post" id="form1">
        <ul class="forminfo">
            <?php if (!isset($_['user']['id'])) { ?>
            <li>新增小哥请先关注微信公众平台，点击微信菜单【我要抢单】，提交小哥资料！</li>
            <?php } ?>
            <li><label>姓　　名</label><input name="real_name" type="text" class="dfinput" value="<?php echo isset($_['user']['real_name'])?$_['user']['real_name']:''; ?>" /></li>
            <li><label>身 份 证</label><input name="id_card" type="text" class="dfinput" value="<?php echo isset($_['user']['id_card'])?$_['user']['id_card']:''; ?>" /></li>
            <li data-toggle="distpicker"><label>所 在 地：</label><p>
                    <select id="pro_n" data-province="<?php echo isset($_['user']['prov'])?$_['user']['prov']:'河南省'; ?>" name="prov">

                    </select>
                    <select id="cit_n" data-city="<?php echo isset($_['user']['city'])?$_['user']['city']:''; ?>" name="city">

                    </select>
                    <select id="cou_n" data-district="<?php echo isset($_['user']['area'])?$_['user']['area']:''; ?>" name="area">

                    </select>
                </p></li>
            <li><label>电　　话</label><input name="phone" type="text" class="dfinput" value="<?php echo isset($_['user']['phone'])?$_['user']['phone']:''; ?>" /></li>
            <li><label>性　　别：</label><p>
                    <select name="sex">
                        <option value="男"<?php if (isset($_['user']['sex']) && $_['user']['sex']=='男') echo ' selected="selected"'; ?>>男</option>
                        <option value="女"<?php if (isset($_['user']['sex']) && $_['user']['sex']=='女') echo ' selected="selected"'; ?>>女</option>
                    </select>
                </p></li>
            <li><label>年　　龄：</label><p><input type="text" name="age" value="<?php echo isset($_['user']['age']) ? $_['user']['age'] : ''; ?>" class="dfinput" /></p></li>
            <li><label>学　　历：</label><p><input type="text" name="edu" value="<?php echo isset($_['user']['edu']) ? $_['user']['edu'] : ''; ?>" class="dfinput" /></p></li>
            <li><label>经　　验：</label><p><input type="text" name="exp" value="<?php echo isset($_['user']['exp']) ? $_['user']['exp'] : ''; ?>" class="dfinput" /></p></li>
            <li><label>备　　注：</label><p><input type="text" name="note" value="<?php echo isset($_['user']['note']) ? $_['user']['note'] : ''; ?>" class="dfinput" /></p></li>
            <li>
                <label>网　　点</label>
                <select name="mid">
                    <option value="">请选择</option>
                    <?php foreach ($_['company'] as $company) { ?>
                        <option value="<?php echo $company['id']; ?>"<?php echo isset($_['user']['mid'])&&$_['user']['mid']==$company['id']?' selected="selected"':''; ?>><?php echo $company['name']; ?></option>
                    <?php } ?>
                </select>
            </li>
            <li>
                <label>状　　态</label>
                <p style="padding-top: 10px;">
                <?php if (isset($_['user']['status']) && $_['user']['status']==1) { ?>
                    <input type="radio" name="status" value="1" checked="checked" /> 启用&nbsp;&nbsp;
                    <input type="radio" name="status" value="0" /> 停用
                <?php } else { ?>
                    <input type="radio" name="status" value="1" /> 启用&nbsp;&nbsp;
                    <input type="radio" name="status" value="0" checked="checked" /> 停用
                <?php } ?>
                </p>
            </li>
            <li><label>&nbsp;</label><input type="submit" class="btn" value="确认保存"/></li>
        </ul>
    </form>
</div>
</body>
</html>