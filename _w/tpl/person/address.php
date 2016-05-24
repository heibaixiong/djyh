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
	_css('store_adres');
	?>
</head>

<body>
<!--头部-->
<header class="aui-nav aui-bar aui-bar-nav aui-bar-dark" id="top_nav">

	<a class="aui-pull-left">
		<span class="aui-iconfont aui-icon-left"></span>
	</a>
	<div class="aui-title">修改收货地址</div>
	<a class="aui-pull-right">
		<span></span>
	</a>
</header>
<div style="position: absolute;top: 50px;bottom: 55px;overflow-y: scroll;-webkit-overflow-scrolling: touch; width:100%; ">
	<!--main-->
	<div class="big_main">
		<form>
			<ul class="adres_box">
				<li class="clearFloat" style="overflow: inherit;">
					<a class="adres_title">收货地址<em>*</em></a>
					<div class="adress_big " data-toggle="distpicker">
						<select id="pro_n" data-province="<?php echo $_['address']['pro_n'] ? $_['address']['pro_n'] : '河南省' ; ?>" name="pro_n" style="width:30%;padding:5px;">
						</select>
						<select id="cit_n" data-city="<?php echo $_['address']['cit_n']; ?>" name="cit_n" style="width:30%;padding:5px;">
						</select>
						<select id="cou_n" data-district="<?php echo $_['address']['cou_n']; ?>" name="cou_n" style="width:30%;padding:5px;">
						</select>

					</div>

				</li>
				<li>
					<a class="adres_title">详细地址<em>*</em></a>
					<div class="deres_detal">
						<input type="text" name="adr" value="<?php echo $_['address']['adr']; ?>">
						<p>收货地址为<span>供货商送货</span>的地址，请仔细核对</p>
					</div>
				</li>
				<li>
					<a class="adres_title">收货人<em>*</em></a>
					<div class="deres_detal">
						<input type="text" name="nam" value="<?php echo $_['address']['nam']; ?>">
					</div>
				</li>
				<li>
					<a class="adres_title">手机号码<em>*</em></a>
					<div class="deres_detal">
						<input type="tel" name="phn" value="<?php echo $_['address']['phn']; ?>">
					</div>
				</li>
				<li>
					<a class="adres_title">固定电话<em style=" visibility: hidden;">*</em></a>
					<div class="deres_detal">
						<input type="tel" name="tel" value="<?php echo $_['address']['tel']; ?>">
					</div>
				</li>
				<li class="adres_bc">保存</li>
			</ul>
		</form>
	</div>
</div>

<?php
_part('footer');
_js('distpicker.data');
_js('distpicker');
?>
<script>
	$(".adres_bc").click(function(){
		var pro_n = $("input[name='pro_n']").val();
		if(pro_n == ''){
			alert('请选择省份');
			return false;
		}
		var adr = $("input[name='adr']").val();
		if(adr == ''){
			alert('请输入详细地址');
			return false;
		}
		var nam = $("input[name='nam']").val();
		if(nam == ''){
			alert('请输入收货人姓名');
			return false;
		}
		var phn = $("input[name='phn']").val();
		if(phn == ''){
			alert('请输入收货人电话');
			return false;
		}
		var url = "<?php echo _u('/person/addressedit'); ?>";
		$.post(url, $("form").serialize(), function(data){
			console.log(data);
			//return false;
			alert(data['errMsg']);
			if(data['errCode'] == 0){
				history.go(-1);
			}
		});
		//console.log($("form").serialize());
	});
</script>
</body>
</html>
