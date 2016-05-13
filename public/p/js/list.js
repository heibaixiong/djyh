$(function(){
    $(".option_more_box a").toggle(function(){
            $(".shower").show();
            $('.list_main_lin01 .current_li').eq(0).removeClass("current_li").addClass("on");


    },function(){
            $(".shower").hide();

            $('.list_main_lin01 .on').eq(0).removeClass("on").addClass("current_li");
        }
    )

    $(".list_xlbox_lin01").click(function(){

        if($(this).siblings(".list_xlbox_zk").css("display")=="none"){
            if($(this).hasClass("list_xlbox_zh")){
                $(this).css("border-bottom","dashed 1px #e5e5e5 ");
                $(this).siblings(".list_xlbox_zk").find("li").last().css("border-bottom","none");
            }
            $(".list_xlbox_zk").hide();
            $(".list_xlbox_lin01").removeClass("current_linnew");
            $(this).siblings(".list_xlbox_zk").show();
            $(this).addClass("current_linnew");
        }
        else{
            if($(this).hasClass("list_xlbox_zh")){
                $(this).css("border-bottom","none");
            }
            $(this).siblings(".list_xlbox_zk").hide();
            $(this).removeClass("current_linnew");
        }

    })
    $(".list_left_a02").hover(function(){
        $(this).find("span").addClass("current_span02");

    },function(){
        $(this).find("span").removeClass("current_span02");
    })
    $(".list_left_a03").hover(function(){
        $(this).find("span").addClass("current_span03");

    },function(){
        $(this).find("span").removeClass("current_span03");
    })
    $(".list_left_a04").hover(function(){
        $(this).find("span").addClass("current_span04");

    },function(){
        $(this).find("span").removeClass("current_span04");
    })


    $(".list_main_left .list_left_bh").click(function(){
      $(this).css({"background":"#fb3a3a"}).find("span").addClass("color_bh01").parents(".list_left_bh").siblings(".list_left_bh").css({"background":"#fff"}).find("span").addClass("color_bh02");

    })
    $(".list_left_a02").click(function(){
        $(this).find("span").addClass("current_sp01");
        $(".list_left_a03").find("span").removeClass("current_sp02");
        $(".list_left_a04").find("span").removeClass("current_sp03");
    })
    $(".list_left_a03").click(function(){
        $(this).find("span").addClass("current_sp02");
        $(".list_left_a02").find("span").removeClass("current_sp01");
        $(".list_left_a04").find("span").removeClass("current_sp03");
    })
    $(".list_left_a04").click(function(){
        $(this).find("span").addClass("current_sp03");
        $(".list_left_a02").find("span").removeClass("current_sp01");
        $(".list_left_a03").find("span").removeClass("current_sp02");
    })
    $(".list_rig").click(function(){
        if($(".f_zk").css("display")=="none"){
            $(".f_zk").slideDown();
        }else{
            $(".f_zk").slideUp();
        }

    })
    $(".list_x_rig").click(function(){
        if($(".list_xy_fl").css("display")=="none"){
            $(".list_xy_fl").slideDown();
        }else{
            $(".list_xy_fl").slideUp();
        }

    })
    shopnum();

})
//�Ӽ�
function shopnum(){
    var shopnum=$(".list_text05");
    shopnum.each(function(){
        var box=$(this);
        var inp=box.find(".list_text05_in02");
        var jian=box.find(".jian");
        var jia=box.find(".jia");
        jian.click(function(){
            var num=parseNum(inp.val());
            num=num-1<=0?1:num-1;
            inp.val(num);
        });
        jia.click(function(){
            var num=parseNum(inp.val());
            num=num+1;
            inp.val(num);
        });
        inp.keyup(function(){
            var num=parseNum(inp.val());
            inp.val(num);
        });
        var parseNum=function(num){
            num=parseInt(num);
            return isNaN(num)?1:num;
        }
    });
}