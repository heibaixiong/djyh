<?php
if(!defined('PART'))exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_['config']['title'];?></title>
<?php
//_jq();
_js('jquery');
_js('jquery-mousewheel');
_js('jquery-ui');
_js('jScrollbar.jquery');
_js('distpicker.data');
_js('distpicker');
_css('login');
?>
</head>
<body>

<div class="toplogo auto1000"><div><img src="<?php echo _img('logo.png');?>" height="68"></div></div>
<div class="poster auto1000" style="width: 100%;">
    <div class="images"><img src="<?php echo _img('poster01.jpg');?>" width="100%" height="450" /></div>
</div>

<ul class="login_dl auto1000">
    <form action="<?php echo _u('/user//');?>" method="post" id="form1" name="form1">
    <li><input type="text" name="aname" id="aname" placeholder="手机号码" /></li>
    <li><input type="password" name="apass" id="apass" placeholder="密码" /></li>
    <li><a href="javascript:void(0);" id="btn-login">登录</a><input type="submit" style="display: none;" /></li>
        <li style="padding-top: 25px; margin-left: 5px;"><span style="cursor: pointer;" onclick="$('#bg').show();$('#passFind').show();$('body').css('overflow', 'hidden');">忘记密码？</span></li>
    </form>
</ul>
<div class="login_retail">
    <div class="login_bg01">零售商</div>
    <div style="display: block;" class="cates auto1000">
        <dl class="dl01">
            <a><img src="<?php echo _img('login_icon01.jpg');?>" /></a>
            <dt>全城比价</dt>
            <dd>多家供应商直接比价<br>一目了然最优选</dd>
        </dl>
        <dl class="dl02">
            <a><img src="<?php echo _img('login_icon02.jpg');?>" /></a>
            <dt>选品保证</dt>
            <dd>入驻供货商严格验证<br>品牌监管保障正品</dd>
        </dl>
        <dl class="dl03">
            <a><img src="<?php echo _img('login_icon03.jpg');?>" /></a>
            <dt>贴心配送</dt>
            <dd>今日下单次日送达<br>轻松坐等货到家</dd>
        </dl>
        <dl class="dl04">
            <a><img src="<?php echo _img('login_icon04.jpg');?>" /></a>
            <dt>货到付款</dt>
            <dd>不押款不垫付<br>验货再付款保安全</dd>
        </dl>
    </div>
    <div id="show" class="login_bg02" onclick = "showPay()">点击入驻</div>
</div>

<div class="login_retail02">
    <div class="login_bg01">供货商</div>
    <div style="display: block;" class="cates auto1000">
        <dl class="dl01">
            <a><img src="<?php echo _img('login_icon05.jpg');?>" /></a>
            <dt>增加销量</dt>
            <dd>拓宽销售渠道<br>吸引更多采购商成交</dd>
        </dl>
        <dl class="dl02">
            <a><img src="<?php echo _img('login_icon06.jpg');?>" /></a>
            <dt>渠道管理</dt>
            <dd>出货、配送、货款数据化运营<br>一个后台管理多个渠道</dd>
        </dl>
        <dl class="dl03">
            <a><img src="<?php echo _img('login_icon07.jpg');?>" /></a>
            <dt>物流支持</dt>
            <dd>服务站提供本地化配送<br>物流更省心</dd>
        </dl>
        <dl class="dl04">
            <a><img src="<?php echo _img('login_icon08.jpg');?>" /></a>
            <dt>实时到款</dt>
            <dd>平台担保，无需账期<br>货到即可收款</dd>
        </dl>
    </div>
    <div class="login_bg02" onclick = "showPay02()">点击入驻</div>
</div>

