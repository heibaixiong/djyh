<?php
if(!defined('PART'))exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="zh_cn">
    <meta charset="utf-8">
    <title><?php echo $_['title']; ?></title>
    <meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <?php
    _js('jquery');
    _js('index');
    _js('distpicker.data');
    _js('distpicker');
    _css('base');
    _css('my_index');
    ?>
</head>
<body>
<!-- 顶部-->
<div class="dev_top">
    <div class="dev_top_list">
        <a><?php echo $_['ship_address'][1]; ?></a>
    </div>
    <a class="dev_tittle">
        <?php if (isset($_['order_info']['id'])) { ?>
            修改订单
        <?php } else { ?>
            我要发货
        <?php } ?>
    </a>
    <a class="dev_order" href="<?php echo _u('/order/list/'._v(4).'/'._v(5).'/'); ?>">我的订单</a>
</div>
<div class="dev_main">
    <form action="<?php echo _u('/ship/post/'); ?>" enctype="multipart/form-data" id="form-order-submit" method="post">
    <!--发货地址-->
    <ul class="dev_ares_box">
        <li style="text-align: center; margin-top: 10px; color: orangered;">您附近五公里范围内有<?php echo $_['user_online']; ?>个小哥.</li>
        <li class="dev_ares_lin01">
            <input type="hidden" name="order_id" value="<?php echo isset($_['order_info']['id'])?$_['order_info']['id']:0; ?>" />
            <input type="hidden" name="ship_bd_lng" value="<?php echo $_['gps_loction']['bd_lng']; ?>" />
            <input type="hidden" name="ship_bd_lat" value="<?php echo $_['gps_loction']['bd_lat']; ?>" />
            <input type="hidden" name="ship_lng" value="<?php echo $_['gps_loction']['gps_lng']; ?>" />
            <input type="hidden" name="ship_lat" value="<?php echo $_['gps_loction']['gps_lat']; ?>" />
            <input type="hidden" name="ship_prov" value="<?php echo $_['ship_address'][0]; ?>" />
            <input type="hidden" name="ship_city" value="<?php echo $_['ship_address'][1]; ?>" />
            <input type="hidden" name="ship_area" value="<?php echo $_['ship_address'][2]; ?>" />
            <input type="hidden" name="cons_zipcode" value="<?php echo isset($_['order_info']['consignee_zipcode'])?$_['order_info']['consignee_zipcode']:''; ?>" />
            <a class="dev_lin01_in01 textellipsis"><?php echo $_['address_first']; ?></a>
            <a href="<?php echo $_['url_geo']; ?>" class="dev_lin01_in02">修改位置</a>
        </li>
        <li class="dev_ares_lin01 dev_ares_lin02">
            <a class="dev_lin02_in01"><input type="text" name="ship_address" value="<?php echo $_['address_last']; ?>" placeholder="发货详细地址"></a>
        </li>
        <li class="dev_ares_lin03">
            <a class="dev_lin03_in01"><input type="text" name="ship_name" value="<?php echo isset($_['order_info']['ship_name'])?$_['order_info']['ship_name']:''; ?>" placeholder="发货人名称"></a>
            <a class="dev_lin03_in02"><input type="text" name="ship_phone" value="<?php echo isset($_['order_info']['ship_phone'])?$_['order_info']['ship_phone']:''; ?>" placeholder="发货人电话"></a>
        </li>
        <li class="dev_ares_lin01 dev_ares_lin04">
          <div class="dev_lin04_in01" data-toggle="distpicker">
              <span class="dev_lin04_icon01"></span>
              <div class="dev_province_box">
                  <select id="pro_n" data-province="<?php echo isset($_['order_info']['consignee_prov'])?$_['order_info']['consignee_prov']:'河南省'; ?>" name="cons_prov" style="display: none;">

                  </select>
                  <span class="dev_province dev_province01 ">请选择</span>
                  <a class="dev_province_bg"></a>
              </div>
              <div class="dev_province_box">
                  <select id="cit_n" data-city="<?php echo isset($_['order_info']['consignee_city'])?$_['order_info']['consignee_city']:''; ?>" name="cons_city" style="display: none;">

                  </select>
                  <span class="dev_province dev_province02">请选择</span>
                  <a class="dev_province_bg"></a>
              </div>
              <div class="dev_province_box">
                  <select id="cou_n" data-district="<?php echo isset($_['order_info']['consignee_area'])?$_['order_info']['consignee_area']:''; ?>" name="cons_area" style="display: none;">

                  </select>
                  <span class="dev_province dev_province03">请选择</span>
                  <a class="dev_province_bg"></a>
              </div>
          </div>
        </li>
        <li class="dev_ares_lin01 dev_ares_lin05">
            <a class="dev_lin05_in01"><input type="text" name="cons_address" value="<?php echo isset($_['order_info']['consignee_address'])?$_['order_info']['consignee_address']:''; ?>" placeholder="收货人详细地址"></a>
        </li>
        <li class="dev_ares_lin03 dev_ares_lin06">
            <a class="dev_lin03_in01 dev_lin06_in01"><input type="text" name="cons_name" value="<?php echo isset($_['order_info']['consignee_name'])?$_['order_info']['consignee_name']:''; ?>" placeholder="收货人名称"></a>
            <a class="dev_lin03_in02 dev_lin06_in02"><input type="text" name="cons_phone" value="<?php echo isset($_['order_info']['consignee_phone'])?$_['order_info']['consignee_phone']:''; ?>" placeholder="收货人电话"></a>
        </li>
        <li class="dev_ares_lin07">
            <div class="dev_lin07_in01">
                <div class="dev_weight">
                    <a>重量</a>
                    <input type="text" name="ship_weight" value="<?php echo isset($_['order_info']['ship_weight'])?$_['order_info']['ship_weight']:''; ?>" placeholder="请填写重量(kg)" style="padding-left:10px;" />
                </div>
                <div class="dev_volume">
                    <a>体积</a>
                    <input type="text" name="ship_cubic" value="<?php echo isset($_['order_info']['ship_cubic'])?$_['order_info']['ship_cubic']:''; ?>" placeholder="请填写体积(m³)" style="padding-left:10px;" />
                </div>
                <div class="dev_volume">
                    <a>数量</a>
                    <input type="text" name="ship_quantity" value="<?php echo isset($_['order_info']['ship_quantity'])?$_['order_info']['ship_quantity']:''; ?>" placeholder="请填写货物件数" style="padding-left:10px;" />
                </div>
                <div class="dev_volume">
                    <a>内容</a>
                    <input type="text" name="ship_desc" value="<?php echo isset($_['order_info']['ship_desc'])?$_['order_info']['ship_desc']:''; ?>" placeholder="请填写货物内容" style="padding-left:10px;" />
                </div>
            </div>
        </li>
        <li class="dev_ares_lin08">
            <div class="dev_lin08_in01">
                    <a class="dev_photo">照片</a>
                <div class="dev_add_photo">
                    <?php $image_i = 0; ?>
                    <?php if (isset($_['order_info']['ship_image']) && is_file(DIR.$_['order_info']['ship_image'])) { ?>
                        <?php $image_i++; ?>
                        <a href="/" data-toggle="upload-image"><img src="<?php echo _resize($_['order_info']['ship_image'],151,151); ?>" alt="" /><span></span></a>
                        <input type="hidden" name="ship_image[]" value="<?php echo $_['order_info']['ship_image']; ?>" />
                    <?php } ?>
                    <?php if (isset($_['order_info']['ship_image1']) && is_file(DIR.$_['order_info']['ship_image1'])) { ?>
                        <?php $image_i++; ?>
                        <a href="/" data-toggle="upload-image"><img src="<?php echo _resize($_['order_info']['ship_image1'],151,151); ?>" alt="" /><span></span></a>
                        <input type="hidden" name="ship_image[]" value="<?php echo $_['order_info']['ship_image1']; ?>" />
                    <?php } ?>
                    <?php if (isset($_['order_info']['ship_image2']) && is_file(DIR.$_['order_info']['ship_image2'])) { ?>
                        <?php $image_i++; ?>
                        <a href="/" data-toggle="upload-image"><img src="<?php echo _resize($_['order_info']['ship_image2'],151,151); ?>" alt="" /><span></span></a>
                        <input type="hidden" name="ship_image[]" value="<?php echo $_['order_info']['ship_image2']; ?>" />
                    <?php } ?>
                    <?php for ($i=0;$i<3-$image_i;$i++) { ?>
                        <a href="/" data-toggle="upload-image"><span style="display: none;"></span></a>
                        <input type="hidden" name="ship_image[]" value="" />
                    <?php } ?>
                </div>
            </div>
        </li>
        <li class="dev_ares_lin09">
            <div class="dev_lin09_in01">
                <div class="dev_pay">
                    <p class="dev_pay_set">付款方式</p>
                    <div class="dev_selt">
                        <?php if (isset($_['order_info']['pay_method']) && $_['order_info']['pay_method'] == 'cod') { ?>
                            <p data-method="cash"><a>现付</a><span>（现金/网银）</span><i></i></p>
                            <p class="current_p" style="float: right" data-method="cod"><a>到付</a><span>（现金/网银）</span><i class="dev_dui"></i></p>
                            <input type="hidden" name="pay_method" value="cod" />
                        <?php } else { ?>
                            <p class="current_p" data-method="cash"><a>现付</a><span>（现金/网银）</span><i class="dev_dui"></i></p>
                            <p style="float: right" data-method="cod"><a>到付</a><span>（现金/网银）</span><i></i></p>
                            <input type="hidden" name="pay_method" value="cash" />
                        <?php } ?>
                    </div>
                </div>
                <div class="dev_pay02">
                    <p class="dev_pay_set">代收货款</p>
                    <div class="dev_selt">
                        <?php if (isset($_['order_info']['ship_cod']) && $_['order_info']['ship_cod'] > 0) { ?>
                            <p class="current_p"><a>是</a><span>（小哥收款）</span><i class="dev_dui"></i></p>
                            <p style="float: right"><a>否</a><span>（其他转账）</span><i></i></p>
                            <input type="hidden" name="ship_cod" value="1" />
                        <?php } else { ?>
                            <p><a>是</a><span>（小哥收款）</span><i></i></p>
                            <p class="current_p" style="float: right"><a>否</a><span>（其他转账）</span><i class="dev_dui"></i></p>
                            <input type="hidden" name="ship_cod" value="0" />
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="dev_pay03">
                <p class="dev_pay_set02"><a>运费出价</a></p>
                <div class="dev_selt02">
                    <input type="text" name="ship_amount" value="<?php echo isset($_['order_info']['ship_amount'])?$_['order_info']['ship_amount']:''; ?>" placeholder="请输入金额">
                </div>
            </div>
        </li>
        <li class="dev_ares_lin10">
            <div class="dev_lin10_in01">
                <a>备注</a>
            </div>
            <input type="text" name="ship_note" value="<?php echo isset($_['order_info']['ship_note'])?$_['order_info']['ship_note']:''; ?>" placeholder="其他备注">
        </li>
    </ul>
    <div class="foot_box">
        <a class="foot_pic"><span>￥</span><?php echo isset($_['order_info']['ship_amount'])?_rmb($_['order_info']['ship_amount']):'0.00'; ?></a>
        <a href="javascript:void(0);" class="foot_order" id="btn-order-submit">
            <?php echo isset($_['order_info']['id'])?'确认修改':'立即下单'; ?>
        </a>
    </div>
    </form>
</div>
<!--弹出-->
<div class="slide-mask"></div>
<div class="slide-wrapper" id="slide_top" >
   <ul class="slide_city">
       <li class="current_city ">郑州市</li>
       <li>洛阳市</li>
       <li>开封市</li>
       <li>许昌市</li>
       <li>平顶山市</li>
       <li>安阳市</li>
       <li>焦作市</li>
       <li>新乡市</li>
       <li>濮阳市</li>
       <li>驻马店市</li>
       <li>济源市</li>
       <li>漯河市</li>
       <li>商丘市</li>
       <li>周口市</li>
       <li>南阳市</li>
       <li>信阳市</li>
       <li>三门峡市</li>
       <li>鹤壁市</li>


   </ul>
    <div class="slide_city_bom">
        <div class="slide_city_pos">
            <a>当前选择城市：<span>郑州</span></a>
        </div>
    </div>
</div>
<!--弹出省-->
<div class="slide-wrapper" id="slide_wrapper01" >
    <ul class="slide_city">
        <li class="current_city ">河南省</li>
        <li>河南省</li>
        <li>河北省</li>
        <li>河南省</li>
        <li>河南省</li>
        <li>河南省</li>
        <li>河南省</li>
        <li>河南省</li>
        <li>河南省</li>
        <li>河南省</li>
        <li>河南省</li>
        <li>河南省</li>
        <li>河南省</li>
        <li>河南省</li>
        <li>河南省</li>
        <li>河南省</li>
        <li>河南省</li>
        <li>河南省</li>
    </ul>
    <div class="slide_city_bom">
        <div class="slide_city_pos">
            <a>当前选择省份：<span>河南省</span></a>
        </div>
    </div>
</div>

<!--弹出市-->
<div class="slide-wrapper" id="slide_wrapper02">
    <ul class="slide_city">
        <li class="current_city ">郑州市</li>
        <li>洛阳市</li>
        <li>开封市</li>
        <li>许昌市</li>
        <li>平顶山市</li>
        <li>安阳市</li>
        <li>焦作市</li>
        <li>新乡市</li>
        <li>濮阳市</li>
        <li>驻马店市</li>
        <li>济源市</li>
        <li>漯河市</li>
        <li>商丘市</li>
        <li>周口市</li>
        <li>南阳市</li>
        <li>信阳市</li>
        <li>三门峡市</li>
        <li>鹤壁市</li>
    </ul>
    <div class="slide_city_bom">
        <div class="slide_city_pos">
            <a>当前选择城市：<span>郑州</span></a>
        </div>
    </div>
</div>


<!--弹出区-->
<div class="slide-wrapper" id="slide_wrapper03">
    <ul class="slide_city">
        <li class="current_city ">二七区</li>
        <li>二七区</li>
        <li>二七区</li>
        <li>中原区</li>
        <li>中原区</li>
        <li>中原区</li>
        <li>中原区</li>
        <li>中原区</li>
        <li>中原区</li>
        <li>中原区</li>
        <li>中原区</li>
        <li>中原区</li>
        <li>中原区</li>
        <li>中原区</li>
        <li>中原区</li>
        <li>中原区</li>
        <li>中原区</li>
        <li>中原区</li>
    </ul>
    <div class="slide_city_bom">
        <div class="slide_city_pos">
            <a>当前选择区县：<span>二七区</span></a>
        </div>
    </div>
</div>

<script>

    $(document).delegate('a[data-toggle=\'upload-image\']', 'click', function(e) {
        e.preventDefault();

        var _t = $(this);

        $('#form-upload').remove();

        $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" value="" /><input type="hidden" name="size" value="151x151" /></form>');

        $('#form-upload input[name=\'file\']').trigger('click');

        if (typeof timer != 'undefined') {
            clearInterval(timer);
        }

        timer = setInterval(function() {
            if ($('#form-upload input[name=\'file\']').val() != '') {
                clearInterval(timer);

                $.ajax({
                    url: '<?php echo _u('/index/upload/'); ?>',
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
        $(this).prev('img').remove();
        $(this).parent('a').next('input[type="hidden"]').val('');
        $(this).hide();
    });

    $('input[name="ship_amount"]').on('keyup', function(){
        var _amount = $(this).val();

        if (isNaN(_amount)) {
            $(this).val(_amount.replace(/[^\d\.]/g, ''));
        }

        _amount = $(this).val() ? $(this).val() : '0';

        if (_amount.indexOf('.') > -1 && _amount.indexOf('.') + 3 < _amount.length) {
            _amount = _amount.substring(0, _amount.indexOf('.')+3);
            $(this).val(_amount);
        }

        $('.foot_box a.foot_pic').html('<span>￥</span>'+parseFloat(_amount).toFixed(2));
    });

    $('input[name="ship_weight"]').on('keyup', function(){
        var _amount = $(this).val();

        if (isNaN(_amount)) {
            $(this).val(_amount.replace(/[^\d\.]/g, ''));
        }

        _amount = $(this).val() ? $(this).val() : '0';

        if (_amount.indexOf('.') > -1 && _amount.indexOf('.') + 3 < _amount.length) {
            _amount = _amount.substring(0, _amount.indexOf('.')+3);
            $(this).val(_amount);
        }
    });

    $('input[name="ship_cubic"]').on('keyup', function(){
        var _amount = $(this).val();

        if (isNaN(_amount)) {
            $(this).val(_amount.replace(/[^\d\.]/g, ''));
        }

        _amount = $(this).val() ? $(this).val() : '0';

        if (_amount.indexOf('.') > -1 && _amount.indexOf('.') + 3 < _amount.length) {
            _amount = _amount.substring(0, _amount.indexOf('.')+3);
            $(this).val(_amount);
        }
    });

    $('input[name="ship_quantity"]').on('keyup', function(){
        var _amount = $(this).val().replace(/[^\d]/g, '');
        _amount = _amount ? parseInt(_amount) : '';
        $(this).val(_amount);
    });

    $('select[name="cons_prov"]').on('change', function(){//console.log('prov change');
        var _prov = $('select[name="cons_prov"]').find('option:selected').val();
        $('select[name="cons_prov"]').next('span').html(_prov);

        setTimeout(function(){
            $('#slide_wrapper02 ul.slide_city').html('');
            $('select[name="cons_city"] option').each(function(e,t){
                if (e > 0) {
                    var _html = '<li>';
                    if ($(this).prop('selected')) {
                        _html = '<li class="current_city">';
                        $('#slide_wrapper02 .slide_city_pos a span').html($(this).val());
                    }
                    _html += $(this).val()+'</li>';
                    $('#slide_wrapper02 ul.slide_city').append(_html);
                }
            });

            $('#slide_wrapper02 ul.slide_city li').unbind('click');
            $('#slide_wrapper02 ul.slide_city li').bind('click', function(){
                var bb=$(this).text();
                //$(".dev_province02").text(bb);
                $(this).parent('ul').find('li').removeClass('current_city');
                $(this).addClass('current_city');
                $(this).closest('div').find('.slide_city_pos a span').html(bb);
                $('select[name="cons_city"]').find('option[value="'+bb+'"]').attr('selected', true);
                $('select[name="cons_city"]').trigger('change');
            });

            $('select[name="cons_city"]').trigger('change');
        }, 500);
    });

    $('select[name="cons_city"]').on('change', function(){//console.log('city change');
        var _city = $('select[name="cons_city"]').find('option:selected').val();
        $('select[name="cons_city"]').next('span').html(_city);


        setTimeout(function(){
            $('#slide_wrapper03 ul.slide_city').html('');
            $('select[name="cons_area"] option').each(function(e,t){
                if (e > 0) {
                    var _html = '<li>';
                    if ($(this).prop('selected')) {
                        _html = '<li class="current_city">';
                        $('#slide_wrapper03 .slide_city_pos a span').html($(this).val());
                    }
                    _html += $(this).val()+'</li>';
                    $('#slide_wrapper03 ul.slide_city').append(_html);
                }
            });

            $('#slide_wrapper03 ul.slide_city li').unbind('click');
            $('#slide_wrapper03 ul.slide_city li').bind('click', function(){
                var bb=$(this).text();
                //$(".dev_province03").text(bb);
                $(this).parent('ul').find('li').removeClass('current_city');
                $(this).addClass('current_city');
                $(this).closest('div').find('.slide_city_pos a span').html(bb);
                $('select[name="cons_area"]').find('option[value="'+bb+'"]').attr('selected', true);
                $('select[name="cons_area"]').trigger('change');
            });

            $('select[name="cons_area"]').trigger('change');
        }, 500);
    });

    $('select[name="cons_area"]').on('change', function(){//console.log('area change');
        var _area = $('select[name="cons_area"]').find('option:selected').val();
        $('select[name="cons_area"]').next('span').html(_area);
    });

    $(document).ready(function(){
        $('#slide_wrapper01 ul.slide_city').html('');
        $('select[name="cons_prov"] option').each(function(e,t){
            if (e > 0) {
                var _html = '<li>';
                if ($(this).prop('selected')) {
                    _html = '<li class="current_city">';
                    $('#slide_wrapper01 .slide_city_pos a span').html($(this).val());
                }
                _html += $(this).val()+'</li>';
                $('#slide_wrapper01 ul.slide_city').append(_html);
            }
        });

        $('#slide_wrapper01 ul.slide_city li').unbind('click');
        $('#slide_wrapper01 ul.slide_city li').bind('click', function(){
            var bb=$(this).text();
            //$(".dev_province01").text(bb);
            $(this).parent('ul').find('li').removeClass('current_city');
            $(this).addClass('current_city');
            $(this).closest('div').find('.slide_city_pos a span').html(bb);
            $('select[name="cons_prov"]').find('option[value="'+bb+'"]').attr('selected', true);
            $('select[name="cons_prov"]').trigger('change');
        });

        $('select[name="cons_prov"]').trigger('change');
    });

    $(document).delegate('a[id=\'btn-order-submit\']', 'click', function(e) {
        e.preventDefault();
        if ($(this).prop('disabled') == true) return false;

        $(this).closest('form').find('input[name="cons_zipcode"]').val($(this).closest('form').find('select[name="cons_area"]').find('option:selected').data('zipcode'));
        var _t = $(this);
        var _url = $(this).closest('form').attr('action');
        $.ajax({
            url: _url,
            type: 'post',
            dataType: 'json',
            data: $(_t).closest('form').find('input, select'),
            beforeSend: function() {
                $(_t).prop('disabled', true);
                $(_t).closest('form').find('ul li.error-warning').remove();
            },
            complete: function() {
                $(_t).prop('disabled', false);
            },
            success: function(data) {
                if (data['error']) {
                    var _html = '<li class="error-warning" style="padding-top: 10px; color: red">'+data['error']+'</li>';
                    $(_t).closest('form').find('ul').prepend(_html);
                    $(window).scrollTop(0);
                }

                if (data['success']) {
                    alert('订单提交成功！');
                    window.location.href = '<?php echo _u('/order/list/'); ?>';
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });

</script>
</body>
</html>
