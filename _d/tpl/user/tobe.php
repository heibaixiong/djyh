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

    </div>
    <a class="dev_tittle">
        申请业务员
    </a>
    <a class="dev_order" href="<?php echo _u('/order/list/'._v(4).'/'._v(5).'/'); ?>">我的订单</a>
</div>
<div class="dev_main">
    <form action="<?php echo _u('/user/tobe/1/'); ?>" enctype="multipart/form-data" id="form-order-submit" method="post">
        <input type="hidden" name="cons_zipcode" value="" />
        <!--发货地址-->
        <ul class="dev_ares_box">
            <li class="dev_ares_lin01 dev_ares_lin04">
                <div class="dev_lin04_in01" data-toggle="distpicker">
                    <span class="dev_lin04_icon01"></span>
                    <div class="dev_province_box">
                        <select id="pro_n" data-province="<?php echo isset($_['user_info']['prov'])?$_['user_info']['prov']:'河南省'; ?>" name="cons_prov" style="display: none;">

                        </select>
                        <span class="dev_province dev_province01 ">请选择</span>
                        <a class="dev_province_bg"></a>
                    </div>
                    <div class="dev_province_box">
                        <select id="cit_n" data-city="<?php echo isset($_['user_info']['city'])?$_['user_info']['city']:''; ?>" name="cons_city" style="display: none;">

                        </select>
                        <span class="dev_province dev_province02">请选择</span>
                        <a class="dev_province_bg"></a>
                    </div>
                    <div class="dev_province_box">
                        <select id="cou_n" data-district="<?php echo isset($_['user_info']['area'])?$_['user_info']['area']:''; ?>" name="cons_area" style="display: none;">

                        </select>
                        <span class="dev_province dev_province03">请选择</span>
                        <a class="dev_province_bg"></a>
                    </div>
                </div>
            </li>

            <li class="dev_ares_lin03 dev_ares_lin06" style="border-bottom: solid 1px #d2d2d2;">
                <a class="dev_lin03_in01 dev_lin06_in01"><input type="text" name="cons_name" value="<?php echo isset($_['user_info']['real_name'])?$_['user_info']['real_name']:''; ?>" placeholder="姓名"></a>
                <a class="dev_lin03_in02 dev_lin06_in02"><input type="text" name="cons_phone" value="<?php echo isset($_['user_info']['phone'])?$_['user_info']['phone']:''; ?>" placeholder="电话"></a>
            </li>
            <li class="dev_ares_lin01 dev_ares_lin05" style="border-bottom: none;">
                <a class="dev_lin05_in01"><input type="text" name="cons_identify" value="<?php echo isset($_['user_info']['id_card'])?$_['user_info']['id_card']:''; ?>" placeholder="身份证号码"></a>
            </li>

            <li class="dev_ares_lin07">
                <div class="dev_lin07_in01">
                    <div class="dev_weight">
                        <a>性别</a>
                        <input type="text" name="ship_sex" value="<?php echo isset($_['user_info']['sex'])?$_['user_info']['sex']:''; ?>" placeholder="男/女" style="padding-left:10px;" />
                    </div>
                    <div class="dev_volume">
                        <a>年龄</a>
                        <input type="text" name="ship_age" value="<?php echo isset($_['user_info']['age'])?$_['user_info']['age']:''; ?>" placeholder="周岁" style="padding-left:10px;" />
                    </div>
                    <div class="dev_volume">
                        <a>学历</a>
                        <input type="text" name="ship_edu" value="<?php echo isset($_['user_info']['edu'])?$_['user_info']['edu']:''; ?>" placeholder="初中/高中/专科/本科" style="padding-left:10px;" />
                    </div>
                    <div class="dev_volume">
                        <a>经验</a>
                        <input type="text" name="ship_exp" value="<?php echo isset($_['user_info']['exp'])?$_['user_info']['exp']:''; ?>" placeholder="相关工作经历" style="padding-left:10px;" />
                    </div>
                </div>
            </li>

            <li class="dev_ares_lin08">
                <div class="dev_lin08_in01">
                    <a class="dev_photo">照片</a>
                    <div class="dev_add_photo">
                        <?php if (isset($_['user_info']['image']) && is_file(DIR.$_['user_info']['image'])) { ?>
                            <a href="/" data-toggle="upload-image"><img src="<?php echo _resize($_['user_info']['image'],151,151); ?>" alt="" /><span></span></a>
                            <input type="hidden" name="ship_image" value="<?php echo $_['user_info']['image']; ?>" />
                        <?php } else { ?>
                            <a href="/" data-toggle="upload-image"><img src="" alt="" /><span style="display: none;"></span></a>
                            <input type="hidden" name="ship_image" value="" />
                        <?php } ?>
                    </div>
                </div>
            </li>

            <li class="dev_ares_lin10">
                <div class="dev_lin10_in01">
                    <a>其它</a>
                </div>
                <input type="text" name="ship_note" value="<?php echo isset($_['user_info']['note'])?$_['user_info']['note']:''; ?>" placeholder="其他特长/优势">
            </li>
        </ul>
        <div class="foot_box">
            <?php if (!empty($_['user_info'])) { ?>
            <a class="foot_pic" style="font-weight: normal; font-size: 0.5rem;">您的申请正在审核中，请耐心等待！<br/><?php echo _time($_['user_info']['mod_time']); ?></a>
            <?php } ?>
            <a href="javascript:void(0);" class="foot_order" id="btn-order-submit">
                立即申请
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
                            $(_t).find('img').first().attr('src', json['thumb']);
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
        $(this).prev('img').attr('src', '');
        $(this).parent('a').next('input[type="hidden"]').val('');
        $(this).hide();
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
                    alert('您的申请已提交成功，我们会尽快与您联系！');
                    window.location.href = '<?php echo _u('/user/tobe/1/'); ?>';
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
