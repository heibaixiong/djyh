// JavaScript Document
$(function(){
    $(".dev_selt p").click(function(){
        $(this).addClass("current_p").siblings("p").removeClass("current_p");
        $(this).find("i").addClass("dev_dui").parents("p").siblings("p").find("i").removeClass("dev_dui");
        if ( typeof $(this).data('method') !== 'undefined') {
            $('input[name="pay_method"]').val($(this).data('method'));
        }
    });
    $('div.slide-mask').on('click', function(){
        $('div.slide-mask').hide();
        $("#slide_top").hide();
        $("#slide_wrapper01").hide();
        $("#slide_wrapper02").hide();
        $("#slide_wrapper03").hide();
        $('body').unbind('touchmove');
        $("body").css("overflow","auto");
    });
    /*$(".dev_top_list").toggle(function(){
        $('div.slide-mask').show();
        $("#slide_top").show();
        $(".dev_top").css("z-index","100");
        $('.dev_top').on('touchmove',function(e){
            e.preventDefault();
        });
        $("body").css("overflow","hidden");

    },function(){
        $('div.slide-mask').hide();
        $("#slide_top").hide();
        $(".dev_top").css("z-index","0");
        $('body').unbind('touchmove');
        $("body").css("overflow","auto");
    });*/
    $(".dev_province01").click(function(){
        $('div.slide-mask').show();
        $("#slide_wrapper01").show();
        $(".dev_top").css("z-index","0");
    });
    $(".dev_province02").click(function(){
        $('div.slide-mask').show();
        $("#slide_wrapper02").show();
        $(".dev_top").css("z-index","0");
    });
    $(".dev_province03").click(function(){
        $('div.slide-mask').show();
        $("#slide_wrapper03").show();
        $(".dev_top").css("z-index","0");
    });

    $(".slide_city li").click(function(){
         $(this).addClass("current_city").siblings("li").removeClass("current_city");
        var str=$(this).text();
        var re = /[市省]$/g;
        str = str.replace(re,function(res){
            return '';
        });
        $(this).parents(".slide_city").siblings(".slide_city_bom").find("span").text(str);

    });
    $("#slide_top  li").click(function(){
        var aa=$(this).text();
        $(".dev_top_list a").text(aa);
    });
    /*
    $("#slide_wrapper01  li").live('click', function(){
        var bb=$(this).text();
        //$(".dev_province01").text(bb);
        $(this).parent('ul').find('li').removeClass('current_city');
        $(this).addClass('current_city');
        $(this).closest('div').find('.slide_city_pos a span').html(bb);
        $('select[name="cons_prov"]').find('option[value="'+bb+'"]').attr('selected', true);
        $('select[name="cons_prov"]').trigger('change');
    });
    $("#slide_wrapper02  li").live('click', function(){
        var bb=$(this).text();
        //$(".dev_province02").text(bb);
        $(this).parent('ul').find('li').removeClass('current_city');
        $(this).addClass('current_city');
        $(this).closest('div').find('.slide_city_pos a span').html(bb);
        $('select[name="cons_city"]').find('option[value="'+bb+'"]').attr('selected', true);
        $('select[name="cons_city"]').trigger('change');
    });
    $("#slide_wrapper03  li").live('click', function(){
        var bb=$(this).text();
        //$(".dev_province03").text(bb);
        $(this).parent('ul').find('li').removeClass('current_city');
        $(this).addClass('current_city');
        $(this).closest('div').find('.slide_city_pos a span').html(bb);
        $('select[name="cons_area"]').find('option[value="'+bb+'"]').attr('selected', true);
        $('select[name="cons_area"]').trigger('change');
    });

    //    collect_page
   /* $(".cot_top_right a").click(function(){
        $(this).addClass("current_zd").siblings("a").removeClass("current_zd");
        $(this).closest('form').find('input[name="type"]').val($(this).data('type'));
    });
    $(".cot_top_right a:eq(0)").click(function(){
        $(".cot_top_left").show();
        $(" .cot_top_left02").hide();
    });
    $(".cot_top_right a:eq(1)").click(function(){
        $(".cot_top_left").hide();
        $(" .cot_top_left02").show();
    });*/
    $(".cot_top_left02").click(function(){
        $('#slide-mask02').show();
        $("#slide_top02").show();
        $('.dev_top').on('touchmove',function(e){
            e.preventDefault();
        });
        $("body").css("overflow","hidden");

    });
    $('div.slide-mask').on('click', function(){
        $("#slide_top02").hide();
    });
    $("#slide_top02 li").click(function(){
        $(".cot_top_in02").html($(this).text()+'<span></span>');
    });
    $(".cot_top_in01").click(function(){

        if($(".cot_top_in_list").css("display")=="none"){
            $(".cot_top_in_list").slideDown();
            $(this).addClass("current_in01");
        }else{
            $(this).removeClass("current_in01");
            $(".cot_top_in_list").slideUp(200);
        }
    });
    $(".cot_top_in_list li").click(function(){
        $(".cot_top_in01").html($(this).find("a").text()+'<span></span>');
        $(".cot_top_in_list").hide();
        $(".cot_top_in01").removeClass("current_in01");
        $(this).closest('form').find('input[name="distance"]').val($(this).data('distance'));
    });

//    cosig_order
    $(".cosig_top_box a").click(function(){
        $(this).addClass("current_cosiga").siblings("a").removeClass("current_cosiga");
    });
});
