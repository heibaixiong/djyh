$(function(){
    $('#myCarousel').carousel({
        interval: 5000
    });
    //$(".new_fls li").mouseenter(function(){
    //    $(this).addClass("current_bignav_a").siblings("li").removeClass("current_bignav_a");
    //
    //});
    $(".big_nav_new div").mouseenter(function(){
        $(this).addClass("current_bignav_a").siblings("div").removeClass("current_bignav_a");

    });
    $(".zk").click(function(){
        if($(this).parents(".nav_line05").hasClass("open")){
            $(this).css("background-color","#a1a1a1");
        }else{
            $(this).css("background-color","#3c3c3c");
        }
    });
    $(".h_nav_box a").click(function(){
        $(this).addClass("current_hnava").siblings("a").removeClass("current_hnava");
    });
    $(".pro09").click(function(){
        $(document).scrollTop(0);
    });
    $(".right_box").click(function(){
        if($(".f_zk").css("display")=="none"){
            $(".f_zk").slideDown();
        }else{
            $(".f_zk").slideUp();
        }

    });
    jQuery("#nav").slide({  type:"menu", titCell:".mainCate", targetCell:".subCate", delayTime:0, triggerTime:0, defaultPlay:false, returnDefault:true });

    navpos();

    $(window).scroll(function() { //����ʱ�򴥷�
        var scroH = $(this).scrollTop()+250;//��������������+�������߶�

        $('div[id^=floor_]').each(function(i,e){
            if (scroH >= $(e).offset().top) {
                $(".left_nav >li a").removeClass("cur");
                $(".left_nav >li a").eq(i).addClass('cur');
                $(".lou_01_top .lou_01_title").css("color","#646464");
                $(e).find(".lou_01_title").css("color","#ff0000");
            }
        });
    });
    //��ť����

    $(window).scroll(function(){
        if($(window).scrollTop()>650&&$(window).width()>=1200){
            $(".left_nav").fadeIn(500);

        }
    });
    //��ť����
    $(window).scroll(function(){
        if($(window).scrollTop()<650){
            $(".left_nav").fadeOut(500);
        }
    });

    $(".left_nav li a").click(function() {
        $(".left_nav a").removeClass("cur");
        $(this).addClass('cur');
        var el = $(this).data('floor');
        $('html, body').animate({
            scrollTop: $("#" + el).offset().top
        }, 300);
        //$(this).addClass("cur").parent().siblings().find("a").removeClass("cur");
    });

    $(document).delegate('#top_search_form .search_type', 'click', function(e){
        e.preventDefault();
        $('#top_search_form input[name="cate"]').val($(this).data('cate'));
        $('#top_search_form .search_type[data-cate="'+$(this).data('cate')+'"]').closest('li').css('background-color', '#3c3c3c');
        $('#top_search_form .search_type[data-cate!="'+$(this).data('cate')+'"]').closest('li').css('background-color', '#a1a1a1');
        //$('#top_search_form .search_type').closest('li').css('background-color', '#a1a1a1');
        //$(this).closest('li').css('background-color', '#3c3c3c');
    });
});
$(window).resize(function() {
    if($(window).width()<1200){
        $(".left_nav").fadeOut(500);

    }
    navpos();
});
function navpos() {
    var offset = $("#main").offset().left;
    var nav_w = $(".left_nav").outerWidth();
    var left = offset - nav_w;
    /*   if (left > 10) {
     $(".nav").css("margin-left", "-90px;");
     } else {
     $(".nav").css("margin-left", -(160 + left) + "px");
     }*/
}
function set_cur(n) {
    if ($(".left_nav a").hasClass("cur")) {
        $(".left_nav a").removeClass("cur");
    }
    $(".left_nav a" + n).addClass("cur");
}


