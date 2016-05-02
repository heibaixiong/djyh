<?php
if(!defined('PART'))exit;
?>
<!--对联广告-->
  <div class="adfloat posl" style="position: fixed;">
      <a href="<?php echo $_['duilian'][0]['url'];?>" target="_blank"><img src="<?php echo _resize($_['duilian'][0]['img'], 150, 450); ?>" alt="<?php echo $_['duilian'][0]['title'];?>" /></a>
  </div>
  <div class="adfloat posr" style="position: fixed;">
      <a href="<?php echo $_['duilian'][1]['url'];?>" target="_blank"><img src="<?php echo _resize($_['duilian'][1]['img'], 150, 450); ?>" alt="<?php echo $_['duilian'][1]['title'];?>" /></a>
  </div>
<!--对联广告 END-->