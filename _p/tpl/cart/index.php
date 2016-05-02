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
                <div class="progress-jhd1"></div>
            </h4>
            <table class="table-orderList">
                <form action="<?php echo _u('//checkout/'); ?>" method="post" id="cart-form">
                    <tbody>
                    <tr style="height:35px;">
                        <td width="1%" style="background-color: #eee;"><input type="checkbox" name="checkbox_all" title="全选" /></td>
                        <td width="30%" style="background-color: #eee;">
                            <span class="fl">商品</span>
                        </td>
                        <td style="background-color: #eee;" width="10%">单价(元)</td>
                        <td style="background-color: #eee;" width="10%">数量</td>
                        <td style="background-color: #eee;" width="10%">小计</td>
                        <td style="background-color: #eee;" width="5%">操作</td>
                    </tr>
                    	<?php
                        $cid = -1;
	                    foreach ($_['arr'] as $k=>$v) {
                            if ($v['company_id'] <> $cid) {
                                $cid = $v['company_id'];
	                    ?>
                                <tr style="height:40px;">
                                    <td colspan="6" style="text-align:left;padding-left:5px;border: 0px;vertical-align: bottom;padding-bottom: 5px;">
                                        <span style="color:#d31a26;font-weight:bold;">
                                            <input type="checkbox" name="cart_checkbox_<?php echo $v['company_id']; ?>" data-cid="<?php echo $v['company_id']; ?>" />
                                            [<?php echo $v['company']; ?>]
                                        </span>
                                    </td>
                                </tr>

                        <?php
                            }
                        ?>
                    	<tr>
                            <td width="1%">
                                <input type="checkbox" name="cart_goods[]" data-toggle="<?php echo $v['company_id']; ?>" value="<?php echo $v['id']; ?>" />
                            </td>
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
                                        <input type="text" name="comment[<?php echo $v['id']; ?>]" value="<?php echo $v['content']; ?>" style="width: 80%;" />
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
                            <td width="5%"><a class="red" cartid="" href="<?php echo _u('/cart/del/'.$v['id'].'/');?>">删除</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </form>
            </table>
            <div id="orderTotalInfo" class="gross-price-js">
                <div class="fl gross-left">
                    <input type="button" onclick="location = '<?php echo _u('/index/index/');?>'" value="&lt;&lt;继续购物" class="btn-gray3">
                </div>
                <div class="fr gross-right">
                    <div class="fl">
                        <p class="fl">已选了商品总计:<b class="red font18"> <span class="red"><?php echo $_['num'];?></span></b></p>
                        <p class="fl">总金额：<b class="red font18"><strong>￥<?php echo _rmb($_['mark']/100);?></strong></b></p>
                    </div>
                    <p class="fl"><a class="return-btn" href="<?php echo _u('/cart/checkout/');?>" id="btn-cart-checkout">结算</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('input[name^="cart_checkbox_"]').click(function(){
        var _cid = $(this).data('cid');
        $('input[data-toggle="'+_cid+'"]').prop('checked', $(this).prop('checked'));
        $('input[name="checkbox_all"]').prop('checked', $('input[name="cart_goods[]"]:checked').length?$('input[name="cart_goods[]"]:checked').eq(0).prop('checked'):false);
    });
    $('input[name="cart_goods[]"]').click(function(){
        var _cid = $(this).data('toggle');
        $('input[name=cart_checkbox_'+_cid+']').prop('checked', $('input[data-toggle="'+_cid+'"]:checked').length?$('input[data-toggle="'+_cid+'"]:checked').eq(0).prop('checked'):false);
        $('input[name="checkbox_all"]').prop('checked', $('input[name="cart_goods[]"]:checked').length?$('input[name="cart_goods[]"]:checked').eq(0).prop('checked'):false);
    });
    $('input[name="checkbox_all"]').click(function(){
        $('input[name^="cart_checkbox_"]').prop('checked', $(this).prop('checked'));
        $('input[name="cart_goods[]"]').prop('checked', $(this).prop('checked'));
    });

    $(document).delegate('#btn-cart-checkout', 'click', function(e) {
        e.preventDefault();
        if ($('input[name="cart_goods[]"]:checked').length <= 0) {
            alert('请选择要结算的商品！');
        } else {
            $('#cart-form').submit();
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