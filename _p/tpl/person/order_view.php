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
<div class="layout_wrap">
    <?php
    _part('personleft');
    ?>
    <div class="prod_return khfwrightCon">
		<div class="cont">
			<div class="zhjf-title">订单详细
			<p style="float: right;"><a href="<?php echo _u('//order/'.$_['page'].'/'); ?>">返回列表</a></p>
			</div>
			<div class="userinfo">

					<table class="table-orderList">
						<thead>
						<tr><th colspan="5" style="background-color: #fff; text-align: left;">
								订单编号：#<?php echo $_['order']['id']; ?><br/>
								订单金额：￥<?php echo _rmb($_['order']['total']); ?><br/>
								收 货 人：<?php echo $_['order']['nam']; ?><br/>
								收货地址：<?php echo $_['order']['pro_n']; ?><?php echo $_['order']['cit_n']; ?><?php echo $_['order']['cou_n']; ?><?php echo $_['order']['adr']; ?><br/>
								手　　机：<?php echo $_['order']['phn']; ?><br/>
								电　　话：<?php echo $_['order']['tel']; ?><br/>
								付款方式：<?php echo $_['order']['payment']; ?><br/>
								下单时间：<?php echo _time($_['order']['addtime']); ?><br/>
								订单状态：<?php echo $_['order']['status']; ?>
								<?php if ($_['order']['state'] == '3') { ?>
									<br/>发货时间：<?php echo _time($_['order']['ship_time']); ?>
								<?php } ?>
							</th></tr>
						<tr>
							<th width="40%">
								<span class="ml-40 fl">商品</span>
							</th>
							<th width="10%">单价(元)</th>
							<th width="10%">数量</th>
							<th width="10%">小计</th>
							<th width="10%">状态</th>
						</tr>
						</thead>

						<tbody>
						<?php
						$total = 0;
						foreach ($_['order']['goods'] as $good){
						$total += $good['mark']/100*$good['num'];
						?>
							<tr>
								<td width="40%">
									<div class="fl" style="width: 100%;">
										<div class="proImg">
											<img src="<?php echo _resize($good['img'], 60, 60); ?>">
										</div>
										<div class="proDetails" style="width: 75%;">
											<a href="<?php echo _u('/shop/show/'.$good['wid'].'/');?>" target="_blank"><?php echo $good['wtitle']?></a>

										</div>
									</div>
								</td>
								<td width="10%">
									<span class="red block GoodsPrice">￥<?php echo _rmb($good['mark']/100);?></span>
								</td>
								<td width="10%">
									<p class="">
										<?php echo $good['num']?>
									</p>
								</td>
								<td width="10%"><b class="red GoodsTotalPrice">￥<?php echo _rmb($good['mark']/100*$good['num']);?></b></td>
								<td width="10%">
									<p class="">
										<?php echo $_['order_state'][$good['state']]; ?>
										<?php if ($good['state'] == '3') echo '<br/>'._time($good['ship_time']); ?>
									</p>
								</td>
							</tr>
						<?php
						}
						?>
						<tr><td colspan="3">&nbsp;</td><td><b class="red GoodsTotalPrice">￥<?php echo _rmb($total);?></b></td><td></td></tr>
						</tbody>
					</table>

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