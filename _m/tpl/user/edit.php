<?php
if(!defined('PART'))exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
_css('style');
_jq();
?>
<script type="text/javascript">
$(function(){   
    $("#btn").click(function(){
        $("#form1").submit();
    });
});
</script>
</head>
<body>
	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li>首页</li>
    <li>会员管理</li>
    <li>编辑会员</li>
    </ul>
    </div>    
    <div class="formbody">    
    <div class="formtitle"><span>编辑会员</span></div>
    <form action="<?php echo _u('//edit/');?>" method="post" id="form1">  
    <ul class="forminfo">
    <li><label>账号</label><input name="user" type="text" class="dfinput" value="<?php echo $_['rs']['user'];?>" /><input type="hidden" value="<?php echo $_['rs']['id'];?>" name="id" /></li>
    <li><label>密码</label><input name="pass" type="text" class="dfinput" /><i>密码不变留空</i></li>
    <li><label>姓名</label><input name="name" type="text" class="dfinput" value="<?php echo $_['rs']['name'];?>" /></li>
    <li><label>公司名称</label><input name="compony" type="text" class="dfinput" value="<?php echo $_['rs']['compony'];?>" /></li>
        <li>
            <label>相关证照</label>
            <?php if (!empty($_['company']['shop_image'])) echo '<a href="'.$_['company']['shop_image'].'" target="_blank"><img src="'._resize($_['company']['shop_image'], 60, 60).'" /></a>';?>
            <?php if (!empty($_['company']['business_image'])) echo '<a href="'.$_['company']['business_image'].'" target="_blank"><img src="'._resize($_['company']['business_image'], 60, 60).'" /></a>';?>
            <?php if (!empty($_['company']['tax_image'])) echo '<a href="'.$_['company']['tax_image'].'" target="_blank"><img src="'._resize($_['company']['tax_image'], 60, 60).'" /></a>';?>
            <?php if (!empty($_['company']['id_image'])) echo '<a href="'.$_['company']['id_image'].'" target="_blank"><img src="'._resize($_['company']['id_image'], 60, 60).'" /></a>';?>
        </li>
    <li><label>地址</label><input name="address" type="text" class="dfinput" value="<?php echo $_['rs']['address'];?>" /></li>
    <li><label>电话</label><input name="tel" type="text" class="dfinput" value="<?php echo $_['rs']['tel'];?>" /></li>
    <li><label>地区代码</label><input name="code" type="text" class="dfinput" value="<?php echo $_['rs']['code'];?>" /></li>
    <li><label>管辖地区代码</label><input name="admincode" type="text" class="dfinput" value="<?php echo $_['rs']['admincode'];?>" /></li>
    <li><label>销售扣点</label><input name="rate" type="text" class="dfinput" value="<?php echo $_['rs']['rate'];?>" /> %</li>
    <li><label>等级</label><select name="rank">
            <?php
            foreach($_['rank'] as $k=>$v){
                if($_['rs']['rank']==$k){
                    echo '<option value="'.$k.'" selected="selected">'.$v.'</option>';
                }else{
                    echo '<option value="'.$k.'">'.$v.'</option>';
                }
            }
            ?>
            </select></li>
    <li><label>排序</label><input name="px" type="text" class="ninput" value="<?php echo $_['rs']['px'];?>" /></li>
    <li><label>启用/关闭</label><input type="radio" name="state" value="0" <?php if($_['rs']['state']==0)echo 'checked'?> /> 开 <input type="radio" name="state" value="1" <?php if($_['rs']['state']==1)echo 'checked'?> /> 关</li>
    <li><label>&nbsp;</label><input name="" id="btn" type="button" class="btn" value="确认保存"/></li>
    </ul>
    </form>
    </div>
</body>
</html>