<div id="passFind" class="O_pay" style="display:none; height: 300px;border: 5px solid #F0F0F0; overflow: hidden;">
    <div class="close"><a href="javascript:void(0);" onclick = "$('#passFind').hide();$('#bg').hide();$('body').css('overflow', 'auto');"><img src="<?php echo _img('close_x.png');?>"></a></div>
    <div class="sub">
        <div class="order_close"><a class="lss_tittle">登录密码找回</a></div>
        <form class="item02" action="<?php echo _u('/user/step_one/');?>" method="post" AutoComplete="off">
            <ul>
                <li>
                    <input type="text" id="ovid_phone" name="fname" placeholder="请输入用户名" AutoComplete="off" />
                </li>
                <li>
                    <input type="text" id="ovid_msg01" name="fcode" placeholder="短信验证码" AutoComplete="off" />
                    <input type="button" id="ovid_msg02" class="btn-sms" value="获取短信验证码" />
                </li>
                <li style="padding-top: 20px;">
                    <input type="button" class="next btn-reg" id="next_two" data-toggle="step_one" value="下一步" />
                </li>
                <li style="display: none;">
                    <input type="password" id="ovid_mm01" name="fpass" placeholder="新的密码" AutoComplete="off" />
                </li>
                <li style="display: none;">
                    <input type="password" id="ovid_mm02" name="fpass2" placeholder="重复密码" AutoComplete="off" />
                </li>
                <li style="display: none; padding-top: 20px;">
                    <input type="button" class="next btn-reg" id="next_two" data-toggle="step_two" value="确认重置" />
                </li>
            </ul>
        </form>
    </div>
</div>

<div id="closePay" class="O_pay jScrollbar" style="display:none;">
    <div class="close"><a href="javascript:void(0);" onclick = "closePay()"><img src="<?php echo _img('close_x.png');?>"></a></div>
    <div class="sub jScrollbar_mask">
        <div class="order_close"><a class="lss_tittle">零售商注册</a><a class="lss_login" onclick = "closePay()">在此登录<span>已有账号</span></a></div>
        <form class="item02" action="<?php echo _u('/user/reg/');?>" method="post">
            <input type="hidden" name="atype" value="5" />
            <ul>
                <li>
                    <input type="text" id="ovid_phone" name="aname" placeholder="手机号" AutoComplete="off" />
                </li>
                <li>
                    <input type="text" id="ovid_msg01" name="acode" placeholder="短信验证码" autocomplete="off" />
                    <input type="button" id="ovid_msg02" class="btn-sms" value="获取短信验证码" />
                </li>
                <li>
                    <input type="password" id="ovid_mm01" name="apass" placeholder="密码" autocomplete="off" />
                </li>
                <li>
                    <input type="password" id="ovid_mm02" name="apass2" placeholder="重复密码" autocomplete="off" />
                </li>
                <li style="height:110px;">
                    <div class="login_photo01">
                        <span>门店照片</span>
                        <a href="" data-toggle="upload-image" title="点击上传照片！"><img src="<?php echo _img('login_icon04.jpg');?>"></a>
                        <input type="hidden" name="shop_image" value="" />
                    </div>
                    <div class="login_photo02">
                        <span>营业执照或身份证</span>
                        <a href="" data-toggle="upload-image" title="点击上传照片！"><img src="<?php echo _img('login_icon04.jpg');?>"></a>
                        <input type="hidden" name="id_image" value="" />
                    </div>
                </li>
                <li id="adress">
                    <div class="det_adress" data-toggle="distpicker">
                        <a>所在地</a>
                        <select id="pro_n" data-province="河南省" name="pro_n">

                        </select>
                        <select id="cit_n" data-city="" name="cit_n">

                        </select>
                        <select id="cou_n" data-district="" name="cou_n">

                        </select>
                        <input type="hidden" name="code" value="0" />
                    </div>
                </li>
                <li id="adress" class="new_adress">
                    <textarea name="address"  aria-combobox="list" placeholder="详细地址"></textarea>
                </li>
                <li>
                    <input type="text" name="company" placeholder="店名" id="ovid_snam" />
                </li>
                <li>
                    <input type="text" name="contact" placeholder="联系人" id="ovid_contact" />
                </li>
                <li>
                    <input type="text" name="invite" placeholder="邀请人手机号(选填)" id="ovid_inphone"  />
                </li>
                <li class="lab text_left">
                    <input type="checkbox" name="agree" value="1" id="check_agree1" class="chec_a" />
                    <label class="check_lab size14 check_hr" for="check_agree1">
                        <a id="ncheck" class="check_h">我已阅读并同意《东家要货注册协议》</a>
                    </label>
                </li>
                <li>
                    <input type="button" class="next btn-reg" id="next_two" value="注册" />
                </li>
            </ul>
        </form>
    </div>
    <div class="jScrollbar_draggable">
        <a href="#" class="draggable"></a>
    </div>
