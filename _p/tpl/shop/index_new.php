<?php
if(!defined('PART'))exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="zh_cn">
    <meta charset="UTF-8">
    <title><?php echo $_['title'];?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <?php
    _css('bootstrap.min');
    _css('base');
    _css('common');
    _css('list');
    _js('jquery');
    _js('bootstrap.min');
    _js('list');
    ?>
</head>
<body>
<?php
_part('top_new');
?>
<!--分类-->
<div class="list_main" style="position: relative;">
    <div class="container" >
        <div class="row list_main_box">
            <div class="col-md-2 col-sm-2 col-xs-2 list_lf01"><a>全部商品分类</a></div>
            <div class="list_lf02 col-md-10 col-sm-10 visible-md visible-lg">
                <div class="col-sm-1 col-md-1 "><a href="<?php echo _u('/index/index/');?>">首页</a></div>
                <div class="col-sm-1 col-md-1 "><a href="<?php echo _u('/shop/special/');?>">推荐商品</a></div>
                <div class="col-sm-1 col-md-1 "><a href="<?php echo _u('/shop/hot/');?>">热卖商品</a></div>
                <div class="col-sm-1 col-md-1 "><a href="<?php echo _u('/shop/new/');?>">最新上架</a></div>
                <div class="col-sm-1 col-md-1 "><a href="<?php echo _u('/news/index/');?>">最新公告</a></div>
                <div class="col-sm-1 col-md-1"><a href="<?php echo _u('/article/index/');?>">关于我们</a></div>
            </div>
            <div class="col-md-2 list_rig visible-xs visible-sm"><a></a></div>
        </div>
    </div>
    <div class="f_zk  hidden-lg hidden-md" style="clear: both">
        <div class="container">
            <ul class="f_zk01">
                <?php
                $_i = 0;
                foreach($_['oneclass'] as $k=>$v){
                    $_i++;
                    if ($_i > 8) break;
                    ?>
                    <li class="f_zk01_icon0<?php echo $_i; ?>"<?php if (is_file(DIR.$v['img'])) echo ' style="background:url(\''._resize($v['img'],18,18).'\') no-repeat left center;"'; ?>><a href="<?php echo _u('/shop/index/'.$v['id'].'/'); ?>"><?php echo $v['title']; ?></a></li>
                <?php } ?>
            </ul>
            <ul class="f_zk02">
                <li><a href="<?php echo _u('/index/index/');?>">首页</a></li>
                <li><a href="<?php echo _u('/shop/special/');?>">推荐商品</a></li>
                <li><a href="<?php echo _u('/shop/hot/');?>">热卖商品</a></li>
                <li><a href="<?php echo _u('/shop/new/');?>">最新上架</a></li>
                <li><a href="<?php echo _u('/news/index/');?>">最新公告</a></li>
                <li><a href="<?php echo _u('/article/index/');?>">关于我们</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container">
    <div class="row list_node">
        <a href="#" class="node_special"><?php echo $_['classtitle'];?></a>
        <a href="#"><?php echo $_['cate_title']?></a>
    </div>
    <div class="row">
        <div class="col-sm-2  hidden-xs" style="padding:0;">
            <ul class="list_xlbox">
                <?php foreach ($_['oneclass'] as $k=>$v) { ?>
                    <li class="list_xlbox_tittle">
                        <a class="list_xlbox_lin01<?php if ($_['p_id']==$v['id'] || ($_['p_id']==0 && _v(3)==$v['id'])) echo ' current_linnew'; ?>"><span><?php echo $v['title']; ?></span></a>
                        <ul class="list_xlbox_zk"<?php if ($_['p_id']==$v['id'] || ($_['p_id']==0 && _v(3)==$v['id'])) echo ' style="display: block;"'; ?>>
                            <li<?php if ($_['p_id']==0 && _v(3)==$v['id']) echo ' class="curren_cor"'; ?>><a href="<?php echo _u('/shop/index/'.$v['id'].'/'); ?>">全部</a></li>
                            <?php foreach ($v['child'] as $child) { ?>
                                <li<?php if (_v(3)==$child['id']) echo ' class="curren_cor"'; ?>><a href="<?php echo _u('/shop/index/'.$child['id'].'/'); ?>"><?php echo $child['title']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="col-sm-10 col-xs-12" style="padding:0;">
            <div class="list_bj" >
                <ul class="list_main_lin01 hidden-xs " style="display: none;">
                    <li>
                        <div class="list_in_big">
                            <a class="list_in01">品牌：</a>
                            <div class="list_main_in">
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山集团<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                            </div>
                        </div>
                    </li>
                    <li >
                        <div class="list_in_big">
                            <a class="list_in01">品牌：</a>
                            <div class="list_main_in">
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山集团<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                            </div>
                        </div>
                    </li>
                    <li >
                        <div class="list_in_big">
                            <a class="list_in01">品牌：</a>
                            <div class="list_main_in">
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山集团<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                            </div>
                        </div>
                    </li>
                    <li class="current_li">
                        <div class="list_in_big">
                            <a class="list_in01">产地：</a>
                            <div class="list_main_in">
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山集团<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                                <a href="#">蓝山<span>(7)</span></a>
                            </div>
                        </div>
                    </li>
                    <ul class="shower" style="display: none">
                        <li >
                            <div class="list_in_big">
                                <a class="list_in01">品牌：</a>
                                <div class="list_main_in">
                                    <a href="#">蓝山<span>(7)</span></a>
                                    <a href="#">蓝山集团<span>(7)</span></a>
                                    <a href="#">蓝山<span>(7)</span></a>
                                    <a href="#">蓝山<span>(7)</span></a>
                                    <a href="#">蓝山<span>(7)</span></a>
                                    <a href="#">蓝山<span>(7)</span></a>
                                    <a href="#">蓝山<span>(7)</span></a>
                                    <a href="#">蓝山<span>(7)</span></a>
                                    <a href="#">蓝山<span>(7)</span></a>
                                    <a href="#">蓝山<span>(7)</span></a>
                                    <a href="#">蓝山<span>(7)</span></a>
                                </div>
                            </div>
                        </li>
                        <li class="current_li">
                            <div class="list_in_big">
                                <a class="list_in01">品牌：</a>
                                <div class="list_main_in">
                                    <a href="#">蓝山<span>(7)</span></a>
                                    <a href="#">蓝山集团<span>(7)</span></a>
                                    <a href="#">蓝山<span>(7)</span></a>
                                    <a href="#">蓝山<span>(7)</span></a>
                                    <a href="#">蓝山<span>(7)</span></a>
                                    <a href="#">蓝山<span>(7)</span></a>
                                    <a href="#">蓝山<span>(7)</span></a>
                                    <a href="#">蓝山<span>(7)</span></a>
                                    <a href="#">蓝山<span>(7)</span></a>
                                    <a href="#">蓝山<span>(7)</span></a>
                                    <a href="#">蓝山<span>(7)</span></a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </ul>
                <div class="option_more_box hidden-xs" style="display: none;">
                    <div class="option_more_in" ></div>
                    <a>更多选项</a>
                </div>
                <ul class="list_main_lin02">
                    <li class="list_main_left">
                        <a href="<?php echo _u('///'._v(3).'/'._v(4).'/0/');?>" class="list_left_a01">默认排序</a>
                        <a href="<?php echo _u('///'._v(3).'/'._v(4).'/2/');?>" class="list_left_a02 list_left_bh"><span>价格</span></a>
                        <a href="<?php echo _u('///'._v(3).'/'._v(4).'/1/');?>" class="list_left_a03 list_left_bh"><span>销量</span></a>
                        <a href="<?php echo _u('///'._v(3).'/'._v(4).'/3/');?>" class="list_left_a04 list_left_bh"><span>新品</span></a>
                    </li>
                    <li class="list_main_right hidden-xs">
                        <div  class="list_main_a01">总计<span><?php echo Page::$num; ?></span>个商品</div>
                        <a class="list_main_a02"><b><?php echo Page::$p; ?></b>/<i><?php echo Page::$pnum; ?></i></a>
                        <a href="<?php echo _u('///'._v(3).'/'.Page::$pre.'/'._v(5).'/');?>" class="list_main_a03"><span class="list_arrow01"></span></a>
                        <a href="<?php echo _u('///'._v(3).'/'.Page::$next.'/'._v(5).'/');?>" class="list_main_a03"><span class="list_arrow02"></span></a>
                    </li>
                    <li class="list_x_rig visible-xs">筛选</li>
                    <div class="list_xy_fl hidden-sm hidden-md hidden-lg" style="clear: both">
                        <div class="container" style="padding:0;">
                            <ul class="f_zk01">
                                <li class="f_zk01_icon01">
                                    <a class="f_zk01_txt">品牌：</a>
                                    <div class="f_zk01_list">
                                        <a href="#">蓝山<span>(7)</span></a>
                                        <a href="#">雀巢<span>(7)</span></a>
                                        <a href="#">蓝山<span>(7)</span></a>
                                        <a href="#">蓝山<span>(7)</span></a>
                                        <a href="#">蓝山<span>(7)</span></a>
                                        <a href="#">雀巢<span>(7)</span></a>
                                        <a href="#">蓝山<span>(7)</span></a>
                                        <a href="#">蓝山<span>(7)</span></a>
                                    </div>
                                </li>
                                <li class="f_zk01_icon01">
                                    <a class="f_zk01_txt">品牌：</a>
                                    <div class="f_zk01_list">
                                        <a href="#">蓝山<span>(7)</span></a>
                                        <a href="#">雀巢<span>(7)</span></a>
                                        <a href="#">蓝山<span>(7)</span></a>
                                        <a href="#">蓝山<span>(7)</span></a>
                                        <a href="#">蓝山<span>(7)</span></a>
                                        <a href="#">雀巢<span>(7)</span></a>
                                        <a href="#">蓝山<span>(7)</span></a>
                                        <a href="#">蓝山<span>(7)</span></a>
                                    </div>
                                </li>
                                <li class="f_zk01_icon01">
                                    <a class="f_zk01_txt">品牌：</a>
                                    <div class="f_zk01_list">
                                        <a href="#">蓝山<span>(7)</span></a>
                                        <a href="#">雀巢<span>(7)</span></a>
                                        <a href="#">蓝山<span>(7)</span></a>
                                        <a href="#">蓝山<span>(7)</span></a>
                                        <a href="#">蓝山<span>(7)</span></a>
                                        <a href="#">雀巢<span>(7)</span></a>
                                        <a href="#">蓝山<span>(7)</span></a>
                                        <a href="#">蓝山<span>(7)</span></a>
                                    </div>
                                </li>
                                <li class="f_zk01_icon01">
                                    <a class="f_zk01_txt">品牌：</a>
                                    <div class="f_zk01_list">
                                        <a href="#">蓝山<span>(7)</span></a>
                                        <a href="#">雀巢<span>(7)</span></a>
                                        <a href="#">蓝山<span>(7)</span></a>
                                        <a href="#">蓝山<span>(7)</span></a>
                                        <a href="#">蓝山<span>(7)</span></a>
                                        <a href="#">雀巢<span>(7)</span></a>
                                        <a href="#">蓝山<span>(7)</span></a>
                                        <a href="#">蓝山<span>(7)</span></a>
                                    </div>
                                </li>
                                <a class="f_zk01_qr">确&nbsp;&nbsp;&nbsp;&nbsp;认</a>
                            </ul>
                        </div>

                    </div>
                </ul>
                <div class="row" style="margin:0 -6px;">
                    <?php foreach (Page::$arr as $v) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 list_bigbox" style="padding:0;  position: relative;">
                            <ul class="list_main_list">
                                <li class="list_main_photo" style=""><a href="<?php echo _u('//show/'.$v['id'].'/');?>" target="_blank"><img src="<?php echo _resize($v['img'], 224, 224); ?>"></a></li>
                                <li class="list_main_text" >
                                    <div>
                                        <p class="list_text06"><a>￥<?php echo _rmb($v['mark']/100); ?></a></p>
                                        <p class="list_text01" style="overflow: hidden;"><a href="<?php echo _u('//show/'.$v['id'].'/');?>" target="_blank"><?php echo _left($v['title'], 0, 34); ?></a></p>
                                        <p class="list_text02" style="height:32px; overflow: hidden;"><a><?php echo _left(strip_tags($v['content']), 0, 62, '...'); ?></a></p>
                                        <div class="list_text05">

                                            <input  class="list_text05_in02" type="text" name="cart_amount" value="1" />
                                            <div class="list_text_big">
                                                <a class="list_text05_in01 jia"></a>
                                                <a class="list_text05_in01 jian"></a>

                                            </div>
                                            <a href="javascript:void(0);" class="list_addcar btn_add_cart" data="<?php echo $v['id']; ?>" data-option="">加入购物车</a>
                                        </div>

                                    </div>

                                </li>

                            </ul>
                            <div class="list_text04"><div class="list_text04_bombox" style="margin:0 5px;"><a class="list_text04_bom01"><?php echo $v['uname']; ?></a><a class="list_text04_bom02">销量：<em><?php echo $v['sale']; ?></em></a></div></div>
                        </div>
                    <?php } ?>
                </div>
                <!--页码-->
                <div class="row" >
                    <div class="col-sm-12 col-xs-12 " style="padding:0;">
                        <div class="list_bom_page" >
                            <?php
                            $i_s = Page::$p - 2;
                            if ($i_s < 1) $i_s = 1;
                            $i_e = $i_s + 4;
                            if ($i_e > Page::$pnum) {
                                $i_e = Page::$pnum;
                                $i_s = $i_e - 4 < 1 ? 1 : $i_e - 4;
                            }
                            ?>
                            <?php for ($page=$i_s;$page<=$i_e;$page++) { ?>
                                <?php
                                $class = '';
                                if ($page==Page::$p) $class .= 'current_page ';
                                if (($i_s>1 && $i_e < Page::$pnum && ($page==$i_s || $page==$i_e)) || ($i_s==1 && $page > 3) || ($i_e==Page::$pnum && $page<Page::$pnum-2)) $class .= 'hidden-xs ';
                                ?>
                                <a href="<?php echo _u('///'._v(3).'/'.$page.'/'._v(5).'/'); ?>"<?php if ($class) echo ' class="'.$class.'"'; ?>><?php echo $page; ?></a>
                            <?php } ?>
                            <?php if ($i_e < Page::$pnum) { ?>
                            <a href="<?php echo _u('///'._v(3).'/'.(Page::$p + 3).'/'._v(5).'/'); ?>">…</a>
                            <a href="<?php echo _u('///'._v(3).'/'.Page::$pnum.'/'._v(5).'/'); ?>" class="hidden-xs"><?php echo Page::$pnum; ?></a>
                            <a class="list_bom_xia" href="<?php echo _u('///'._v(3).'/'.Page::$next.'/'._v(5).'/'); ?>">下一页</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.btn_add_cart').click(function(){
            var id=parseInt($(this).attr('data'));
            var num=parseInt($(this).closest('div').find('input[name="cart_amount"]').val());
            var option = $(this).data('option');
            if(num>0){
                $.get("<?php echo _u('/cart/add/'); ?>"+id+"/"+num+"/"+option+'/',function(data,status){
                    var _result = $.parseJSON(data);
                    $('#shopping-amount').next('span').html(_result['total']);
                    //alert('添加成功！');
                    alert(_result['msg']);
                    if (_result['redirect']) window.location.href = _result['redirect'];
                });
            }
        });
    });
</script>

<?php
_part('footer_new');
_part('footer3');
?>
</body>
</html>