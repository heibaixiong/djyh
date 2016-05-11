<?php
if(!defined('PART'))exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
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
        <li>编辑广告</li>
    </ul>
</div>
<div class="formbody">
    <div class="formtitle"><span>编辑广告</span></div>
    <form action="<?php echo _u('//adedit/');?>" method="post" id="form1" name="form1">
        <ul class="forminfo">
            <li><label>地区</label><input name="code" type="text" class="dfinput" value="<?php echo $_['rs']['code'];?>" /><input type="hidden" value="<?php echo $_['rs']['id'];?>" name="id" /><i>0 为所有地区</i></li>
            <li>
                <label>位置</label>
                <select name="postion">
                    <option value="">请选择</option>
                    <?php foreach ($_['ad_position'] as $key => $label) { ?>
                        <option value="<?php echo $key; ?>"<?php if ($_['rs']['postion']==$key) echo ' selected="selected"'; ?>><?php echo $label; ?></option>
                    <?php } ?>
                </select>
            </li>
            <li><label>文字</label><input name="title" type="text" class="dfinput" value="<?php echo $_['rs']['title'];?>" /></li>
            <li>
                <label>图片</label>
                <?php if (is_file(DIR.$_['rs']['img'])) { ?>
                    <a href="javascript:void(0);" data-toggle="upload-image"><img src="<?php echo _resize($_['rs']['img'], 100); ?>" /></a>
                    <input name="img" type="hidden" value="<?php echo $_['rs']['img'];?>" />
                <?php } else { ?>
                    <a href="javascript:void(0);" data-toggle="upload-image"><img src="<?php echo _resize(PUB.'p/images/nopic.gif', 100); ?>" /></a>
                    <input name="img" type="hidden" value="" />
                <?php } ?>
            </li>
            <li><label>连接</label><input name="url" type="text" class="dfinput" value="<?php echo $_['rs']['url'];?>" /></li>
            <li>
                <label>显示/隐藏</label>
                <p style="padding-top: 10px;">
                <input type="radio" name="state" value="0" <?php if($_['rs']['state']==0)echo 'checked'?> /> 开&nbsp;&nbsp;
                <input type="radio" name="state" value="1" <?php if($_['rs']['state']==1)echo 'checked'?> /> 关
                </p>
            </li>
            <li><label>排序</label><input name="px" type="text" class="dfinput" value="<?php echo $_['rs']['px'];?>" /></li>
            <li><label>&nbsp;</label><input name="" id="btn" type="button" class="btn" value="确认编辑"/></li>
        </ul>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).delegate('a[data-toggle=\'upload-image\']', 'click', function(e) {
            e.preventDefault();

            var _t = $(this);

            $('#form-upload').remove();

            $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" value="" /></form>');

            $('#form-upload input[name=\'file\']').trigger('click');

            if (typeof timer != 'undefined') {
                clearInterval(timer);
            }

            timer = setInterval(function() {
                if ($('#form-upload input[name=\'file\']').val() != '') {
                    clearInterval(timer);

                    $.ajax({
                        url: '/?p/user/upload/',
                        type: 'post',
                        dataType: 'json',
                        data: new FormData($('#form-upload')[0]),
                        cache: false,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            //$('#button-upload').prop('disabled', true);
                        },
                        complete: function() {
                            //$('#button-upload').prop('disabled', false);
                        },
                        success: function(json) {
                            if (json['error']) {
                                alert(json['error']);
                            }

                            if (json['success']) {
                                //alert(json['success']);
                                //console.log(json['path']);
                                $(_t).find('img').first().attr('src', json['thumb']);
                                $(_t).next('input[type="hidden"]').val(json['path']);
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                        }
                    });
                }
            }, 500);
        });
    });
</script>
</body>
</html>