</div>
<div id="bg" class="bg" style="display:none;"></div>

<div id="closePay02" class="O_pay jScrollbar" style="display:none">
    <div class="close"><a href="javascript:void(0);" onclick = "closePay02()"><img src="<?php echo _img('close_x.png');?>"></a></div>
    <div class="sub jScrollbar_mask">
        <div class="order_close"><a class="lss_tittle">供货商注册</a><a class="lss_login" onclick = "closePay02()">在此登录<span>已有账号</span></a></div>
        <form class="item03" action="<?php echo _u('/user/reg/');?>" method="post">
            <input type="hidden" name="atype" value="3" />
            <ul>
                <li>
                    <input type="text" id="ovid_phone" name="aname" placeholder="手机号" />
                </li>
                <li>
                    <input type="text" id="ovid_msg01" name="acode" placeholder="短信验证码"  />
                    <input type="button" id="ovid_msg02" class="btn-sms" value="获取短信验证码" />
                </li>
                <li>
                    <input type="password" id="ovid_mm01" name="apass" placeholder="密码" />
                </li>
                <li>
                    <input type="password" id="ovid_mm02" name="apass2" placeholder="重复密码" />
                </li>
                <li style="height:110px;">
                    <div class="login_photo01">
                        <span>营业执照</span>
                        <a href="" data-toggle="upload-image" title="点击上传照片！"><img src="<?php echo _img('login_icon04.jpg');?>"></a>
                        <input type="hidden" name="business_image" value="" />
                    </div>
                    <div class="login_photo02">
                        <span>税务登记</span>
                        <a href="" data-toggle="upload-image" title="点击上传照片！"><img src="<?php echo _img('login_icon04.jpg');?>"></a>
                        <input type="hidden" name="tax_image" value="" />
                    </div>
                </li>
                <li id="adress">
                    <div class="det_adress" data-toggle="distpicker">
                        <a>所在地</a>
                        <select id="pro_n" data-province="河南省" name="pro_n">

                        </select>
                        <select id="cit_n" data-city="" name="cit_n">

                        </select>
                        <select id="cou_n" data-district="" name="cou_n">

                        </select>
                        <input type="hidden" name="code" value="0" />
                    </div>
                </li>
                <li id="adress" class="new_adress">
                    <textarea name="address"  aria-combobox="list" placeholder="详细地址"></textarea>
                </li>
                <li>
                    <input type="text" name="company" placeholder="公司名称" id="ovid_gnam" />
                </li>
                <li>
                    <input type="text" name="category" placeholder="主营类目"  id="ovid_imp" />
                </li>
                <li>
                    <input type="text" name="contact" placeholder="联系人" id="ovid_contact" />
                </li>
                <li>
                    <input type="text" name="invite" placeholder="邀请人手机号(选填)" id="ovid_inphone"  />
                </li>
                <li class="lab text_left">
                    <input type="checkbox" name="agree" value="1" id="check_agree2" class="chec_a" />
                    <label class="check_lab size14 check_hr" for="check_agree2">
                        <a id="ncheck" class="check_h">我已阅读并同意《东家要货注册协议》</a>
                    </label>
                </li>
                <li>
                    <input type="button" class="next btn-reg" id="next_two" value="注册" />
                </li>
            </ul>
        </form>
    </div>
    <div class="jScrollbar_draggable">
        <a href="#" class="draggable"></a>
    </div>
</div>

