<!--尾部start-->
<footer class="aui-nav" id="aui-footer">
    <ul class="aui-bar-tab font_box">
        <li class="" id="tabbar1" >
            <a href="<?php echo _u('/index/index'); ?>">
                <span class="footer_icon01 <?php if(isset($_['foot_nav']) && $_['foot_nav'] == 1) echo 'footer_bh01'; ?>"></span>
                <p <?php if(isset($_['foot_nav']) && $_['foot_nav'] == 1) echo 'style="color:rgb(255, 0, 0)"'; ?>>首  页</p>
            </a>

        </li>
        <li id="tabbar2" >
            <a href="<?php echo _u('/shop/index'); ?>">
                <span class="footer_icon02 <?php if(isset($_['foot_nav']) && $_['foot_nav'] == 2) echo 'footer_bh02'; ?>"></span>
                <p <?php if(isset($_['foot_nav']) && $_['foot_nav'] == 2) echo 'style="color:rgb(255, 0, 0)"'; ?>>分  类</p>
            </a>

        </li>
        <li id="tabbar3" >
            <a href="<?php echo _u('/cart/index'); ?>">
                <span class="footer_icon03 <?php if(isset($_['foot_nav']) && $_['foot_nav'] == 3) echo 'footer_bh03'; ?>"></span>
                <p <?php if(isset($_['foot_nav']) && $_['foot_nav'] == 3) echo 'style="color:rgb(255, 0, 0)"'; ?>>购物车</p>
            </a>
        </li>
        <li id="tabbar4">
            <a href="<?php echo _u('/person/order'); ?>">
                <span class="footer_icon04 <?php if(isset($_['foot_nav']) && $_['foot_nav'] == 4) echo 'footer_bh04'; ?>"></span>
                <p <?php if(isset($_['foot_nav']) && $_['foot_nav'] == 4) echo 'style="color:rgb(255, 0, 0)"'; ?>>我的订单</p>
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
                 _session('weixin_redirect_url') ? '' : _session('weixin_redirect_url', 'http://'.$_SERVER['HTTP_HOST'].'?'.$_SERVER['REQUEST_URI']);
            ?>
            var url = '<?php echo 'http://'.$_SERVER['HTTP_HOST'] . '/callback/wxpay_openid/index.php';  ?>';
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

    //goods search event
    $(document).delegate(".good-search", 'click', function(){
        searchGoods();
    });
    function searchGoods(){
        var keyword = $("#search-input").val();
        var url = "<?php echo _u('/shop/index/0/1/0'); ?>";
        url += '/'+keyword;
        console.log(url);
        openWin(url, 0);
    }
</script>
