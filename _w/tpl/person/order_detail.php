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
    _css('commons');
    _css('order_detail');
    ?>
</head>
<body>
<!-- 顶部-->
<header class="aui-nav aui-bar aui-bar-nav aui-bar-dark" id="top_nav">
    <a class="aui-pull-left" onclick="history.go(-1)">
        <span class="aui-iconfont aui-icon-left"></span>
    </a>
    <div class="aui-title"><span class="car_icon01">订单详情</span></div>
    <a class="aui-pull-right">
        <!-- <span></span>管理 -->
    </a>
</header>
<div style="position: absolute;top: 50px;bottom: 55px;overflow-y: scroll;-webkit-overflow-scrolling: touch; width:100%; ">
    <!-- 内容-->
    <div class="dev_main">
        <div class="order_top_box aui-border-b">
            <div class="order_top_in">
                <p class="order_top_tex01">【<?php echo $_['order']['detail']['pro_n']; ?>】<?php echo $_['order']['detail']['cit_n'].$_['order']['detail']['cou_n'].$_['order']['detail']['adr']; ?>，<?php echo $_['user_order_status'][$_['order']['detail']['state']]; ?>。</p>
                <p class="order_top_tex02"><a><?php echo date('Y-m-d H:i:s', $_['order']['detail']['addtime']); ?></a></p>
                <p class="order_top_tex02"><a><?php echo $_['order']['detail']['nam'] . '　　'. $_['order']['detail']['phn']; ?></a></p>
            </div>
        </div>

        <!--
        <div class="order_top_box02">
            <div class="order_top_in02">
                <p class="order_top_tex03"><a class="order_top_t01">收货人：百家超市老板</a><a class="order_top_t02">159****2222</a></p>
                <p class="order_top_tex04">收货地址：</p>
                <p class="order_top_tex05">河南省洛阳市西工区xxxxxxxxxxxxxxxxxx</p>
            </div>
        </div>
        -->

        <div>
            <ul class="cosig_main_list">
                <?php
                $com_id = 0;
                $btn = 0;
                foreach($_['order']['goods'] as $k => $v) {
                    if ($v['company_id'] != $com_id){
                        ?>
                        <li class="cosig_lin01">
                            <a class="cosig_lin01_in02" href="javascript:void(0)"><?php echo $v['company']; ?></a>
                            <?php
                            if($btn == 0){
                                echo '<a class="aui-pull-right" href="javascript:void(0)">' . $_['user_order_status'][$_['order']['detail']['state']] . '</a>';
                            }
                            ?>
                        </li>
                <?php
                    }
                ?>
                <li class="cosig_lin02" style="border-bottom:1px solid #fff;">
                    <a class="cosig_lin02_in01" href="<?php echo _u('/shop/show/').$v['wid'].'/'; ?>"><img src="<?php echo _resize($v['img'], 200, 200) ?>"></a>
                    <div class="cosig_lin02_in02">
                        <p class="cosig_pro_title"><a href="<?php echo _u('/shop/show/').$v['wid'].'/'; ?>"><?php echo $v['wtitle']; ?></a></p>
                        <p class="cosig_pro_txt">
                            <a class="cosig_pro_yf"><span>￥<?php echo _rmb($v['mark']/100) ?></span></a>
                            <a class="cosig_pro_sl"><span>x <?php echo $v['num']; ?> </span></a>
                        </p>
                    </div>

                    <?php
                    if($v['content'] != ''){
                        echo '<p style="font-size:0.4rem;">留言：<font color="#ff855b">' . $v['content'] . '</font></p>';
                    }
                    ?>
                </li>
                <?php
                    $com_id = $v['company_id'];
                }
                ?>
                <div class="order_lin02">
                    <a>合计：<em>￥<?php echo _rmb($_['order']['detail']['total']); ?></em></a>
                    <a>共计<em><?php echo $_['order']['detail']['cates']; ?></em>件商品</a>
                </div>
                <li class="order_lin01" style="padding:10px 0;">
                    <p style="line-height:1.2rem;">订单编号：<em><?php echo $_['order']['detail']['id']; ?></em></p>
                    <!-- <p>物流单号：<em>222222222222222</em></p> -->
                    <p style="line-height:1.2rem;">创建时间：<em><?php echo date('Y-m-d H:i:s', $_['order']['detail']['addtime']); ?></em></p>
                    <p style="line-height:1.2rem;">付款时间：<em><?php echo date('Y-m-d H:i:s', $_['order']['detail']['pay_time']); ?></em></p>
                    <!-- <p>发货时间：<em>2016-04-06  12:12:12</em></p> -->
                </li>
            </ul>
            <!--
            <div class="order_wl_list" >
                <p class="order_wl_title"><a >物流信息</a></p>
                <div class="order_big_box" >
                    <ul style="position: relative;">
                        <li class="order_wl_box">
                            <p class="order_wl_time"><a>2016-04-08</a></p>
                            <div class="order_wl_time02">
                                <p class="clearFloat"><a class="wl_time02_in01">14:11:25</a><a class="wl_time02_in02">郑州经开二部收件员 已揽件</a><span></span></p>
                                <p  class="clearFloat"><a  class="wl_time02_in01">19:26:10 </a><a  class="wl_time02_in02">郑州经开已发出郑州经开二部 已发出</a><span></span></p>
                                <p  class="clearFloat"><a  class="wl_time02_in01">20:38:52 </a><a  class="wl_time02_in02">郑州经开二部 已发出</a><span></span></p>
                            </div>
                        </li>
                        <li class="order_wl_box">
                            <p class="order_wl_time"><a>2016-04-08</a></p>
                            <div class="order_wl_time02">
                                <p class="clearFloat"><a class="wl_time02_in01">14:11:25</a><a class="wl_time02_in02">郑州经开二部收件员经开二部收件员 已揽件</a><span></span></p>
                                <p class="clearFloat"><a class="wl_time02_in01">19:26:10 </a><a class="wl_time02_in02">郑州经开二部 已发出</a><span></span></p>

                            </div>
                        </li>
                        <li class="order_wl_box">
                            <p class="order_wl_time"><a>2016-04-08</a></p>
                            <div class="order_wl_time02">
                                <p class="clearFloat"><a class="wl_time02_in01">14:11:25</a><a class="wl_time02_in02">郑州经开二部收件员 已揽件郑州经开二部收件员 已揽件郑州经开二部收件员 已揽件</a><span></span></p>
                                <p class="clearFloat"><a  class="wl_time02_in01">19:26:10 </a><a  class="wl_time02_in02">郑州经开二部 已发出</a><span></span></p>
                                <p class="clearFloat"><a  class="wl_time02_in01">20:38:52 </a><a  class="wl_time02_in02">郑州经郑州经开二部郑州经开二部开二部 已发出</a><span></span></p>

                                <p class="clearFloat current_zp"><a  class="wl_time02_in01">20:38:52 </a><a  class="wl_time02_in02">郑州经郑州经开二部郑州经开二部开二部 已发出</a><span></span></p>
                            </div>
                        </li>
                        <div style="width:1px; height: 100%;position: absolute;border-left: dashed 1px #818182;left:-1.15rem;margin-top:1rem;"></div>
                        <div style="width:1px; height: 1.2rem;position: absolute;border-left: solid 1px #fff;left:-1.15rem;bottom:0;"> </div>
                    </ul>

                </div>

            </div>
            -->
        </div>

        <div class="oreder_bom">
            <?php
            if($_['order']['detail']['state'] == 1){
                echo '<a href="'. _u('/shop/order_view/'). $_['order']['id'].'" class="current_boma">去支付</a>';
            }else if($_['order']['detail']['state'] == 3){
                echo ' <a href="'. _u('/shop/show/'.$_['order']['detail']['id'].'/1/'.$_['order']['goods'][0]['seller_id']) .'/" class="current_boma">确认收货</a>';
            }
            ?>
            <!-- <a href="#">删除订单</a> -->
        </div>
    </div>

</div>
<!--footer-->
<?php
_part('footer');
?>
</body>
</html>
