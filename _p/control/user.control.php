<?php
if(!defined('PART'))exit;
function __index(){
	$r=_v(3);
	if(empty($r)){
		$r=0;
	}
	$p=_v(4);
	if(empty($p)){
		$p=0;
	}
	$arr=_sqlone('compony','aid='.$r);
	_c('rs',$arr);
	_c('classtitle','所有分类');
	_c('title',$arr['compony']);
	_c('shopclass',_f('oneclass'));
	Page::start('ware',$p,'state=0 and uid='.$r,'px,id desc');
	_tpl();
}
function __login(){
    $loginuser=_post('aname');
    $loginpwd=_post('apass');
    if(!empty($loginuser)){
        $arr=_sqlone('admin','(user="'._escape($loginuser).'" or tel="'._escape($loginuser).'") and pass="'._md5($loginpwd).'"');
        if(empty($arr)){
            _weblogs($loginuser.' 试图登录系统，账号或者密码错误！');
            _alerturl('账号不存在或者密码错误！',_u('/index/login/'));
        }else{
            if($arr['state']>0){
                if ($arr['rank'] == '3' || $arr['rank'] == '4' || $arr['rank'] == '5') {
                    _session('web_uid', $arr['id']);
                    _header(_u('/index/register/'));
                } else {
                    _weblogs($arr['user'].' 试图进入系统，失败！');
                    _alerturl('您的账户尚未开通，请您联系客服人员！',_u('/index/login/'));
                }
            }
            _session('webid',$arr['id']);
            _session('webuser',$arr['user']);
            _session('webname',$arr['name']);
            _session('webcompony',$arr['compony']);
            _session('webrank',$arr['rank']);
            _session('code',$arr['code']);
            _session('webcode',$arr['admincode']);
            _sqldo('update '._pre('admin').' set updatetime='.time().',hits=hits+1 where id='.$arr['id']);
            _weblogs('成功登陆B2B系统！');
            _url(_u('/index/index'));
        }
    }
}
function __reg(){
    $json = array();
    $loginuser=_post('aname');
    $loginpwd=_post('apass');
    $loginpwd2=_post('apass2');

    if (!_phone($loginuser)) {
        //_alerturl('手机号码格式不正确！',_u('/index/login/'));
        $json['error'] = '手机号码格式不正确！';
    } /*elseif (_session('sms_phone') <> md5($loginuser) || _session('sms_code') <> md5(_post('acode')) || _session('sms_time') < time()) {
        //_alerturl('验证码错误或已过期！',_u('/index/login/'));
        $json['error'] = '验证码错误或已过期！';
    }*/ elseif (empty(_post('apass')) || $loginpwd<>$loginpwd2){
        //lerturl('两次密码不一样！',_u('/index/login/'));
        $json['error'] = '密码为空或两次密码不一致！';
    } elseif (!in_array(_post('atype'), array('3', '5'))) {
        $json['error'] = '注册类型不匹配！';
    }

    if (empty($json)) {
        if (_post('atype') == '3') {
            if (_post('business_image') == '') {
                $json['error'] = '请上传营业执照！';
            } elseif (_post('tax_image') == '') {
                $json['error'] = '请上传税务登记证！';
            } elseif (_post('company') == '') {
                $json['error'] = '请输入公司名称！';
            } elseif (_post('category') == '') {
                $json['error'] = '请输入主营类目！';
            }
        } elseif (_post('atype') == '5') {
            if (_post('shop_image') == '') {
                $json['error'] = '请上传门店照片！';
            } elseif (_post('id_image') == '') {
                $json['error'] = '请上传营业执照或身份证！';
            } elseif (_post('company') == '') {
                $json['error'] = '请输入店名！';
            }
        }
    }

    if (empty($json)) {
        if (empty(_post('pro_n')) || empty(_post('cit_n')) || empty(_post('cou_n')) || empty(trim(_post('address'))) || empty(_post('code'))) {
            $json['error'] = '请填写完整地址！';
        } elseif (_post('contact') == '') {
            $json['error'] = '请输入联系人！';
        } elseif (is_null(_post('agree'))) {
            $json['error'] = '请先阅读并同意<<注册协议>>！';
        }
    }


    if(empty($json)){
        $arr=_sqlone('admin', 'user=\''._escape($loginuser).'\' or tel=\''._escape($loginuser).'\'');
        if(empty($arr)){
            $rs=array();
            $rs['user']=$loginuser;
            $rs['tel']=$loginuser;
            $rs['pass']=_md5($loginpwd);

            $rs['name'] = trim(_post('contact'));
            $rs['compony'] = trim(_post('company'));
            $rs['address'] = _post('pro_n')._post('cit_n')._post('cou_n')._post('address');
            $rs['code'] = intval(_post('code'));

            $rs['rank'] = intval(_post('atype'));
            $rs['state'] = 1;
            $rs['regtime'] = time();
            $rs['invite'] = _phone(_post('invite')) ? _post('invite') : '';

            if ($uid = _sqlinsert('admin', $rs)) {
                $company = array();
                $company['aid'] = $uid;
                $company['compony'] = trim(_post('company'));
                if (_post('atype') == '3') {
                    $company['product'] = trim(_post('category'));
                    $company['business_image'] = _post('business_image');
                    $company['tax_image'] = _post('tax_image');
                }

                if (_post('atype') == '5') {
                    $company['id_image'] = _post('id_image');
                    $company['shop_image'] = _post('shop_image');
                }

                _sqlinsert('compony', $company);
                _weblogs($loginuser.'注册成功！');
                //_alerturl('注册成功！请登录！', _u('/index/login/'));
                $json['success'] = '注册成功！';
            } else {
                $json['error'] = '注册失败！';
            }
        }else{
            _weblogs('手机号码已被注册！');
            //_alerturl('账号已存在！',_u('/index/login/'));
            $json['error'] = '您输入的手机号码已被注册，请使用忘记密码找回！';
        }
    }

    die(json_encode($json));
}

