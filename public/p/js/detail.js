$(function(){
   $(".list_lf01").mouseenter(function(){
        $(".banner").slideDown("fast");
   }).mouseleave(function(){
       $(".banner").hide();
       $(".banner").css("overflow","visible");
   })

    $(".banner").mouseenter(function(){
        $(this).show();

    }).mouseleave(function(){
        $(".banner").hide();
    })
    $("#nav li").mouseenter(function(){
        $(this).addClass("on")
        $(this).find("h3 a").css("color","#333333");
        $(this).find("p a").css("color","#646464");
        var bb=$(this).index();
        if(bb==0){
        $(this).find("h3 a").addClass("big_nav_bh01");
        }else if(bb==1){
            $(this).find("h3 a").addClass("big_nav_bh02");
        }else if(bb==2){
            $(this).find("h3 a").addClass("big_nav_bh03");
        }else if(bb==3){
            $(this).find("h3 a").addClass("big_nav_bh04");
        }else if(bb==4){
            $(this).find("h3 a").addClass("big_nav_bh05");
        }else if(bb==5){
            $(this).find("h3 a").addClass("big_nav_bh06");
        }else if(bb==6){
            $(this).find("h3 a").addClass("big_nav_bh07");
        }else if(bb==7){
            $(this).find("h3 a").addClass("big_nav_bh08");
        }

    }).mouseleave(function(){
        $(this).removeClass("on")
        $(this).find("h3 a").css("color","#fff").removeClass("big_nav_bh01 big_nav_bh02 big_nav_bh03 big_nav_bh04 big_nav_bh05 big_nav_bh06 big_nav_bh07 big_nav_bh08");
        $(this).find("p a").css("color","#fff");

    })

    $(window).resize(function(){
        var s_width=$(".detail_box").width()+2;
        $(".detail_main_lin02").css({"width":s_width});
        var bb= $(".detail_main_lin02").offset().top;


    })

    var navH = $(".detail_main_lin02").offset().top;
    //�������¼�
    $(window).scroll(function(){
        //��ȡ�������Ļ�������

        var scroH = $(this).scrollTop();
        var s_width=$(".detail_box").width()+2;
        //�������Ļ���������ڵ��ڶ�λԪ�ؾ�������������ľ��룬�͹̶�����֮�Ͳ��̶�
        if(scroH>=navH){
            $(".detail_main_lin02").css({"position":"fixed","top":"0px","margin-top":"1px","width":s_width,"z-index":"999"});
        }else if(scroH<navH){
            $(".detail_main_lin02").css({"position":"static","margin-top":"15px"});
        }
    })

    $(".detail_sml_img img").click(function(){
        $(this).parents(".detail_sml_img").siblings(".detail_big_img").find("img").attr("src",$(this).data('image'));
    })
    $(".detail_main_lin02 li").click(function(){
        var index=$(this).index();
        $(this).addClass("current_detlin01").siblings("li").removeClass("current_detlin01");
        $(".d_tab").eq(index).show().siblings(".d_tab").hide();
    })
    $(".detail_rig07_rig .select_box").click(function(){
        $(this).find(".select_box_in").addClass("add_box_in").parents(".select_box").siblings(".select_box").find(".select_box_in").removeClass("add_box_in");
        $(this).find(".select_cor_in").addClass("add_cor_in").parents(".select_box").siblings(".select_box").find(".select_cor_in").removeClass("add_cor_in");
        //$(".select_box .dui").hide();
        $(this).find(".dui").show().parents(".select_box").siblings(".select_box").find(".dui").hide();

        var _select = '';
        $('.detail_rig07_rig .select_box .add_box_in').each(function(){
            if (_select != '') _select += ',';
            _select += $(this).closest('dd').data('attr');
        });
        $('#btn-add-cart').data('option', _select);

    })
    $(".select_cor_in").click(function(){
        var new_img=$(this).find("img").attr("src");
        $(".detail_big_img").find("img").attr("src",new_img);

    })
    $(".d_coment_cor li").click(function(){
        $(this).addClass("current_l_first").siblings("li").removeClass("current_l_first");
        var cc=$(this).index();
        $(".d_coment_content").eq(cc).show().siblings(".d_coment_content").hide();
    })
    $(".d_zk_incoment li").click(function(){
        var cc=$(this).index();
        $(".d_coment_content").eq(cc).show().siblings(".d_coment_content").hide();
        $(".d_zk_incoment").hide();
        $(" .current_l_first02").removeClass("current_l_first03");
        $(".d_coment_cor li").eq(cc).addClass("current_l_first").siblings("li").removeClass("current_l_first");
    })
    $(".list_rig").click(function(){
        if($(".f_zk").css("display")=="none"){
            $(".f_zk").slideDown();
        }else{
            $(".f_zk").slideUp();
        }

    })
    $(" .current_l_first02").click(function(){
        if($(".d_zk_incoment").css("display")=="none"){
            $(".d_zk_incoment").show();
            $(this).addClass("current_l_first03");
        }else{
            $(".d_zk_incoment").hide();
            $(this).removeClass("current_l_first03");
        }

    })

    $('#btn-add-cart').click(function(){
        var id=parseInt($(this).attr('data'));
        var num=parseInt($('#goodsnum').val());
        var option = $(this).data('option');
        if(num>0){
            $.get("?p/cart/add/"+id+"/"+num+"/"+option+'/',function(data,status){
                var _result = $.parseJSON(data);
                $('#shopping-amount').next('span').html(_result['total']);
                //alert('添加成功！');
                alert(_result['msg']);
            });
        }
    });

    $('#btn-add-buy').click(function(){
        var id=parseInt($('#btn-add-cart').attr('data'));
        var num=parseInt($('#goodsnum').val());
        var option = $('#btn-add-cart').data('option');
        if(num>0){
            $.get("?p/cart/add/"+id+"/"+num+"/"+option+'/',function(data,status){
                var _result = $.parseJSON(data);
                $('#shopping-amount').next('span').html(_result['total']);
                if (_result['error']) {
                    alert(_result['msg']);
                } else {
                    window.location.href = "/?p/cart/index/";
                }
            });
        }
    });

    shopnum();

})
//�Ӽ�
function shopnum(){
    var shopnum=$(".detail_sl");
    shopnum.each(function(){
        var box=$(this);
        var inp=box.find("input");
        var jian=box.find(".detail_jian");
        var jia=box.find(".detail_jia");
        jian.click(function(){
            var num=parseNum(inp.val());
            num=num-1<=0?1:num-1;
            inp.val(num);
        });
        jia.click(function(){
            var num=parseNum(inp.val());
            num=num+1;
            if (num > inp.attr('maxnum')) num = inp.attr('maxnum');
            inp.val(num);
        });
        inp.keyup(function(){
            var num=parseNum(inp.val());
            if (num > inp.attr('maxnum')) num = inp.attr('maxnum');
            inp.val(num);
        });
        var parseNum=function(num){
            num=parseInt(num);
            return isNaN(num)?1:num;
        }
    });
}

