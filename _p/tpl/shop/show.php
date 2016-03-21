<?php
if(!defined('PART'))exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_['title'];?></title>
<?php
_jq();
_css('default');
_css('v1.0');
_css('style');
_js('shop');
?>
</head>
<body>
<?php
_part('top');
_part('head');
_part('nav');
?>
<!-- 主体 -->
<div class="w1200">
        <div class="details_main">
            <div class="details_body clearfix">
                <div class="details-content">
				    <div class="details-leftBox">
				        <div class="details_showPic">
				            <div id="spec-n1" class="big jqzoom">
				                <img alt="<?php echo $_['rs']['title'];?>" src="<?php echo _resize($_['rs']['img'], 360, 360); ?>">
				            </div>
				            <div id="spec-list" class="dp_slide">
				                <ul style="overflow: hidden;">
									<li>
										<img src="<?php echo _resize($_['rs']['img'], 60, 60); ?>" data-image="<?php echo _resize($_['rs']['img'], 360, 360); ?>" />
									</li>
									<?php
				                	foreach($_['img'] as $k=>$v){
				                	?>
				                    <li>
				                        <img src="<?php echo _resize($v, 60, 60); ?>" data-image="<?php echo _resize($v, 360, 360); ?>" />
				                    </li>
				                    <?php
				                    }
					                ?>
				                </ul>
				            </div>
				        </div>
				        <div class="show_info">
				            <div class="jifen-details-riCon">
				                <div class="goodsName"><a style="text-decoration: none; cursor: default" href="javascript:void(0)"><?php echo $_['rs']['title'];?></a></div>
				                <div class="deteils_shop_div1">
				                    <div class="priceNew">
				                        <div class="priceTop">
				                            <div class="fl priceTag mt-10">
				                                <p><span class="priceSpan fl typeRight">价格：</span><span class="priceSpan1 fl"><strong>￥</strong><?php echo _rmb($_['rs']['mark']/100);?></span></p>
				                            </div>
				                        </div>
				                        <p class="clear"></p>
				                    </div>
				                </div>
				            </div>
				            <div class="pro-Sales">
				                <p class="fl"><span class="Sales-left fl">总销量：</span><span class="red fl"><?php echo $_['rs']['sale'];?></span></p>
				                <div class="clear"></div>
				            </div>
				            <div class="quantity">
				                <span class="fl iname">数量：</span>
				                <div class="fl quantityfr input-div">
				                    <input type="text" minnum="1" maxnum="<?php echo $_['rs']['stock'];?>" orinum="1" value="1" id="goodsnum" class="fl atext">
				                    <div class="fl ml-5">
				                        <a class="addbtn ibtn" href="javaScript:void(0);"></a>
				                        <a class="cutbtn ibtn" href="javaScript:void(0);"></a>
				                    </div>
				                </div>
				                <p class="quantity_Stock fl">库存：<span><?php echo $_['rs']['stock'];?></span></p>
				                <div class="clear"></div>
				            </div>
				                <div class="shopBtnBox">
				                    <p class="fl btn-1 join">
				                        <a class="btn-jhd livebuy" href="javaScript:void(0)" data="<?php echo $_['rs']['id'];?>">加入购物车</a>
				                    </p>
				                </div>
				        </div>
				    </div>                    
                    <div class="details-rightBox">
                        <div class="CommodityDetail-topBox">                            
                            <a href="<?php echo _u('/user/index/'.$_['rs']['uid'].'/');?>">
                                <h4 title="<?php echo $_['rs']['uname'];?>" class="CommodityDetail-topWord"><?php echo $_['rs']['uname'];?></h4>
                            </a>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                        <!--供货商信息-->
                        <ul class="CommodityDetail-ul">
                            <li>
                                <p class="CommodityDetail-Note">
                                    代理产品：
                                </p>
                                <div class="CommodityDetail-NoteDetails"><p><?php echo $_['rs0']['product'];?></p></div>
                            </li>
                            <li>
                                <p class="CommodityDetail-Note">
                                    配送条件：
                                </p>
                                <div class="CommodityDetail-NoteDetails"><p><?php echo $_['rs0']['if'];?></p></div>
                            </li>
                            <li>
                                <p class="CommodityDetail-Note">
                                    配送范围：
                                </p>
                                <div class="CommodityDetail-NoteDetails"><p><?php echo $_['rs0']['zone'];?></p></div>
                            </li>
                            <li>
                                <p class="CommodityDetail-Note">
                                    优惠政策：
                                </p>
                                <div class="CommodityDetail-NoteDetails"><p><?php echo $_['rs0']['good'];?></p></div>
                            </li>
                        </ul>
                        <!--供货商信息-->
                        <a href="<?php echo _u('/user/index/'.$_['rs']['uid'].'/');?>">
                            <div class="SeeShop-Btn">逛逛店铺</div>
                        </a>
                    </div>
                    <div class="clear"></div>
                    <div id="sameGoods"></div>
                    <div class="show_description">
                        <div class="prod_descrit clearfix">
                            <h3>商品描述</h3>
                            <?php echo $_['rs']['content'];?>
                        </div>
                    </div>
                </div>
            </div>
            <div id="otherGoods" class="details_main_recommend">
				<div class="main-width-goods">
				    <div class="main-goods-title">
				        <img class="fl" src="<?php echo _img('car.png');?>">
				        <p class="red font16 fl mt-10">该供货商的其他商品</p>
				        <div class="clear"></div>
				    </div>
				    <div class="main-goods-scroll">
				        <div class="goods-div-scroll">
				            <div class="search_list">
				                <ul class="clearfix">
				                	<?php
				                	foreach($_['list'] as $k=>$v){
				                		$youjiao=0;
					                    if($v['recommend']==1){
					                        $youjiao=1;
					                    }
					                    if($v['new']==1){
					                        $youjiao=2;
					                    }
					                    if($v['hot']==1){
					                        $youjiao=3;
					                    }
				                	?>
		                            <li class="search_item search_item240">
		                            	<?php
		                            	if($youjiao>0){
		                            	?>
	                                    <div class="pro-activiyIco"><?php echo $_['youjiao'][$youjiao];?></div>
	                                    <?php
	                                    }
	                                    ?>
		                                    <div class="search_item_box">
			                                    <div class="prod_img">
			                                        <a href="<?php echo _u('//show/'.$v['id'].'/');?>">
			                                            <img style="display: inline;" alt="<?php echo $v['title']?>" src="<?php echo _resize($v['img'], 210, 210); ?>" class="imgload lazy">
			                                        </a>
			                                    </div>
			                                    <div style="position: relative;">
			                                        <p class="prod_price">
			                                            <span>¥<?php echo _rmb($v['mark']/100);?></span>
			                                            <b></b>
			                                        </p>
			                                    </div>
		                                    <div class="clear"></div>
		                                    <p class="prod_title"><a href="<?php echo _u('//show/'.$v['id'].'/');?>"><?php echo $v['title']?></a></p>
		                                    <div class="clear"></div>
		                                    <div class="prod_num">
		                                        <div class="fl c_999">销量：<?php echo $v['sale']?></div>
		                                        <div class="fr c_999">库存：<?php echo $v['stock']?></div>
		                                    </div>
		                                    <div class="clear"></div>
		                                    <div class="prod_btn">
		                                        <div style="margin-top: 3px;" class="num_box fl input-div">
		                                            <input type="button" class="cutbtn minusDisable num-ico">
		                                            <input type="text" minnum="1" maxnum="0" orinum="1" value="1" id="goodsId_0" class="atext minicart_num">
		                                            <input type="button" class="addbtn plusDisable  num-ico">
		                                        </div>
		                                        <input type="submit" class="buy-btn fr livebuy" value="加入购物车" id="submit" name="submit" data="<?php echo $v['id'];?>">
		                                        <div class="clear"></div>
		                                    </div>
		                                    <p class="pro_address"><a href="<?php echo _u('/user/'.$_['rs']['uid'].'/');?>"><?php echo $_['rs']['uname'];?></a></p>
		                                </div>
		                            </li>
		                            <?php
		                            }
		                            ?>
				                </ul>
				            </div>
				        </div>
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