<?php
if(!defined('PART'))exit;

function _geoSquarePoint($lng, $lat, $distance=3, $type=0) {
    if ($type == 1) {
        $lnglat = _BD09LLtoWGS84($lng.','.$lat);
        list($lng, $lat) = explode(',', $lnglat);
    }
    //$distance = 0.2; //单位是KM
    $radius = 6371.393; //代为是KM
    //用户当前的地理位置
    //$lng = '121.606546';
    //$lat = '29.918017';
    //计算偏移的角度并转化为弧度
    $dlng = rad2deg(2*asin(sin($distance/(2*$radius)) / cos(deg2rad($lat))));
    $dlat = rad2deg($distance/$radius);
    //计算实际搜索的四边形的四个边界范围
    return array(
        'left-top'=>array('lat'=>$lat + $dlat,'lng'=>$lng-$dlng),
        'right-top'=>array('lat'=>$lat + $dlat, 'lng'=>$lng + $dlng),
        'left-bottom'=>array('lat'=>$lat - $dlat, 'lng'=>$lng - $dlng),
        'right-bottom'=>array('lat'=>$lat - $dlat, 'lng'=>$lng + $dlng)
    );
    // lat<>0 and lat>{$squares['right-bottom']['lat']} and lat<{$squares['left-top']['lat']} and lng>{$squares['left-top']['lng']} and lng<{$squares['right-bottom']['lng']}
}

/**
 * 百度坐标系转换成标准GPS坐系
 * @param string $lnglat 坐标(如:106.426, 29.553404)
 * @return string 转换后的标准GPS值:
 */
function _BD09LLtoWGS84($lnglat){ // 经度,纬度
    $lng_lat = explode(',', $lnglat);
    list($x,$y) = $lng_lat;
    $Baidu_Server = "http://api.map.baidu.com/ag/coord/convert?from=0&to=4&x={$x}&y={$y}";
    $result = @file_get_contents($Baidu_Server);
    $json = json_decode($result);
    if ($json->error == 0) {
        $bx = base64_decode($json->x);
        $by = base64_decode($json->y);
        $GPS_x = 2 * $x - $bx;
        $GPS_y = 2 * $y - $by;
        return $GPS_x.','.$GPS_y;//经度,纬度
    } else
        return $lnglat;
}

/**
 * 计算两个坐标之间的距离(米)
 * @param float $fP1Lat 起点(纬度)
 * @param float $fP1Lon 起点(经度)
 * @param float $fP2Lat 终点(纬度)
 * @param float $fP2Lon 终点(经度)
 * @return float
 */
function _distanceBetween($fP1Lat, $fP1Lon, $fP2Lat, $fP2Lon){
    $fEARTH_RADIUS = 6378137;
    //角度换算成弧度
    $fRadLon1 = deg2rad($fP1Lon);
    $fRadLon2 = deg2rad($fP2Lon);
    $fRadLat1 = deg2rad($fP1Lat);
    $fRadLat2 = deg2rad($fP2Lat);
    //计算经纬度的差值
    $fD1 = abs($fRadLat1 - $fRadLat2);
    $fD2 = abs($fRadLon1 - $fRadLon2);
    //距离计算
    $fP = pow(sin($fD1/2), 2) + cos($fRadLat1) * cos($fRadLat2) * pow(sin($fD2/2), 2);

    return floatval($fEARTH_RADIUS * 2 * asin(sqrt($fP)) + 0.5);
}

function _shortTime($value) {
    $time = time() - $value;
    if ($time < 0) return false;
    if ($time < 3600) {
        return ceil($time/60).'分钟前';
    } elseif ($time < 3600 * 24) {
        return ceil($time/3660).'小时前';
    } else {
        return ceil($time/3660/24).'天前';
    }
}

function _sendWxMsg($openid='', $msg='') {
    require_once(APP_PATH . 'library/wxjssdk.php');
    global $_wrap;
    $jssdk = new WxJsSDK($_wrap['wxpay_config']['wxpay_appid'], $_wrap['wxpay_config']['wxpay_appsecret']);
    $res = $jssdk->sendTextMessage($openid, $msg);
    return $res;
}

function _weblogs($str){
    $data=array();
    $data['uid']=_session('webid')?_session('webid'):0;
    $data['uname']=_session('weixin_openid')?_session('weixin_openid'):'';
    $data['content']=$str;
    $data['addtime']=time();
    $data['ip']=_ip();
    _sqlinsert('weblogs',$data);
}