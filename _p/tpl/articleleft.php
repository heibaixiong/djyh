<?php
if(!defined('PART'))exit;
?>
<div class="khfwleftMenu">
  <?php
  foreach($_['article'] as $k=>$v){
  ?>
    <dl>
        <dt class="khtitle"><?php echo $v['title'];?></dt>
        <?php
        foreach($_['article'][$k]['article'] as $k0=>$v0){
        ?>
        <dd hurl="payinstruction" class="li active" p="J"><span class="kh9"></span><a href="<?php echo _u('/article/show/'.$v0['id'].'/');?>"><?php echo $v0['title'];?></a></dd>
        <?php
        }
        ?>
    </dl>
    <?php
    }
    ?>
</div>