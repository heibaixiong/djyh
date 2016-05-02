<?php
if(!defined('PART'))exit;
if (empty(_session('weixin_openid'))) {
    _session('weixin_redirect_url', 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
    _header('http://'.$_SERVER['HTTP_HOST'] . '/callback/wxpay_openid/index.php');
    exit();
}
function __index() {
    //die('I\'m in logistic.');
    require_once(APP_PATH . 'library/wxjssdk.php');

    global $_wrap;
    $jssdk = new WxJsSDK($_wrap['wxpay_config']['wxpay_appid'], $_wrap['wxpay_config']['wxpay_appsecret']);
    $signPackage = $jssdk->GetSignPackage();

    $redirect_url = _u('/index/geo/');
    if (_v(3)) {
        $redirect_url = empty(_session('gps_redirect_url')) ? _u('/index/auto/') : _session('gps_redirect_url');
        //_session('gps_redirect_url', null);
    }

    _c('gps_redirect_url', $redirect_url);

    _c('signPackage', $signPackage);

    _c('openid', _session('weixin_openid'));

    _tpl();
}

function __auto() {
    if (empty(_v(3)) || empty(_v(4))) {
        _header(_u('//geo/'));
        die();
    }

    $gps_lng = floatval(_v(3));
    $gps_lat = floatval(_v(4));

    $url = "http://api.map.baidu.com/geocoder/v2/?ak=dt0euriXB1EXVHOqWMGLvGVZgVDYtWWx&coordtype=wgs84ll&location={$gps_lat},{$gps_lng}&output=json&pois=0";
    $res = _curlget($url);
    $location = json_decode($res);
    //die($location->result->location->lng);
    if (isset($location->status) && $location->status == 0) {
        _session('auto_gps_location', $gps_lng.','.$gps_lat);
        _session('last_bd_gps', $location->result->location->lng.','.$location->result->location->lat);

        $address = $location->result->addressComponent->province;
        if (!empty($location->result->addressComponent->city)) $address .= ', '.$location->result->addressComponent->city;
        if (!empty($location->result->addressComponent->district)) $address .= ', '.$location->result->addressComponent->district;

        $detail = '';
        if (!empty($location->result->addressComponent->street)) $detail .= $location->result->addressComponent->street;
        if (!empty($location->result->addressComponent->street_number)) $detail .= $location->result->addressComponent->street_number;

        if (!empty($detail)) $address .= ', '.$detail;
        _session('last_bd_address', $address);

        if (empty(_session('geo_form_url'))) {
            _header(_u('//geo/'._v(3).'/'._v(4).'/'));
            die();
        } else {
            _header(_session('geo_form_url'));
            die();
        }
    } else {
        _header(_u('//geo/'._v(3).'/'._v(4).'/'));
        die();
    }
}

function __geo() {
    $squares = array();
    if (_v(3) && _v(4)) {
        $squares = _geoSquarePoint(_v(3), _v(4));
    }
    _c('squares', $squares);

    $redirect_url = _u('/ship/index/');
    if (_session('geo_form_url')) {
        $redirect_url = _session('geo_form_url');
        //_session('geo_form_url', null);
    }

    _c('geo_form_url', $redirect_url);

    _tpl();
}

function __upload() {
    $json = array();

    // Make sure we have the correct directory
    $directory = UPLOAD . date('Y') . '/' . date('m') . '/' . floor(intval(date('d'))/10);
    if (!is_dir($directory)) {
        mkdir($directory,0777,true);
    }

    // Check its a directory
    if (!is_dir($directory)) {
        $json['error'] = '文件上传失败！文件夹不存在！';
    }

    if (!$json) {
        if (!empty($_FILES['file']['name']) && is_file($_FILES['file']['tmp_name'])) {
            // Sanitize the filename
            $filename = basename(html_entity_decode($_FILES['file']['name'], ENT_QUOTES, 'UTF-8'));

            // Validate the filename length
            if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 255)) {
                $json['error'] = '文件名长度不符！';
            }

            // Allowed file extension types
            $allowed = array(
                'jpg',
                'jpeg',
                'gif',
                'png'
            );

            if (!in_array(utf8_strtolower(utf8_substr(strrchr($filename, '.'), 1)), $allowed)) {
                $json['error'] = '文件格式不符！';
            }

            // Allowed file mime types
            $allowed = array(
                'image/jpeg',
                'image/pjpeg',
                'image/png',
                'image/x-png',
                'image/gif'
            );

            if (!in_array($_FILES['file']['type'], $allowed)) {
                $json['error'] = '文件格式不符！';
            }

            // Return any upload error
            if ($_FILES['file']['error'] != UPLOAD_ERR_OK) {
                $json['error'] = '上传失败！' . $_FILES['file']['error'];
            }
        } else {
            $json['error'] = '上传出错啦！';
        }
    }

    if (!$json) {
        $new_filename = str_replace('.', '', microtime(true)) . _random(6, 'num') . '.' . utf8_strtolower(utf8_substr(strrchr($filename, '.'), 1));
        move_uploaded_file($_FILES['file']['tmp_name'], $directory . '/' . $new_filename);
        _weblogs('上传文件：'.$directory . '/' . $new_filename);

        $thumb_w = 100;
        $thumb_h = 100;
        if (_post('size')) {
            $_size = explode('x', _post('size'));
            if (isset($_size[0])) $thumb_w = intval($_size[0]);
            if (isset($_size[1])) $thumb_h = intval($_size[1]);
        }

        $json['success'] = 'ok';
        $json['path'] = $directory . '/' . $new_filename;
        $json['thumb'] = _resize($directory . '/' . $new_filename, $thumb_w, $thumb_h);
    }

    die(json_encode($json));
}