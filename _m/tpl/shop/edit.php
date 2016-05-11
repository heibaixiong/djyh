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
    _js('attri');
    ?>
    <script type="text/javascript">
        $(function(){
            $("#btn").click(function(){
                $("#form1").submit();
            });
        });
    </script>
    <script type=text/javascript>
        function selectTag(a,b,c,d,e,f){
            $$(a).className = "selected";
            $$(b).className = "";
            $$(c).className = "";
            $$(d).style.display = "block";
            $$(e).style.display = "none";
            $$(f).style.display = "none";
        }
    </script>
    <?php
    _editor('mess');
    ?>
</head>
<body>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li>首页</li>
        <li>商品管理</li>
        <li><?php echo $_['rs']['title'];?></li>
        <li>编辑商品</li>
    </ul>
</div>
<div class="formbody">
    <div id="usual1" class="usual">
        <form action="<?php echo _u('//edit/');?>" method="post" id="form1" name="form1">
            <div class="itab">
                <ul>
                    <li><a href="#tab1" id='a' class="selected" onClick="selectTag('a','b','c','tab1','tab2','tab3')">商品详情</a></li>
                    <li><a href="#tab2" id='b' onClick="selectTag('b','a','c','tab2','tab1','tab3')">商品参数</a></li>
                    <li><a href="#tab3" id='c' onClick="selectTag('c','a','b','tab3','tab2','tab1')">商品属性</a></li>
                    <li style="float: right;"><input name="" id="btn" type="button" class="btn" value="确认编辑"/></li>
                </ul>
            </div>
            <div id="tab1" class="tabson">
                <ul class="forminfo">
                    <li><label>商品名称<b>*</b></label><input type="hidden" value="<?php echo $_['rs']['id'];?>" name="id" /><input name="title" type="text" class="dfinput" value="<?php echo htmlspecialchars($_['rs']['title']);?>" /></li>
                    <?php
                    if(_session('adminrank')<3){
                        ?>
                        <li><label>商品分类<b>*</b></label><input type="text" name="class2" class="dfinput" value="<?php echo $_['rs']['class2'];?>" /></li>
                        <?php
                    }
                    ?>
                    <li><label>商品货号<b>*</b></label><input name="number" type="text" class="dfinput" value="<?php echo $_['rs']['number'];?>" /></li>
                    <li><label><?php echo $_['config']['name'];?>价<b>*</b></label><input name="mark" type="text" class="ninput" value="<?php echo _rmb($_['rs']['mark']/100);?>" /> 元</li>
                    <?php
                    if(_session('adminrank')<3){
                        ?>
                        <li><label>仓邮费</label><input name="postage" type="text" class="ninput" value="<?php echo $_['rs']['postage'];?>" /> 元</li>
                        <li><label>推荐与否</label><input style="margin-top: 10px;" type="radio" name="recommend" value="1"<?php if ($_['rs']['recommend'] == '1') echo ' checked="checked"';?> /> 开 <input type="radio" name="recommend" value="0"<?php if ($_['rs']['recommend'] == '0') echo ' checked="checked"';?> /> 关</li>
                        <li><label>最新与否</label><input style="margin-top: 10px;" type="radio" name="new" value="1"<?php if ($_['rs']['new'] == '1') echo ' checked="checked"';?> /> 开 <input type="radio" name="new" value="0"<?php if ($_['rs']['new'] == '0') echo ' checked="checked"';?> /> 关</li>
                        <li><label>热门与否</label><input style="margin-top: 10px;" type="radio" name="hot" value="1"<?php if ($_['rs']['hot'] == '1') echo ' checked="checked"';?> /> 开 <input type="radio" name="hot" value="0"<?php if ($_['rs']['hot'] == '0') echo ' checked="checked"';?> /> 关</li>
                        <li><label>上架/下架</label><input style="margin-top: 10px;" type="radio" name="state" value="0"<?php if ($_['rs']['state'] == '0') echo ' checked="checked"';?> /> 上架 <input type="radio" name="state" value="1"<?php if ($_['rs']['state'] == '1') echo ' checked="checked"';?> /> 下架</li>
                        <li><label>销量</label><input name="sale" type="text" class="ninput" value="<?php echo $_['rs']['sale'];?>" /></li>
                        <li><label>库存</label><input name="stock" type="text" class="ninput" value="<?php echo $_['rs']['stock'];?>" /></li>
                        <li><label>排序</label><input name="px" type="text" class="ninput" value="<?php echo $_['rs']['px'];?>" /></li>
                        <?php
                    }
                    ?>
                    <li>
                        <label>商品主图<b>*</b></label>
                        <?php if (is_file(DIR.$_['rs']['img'])) { ?>
                            <a href="javascript:void(0);" data-toggle="upload-image"><img src="<?php echo _resize($_['rs']['img'], 100); ?>" style="border: 1px solid #ccc;" /></a>
                            <input name="img" type="hidden" value="<?php echo $_['rs']['img'];?>" />
                        <?php } else { ?>
                            <a href="javascript:void(0);" data-toggle="upload-image"><img src="<?php echo _resize(PUB.'p/images/nopic.gif', 100); ?>" style="border: 1px solid #ccc;" /></a>
                            <input name="img" type="hidden" value="" />
                        <?php } ?>
                    </li>
                    <li>
                        <label>商品侧图1</label>
                        <?php if (is_file(DIR.$_['rs']['img1'])) { ?>
                            <a href="javascript:void(0);" data-toggle="upload-image"><img src="<?php echo _resize($_['rs']['img1'], 100); ?>" style="border: 1px solid #ccc;" /></a>
                            <input name="img1" type="hidden" value="<?php echo $_['rs']['img1'];?>" />
                        <?php } else { ?>
                            <a href="javascript:void(0);" data-toggle="upload-image"><img src="<?php echo _resize(PUB.'p/images/nopic.gif', 100); ?>" style="border: 1px solid #ccc;" /></a>
                            <input name="img1" type="hidden" value="" />
                        <?php } ?>
                    </li>
                    <li>
                        <label>商品侧图2</label>
                        <?php if (is_file(DIR.$_['rs']['img2'])) { ?>
                            <a href="javascript:void(0);" data-toggle="upload-image"><img src="<?php echo _resize($_['rs']['img2'], 100); ?>" style="border: 1px solid #ccc;" /></a>
                            <input name="img2" type="hidden" value="<?php echo $_['rs']['img2'];?>" />
                        <?php } else { ?>
                            <a href="javascript:void(0);" data-toggle="upload-image"><img src="<?php echo _resize(PUB.'p/images/nopic.gif', 100); ?>" style="border: 1px solid #ccc;" /></a>
                            <input name="img2" type="hidden" value="" />
                        <?php } ?>
                    </li>
                    <li>
                        <label>商品侧图3</label>
                        <?php if (is_file(DIR.$_['rs']['img3'])) { ?>
                            <a href="javascript:void(0);" data-toggle="upload-image"><img src="<?php echo _resize($_['rs']['img3'], 100); ?>" style="border: 1px solid #ccc;" /></a>
                            <input name="img3" type="hidden" value="<?php echo $_['rs']['img3'];?>" />
                        <?php } else { ?>
                            <a href="javascript:void(0);" data-toggle="upload-image"><img src="<?php echo _resize(PUB.'p/images/nopic.gif', 100); ?>" style="border: 1px solid #ccc;" /></a>
                            <input name="img3" type="hidden" value="" />
                        <?php } ?>
                    </li>
                    <li>
                        <label>商品侧图4</label>
                        <?php if (is_file(DIR.$_['rs']['img4'])) { ?>
                            <a href="javascript:void(0);" data-toggle="upload-image"><img src="<?php echo _resize($_['rs']['img4'], 100); ?>" style="border: 1px solid #ccc;" /></a>
                            <input name="img4" type="hidden" value="<?php echo $_['rs']['img4'];?>" />
                        <?php } else { ?>
                            <a href="javascript:void(0);" data-toggle="upload-image"><img src="<?php echo _resize(PUB.'p/images/nopic.gif', 100); ?>" style="border: 1px solid #ccc;" /></a>
                            <input name="img4" type="hidden" value="" />
                        <?php } ?>
                    </li>
                    <li><label>商品介绍</label><textarea name="mess" id="mess" width="600" class="textinput"><?php echo $_['rs']['content'];?></textarea></li>
                </ul>
            </div>
            <div id="tab2" class="tabson" style="display:none;">
                <?php
                $para='';
                foreach($_['rs_para'] as $k=>$v){
                    $para.=$v['paraname'].'@@@'.$v['value'].'@@@';
                }
                ?>
                <ul class="forminfo" id="para" u="<?php echo $para;?>">
                    <?php
                    if (1<>1) {
                        foreach($_['para'] as $k=>$v){
                            ?>
                            <li><label><?php echo $v['title']?><b>*</b></label><input name="paraid[]" type="hidden" class="dfinput" value="<?php echo $v['title']?>" /><input name="para[]" type="text" class="dfinput" /></li>
                            <?php
                        }}
                    ?>
                    <?php
                    foreach($_['rs_para'] as $k=>$v){
                        ?>
                        <li><label><?php echo $v['paraname']?><b>*</b></label><input name="paraid[]" type="hidden" class="dfinput" value="<?php echo $v['paraname']?>" /><input name="para[]" value="<?php echo $v['value']?>" type="text" class="dfinput" /></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <div id="tab3" class="tabson" style="display:none;">
                <?php
                $attri='';
                foreach($_['rs_attri'] as $k=>$v){
                    $attri.=$v['model'].'@@@'.$v['stock'].'@@@';
                }
                ?>
                <ul class="forminfo" id="attri1" u="<?php echo $attri;?>">
                    <?php
                    foreach($_['attri'] as $k=>$v){
                        $a=explode(',',$v['content']);
                        echo '<li width=100%><span>'.$v['title'].' : </span>';
                        for($i=0;$i<count($a);$i++){
                            ?>
                            <input type="button" class="button" u="" value="<?php echo $a[$i];?>">
                            <?php
                        }
                        echo '</li>';
                    }
                    ?>
                </ul>
                <ul class="forminfo" id="attri2">
                </ul>
            </div>
        </form>
    </div>
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