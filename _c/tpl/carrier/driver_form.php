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
    <script type="text/javascript">
        $(document).ready(function(){
            $(".click").click(function(){
                $(".tip").fadeIn(200);
            });
            $(".tiptop a").click(function(){
                $(".tip").fadeOut(200);
            });
            $(".sure").click(function(){
                $(".tip").fadeOut(100);
            });
            $(".cancel").click(function(){
                $(".tip").fadeOut(100);
            });
        });
    </script>
</head>
<body>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li>首页</li>
        <li>承运人管理</li>
        <li><?php echo isset($_['driver']['id'])?'编辑':'新增'; ?></li>
    </ul>
</div>
<div class="formbody">
    <div id="usual1" class="usual">
        <div id="tab1" class="tabson">
            <form action="<?php echo $_['form_action']; ?>" method="post">
            <ul class="forminfo">
                <?php if (isset($_['driver']['id'])) { ?>
                    <li><label>编　　号：</label><p style="padding-top: 10px;"><?php echo str_repeat('0', 8-strlen($_['driver']['id'])).$_['driver']['id']; ?></p></li>
                <?php } ?>
                <li data-toggle="distpicker"><label>所 在 地：</label><p>
                        <select id="pro_n" data-province="<?php echo isset($_['driver']['prov'])?$_['driver']['prov']:'河南省'; ?>" name="prov">

                        </select>
                        <select id="cit_n" data-city="<?php echo isset($_['driver']['city'])?$_['driver']['city']:''; ?>" name="city">

                        </select>
                        <select id="cou_n" data-district="<?php echo isset($_['driver']['area'])?$_['driver']['area']:''; ?>" name="area">

                        </select>
                    </p></li>
                <li><label>姓　　名：</label><p><input type="text" name="real_name" value="<?php echo isset($_['driver']['real_name']) ? $_['driver']['real_name'] : ''; ?>" class="dfinput" /></p></li>
                <li><label>性　　别：</label><p>
                        <select name="sex">
                            <option value="男"<?php if (isset($_['driver']['sex']) && $_['driver']['sex']=='男') echo ' selected="selected"'; ?>>男</option>
                            <option value="女"<?php if (isset($_['driver']['sex']) && $_['driver']['sex']=='女') echo ' selected="selected"'; ?>>女</option>
                        </select>
                    </p></li>
                <li><label>年　　龄：</label><p><input type="text" name="age" value="<?php echo isset($_['driver']['age']) ? $_['driver']['age'] : ''; ?>" class="dfinput" /></p></li>
                <li><label>学　　历：</label><p><input type="text" name="edu" value="<?php echo isset($_['driver']['edu']) ? $_['driver']['edu'] : ''; ?>" class="dfinput" /></p></li>
                <li><label>经　　验：</label><p><input type="text" name="exp" value="<?php echo isset($_['driver']['exp']) ? $_['driver']['exp'] : ''; ?>" class="dfinput" /></p></li>
                <li><label>身 份 证：</label><p><input type="text" name="id_card" value="<?php echo isset($_['driver']['id_card']) ? $_['driver']['id_card'] : ''; ?>" class="dfinput" /></p></li>
                <li><label>手　　机：</label><p><input type="text" name="phone" value="<?php echo isset($_['driver']['phone']) ? $_['driver']['phone'] : ''; ?>" class="dfinput" /></p></li>
                <li><label>备　　注：</label><p><input type="text" name="note" value="<?php echo isset($_['driver']['note']) ? $_['driver']['note'] : ''; ?>" class="dfinput" /></p></li>
                <?php if (isset($_['driver']['id'])) { ?>
                    <li><label>登记时间：</label><p style="padding-top: 10px;"><?php echo _time($_['driver']['add_time']); ?></p></li>
                    <li><label>修改时间：</label><p style="padding-top: 10px;"><?php echo _time($_['driver']['mod_time']); ?></p></li>
                <?php } ?>
                <li><label>状　　态：</label>
                    <p style="padding-top: 10px;">
                        <?php if (isset($_['driver']['id']) && $_['driver']['status'] == '1') { ?>
                            <input type="radio" name="status" value="1" checked="checked" /> 启用
                            <input type="radio" name="status" value="0" /> 停用
                        <?php } else { ?>
                            <input type="radio" name="status" value="1" /> 启用
                            <input type="radio" name="status" value="0" checked="checked" /> 停用
                        <?php } ?>
                    </p>
                </li>
                <li><input type="submit" value="保存" class="btn" /></li>
            </ul>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.tablelist tbody tr:odd').addClass('odd');
</script>
</body>
</html>