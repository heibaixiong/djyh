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
_js('distpicker.data');
_js('distpicker');
?>
<script type="text/javascript">
$(function(){   
    $("#btn2").click(function(){
        $("#form2").submit();
    });
});
</script>
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
						<div class="zhjf-title">收货地址</div>
						<div class="userinfo">
							<div class="userinfo_item1">							
								<form method="post" id="form2" action="<?php echo _u('//addressedit/');?>" name="form2">
									<table cellspacing="0" cellpadding="0" border="0" class="userinfo_table">
								        <tbody>
								        <tr>
								            <th>
								                <label for="textfield">登录名称：</label>
								            </th>
								            <td>
								                <?php echo _session('webuser');?> &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo _u('//passedit/');?>" class="a-blue underline">修改登录密码</a>&nbsp;&nbsp;&nbsp;&nbsp;<a  href="<?php echo _u('//zhifupassedit/');?>" class="a-blue underline">修改支付密码</a>
								            </td>
								        </tr>								        
								        <tr>
								            <th>
								                <label for="textfield"><span class="red">*</span>收货地址：</label>
								            </th>
								            <td>
								            <div data-toggle="distpicker">
								                <select style="width: 112px;" id="pro_n" data-province="<?php echo $_['address']['pro_n']?$_['address']['pro_n']:'河南省';?>" name="pro_n" class="regSelect fl">
								                </select>
								                <select id="cit_n" data-city="<?php echo $_['address']['cit_n'];?>" name="cit_n" class="regSelect fl">
								                </select>
								                <select id="cou_n" data-district="<?php echo $_['address']['cou_n'];?>" name="cou_n" class="regSelect fl">
								                </select>
								            </div>
								            </td>
								        </tr>
								        <tr>
								            <th>&nbsp;</th>
								            <td>
								                <input type="text" class="tj-input  fl" value="<?php echo $_['address']['adr']?>" name="adr">
								            </td>
								        </tr>
								        <tr>
								            <th>&nbsp;</th>
								            <td class="regMs">此收货地址将作为<em class="c_f00">供货商为您送货的地址</em>，请仔细核对</td>
								        </tr>
								        <tr>
								            <th>
								                <label for="textfield"><span class="red">*</span>收货人：</label>
								            </th>
								            <td>
								                <input type="text" class="tj-input fl" value="<?php echo $_['address']['nam'];?>" id="Linkman" name="nam">
								                <span id="linkmanerror"></span>
								            </td>
								        </tr>
								        <tr>
								            <th>
								                <label for="textfield"><span class="red">*</span>手机号码：</label>
								            </th>
								            <td>
								                <input type="text" class="tj-input fl" value="<?php echo $_['address']['phn']?>" id="Mobile" name="phn">
								                <span id="Phoneerror"></span>
								            </td>
								        </tr>
								         <tr>
								            <th>
								                <label for="textfield"><span class="red"></span>固定电话：</label>
								            </th>
								            <td>
								                <input type="text" class="tj-input fl" id="Landline" name="tel" value="<?php echo $_['address']['tel']?>">
								                <span id="Landlineerror"></span>
								            </td>
								        </tr>
								        <tr>
								            <th height="60">&nbsp;</th>
								            <td>
								                <input type="button" class="tj-button" value="保存修改" id="btn2">
								            </td>
								        </tr>
								    </tbody>
								    </table>
								</form>
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