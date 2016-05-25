<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
    <title><?php echo $_['title'];?></title>
    <?php
    _css('aui');
    _css('commons');
    _css('my_car');
    ?>
</head>
<body>
<!-- 头部start -->
<header class="aui-nav aui-bar aui-bar-nav aui-bar-dark" id="top_nav">
    <div class="aui-col-xs-2" onclick="history.go(-1)">
        <span class="aui-pull-left" style="padding-left: 5px;">
           <span class="aui-iconfont aui-icon-left"></span>
        </span>
    </div>
    <div class="aui-col-xs-8" style="text-align: center;width:62%;">
        <a class="car_icon01" style="">购物车</a>
    </div>
    <div class="aui-col-xs-2" style="width:20%;">
        <span class="aui-pull-right" style="padding-right:5px;padding-top:2px;">
             <a href="#" class="index_car">编辑</a>
        </span>
    </div>
</header>
<div>
<!-- 头部end -->
<form>
<div style="position: absolute;top: 50px;bottom: 55px;overflow-y: scroll;-webkit-overflow-scrolling: touch; width:100%; ">
    <!--main-->
    <div class="big_main">
        <div class="aui-content">
            <!-- 购物车商品列表start -->
            <?php
            if(count($_['arr']) > 0){
            $wid = 0;
            foreach ($_['arr'] as $k => $v) {
                ?>
                <div class="aui-content order_content">
                    <?php
                    if($v['company_id'] != $wid){
                    ?>
                    <div class="detail_home_lin01"><a href="#"><?php echo $v['company']; ?></a></div>
                    <?php } ?>
                    <div class="index_content">
                        <div class="aui-col-xs-4">
                            <a href="#" class="index_pro02">
                                <img src="<?php echo _resize($v['img'], 210, 210); ?>">
                                <input type="checkbox" value="<?php echo $v['id']; ?>" name="cids[]"
                                       style="display: none;"/>
                            </a>
                        </div>
                        <div class="aui-col-xs-8">
                            <div class="index_bleft">
                                <p class="index_text01"><a
                                        href="<?php echo _u('/shop/show/' . $v['wid'] . '/'); ?>"><?php echo $v['wtitle']; ?></a>
                                </p>
                                <p class="index_text02">
                                    <?php
                                    $model = unserialize($v['model']);
                                    if ($model && count($model > 0)) {
                                        foreach ($model as $m) {
                                            echo $m['value'] . ' ';
                                        }
                                    }
                                    ?>
                                </p>

                                <div class="index_text03">
                                    <a class="mark">￥<?php echo _rmb($v['mark'] / 100); ?></a>

                                    <div class="detail_sl" data-cid="<?php echo $v['id']; ?>">
                                        <span class="detail_jian"></span>
                                        <input class="car_inp num" type="text" value="<?php echo $v['num']; ?>">
                                        <span class="detail_jia"></span>
                                    </div>
                                </div>
                            </div>
                            <span class="aui-iconfont aui-icon-delete good-delete" data-id="<?php echo $v['id']; ?>" style="position: absolute;right:-10px;top:0;color:#f00;"></span>
                        </div>
                    </div>
                    <!--
                    <ul class="order_linbox">
                        <li class="order_lin01">
                            <a>应付：<em>￥<?php echo $v['mark'] * $v['num'] / 100; ?></em></a>
                            <a>已选<em><?php echo $v['num']; ?></em>件商品</a>
                        </li>
                    </ul>
                    -->
                </div>
            <?php
                $wid = $v['company_id'];
                }
            ?>
            <!-- 购物车商品列表end -->
        </div>
        <div class="car_bom">
            <a class="car_bom_qx">全选</a>

            <div class="car_bom_rig">
                <a>合计：<em class="gmark">￥<?php echo $_['mark'] / 100; ?></em></a>
                <a href="javascript:jiesuan()">结算(<em class="gnum"><?php echo $_['num']; ?></em>件)</a>
            </div>
        </div>
        <?php
        }else{
        ?>
        <p style="text-align:center;">购物车是空的</p>
        <?php
        }
        ?>
    </div>
</div>
</form>
<?php
_part('footer');
?>
<script>
    // 单独店铺全选 取消全选
    $(".detail_home_lin01 ").click(function(){
        if($(this).find("a").hasClass("select_true") == true){

            $(this).find("a").removeClass("select_true");
            $(this).siblings(".index_content").find(".index_pro02").removeClass("select_true");
        }else{
            $(this).find("a").addClass("select_true");
            $(this).siblings(".index_content").find(".index_pro02").addClass("select_true");
        }

    })
    // 单个商品的选择
    $(".index_pro02").click(function(){
        if($(this).hasClass("select_true") == true){
            $(this).removeClass("select_true");
            $(this).find("input").attr("checked", false);
        }else{
            $(this).addClass("select_true");
            $(this).find("input").attr("checked", true);
        }
    })
    // 全选 取消全选
    $(".car_bom_qx").click(function(){
        if($(this).hasClass("select_true") == true){
            $(this).removeClass("select_true");
            $(".detail_home_lin01 a").removeClass("select_true");
            $(".index_pro02").removeClass("select_true");
            $("input[type='checkbox']").attr('checked', false);
        }else{
            $(this).addClass("select_true");
            $(".detail_home_lin01 a").addClass("select_true");
            $(".index_pro02").addClass("select_true");
            $("input[type='checkbox']").attr('checked', true);
        }
    });
    //cart goods to order
    function jiesuan(){
        var cids = new Array();
        var i = 0;
        $("input[type='checkbox']:checked").each(function(){
            cids[i] = $(this).val();
            i++;
        });
        console.log(cids);
        if(cids.length == 0){
            alert('请选择要结算的商品');
            return false;
        }
        var url = "<?php echo _u('/cart/checkout/'); ?>"+cids.join(",");
        //console.log(url);
        location.href = url;
    }

    //加减
    (function shopnum(){
        var shopnum=$(".detail_sl");
        shopnum.each(function(){
            var box=$(this);
            var cid = box.attr("data-cid");
            var inp=box.find(".car_inp");
            var jian=box.find(".detail_jian");
            var jia=box.find(".detail_jia");
            jian.click(function(){
                var num=parseNum(inp.val());
                num=num-1<=0?1:num-1;
                inp.val(num);
                edit({cid:cid, type:2}, function(data){
                    console.log(data);
                });
            });
            jia.click(function(){
                var num=parseNum(inp.val());
                num=num+1;
                inp.val(num);
                edit({cid:cid, type:1}, function(data){
                    console.log(data);
                });
            });
            inp.keyup(function(){
                var num=parseNum(inp.val());
                inp.val(num);
            });
            var parseNum=function(num){
                num=parseInt(num);
                return isNaN(num)?1:num;
            };


        })
    }());

    //edit cart num
    var edit = function(opts, callback){
        var url = "<?php echo _u('/cart/edit/'); ?>";
        $.post(url, {cid:opts.cid, type:opts.type}, function(data){
            callback(data);
        });
    }

    //delete goods
    $(".good-delete").click(function(){
        var id = $(this).attr('data-id');
        $.post("<?php echo _u('/cart/del'); ?>", {id : id}, function(data){
            if(data == '0'){
                location.reload();
            }
        });
    });
</script>
</body>
</html>
