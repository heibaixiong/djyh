<?php
if(!defined('PART'))exit;
function _weixin_checksign($token){
    $signature=_get('signature');
    $timestamp=_get('timestamp');
    $nonce=_get('nonce');
    $echostr=_get('echostr');
    $tmparr=array($token,$timestamp,$nonce);
    sort($tmparr,SORT_STRING);
    $tmpstr=implode($tmparr);
    $tmpstr=sha1($tmpstr);
    if($tmpstr==$signature){
        return $echostr;
    }else{
        return '';
    }
}
function _weixin_js($str='1.0.0'){
    echo '<script src="http://res.wx.qq.com/open/js/jweixin-'.$str.'.js" type="text/javascript"></script>'."\n";
}
function _weixin_token($appid,$secret){
    $token=_session('weixin_token');
    if(!empty($token)){
        return $token;
    }else{
        $str=_curlget('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$secret);
        $arr=json_decode($str,true);
        _session('weixin_token',$arr['access_token']);
        return $arr['access_token'];
    }	
}
function _weixin_qrcode($token,$id){
    $data=array("action_name"=>"QR_LIMIT_SCENE","action_info"=>array("scene"=>array("scene_id"=>$id)));
    $ticket=_curlpost('https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$token,_tojson($data));
    $ticketstr=json_decode($ticket,true);
    return 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$ticketstr['ticket'];
}
function _weixin_info($appid,$appsecret,$openid,$lang='zh_CN'){
	$str=_curlget('https://api.weixin.qq.com/cgi-bin/user/info?access_token='._weixin_token($appid,$appsecret).'&openid='.$openid.'&lang='.$lang);
    $j=json_decode($str,true);
    return $j;
}
function _weixin_getmenu($token){
    return _curlget('https://api.weixin.qq.com/cgi-bin/menu/get?access_token='.$token);
}
function _weixin_setmenu($token,$data){
    $data=array("button"=>$data);
    $datajson=_tojson($data);
    return _curlpost('https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$token,$datajson);
}
function _weixin_snsapi_base($appid,$url){
    return 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.urlencode($url).'&response_type=code&scope=snsapi_base&state=123#wechat_redirect';
}
function _weixin_code(){
    $code=_get('code');
    if(!empty($code)){
        return $code;
    }else{
        return false;
    }
}
function _weixin_web_openid($appid,$secret,$code){
    $str=_curlget('https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code');
    $j=json_decode($str,true);
    return $j['openid'];
}
function _weixin_jsapi_ticket($token){
    $ticket=_session('weixin_ticket');
    if(!empty($ticket)){
        return $ticket;
    }else{
        $str=_curlget('https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$token.'&type=jsapi');
        $j=json_decode($str,true);
        _session('weixin_ticket',$j['ticket']);
        return $j['ticket'];
    }
}
function _weixin_signature($access_token){
    global $_;
    $ticket=_weixin_jsapi_ticket($access_token);
    $url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
    return array('noncestr'=>_md5(time()),'timestamp'=>time(),'signature'=>sha1('jsapi_ticket='.$ticket.'&noncestr='.$_['weixin_signature']['noncestr'].'&timestamp='.$_['weixin_signature']['timestamp'].'&url='.$url));
}
function _weixin_get_id($session){
    $s=_session($session);
    if(empty($s)){
        $code=_weixin_code();
        if(!$code){
            global $_wrap;
            $url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
            $url=_weixin_snsapi_base($_wrap['appid'],$url);
            _header($url);
        }else{
             $opendid=_weixin_web_openid($_wrap['appid'],$_wrap['secret'],$code);
             _session('opendid',$opendid);
        }
    }
}
?>