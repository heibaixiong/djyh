<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $_['title'];?></title>
    <?php
    _css('aui');
    _css('aui-iconfont');
    _css('commons');
    _css('list');
    ?>
    <style>
        .list_sx i{font-size:12px;color:#666;}
    </style>
</head>

<body>
<!-- 头部start -->
<header class="aui-nav aui-bar aui-bar-nav aui-bar-dark" id="top_nav">
    <div class="aui-col-xs-2" style="width:18%;">
        <span class="aui-pull-left" style="padding-left: 5px;">
           <span class="aui-iconfont aui-icon-left"></span>
        </span>
    </div>
    <div class="aui-col-xs-8" style="width:62%">
        <div class="aui-searchbar" id="search">
            <form style="width:100%;">
                <input type="search" placeholder="请输入搜索内容" id="search-input">
                <a href="#" class="aui-iconfont aui-icon-search search_icon" ></a>
            </form>
        </div>
    </div>
    <div class="aui-col-xs-2" style="width:20%;">
        <span class="aui-pull-right" style="padding-right:5px;padding-top:2px;">
            <a class="index_car" style="background:none;font-size:20px;color:#fff;">筛选</a>
        </span>
    </div>
</header>
<!-- 头部end -->

<div style="position: absolute;top: 50px;bottom: 55px;overflow-y: scroll;-webkit-overflow-scrolling: touch; width:100%; ">

    <!--筛选条件-->
    <ul class="aui-content list_sx aui-border-tb" style="margin-bottom:0;">
        <li class="aui-col-xs-3 current_mr"><a data-paixu="0" data-icon="1">默认排序</a></li>
        <li class="aui-col-xs-3 "><a data-paixu="2" data-icon="1"><span class="list_sxicon01"></span>价格<i class="aui-iconfont"></i></a></li>
        <li class="aui-col-xs-3 "><a data-paixu="4" data-icon="1"><span class="list_sxicon02"></span>销量<i class="aui-iconfont"></i></a></li>
        <li class="aui-col-xs-3 " style="border: none"><a data-paixu="6" data-icon="1"><span class="list_sxicon03"></span>新品<i class="aui-iconfont"></i></a></li>
    </ul>

    <!-- 商品列表start -->
    <div class="big_main" id=""wrapper">
        <div class="aui-content list-box" id=""scroller">

            <div id="pullDown">
                <span class="pullDownIcon"></span><span class="pullDownLabel">Pull down to refresh...</span>
            </div>

            <?php
                foreach($_['good_list'] as $k => $v){
            ?>
            <div class="aui-content index_content">
                <div class="aui-col-xs-5" >
                    <a href="#" class="index_pro02">
                        <img src="<?php echo _resize($v['img']); ?>" >
                        <span>推荐<br>商品</span>
                    </a>
                </div>
                <div class="aui-col-xs-7" >
                    <div class="index_bleft">
                        <p class="index_text01"><a href="#"><?php echo $v['title']; ?></a></p>
                        <p class="index_text02"><?php echo $v['class1name']; ?></p>
                        <p class="index_text03">￥<?php echo _rmb($v['mark']/100);?></p>
                        <div class="index_text04">
                            <div class="idnex_gw">加入购物车</div>
                            <div class="index_pl">
                                <span>已售<em><?php echo $v['sale']*5; ?></em>件</span>
                                <span>好评<em><?php echo $v['sale']*4; ?></em>条</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>

            <div id="pullUp">
                <span class="pullUpIcon"></span><span class="pullUpLabel">Pull up to refresh...</span>
            </div>
        </div>
    </div>
    <!-- 商品列表end -->

</div>

<!--弹出层-->
<div class="slide-mask"></div>
<aside class="slide-wrapper" >
    <div class="slide_big">
        <div class="slide_right">
            <div class="aui-content">
                <header class="aui-bar aui-bar-nav aui-bar-dark list_topin">
                    <a class="aui-pull-left">
                        <span class="aui-border aui-border-radius list_rest">取消</span>
                    </a>
                    <div class="aui-title">筛选</div>
                    <a class="aui-pull-right">
                        <span class=" list_rest02" style=" ">确认</span>
                    </a>
                </header>
                <ul class="aui-list-view list_bigbox">
                    <li class="aui-list-view-cell">
                        <div class="aui-arrow-right aui-ellipsis-1 list_pp">
                            品牌
                        </div>
                    </li>
                    <li class="aui-list-view-cell">
                        <div class="aui-arrow-right aui-ellipsis-1 list_pp">
                            产地
                        </div>
                    </li>
                    <li class="aui-list-view-cell">
                        <div class="aui-arrow-right aui-ellipsis-1 list_pp">
                            颜色
                        </div>
                    </li>
                    <li class="aui-list-view-cell">
                        <div class="aui-arrow-right aui-ellipsis-1 list_pp">
                            风格
                        </div>
                    </li>
                </ul>
                <ul class="aui-list-view list_bigbox02" style="display: none;">
                    <div class="aui-list-view-cell list_select">
                        <div class="aui-ellipsis-1">
                            已选择:<span></span>
                        </div>
                    </div>
                    <li class="aui-list-view-cell">
                        <div class="aui-arrow-right aui-ellipsis-1 list_pp02">
                            老杨家
                        </div>
                    </li>
                    <li class="aui-list-view-cell">
                        <div class="aui-arrow-right aui-ellipsis-1 list_pp02">
                            方中山
                        </div>
                    </li>
                    <li class="aui-list-view-cell">
                        <div class="aui-arrow-right aui-ellipsis-1 list_pp02">
                            方西山
                        </div>
                    </li>
                </ul>

            </div>

        </div>

    </div>
</aside>

<div id="pullDown">
    <span class="pullDownIcon"></span><span class="pullDownLabel">Pull down to refresh...</span>
</div>
<div id="pullUp">
    <span class="pullUpIcon"></span><span class="pullUpLabel">Pull up to refresh...</span>
</div>


<?php
_part('footer');
_js('idangerous.swiper.min');
?>
<script>
    //排序部分
    var  arr_new_bg = [" ", "current_mr02","current_mr03","current_mr04"];
    $('.list_sx li').click(function(){
        var $this = $(this),
            index = $this.index();
        $this.parent().find('li').each(function(i,e){
            $(this).find('span').removeClass(arr_new_bg[i]);
        });
        $this.find('span').addClass(arr_new_bg[index]).parents("li").siblings("li").find("span").removeClass(arr_new_bg[index]);  //改变字体颜色
        $this.addClass("current_mr").siblings("li").removeClass("current_mr");    //改变前图标

        /* 添加排序小图标 */
        $this.parent().find("i").removeClass("aui-icon-top").removeClass("aui-icon-down");
        var dom_a = $this.find("a");
        var paixu = parseInt(dom_a.attr("data-paixu")), icon = (parseInt(dom_a.attr("data-icon")) + 1)%2;
        paixu = paixu >= 0 ? paixu : 0;
        if(paixu > 0){
            var icf = '';
            if(icon == 0){
                icf = 'aui-icon-down';
            }else{
                icf = 'aui-icon-top';
            }
            dom_a.find("i").addClass(icf);
            dom_a.attr('data-icon', icon);
            px = paixu%2 == 0 ? paixu - 1 : paixu + 1;
            dom_a.attr('data-paixu', px);
        }
        var cid = '<?php echo _v(3); ?>';
        //请求数据
        get_goods_list(1, cid, 1, paixu)
    });

    function pullUpAction () {
        setTimeout(function () {	// <-- Simulate network congestion, remove setTimeout from production!
            var el, li, i;
            el = document.getElementById('thelist');

            for (i=0; i<3; i++) {
                li = document.createElement('li');
                li.innerText = 'Generated row ' + (++generatedCount);
                el.appendChild(li, el.childNodes[0]);
            }

            myScroll.refresh();		// Remember to refresh when contents are loaded (ie: on ajax completion)
        }, 1000);	// <-- Simulate network congestion, remove setTimeout from production!
    }




    /*AJAX获取数据
     * type=0默认下拉刷新;1重新加载
     * cid分类
     * page页数
     * paixu排序方式
     */
    function get_goods_list(type, cid, page, paixu){
        loading(1); //打开加载效果
        var url = '<?php echo $_['ajax_url']; ?>';
        url += '/' + cid + '/' + page + '/' + paixu;
        $.ajax({
            url : url,
            data : '',
            type : 'post',
            success : function(data){
                console.log(data);
                //return false;
                if(data == false){
                    tips('没有更多数据');
                    return false;
                }
                var str = '';
                for(var i = 0; i < data.length; i++){
                    str += '<div class="aui-content index_content">';
                    str += '<div class="aui-col-xs-5" >';
                    str += '<a href="#" class="index_pro02">';
                    str += '<img src="' + data[i]['img'] + '" >';
                    str += '<span>推荐<br>商品</span>';
                    str += '</a>';
                    str += '</div>';
                    str += '<div class="aui-col-xs-7" >';
                    str += '<div class="index_bleft">';
                    str += '<p class="index_text01"><a href="#">' + data[i]['title'] + '</a></p>';
                    str += '<p class="index_text02">' + data[i]['class1name'] + '</p>';
                    str += '<p class="index_text03">￥' + (data[i]['mark']/100) + '</p>';
                    str += '<div class="index_text04">';
                    str += '<div class="idnex_gw">加入购物车</div>';
                    str += '<div class="index_pl">';
                    str += '<span>已售<em>' + (parseInt(data[i]['sale'])*5) + '</em>件</span>';
                    str += '<span>好评<em>' + (parseInt(data[i]['sale'])*4) + '</em>条</span>';
                    str += '</div>';
                    str += '</div>';
                    str += '</div>';
                    str += '</div>';
                    str += '</div>';
                    //console.log(str);
                }
                if(type == 0){
                    $(".big_main .list-box").append(str);
                }else{
                    $(".big_main .list-box").html(str);
                }
            }
        });
        loading(0); //关闭加载效果
    }

    $('.index_car').on('click', function(e){
        var wh = $('div.wrapperhove'+'rtree').height();
        $('div.slide-mask').css('height', wh).show();
        $('aside.slide-wrapper').css('height', wh).addClass('moved');
        $('div.slide-mask').css({'right':'0'});
        $('.slide-wrapper ').css({'right':'0'});

    });

    $('div.slide-mask').on('click', function(){
        $('div.slide-mask').hide();
        $('aside.slide-wrapper').removeClass('moved');
//         $(".slide-wrapper").hide();
    });
    $(".list_bigbox li").click(function(){
        $(this).css("background","#f0f0f0").siblings("li").css("background","#fff");
        $(".list_bigbox").hide();
        $(".list_bigbox02").show();
    })
    $(".list_bigbox02 li").click(function(){
        $(this).css("background","#f0f0f0").siblings("li").css("background","#fff");
        $(this).find("div").addClass("list_pp03").parents("li").siblings("li").find("div").removeClass("list_pp03");
        var cc=$(this).find("div").text();
        $(".list_select span").text(cc);
    })
    $(".list_rest02").click(function(){
        $('div.slide-mask').hide();
        $('aside.slide-wrapper').removeClass('moved');
    })

    var holdPosition = 0;
    var mySwiper = new Swiper('.swiper-container',{
        slidesPerView:'auto',
        mode:'vertical',
        watchActiveIndex: true,
        onTouchStart: function() {
            holdPosition = 0;
        },
        onResistanceBefore: function(s, pos){
            holdPosition = pos;
        },
        onTouchEnd: function(){
            if (holdPosition>100) {
                mySwiper.setWrapperTranslate(0,100,0)
                mySwiper.params.onlyExternal=true
                $('.preloader').addClass('visible');
                console.log(123);
            }
        }
    })
</script>
</body>
</html>