function __resave(){
    $json = array();

    $webid = _session('web_uid');
    $user = _sqlone('admin', 'rank in (3,4,5) and state > 0 and id='.intval($webid));

    $loginuser = $user['user'];
    $loginpwd=_post('apass');
    $loginpwd2=_post('apass2');

    if (empty($user)) {
        $json['error'] = '用户不存在或状态异常！';
    } elseif (!in_array(_post('atype'), array('3', '5'))) {
        $json['error'] = '注册类型不匹配！';
    }
    if (empty($json) && _post('atype') == '3') {
        if (_post('business_image') == '') {
            $json['error'] = '请上传营业执照！';
        } elseif (_post('tax_image') == '') {
            $json['error'] = '请上传税务登记证！';
        } elseif (_post('company') == '') {
            $json['error'] = '请输入公司名称！';
        } elseif (_post('category') == '') {
            $json['error'] = '请输入主营类目！';
        }
    } elseif (empty($json) && _post('atype') == '5') {
        if (_post('shop_image') == '') {
            $json['error'] = '请上传门店照片！';
        } elseif (_post('id_image') == '') {
            $json['error'] = '请上传营业执照或身份证！';
        } elseif (_post('company') == '') {
            $json['error'] = '请输入店名！';
        }
    }
    if (empty($json)) {
        if (empty(_post('pro_n')) || empty(_post('cit_n')) || empty(_post('cou_n')) || empty(trim(_post('address'))) || empty(_post('code'))) {
            $json['error'] = '请填写完整地址！';
        } elseif (_post('contact') == '') {
            $json['error'] = '请输入联系人！';
        } elseif (is_null(_post('agree'))) {
            $json['error'] = '请先阅读并同意<<注册协议>>！';
        }
    }

    if(empty($json)){
        $arr = array();
        if(empty($arr)){
            $rs=array();
            //$rs['user']=$loginuser;
            //$rs['tel']=$loginuser;
            //$rs['pass']=_md5($loginpwd);

            $rs['name'] = trim(_post('contact'));
            $rs['compony'] = trim(_post('company'));
            $rs['address'] = _post('pro_n')._post('cit_n')._post('cou_n')._post('address');
            $rs['code'] = intval(_post('code'));

            //$rs['rank'] = intval(_post('atype'));
            //$rs['state'] = 1;
            //$rs['invite'] = _phone(_post('invite')) ? _post('invite') : '';

            if ($uid = _sqlupdate('admin', $rs, 'id='.$user['id'])) {
                $company = array();
                //$company['aid'] = $uid;
                $company['compony'] = trim(_post('company'));
                if (_post('atype') == '3') {
                    $company['product'] = trim(_post('category'));
                    $company['business_image'] = _post('business_image');
                    $company['tax_image'] = _post('tax_image');
                }

                if (_post('atype') == '5') {
                    $company['id_image'] = _post('id_image');
                    $company['shop_image'] = _post('shop_image');
                }

                _sqlupdate('compony', $company, 'aid='.$user['id']);
                _weblogs($loginuser.'提交成功！');
                //_alerturl('注册成功！请登录！', _u('/index/login/'));
                $json['success'] = '提交成功！';
                _session('web_uid', null);
            } else {
                $json['error'] = '提交失败！';
            }
        }else{
            _weblogs('手机号码已被注册！');
            //_alerturl('账号已存在！',_u('/index/login/'));
            $json['error'] = '您输入的手机号码已被注册，请使用忘记密码找回！';
        }
    }

    die(json_encode($json));
}

