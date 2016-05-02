<?php
if(!defined('PART'))exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
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
    <li><?php echo $_['title'];?></li>
    <li>添加分类</li>
    </ul>
    </div>    
    <div class="formbody">    
    <div class="formtitle"><span>添加分类</span></div>
    <form action="<?php _u('//add/');?>" method="post" id="form1" name="form1">
        <ul class="forminfo">
        <li><label>上级分类</label><input name="pid" type="text" class="dfinput" value="<?php echo _v(4)?_v(4):0;?>" readonly="readonly" /><i>方便查看，不能修改</i></li>
        <li><label>分类名称</label><input name="title" type="text" class="dfinput" /></li>
        <li><label>图标地址</label><input name="img" type="text" class="dfinput" /><?php echo _upload('img','form1');?></li>

                <li><label>属性</label><select name="attri">
                        <option>选择属性</option>
                        <?php
                        foreach($_['attri'] as $k=>$v){
                            echo '<option value="'.$v['id'].'">'.$v['title'].'</option>';
                        }
                        ?>
                    </select></li>
                <li><label>参数</label><select name="para">
                        <option>选择参数</option>
                        <?php
                        foreach($_['para'] as $k=>$v){
                            echo '<option value="'.$v['id'].'">'.$v['title'].'</option>';
                        }
                        ?>
                    </select></li>
                <li><label>单位</label><select name="unit">
                        <option>选择单位</option>
                        <?php
                        foreach($_['unit'] as $k=>$v){
                            echo '<option value="'.$v['id'].'">'.$v['title'].'</option>';
                        }
                        ?>
                    </select></li>

        <li><label>显示/隐藏</label><input type="radio" name="state" value="0" checked="checked" />开 <input type="radio" name="state" value="1" />关</li>
        <li><label>排序</label><input name="px" type="text" class="dfinput" value="0" /></li>
        <li><label>&nbsp;</label><input name="" id="btn" type="button" class="btn" value="确认保存"/></li>
        </ul>
    </form>
    </div>
</body>
</html>