<?php
if(!defined('PART'))exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php
    _css('style');
    _css('jquery.datetimepicker');
    _jq();
    _js('jquery.datetimepicker');
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
                $(this).closest('form').submit();
            });
        });
    </script>
    <script type=text/javascript>
        function selectTag(a,b,c,d,e,f){
            $(a).attr('class', 'selected');
            $(b).attr('class', '');
            $(c).attr('class', '');
            $(d).show();
            $(e).hide();
            $(f).hide();
        }
    </script>
</head>
<body>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li>首页</li>
        <li>配载管理</li>
        <li><?php echo isset($_['driver']['id'])?'编辑':'新增'; ?></li>
    </ul>
</div>
<div class="formbody">
    <div id="usual1" class="usual">
        <form action="<?php echo $_['form_action']; ?>" method="post">
            <div class="itab">
                <ul>
                    <li><a href="javascript:void(0);" id='a' class="selected" onClick="selectTag('#a','#b','#c','#tab1','#tab2','#tab3')">基本信息</a></li>
                    <li><a href="javascript:void(0);" id='b' onClick="selectTag('#b','#c','#a','#tab2','#tab3','#tab1')">配载信息</a></li>
                    <?php if (isset($_['driver']['id'])) { ?>
                        <li><a href="javascript:void(0);" id='c' onClick="selectTag('#c','#b','#a','#tab3','#tab2','#tab1')">状态信息</a></li>
                    <?php } ?>
                    <li style="float: right;"><input id="btn-save" type="button" class="btn" value="确认保存" /></li>
                </ul>
            </div>
            <div id="tab1" class="tabson">
                <?php foreach ($_['stowage_ship'] as $order) { ?>
                    <input type="hidden" id="stowage-ship-<?php echo $order['ship_number']; ?>" name="ship_order[]" value="<?php echo $order['ship_number']; ?>" />
                <?php } ?>
                <ul class="forminfo">
                    <?php if (isset($_['driver']['id'])) { ?>
                        <li><label>编　　号：</label><p style="padding-top: 10px;"><?php echo str_repeat('0', 8-strlen($_['driver']['id'])).$_['driver']['id']; ?></p></li>
                    <?php } ?>
                    <li data-toggle="distpicker"><label>始 发 地：</label><p>
                            <select id="pro_s" data-province="<?php echo isset($_['driver']['prov_s'])?$_['driver']['prov_s']:'河南省'; ?>" name="prov_s">

                            </select>
                            <select id="cit_s" data-city="<?php echo isset($_['driver']['city_s'])?$_['driver']['city_s']:''; ?>" name="city_s">

                            </select>
                            <select id="cou_s" data-district="<?php echo isset($_['driver']['area_s'])?$_['driver']['area_s']:''; ?>" name="area_s">

                            </select>
                        </p></li>
                    <li data-toggle="distpicker"><label>目 的 地：</label><p>
                            <select id="pro_n" data-province="<?php echo isset($_['driver']['prov_e'])?$_['driver']['prov_e']:'河南省'; ?>" name="prov_e">

                            </select>
                            <select id="cit_n" data-city="<?php echo isset($_['driver']['city_e'])?$_['driver']['city_e']:''; ?>" name="city_e">

                            </select>
                            <select id="cou_n" data-district="<?php echo isset($_['driver']['area_e'])?$_['driver']['area_e']:''; ?>" name="area_e">

                            </select>
                        </p></li>
                    <li>
                        <label>接收网点</label>
                        <select name="to_mid">
                            <option value="">请选择</option>
                            <?php foreach ($_['company'] as $company) { ?>
                                <option value="<?php echo $company['id']; ?>"<?php echo isset($_['driver']['to_mid'])&&$_['driver']['to_mid']==$company['id']?' selected="selected"':''; ?>><?php echo $company['name']; ?></option>
                            <?php } ?>
                        </select>
                    </li>
                    <li><label>承 运 人：</label>
                        <p>
                            <select name="driver">
                                <option value="">请选择</option>
                                <?php foreach ($_['drivers'] as $drv) { ?>
                                    <option value="<?php echo $drv['id']; ?>"<?php echo isset($_['driver']['driver_id'])&&$_['driver']['driver_id']==$drv['id']?' selected="selected"':''; ?>><?php echo $drv['real_name']; ?></option>
                                <?php } ?>
                            </select>
                        </p>
                    </li>
                    <li><label>车　　辆：</label>
                        <p>
                            <select name="car">
                                <option value="">请选择</option>
                                <?php foreach ($_['cars'] as $car) { ?>
                                    <option value="<?php echo $car['id']; ?>"<?php echo isset($_['driver']['car_id'])&&$_['driver']['car_id']==$car['id']?' selected="selected"':''; ?>><?php echo $car['number']; ?></option>
                                <?php } ?>
                            </select>
                        </p>
                    </li>
                    <li><label>备　　注：</label><p><input type="text" name="note" value="<?php echo isset($_['driver']['note']) ? $_['driver']['note'] : ''; ?>" class="dfinput" /></p></li>
                    <?php if (isset($_['driver']['id'])) { ?>
                        <li><label>添加时间：</label><p style="padding-top: 10px;"><?php echo _time($_['driver']['add_time']); ?></p></li>
                        <li><label>更新时间：</label><p style="padding-top: 10px;"><?php echo _time($_['driver']['mod_time']); ?></p></li>
                    <?php } ?>
                    <li><label>状　　态：</label>
                        <p style="padding-top: 10px;">
                            <select name="status">
                                <?php foreach ($_['stowage_status'] as $key => $status) { ?>
                                    <option value="<?php echo $key; ?>"<?php echo isset($_['driver']['status'])&&$_['driver']['status']==$key?' selected="selected"':''; ?>><?php echo $status; ?></option>
                                <?php } ?>
                            </select>
                        </p>
                    </li>
                    <li><label>通知用户：</label>
                        <p style="padding-top: 10px;">
                            <input type="radio" name="notice" value="1" /> 是&nbsp;&nbsp;
                            <input type="radio" name="notice" value="0" checked="checked" /> 否
                        </p>
                    </li>
                </ul>
            </div>
            <div id="tab2" class="tabson">
                <div class="tools">
                    <ul class="toolbar" style="margin-bottom: 5px;">
                        <li style="margin-bottom: 5px;padding: 0 5px 0 5px;">运单号：<input type="text" name="ship_key" value="" class="dfinput" style="width: 150px;" /></li>
                        <li class="click">
                            <a href="javascript:void(0);" id="btn-ship-search"><span><img src="<?php echo _img('ico06.png');?>" /></span>搜索</a>
                        </li>
                    </ul>
                </div>
                <ul class="forminfo" style="padding-left: 0px;">
                    <li>
                        <p style="float: left;">
                            <select name="ship_select" multiple="multiple" style="width: 400px; height: 400px;">
                                <optgroup label="待装载">
                                    <?php foreach ($_['ship_order'] as $order) { ?>
                                        <?php if (array_key_exists($order['ship_number'], $_['stowage_ship'])) continue; ?>
                                        <option value="<?php echo $order['ship_number']; ?>"><?php echo $order['ship_number']; ?></option>
                                    <?php } ?>
                                </optgroup>
                            </select>
                        </p>
                        <p style="float: left;margin: 0 10px 0 10px;">
                            <input type="button" value=">>加入" id="btn-ship-add" class="btn" style="background: #CCCCCC; width: 80px; color: #000; margin-top: 100px; float: left;" />
                            <input type="button" value="<<移出" id="btn-ship-sub" class="btn" style="background: #CCCCCC; width: 80px; color: #000; margin-top: 60px; float: left; clear: both;" />
                        </p>
                        <p style="float: left;">
                            <select name="stowage_ship" multiple="multiple" style="width: 400px; height: 400px;">
                                <optgroup label="已装载">
                                    <?php foreach ($_['stowage_ship'] as $order) { ?>
                                        <option value="<?php echo $order['ship_number']; ?>"><?php echo $order['ship_number']; ?></option>
                                    <?php } ?>
                                </optgroup>
                            </select>
                        </p>
                    </li>
                </ul>
            </div>
            <div id="tab3" class="tabson">
                <ul class="forminfo" style="padding-left: 0px;">
                    <li><label>操作内容：</label>
                        <p style="padding-top: 10px;">
                            <textarea name="status_content" rows="6" cols="50" class=""></textarea>
                        </p>
                    </li>
                    <li><label>&nbsp;</label>
                        <p>
                            <input id="btn-status-history" type="button" class="btn" value="确认添加" />
                        </p>
                    </li>
                    <?php if (isset($_['driver']['id'])) { ?>
                        <li>
                            <table class="tablelist">
                                <thead>
                                <th width="20%">时间</th>
                                <th width="10%">前状态</th>
                                <th width="10%">后状态</th>
                                <th width="35%">内容</th>
                                <th width="25%">操作人</th>
                                </thead>
                                <tbody>
                                <?php foreach ($_['driver']['status_history'] as $_state) { ?>
                                    <tr>
                                        <td><?php echo _time($_state['add_time']); ?></td>
                                        <td><?php echo $_['stowage_status'][$_state['status_before']]; ?></td>
                                        <td><?php echo $_['stowage_status'][$_state['status_after']]; ?></td>
                                        <td><?php echo $_state['content']; ?></td>
                                        <td><?php echo $_state['admin_name'].'['.$_state['admin_part'].']'; ?></td>
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
    $(document).ready(function(){
        $('#date-picker-start').datetimepicker({
            lang:'ch',
            timepicker:false,
            allowBlank: true,
            format:'Y-m-d',
            formatDate:'Y/m/d',
            maxDate:'+1970/01/01',
            onClose: function(){
                if ($('#date-picker-end').val() != '' && $('#date-picker-start').val() > $('#date-picker-end').val()) {
                    $('#date-picker-start').val('');
                }
            }
        });

        $('#date-picker-end').datetimepicker({
            lang:'ch',
            timepicker:false,
            allowBlank: true,
            format:'Y-m-d',
            formatDate:'Y/m/d',
            maxDate:'+1970/01/01',
            onClose: function(){
                if ($('#date-picker-start').val() != '' && $('#date-picker-start').val() > $('#date-picker-end').val()) {
                    $('#date-picker-end').val('');
                }
            }
        });

        $('#btn-ship-add').on('click', function(){
            //console.log($('select[name="ship_select"]').find('option:selected').length);
            if ($('select[name="ship_select"]').find('option:selected').length > 0) {
                $('select[name="ship_select"]').find('option:selected').each(function(){
                    if ($('select[name="stowage_ship"]').find('option[value="'+$(this).attr('value')+'"]').length == 0) {
                        var _html = '<option value="'+$(this).attr('value')+'">'+$(this).text()+'</option>';
                        $('select[name="stowage_ship"]').find('optgroup').first().append(_html);
                    }
                    if ($('input[id="stowage-ship-'+$(this).attr('value')+'"]').length == 0) {
                        var _html = '<input type="hidden" id="stowage-ship-'+$(this).attr('value')+'" name="ship_order[]" value="'+$(this).attr('value')+'" />';
                        $('#btn-ship-add').closest('form').prepend(_html);
                    }
                    $(this).remove();
                });
            }

            return false;
        });

        $('#btn-ship-sub').on('click', function(){
            //console.log($('select[name="stowage_ship"]').find('option:selected').length);
            if ($('select[name="stowage_ship"]').find('option:selected').length > 0) {
                $('select[name="stowage_ship"]').find('option:selected').each(function(){
                    if ($('select[name="ship_select"]').find('option[value="'+$(this).attr('value')+'"]').length == 0) {
                        var _html = '<option value="'+$(this).attr('value')+'">'+$(this).text()+'</option>';
                        $('select[name="ship_select"]').find('optgroup').first().append(_html);
                    }
                    $('input[id="stowage-ship-'+$(this).attr('value')+'"]').remove();
                    $(this).remove();
                });
            }

            return false;
        });

        $('#btn-ship-search').on('click', function(){
            if ($('input[name="ship_key"]').val() == '') {
                $('input[name="ship_key"]').focus();
                return false;
            }
            if ($(this).hasClass('working')) {
                return false;
            }
            var _obj = $(this);
            $.ajax({
                url: '<?php echo _u('/stowage/ship/'); ?>',
                type: 'get',
                dataType: 'json',
                data: $('input[name="ship_key"]'),
                beforeSend: function() {
                    $(_obj).addClass('working');
                },
                complete: function() {
                    $(_obj).removeClass('working');
                },
                success: function(data) {
                    if (data['result']) {
                        for (var i=0; i<data['result'].length; i++) {
                            if ($('select[name="ship_select"]').find('option[value="'+data['result'][i]['ship_number']+'"]').length == 0) {
                                $('select[name="ship_select"]').find('optgroup').first().prepend('<option value="'+data['result'][i]['ship_number']+'">'+data['result'][i]['ship_number']+'</option>');
                            }
                        }
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        });
    });
</script>
</body>
</html>