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
        <li>配载管理</li>
        <li><?php echo $_['title'];?></li>
    </ul>
</div>
<div class="rightinfo">
    <div class="tools">
        <ul class="toolbar">
            <li class="click"><a href="<?php echo _u('//add/'._v(3).'/'._v(4).'/');?>"><span><img src="<?php echo _img('t01.png');?>" /></span>添加</a></li>
        </ul>
    </div>
    <table class="tablelist">
        <thead>
        <tr>
            <th>编号</th>
            <th>车牌</th>
            <th>出发地</th>
            <th>目的地</th>
            <th>数量</th>
            <th>重量</th>
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
                <td><?php echo str_repeat('0', 8-strlen($v['id'])).$v['id']; ?></td>
                <td><?php echo $v['car_number']; ?></td>
                <td><?php echo $v['prov_s'].'/'.$v['city_s'].'/'.$v['area_s']; ?></td>
                <td><?php echo $v['prov_e'].'/'.$v['city_e'].'/'.$v['area_e']; ?></td>
                <td><?php echo $v['total_quantity']; ?> 件</td>
                <td><?php echo $v['total_weight']?> kg</td>
                <td><?php echo _time($v['mod_time']);?></td>
                <td><?php echo $_['stowage_status'][$v['status']]; ?></td>
                <td><a href="<?php echo _u('/stowage/edit/'.$v['id'].'/'); ?>" class="tablelink">查看</a></td>
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