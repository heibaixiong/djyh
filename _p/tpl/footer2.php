<?php
if(!defined('PART'))exit;
?>

<div class="mod-help clearfix">
      <div class="hotline">
          <h4>服务热线：<br/><?php echo $_['config']['tel'];?></h4>
      </div>
      <?php
      foreach($_['article'] as $k=>$v){
      ?>
      <div class="mod-help-item">
          <h5><?php echo $v['title'];?></h5>
          <ul>
            <?php
            foreach($_['article'][$k]['article'] as $k0=>$v0){
            ?>
            <li><a href="<?php echo _u('/article/show/'.$v0['id'].'/');?>"><?php echo $v0['title'];?></a></li>
            <?php
            }
            ?>
          </ul>
      </div>
      <?php
      }
      ?>
</div>
</div>