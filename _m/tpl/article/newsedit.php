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
_editor('mess');
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
    <li>新闻管理</li>
    <li>编辑新闻</li>
    </ul>
    </div>    
    <div class="formbody">
    <div id="usual1" class="usual">
        <form action="<?php echo _u('//newsedit/');?>" method="post" id="form1" name="form1">
            <div id="tab1" class="tabson">    
                    <ul class="forminfo">
                        <li><label>新闻标题<b>*</b></label><input name="title" type="text" class="dfinput" value="<?php echo $_['rs']['title'];?>" /><input type="hidden" value="<?php echo $_['rs']['id'];?>" name="id" /></li>
                        <li><label>分类</label><select name="classid">
				            <?php
				            foreach($_['classid'] as $k=>$v){
				            	if($_['rs']['classid']==$v['id']){
				            		echo '<option value="'.$v['id'].'" selected="selected">'.$v['title'].'</option>';
				            	}else{
				            		echo '<option value="'.$v['id'].'">'.$v['title'].'</option>';
				            	}
				            }
				            ?>
				            </select>
				        </li>
                        <li><label>配图</label><input name="img" type="text" class="dfinput" value="<?php echo $_['rs']['title'];?>" /><?php echo _upload('img','form1');?></li>
                        <li><label>新闻内容</label><textarea name="mess" id="mess" width="600" height="600" class="textinput"><?php echo $_['rs']['mess'];?></textarea></li>
                        <li><label>&nbsp;</label><input name="" id="btn" type="button" class="btn" value="确认保存"/></li>
                    </ul>   
            </div>
        </form>
    </div> 
    </div>
</body>
</html>