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
_css('detail');
?>
</head>
<body>
<!--头部-->
<header class="aui-nav aui-bar aui-bar-nav aui-bar-dark" id="top_nav">
	<div class="aui-col-xs-2" style="width:18%;">
        <span class="aui-pull-left" style="padding-left: 5px;">
           <span class="aui-iconfont aui-icon-left"></span>
        </span>
	</div>
	<div class="aui-col-xs-8" style="width:62%">
		<div class="aui-searchbar" id="search">
			<form style="width:100%;">
				<input type="search" placeholder="请输入搜索内容" id="search-input">
				<a href="#" class="aui-iconfont aui-icon-search search_icon" ></a>
			</form>
		</div>
	</div>
	<div class="aui-col-xs-2" style="width:20%;">
         <span class="aui-pull-right" style="padding-right:5px;padding-top:2px;">
            <a class="index_car">搜索</a>
        </span>
	</div>
</header>
<div style="position: absolute;top: 50px;bottom: 55px;overflow-y: scroll;-webkit-overflow-scrolling: touch; width:100%; ">

	<!--筛选条件-->
	<ul class="aui-content list_sx aui-border-tb" style="margin-bottom:0;">
		<li class="aui-col-xs-6 current_mr"><a href="#">商品</a></li>
		<li class="aui-col-xs-6" style="border:none;"><a href="#">详情</a></li>
		<!-- <li class="aui-col-xs-3 "><a href="#">评价</a></li> -->
		<!-- <li class="aui-col-xs-4 " style="border: none"><a href="#">购物车</a></li> -->
	</ul>

	<!--main-->
	<div class="big_main">
		<div class="det_img">
			<img src="<?php echo $_['rs']['img']; ?>">
		</div>
		<!--题目-->
		<div class="det_tit">
			<div class="det_tit_box">
				<div class="det_tit_left">
					<p class="index_text01"><a href="#"><?php echo $_['rs']['title']; ?></a></p>
					<p class="index_text02" style="margin-top:0.2rem;"><?php echo $_['rs']['class1name']; ?></p>
				</div>
				<div class="det_tit_cent">

				</div>
				<div class="det_tit_right">
					<a href="#">
						<p class="det_tit_lin01"></p>
						<p class="det_tit_lin02">收藏</p>
					</a>
				</div>
			</div>
			<div class="det_price">
				<span class="det_price_in01">价格:<em>￥<?php echo _rmb($_['rs']['mark']/100);?></em></span>
				<span class="det_price_in02">已售<em><?php echo $_['rs']['sale'];?></em>件</span>
			</div>
		</div>
		<!--选择-->
		<ul class="aui-list-view det_bigbox" style="margin:10px 0;border-color:#c6c6c6;">
			<li class="aui-list-view-cell">
				<div class="aui-arrow-right aui-ellipsis-1 list_pp">
					选择套装
				</div>
			</li>
		</ul>

		<!--东家要货自营-->
		<div class="det_zj">
			<div class="detail_home_lin01"><a href="#"><?php echo $_['rs0']['compony']; ?></a></div>
			<ul class="detail_home">
				<li class="detail_home_lin02 detail_icpn02"><a>金牌信誉店</a></li>
				<li class="detail_home_lin03" style="width:100%;text-align: center;">
					<div class="detail_lin03_item" style="float: none">
						<div class="detail_lin03_item_tex aui-ellipsis-1" style="padding-top:0.3rem;"><?php echo $_['rs0']['product']; ?></div>
						<div class="detail_lin03_item_num" style="height:0.7rem">
							<span style="visibility: hidden">4.8</span>
						</div>
					</div>

				</li>
				<!--
				<li class="detail_home_lin04">
					<a href="#" class="detail_lin04_d01">进店逛逛</a>
				</li>
				-->
			</ul>
			<ul class="detail_home">
				<li class="detail_home_lin02"><a>店铺评分</a></li>
				<li class="detail_home_lin03">
					<div class="detail_lin03_item">
						<div class="detail_lin03_item_tex">描 述</div>
						<div class="detail_lin03_item_num">
							<span>4.8</span>
						</div>
					</div>
					<div class="detail_lin03_item">
						<div class="detail_lin03_item_tex">服 务</div>
						<div class="detail_lin03_item_num ">
							<span>4.8</span>
						</div>
					</div>
					<div class="detail_lin03_item">
						<div class="detail_lin03_item_tex">物 流</div>
						<div class="detail_lin03_item_num">
							<span>4.8</span>
						</div>
					</div>
				</li>
				<!--
				<li class="detail_home_lin04">
					<a href="#" class="detail_lin04_d02">收藏店铺</a>
				</li>
				-->
			</ul>
		</div>
		<!-- 热门推荐start -->
		<div class="detail_hot">
			<div class="detail_hot_tex">热门推荐<span>NEW</span></div>
			<ul class="detail_hot_min">
				<?php
				foreach($_['list'] as $k => $v){
				?>
				<li>
					<div class="detail_hot_img"><a href="#"><img src="<?php echo $v['img']; ?>"></a> <span class="store_one">推荐<br>商品</span></div>
					<p class="detail_hot_wz"><a href="#" class="aui-ellipsis-1"><?php echo $v['title']; ?></a></p>
					<p class="detail_hot_wz02"><span class="detail_hot_pice">￥<?php echo _rmb($_['rs']['mark']/100);?></span><span class="detail_hot_num">已售<em><?php echo $_['rs']['sale'];?></em>件</span></p>
				</li>
				<?php
				}
				?>
			</ul>
		</div>
		<!-- 热门推荐end -->

		<!-- 逛逛start -->
		<div class="detail_attr det_yem" style="position: inherit;">
			<div class="attr_bottom" style="margin:0.44rem 0;">
				<a href="#" class="attr_bottom_a01"><!-- 进  店 --></a>
				<a href="#" class="attr_bottom_a02 idnex_gw" data-id="<?php echo $_['rs']['id']; ?>">加入购物车</a>
				<a href="#" class="attr_bottom_a03">立即购买</a>
			</div>
		</div>
		<!-- 逛逛end -->

	</div>
