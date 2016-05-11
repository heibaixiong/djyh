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

            $('#btn-save').on('click', function(){
                if ($(this).hasClass('working')) return false;
                $(this).addClass('working');
                var _zipcode = $(this).closest('form').find('select[name="cons_area"]').find('option:selected').data('zipcode');
                $(this).closest('form').find('input[name="cons_zipcode"]').val(_zipcode);
                $(this).closest('form').submit();
            });
        });
    </script>
    <script type=text/javascript>
        function selectTag(a,b,d,e){
            $(a).attr('class', 'selected');
            $(b).attr('class', '');
            $(d).show();
            $(e).hide();
        }
    </script>
</head>
<body>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li>首页</li>
        <li><a href="<?php echo _u('//list/'._v(4).'/'._v(5).'/'); ?>">订单管理</a></li>
        <li><?php echo isset($_['order']['id'])?'编辑':'新增'; ?></li>
    </ul>
</div>
<div class="formbody">
    <div id="usual1" class="usual">
        <form action="<?php echo $_['form_action']; ?>" method="post">
            <input type="hidden" name="cons_zipcode" value="" />
        <div class="itab">
            <ul>
                <li><a href="javascript:void(0);" id='a' class="selected" onClick="selectTag('#a','#b','#tab1','#tab2')">订单信息</a></li>
                <?php if (isset($_['order']['id'])) { ?>
                <li><a href="javascript:void(0);" id='b' onClick="selectTag('#b','#a','#tab2','#tab1')">物流信息</a></li>
                <?php } ?>
                <li style="float: right;"><input id="btn-save" type="button" class="btn" value="确认保存" /></li>
            </ul>
        </div>
        <div id="tab1" class="tabson">
            <ul class="forminfo">
                <?php if (isset($_['order']['id'])) { ?>
                <li><label>订单编号：</label><p style="padding-top: 10px;"><?php echo str_repeat('0', 12-strlen($_['order']['id'])).$_['order']['id']; ?></p></li>
                <?php } ?>
                <li>
                    <label>发 货 人：</label>
                    <input type="text" name="ship_name" value="<?php echo isset($_['order']['ship_name']) ? $_['order']['ship_name'] : ''; ?>" class="dfinput" />
                </li>
                <li>
                    <label>手　　机：</label>
                    <input type="text" name="ship_phone" value="<?php echo isset($_['order']['ship_phone']) ? $_['order']['ship_phone'] : ''; ?>" class="dfinput" />
                </li>
                <li data-toggle="distpicker">
                    <label>发 货 地：</label>
                    <select id="pro_n" data-province="<?php echo isset($_['order']['ship_prov'])?$_['order']['ship_prov']:'河南省'; ?>" name="ship_prov">

                    </select>
                    <select id="cit_n" data-city="<?php echo isset($_['order']['ship_city'])?$_['order']['ship_city']:''; ?>" name="ship_city">

                    </select>
                    <select id="cou_n" data-district="<?php echo isset($_['order']['ship_area'])?$_['order']['ship_area']:''; ?>" name="ship_area">

                    </select>
                </li>
                <li>
                    <label>发货地址：</label>
                    <input type="text" name="ship_address" value="<?php echo isset($_['order']['ship_address']) ? $_['order']['ship_address'] : ''; ?>" class="dfinput" />
                </li>
                <li>
                    <label>收 货 人：</label>
                    <input type="text" name="cons_name" value="<?php echo isset($_['order']['consignee_name']) ? $_['order']['consignee_name'] : ''; ?>" class="dfinput" />
                </li>
                <li>
                    <label>手　　机：</label>
                    <input type="text" name="cons_phone" value="<?php echo isset($_['order']['consignee_phone']) ? $_['order']['consignee_phone'] : ''; ?>" class="dfinput" />
                </li>
                <li data-toggle="distpicker">
                    <label>收 货 地：</label>
                    <select id="pro_s" data-province="<?php echo isset($_['order']['consignee_prov'])?$_['order']['consignee_prov']:'河南省'; ?>" name="cons_prov">

                    </select>
                    <select id="cit_s" data-city="<?php echo isset($_['order']['consignee_city'])?$_['order']['consignee_city']:''; ?>" name="cons_city">

                    </select>
                    <select id="cou_s" data-district="<?php echo isset($_['order']['consignee_area'])?$_['order']['consignee_area']:''; ?>" name="cons_area">

                    </select>
                </li>
                <li>
                    <label>收货地址：</label>
                    <input type="text" name="cons_address" value="<?php echo isset($_['order']['consignee_address']) ? $_['order']['consignee_address'] : ''; ?>" class="dfinput" />
                </li>
                <li>
                    <label>重　　量：</label>
                    <input type="text" name="ship_weight" value="<?php echo isset($_['order']['ship_weight']) ? $_['order']['ship_weight'] : ''; ?>" class="dfinput" /> kg
                </li>
                <li>
                    <label>体　　积：</label>
                    <input type="text" name="ship_cubic" value="<?php echo isset($_['order']['ship_cubic']) ? $_['order']['ship_cubic'] : ''; ?>" class="dfinput" /> m³
                </li>
                <li>
                    <label>数　　量：</label>
                    <input type="text" name="ship_quantity" value="<?php echo isset($_['order']['ship_quantity']) ? $_['order']['ship_quantity'] : ''; ?>" class="dfinput" /> 件
                </li>
                <li>
                    <label>内　　容：</label>
                    <input type="text" name="ship_desc" value="<?php echo isset($_['order']['ship_desc']) ? $_['order']['ship_desc'] : ''; ?>" class="dfinput" />
                </li>
                <li><label>照　　片：</label>
                    <?php if (isset($_['order']['ship_image']) && is_file(DIR.$_['order']['ship_image'])) { ?>
                        <?php echo '<a href="javascript:void(0);" data-toggle="upload-image" style="position: relative;width: 100px;height: 100px; float: left; margin-bottom: 15px;margin-right: 15px;"><img src="'._resize($_['order']['ship_image'], 100, 100).'" style="border:1px solid #ccc;" /><span style="width:20px;height:20px;background:url(\''._resize(PUB._v(0).'/images/close.png', 20, 20).'\') no-repeat center center;background-size:20px 20px;position:absolute;top: -10px;right: -10px;"></span></a><input type="hidden" name="ship_image[]" value="'.$_['order']['ship_image'].'" />'; ?>
                    <?php } else { ?>
                        <a href="javascript:void(0);" data-toggle="upload-image" style="position: relative;width: 100px;height: 100px; float: left; margin-bottom: 15px;margin-right: 15px;"><img src="<?php echo _resize(PUB._v(0).'/images/l04.png', 100, 100)?>" style="border:1px solid #ccc;" /><span style="display:none;width:20px;height:20px;background:url('<?php _resize(PUB._v(0).'/images/close.png', 20, 20)?>') no-repeat center center;background-size:20px 20px;position:absolute;top: -10px;right: -10px;"></span></a><input type="hidden" name="ship_image[]" />
                    <?php } ?>

                    <?php if (isset($_['order']['ship_image1']) && is_file(DIR.$_['order']['ship_image1'])) { ?>
                        <?php echo '<a href="javascript:void(0);" data-toggle="upload-image" style="position: relative;width: 100px;height: 100px; float: left; margin-bottom: 15px;margin-right: 15px;"><img src="'._resize($_['order']['ship_image1'], 100, 100).'" style="border:1px solid #ccc;" /><span style="width:20px;height:20px;background:url(\''._resize(PUB._v(0).'/images/close.png', 20, 20).'\') no-repeat center center;background-size:20px 20px;position:absolute;top: -10px;right: -10px;"></span></a><input type="hidden" name="ship_image[]" value="'.$_['order']['ship_image1'].'" />'; ?>
                    <?php } else { ?>
                        <a href="javascript:void(0);" data-toggle="upload-image" style="position: relative;width: 100px;height: 100px; float: left; margin-bottom: 15px;margin-right: 15px;"><img src="<?php echo _resize(PUB._v(0).'/images/l04.png', 100, 100)?>" style="border:1px solid #ccc;" /><span style="display:none;width:20px;height:20px;background:url('<?php echo _resize(PUB._v(0).'/images/close.png', 20, 20)?>') no-repeat center center;background-size:20px 20px;position:absolute;top: -10px;right: -10px;"></span></a><input type="hidden" name="ship_image[]" />
                    <?php } ?>

                    <?php if (isset($_['order']['ship_image2']) && is_file(DIR.$_['order']['ship_image2'])) { ?>
                        <?php echo '<a href="javascript:void(0);" data-toggle="upload-image" style="position: relative;width: 100px;height: 100px; float: left; margin-bottom: 15px;margin-right: 15px;"><img src="'._resize($_['order']['ship_image2'], 100, 100).'" style="border:1px solid #ccc;" /><span style="width:20px;height:20px;background:url(\''._resize(PUB._v(0).'/images/close.png', 20, 20).'\') no-repeat center center;background-size:20px 20px;position:absolute;top: -10px;right: -10px;"></span></a><input type="hidden" name="ship_image[]" value="'.$_['order']['ship_image2'].'" />'; ?>
                    <?php } else { ?>
                        <a href="javascript:void(0);" data-toggle="upload-image" style="position: relative;width: 100px;height: 100px; float: left; margin-bottom: 15px;margin-right: 15px;"><img src="<?php echo _resize(PUB._v(0).'/images/l04.png', 100, 100)?>" style="border:1px solid #ccc;" /><span style="display:none;width:20px;height:20px;background:url('<?php echo _resize(PUB._v(0).'/images/close.png', 20, 20)?>') no-repeat center center;background-size:20px 20px;position:absolute;top: -10px;right: -10px;"></span></a><input type="hidden" name="ship_image[]" />
                    <?php } ?>
                </li>
                <li>
                    <label>备　　注：</label>
                    <input type="text" name="ship_note" value="<?php echo isset($_['order']['ship_note']) ? $_['order']['ship_note'] : ''; ?>" class="dfinput" />
                </li>
                <li>
                    <label>运　　费：</label>
                    <input type="text" name="ship_amount" value="<?php echo isset($_['order']['ship_amount']) ? $_['order']['ship_amount'] : ''; ?>" class="dfinput" />
                </li>
                <li>
                    <label>代收货款：</label>
                    <input type="text" name="ship_cod" value="<?php echo isset($_['order']['ship_cod']) ? $_['order']['ship_cod'] : ''; ?>" class="dfinput" />
                </li>
                <li>
                    <label>付款方式：</label>
                    <p style="padding-top: 10px;">
                    <?php if (isset($_['order']['pay_method']) && $_['order']['pay_method'] == 'cash') { ?>
                        <input type="radio" name="pay_method" value="cash" checked="checked" /> 现付&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="pay_method" value="cod" /> 到付
                    <?php } else { ?>
                        <input type="radio" name="pay_method" value="cash" /> 现付&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="pay_method" value="cod" checked="checked" /> 到付
                    <?php } ?>
                    </p>
                </li>
                <?php if (isset($_['order']['add_time'])) { ?>
                <li><label>下单时间：</label><p style="padding-top: 10px;"><?php echo _time($_['order']['add_time']); ?></p></li>
                <?php } ?>
                <li>
                    <label>订单状态：</label>
                    <p>
                        <select name="status">
                        <?php foreach ($_['order_status'] as $value => $label) { ?>
                        <option value="<?php echo $value; ?>"<?php echo isset($_['order']['status'])&&$_['order']['status']==$value?' selected="selected"':''; ?>><?php echo $label; ?></option>
                        <?php } ?>
                        </select>
                    </p>
                </li>
            </ul>
        </div>
        <div id="tab2" class="tabson">
            <ul class="forminfo" style="padding-left: 0px;">
                <?php if (isset($_['order']['status']) && $_['order']['status'] >= 3) { ?>
                    <li>
                        <table class="tablelist">
                            <thead>
                            <th width="25%">时间</th>
                            <th width="55%">内容</th>
                            <th width="20%">状态</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?php echo _time($_['order']['rob_time']); ?></td>
                                <td><?php echo $_['order']['rob_name']; ?> -> 接单</td>
                                <td>已接单</td>
                            </tr>
                            <tr>
                                <td><?php echo _time($_['order']['pick_time']); ?></td>
                                <td><?php echo $_['order']['rob_name']; ?> -> 揽件</td>
                                <td>已揽件</td>
                            </tr>
                            <?php foreach ($_['order']['ship_status'] as $_state) { ?>
                                <tr>
                                    <td><?php echo _time($_state['mod_time']); ?></td>
                                    <td>
                                        发往 -> <?php echo $_state['prov_e'].'/'.$_state['city_e'].'/'.$_state['area_e']; ?><br/>
                                        上一站：<?php echo $_state['prov_s'].'/'.$_state['city_s'].'/'.$_state['area_s']; ?>
                                    </td>
                                    <td><?php echo $_['stowage_status'][$_state['status']]; ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </li>
                <?php } ?>
            </ul>
        </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $('.tablelist tbody tr:odd').addClass('odd');
    $(document).delegate('a[data-toggle=\'upload-image\']', 'click', function(e) {
        e.preventDefault();

        var _t = $(this);

        $('#form-upload').remove();

        $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" value="" /><input type="hidden" name="size" value="100x100" /></form>');

        $('#form-upload input[name=\'file\']').trigger('click');

        if (typeof timer != 'undefined') {
            clearInterval(timer);
        }

        timer = setInterval(function() {
            if ($('#form-upload input[name=\'file\']').val() != '') {
                clearInterval(timer);

                $.ajax({
                    url: '/?d/index/upload/',
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
                            if ($(_t).find('img').length > 0) {
                                $(_t).find('img').first().attr('src', json['thumb']);
                            } else {
                                var _html = '<img src="'+json['thumb']+'" />';
                                $(_t).prepend(_html);
                            }

                            $(_t).next('input[type="hidden"]').val(json['path']);
                            $(_t).find('span').first().show();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        }, 500);
    });

    $(document).delegate('a[data-toggle=\'upload-image\'] span', 'click', function(e) {
        e.stopPropagation();
        e.preventDefault();
        //$(this).prev('img').attr('src', '');
        $(this).prev('img').attr('src', '<?php echo _resize(PUB._v(0).'/images/l04.png', 100, 100)?>');
        $(this).parent('a').next('input[type="hidden"]').val('');
        $(this).hide();
    });
</script>
</body>
</html>