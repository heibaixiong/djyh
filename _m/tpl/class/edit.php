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
        <li>分类管理</li>
        <li>编辑分类</li>
    </ul>
</div>
<div class="formbody">
    <div class="formtitle"><span>编辑分类</span></div>
    <form action="<?php echo _u('//edit/');?>" method="post" id="form1">
        <ul class="forminfo">
            <li><label>上级分类</label><input name="pid" type="text" class="dfinput" value="<?php echo $_['rs']['pid'];?>" readonly="readonly" /></li>
            <li><label>分类名称</label><input name="title" type="text" class="dfinput" value="<?php echo $_['rs']['title'];?>" /><input type="hidden" value="<?php echo $_['rs']['id'];?>" name="id" /></li>
            <li>
                <label>图标地址</label>
                <?php if (is_file(DIR.$_['rs']['img'])) { ?>
                    <a href="javascript:void(0);" data-toggle="upload-image"><img src="<?php echo _resize($_['rs']['img'], 100); ?>" /></a>
                    <input name="img" type="hidden" value="<?php echo $_['rs']['img'];?>" />
                <?php } else { ?>
                    <a href="javascript:void(0);" data-toggle="upload-image"><img src="<?php echo _resize(PUB.'p/images/nopic.gif', 100); ?>" /></a>
                    <input name="img" type="hidden" value="" />
                <?php } ?>
            </li>
            <li>
                <label>楼层广告<br/>(288px*329px)</label>
                <?php if (is_file(DIR.$_['rs']['img_ad_1'])) { ?>
                    <a href="javascript:void(0);" data-toggle="upload-image"><img src="<?php echo _resize($_['rs']['img_ad_1'], 100); ?>" /></a>
                    <input name="img_ad_1" type="hidden" value="<?php echo $_['rs']['img_ad_1'];?>" />
                <?php } else { ?>
                    <a href="javascript:void(0);" data-toggle="upload-image"><img src="<?php echo _resize(PUB.'p/images/nopic.gif', 100); ?>" /></a>
                    <input name="img_ad_1" type="hidden" value="" />
                <?php } ?>
            </li>
            <li>
                <label>广告链接</label>
                <input name="url_ad_1" value="<?php echo $_['rs']['url_ad_1'];?>" class="dfinput" />
            </li>
            <li>
                <label>楼层广告<br/>(592px*491px)</label>
                <?php if (is_file(DIR.$_['rs']['img_ad_2'])) { ?>
                    <a href="javascript:void(0);" data-toggle="upload-image"><img src="<?php echo _resize($_['rs']['img_ad_2'], 100); ?>" /></a>
                    <input name="img_ad_2" type="hidden" value="<?php echo $_['rs']['img_ad_2'];?>" />
                <?php } else { ?>
                    <a href="javascript:void(0);" data-toggle="upload-image"><img src="<?php echo _resize(PUB.'p/images/nopic.gif', 100); ?>" /></a>
                    <input name="img_ad_2" type="hidden" value="" />
                <?php } ?>
            </li>
            <li>
                <label>广告链接</label>
                <input name="url_ad_2" value="<?php echo $_['rs']['url_ad_2'];?>" class="dfinput" />
            </li>

            <li><label>属性</label><select name="attri">
                    <option>选择属性</option>
                    <?php
                    foreach($_['attri'] as $k=>$v){
                        if($_['rs']['attri']==$v['id']){
                            echo '<option value="'.$v['id'].'" selected="selected">'.$v['title'].'</option>';
                        }else{
                            echo '<option value="'.$v['id'].'">'.$v['title'].'</option>';
                        }
                    }
                    ?>
                </select></li>
            <li><label>参数</label><select name="para">
                    <option>选择参数</option>
                    <?php
                    foreach($_['para'] as $k=>$v){
                        if($_['rs']['para']==$v['id']){
                            echo '<option value="'.$v['id'].'" selected="selected">'.$v['title'].'</option>';
                        }else{
                            echo '<option value="'.$v['id'].'">'.$v['title'].'</option>';
                        }
                    }
                    ?>
                </select></li>
            <li><label>单位</label><select name="unit">
                    <option>选择单位</option>
                    <?php
                    foreach($_['unit'] as $k=>$v){
                        if($_['rs']['unit']==$v['id']){
                            echo '<option value="'.$v['id'].'" selected="selected">'.$v['title'].'</option>';
                        }else{
                            echo '<option value="'.$v['id'].'">'.$v['title'].'</option>';
                        }
                    }
                    ?>
                </select></li>

            <li>
                <label>显示/隐藏</label>
                <p style="padding-top: 10px;">
                <input type="radio" name="state" value="0" <?php if($_['rs']['state']==0)echo 'checked'?> /> 开&nbsp;&nbsp;
                <input type="radio" name="state" value="1" <?php if($_['rs']['state']==1)echo 'checked'?> /> 关
                </p>
            </li>
            <li>
                <label>首页显示</label>
                <p style="padding-top: 10px;">
                <input type="radio" name="show" value="1" <?php if($_['rs']['show']==1)echo 'checked'?> /> 开&nbsp;&nbsp;
                <input type="radio" name="show" value="0" <?php if($_['rs']['show']==0)echo 'checked'?> /> 关
                </p>
            </li>
            <li><label>排序</label><input name="px" type="text" class="dfinput" value="<?php echo $_['rs']['px'];?>" /><i>数越大越靠前</i></li>
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