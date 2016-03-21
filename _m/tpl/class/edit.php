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
    <li>分类管理</li>
    <li>编辑分类</li>
    </ul>
    </div>    
    <div class="formbody">    
    <div class="formtitle"><span>编辑分类</span></div>
    <form action="<?php echo _u('//edit/');?>" method="post" id="form1">
        <ul class="forminfo">
        <li><label>上级分类</label><input name="pid" type="text" class="dfinput" value="<?php echo $_['rs']['pid'];?>" readonly="readonly" /></li>
        <li><label>分类名称</label><input name="title" type="text" class="dfinput" value="<?php echo $_['rs']['title'];?>" /><input type="hidden" value="<?php echo $_['rs']['id'];?>" name="id" /></li>
        <li><label>图标地址</label><input name="img" type="text" class="dfinput" value="<?php echo $_['rs']['img'];?>" /></li>
        <?php
        if(1==$_['rs']['rank']){
        ?>
        <li><label>属性</label><select name="attri">
                <option>选择属性</option>
                <?php
                foreach($_['attri'] as $k=>$v){
                    if($_['rs']['attri']==$v['id']){
                        echo '<option value="'.$v['id'].'" selected="selected">'.$v['title'].'</option>';
                    }else{
                        echo '<option value="'.$v['id'].'">'.$v['title'].'</option>';
                    }
                }
                ?>
                </select></li>
        <li><label>参数</label><select name="para">
                <option>选择参数</option>
                <?php
                foreach($_['para'] as $k=>$v){
                    if($_['rs']['para']==$v['id']){
                        echo '<option value="'.$v['id'].'" selected="selected">'.$v['title'].'</option>';
                    }else{
                        echo '<option value="'.$v['id'].'">'.$v['title'].'</option>';
                    }
                }
                ?>
                </select></li>
        <li><label>单位</label><select name="unit">
                <option>选择单位</option>
                <?php
                foreach($_['unit'] as $k=>$v){
                    if($_['rs']['unit']==$v['id']){
                        echo '<option value="'.$v['id'].'" selected="selected">'.$v['title'].'</option>';
                    }else{
                        echo '<option value="'.$v['id'].'">'.$v['title'].'</option>';
                    }
                }
                ?>
                </select></li>
        <?php
        }
        ?>
        <li><label>显示/隐藏</label><input type="radio" name="state" value="0" <?php if($_['rs']['state']==0)echo 'checked'?> /> 开 <input type="radio" name="state" value="1" <?php if($_['rs']['state']==1)echo 'checked'?> /> 关</li>
        <li><label>排序</label><input name="px" type="text" class="dfinput" value="<?php echo $_['rs']['px'];?>" /><i>数越大越靠前</i></li>
        <li><label>&nbsp;</label><input name="" id="btn" type="button" class="btn" value="确认编辑"/></li>
        </ul>
    </form>
    </div>
</body>
</html>