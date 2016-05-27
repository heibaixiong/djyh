<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
	<meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
	<title><?php echo $_['title'];?></title>
	<?php
	_css('aui');
	_css('commons');
	_css('detail');
	?>
	<style>
		.goods-attr-check{background-color: #eee;color:#f60;border:#f60;}
	</style>
</head>

<body>
<!--头部-->
<header class="aui-nav aui-bar aui-bar-nav aui-bar-dark" id="top_nav">
	<div class="aui-col-xs-2" style="width:18%;">
        <span class="aui-pull-left" style="padding-left: 5px;" onclick="history.go(-1)">
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
<div  style="position: absolute;top: 50px;bottom: 55px;overflow-y: scroll;-webkit-overflow-scrolling: touch; width:100%; ">

	<!--筛选条件-->
	<ul class="aui-content list_sx aui-border-tb" style="margin-bottom:0;">
		<li class="aui-col-xs-3 current_mr"><a href="#">商品</a></li>
		<li class="aui-col-xs-3 "><a href="#">详情</a></li>
		<li class="aui-col-xs-3 "><a href="#">评价</a></li>
		<li class="aui-col-xs-3 " style="border: none"><a href="#">购物车</a></li>
	</ul>

	<!--main-->
	<div class="big_main">
		<!-- tab01-->
		<div class="det_tab01" >
			<div class="det_img">
				<img src="<?php echo _resize($_['rs']['img'], 360, 360); ?>">
			</div>
			<!--题目-->
			<div class="det_tit">
				<div class="det_tit_box">
					<div class="det_tit_left">
						<p class="index_text01"><a href="#"><?php echo $_['rs']['title']; ?></a></p>
						<p class="index_text02" style="margin-top:0.2rem;"><?php echo _left(strip_tags($_['rs']['content']), 0, 48, '...'); ?></p>
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
					<li class="detail_home_lin04">
						<a href="#" class="detail_lin04_d01">进店逛逛</a>
					</li>
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
					<li class="detail_home_lin04">
						<a href="#" class="detail_lin04_d02">收藏店铺</a>
					</li>
				</ul>
			</div>
		</div style>
		<!-- tab02-->
		<div class="det_tab01 d_tab" style="display: none">
			<div class="d_tab_main">
				<div class="d_tab_list">
					<p class="d_tab_list_title">商品详情</p>
					<!--
					<ul class="d_tab_list02">
						<li><p>产品参数</p><li>
						<li>生产许可证编号：QS4419 0601 1036</li>
						<li>产品标准号：Q/HLS0001S 2012</li>
						<li>厂名：河南省老杨家食品有限公司</li>
						<li>厂址：西华县逍遥镇工业区</li>
						<li>厂家联系方式：03942581180</li>
					</ul>
					-->
					<ul class="d_tab_list02">
						<!--
						<li><p>规格参数</p><li>
						<li><a class="d_tab_list02_lef">品牌: 逍遥老杨家</a><a class="d_tab_list02_rig">特产品类: 逍遥镇胡辣汤</a></li>
						<li><a class="d_tab_list02_lef">保质期：365 天</a><a class="d_tab_list02_rig">包装种类: 袋装</a></li>
						<li><a>品牌: 逍遥老杨家</a><a>特产品类: 逍遥镇胡辣汤</a></li>
						<li>配料表：玉米淀粉、山药粉、豆肉蔻</li>
						<li>储藏方法：存放阴凉、干燥、通风处</li>
						<li>规格: 麻组合辣和微辣组合256g*2袋</li>
						<li><a class="d_tab_list02_lef">产地: 中国大陆</a><a class="d_tab_list02_rig">省份: 河南省</a></li>
						<li><a class="d_tab_list02_lef">城市: 郑州市</a><a class="d_tab_list02_rig">口味: 胡辣味</a></li>
						-->
						<?php
						if (!empty($_['para_info'])) {
						?>

						<li><p>规格参数</p><li>
						<?php foreach ($_['para_info'] as $para) { ?>
						<li><?php echo $para['paraname'].'：'.$para['value']; ?></li>
						<?php
							}
						}
						?>
					</ul>
				</div>
				<div class="d_tab_img">
					<p class="d_tab_list_title">图文详情</p>
					<div id="content">
						<style>
							#content img{max-width: 100%;}
						</style>
						<?php echo $_['rs']['content']; ?>
					</div>
				</div>
			</div>
		</div>
		<!--热门推荐-->
		<div class="detail_hot">
			<div class="detail_hot_tex">热门推荐<span>NEW</span></div>
			<ul class="detail_hot_min">
				<?php
				foreach($_['list'] as $k => $v){
				?>
				<li>
					<div class="detail_hot_img">
						<a href="<?php echo _u('/shop/show/'.$v['id']); ?>">
							<img src="<?php echo _resize($v['img'], 210, 210); ?>">
						</a>
						<?php if ($v['recommend'] == 1) { ?>
							<span class="store_one">推荐<br>商品</span>
						<?php } elseif ($v['hot'] == 1) { ?>
							<span class="store_one">热门<br>商品</span>
						<?php } ?>
					</div>
					<p class="detail_hot_wz"><a href="<?php echo _u('/shop/show/'.$v['id']); ?>" class="aui-ellipsis-1"><?php echo $v['title']; ?></a></p>
					<p class="detail_hot_wz02"><span class="detail_hot_pice">￥<?php echo _rmb($_['rs']['mark']/100);?></span><span class="detail_hot_num">已售<em><?php echo $_['rs']['sale'];?></em>件</span></p>
				</li>
					<?php
				}
				?>
			</ul>
		</div>
		<!--逛逛-->
		<div class="detail_attr det_yem" style="position: inherit;">
			<div class="attr_bottom" style="margin:0.44rem 0;">
				<a href="#" class="attr_bottom_a01">进  店</a>
				<a href="#" class="attr_bottom_a02 idnex_gw" data-id="<?php echo $_['rs']['id']; ?>">加入购物车</a>
				<a href="#" class="attr_bottom_a03">立即购买</a>
			</div>
		</div>
	</div>
</div>

<?php
_part('footer');
_js('iscroll');
?>

<!--弹出层-->
<div class="slide-mask"></div>

<div class="detail_attr" >
	<ul>
		<li class="aui-content index_content det_newcont" style="background: #fff;padding-top:20px;position:absolute;top:0;left:0;width:100%;height:120px;">
			<div class="aui-col-xs-3" >
				<a href="#" class="index_pro02">
					<img src="<?php echo _resize($_['rs']['img'], 360, 360); ?>" />
				</a>

			</div>
			<div class="aui-col-xs-9" >
				<div class="index_bleft">
					<p class="index_text01"><a href="#"><?php echo $_['rs']['title']; ?></a></p>
					<p class="index_text02"><?php echo _left(strip_tags($_['rs']['content']), 0, 48, '...'); ?></p>
					<p class="index_text03">￥<?php echo _rmb($_['rs']['mark']/100);?></p>
				</div>
			</div>
		</li>


		<div class="attr_main" id="wrapper" >
			<ul>
				<?php if(isset($_['attr_info']) && count($_['attr_info']) > 0){ ?>
				<li>
					<div class="attr_middle">
						<?php
							foreach ($_['attr_info'] as $k1 => $v1) {
						?>
								<dl data-wname="<?php echo $k1; ?>">
									<dt><?php echo $k1; ?>:</dt>
									<dd>
										<?php
										foreach($v1 as $k2 => $v2){
											echo '<a class="goods-attr" data-check="0" data-attr="' . $v2['id'] . '">' . $v2['model'] . '</a>';
										}
										?>
										<!-- <a>精品礼盒</a> -->
									</dd>
								</dl>
						<?php } ?>
					</div>
				</li>
				<?php } ?>
				<li>
					<div class="attr_center">
						<dl>
							<dt>数量</dt>
							<dd class="detail_sl">
								<span class="detail_jian"></span>
								<input type="text" name="num" value="1">
								<span class="detail_jia"></span>
							</dd>
						</dl>
					</div>
					<div style="clear: both;"></div>
				</li>
			</ul>
		</div>
		<li class="attr_bombox">
			<div class="attr_bottom" style="width:100%;">
				<a href="#" class="attr_bottom_a01">进  店</a>
				<a href="#" class="attr_bottom_a02 idnex_gw" data-id="<?php echo $_['rs']['id']; ?>">加入购物车</a>
				<a href="#" class="attr_bottom_a03">立即购买</a>
			</div>
		</li>
	</ul>
	<span class="detail_close"></span>
</div>

<script>
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
		$(".det_tab01").eq(index).show().siblings(".det_tab01").hide();
	});

	//购物车点击操作
	$(".idnex_gw").click(function(){
		var tag = is_login();
		if(tag === true){
			var id = parseInt($(this).attr('data-id'));
			var num = $("input[name='num']").val();
			var attr = '';
			$(".goods-attr").each(function(){
				if($(this).attr("data-check") == "1"){
					attr += $(this).attr("data-attr") + ',';
				}
			});
			attr = attr.substring(0, attr.length-1);
			addCart(id, num, attr);
		}
	});


	$('div.slide-mask').on('click', function(){
		$('div.slide-mask').hide();
		$('aside.slide-wrapper').removeClass('moved');
		$('.detail_attr').removeClass('moved');
		$('body').unbind('touchmove');
	});
	$(".det_bigbox li").click(function(){
		var wh = $('div.wrapperhove'+'rtree').height();
		$('div.slide-mask').css('height', wh).show();
		$('.detail_attr').css('height', wh).addClass('moved');
		$('div.slide-mask').css({'bottom':'0'});
		$('.detail_attr ').css({'bottom':'0'});
		$('body').on('touchmove',function(e){
			e.preventDefault();
		})
		var myScroll;
		myScroll = new IScroll('#wrapper', { click: true, fadeScrollbars: true,zoom:true});
	})

	$('.detail_close').on('click', function(){
		$('div.slide-mask').hide();
		$('.detail_attr').removeClass('moved');
		$('body').unbind('touchmove');
	});

	//参数选择
	$(".goods-attr").click(function(){
		var ck = parseInt($(this).attr("data-check"));
		ck = (ck+1)%2;
		//console.log(ck);
		ck == 1 ? $(this).attr("data-check", ck).css({"color":"#f60", "border":"1px solid #f60"}).siblings().attr("data-check", 0).css({"color":"#646464", "border":"none"}) : $(this).parent().find("a").attr("data-check", ck).css({"color":"#646464", "border":"none"});
	});


	//加减
	(function shopnum(){
		var shopnum=$(".detail_sl");
		var cid = shopnum.attr("data-cid");
		var inp=shopnum.find("input[name='num']");
		var jian=shopnum.find(".detail_jian");
		var jia=shopnum.find(".detail_jia");

		jian.click(function(){
			var th = $(this);
			var num=parseNum(inp.val());
			num=num-1<=0?1:num-1;
			inp.val(num);
		});
		jia.click(function(){
			var th = $(this);
			var num=parseNum(inp.val());
			num=num+1;
			inp.val(num);
		});
		inp.keyup(function(){
			var num=parseNum(inp.val());
			inp.val(num);
		});
		var parseNum=function(num){
			num=parseInt(num);
			return isNaN(num)?1:num;
		};
	}());
</script>
</body>
</html>
