<?php
if(!defined('PART'))exit;
?>
<div class="khfwleftMenu">
    <dl>
    	<dt class="khtitle">新闻中心</dt>
        <?php
        foreach($_['newsclass'] as $k=>$v){
        ?>
        <dd hurl="payinstruction" class="li active" p="J"><span class="kh9"></span><a href="<?php echo _u('/news/index/'.$v['id'].'/');?>"><?php echo $v['title'];?></a></dd>
        <?php
        }
        ?>
    </dl>
</div>