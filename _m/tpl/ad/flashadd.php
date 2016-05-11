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
        <li>幻灯片管理</li>
        <li>增加幻灯片</li>
    </ul>
</div>
<div class="formbody">
    <div class="formtitle"><span>增加幻灯片</span></div>
    <form action="<?php echo _u('//flashadd/');?>" method="post" id="form1" name="form1">
        <ul class="forminfo">
            <li><label>地区</label><input name="code" type="text" class="dfinput" /><i>0 为所有地区</i></li>
            <li><label>文字</label><input name="title" type="text" class="dfinput" /></li>
            <li>
                <label>图片</label>
                <a href="javascript:void(0);" data-toggle="upload-image"><img src="<?php echo _resize(PUB.'p/images/nopic.gif', 100); ?>" /></a>
                <input name="img" type="hidden" value="" />
            </li>
            <li><label>连接</label><input name="url" type="text" class="dfinput" /></li>
            <li><label>显示/隐藏</label><input type="radio" name="state" value="0" checked="checked" />开 <input type="radio" name="state" value="1" />关</li>
            <li><label>排序</label><input name="px" type="text" class="dfinput" /></li>
            <li><label>&nbsp;</label><input name="" id="btn" type="button" class="btn" value="确认保存"/></li>
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