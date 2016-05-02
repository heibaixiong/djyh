<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
        body, html,#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;font-family:"微软雅黑";}
    </style>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=dt0euriXB1EXVHOqWMGLvGVZgVDYtWWx"></script>
    <title>选择位置</title>
    <?php
    _js('jquery');
    //_css('base');
    //_css('rob_page');
    ?>
</head>
<body>
<!-- 顶部-->
<!--
<div class="dev_top">
    <div class="dev_top_list">
        <a href="<?php echo _u('/ship/list/'); ?>"></a>
    </div>
    <a class="dev_tittle">
        查看位置
    </a>
    <a class="dev_order" href="<?php echo _u('/order/manage/'); ?>">管理订单</a>
</div>
-->
<div id="allmap"></div>
</body>
</html>
<script type="text/javascript">
    // 百度地图API功能
    var map = new BMap.Map("allmap",{minZoom:4,maxZoom:25,enableMapClick:false});
    var auto_point = new BMap.Point(116.331398, 39.897445);
    //map.centerAndZoom('郑州市', 12);

    /*var myCity = new BMap.LocalCity();
    myCity.get(function(res){
        var cityName = res.name;
        map.setCenter(cityName);
        //alert("当前定位城市:"+cityName);
    });*/

    map.enableScrollWheelZoom(true);
    map.enableInertialDragging();

    map.enableContinuousZoom();

    var geoc = new BMap.Geocoder();

    <?php if (_v(3) && _v(4)) { ?>
    //坐标转换完之后的回调函数
    var translateCallback = function (data){
        if(data.status === 0) {
            auto_point = data.points[0];
            map.centerAndZoom(data.points[0], 15);
            var marker = new BMap.Marker(data.points[0]);
            map.clearOverlays();
            map.addOverlay(marker);
            map.panTo(data.points[0]);
            //alert('您的位置：'+r.point.lng+','+r.point.lat);
            geoc.getLocation(data.points[0], function(rs){
                var addComp = rs.addressComponents;
                var address = addComp.province + ", " + addComp.city + ", " + addComp.district + ", " + addComp.street + ", " + addComp.streetNumber;
                address = address.replace(/^(, )+|(, )+$/g,'');
                //var label = new BMap.Label(address,{offset:new BMap.Size(20,-10)});
                //mk.setLabel(label);
                var sContent = "当前位置：<br/>" + address + "<br/><input type='button' value='选择' data-lng='"+ data.points[0].lng+"' data-lat='"+ data.points[0].lat+"' data-address='"+address+"' onclick='geo_select(this)' />";
                var infoWindow = new BMap.InfoWindow(sContent);
                marker.openInfoWindow(infoWindow);
                marker.addEventListener("click", function(){
                    this.openInfoWindow(infoWindow);
                });
                //alert(addComp.province + ", " + addComp.city + ", " + addComp.district + ", " + addComp.street + ", " + addComp.streetNumber);
            });

            /*var _mk = [];
            for (var i=1; i<data.points.length; i++) {
                _mk[i] = new BMap.Marker(data.points[i]);
                //map.clearOverlays();
                map.addOverlay(_mk[i]);
                var _distance = map.getDistance(auto_point, data.points[i]).toFixed(0);
                console.log(_distance);
            }*/

            $('#allmap').show();
            //map.centerAndZoom(data.points[0], 15);
        } else {
            map.centerAndZoom('郑州市', 12);
        }
    }
    var x = <?php echo _v(3); ?>;
    var y = <?php echo _v(4); ?>;
    var ggPoint = new BMap.Point(x,y);
    var convertor = new BMap.Convertor();
    var pointArr = [];
    pointArr.push(ggPoint);

    <?php foreach($_['squares'] as $k => $square) { ?>
    //pointArr.push(new BMap.Point(<?php echo $square['lng']; ?>, <?php echo $square['lat']; ?>));
    <?php } ?>

    convertor.translate(pointArr, 1, 5, translateCallback);
    <?php } else { ?>
    var geolocation = new BMap.Geolocation();
    geolocation.getCurrentPosition(function(r){
        if(this.getStatus() == BMAP_STATUS_SUCCESS){
            auto_point = r.point;
            map.centerAndZoom(r.point, 15);
            map.clearOverlays();
            var mk = new BMap.Marker(r.point);
            map.addOverlay(mk);
            map.panTo(r.point);
            //alert('您的位置：'+r.point.lng+','+r.point.lat);
            geoc.getLocation(r.point, function(rs){
                var addComp = rs.addressComponents;
                var address = addComp.province + ", " + addComp.city + ", " + addComp.district + ", " + addComp.street + ", " + addComp.streetNumber;
                address = address.replace(/^(, )+|(, )+$/g,'');
                //var label = new BMap.Label(address,{offset:new BMap.Size(20,-10)});
                //mk.setLabel(label);
                var sContent = "当前位置：<br/>" + address + "<br/><input type='button' value='选择' data-lng='"+ r.point.lng+"' data-lat='"+ r.point.lat+"' data-address='"+address+"' onclick='geo_select(this)' />";
                var infoWindow = new BMap.InfoWindow(sContent);
                mk.openInfoWindow(infoWindow);
                mk.addEventListener("click", function(){
                    this.openInfoWindow(infoWindow);
                });
                //alert(addComp.province + ", " + addComp.city + ", " + addComp.district + ", " + addComp.street + ", " + addComp.streetNumber);
            });
            $('#allmap').show();
            //map.centerAndZoom(r.point, 15);
        }
        else {
            alert('failed'+this.getStatus());
            map.centerAndZoom('郑州市', 12);
            $('#allmap').show();
        }
    },{enableHighAccuracy: true});
    <?php } ?>

    // 添加带有定位的导航控件
    var navigationControl = new BMap.NavigationControl({
        // 靠左上角位置
        anchor: BMAP_ANCHOR_TOP_RIGHT,
        // LARGE类型
        type: BMAP_NAVIGATION_CONTROL_ZOOM,
        // 启用显示定位
        enableGeolocation: true
    });
    map.addControl(navigationControl);
    // 添加定位控件
    var geolocationControl = new BMap.GeolocationControl();
    geolocationControl.addEventListener("locationSuccess", function(e){
        // 定位成功事件
        map.clearOverlays();
        var mk = new BMap.Marker(e.point);
        map.addOverlay(mk);
        map.panTo(e.point);

        geoc.getLocation(e.point, function(rs){
            var addComp = rs.addressComponents;
            var address = addComp.province + ", " + addComp.city + ", " + addComp.district + ", " + addComp.street + ", " + addComp.streetNumber;
            address = address.replace(/^(, )+|(, )+$/g,'');
            //var label = new BMap.Label(address,{offset:new BMap.Size(20,-10)});
            //mk.setLabel(label);
            var sContent = "当前位置：<br/>" + address + "<br/><input type='button' value='选择' data-lng='"+ e.point.lng+"' data-lat='"+ e.point.lat+"' data-address='"+address+"' onclick='geo_select(this)' />";
            var infoWindow = new BMap.InfoWindow(sContent);
            mk.openInfoWindow(infoWindow);
            mk.addEventListener("click", function(){
                this.openInfoWindow(infoWindow);
            });
            //alert(addComp.province + ", " + addComp.city + ", " + addComp.district + ", " + addComp.street + ", " + addComp.streetNumber);
        });
    });
    geolocationControl.addEventListener("locationError",function(e){
        // 定位失败事件
        alert(e.message);
    });
    map.addControl(geolocationControl);

    var size = new BMap.Size(10, 20);
    map.addControl(new BMap.CityListControl({
        anchor: BMAP_ANCHOR_TOP_LEFT,
        offset: size,
        // 切换城市之间事件
        // onChangeBefore: function(){
        //    alert('before');
        // },
        // 切换城市之后事件
        // onChangeAfter:function(){
        //   alert('after');
        // }
    }));

    function getGeo(e){
        //alert(e.point.lng + ", " + e.point.lat);
        //var point = new BMap.Point(e.point.lng, e.point.lat);
        map.clearOverlays();
        var mk = new BMap.Marker(e.point);
        map.addOverlay(mk);
        map.panTo(e.point);
        geoc.getLocation(e.point, function(rs){
            var addComp = rs.addressComponents;
            var address = addComp.province + ", " + addComp.city + ", " + addComp.district + ", " + addComp.street + ", " + addComp.streetNumber;
            address = address.replace(/^(, )+|(, )+$/g,'');
            //var label = new BMap.Label(address,{offset:new BMap.Size(20,-10)});
            //mk.setLabel(label);
            var sContent = "当前位置：<br/>" + address + "<br/><input type='button' value='选择' data-lng='"+ e.point.lng+"' data-lat='"+ e.point.lat+"' data-address='"+address+"' onclick='geo_select(this)' />";
            var infoWindow = new BMap.InfoWindow(sContent);
            mk.openInfoWindow(infoWindow);
            mk.addEventListener("click", function(){
                this.openInfoWindow(infoWindow);
            });
            //alert(addComp.province + ", " + addComp.city + ", " + addComp.district + ", " + addComp.street + ", " + addComp.streetNumber);
        });
        console.log('经度：'+ e.point.lng +' 纬度：'+e.point.lat);
        console.log(map.getDistance(auto_point, e.point).toFixed(0));
    }
    map.addEventListener("click", getGeo);

    //关于状态码
    //BMAP_STATUS_SUCCESS	检索成功。对应数值“0”。
    //BMAP_STATUS_CITY_LIST	城市列表。对应数值“1”。
    //BMAP_STATUS_UNKNOWN_LOCATION	位置结果未知。对应数值“2”。
    //BMAP_STATUS_UNKNOWN_ROUTE	导航结果未知。对应数值“3”。
    //BMAP_STATUS_INVALID_KEY	非法密钥。对应数值“4”。
    //BMAP_STATUS_INVALID_REQUEST	非法请求。对应数值“5”。
    //BMAP_STATUS_PERMISSION_DENIED	没有权限。对应数值“6”。(自 1.1 新增)
    //BMAP_STATUS_SERVICE_UNAVAILABLE	服务不可用。对应数值“7”。(自 1.1 新增)
    //BMAP_STATUS_TIMEOUT	超时。对应数值“8”。(自 1.1 新增)

    function geo_select(obj) {
        var _lng = $(obj).data('lng');
        var _lat = $(obj).data('lat');
        var _address = $(obj).data('address');
        //console.log('经度：'+_lng+' 纬度：'+_lat);
        //alert('经度：'+_lng+' 纬度：'+_lat+'\n地址：'+_address);

        $('#form-select').remove();

        var _html = '<form enctype="multipart/form-data" id="form-select" action="<?php echo $_['geo_form_url']; ?>" method="post" style="display: none;">';
        _html += '<input type="hidden" name="address" value="'+_address+'" />';
        _html += '<input type="hidden" name="bd_lng" value="'+_lng+'" />';
        _html += '<input type="hidden" name="bd_lat" value="'+_lat+'" />';
        _html += '</form>';
        $('body').prepend(_html);

        $('#form-select').submit();
    }

</script>
