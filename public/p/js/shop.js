var public_url="a.php?p/";
$(function(){
	$('#spec-list ul li img').click(function(){
		$('#spec-n1 img').attr('src',$(this).data('image'));
	});
	$('.add').click(function(){
		var jie=$(this).siblings('.minicart_num');
		var stock=jie.attr('count');
		var num=parseInt(jie.val());
		if(num<stock){
			jie.val(num+1);
		}
	});
	$('.sub').click(function(){
		var jie=$(this).siblings('.minicart_num');
		var num=parseInt(jie.val());
		if(num>1){
			jie.val(num-1);
		}
	});
	$('.addbtn').click(function(){
		var jie=$('#goodsnum');
		var stock=jie.attr('maxnum');
		var num=parseInt(jie.val());
		if(num<stock){
			jie.val(num+1);
		}
	});
	$('.cutbtn').click(function(){
		var jie=$('#goodsnum');
		var num=parseInt(jie.val());
		if(num>1){
			jie.val(num-1);
		}
	});
	$('.buy-btn').click(function(){
		var id=parseInt($(this).attr('data'));
		var num=parseInt($(this).parent().find('.minicart_num').val());
		if(num>0){
			$.get(public_url+"cart/add/"+id+"/"+num+"/",function(data,status){
				var _result = $.parseJSON(data);
				$('#shopping-amount').html(_result['total']);
				//alert('添加成功！');
				alert(_result['msg']);
			});
		}
	});
	$('.shopBtnBox .livebuy').click(function(){
		var id=parseInt($(this).attr('data'));
		var num=parseInt($('#goodsnum').val());
		if(num>0){
			$.get(public_url+"cart/add/"+id+"/"+num+"/",function(data,status){
				var _result = $.parseJSON(data);
				$('#shopping-amount').html(_result['total']);
				//alert('添加成功！');
				alert(_result['msg']);
			});
		}
	});
});