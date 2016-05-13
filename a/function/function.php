<?php
if(!defined('PART'))exit;
function _insert($a){
    $key=array('select','delete','update','insert','drop','or','and','create','union');
    if(is_array($a)){
        return array_map('_insert',$a);
    }else{
        foreach($key as $k=>$v){
            $a=str_ireplace($v,'&nbsp;'.$v,$a);
        }
        return $a;
    }
}
$_GET=_insert($_GET);
$_POST=_insert($_POST);
$_COOKIE=_insert($_COOKIE);
function _echo($str){
    if(is_array($str)||is_object($str)){
        echo json_encode($str);
    }else{
        echo $str;
    }
    exit;
}
function _logs($str,$type=''){
    $str=_ip().' '._time(time()).' '.$str.PHP_EOL;
    if(!empty($type)){
        _mkdir(LOGS.$type);
        $type.='/';
    }
    file_put_contents(LOGS.$type._time(time(),'d').'.txt',$str,FILE_APPEND);
}
function _geturl(){
    if(!get_magic_quotes_gpc()){
        $str=addslashes($_SERVER['QUERY_STRING']);
    }else{
        $str=$_SERVER['QUERY_STRING'];
    }
    return $str;
}
function _v($n){
    $v=explode('/',_geturl());
    $p=explode(',',PROJECT);
    $s=isset($v[$n]) ? $v[$n] : '';
    if((!isset($v[$n]) || !$v[$n]) && $n<3){
        if(0==$n){
            $s=$p[0];
        }else{
            $s='index';
        }
    }
    return $s;
}
function _u($str=''){
    $s=explode('/',$str);
    if(isset($s[0]) && !$s[0])$s[0]=V0;
    if(isset($s[1]) && !$s[1])$s[1]=V1;
    if(isset($s[2]) && !$s[2])$s[2]=V2;
    if(HTML=='php'){
        $url=INDEX.'?'.implode('/',$s);
    }
    if(HTML=='html'){
        $url=implode('/',$s).'.html';
    }
    return $url;
}
function _f($name,$str=''){
    if(is_null($str)){
        return unlink(CACHE.$name.SALT);
    }
    if(!$str){
        if(file_exists(CACHE.$name.SALT)){
            $a=file_get_contents(CACHE.$name.SALT);
        }else{
            $a=false;
        }        
        return $a === false ? 'no cache' : unserialize($a);
    }else{
        _mkdir(CACHE);
        file_put_contents(CACHE.$name.SALT,serialize($str));
        return $str;
    }
}
function _fdel($name){
    return unlink(CACHE.$name.SALT);
}
function _ftime($name){
	if(!file_exists(CACHE.$name.SALT)){
		$t=0;
	}else{
		$t=filemtime(CACHE.$name.SALT);
	}
    return time()-$t;
}
function _ismob(){
    $user_agent=$_SERVER['HTTP_USER_AGENT'];
    $mobile_agents=Array('240x320','acer','acoon','acs-','abacho','ahong','airness','alcatel','amoi','android','anywhereyougo.com','applewebkit/525','applewebkit/532','asus','audio','au-mic','avantogo','becker','benq','bilbo','bird','blackberry','blazer','bleu','cdm-','compal','coolpad','danger','dbtel','dopod','elaine','eric','etouch','fly ','fly_','fly-','go.web','goodaccess','gradiente','grundig','haier','hedy','hitachi','htc','huawei','hutchison','inno','ipad','ipaq','ipod','jbrowser','kddi','kgt','kwc','lenovo','lg ','lg2','lg3','lg4','lg5','lg7','lg8','lg9','lg-','lge-','lge9','longcos','maemo','mercator','meridian','micromax','midp','mini','mitsu','mmm','mmp','mobi','mot-','moto','nec-','netfront','newgen','nexian','nf-browser','nintendo','nitro','nokia','nook','novarra','obigo','palm','panasonic','pantech','philips','phone','pg-','playstation','pocket','pt-','qc-','qtek','rover','sagem','sama','samu','sanyo','samsung','sch-','scooter','sec-','sendo','sgh-','sharp','siemens','sie-','softbank','sony','spice','sprint','spv','symbian','tablet','talkabout','tcl-','teleca','telit','tianyu','tim-','toshiba','tsm','up.browser','utec','utstar','verykool','virgin','vk-','voda','voxtel','vx','wap','wellco','wig browser','wii','windows ce','wireless','xda','xde','zte');
    $is_mobile=false;
    foreach($mobile_agents as $device){
        if(stristr($user_agent,$device)){
            $is_mobile=true;
            break;
        }
    }
    return $is_mobile;
}
function _isiphone(){
    $isiphone=false;
    if(stripos($_SERVER['HTTP_USER_AGENT'],'iphone')){
       $isiphone=true;
    }
    return $isiphone;
}
function _isweixin(){
    if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
        return true;
    }

    return false;
}
function _get($str=''){
    if(!$str)return $_GET;
    return array_key_exists($str,$_GET)?trim($_GET[$str]):null;
}
function _post($str=''){
    if(!$str)return $_POST;
    return array_key_exists($str,$_POST)?$_POST[$str]:null;
}
function _server($str=''){
    if(!$str)return $_SERVER;
    return array_key_exists($str,$_SERVER)?$_SERVER[$str]:null;
}
function _session($str='',$value=''){
    if($str=='')return $_SESSION;
    if(is_null($value)){
        unset($_SESSION[$str]);
        return true;
    }
    if($value=='')return array_key_exists($str,$_SESSION)?trim($_SESSION[$str]):null;
    $_SESSION[$str]=$value;
}
function _cookie($str='',$value='',$time=3600){
    if($str=='')return $_COOKIE;
    if(is_null($value)){
        unset($_COOKIE[$str]);
        return true;
    }
    if($value=='')return array_key_exists($str,$_COOKIE)?trim($_COOKIE[$str]):null;
    setcookie($str,$value,time()+$time);
}
function _fun($str){
    include_once(APP_PATH.'function/'.$str.'.php');
}
function _prefun($str){
    if(!AUTO_LOAD){
        include_once(PROJECT_PRE.'function/'.$str.'.php');
    }
}
function _prefig($str){
    if(!AUTO_LOAD){
        include_once(PROJECT_PRE.'config/'.$str.'.php');
    }
}
function _profun($str){
    if(!AUTO_LOAD){
        include_once(PROJECT_PRE.V0.'/function/'.$str.'.php');
    }
}
function _profig($str){
    if(!AUTO_LOAD){
        include_once(PROJECT_PRE.V0.'/config/'.$str.'.php');
    }
}
function _autofile($file,$str=''){
    file_put_contents($file,'<?php'."\n".'if(!defined(\'PART\'))exit;'."\n".$str.'?>');
}
function _tpl($str='',$time=0){
    $s=explode('/',$str);
    if(empty($s[0]))$s[0]=V1;
    if(empty($s[1]))$s[1]=V2;
    $url=PROJECT_PRE.V0.'/tpl/'.$s[0].'/'.$s[1].'.php';
    if(AUTO_CREATFILE&&!file_exists($url)){
        _autofile($url);
    }
    global $_;
    include_once($url);
    unset($_);
}
function _part($str=''){
    $url=PROJECT_PRE.V0.'/tpl/'.$str.'.php';
    if(!file_exists($url)){
        echo '引入文件:('.$url.')不存在！';
        exit;
    }else{
        global $_;
        include_once($url);
    }
}
function _c($key,$value){
    global $_;
    $_[$key]=$value;
    if (_v(0) == 'p' && $key == 'title') $_[$key] .= ' - ' . $_['config']['title'];
}
function _mkdir($str){
    if(!is_dir($str)){
        mkdir($str,0777,true);
        _autofile($str.'index.php');
    }
}
function _deldir($str){
    if(is_dir($str)){
        $dir=opendir($str);
        while($file=readdir($dir)){
            if(is_dir($str.'/'.$file)){
                if(($file!='.')&&($file!='..')){
                    _deldir($str.'/'.$file);
                    rmdir($str.'/'.$file);
                }
            }else{
                if($file!='.DS_Store'){
                    unlink($str.'/'.$file);
                }
            }
        }
    }
}
function _header($v){
    header('Location:'.$v);
    exit;
}
function _js($str){
    echo '<script src="'.PUB.V0.'/js/'.$str.'.js" type="text/javascript"></script>'."\n";
}
function _css($str){
    echo '<link href="'.PUB.V0.'/style/'.$str.'.css" rel="stylesheet" type="text/css" />'."\n";
}
function _img($str){
    return PUB.V0.'/images/'.$str;
}
function _resize($filename, $width=0, $height=0) {
    if (!is_file(DIR . $filename)) {
        return;
    }

    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    $old_image = $filename;
    list($width_orig, $height_orig) = getimagesize(DIR . $old_image);

    if ($width == 0) $width = (int)($height/$height_orig*$width_orig);
    if ($height == 0) $height = (int)($width/$width_orig*$height_orig);
    if ($width == 0 && $height == 0) {
        $width = $width_orig;
        $height = $height_orig;
    }

    $new_image = 'cache/' . utf8_substr($filename, 0, utf8_strrpos($filename, '.')) . '-' . $width . 'x' . $height . '.' . $extension;

    if (!is_file(DIR . $new_image) || (filectime(DIR . $old_image) > filectime(DIR . $new_image))) {
        $path = '';

        $directories = explode('/', dirname(str_replace('../', '', $new_image)));

        foreach ($directories as $directory) {
            $path = $path . '/' . $directory;

            if (!is_dir(DIR . $path)) {
                @mkdir(DIR . $path, 0777);
            }
        }

        if ($width_orig != $width || $height_orig != $height) {
            $image = new Image(DIR . $old_image);
            $image->resize($width, $height);
            $image->save(DIR . $new_image);
        } else {
            copy(DIR . $old_image, DIR . $new_image);
        }
    }

    return  '/' . $new_image;
}
function _jq(){
    echo '<script src="'.PUB.'javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>'."\n";
}
function _tojson($data){
    function ch_urlencode($data){
        if(is_array($data)||is_object($data)){
            foreach($data as $k=>$v){
                if(is_scalar($v)){
                    if(is_array($data)){
                        $data[$k]=urlencode($v);
                    }elseif(is_object($data)){
                        $data->$k=urlencode($v);
                    }
                }elseif(is_array($data)){
                    $data[$k]=ch_urlencode($v);
                }elseif(is_object($data)){
                    $data->$k=ch_urlencode($v);
                }
            }
        }
        return $data;
    }
    $ret=ch_urlencode($data);
    $ret=json_encode($ret);
    return urldecode($ret);
}
function _json($code,$message='',$data=array()){
    return json_encode(array('code'=>$code,'message'=>$message,'data'=>$data));
}
function _curl($url){
   $ch=curl_init();
   curl_setopt($ch,CURLOPT_URL,$url);
   curl_setopt($ch,CURLOPT_TIMEOUT,5);
   curl_setopt($ch,CURLOPT_USERAGENT,_USERAGENT_);
   curl_setopt($ch,CURLOPT_REFERER,_REFERER_);
   curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
   $r=curl_exec($ch);
   curl_close($ch);
   return $r;
}
function _curlget($url){
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_HEADER,0);
    $output=curl_exec($ch);
    curl_close($ch);
    return $output;
}
function _curlpost($url,$data){
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_POST,1);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
    $output=curl_exec($ch);
    curl_close($ch);
    return $output;
}
function _ip(){
    $ip=false;
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ips=explode(',',$_SERVER['HTTP_X_FORWARDED_FOR']);
        if($ip){
            array_unshift($ips,$ip);
            $ip=FALSE;
        }
        for($i=0;$i<count($ips);$i++){
            if(!eregi('^(10|172\.16|192\.168)\.',$ips[$i])){
                $ip=$ips[$i];
                break;
            }
        }
    }
    return($ip?$ip:$_SERVER['REMOTE_ADDR']);
}
function _words($str,$num=1){
    $n=$num==1?'words1':'words2';
    _fun($n);
    foreach($_word as $v){
        if(strpos($str,$v)!==false){
            return false;
        }
    }
    return true;
}
function _togb($str){
    return iconv('UTF-8//IGNORE','GB2312//IGNORE',$str);
}
function _toutf($str){
    return iconv('GB2312//IGNORE','UTF-8//IGNORE',$str);
}
function _left($str,$star,$len,$omit='',$charset='UTF-8'){
    //$s=mb_substr($str,$star,$len,$charset);
    if (mb_strwidth($str, $charset) <= $len) {
        //return $str.str_repeat('　', floor(($len-mb_strwidth($str, $charset))/2));
    }
    $s = mb_strimwidth($str, $star, $len, $omit, $charset);
    return $s;
}
function _upper($str){
    return strtoupper($str);
}
function _lower($str){
    return strtolower($str);
}
function _md5($str){
    return md5(md5(SALT).$str.md5(SALT));
}
function _iconv($value){
    $value_1=$value;
    $value_2=iconv('gb2312','utf-8//IGNORE',$value_1);
    $value_3=iconv('utf-8','gb2312//IGNORE',$value_2);
    if(strlen($value_1)==strlen($value_3)){
        return $value_2;
    }else{
        return $value_1;
    }
}
function _phone($value){
    if(((float)($value)!=$value)||($value<13000000000)||$value>19000000000){
        return false;
    }else{
        return true;
    }
}
function _maskPhone($value, $before=3, $after=2) {
    if (strlen($value) < $before+$after) return $value;
    return substr($value, 0 ,$before).str_repeat('*', strlen($value)-$before-$after).substr($value, strlen($value)-$after);
}
function _zipcode($value){
    if(((int)($value)!=$value)||($value<0)||$value>999999){
        return false;
    }else{
        return true;
    }
}
function _email($value){
    if((!strpos($value,'@'))||(strpos($value,'@')>strrpos($value,'.'))){
        return false;
    }else{
        return true;
    }
}
function _int($value){
    return intval($value);
}
function _str($value){
    return strval($value);
}
function _float($value){
    return floatval($value);
}
function _rmb($v){
    return sprintf("%.2f",$v);
}
function _time($v,$t=''){
    if(empty($v)){
        return '';
    }
    if('d'==$t){
        return date('Y-m-d',$v);
    }else{
        return date('Y-m-d H:i:s',$v);
    }
}
function _random($len=6,$type='str'){
    if('str'==$type){
        return _left(_md5(mt_rand(10,10000).time()),0,$len);
    }
    if('num'==$type){
        return str_pad(rand(0,pow(10,$len)),$len,'0');
    }
}
function _editor($id,$w='400',$h='600'){
    echo '
    <script charset="utf-8" src="'.APP_PATH.'/editor/kindeditor-min.js"></script>
    <script charset="utf-8" src="'.APP_PATH.'/editor/lang/zh_CN.js"></script>
    <script>
        var editor;
        KindEditor.ready(function(K) {
                editor = K.create("#'.$id.'",{width:"'.$w.'px",height:"'.$h.'px",afterBlur:function(){this.sync();}
            });
        });
    </script>
    ';
}
function _upload($input,$form){
    echo ' <input type="button" value="上传.." style="padding:8px 20px;" onClick="window.open (\''.INDEX.'?upload/'.$input.'/'.$form.'/\',\''.$input.'\',\'resizable=no,scrollbars=no,status=no,toolbar=no,menubar=no,fullscreen=no,top=\'+(screen.height-300)/2+\',left=\'+(screen.width-420)/2+\',width=420,height=150\');"/>';
}
?>