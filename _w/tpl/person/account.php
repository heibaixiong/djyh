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
            <div class="zhjf-title">基本信息</div>
            <div class="userinfo">
                <div class="userinfo_item1">
                    <table cellspacing="0" cellpadding="0" border="0" class="userinfo_table">
                        <tbody>
                        <tr>
                            <th>
                                <label for="textfield">登录名称：</label>
                            </th>
                            <td>
                                <?php echo _session('webuser') . '[' . $_['member']['rank_name'] . ']';?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="textfield">手机号码：</label>
                            </th>
                            <td>
                                <?php echo $_['member']['tel']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="textfield">公司名称：</label>
                            </th>
                            <td>
                                <?php echo $_['member']['compony']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="textfield">联系地址：</label>
                            </th>
                            <td>
                                <?php echo $_['member']['address']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="textfield">主营类目：</label>
                            </th>
                            <td>
                                <?php echo $_['company']['product']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="textfield">联 系 人：</label>
                            </th>
                            <td>
                                <?php echo $_['member']['name']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="textfield">注册时间：</label>
                            </th>
                            <td>
                                <?php echo _time($_['member']['regtime']); ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //主体 -->
<?php
_part('footer1');
_part('footer2');
_part('footer3');
?>
</body>
</html>