</div>

<!--弹出层-->
<div class="slide-mask"></div>
<aside class="slide-wrapper" >
	<div class="slide_big">
		<div class="slide_right">
			<div class="detail_attr" >
				<ul>
					<li class="aui-content index_content det_newcont" style="background: #fff;padding-top:20px;">
						<div class="aui-col-xs-4" >
							<a href="#" class="index_pro02">
								<img src="<?php echo $_['rs']['img']; ?>" >
							</a>

						</div>
						<div class="aui-col-xs-8" >
							<div class="index_bleft">
								<p class="index_text01"><a href="#"><?php echo $_['rs']['title']; ?></a></p>
								<p class="index_text02"><?php echo $_['rs']['class1name']; ?></p>
								<p class="index_text03">￥<?php echo _rmb($_['rs']['mark']/100);?></p>
							</div>
						</div>
					</li>
					<li>
						<div class="attr_middle">
							<dl>
								<dt>选择套装</dt>
								<dd><a>精品礼盒</a><a>实惠套装</a><a>简易装</a><a>简易装</a><a>简易装</a><a>简易装</a></dd>
							</dl>
						</div>
					</li>
					<li>
						<div class="attr_center">
							<dl>
								<dt>数量</dt>
								<dd class="detail_sl">
									<span class="detail_jian"></span>
									<input type="text" value="1">
									<span class="detail_jia"></span>
								</dd>
							</dl>
						</div>
						<div style="clear: both;"></div>
					</li>
					<li>
						<div class="attr_bottom">
							<a href="#" class="attr_bottom_a01">进  店</a>
							<a href="#" class="attr_bottom_a02">加入购物车</a>
							<a href="#" class="attr_bottom_a03">立即购买</a>
						</div>
					</li>
				</ul>
			</div>

		</div>

	</div>
</aside>

<?php
_part('footer');
?>


<script>


	var arr_old_bgp = ["footer_icon01","footer_icon02","footer_icon03","footer_icon04"],
			arr_new_bgp = ["footer_bh01","footer_bh02","footer_bh03",'footer_bh04',];
	$('.aui-bar-tab li').click(function(){
		var guide =$(this).index();
		var $this = $(this),
				index = $this.index();
		$this.parent().find('li').each(function(i,e){

			$(this).find('span').removeClass(arr_new_bgp[i]);

		});

		$(this).find('span').addClass(arr_new_bgp[index]).siblings("p").css("color","#ff0000").parents("li").siblings("li").find("span").removeClass(arr_new_bgp[index]).siblings("p").css("color","#3c3c3c");
	});


	var arr_old_bg= ["","list_sxicon01","list_sxicon02","list_sxicon03"],
			arr_new_bg = [" ", "current_mr02","current_mr03","current_mr04"];
	$('.list_sx li').click(function(){

		var guide =$(this).index();
		var $this = $(this),
				index = $this.index();
		$this.parent().find('li').each(function(i,e){

			$(this).find('span').removeClass(arr_new_bg[i]);

		});

		$(this).find('span').addClass(arr_new_bg[index]).parents("li").siblings("li").find("span").removeClass(arr_new_bg[index]);
		$(this).addClass("current_mr").siblings("li").removeClass("current_mr");
	});


	$('div.slide-mask').on('click', function(){
		$('div.slide-mask').hide();
		$('aside.slide-wrapper').removeClass('moved');
//         $(".slide-wrapper").hide();

	});
	$(".det_bigbox li").click(function(){
		var wh = $('div.wrapperhove'+'rtree').height();
		$('div.slide-mask').css('height', wh).show();
		$('aside.slide-wrapper').css('height', wh).addClass('moved');
		$('div.slide-mask').css({'bottom':'0'});
		$('.slide-wrapper ').css({'bottom':'0'});
		$(".list_bigbox02").show();
	})


	//购物车点击操作
	$(".idnex_gw").click(function(){
		var tag = is_login();
		if(tag === true){
			var id = parseInt($(this).attr('data-id'));
			var num = 9;
			addCart(id, num);
		}
	});
</script>
</body>
</html>