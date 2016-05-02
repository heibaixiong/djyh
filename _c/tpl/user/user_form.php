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
        <li>账号管理</li>
        <li><?php echo isset($_['user']['id'])?'编辑':'新增'; ?></li>
    </ul>
</div>
<div class="formbody">
    <div class="formtitle"><span>账号信息</span></div>
    <form action="<?php echo $_['form_action']; ?>" method="post" id="form1">
        <ul class="forminfo">
            <li>
                <label>账号</label>
                <input name="user" type="text" class="dfinput" value="<?php echo isset($_['user']['user'])?$_['user']['user']:''; ?>"<?php echo isset($_['user']['user'])?' readonly':''; ?> />
                <?php if (isset($_['user']['id'])) { ?>
                    <i>账号不能修改！</i>
                <?php } ?>
            </li>
            <li>
                <label>密码</label>
                <input name="pass" type="password" class="dfinput" />
                <?php if (isset($_['user']['id'])) { ?>
                    <i>密码留空则不修改！</i>
                <?php } ?>
            </li>
            <li><label>姓名</label><input name="name" type="text" class="dfinput" value="<?php echo isset($_['user']['name'])?$_['user']['name']:''; ?>" /></li>
            <li>
                <label>网点</label>
                <input name="company" type="hidden" value="<?php echo isset($_['user']['company'])?$_['user']['company']:''; ?>" />
                <select name="code">
                    <?php foreach ($_['company'] as $company) { ?>
                    <option value="<?php echo $company['id']; ?>"<?php echo isset($_['user']['code'])&&$_['user']['code']==$company['id']?' selected="selected"':''; ?>><?php echo $company['name']; ?></option>
                    <?php } ?>
                </select>
            </li>
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
            <li><label>等级</label><select name="rank">
                    <?php
                    foreach($_['user_ranks'] as $k=>$v){
                        if(isset($_['user']['rank']) && $_['user']['rank']==$k){
                            echo '<option value="'.$k.'" selected="selected">'.$v.'</option>';
                        }else{
                            echo '<option value="'.$k.'">'.$v.'</option>';
                        }
                    }
                    ?>
                </select></li>
            <li>
                <label>状态</label>
                <p style="padding-top: 10px;">
                <?php if (isset($_['user']['state']) && $_['user']['state']==1) { ?>
                    <input type="radio" name="state" value="1" checked="checked" /> 启用&nbsp;&nbsp;
                    <input type="radio" name="state" value="0" /> 停用
                <?php } else { ?>
                    <input type="radio" name="state" value="1" /> 启用&nbsp;&nbsp;
                    <input type="radio" name="state" value="0" checked="checked" /> 停用
                <?php } ?>
                </p>
            </li>
            <li><label>&nbsp;</label><input type="button" id="btn-save" class="btn" value="确认保存"/></li>
        </ul>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#btn-save').on('click', function(){
            if ($(this).hasClass('working')) return false;
            $(this).addClass('working');
            var _company = $(this).closest('form').find('select[name="code"]').find('option:selected').text();
            $(this).closest('form').find('input[name="company"]').val(_company);
            $(this).closest('form').submit();
        });
    });
</script>
</body>
</html>