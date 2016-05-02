<?php
if(!defined('PART'))exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎登录后台管理系统</title>
<?php
_css('style');
_jq();
_js('cloud');
?>
<script language="javascript">
	$(function(){
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
	$(window).resize(function(){  
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
    })
    $("#loginbtn").click(function(){
        $("#form1").submit();
        });
});
</script>
</head>
<body style="background-color:#1c77ac; background-image:url(<?php echo _img('light.png');?>); background-repeat:no-repeat; background-position:center top; overflow:hidden;">
    <div id="mainBody">
      <div id="cloud1" class="cloud"></div>
      <div id="cloud2" class="cloud"></div>
    </div>
<div class="logintop">
    <span>欢迎登录后台管理界面平台</span>
    <ul>
    <li><a href="#">回首页</a></li>
    <li><a href="#">帮助</a></li>
    <li><a href="#">关于</a></li>
    </ul>
    </div>
    <div class="loginbody">
    <span class="systemlogo"></span>
    <div class="loginbox">
    <form action="<?php echo _u('/login/login');?>" method="post" id="form1">  
    <ul>
    <li><input name="loginuser" type="text" class="loginuser" value="admin" onclick="JavaScript:this.value=''"/></li>
    <li><input name="loginpwd" type="password" class="loginpwd" value="密码" onclick="JavaScript:this.value=''"/></li>
    <li><input name="" id="loginbtn" type="button" class="loginbtn" value="登录" /><label><a href="#">忘记密码？</a></label></li>
    </ul>
    </form>
    </div>
    </div>
    <div class="loginbm">版权所有  2015  <?php echo $_['config']['title']?></div>
</body>
</html>