<?php
if(!defined('PART'))exit;
?>
<div class="khfwleftMenu">
    <dl>
    	<dt class="khtitle">个人中心</dt>
        <dd hurl="payinstruction" class="li<?php if(_v(2) == 'account') echo ' active'; ?>" p="J">
            <span class="kh9"></span>
            <a href="<?php echo _u('/person/account/');?>">基本信息</a>
        </dd>
        <dd hurl="payinstruction" class="li<?php if(_v(2) == 'order') echo ' active'; ?>" p="J">
            <span class="kh9"></span>
            <a href="<?php echo _u('/person/order/');?>">我的订单</a>
        </dd>
        <dd hurl="payinstruction" class="li<?php if(_v(2) == 'address') echo ' active'; ?>" p="J">
                <span class="kh9"></span>
                <a href="<?php echo _u('/person/address/');?>">收货地址</a>
            </dd>
            <dd hurl="payinstruction" class="li<?php if(_v(2) == 'passedit') echo ' active'; ?>" p="J">
                <span class="kh9"></span>
                <a href="<?php echo _u('/person/passedit/');?>">登录密码</a>
            </dd>
            <dd hurl="payinstruction" class="li<?php if(_v(2) == 'zhifupassedit') echo ' active'; ?>" p="J">
                <span class="kh9"></span>
                <a href="<?php echo _u('/person/zhifupassedit/');?>">支付密码</a>
            </dd>
    </dl>
    <?php if ($_['member']['rank'] == '3') { ?>
        <dl>
            <dt class="khtitle">卖家中心</dt>
            <dd hurl="payinstruction" class="li" p="J">
                <span class="kh9"></span>
                <a href="<?php echo _u('/seller/goods/');?>">商品管理</a>
            </dd>
            <dd hurl="payinstruction" class="li" p="J">
                <span class="kh9"></span>
                <a href="<?php echo _u('/seller/order/');?>">订单管理</a>
            </dd>
        </dl>
    <?php } ?>
</div>