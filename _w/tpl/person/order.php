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
			<div class="zhjf-title">
				订单列表
				<div style="float: right; margin-top: 10px; font-weight: normal;">
					<span style="margin-left: 5px;<?php if (empty(_v(4))) echo 'font-weight: bold;'; ?>"><a href="<?php echo _u('///'); ?>">全部(<?php echo $_['total_all']; ?>)</a></span>
					<span style="margin-left: 5px;<?php if (_v(4)=='1') echo 'font-weight: bold;'; ?>"><a href="<?php echo _u('///1/1/'); ?>">待付款(<?php echo $_['total_1']; ?>)</a></span>
					<span style="margin-left: 5px;<?php if (_v(4)=='2') echo 'font-weight: bold;'; ?>"><a href="<?php echo _u('///1/2/'); ?>">已付款(<?php echo $_['total_2']; ?>)</a></span>
					<span style="margin-left: 5px;<?php if (_v(4)=='3') echo 'font-weight: bold;'; ?>"><a href="<?php echo _u('///1/3/'); ?>">已发货(<?php echo $_['total_3']; ?>)</a></span>
					<span style="margin-left: 5px;<?php if (_v(4)=='4') echo 'font-weight: bold;'; ?>"><a href="<?php echo _u('///1/4/'); ?>">已完成(<?php echo $_['total_4']; ?>)</a></span>
					<span style="margin-left: 5px;<?php if (_v(4)=='12') echo 'font-weight: bold;'; ?>"><a href="<?php echo _u('///1/12/'); ?>">已关闭(<?php echo $_['total_12']; ?>)</a></span>
				</div>
			</div>
			<div class="userinfo">
				<?php
				$i = 0;
				foreach (Page::$arr as $k=>$v) {
				$i++;
				?>
					<table class="table-orderList">
						<thead>
						<tr>
							<th colspan="4" style="background-color: #ccc; text-align: left;">
								<span style="float: left;">
								<input type="checkbox" name="checkbox_order" value="<?php echo $v['id']; ?>" />
								#<?php echo $v['id']; ?>, ￥<?php echo _rmb($v['total']); ?>, <?php echo _time($v['addtime']); ?>
								</span>

								<?php if (1<>1 && count($v['goods']) > 1) { ?>
									<span style="float: left;">
									<a href="javascript:void(0);" class="a-open-btn" data-state="<?php echo 1==1||$i<=3?'true':'false'; ?>" >[<?php echo 1==1||$i<=3?'收起':'展开'; ?>]</a>
									</span>
								<?php } ?>

								<?php if ($v['state'] == '1') { ?>
								<span style="float: left;">
									<a href="<?php echo _u('/person/order_close/'.$v['id'].'/'.Page::$p); ?>" class="a-close-btn">[关闭]</a>
								</span>
									<form action="<?php echo _u('/person/order_pay/'.$v['id'].'/'.Page::$p); ?>" method="post" target="_blank">
									<p class="fl pay-form-btn" style="float: right; width: 145px;">
										<select name="payment_method" style="height: 35px; float: left;">
											<?php
											if (_isweixin() && $v['payment_code'] == 'wxpay_qrcode') {
												$v['payment_code'] = 'wxpay';
											}
											if (!_isweixin() && $v['payment_code'] == 'wxpay') {
												$v['payment_code'] = 'wxpay_qrcode';
											}
											foreach ($_['payment_method'] as $k => $method) {
												if (_isweixin() && $k == 'wxcode') continue;
												if (!_isweixin() && $k == 'weixin') continue;

												echo '<option value="' . $k . '"' . ($v['payment_code'] == $method['code'] ? ' selected="selected"' : '') . '>' . $method['title'] . '</option>';
											}
											?>
										</select>
										<a class="return-btn" href="javascript:void(0);" onclick="$(this).closest('form').submit();" id="btn-cart-pay" style="float: left; margin-left: 5px;">支 付</a>
									</p>
									</form>
								<?php } ?>
							</th>
						</tr>

						</thead>

						<tbody>
						<?php
						$ii = 0;
						$cid = -1;
						foreach ($v['goods'] as $good){
							if ($good['company_id'] <> $cid) {
								$cid = $good['company_id'];
								echo '<tr'.(1<>1&&$i>3&&$ii>0?' style="height:35px;display:none;"':' style="height:35px;"').'>' .
									'<td colspan="4" style="text-align:left;padding-left:10px;">' .
									'<span style="color:#d31a26;font-weight:bold;">['.$good['company'].']</span>' .
									'<span style="margin-left:5px;" class="order-status-'.$good['state'].'">' . $_['user_order_status'][$good['state']] . '</span>' .
									'<span style="padding-left:5px;"><a href="'._u('//order_view/'.$v['id'].'/'.Page::$p.'/'.$good['seller_id'].'/').'">[详细]</a></span>'
								;

								if ($good['state'] == '3') {
									echo '<span style="float:right; padding-right:10px;"><a href="'._u('//order_receipt/'.$v['id'].'/'.Page::$p.'/'.$good['seller_id'].'/').'" style="color:#d31a26;font-weight:bold;" class="a-receipt-btn">[确认收货]</a></span>';
								}

								echo '</td></tr>';
						?>
								<tr<?php if(1<>1&&$i>3&&$ii>0) echo ' style="display:none;"'; ?>>
									<td width="40%" style="background-color: #f1f1f1;">
										<span class="ml-40 fl">商品</span>
									</td>
									<td style="background-color: #f1f1f1;" width="10%">单价(元)</td>
									<td style="background-color: #f1f1f1;" width="10%">数量</td>
									<td style="background-color: #f1f1f1;" width="10%">小计</td>
								</tr>
						<?php
							}
							$ii++;
						?>
							<tr<?php if(1<>1&&$i>3&&$ii>1) echo ' style="display:none;"'; ?>>
								<td width="40%">
									<div class="fl" style="width: 100%;">
										<div class="proImg">
											<img src="<?php echo _resize($good['img'], 60, 60); ?>">
										</div>
										<div class="proDetails" style="width: 75%;">
											<a href="<?php echo _u('/shop/show/'.$good['wid'].'/');?>" style="float: left;" target="_blank"><?php echo $good['wtitle']?></a>
											<?php
											if (!empty($options = unserialize($good['model']))) {
												echo '<label style="float: left;clear: both; margin-top: 5px;">';
												foreach ($options as $option) {
													echo $option['name'].'：'.$option['value'].'&nbsp;&nbsp;';
												}
												echo '</label>';
											}
											?>
											<p style="clear: both;float:left;width:100%;margin-top: 5px;">给卖家留言：
												<?php echo $good['content']; ?>
											</p>
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
							</tr>
						<?php
						}
						?>
						</tbody>
					</table>
				<?php
				}
				?>

				<div style="float: right" class="pageWrap">
					<div class='turn_page clearfix'>
						<div class="fr"><a disabled="disabled" href="<?php echo _u('///1/'._v(4).'/');?>">首页</a><a disabled="disabled" href="<?php echo _u('///'.Page::$pre.'/'._v(4).'/');?>">上一页</a><a class="page_cur"><?php echo Page::$p.'/'.Page::$pnum;?></a><a href="<?php echo _u('///'.Page::$next.'/'._v(4).'/');?>">下一页</a><a href="<?php echo _u('///'.Page::$pnum.'/'._v(4).'/');?>">尾页</a></div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('.a-open-btn').click(function(){
		if ($(this).data('state') === false) {
			$(this).html('[收起]');
			$(this).data('state', true);
			$(this).closest('table').find('tbody tr').show();
		} else {
			$(this).html('[展开]');
			$(this).data('state', false);
			$(this).closest('table').find('tbody tr').each(function(e, b){
				if (e > 2) $(b).hide();
			});
		}
	});

	$(document).delegate('a.a-close-btn', 'click', function(e){
		e.preventDefault();

		if (confirm('确认关闭订单吗？')) {
			window.location.href = $(this).attr('href');
		}

		return false;
	});

	$(document).delegate('a.a-receipt-btn', 'click', function(e){
		e.preventDefault();

		if (confirm('确认收货吗？谨慎操作以免货财两空哦！')) {
			window.location.href = $(this).attr('href');
		}

		return false;
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