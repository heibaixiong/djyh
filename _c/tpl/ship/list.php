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
    <li>运单管理</li>
    <li><?php echo $_['title'];?></li>
    </ul>
    </div>
    <div class="rightinfo">
    <table class="tablelist">
    	<thead>
        <tr>
            <th>运单号</th>
            <th>发货人</th>
            <th>发货地</th>
            <th>收货地</th>
            <th>数量</th>
            <th>运费</th>
            <th>揽件员</th>
            <th>时间</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach(Page::$arr as $k=>$v){
        ?>
        <tr>
            <td><?php echo $v['ship_number']; ?></td>
            <td><?php echo $v['ship_name']; ?></td>
            <td><?php echo $v['ship_prov'].'/'.$v['ship_city'].'/'.$v['ship_area']; ?></td>
            <td><?php echo $v['consignee_prov'].'/'.$v['consignee_city'].'/'.$v['consignee_area']; ?></td>
            <td><?php echo $v['ship_quantity']?></td>
            <td>￥<?php echo _rmb($v['ship_amount']);?> 元</td>
            <td><?php echo $v['rob_user']?($v['rob_user']['real_name']):''; ?></td>
            <td><?php echo _time($v['pick_time']);?></td>
            <td>
                <?php echo $_['order_status'][$v['status']]; ?>
                <?php if (strlen($v['ship_status']) > 0) echo '['.$_['stowage_status'][$v['ship_status']].']';?>
            </td>
            <td><a href="<?php echo _u('/ship/show/'.$v['id'].'/'); ?>" class="tablelink">查看</a></td>
        </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
    <div class="pagin">
        <div class="message">共<i class="blue"><?php echo Page::$num;?></i>条记录，当前显示第&nbsp;<i class="blue"><?php echo Page::$p;?>&nbsp;</i>页</div>
        <ul class="paginList">
        <li class="paginItem"><a href="<?php echo _u('///'._v(3).'/1/');?>"><span class="pagepre"></span></a></li>
        <li class="paginItem"><a href="<?php echo _u('///'._v(3).'/'.Page::$pre.'/');?>">上页</a></li>
        <li class="paginItem"><a href="<?php echo _u('///'._v(3).'/'.Page::$next.'/');?>">下页</a></li>
        <li class="paginItem"><a href="<?php echo _u('///'._v(3).'/'.Page::$pnum.'/');?>"><span class="pagenxt"></span></a></li>
        </ul>
    </div>
    </div>
    <script type="text/javascript">
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>
</body>
</html>