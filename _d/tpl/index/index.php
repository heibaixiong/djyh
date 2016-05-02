<?php
if(!defined('PART'))exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>自动定位中</title>
    <?php
    _jq();
    ?>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript"></script>
    <script type="text/javascript">

    </script>
</head>
<body>
<script type="text/javascript">
    $(window).load(function(){
        wx.config({
            debug: false,
            appId: '<?php echo $_['signPackage']["appId"];?>',
            timestamp: <?php echo $_['signPackage']["timestamp"];?>,
            nonceStr: '<?php echo $_['signPackage']["nonceStr"];?>',
            signature: '<?php echo $_['signPackage']["signature"];?>',
            jsApiList: [
                // 所有要调用的 API 都要加到这个列表中
                'checkJsApi',
                //'openLocation',
                'getLocation'
            ]
        });

        wx.ready(function() {
            //console.log('config ready.');
            //alert('<?php echo $_['openid']; ?>');
            wx.checkJsApi({
                jsApiList: [
                    'getLocation'
                ],
                success: function (res) {
                    // alert(JSON.stringify(res));
                    // alert(JSON.stringify(res.checkResult.getLocation));
                    //console.log('checkJsApi success.');
                    if (res.checkResult.getLocation == false) {
                        alert('你的微信版本太低，无法完成自动定位，请升级到最新的微信版本！');
                        window.location.href = "<?php echo _u('/index/geo/'); ?>";
                        return;
                    } else {
                        wx.getLocation({
                            type: 'wgs84',
                            success: function (res1) {
                                //console.log('getLocation success.');
                                var latitude = res1.latitude; // 纬度，浮点数，范围为90 ~ -90
                                var longitude = res1.longitude; // 经度，浮点数，范围为180 ~ -180。
                                var speed = res1.speed; // 速度，以米/每秒计
                                var accuracy = res1.accuracy; // 位置精度
                                //alert('经度：'+longitude+' 纬度：'+latitude);
                                window.location.href = "<?php echo $_['gps_redirect_url']; ?>"+longitude+"/"+latitude+"/";
                            },
                            cancel: function (res) {
                                //console.log('getLocation cancel.');
                                alert('您的设置拒绝自动获取地理位置！');
                                window.location.href = "<?php echo _u('/index/geo/'); ?>";
                            },
                            fail: function() {
                                //console.log('getLocation failed.');
                                alert('自动定位失败，转入手动定位！');
                                window.location.href = "<?php echo _u('/index/geo/'); ?>";
                            }
                        });
                    }
                },
                fail: function() {
                    //console.log('checkJsApi failed.');
                    alert('你的微信版本太低，无法完成自动定位，请升级到最新的微信版本！');
                    window.location.href = "<?php echo _u('/index/geo/'); ?>";
                }
            });

        });

        wx.error(function(res){
            //console.log('config error.');
            alert('系统定位失败，转入手动定位！');
            window.location.href = "<?php echo _u('/index/geo/'); ?>";
        });

    });

    $(document).ready(function(){
        setTimeout(function(){
            alert('系统定位超时，转入手动定位！');
            window.location.href = "<?php echo _u('/index/geo/'); ?>";
        }, 3000);
    });
</script>
<!-- 主体 -->
<div class="main-Body">
    <div class="main-content">
        <div class="main-body-w">
            <h4 class="hBorder">系统自动定位中，请稍后 ...</h4>
        </div>
    </div>
</div>
<!-- //主体 -->
</body>
</html>