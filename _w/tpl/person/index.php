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
	_css('my_car');
	_css('store_center');
	?>
</head>

<body>
<!--头部-->
<header class="aui-nav aui-bar aui-bar-nav aui-bar-dark" id="top_nav">
	<a class="aui-pull-left" onclick="history.go(-1)">
		<span class="aui-iconfont aui-icon-left"></span>
	</a>
	<div class="aui-title"><span class="car_icon01">个人中心</span></div>
	<a class="aui-pull-right">
		<!-- <span></span>管理 -->
	</a>
</header>
<div style="position: absolute;top: 50px;bottom: 55px;overflow-y: scroll;-webkit-overflow-scrolling: touch; width:100%; ">

	<!--main-->
	<div class="big_main" style="margin:0;">
		<div class="center_tx" style="position: relative">
			<div class="video_scale">
				<img src="<?php echo _resize(_img('center_tx.png'), 70, 70); ?>">
				<div class="video_scale_01"></div>
				<div class="video_scale_02"></div>
			</div>
			<div class="center_name">
				<a class="center_name01"><?php echo $_['rs']['name'] != '' ? $_['rs']['name'] : $_['rs']['user']  ;?></a>

				<p><a class="center_name02 aui-border" href="javascript:void(0)">账号管理</a></p>
			</div>
		</div>
		<!--我的订单-->
		<div class="center_order">
			<a class="center_order01">我的订单</a>
			<a href="<?php echo _u('/person/order/'); ?>" class="center_order02 ">查看所有订单</a>
		</div>

		<ul class="aui-content order_sx aui-border-tb" style="margin-bottom:10px;">

			<li class="list_sxicon00 "><a href="<?php echo _u('/person/order/'); ?>"><span>全部</span></a></li>
			<li class="list_sxicon01"><a href="<?php echo _u('/person/order/1/1/'); ?>"><span>待付款</span></a></li>
			<li class="list_sxicon02"><a href="<?php echo _u('/person/order/1/2/'); ?>"><span>待发货</span></a></li>
			<li class="list_sxicon03"><a href="<?php echo _u('/person/order/1/3/'); ?>"><span>待收货</span></a></li>
			<li class="list_sxicon04"><a href="<?php echo _u('/person/order/1/4/'); ?>"><span>已完成</span></a></li>
		</ul>
		<!--我的钱包-->
		<!--
		<div class="center_order">
			<a class="center_order01">我的钱包</a>
		</div>

		<ul class="order_wallet aui-border-tb" style="margin-bottom:10px;">
			<li>
				<p class="wallet_p01">￥500</p>
				<p class="wallet_p02">余额</p>
			</li>
			<li >
				<p class="wallet_p03">充值</p>
			</li>
		</ul>
		-->
		<!--热门推荐-->
		<div class="detail_hot">
			<div class="detail_hot_tex">热门推荐<span>NEW</span></div>
			<ul class="detail_hot_min">
				<?php
					foreach($_['goods'] as $k => $v) {
						?>
						<li>
							<div class="detail_hot_img"><a href="<?php echo _u('/shop/show/').$v['id']; ?>"><img src="<?php echo _resize($v['img'], 200, 200) ?>"></a> <span
										class="store_one"><?php echo $v['recommend'] == '1' ? '推荐':'热门'; ?><br>商品</span></div>
							<p class="detail_hot_wz"><a href="<?php echo _u('/shop/show/').$v['id']; ?>" class="aui-ellipsis-1"><?php echo $v['title']; ?></a></p>

							<p class="detail_hot_wz02"><span class="detail_hot_pice">￥<?php echo _rmb($v['mark']/100); ?></span><span
										class="detail_hot_num">已售<em><?php echo $v['sale']; ?></em>件</span></p>
						</li>
						<?php
					}
				?>
			</ul>
		</div>
	</div>
</div>

<!--footer-->
<?php
_part('footer');
?>
<script>


</script>
</body>
</html>
