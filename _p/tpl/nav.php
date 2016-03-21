<?php
if(!defined('PART'))exit;
?>
<!-- 导航 -->
<div class="zh-nav">
    <div class="zh-nav-conter">
        <div id="newCat">
            <div id="allGoogsCat" class="all_type"><?php echo $_['config']['name'];?></div>                    
        </div>
        <ul class="zh-nav-list">
            <li class="cur"><a href="<?php echo _u('/index/index/');?>">首页</a></li>
            <li><a href="<?php echo _u('/shop/special/');?>">推荐商品</a></li>
            <li><a href="<?php echo _u('/shop/hot/');?>">热卖商品</a></li>
            <li><a href="<?php echo _u('/shop/new/');?>">最新上架</a></li>
            <li><a href="<?php echo _u('/news/');?>">新闻中心</a></li>
            <li><a href="<?php echo _u('/article/');?>">关于我们</a></li>
        </ul>
    </div>
</div>
<!--//导航-->