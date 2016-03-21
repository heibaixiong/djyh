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
_js('attri');
?>
<script type="text/javascript">
$(function(){   
    $("#btn").click(function(){
        $("#form1").submit();
    });
});
</script>
<script type=text/javascript>
    function selectTag(a,b,c,d,e,f){
        $$(a).className = "selected";
        $$(b).className = "";
        $$(c).className = "";
        $$(d).style.display = "block";
        $$(e).style.display = "none";
        $$(f).style.display = "none";
    }
</script>
<?php
_editor('mess');
?>
</head>
<body>
	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li>首页</li>
    <li>商品管理</li>
    <li><?php echo $_['rs']['title'];?></li>
    <li>编辑商品</li>
    </ul>
    </div>    
    <div class="formbody">
    <div id="usual1" class="usual">
        <form action="<?php echo _u('//edit/');?>" method="post" id="form1" name="form1">
        <div class="itab">
            <ul>
            <li><a href="#tab1" id='a' class="selected" onClick="selectTag('a','b','c','tab1','tab2','tab3')">商品详情</a></li> 
            <li><a href="#tab2" id='b' onClick="selectTag('b','a','c','tab2','tab1','tab3')">商品参数</a></li>
            <li><a href="#tab3" id='c' onClick="selectTag('c','a','b','tab3','tab2','tab1')">商品属性</a></li>
            <li style="margin-left:200px;"><input name="" id="btn" type="button" class="btn" value="确认编辑"/></li> 
            </ul>
        </div>        
            <div id="tab1" class="tabson">    
                    <ul class="forminfo">
                        <li><label>商品名称<b>*</b></label><input type="hidden" value="<?php echo $_['rs']['id'];?>" name="id" /><input name="title" type="text" class="dfinput" value="<?php echo $_['rs']['title'];?>" /></li>
                        <?php
                        if(_session('adminrank')<3){
                        ?>
                        <li><label>商品分类<b>*</b></label><input type="text" name="class2" class="dfinput" value="<?php echo $_['rs']['class2'];?>" /></li>
                        <?
                        }
                        ?>
                        <li><label>商品货号<b>*</b></label><input name="number" type="text" class="dfinput" value="<?php echo $_['rs']['number'];?>" /></li>
                        <li><label><?php echo $_['config']['name'];?>价<b>*</b></label><input name="mark" type="text" class="ninput" value="<?php echo _rmb($_['rs']['mark']/100);?>" /> 元</li>
                        <?php
                        if(_session('adminrank')<3){
                        ?>
                        <li><label>仓邮费</label><input name="postage" type="text" class="ninput" value="<?php echo $_['rs']['postage'];?>" /> 元</li>
                        <li><label>推荐与否</label><input type="radio" name="recommend" value="1" /> 开 <input type="radio" name="recommend" value="1" /> 关</li>
                        <li><label>最新与否</label><input type="radio" name="new" value="1" /> 开 <input type="radio" name="new" value="1" /> 关</li>
                        <li><label>热门与否</label><input type="radio" name="hot" value="1" /> 开 <input type="radio" name="hot" value="1" /> 关</li>
                        <li><label>上架/下架</label><input type="radio" name="state" value="0" /> 上架 <input type="radio" name="state" value="1" /> 下架</li>
                        <li><label>销量</label><input name="sale" type="text" class="ninput" value="<?php echo $_['rs']['sale'];?>" /></li>
                        <li><label>库存</label><input name="stock" type="text" class="ninput" value="<?php echo $_['rs']['stock'];?>" /></li>
                        <li><label>排序</label><input name="px" type="text" class="ninput" value="<?php echo $_['rs']['px'];?>" /></li>
                        <?
                        }
                        ?>
                        <li><label>商品主图<b>*</b></label><input name="img" type="text" class="dfinput" value="<?php echo $_['rs']['img'];?>" /><?php echo _upload('img','form1');?><i>图片为jpg格式的正方形</i></li>
                        <li><label>商品侧图1</label><input name="img1" type="text" class="dfinput" value="<?php echo $_['rs']['img1'];?>" /><?php echo _upload('img1','form1');?><i>图片为jpg格式的正方形</i></li>
                        <li><label>商品侧图2</label><input name="img2" type="text" class="dfinput" value="<?php echo $_['rs']['img2'];?>" /><?php echo _upload('img2','form1');?><i>图片为jpg格式的正方形</i></li>
                        <li><label>商品侧图3</label><input name="img3" type="text" class="dfinput" value="<?php echo $_['rs']['img3'];?>" /><?php echo _upload('img3','form1');?><i>图片为jpg格式的正方形</i></li>
                        <li><label>商品侧图4</label><input name="img4" type="text" class="dfinput" value="<?php echo $_['rs']['img4'];?>" /><?php echo _upload('img4','form1');?><i>图片为jpg格式的正方形</i></li>
                        <li><label>商品介绍</label><textarea name="mess" id="mess" width="600" class="textinput"><?php echo $_['rs']['content'];?></textarea></li>
                    </ul>   
            </div>
            <div id="tab2" class="tabson" style="display:none;">
                <?php
                $para='';
                foreach($_['rs_para'] as $k=>$v){
                    $para.=$v['paraname'].'@@@'.$v['value'].'@@@';
                }
                ?>
                <ul class="forminfo" id="para" u="<?php echo $para;?>">
                    <?php
                    foreach($_['para'] as $k=>$v){
                    ?>
                    <li><label><?php echo $v['title']?><b>*</b></label><input name="paraid[]" type="hidden" class="dfinput" value="<?php echo $v['title']?>" /><input name="para[]" type="text" class="dfinput" /></li>
                    <?
                    }
                    ?>     
                </ul>
            </div>
            <div id="tab3" class="tabson" style="display:none;">
                <?php
                $attri='';
                foreach($_['rs_attri'] as $k=>$v){
                    $attri.=$v['model'].'@@@'.$v['stock'].'@@@';
                }
                ?>
                <ul class="forminfo" id="attri1" u="<?php echo $attri;?>">
                    <?php
                    foreach($_['attri'] as $k=>$v){
                        $a=explode(',',$v['content']);
                        echo '<li width=100%><span>'.$v['title'].' : </span>';
                        for($i=0;$i<count($a);$i++){                            
                    ?>
                    <input type="button" class="button" u="" value="<?php echo $a[$i];?>">
                    <?  
                        }
                        echo '</li>';
                    }
                    ?>
                </ul>
                <ul class="forminfo" id="attri2">                    
                </ul>
            </div>
        </form>
    </div> 
    </div>
</body>
</html>