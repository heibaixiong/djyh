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
            <table class="table-orderList">
                <thead>
                    <tr>
                    <th width="30%">
                        <span class="ml-40 fl">商品</span>
                    </th>
                    <th width="10%">单价(元)</th>
                    <th width="15%">数量</th>
                    <th width="10%">小计</th>
                    </tr>
                </thead>
            </table>
            <table class="table-orderList">
                    <tbody>
                    	<?php
	                    foreach($_['arr'] as $k=>$v){
	                    ?>
                    	<tr>
                        <td width="30%">
                            <div class="fl">
                                <div class="proImg">
                                    <img src="<?php echo $v['img']?>">
                                </div>
                                <div class="proDetails">
                                    <a id="GoodsName865912" href="<?php echo _u('/shop/show/'.$v['wid'].'/');?>" target="_blank"><?php echo $v['wtitle']?></a>
                                    
                                </div>
                            </div>
                        </td>
                        <td width="10%">                            
                            <span price="42.50" id="865912" class="red block GoodsPrice">￥<?php echo _rmb($v['mark']/100);?></span>                            
                        </td>
                        <td width="15%">
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
            <p class="fl">支付方式：货到付款</p><br/><br/>
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
                    <p class="fl"><a class="return-btn" href="<?php echo _u('/cart/submit/');?>">确认订单</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //主体 -->
<?php
_part('footer1');
_part('footer2');
_part('footer3');
?>
</body>
</html>