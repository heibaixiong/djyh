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
//_jq();
_js('jquery');
_editor('editor-desc');
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
				发布商品
				<p style="float: right;">
					<a href="<?php echo _u('//goods/'._v(4).'/'); ?>" class="return-btn">返回列表</a>
				</p>
			</div>
			<div class="userinfo">
				<div style="height: 22px; border-bottom: 1px solid #ddd; margin-bottom: 10px;">
					<span style="font-weight: bold; font-size: 14px; margin-right: 10px; padding: 5px; background-color: #ddd;" data-tab="tab_basic">基本</span>
					<span style="font-weight: bold; font-size: 14px; margin-right: 10px; padding: 5px;" data-tab="tab_attr">属性</span>
					<span style="font-weight: bold; font-size: 14px; margin-right: 10px; padding: 5px;" data-tab="tab_para">参数</span>
				</div>
				<form action="<?php echo _u('///'._v(3).'/'._v(4).'/'); ?>" method="post">
					<ul style="width: auto; height: auto; border: none;" id="tab_basic">
						<li style="clear: both; margin: 0 0 5px 0; cursor: auto; height: auto; width: auto; padding-bottom: 3px;">
							<label>名称：</label>
							<input type="text" class="" style="width: 400px; height: 25px; line-height: 25px;" name="title" value="<?php echo htmlspecialchars($_['goods']['title']); ?>" />
						</li>
						<li style="clear: both; margin: 0 0 5px 0; cursor: auto; height: auto; width: auto; padding-bottom: 3px;">
							<label>分类：</label>
							<select name="category" style="width: 200px; height: 30px; line-height: 30px;">
								<option value="" data-attr="0" data-para="0">-请选择-</option>
								<?php
								foreach ($_['categories'] as $category) {
									echo '<optgroup label="'.$category['title'].'"></optgroup>';
									foreach ($category['children'] as $child) {
										echo '<option value="'.$child['id'].'"'.($_['goods']['class2']==$child['id']?' selected="selected"':'').' data-attr="'.$child['attri'].'" data-para="'.$child['para'].'">'.$child['title'].'</option>';
									}
								}
								?>
							</select>
						</li>
						<li style="clear: both; margin: 0 0 5px 0; cursor: auto; height: auto; width: auto; padding-bottom: 3px;">
							<label>货号：</label>
							<input type="text" class="" style="width: 100px; height: 25px; line-height: 25px;" name="number" value="<?php echo $_['goods']['number']; ?>" />
						</li>
						<li style="clear: both; margin: 0 0 5px 0; cursor: auto; height: auto; width: auto; padding-bottom: 3px;">
							<label>单价：</label>
							<input type="text" class="" style="width: 50px; height: 25px; line-height: 25px;" name="mark" value="<?php echo _rmb($_['goods']['mark']/100); ?>" />
						</li>
						<li style="clear: both; margin: 0 0 5px 0; cursor: auto; height: auto; width: auto; padding-bottom: 3px;">
							<label>库存：</label>
							<input type="text" class="" style="width: 50px; height: 25px; line-height: 25px;" name="stock" value="<?php echo _int($_['goods']['stock']); ?>" />
						</li>
						<li style="clear: both; margin: 0 0 5px 0; cursor: auto; height: auto; width: auto; padding-bottom: 3px; padding-top: 3px;">
							<label>图片：</label>
							<?php
							if (is_file(DIR . $_['goods']['img'])) {
								echo '<a href="" data-toggle="upload-image"><img src="'._resize($_['goods']['img'], 60, 60).'" style="border: 1px solid #ededed; margin-right: 3px;" /></a><input type="hidden" name="goods_image" value="'.$_['goods']['img'].'" />';
							} else {
								echo '<a href="" data-toggle="upload-image"><img src="'._resize(_img('nopic.gif'), 60, 60).'" style="border: 1px solid #ededed; margin-right: 3px;" /></a><input type="hidden" name="goods_image" value="" />';
							}
							if (is_file(DIR . $_['goods']['img1'])) {
								echo '<a href="" data-toggle="upload-image"><img src="'._resize($_['goods']['img1'], 60, 60).'" style="border: 1px solid #ededed; margin-right: 3px;" /></a><input type="hidden" name="goods_image1" value="'.$_['goods']['img1'].'" />';
							} else {
								echo '<a href="" data-toggle="upload-image"><img src="'._resize(_img('nopic.gif'), 60, 60).'" style="border: 1px solid #ededed; margin-right: 3px;" /></a><input type="hidden" name="goods_image1" value="" />';
							}
							if (is_file(DIR . $_['goods']['img2'])) {
								echo '<a href="" data-toggle="upload-image"><img src="'._resize($_['goods']['img2'], 60, 60).'" style="border: 1px solid #ededed; margin-right: 3px;" /></a><input type="hidden" name="goods_image2" value="'.$_['goods']['img2'].'" />';
							} else {
								echo '<a href="" data-toggle="upload-image"><img src="'._resize(_img('nopic.gif'), 60, 60).'" style="border: 1px solid #ededed; margin-right: 3px;" /></a><input type="hidden" name="goods_image2" value="" />';
							}
							if (is_file(DIR . $_['goods']['img3'])) {
								echo '<a href="" data-toggle="upload-image"><img src="'._resize($_['goods']['img3'], 60, 60).'" style="border: 1px solid #ededed; margin-right: 3px;" /></a><input type="hidden" name="goods_image3" value="'.$_['goods']['img3'].'" />';
							} else {
								echo '<a href="" data-toggle="upload-image"><img src="'._resize(_img('nopic.gif'), 60, 60).'" style="border: 1px solid #ededed; margin-right: 3px;" /></a><input type="hidden" name="goods_image3" value="" />';
							}
							if (is_file(DIR . $_['goods']['img4'])) {
								echo '<a href="" data-toggle="upload-image"><img src="'._resize($_['goods']['img4'], 60, 60).'" style="border: 1px solid #ededed; margin-right: 3px;" /></a><input type="hidden" name="goods_image4" value="'.$_['goods']['img4'].'" />';
							} else {
								echo '<a href="" data-toggle="upload-image"><img src="'._resize(_img('nopic.gif'), 60, 60).'" style="border: 1px solid #ededed; margin-right: 3px;" /></a><input type="hidden" name="goods_image4" value="" />';
							}
							?>
						</li>
						<li style="clear: both; margin: 0 0 5px 0; cursor: auto; height: auto; width: auto; padding-bottom: 3px;">
							<label>状态：</label>
							<?php
							foreach ($_['state'] as $k => $state) {
								echo '<input type="radio" name="state" value="'.$k.'"'.($_['goods']['state']==$k?' checked="checked"':'').' />'.$state.'&nbsp;&nbsp;';
							}
							?>
						</li>
						<li style="clear: both; margin: 0 0 5px 0; cursor: auto; height: auto; width: auto; padding-bottom: 5px;">
							<label>描述：</label>
							<textarea rows="" cols="" name="desc" id="editor-desc"><?php echo $_['goods']['content']; ?></textarea>
						</li>

					</ul>

					<ul style="width: auto; height: auto; border: none; display: none;" id="tab_attr">
						<li style="clear: both; margin: 0 0 5px 0; cursor: auto; height: auto; width: 913px; padding-bottom: 3px; background-color: #fff;" id="goods_attr_custom">
							<label style="float: left;">自定义：</label>
							<p style="float: left; padding-top: 5px;">
							<input type="text" class="" style="width: 100px; height: 25px; line-height: 25px;" name="attr_custom" value="" placeholder="属性名称" /><input type="button" style="width: 40px; height: 29px; margin-left: 5px;" name="btn-attr-add" value="添加" />
							</p>
						</li>
					</ul>

					<ul style="width: auto; height: auto; border: none; display: none;" id="tab_para">
						<li style="clear: both; margin: 0 0 5px 0; cursor: auto; height: auto; width: 913px; padding-bottom: 3px;" class="goods-para-custom">
							<label style="float: left; width: 10%; text-align: right;">自定义：</label>
							<p style="float: left; padding-left: 10px; padding-top: 5px;">
							<input type="text" style="width: 100px; height: 25px; line-height: 25px;" name="value_custom" value="" placeholder="参数名称" /><input type="button" name="btn-value-add" style="width: 40px; height: 29px; margin-left: 5px;" value="添加" onclick="add_custom_para(this)" />
							</p>
						</li>
					</ul>

					<a href="" class="return-btn" id="button-submit" style="clear: both; width: 80px;">
						确认提交
					</a>
				</form>

			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var _attributes = <?php echo json_encode($_['goods_attributes']); ?>;
	var _params = <?php echo json_encode($_['goods_params']); ?>;
	var _goods_attr = <?php echo isset($_['goods']['attr']) ? json_encode($_['goods']['attr']) : '[]'; ?>;
	var _goods_para = <?php echo isset($_['goods']['para']) ? json_encode($_['goods']['para']) : '[]'; ?>;

	<?php if (isset($_['goods']['attr']) && !empty($_['goods']['attr'])) { ?>
	$(document).ready(function(){
		$('select[name="category"]').trigger('change');
	});
	<?php } ?>

	$(document).delegate('input[name="checkbox_all"]', 'click', function() {
		$('input[name^="checkbox_"]').prop('checked', $(this).prop('checked'));
	});

	$(document).delegate('span[data-tab^="tab_"]', 'click', function() {
		var _tab = $(this).data('tab');
		$('span[data-tab^="tab_"]').css('background-color', '#fff');
		$(this).css('background-color', '#ddd');
		$('ul[id^="tab_"]').hide();
		$('ul#'+_tab).show();
	});

	$('select[name="category"]').on('change', function(){
		//if ($(this).val() == '' || $(this).find('option:selected').data('attr') == '0' || $(this).find('option:selected').data('attr') == '') return false;
		var _html = '';
		if (_attributes[$(this).find('option:selected').data('attr')]) {
			var _attr = _attributes[$(this).find('option:selected').data('attr')];
			for (var _i=0; _i<_attr['children'].length; _i++) {
				_html += '<li style="clear: both; margin: 0 0 5px 0; cursor: auto; height: auto; width: 913px; padding-bottom: 3px;" class="goods-attr-select">';
				_html += '<label>'+_attr['children'][_i]['title']+'：</label>';
				_html += '<p>';
				var _child = _attr['children'][_i]['content'].split(',');
				for (var _ii=0; _ii<_child.length; _ii++) {
					var _checked = '';
					var _stock = 9999;
					for (var j=0; j<_goods_attr.length; j++) {
						if (_goods_attr[j]['wname'] == _attr['children'][_i]['title']) {
							if (_goods_attr[j]['model'] == _child[_ii]) {
								_checked = ' checked="true"';
								_stock = _goods_attr[j]['stock'];
								break;
							}
						}
					}
					_html += '<input type="checkbox" name="attributes['+_attr['children'][_i]['id']+']['+_ii+'][name]" value="'+_child[_ii]+'" id="goods_attr_'+_attr['children'][_i]['id']+'_'+_ii+'"'+_checked+' data-stock="'+_stock+'" />';
					_html += '<label style="margin-right: 10px; font-weight: normal;" for="goods_attr_'+_attr['children'][_i]['id']+'_'+_ii+'">'+_child[_ii]+'</label>';
				}


				var _ii = _child.length;
				var _str = ','+_attr['children'][_i]['content']+',';
				for (var j=0; j<_goods_attr.length; j++) {
					if (_goods_attr[j]['wname'] == _attr['children'][_i]['title']) {
						if (_str.indexOf(','+_goods_attr[j]['model']+',') == -1) {
							_html += '<input type="checkbox" name="attributes['+_attr['children'][_i]['id']+']['+_ii+'][name]" value="'+_goods_attr[j]['model']+'" id="goods_attr_'+_attr['children'][_i]['id']+'_'+_ii+'" data-stock="'+_goods_attr[j]['stock']+'" checked="true" />';
							_html += '<label style="margin-right: 10px; font-weight: normal;" for="goods_attr_'+_attr['children'][_i]['id']+'_'+_ii+'">'+_goods_attr[j]['model']+'</label>';
							_ii++;
						}
						_goods_attr[j]['sys'] = true;
					}
				}

				_html += '</p><label>自定义：<input type="text" style="width: 100px; height: 25px; line-height: 25px;" name="value_custom" value="" placeholder="'+_attr['children'][_i]['title']+'" /><input type="button" name="btn-value-add" style="width: 40px; height: 29px; margin-left: 5px;" value="添加" onclick="add_system_value(this, '+_attr['children'][_i]['id']+')" /></label><p id="select_attr_'+_attr['children'][_i]['id']+'"></p></li>';
			}
		}

		//custom attribute
		var _html1 = '';
		var _custom = '';
		var _cid = -1;
		var _ii = 0;
		for (var j=0; j<_goods_attr.length; j++) {
			if (!_goods_attr[j]['sys']) {
				if (_goods_attr[j]['wname'] != _custom) {
					if (_custom != '') {
						_html1 += '</p><label>自定义：<input type="text" style="width: 100px; height: 25px; line-height: 25px;" name="value_custom" value="" placeholder="'+_custom+'" /><input type="button" name="btn-value-add" style="width: 40px; height: 29px; margin-left: 5px;" value="添加" onclick="add_system_value(this, \'c'+_cid+'\')" /></label><p id="select_attr_c'+_cid+'"></p></li>';
					}
					_custom = _goods_attr[j]['wname'];
					_cid++;
					_ii=0;
					_html1 += '<li style="clear: both; margin: 0 0 5px 0; cursor: auto; height: auto; width: 913px; padding-bottom: 3px;" class="goods-attr-custom">';
					_html1 += '<input type="hidden" name="custom_attr[c'+_cid+']" value="'+_goods_attr[j]['wname']+'" />';
					_html1 += '<label>'+_goods_attr[j]['wname']+'：</label>';
					_html1 += '<p>';
				}
				_html1 += '<input type="checkbox" name="attributes[c'+_cid+']['+_ii+'][name]" value="'+_goods_attr[j]['model']+'" id="goods_attr_c'+_cid+'_'+_ii+'" data-stock="'+_goods_attr[j]['stock']+'" checked="true" />';
				_html1 += '<label style="margin-right: 10px; font-weight: normal;" for="goods_attr_c'+_cid+'_'+_ii+'">'+_goods_attr[j]['model']+'</label>';
				_ii++;
			}
		}
		if (_cid > -1) {
			_html1 += '</p><label>自定义：<input type="text" style="width: 100px; height: 25px; line-height: 25px;" name="value_custom" value="" placeholder="'+_custom+'" /><input type="button" name="btn-value-add" style="width: 40px; height: 29px; margin-left: 5px;" value="添加" onclick="add_system_value(this, \'c'+_cid+'\')" /></label><p id="select_attr_c'+_cid+'"></p></li>';
		}

		$('ul#tab_attr li.goods-attr-select').remove();
		$('ul#tab_attr').append(_html);
		$('#goods_attr_custom').after(_html1);

		$('input[type="checkbox"]:checked').each(function(e,b){
			$(this).trigger('click');
			$(this).prop('checked', true);
		});

		_html = '';
		if (_params[$(this).find('option:selected').data('para')]) {
			var _para = _params[$(this).find('option:selected').data('para')];
			var _exist = ',';
			for (var _i=0; _i<_para['children'].length; _i++) {
				var _value = '';
				for (var j=0; j<_goods_para.length; j++) {
					if (_goods_para[j]['paraname'] == _para['children'][_i]['title']) {
						_value = _goods_para[j]['value'];
						_exist += _goods_para[j]['paraname'] + ',';
					}
				}
				_html += '<li style="clear: both; margin: 0 0 5px 0; cursor: auto; height: auto; width: 913px; padding-bottom: 3px;" class="goods-para-select">';
				_html += '<label style="float: left; width: 10%; text-align: right;">'+_para['children'][_i]['title']+'：</label>';
				_html += '<p style="float: left; width: 85%; padding-left: 10px; padding-top: 5px;">';
				_html += '<input type="text" class="" style="width: 50%; height: 25px; line-height: 25px;" name="params['+_i+'][value]" value="'+_value+'" placeholder="参数值" />';
				_html += '<input type="hidden" name="params['+_i+'][name]" value="'+_para['children'][_i]['title']+'" />';
				_html += '</p></li>';
			}

			var _i = _para['children'].length;
			for (var j=0; j<_goods_para.length; j++) {
				if (_exist.indexOf(','+_goods_para[j]['paraname']+',') == -1) {
					_html += '<li style="clear: both; margin: 0 0 5px 0; cursor: auto; height: auto; width: 913px; padding-bottom: 3px;" class="goods-para-select">';
					_html += '<label style="float: left; width: 10%; text-align: right;">'+_goods_para[j]['paraname']+'：</label>';
					_html += '<p style="float: left; width: 85%; padding-left: 10px; padding-top: 5px;">';
					_html += '<input type="text" class="" style="width: 50%; height: 25px; line-height: 25px;" name="params['+_i+'][value]" value="'+_goods_para[j]['value']+'" placeholder="参数值" />';
					_html += '<input type="hidden" name="params['+_i+'][name]" value="'+_goods_para[j]['paraname']+'" />';
					_html += '</p></li>';
					_i++;
				}
			}
		}

		$('ul#tab_para li.goods-para-select').remove();
		$('ul#tab_para li.goods-para-custom').before(_html);

	});

	$('input[type="checkbox"]').live('click', function(){
		var _data = $(this).attr('id').split('_');
		var _sid = $(this).attr('id').replace('goods', 'stock');
		var _stock = $(this).data('stock');
		if ($(this).prop('checked')) {
			if ($('#select_attr_'+_data[2]).find('input[id="'+_sid+'"]').length == 0) {
				var _html = '<label for="'+_sid+'">'+$(this).next('label').html()+'：</label>';
				_html += '<input type="text" style="width: 50px; height: 25px; line-height: 25px; margin-right: 10px;" name="attributes['+_data[2]+']['+_data[3]+'][stock]" value="'+_stock+'" id="'+_sid+'" title="库存" placeholder="库存" />';
				$('#select_attr_'+_data[2]).append(_html);
				$('#select_attr_'+_data[2]).find('input[id="'+_sid+'"]').focus();
			}
		} else {
			if ($('#select_attr_'+_data[2]).find('input[id="'+_sid+'"]').length > 0) {
				$('#select_attr_'+_data[2]).find('input[id="'+_sid+'"]').prev('label').remove();
				$('#select_attr_'+_data[2]).find('input[id="'+_sid+'"]').remove();
			}
		}
	});

	$('input[name="btn-attr-add"]').on('click', function(){
		$('input[name="attr_custom"]').val($('input[name="attr_custom"]').val().replace(/(^\s*)|(\s*$)/g,""));
		if ($('input[name="attr_custom"]').val() == '') {
			$('input[name="attr_custom"]').focus();
			return false;
		}

		var _exist = false;
		$('input[name^="custom_attr"]').each(function(){
			if ($(this).val().toLowerCase() == $('input[name="attr_custom"]').val().toLowerCase()) {
				_exist = true;
				return false;
			}
		});

		if (!_exist) {
			var _attr = _attributes[$('select[name="category"]').find('option:selected').data('attr')];
			if (_attr) {
				for (var _i=0; _i<_attr['children'].length; _i++) {
					if (_attr['children'][_i]['title'].toLowerCase() == $('input[name="attr_custom"]').val().toLowerCase()) {
						_exist = true;
						break;
					}
				}
			}
		}

		if (_exist) {
			$('input[name="attr_custom"]').val('');
			$('input[name="attr_custom"]').focus();
			return false;
		}

		var _id = 'c' + $('ul#tab_attr li.goods-attr-custom').length;
		var _html = '<li style="clear: both; margin: 0 0 5px 0; cursor: auto; height: auto; width: 913px; padding-bottom: 3px;" class="goods-attr-custom">';
		_html += '<input type="hidden" name="custom_attr['+_id+']" value="'+$('input[name="attr_custom"]').val()+'" />';
		_html += '	<label>'+$('input[name="attr_custom"]').val()+'：</label>';
		_html += '	<p></p><label>';
		_html += '		自定义：<input type="text" class="" style="width: 80px; height: 25px; line-height: 25px;" name="value_custom" value="" placeholder="'+$('input[name="attr_custom"]').val()+'" />';
		_html += '		<input type="button" style="width: 40px; height: 29px; margin-left: 5px;" name="btn-value-add" value="添加" onclick="add_system_value(this, \''+_id+'\')" />';
		_html += '	</label>';
		//_html += '	<label>已选：</label>';
		_html += '	<p id="select_attr_'+_id+'"></p>';
		_html += '</li>';
		$('#goods_attr_custom').after(_html);
		$('li.goods-attr-custom input[name="value_custom"]').first().focus();
		$('input[name="attr_custom"]').val('');
	});

	function add_custom_value(obj, id) {
		$(obj).prev('input').val($(obj).prev('input').val().replace(/(^\s*)|(\s*$)/g,""));
		if ($(obj).prev('input').val() == '') return false;
		var _id = $('#select_attr_'+id).find('label').length;
		var _sid = 'custom_value_' + _id;

		var _html = '<label for="'+_sid+'">'+$(obj).prev('input').val()+'：</label><input type="text" style="width: 50px; height: 25px; line-height: 25px; margin-right: 10px;" name="attributes[custom]['+id+'][value]['+_id+'][stock]" id="'+_sid+'" value="9999" placeholder="库存" />';
		_html += '<input type="hidden" name="attributes[custom]['+id+'][value]['+_id+'][name]" value="'+$(obj).prev('input').val()+'" />';
		$('#select_attr_'+id).append(_html);
		$(obj).prev('input').val('');
	}

	function add_system_value(obj, id) {
		$(obj).prev('input').val($(obj).prev('input').val().replace(/(^\s*)|(\s*$)/g,""));
		if ($(obj).prev('input').val() == '') {
			$(obj).prev('input').focus();
			return false;
		}

		/*if ($(obj).closest('li').find('p').first().find('input[value="'+$(obj).prev('input').val()+'"]').length > 0) {
			if ($(obj).closest('li').find('p').first().find('input[value="'+$(obj).prev('input').val()+'"]').prop('checked') == false) {
				$(obj).closest('li').find('p').first().find('input[value="'+$(obj).prev('input').val()+'"]').prop('checked', true);
				$(obj).closest('li').find('p').first().find('input[value="'+$(obj).prev('input').val()+'"]').trigger('click');
				$(obj).closest('li').find('p').first().find('input[value="'+$(obj).prev('input').val()+'"]').prop('checked', true);
			}

			$(obj).prev('input').val('');
			return false;
		}*/

		var _exist = false;
		$(obj).closest('li').find('p').first().find('input[type="checkbox"]').each(function(){
			if ($(obj).prev('input').val().toLowerCase() == $(this).val().toLowerCase()) {
				if ($(this).prop('checked') == false) {
					$(this).prop('checked', true);
					$(this).trigger('click');
					$(this).prop('checked', true);
				}

				_exist = true;
				$(obj).prev('input').val('');
				return false;
			}
		});

		if (_exist) {
			$(obj).prev('input').focus();
			return false;
		}

		var _id = $(obj).closest('li').find('input[type="checkbox"]').length;
		var _html = '<input type="checkbox" name="attributes['+id+']['+_id+'][name]" value="'+$(obj).prev('input').val()+'" id="goods_attr_'+id+'_'+_id+'" data-stock="9999" />';
		_html += '<label style="margin-right: 10px; font-weight: normal;" for="goods_attr_'+id+'_'+_id+'">'+$(obj).prev('input').val()+'</label>';
		$(obj).closest('li').find('p').first().append(_html);
		$(obj).prev('input').val('');
		$('#goods_attr_'+id+'_'+_id).prop('checked', true);
		$('#goods_attr_'+id+'_'+_id).trigger('click');
		$('#goods_attr_'+id+'_'+_id).prop('checked', true);
	}

	function add_custom_para(obj) {
		if ($(obj).prev('input').val() == '') {
			$(obj).prev('input').focus();
			return false;
		}
		var _exist = false;
		$('ul#tab_para').find('input[type="hidden"]').each(function(){
			if ($(this).val() == $(obj).prev('input').val()) {
				_exist = true;
				return false;
			}
		});

		if (_exist) {
			$(obj).prev('input').val('');
			$(obj).prev('input').focus();
			return false;
		}

		if (_exist === false) {
			var _i = $('ul#tab_para').find('input[type="hidden"]').length;
			var _html = '<li style="clear: both; margin: 0 0 5px 0; cursor: auto; height: auto; width: 913px; padding-bottom: 3px;" class="goods-para-select">';
			_html += '<label style="float: left; width: 10%; text-align: right;">'+$(obj).prev('input').val()+'：</label>';
			_html += '<p style="float: left; width: 85%; padding-left: 10px; padding-top: 5px;">';
			_html += '<input type="text" class="" style="width: 50%; height: 25px; line-height: 25px;" name="params['+_i+'][value]" value="" placeholder="参数值" />';
			_html += '<input type="hidden" name="params['+_i+'][name]" value="'+$(obj).prev('input').val()+'" />';
			_html += '</p></li>';
			$('ul#tab_para li.goods-para-custom').before(_html);
			$('ul#tab_para li.goods-para-custom').prev('li').find('input[type="text"]').first().focus();
		}

		$(obj).prev('input').val('');
	}

	$(document).delegate('#button-submit', 'click', function(e) {
		e.preventDefault();
		var _form = $('#button-submit').closest('form');
		if ($(_form).find('input[name="title"]').val() == '') {
			alert('请输入商品名称！');
			$(_form).find('input[name="title"]').focus();
			return false;
		}
		if ($(_form).find('select[name="category"]').val() == '') {
			alert('请选择商品分类！');
			$(_form).find('select[name="category"]').focus();
			return false;
		}
		if ($(_form).find('input[name="number"]').val() == '') {
			alert('请输入商品货号！');
			$(_form).find('input[name="number"]').focus();
			return false;
		}
		if (isNaN($(_form).find('input[name="mark"]').val()) || $(_form).find('input[name="mark"]').val() <= 0) {
			alert('请输入正确的商品单价！');
			$(_form).find('input[name="mark"]').focus();
			return false;
		}
		if (isNaN($(_form).find('input[name="stock"]').val())) {
			alert('请输入正确的商品库存！');
			$(_form).find('input[name="stock"]').focus();
			return false;
		}
		if ($(_form).find('input[name="goods_image"]').val() == '') {
			alert('请至少上传第一张商品图片！');
			$(_form).find('input[name="goods_image"]').focus();
			return false;
		}
		$('#button-submit').closest('form').submit();
	});

	$(document).delegate('a[data-toggle=\'upload-image\']', 'click', function(e) {
		e.preventDefault();

		var _t = $(this);

		$('#form-upload').remove();

		$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="hidden" name="size" value="60x60" /><input type="file" name="file" value="" /></form>');

		$('#form-upload input[name=\'file\']').trigger('click');

		if (typeof timer != 'undefined') {
			clearInterval(timer);
		}

		timer = setInterval(function() {
			if ($('#form-upload input[name=\'file\']').val() != '') {
				clearInterval(timer);

				$.ajax({
					url: '<?php echo _u('/user/upload/'); ?>',
					type: 'post',
					dataType: 'json',
					data: new FormData($('#form-upload')[0]),
					cache: false,
					contentType: false,
					processData: false,
					beforeSend: function() {
						//$('#button-upload').prop('disabled', true);
					},
					complete: function() {
						//$('#button-upload').prop('disabled', false);
					},
					success: function(json) {
						if (json['error']) {
							alert(json['error']);
						}

						if (json['success']) {
							//alert(json['success']);
							//console.log(json['path']);
							$(_t).find('img').first().attr('src', json['thumb']);
							$(_t).next('input[type="hidden"]').val(json['path']);
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			}
		}, 500);
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