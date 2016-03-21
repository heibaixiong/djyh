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
			<div class="zhjf-title">订单列表</div>
			<div class="userinfo">

				<?php
				foreach (Page::$arr as $k=>$v) {
				?>
					<table class="table-orderList">
						<thead>
						<tr>
							<th colspan="4" style="background-color: #fff; text-align: left;">
								<a href="<?php echo _u('//order_view/'.$v['id'].'/'.Page::$p.'/'); ?>">#<?php echo $v['id']; ?>, ￥<?php echo _rmb($v['total']); ?>, <?php echo _time($v['addtime']); ?> [<?php echo $_['order_state'][$v['state']]; ?>]</a>
								<?php if (count($v['goods']) > 1) { ?>
								<a href="javascript:void(0);" class="a-open-btn" data-state="false" >[展开]</a>
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
							<tr<?php if($ii>1) echo ' style="display:none;"'; ?>>
								<td width="30%">
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
						<div class="fr"><a disabled="disabled" href="<?php echo _u('///1/');?>">首页</a><a disabled="disabled" href="<?php echo _u('///'.Page::$pre.'/');?>">上一页</a><a class="page_cur"><?php echo Page::$p.'/'.Page::$pnum;?></a><a href="<?php echo _u('///'.Page::$next.'/');?>">下一页</a><a href="<?php echo _u('///'.Page::$pnum.'/');?>">尾页</a></div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('.a-open-btn').click(function(){ console.log($(this).data('state'));
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
		}console.log($(this).data('state'));
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