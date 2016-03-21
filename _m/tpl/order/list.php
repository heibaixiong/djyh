<?php
if(!defined('PART'))exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
_css('style');
_jq();
$_wrap['ctrl_url'] = _u() . '/';
?>
<script type="text/javascript">
$(document).ready(function(){
  $(".click").click(function(){
  $(".tip").fadeIn(200);
  });  
  $(".tiptop a").click(function(){
  $(".tip").fadeOut(200);
});
  $(".sure").click(function(){
  $(".tip").fadeOut(100);
});
  $(".cancel").click(function(){
  $(".tip").fadeOut(100);
});
});
</script>
</head>
<body>
	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li>首页</li>
    <li>订单管理</li>
    <li><?php echo $_['title'];?></li>
    </ul>
    </div>
    <div class="rightinfo">
    <table class="tablelist">
    	<thead>
        <tr>
        <th>订单编号</th>
        <th>收货人</th>
        <th>收货地址</th>
        <th>手机</th>
        <th>电话</th>
        <th>实付现金</th>
            <th>下单时间</th>
            <th>订单状态</th>
        <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach(Page::$arr as $k=>$v){
        ?>
        <tr>
        <td><?php echo $v['id']?></td>
        <td><?php echo _left($v['nam'],0,3,'...')?></td>
        <td><?php echo $v['pro_n'].$v['cit_n'].$v['cou_n'].$v['adr']?></td>
        <td><?php echo $v['phn']?></td>
        <td><?php echo $v['tel']?></td>
        <td>￥<?php echo _rmb($v['total']);?> 元</td>
        <td><?php echo _time($v['addtime']);?></td>
            <td><?php echo$v['status']; ?></td>
            <td><a href="<?php echo _u('/order/show/'.$v['id'].'/'); ?>" class="tablelink">查看</a></td>
        </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
    <div class="pagin">
        <div class="message">共<i class="blue"><?php echo Page::$num;?></i>条记录，当前显示第&nbsp;<i class="blue"><?php echo Page::$p;?>&nbsp;</i>页</div>
        <ul class="paginList">
        <li class="paginItem"><a href="<?php echo _u('///0/');?>"><span class="pagepre"></span></a></li>
        <li class="paginItem"><a href="<?php echo _u('///'.Page::$pre.'/');?>">上页</a></li>
        <li class="paginItem"><a href="<?php echo _u('///'.Page::$next.'/');?>">下页</a></li>
        <li class="paginItem"><a href="<?php echo _u('///'.Page::$pnum.'/');?>"><span class="pagenxt"></span></a></li>
        </ul>
    </div>
    </div>
    <script type="text/javascript">
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>
</body>
</html>