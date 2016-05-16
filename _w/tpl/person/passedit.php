<?php
if(!defined('PART'))exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_['title'];?></title>
<?php
_css('default');
_css('v1.0');
_css('style');
_jq();
_js('distpicker.data');
_js('distpicker');
?>
</head>
<body>
<?php
_part('top');
_part('head');
_part('nav');
?>
<!-- 主体 -->
<div class="layout_wrap">
    <?php
    _part('personleft');
    ?>
    <div class="prod_return khfwrightCon">
		<div class="cont">
			<div class="zhjf-title">修改密码</div>
    			<div class="userinfo">
    				<div class="userinfo_item1">
                        <div id="changePass2" class="changePass">
                            <form method="post" id="form-pass-edit" action="<?php echo _u('//passedit/');?>">
                                <table cellspacing="0" cellpadding="0" border="0" width="100%" class="userinfo_table">
                                    <tbody><tr>
                                        <th>旧密码：</th>
                                        <td>
                                            <input type="password" class="passw" id="oldpass" name="oldpass">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>新密码：</th>
                                        <td>
                                            <input type="password" class="passw" id="pass" name="pass1">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>再次输新密码：</th>
                                        <td>
                                            <input type="password" class="passw" id="pass2" name="pass2">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" colspan="2">
                                            <input type="button" class="tj-button" value="确定修改" id="btn-submit">
                                    </td></tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#btn-submit').click(function(){
            var _error = false;
            $('#form-pass-edit input[type=password]').each(function(e, t){
                if ($(t).val() == '') {
                    alert('请输入完整！');
                    _error = true;
                    return false;
                }
            });
            if (!_error) $('#form-pass-edit').submit();
        });
    });
</script>
<!-- //主体 -->
<?php
_part('footer1');
_part('footer2');
_part('footer3');
?>
</body>
</html>