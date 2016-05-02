<?php
if(!defined('PART'))exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_['title'];?></title>
<?php
_css('default');
_css('v1.0');
_css('style');
_jq();
?>
</head>
<body>
<?php
_part('top');
_part('head');
_part('nav');
?>
<!-- 主体 -->
<div class="main-Body">
    <div class="main-content">
        <div class="main-body-w">
            <h4 class="hBorder">我的进货单</span>
                <div class="progress-jhd2"></div>
            </h4>
            <form action="<?php echo _u('//submit/'); ?>" method="post" id="checkout-form">
            <table class="table-orderList">
                <tbody>
                <tr style="height:35px;">
                    <td width="30%" style="background-color: #eee;">
                        <span class="fl">商品</span>
                    </td>
                    <td style="background-color: #eee;" width="10%">单价(元)</td>
                    <td style="background-color: #eee;" width="10%">数量</td>
                    <td style="background-color: #eee;" width="10%">小计</td>
                </tr>
                    <?php
                    $cid = -1;
                    foreach ($_['arr'] as $k=>$v) {
                        if ($v['company_id'] <> $cid) {
                            $cid = $v['company_id'];
                            ?>
                            <tr style="height:40px;">
                                <td colspan="4" style="text-align:left;border: 0px;vertical-align: bottom;padding-bottom: 5px;">
                                        <span style="color:#d31a26;font-weight:bold;">
                                            [<?php echo $v['company']; ?>]
                                        </span>
                                </td>
                            </tr>

                    <?php
                        }
                    ?>
                    	<tr>
                            <td width="30%">
                                <div class="fl">
                                    <div class="proImg">
                                        <img src="<?php echo _resize($v['img'], 60, 60); ?>">
                                    </div>
                                    <div class="proDetails">
                                        <a id="GoodsName865912" href="<?php echo _u('/shop/show/'.$v['wid'].'/');?>" style="float: left;" target="_blank"><?php echo $v['wtitle']?></a>
                                        <?php
                                        if (!empty($options = unserialize($v['model']))) {
                                            echo '<label style="float: left;clear: both; margin-top: 5px;">';
                                            foreach ($options as $option) {
                                                echo $option['name'].'：'.$option['value'].'&nbsp;&nbsp;';
                                            }
                                            echo '</label>';
                                        }
                                        ?>
                                        <p style="clear: both;float:left;width:100%;margin-top: 5px;">给卖家留言：
                                            <?php echo $v['content']; ?>
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td width="10%">
                                <span price="42.50" id="865912" class="red block GoodsPrice">￥<?php echo _rmb($v['mark']/100);?></span>
                            </td>
                            <td width="10%">
                                <p class="">
                                    <?php echo $v['num']?>
                                </p>
                            </td>
                            <td width="10%"><b class="red GoodsTotalPrice">￥<?php echo _rmb($v['mark']/100*$v['num']);?></b></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <br/>
            <p class="fl">
                支付方式：
                <input type="radio" name="payment_method" value="cod" id="payment_cod" checked="checked" /> <label for="payment_cod">货到付款</label> &nbsp;&nbsp;
                <input type="radio" name="payment_method" value="alipay" id="payment_alipay" /> <label for="payment_alipay">支付宝</label> &nbsp;&nbsp;
                <input type="radio" name="payment_method" value="<?php echo _isweixin()?'weixin':'wxcode'; ?>" id="payment_weixin" /> <label for="payment_weixin">微信</label> &nbsp;&nbsp;
            </p>
            </form>
            <br/><br/>
            <p class="fl">
                <?php
                echo '收货地址：'.$_['address']['pro_n'].$_['address']['cit_n'].$_['address']['cou_n'].$_['address']['adr'].', '.$_['address']['nam'];
                if (!empty($_['address']['phn'])) echo ', '.$_['address']['phn'];
                if (!empty($_['address']['tel'])) echo ', '.$_['address']['tel'];
                ?>
                <a href="<?php echo _u('/person/address/');?>">[<b class="red font18"><span class="red">修改</span></b>]</a>
            </p><br/>
            <div id="orderTotalInfo" class="gross-price-js">
                <div class="fl gross-left">

                </div>
                <div class="fr gross-right">
                    <div class="fl">
                        <p class="fl">已选了商品总计:<b class="red font18"> <span class="red"><?php echo $_['num'];?></span></b></p>
                        <p class="fl">总金额：<b class="red font18"><strong>￥<?php echo _rmb($_['mark']/100);?></strong></b></p>
                    </div>
                    <p class="fl"><a class="return-btn" href="<?php echo _u('/cart/submit/');?>" id="btn-cart-submit">确认订单</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).delegate('#btn-cart-submit', 'click', function(e) {
        e.preventDefault();
        if ($('input[name="payment_method"]:checked').length <= 0) {
            alert('请选择支付方式！');
        } else {
            $('#checkout-form').submit();
        }
    });
</script>
<!-- //主体 -->
<?php
_part('footer1');
_part('footer2');
_part('footer3');
?>
</body>
</html>