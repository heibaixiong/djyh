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
					<span style="margin-left: 5px;<?php if (_v(4)=='2') echo 'font-weight: bold;'; ?>"><a href="<?php echo _u('///1/2/'); ?>">待发货(<?php echo $_['total_2']; ?>)</a></span>
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
							<th colspan="4" style="background-color: #fff; text-align: left;">
								<span style="float: left;">
									#<?php echo $v['id']; ?>, ￥<?php echo _rmb($v['total']); ?>, <?php echo _time($v['addtime']); ?>
									<span class="order-status-<?php echo $v['goods'][0]['state']; ?>">[<?php echo $_['order_state'][$v['goods'][0]['state']]; ?>]</span>
									<a href="<?php echo _u('//order_view/'.$v['id'].'/'.Page::$p.'/'); ?>">[详细]</a>
								</span>
								<?php if (1<>1&&count($v['goods']) > 1) { ?>
									<span style="float: left; padding-left: 0px;">
									<a href="javascript:void(0);" class="a-open-btn" data-state="<?php echo 1==1||$i<=3?'true':'false'; ?>" >[<?php echo 1==1||$i<=3?'收起':'展开'; ?>]</a>
									</span>
								<?php } ?>
								<?php if ($v['goods'][0]['state'] == '2') { ?>
									<span style="float: right;">
										<a href="<?php echo _u('//order_view/'.$v['id'].'/'.Page::$p.'/'); ?>#ship" class="return-btn" style="color: #fff;">发货</a>
									</span>
								<?php } ?>
							</th>
						</tr>
						<tr>
							<th width="30%">
								<span class="ml-40 fl">商品</span>
							</th>
							<th width="10%">单价(元)</th>
							<th width="15%">数量</th>
							<th width="10%">小计</th>
						</tr>
						</thead>

						<tbody>
						<?php
						$ii = 0;
						foreach ($v['goods'] as $good){
							$ii++;
						?>
							<tr<?php if(1<>1&&$i>3&&$ii>1) echo ' style="display:none;"'; ?>>
								<td width="30%">
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
											<p style="clear: both;float:left;width:100%;margin-top: 5px;">买家留言：
												<?php echo $good['content']; ?>
											</p>
										</div>
									</div>
								</td>
								<td width="10%">
									<span class="red block GoodsPrice">￥<?php echo _rmb($good['mark']/100);?></span>
								</td>
								<td width="15%">
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
				if (e > 0) $(b).hide();
			});
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