<?php
if(!defined('PART'))exit;
?>
<!--底部-->
<div class="footer">
    <div class="container" >
        <div class="row">
            <a href="#" class="visible-lg visible-md"><img class="img-responsive" src="<?php echo _img('new/footer_img.png'); ?>"></a>
            <a class="visible-sm visible-xs" href="#"><img class="img-responsive" src="<?php echo _img('new/footer_img02.png'); ?>"></a>
        </div>
    </div>
</div>
<div class="foot_box">
    <div class="container" style="margin-top:16px;">
        <div class="row ">
            <div class=" col-md-3 col-xs-12 col-lg-3 ">
                <div class="foot_box_01">
                    <a><img src="<?php echo _img('new/foot_phone.png'); ?>"></a>
                    <a style="margin-top:20px;">服务热线：<br><?php echo $_['config']['tel'];?></a>
                </div>
            </div>
            <div class="foot_box_02 visible-md visible-lg col-lg-7 col-md-7">
                <div class="row ">
                    <?php
                    foreach($_['article'] as $k=>$v){
                        ?>
                        <ul class="col-md-2">
                            <li class="current_li01"><a><?php echo $v['title'];?></a></li>
                            <?php
                            foreach($_['article'][$k]['article'] as $k0=>$v0){
                                ?>
                                <li><a href="<?php echo _u('/article/show/'.$v0['id'].'/');?>"><?php echo $v0['title'];?></a></li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
            <div class=" col-lg-2 col-xs-12 col-md-2" style="padding:0;">
                <div class="foot_box_03">
                    <p><img src="<?php echo _img('new/foot_ewm.png'); ?>"></p>
                    <p>扫一扫，关注我们</p>
                </div>
            </div>
        </div>
    </div>
</div>
