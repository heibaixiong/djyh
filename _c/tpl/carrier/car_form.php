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
        <li>车辆管理</li>
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
                <li><label>车　　牌：</label><p><input type="text" name="number" value="<?php echo isset($_['driver']['number']) ? $_['driver']['number'] : ''; ?>" class="dfinput" /></p></li>
                <li><label>载　　重：</label><p><input type="text" name="ship_weight" value="<?php echo isset($_['driver']['ship_weight']) ? $_['driver']['ship_weight'] : ''; ?>" class="dfinput" /> kg</p></li>
                <li><label>描　　述：</label><p><input type="text" name="desc" value="<?php echo isset($_['driver']['desc']) ? $_['driver']['desc'] : ''; ?>" class="dfinput" /></p></li>
                <?php if (isset($_['driver']['id'])) { ?>
                    <li><label>登记时间：</label><p style="padding-top: 10px;"><?php echo _time($_['driver']['add_time']); ?></p></li>
                    <li><label>修改时间：</label><p style="padding-top: 10px;"><?php echo _time($_['driver']['mod_time']); ?></p></li>
                <?php } ?>
                <li><label>状　　态：</label>
                    <p style="padding-top: 10px;">
                        <?php if (isset($_['driver']['id']) && $_['driver']['status'] == '1') { ?>
                            <input type="radio" name="status" value="1" checked="checked" /> 启用&nbsp;&nbsp;
                            <input type="radio" name="status" value="0" /> 停用
                        <?php } else { ?>
                            <input type="radio" name="status" value="1" /> 启用&nbsp;&nbsp;
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