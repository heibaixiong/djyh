<?php
if(!defined('PART'))exit;
?>
<div class="toolbar">
   <div class="t-grid">
       <ul class="topnav fr">
           <li><p class="greet">您好！欢迎来到东家要货B2B购物平台！</p></li>
           <?php if (!empty($_['member'])) { ?>
           <li><a href="<?php echo _u('/person/index/')?>">个人中心</a></li>
           <?php } else { ?>
               <li><a href="<?php echo _u('/index/login/')?>">登录注册</a></li>
           <?php } ?>
           <li><a href="<?php echo _u('/person/order/')?>">我的订单</a></li>
           <li><a href="<?php echo _u('/article/index/')?>">帮助中心</a></li>
           <?php if (!empty($_['member'])) { ?>
           <li><a href="<?php echo _u('/user/out/')?>">退出</a></li>
           <?php } ?>
       </ul>
   </div>
</div>