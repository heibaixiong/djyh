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
_css('my_order');
?>

</head>
<body>
<!-- 头部start -->
<header class="aui-nav aui-bar aui-bar-nav aui-bar-dark" id="top_nav">

	<a class="aui-pull-left" onclick="history.go(-1)">
		<span class="aui-iconfont aui-icon-left"></span>
	</a>
	<div class="aui-title"><span >我的订单</span></div>
	<a class="aui-pull-right">
		<span></span>管理
	</a>
</header>
<!-- 头部end -->

<div style="position: absolute;top: 50px;bottom: 55px;overflow-y: scroll;-webkit-overflow-scrolling: touch; width:100%; ">

	<!-- 筛选条件start -->
	<ul class="aui-content order_sx aui-border-tb" style="margin-bottom:10px;">
		<li class="list_sxicon00 <?php if (empty(_v(4))) echo 'current_h'; ?>"><a href="<?php echo _u('///'); ?>"><span>全部</span></a></li>
		<li class="list_sxicon01 <?php if((_v(4)=='1')) echo 'current_h'; ?>"><a href="<?php echo _u('///1/1/'); ?>"><span>待付款</span></a></li>
		<li class="list_sxicon02 <?php if((_v(4)=='2')) echo 'current_h'; ?>"><a href="<?php echo _u('///1/2/'); ?>"><span>待收货</span></a></li>
		<li class="list_sxicon03 <?php if((_v(4)=='3')) echo 'current_h'; ?>"><a href="<?php echo _u('///1/3/'); ?>"><span>待评价</span></a></li>
		<li class="list_sxicon04 <?php if((_v(4)=='4')) echo 'current_h'; ?>"><a href="<?php echo _u('///1/4/'); ?>"><span>已评价</span></a></li>
	</ul>
	<!-- 筛选条件end -->

	<!-- 订单列表start -->
	<div class="big_main">
		<div class="aui-content">
			<?php
			foreach(Page::$arr as $k1 => $v1) {
				if (count($v1['goods']) > 0) {
					?>

					<div class="aui-content order_content">
						<?php
						$wcid = 0;
						$status = 0;
						foreach ($v1['goods'] as $k2 => $v2) {
							if ($wcid != $v2['company_id']) {
								?>
								<div class="detail_home_lin01"><a
											href="#"><?php echo $v2['company']; ?></a><span><?php if ($status == 0) {
											echo $v1['status'];
											$status = 1;
										} ?></span></div>
								<?php
							}
							?>
							<div class="index_content">
								<div class="aui-col-xs-4">
									<a href="<?php echo _u('/shop/show/' . $v2['wid']); ?>" class="index_pro02">
										<img src="<?php echo _resize($v2['img'], 300, 300); ?>">
									</a>
								</div>
								<div class="aui-col-xs-8">
									<div class="index_bleft">
										<p class="index_text01"><a
													href="<?php echo _u('/shop/show/' . $v2['wid']); ?>"><?php echo $v2['wtitle']; ?></a>
										</p>

										<p class="index_text02">
											<?php
											$model = unserialize($v2['model']);
											if ($model && count($model > 0)) {
												foreach ($model as $m) {
													echo $m['value'] . ' ';
												}
											}
											?>
										</p>

										<p class="index_text03">
											<a>￥<?php echo _rmb($v2['mark'] / 100); ?></a><span>x <?php echo $v2['num']; ?></span>
										</p>
									</div>
								</div>
							</div>
							<?php
							$wcid = $v2['company_id'];
						}
						?>
						<ul class="order_linbox">
							<li class="order_lin01">
								<a>合计：<em>￥<?php echo $v1['total']; ?></em></a>
								<a>共计<em><?php echo count($v1['goods']); ?></em>件商品</a>
							</li>
							<li class="order_lin02">
								<?php
								if ($v1['state'] == '1') {
									echo '<a href="#" data-id="' . $v1['id'] . '" class="pay-now"><span>立即支付</span></a>';
									echo '<a href="' . _u('/person/order_close/' . $v1['id'] . '/' . Page::$p) . '" class="cancleOrder"><span>取消订单</span></a>';
								} else if ($v1['state'] == '2') {
									echo '<a href="#"><span>等待发货</span></a>';
								} else if ($v1['state'] == '3') {
									echo '<a href="' . _u('//order_receipt/' . $v1['id'] . '/' . Page::$p . '/' . $v1['seller_id'] . '/') . '"><span>确认收货</span></a>';
								}
								?>
							</li>
						</ul>
					</div>
					<?php
				}
			}
			?>

		</div>
	</div>
	<!-- 订单列表end -->

</div>

<?php
_part('footer');
?>
<div class="paybox" style="display: none;"></div>
<script type="text/javascript">
	//关闭订单操作
	$(document).delegate('a.cancleOrder', 'click', function(e){
		e.preventDefault();
		var url = $(this).attr('href');
		dialog({title:'温馨提示', buttons:['关闭','取消'], content:'确认关闭订单吗？'}, function(rs){
			if (rs == 1) {
				window.location.href = url;
			}
		});
	});
	//确认收货操作
	$(document).delegate('a.a-receipt-btn', 'click', function(e){
		e.preventDefault();
		if (confirm('确认收货吗？谨慎操作以免货财两空哦！')) {
			window.location.href = $(this).attr('href');
		}
		return false;
	});

	//pay now
	$(".pay-now").click(function(){
		var id = parseInt($(this).attr('data-id'));
		var url = '<?php echo _u('/person/order_pay/'); ?>' + id;
		$.post(url, {id:id, payment_method:'weixin'}, function(data){
			console.log(data);
			//return false;
			if(data != '100' && data != '101' && data != '102'){
				$(".paybox").append(data);
				$("#btn-cart-pay").click();
			}else{
				alert('支付失败，请稍后再试');
			}
		});
	});
</script>
<!-- //主体 -->
</body>
</html>