<div id="closePay03" class="O_pay03">
    <div class="sub ">
        <div class="close"><a href="javascript:void(0);" onclick="$('.O_pay03').hide();"><img src="<?php echo _img('close_x02.png');?>"></a></div>
        <video id="vio01" poster="<?php echo _img('djyh_prv_0.png');?>"  preload="preload"  muted  width="700px;" autoplay>
            <source src="<?php echo _img('djyh_prv_0.mp4');?>" type="video/mp4" />
        </video>
        <!--
        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="700" height="394" title="flash">
            <param name="movie" value="images/djyh_prv_001.swf" />
            <param name="quality" value="high" />
            <embed src="<?php echo _img('djyh_prv_0.swf'); ?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="700" height="394"></embed>
        </object>
        -->
    </div>
    <div id="bg03" class="bg03"></div>
    <iframe id='popIframe03' class='popIframe03' frameborder='0' ></iframe>
</div>

<div class="footer">
    2015-<?php echo date('Y');?> <?php echo $_['config']['compony'];?> 版权所有<br /><?php echo $_['config']['icp'];?>
    <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1258835937'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1258835937%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>
</div>
</body>
</html>
<script type="text/javascript">
    var sms_time = 60;

    $(function(){
        $("#btn-login").click(function(){
            $("#form1").submit();
        });

        $('.btn-sms').click(function(){
            //console.log('sms click.');
            var _t = $(this);
            $.ajax({
                url: '<?php echo _u('/user/sms/');?>',
                type: 'post',
                dataType: 'json',
                data: $(_t).closest('form').find('input'),
                beforeSend: function() {
                    $('.btn-sms').attr('disabled', true);
                    $('li.error-warning').remove();
                },
                complete: function() {
                    //$('#mobile_code').attr('disabled', false);
                    //$('.attention').remove();
                },
                success: function(data) {
                    if (data['error']) {
                        //$('#btn_sms').attr('disabled', false);
                        //alert('短信发送失败！请检查手机号码是否正确！');
                        var _html = '<li class="error-warning" style="height: 20px; color: #a70001;">'+data['error']+'</li>';
                        $(_t).closest('ul').prepend(_html);
                        setTimeout(function(){
                            $('li.error-warning').slideUp();
                            $('li.error-warning').remove();
                            $('.btn-sms').attr('disabled', false);
                        }, 3000);
                    }
                    //console.log('sms send..');
                    if (data['success']) {
                        /*setTimeout(function(){
                            $('#btn_sms').attr('disabled', false);
                        }, 60000);*/
                        $('.btn-sms').val('60秒后重新获取');
                        var sms_Interval = setInterval(function(){
                            sms_time--;
                            if  (sms_time < 1) {
                                clearInterval(sms_Interval);
                                $('.btn-sms').val('获取短信验证码');
                                $('.btn-sms').attr('disabled', false);
                                sms_time = 60;
                            } else {
                                if (sms_time < 10) {
                                    sms_time = '0' + sms_time;
                                }
                                $('.btn-sms').val(sms_time + '秒后重新获取');
                            }
                        }, 1000);

                        $(_t).closest('form').find('input[name="acode"]').focus();
                    }
                }
            });
        });
    });

    $("#vio01").on('timeupdate',function(){
        if($("#vio01")[0].currentTime.toFixed(1)==5.1){
            setTimeout(function(){

                $(".O_pay03").hide();

            },1000);
        }
    });

    $(document).ready(function(){
        setTimeout(function(){

            $(".O_pay03").hide();

        },7000);
    });

    function showPay(){
        $('#closePay').css('top', '38%');
        $('#closePay').css('height', $(window).height() * 0.8).show();
        $('#closePay .jScrollbar_draggable').css('height', $(window).height() * 0.8);
        $('#bg').show();
        $('#closePay').jScrollbar({scrollStep:50});
        $('body').css('overflow', 'hidden');
    }
    // hide
    function closePay(){
        $('#closePay').hide();
        $('#bg').hide();
        $('body').css('overflow', 'auto');
    }
    function showPay02(){
        $('#closePay02').css('top', '38%');
        $('#closePay02').css('height', $(window).height() * 0.8).show();
        $('#closePay02 .jScrollbar_draggable').css('height', $(window).height() * 0.8);
        $('#bg').show();
        $('#closePay02').jScrollbar({scrollStep:50});
        $('body').css('overflow', 'hidden');
    }
    // hide
    function closePay02(){
        $('#closePay02').hide();
        $('#bg').hide();
        $('body').css('overflow', 'auto');
    }

    $(document).click(function(event){
        var e=window.event || event;

        if(e.stopPropagation){
            e.stopPropagation();
        }else{
            e.cancelBubble = true;
        }

        var _obj = e.srcElement ? e.srcElement : e.target;
        //console.log(_obj);
        if  ($(_obj).attr('id') == 'bg') {
            $('#closePay').hide();
            $('#closePay02').hide();
            $('#passFind').hide();
            $('#bg').hide();
            $('body').css('overflow', 'auto');
        }
    });

    $(document).delegate('.btn-reg', 'click', function() {
        //$(this).closest('form').submit();
        $(this).closest('form').find('input[name="code"]').val($(this).closest('form').find('select[name="cou_n"]').find('option:selected').data('zipcode'));
        var _t = $(this);
        var _url = $(this).closest('form').attr('action');
        $.ajax({
            url: _url,
            type: 'post',
            dataType: 'json',
            data: $(_t).closest('form').find('input[type!="checkbox"], input[type="checkbox"]:checked, select, textarea'),
            beforeSend: function() {
                //$(_t).prop('disabled', true);
                $(_t).closest('ul').find('li.error-warning').remove();
            },
            complete: function() {
                //$(_t).prop('disabled', false);
            },
            success: function(data) {
                if (data['error']) {
                    //$('#btn_sms').attr('disabled', false);
                    //alert(data['error']);
                    var _html = '<li class="error-warning" style="height: 20px; color: #a70001;">'+data['error']+'</li>';
                    $(_t).closest('ul').prepend(_html);
                    $(_t).closest('.jScrollbar_mask').css('top', '0px');
                    setTimeout(function(){
                        $('li.error-warning').slideUp();
                        $('li.error-warning').remove();
                        if (data['back']) {
                            if ($(_t).closest('form').find('input[name="fname"]').length > 0) {
                                if ($(_t).data('toggle') == 'step_two') {
                                    $(_t).closest('form').find('li').each(function(e, t){
                                        if (e > 2) {
                                            $(this).hide();
                                        } else {
                                            $(this).show();
                                        }
                                    });
                                    $(_t).closest('form').find('input[name="fcode"]').val('');
                                    $(_t).closest('form').find('input[name="fpass"]').val('');
                                    $(_t).closest('form').find('input[name="fpass2"]').val('');
                                    $(_t).closest('form').attr('action', "<?php echo _u('/user/step_one'); ?>");
                                }
                            }
                        }
                    }, 5000);
                }

                if (data['success']) {
                    if ($(_t).closest('form').find('input[name="fname"]').length > 0) {
                        if ($(_t).data('toggle') == 'step_one') {
                            $(_t).closest('form').find('li').each(function(e, t){
                                if (e > 2) {
                                    $(this).show();
                                } else {
                                    $(this).hide();
                                }
                            });
                            $(_t).closest('form').attr('action', "<?php echo _u('/user/step_two'); ?>");
                        } else if ($(_t).data('toggle') == 'step_two') {
                            alert('密码熏置成功！请重新登录！');
                            $(_t).closest('.O_pay').find('.close a').first().trigger('click');
                            $(_t).closest('form').find('li').each(function(e, t){
                                if (e > 2) {
                                    $(this).hide();
                                } else {
                                    $(this).show();
                                }
                            });
                            $(_t).closest('form').find('input[name="fname"]').val('');
                            $(_t).closest('form').find('input[name="fcode"]').val('');
                            $(_t).closest('form').find('input[name="fpass"]').val('');
                            $(_t).closest('form').find('input[name="fpass2"]').val('');
                            $(_t).closest('form').attr('action', "<?php echo _u('/user/step_one'); ?>");
                        }
                    } else {
                        alert('注册成功！请等待审核开通！');
                        $(_t).closest('.O_pay').find('.close a').first().trigger('click');
                    }
                }
            }
        });
    });

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
                    url: '<?php echo _u('/user/upload/'); ?>',
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
</script>