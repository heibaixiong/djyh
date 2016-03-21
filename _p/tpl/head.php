<?php
if(!defined('PART'))exit;
$key=explode(',',$_['config']['search']);
?>
<div class="mod-header clearfix">
   <div class="jd-logo"><a href="<?php echo _u('/index/index/');?>"></a></div>
   <div class="search-frame">
      <form action="<?php echo _u('/shop/search/');?>" method="post" id="form1" name="form1">
       <div class="searchText">
           <input type="text" value="<?php echo $key[0];?>" class="inputTxt" name="key" />
           <button>搜索</button>
       </div>
      </form>
       <div class="hotwords">
        <?php        
        foreach($key as $k=>$v){
        ?>
          <a href="<?php echo _u('/shop/search/'.urlencode($v).'/');?>" class="color-red"><?php echo $v;?></a>
        <?php
        }
        ?>
       </div>
   </div>
    <div class="shoplist"><!--滑过时添加 list-hover 样式-->
        <div class="cw-icon">
            <i class="ci-left"></i>
            <i class="ci-right"></i><i class="ci-count" id="shopping-amount"><?php echo $_['cartnum'];?></i>
            <a target="_blank" href="<?php echo _u('/cart/index/');?>">我的购物车</a>
        </div>
    </div>
</div>