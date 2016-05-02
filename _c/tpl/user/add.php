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
    <li>增加会员</li>
    </ul>
    </div>    
    <div class="formbody">    
    <div class="formtitle"><span>增加<?php echo $_['rank'][_v(3)]?></span></div>
    <form action="<?php echo _u('//add/');?>" method="post" id="form1">  
    <ul class="forminfo">
    <li><label>账号</label><input name="user" type="text" class="dfinput" /></li>
    <li><label>密码</label><input name="pass" type="text" class="dfinput" /></li>
    <li><label>姓名</label><input name="name" type="text" class="dfinput" /></li>
    <li><label>公司名称</label><input name="compony" type="text" class="dfinput" /></li>
    <li><label>地址</label><input name="address" type="text" class="dfinput" /></li>
    <li><label>电话</label><input name="tel" type="text" class="dfinput" /></li>
    <li><label>地区代码</label><input name="code" type="text" class="dfinput" /></li>
    <li><label>管辖地区代码</label><input name="admincode" type="text" class="dfinput" /></li>
    <li><label>销售扣点</label><input name="rate" type="text" class="dfinput" /> %</li>
    <li><label>等级</label><select name="rank">
            <?php
            foreach($_['rank'] as $k=>$v){
            	if(_v(3)==$k){
                    echo '<option value="'.$k.'" selected="selected">'.$v.'</option>';
                }else{
                    echo '<option value="'.$k.'">'.$v.'</option>';
                }
            }
            ?>
            </select></li>
    <li><label>排序</label><input name="px" type="text" class="ninput" value="0" /></li>
    <li><label>启用/禁用</label><input type="radio" name="state" value="0" />开 <input type="radio" name="state" value="1" />关</li>
    <li><label>&nbsp;</label><input name="" id="btn" type="button" class="btn" value="确认保存"/></li>
    </ul>
    </form>
    </div>
</body>
</html>