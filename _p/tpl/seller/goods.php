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
				商品列表
				<p style="float: right;">
					<a href="<?php echo _u('//goods_add//'.Page::$p.'/'); ?>" class="return-btn">发布商品</a>
				</p>
			</div>
			<div class="userinfo">
				<form action="<?php echo _u('//goods/'); ?>" method="post" id="mess-form">
					<p style="float: left; margin-bottom: 5px;">
						<select name="mess_action" style="float: left;height: 34px; line-height: 34px; margin-right: 5px;">
							<option value="">操作</option>
							<option value="onsale">批量上架</option>
							<option value="unsale">批量下架</option>
						</select>
						<input type="text" name="search" value="<?php echo $_['search_key']; ?>" style="float: left;height: 30px; line-height: 30px; margin-right: 5px; padding: 0 5px 0 5px;" />
						<a href="javascript:void(0);" id="btn-seller-search" class="return-btn" style="float: left;width: 50px; margin-right: 5px;">搜 索</a>
					</p>
					<table class="table-orderList">
						<thead>
						<tr>
							<th width="5%"><input type="checkbox" name="checkbox_all" id="checkbox-all" value="1" /><label for="checkbox-all">全选</label></th>
							<th width="30%">
								<span class="fl">商品名称</span>
							</th>
							<th width="10%">货号</th>
							<th width="10%">单价(元)</th>
							<th width="10%">库存</th>
							<th width="10%">状态</th>
							<th width="10%">操作</th>
						</tr>
						</thead>

						<tbody>
						<?php
						foreach (Page::$arr as $k=>$goods) {
							?>
							<tr>
								<td><input type="checkbox" name="checkbox[]" value="<?php echo $goods['id']; ?>" /></td>
								<td width="30%">
									<div class="fl" style="width: 100%;">
										<div class="proImg">
											<img src="<?php echo _resize($goods['img'], 60, 60); ?>">
										</div>
										<div class="proDetails" style="width: 72%;">
											<a href="<?php echo _u('/shop/show/'.$goods['id'].'/');?>" target="_blank"><?php echo $goods['title']?></a>
										</div>
									</div>
								</td>
								<td><?php echo $goods['number']; ?></td>
								<td width="10%">
									<span class="red block GoodsPrice">￥<?php echo _rmb($goods['mark']/100);?></span>
								</td>
								<td width="10%">
									<p class="">
										<?php echo $goods['stock']; ?>
									</p>
								</td>
								<td style="color: <?php echo $goods['state']?'#d31a26':'#12ad12'; ?>"><b><?php echo $_['state'][$goods['state']]; ?></b></td>
								<td width="10%"><a href="<?php echo _u('//goods_edit/'.$goods['id'].'/'.Page::$p.'/'); ?>">编辑</a></td>
							</tr>
							<?php
						}
						?>
						</tbody>
					</table>
				</form>
				<div style="float: right" class="pageWrap">
					<div class='turn_page clearfix'>
						<form action="<?php echo _u('//goods/'); ?>" method="post" id="page-form">
							<div class="fr">
								<a disabled="disabled" href="<?php echo _u('///1/');?>">首页</a><a disabled="disabled" href="<?php echo _u('///'.Page::$pre.'/');?>">上一页</a><a class="page_cur"><?php echo Page::$p.'/'.Page::$pnum;?></a><a href="<?php echo _u('///'.Page::$next.'/');?>">下一页</a><a href="<?php echo _u('///'.Page::$pnum.'/');?>">尾页</a>
								<input type="text" name="page_go" value="<?php echo Page::$p; ?>" style="line-height: 25px; margin-top: -25px; margin-left: 5px; width: 30px; text-align: center;" />
								<a href="javascript:void(0);" id="btn-page-jump">跳转</a>
								<input type="submit" style="display: none;" />
							</div>
						</form>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).delegate('input[name="checkbox_all"]', 'click', function() {
		$('input[name="checkbox[]"]').prop('checked', $(this).prop('checked'));
	});
	$(document).delegate('select[name="mess_action"]', 'change', function() {
		if ($('input[name="checkbox[]"]:checked').length == 0) {
			$('select[name="mess_action"]').find('option[value=""]').prop('selected', 'selected');
			alert('请选择要批量操作的商品！');
		}

		if ($('select[name="mess_action"]').val() != '') {
			if (confirm('确定进行批量操作？')) {
				$('select[name="mess_action"]').closest('form').attr('action', '<?php echo _u('//goods_mess/'.Page::$p.'/'); ?>');
				$('select[name="mess_action"]').closest('form').submit();
			} else {
				$('select[name="mess_action"]').find('option[value=""]').prop('selected', 'selected');
			}
		}
	});
	$('#btn-seller-search').on('click', function(){
		$(this).closest('form').attr('action', '<?php echo _u('//goods/'); ?>');
		$(this).closest('form').submit();
	});
	$('#btn-page-jump').on('click', function(){
		var _p = $('#page-form input[name="page_go"]').val();
		if (isNaN(_p)) {
			$('#page-form input[name="page_go"]').focus();
			return false;
		}
		window.location.href = '<?php echo _u('//goods/'); ?>'+_p+'/';
	});
	$('#page-form').on('submit', function(){
		$('#btn-page-jump').trigger('click');
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