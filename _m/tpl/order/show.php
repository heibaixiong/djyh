<?php
if(!defined('PART'))exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php
    _css('style');
    _jq();
    ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".click").click(function(){
                $(".tip").fadeIn(200);
            });
            $(".tiptop a").click(function(){
                $(".tip").fadeOut(200);
            });
            $(".sure").click(function(){
                $(".tip").fadeOut(100);
            });
            $(".cancel").click(function(){
                $(".tip").fadeOut(100);
            });
        });
    </script>
</head>
<body>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li>首页</li>
        <li>订单管理</li>
        <li>查看订单</li>
    </ul>
</div>
<div class="rightinfo">
    订单编号：<?php echo $_['order']['id']; ?><br/>
    收 货 人：<?php echo $_['order']['nam']; ?><br/>
    手　　机：<?php echo $_['order']['phn']; ?><br/>
    电　　话：<?php echo $_['order']['tel']; ?><br/>
    收货地址：<?php echo $_['order']['pro_n'].$_['order']['cit_n'].$_['order']['cou_n'].$_['order']['adr']?><br/>
    支付方式：<?php echo $_['order']['payment']; ?><br/>
    订单金额：￥<?php echo _rmb($_['order']['total']); ?><br/>
    下单时间：<?php echo _time($_['order']['addtime']); ?><br/>
    订单状态：<?php echo $_['order']['status']; ?><br/>
    <?php if ($_['order']['state'] == '3') { ?>
    发货时间：<?php echo _time($_['order']['ship_time']); ?><br/>
    <?php } ?>
    <br/>
    <table class="tablelist">
        <thead>
        <tr>
            <th width="10%"></th>
            <th width="40%">商品</th>
            <th width="10%">单价</th>
            <th width="10%">数量</th>
            <th width="10%">小计</th>
            <th width="10%">状态</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $total = 0;
        foreach($_['order']['goods'] as $k=>$v){
            $total += $v['mark']/100*$v['num'];
            ?>
            <tr>
                <td><img src="<?php echo _resize($v['img'], 60, 60); ?>"></td>
                <td><?php echo $v['wtitle']?></td>
                <td>￥<?php echo _rmb($v['mark']/100);?></td>
                <td><?php echo $v['num']?></td>
                <td>￥<?php echo _rmb($v['mark']/100*$v['num']);?></td>
                <td>
                    <?php echo $_['order_state'][$v['state']]; ?>
                    <?php if ($v['state'] == '3') echo '['._time($v['ship_time']).']'; ?>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
        <tfoot>
        <tr><td colspan="6" style="text-align: right; padding-right: 10px;">合计：￥<?php echo _rmb($total);?></td></tr>
        </tfoot>
    </table>
</div>
<script type="text/javascript">
    $('.tablelist tbody tr:odd').addClass('odd');
</script>
</body>
</html>