function __step_one() {
    $json = array();

    if (!empty(_post('fname')) && !empty(_post('fcode'))) {
        $user = _sqlone('admin', 'user=\''._escape(_post('fname')).'\' or tel = \''._escape(_post('fname')).'\'');
        if ($user) {
            $phone = _phone($user['tel']) ? $user['tel'] : (_phone($user['user']) ? $user['user'] : false);
            if ($phone === false || _session('sms_phone') <> md5($phone) || _session('sms_code') <> md5(_post('fcode')) || _session('sms_time') < time()) {
                $json['error'] = '验证码错误或已过期！';
            } else {
                $json['success'] = true;
            }
        } else {
            $json['error'] = '您输入的用户不存在！';
        }
    } else {
        $json['error'] = '请输入完整！';
    }
    //$json = array('success' => true);
    die(json_encode($json));
}

function __step_two() {
    $json = array();

    if (!empty(_post('fname')) && !empty(_post('fcode')) && !empty(_post('fpass')) && !empty(_post('fpass2'))) {
        $user = _sqlone('admin', 'user=\''._escape(_post('fname')).'\' or tel = \''._escape(_post('fname')).'\'');
        if ($user) {
            $phone = _phone($user['tel']) ? $user['tel'] : (_phone($user['user']) ? $user['user'] : false);
            if ($phone === false || _session('sms_phone') <> md5($phone) || _session('sms_code') <> md5(_post('fcode')) || _session('sms_time') < time()) {
                $json['error'] = '验证信息已过期！';
                $json['back'] = true;
            } else {
                if (_post('fpass') == _post('fpass2')) {
                    if (_sqlupdate('admin', array('pass' => _md5(_post('fpass'))), 'id='.$user['id'])) {
                        $json['success'] = true;
                    } else {
                        $json['error'] = '密码重置失败！请稍后再试！';
                    }
                } else {
                    $json['error'] = '两次输入密码不一致！';
                }
            }
        } else {
            $json['error'] = '您输入的用户不存在！';
            $json['back'] = true;
        }
    } else {
        $json['error'] = '请输入完整！';
    }
    //$json = array('success' => true);
    die(json_encode($json));
}

function __out(){
    _weblogs(_session('webuser') . ' 成功退出B2B系统');
    _session('webid', null);
    _session('webuser', null);
    _session('webcompony', null);
    _session('webrank', null);
    _session('code', null);
    _session('webcode', null);
    _url(_u('/index/login'));
}

function __sms() {
    $json = array();
    $loginuser=_post('aname');
    if(!empty($loginuser)){
        $user = _sqlone('admin', 'user=\''._escape(_post('aname')).'\' or tel = \''._escape(_post('aname')).'\'');
        if ($user) {
            $json['error'] = '您输入的手机号码已被注册，请使用忘记密码找回！';
        } elseif (_phone($loginuser)) {
            $_code = _random(6, 'num');
            $_sms = '【东家要货】您的验证码：' . $_code . '，十五分钟内有效，若非本人操作请忽略此消息！';
            if (_sms_send($loginuser, $_sms)) {
                $json['success'] = true;
                _session('sms_phone', md5($loginuser));
                _session('sms_code', md5($_code));
                _session('sms_time', time() + 15*60);
            } else {
                $json['error'] = '短信发送失败！请稍后再试！';
            }
        } else {
            $json['error'] = '请检查手机号码是否输入正确！';
        }
    } elseif (!empty(_post('fname'))) {
        $user = _sqlone('admin', 'user=\''._escape(_post('fname')).'\' or tel = \''._escape(_post('fname')).'\'');
        if ($user) {
            $phone = _phone($user['tel']) ? $user['tel'] : (_phone($user['user']) ? $user['user'] : false);
            $_code = _random(6, 'num');
            $_sms = '【东家要货】您的验证码是' . $_code . ',15分钟内有效.若非本人操作请忽略此消息.';
            if ($phone && _sms_send($phone, $_sms)) {
                $json['success'] = true;
                _session('sms_phone', md5($phone));
                _session('sms_code', md5($_code));
                _session('sms_time', time() + 15*60);
            } else {
                $json['error'] =  '请检查手机号码是否输入正确或者稍后再次尝试！';
            }
        } else {
            $json['error'] = '您输入的用户不存在！';
        }
    } else {
        $json['error'] = '请输入完整！';
    }

    echo json_encode($json);
    die();
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
?>