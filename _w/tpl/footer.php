<!--尾部start-->
<footer class="aui-nav" id="aui-footer">
    <ul class="aui-bar-tab font_box">
        <li class="" id="tabbar1" >
            <a onclick="openWin('<?php echo _u('/index/index'); ?>', 0)">
                <span class="footer_icon01"></span>
                <p>首  页</p>
            </a>

        </li>
        <li id="tabbar2" >
            <a onclick="openWin('<?php echo _u('/shop/index'); ?>', 0)">
                <span class="footer_icon02"></span>
                <p>分  类</p>
            </a>

        </li>
        <li id="tabbar3" >
            <a onclick="openWin('<?php echo _u('/cart/index'); ?>', 1)">
                <span class="footer_icon03"></span>
                <p>购物车</p>
            </a>
        </li>
        <li id="tabbar4">
            <a href="#">
                <span class="footer_icon04"></span>
                <p>个人中心</p>
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
        var webid = '<?php echo _session("webid"); ?>';
        if(!webid){
            dialog({title:'温馨提示', content:'您还没有登录，是否立即登录？', buttons:['立即登录', '稍后再说']}, function(opt){
                if(opt == 1){
                    var url = '<?php echo _u('/index/login');  ?>';
                    openWin(url, 0);
                }else{
                    return false;
                }
            });
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
            dialog({title:'温馨提示', buttons:['确定'], content:rs['msg']});
        });
    }
</script>
