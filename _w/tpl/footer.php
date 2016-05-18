<!--尾部start-->
<footer class="aui-nav" id="aui-footer">
    <ul class="aui-bar-tab font_box">
        <li class="" id="tabbar1" >
            <a href="<?php echo _u('/index/index'); ?>">
                <span class="footer_icon01"></span>
                <p>首  页</p>
            </a>

        </li>
        <li id="tabbar2" >
            <a href="<?php echo _u('/shop/index'); ?>">
                <span class="footer_icon02"></span>
                <p>分  类</p>
            </a>

        </li>
        <li id="tabbar3" >
            <a href="<?php echo _u('/cart/index'); ?>">
                <span class="footer_icon03"></span>
                <p>购物车</p>
            </a>
        </li>
        <li id="tabbar4">
            <a href="<?php echo _u('/person/order'); ?>">
                <span class="footer_icon04"></span>
                <p>我的订单</p>
            </a>
        </li>
    </ul>
</footer>
<!--尾部end-->
<!-- 引入JS文件 -->
<?php
_js('api');
_js('jquery-1.8.2.min');
_js('swiper.min');
_js('common');
?>
<script>
    //判断用户是否登录
    function is_login(){
        var webid = '<?php echo _session("webid"); ?>',
            openid = '<?php echo _session('weixin_openid'); ?>';
        if(!webid || !openid){
            <?php
                 _session('weixin_redirect_url') ? '' : _session('weixin_redirect_url', 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
            ?>
            var url = '<?php echo _u('/index/auth');  ?>';
            openWin(url, 0);
        }else{
            return true;
        }
    }

    /* 跳转事件 */
    function openWin(url, tag) {
        rt = tag == 1 ? is_login() : true;
        if(rt === true) location.href = url;
    }

    //添加商品到购物车操作
    function addCart(id, num){
        var url = "<?php echo _u('/cart/add/'); ?>"+id+"/"+num+"/";
        $.get(url, function(data){
            var rs = $.parseJSON(data);
            //console.log(rs);
            //dialog({title:'温馨提示', buttons:['确定'], content:rs['msg']});
            tips(rs['msg']);
        });
    }
</script>