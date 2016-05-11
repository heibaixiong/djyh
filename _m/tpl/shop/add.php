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
            $("#all").click(function(){
                $("#attri2 .ninput").val(9999);
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
        <li><?php echo $_['title'];?></li>
        <li>添加商品</li>
    </ul>
</div>
<div class="formbody">
    <div id="usual1" class="usual">
        <form action="<?php echo _u('//add/');?>" method="post" id="form1" name="form1">
            <div class="itab">
                <ul>
                    <li><a href="#tab1" id='a' class="selected" onClick="selectTag('a','b','c','tab1','tab2','tab3')">商品详情</a></li>
                    <li><a href="#tab2" id='b' onClick="selectTag('b','a','c','tab2','tab1','tab3')">商品参数</a></li>
                    <li><a href="#tab3" id='c' onClick="selectTag('c','a','b','tab3','tab2','tab1')">属性/库存</a></li>
                    <li style="float: right;"><input name="" id="btn" type="button" class="btn" value="确认添加" /></li>
                </ul>
            </div>
            <div id="tab1" class="tabson">
                <ul class="forminfo">
                    <li><label>商品名称<b>*</b></label><input name="title" type="text" class="dfinput" /></li>
                    <li><label>商品分类<b>*</b></label><input type="text" name="class2" class="dfinput" value="<?php echo _v(3)?_v(3):0;?>" readonly="readonly" /></li>
                    <li><label>商品货号<b>*</b></label><input name="number" type="text" class="dfinput" /></li>
                    <li><label><?php echo $_['config']['name'];?>价<b>*</b></label><input name="mark" type="text" class="ninput" value="0" /> 元</li>
                    <?php
                    if(_session('adminrank')<3){
                        ?>
                        <li><label>仓邮费</label><input name="postage" type="text" class="ninput" value="0" /> 元</li>
                        <li><label>推荐与否</label><input style="margin-top: 10px;" type="radio" name="recommend" value="1" /> 开 <input type="radio" name="recommend" value="0" /> 关</li>
                        <li><label>最新与否</label><input style="margin-top: 10px;" type="radio" name="new" value="1" /> 开 <input type="radio" name="new" value="0" /> 关</li>
                        <li><label>热门与否</label><input style="margin-top: 10px;" type="radio" name="hot" value="1" /> 开 <input type="radio" name="hot" value="0" /> 关</li>
                        <li><label>上架/下架</label><input style="margin-top: 10px;" type="radio" name="state" value="0" /> 上架 <input type="radio" name="state" value="1" /> 下架</li>
                        <li><label>销量</label><input name="sale" type="text" class="ninput" value="0" /></li>
                        <li><label>库存</label><input name="stock" type="text" class="ninput" value="0" /></li>
                        <li><label>排序</label><input name="px" type="text" class="ninput" value="0" /></li>
                        <?php
                    }
                    ?>
                    <li>
                        <label>商品主图<b>*</b></label>
                        <a href="javascript:void(0);" data-toggle="upload-image"><img src="<?php echo _resize(PUB.'p/images/nopic.gif', 100); ?>" style="border: 1px solid #ccc;" /></a>
                        <input name="img" type="hidden" value="" />
                    </li>
                    <li>
                        <label>商品侧图1</label>
                        <a href="javascript:void(0);" data-toggle="upload-image"><img src="<?php echo _resize(PUB.'p/images/nopic.gif', 100); ?>" style="border: 1px solid #ccc;" /></a>
                        <input name="img1" type="hidden" value="" />
                    </li>
                    <li>
                        <label>商品侧图2</label>
                        <a href="javascript:void(0);" data-toggle="upload-image"><img src="<?php echo _resize(PUB.'p/images/nopic.gif', 100); ?>" style="border: 1px solid #ccc;" /></a>
                        <input name="img2" type="hidden" value="" />
                    </li>
                    <li>
                        <label>商品侧图3</label>
                        <a href="javascript:void(0);" data-toggle="upload-image"><img src="<?php echo _resize(PUB.'p/images/nopic.gif', 100); ?>" style="border: 1px solid #ccc;" /></a>
                        <input name="img3" type="hidden" value="" />
                    </li>
                    <li>
                        <label>商品侧图4</label>
                        <a href="javascript:void(0);" data-toggle="upload-image"><img src="<?php echo _resize(PUB.'p/images/nopic.gif', 100); ?>" style="border: 1px solid #ccc;" /></a>
                        <input name="img4" type="hidden" value="" />
                    </li>
                    <li><label>商品介绍</label><textarea name="mess" id="mess" width="600" height="600" class="textinput"></textarea></li>
                </ul>
            </div>
            <div id="tab2" class="tabson" style="display:none;">
                <ul class="forminfo">
                    <?php
                    foreach($_['para'] as $k=>$v){
                        ?>
                        <li><label><?php echo $v['title']; ?><b>*</b></label><input name="paraid[]" type="hidden" class="dfinput" value="<?php echo $v['title']; ?>" /><input name="para[]" type="text" class="dfinput" /></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <div id="tab3" class="tabson" style="display:none;">
                <ul class="forminfo" id="attri1">
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
                <div style="padding-left: 30px;"><input id="all" type="button" class="btn" value="全部满库存" /></div>
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