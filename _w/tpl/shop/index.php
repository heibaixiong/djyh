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
    <div class="aui-col-xs-2" style="width:15%;" onclick="history.go(-1)">
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
    <div class="aui-col-xs-2" style="width:23%;">
        <span class="aui-pull-right" style="padding-right:5px;padding-top:2px;">
            <a class="index_car">筛选</a>
        </span>
    </div>
</header>
<!-- 头部end -->

<div style="margin:50px auto 55px;overflow-y: scroll;-webkit-overflow-scrolling: touch; width:100%; ">

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

            <?php
                foreach($_['good_list'] as $k => $v){
            ?>
            <div class="aui-content index_content">
                <div class="aui-col-xs-5" >
                    <a href="<?php echo _u('/shop/show/'.$v['id']); ?>" class="index_pro02">
                        <img src="<?php echo _resize($v['img'], 210, 210); ?>" />
                        <?php if ($v['recommend'] == 1) { ?>
                            <span>推荐<br>商品</span>
                        <?php } elseif ($v['hot'] == 1) { ?>
                            <span>热门<br>商品</span>
                        <?php } ?>
                    </a>
                </div>
                <div class="aui-col-xs-7" >
                    <div class="index_bleft">
                        <p class="index_text01"><a href="#"><?php echo $v['title']; ?></a></p>
                        <p class="index_text02"><?php echo _left(strip_tags($v['content']), 0, 48, '...'); ?></p>
                        <p class="index_text03">￥<?php echo _rmb($v['mark']/100);?></p>
                        <div class="index_text04">
                            <div class="idnex_gw" data-id="<?php echo $v['id']; ?>">加入购物车</div>
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
                    <a class="aui-pull-left reset-back">
                        <span class="aui-border aui-border-radius list_rest">返回</span>
                    </a>
                    <div class="aui-title">筛选</div>
                    <a class="aui-pull-right reset-confirm">
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

<?php
_part('footer');
_js('iscroll');
?>
<script>
var cid = '<?php echo _v(3); ?>';
    page = 1,
    paixu = 0,
    keyword = '<?php echo urldecode(_v(6)) ?>';

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
        paixu = parseInt(dom_a.attr("data-paixu")), icon = (parseInt(dom_a.attr("data-icon")) + 1)%2;
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

        //get good data
        get_goods_list(1, cid, 1, paixu, keyword)
    });

    //pull down auto ajax
    $(document).scroll(function() {
        if(page > 0){
            if ($(document).scrollTop() + $(window).height() == $(document).height()) {
                page++;
                get_goods_list(0, cid, page, paixu, keyword)
            }
        }
    });

    /*AJAX获取数据
     * type=0默认下拉刷新;1重新加载
     * cid分类
     * page页数
     * paixu排序方式
     */
    function get_goods_list(type, cid, pages, paixu, keyword){
        loading(1); //打开加载效果
        var url = '<?php echo $_['ajax_url']; ?>';
        url += '?/' + cid + '/' + pages + '/' + paixu + '/' + keyword;
        $.ajax({
            url : url,
            data : '',
            type : 'post',
            success : function(data){
                //console.log(data);
                //return false;
                if(data == false){
                    tips('没有更多数据');
                    page = 0;
                    return false;
                }
                var str = '';
                for(var i = 0; i < data.length; i++){
                    str += '<div class="aui-content index_content">';
                    str += '<div class="aui-col-xs-5" >';
                    str += '<a href="'+data[i]['url_show']+'" class="index_pro02">';
                    str += '<img src="' + data[i]['thumb_img'] + '" >';

                    if (data[i]['recommend'] == 1) {
                        str += '<span>推荐<br>商品</span>';
                    } else if (data[i]['hot'] == 1) {
                        str += '<span>推荐<br>商品</span>';
                    }

                    str += '</a>';
                    str += '</div>';
                    str += '<div class="aui-col-xs-7" >';
                    str += '<div class="index_bleft">';
                    str += '<p class="index_text01"><a href="'+data[i]['url_show']+'">' + data[i]['title'] + '</a></p>';
                    str += '<p class="index_text02">' + data[i]['short_desc'] + '</p>';
                    str += '<p class="index_text03">￥' + (data[i]['mark_price']) + '</p>';
                    str += '<div class="index_text04">';
                    str += '<div class="idnex_gw" data-id="'+data[i]['id']+'">加入购物车</div>';
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

    //购物车点击操作
    $(".idnex_gw").click(function(){
        var tag = is_login();
        if(tag === true){
            var id = parseInt($(this).attr('data-id'));
            var num = 1;
            addCart(id, num);
        }
    });


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
</script>
</body>
</html>