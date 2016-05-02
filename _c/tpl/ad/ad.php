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
    <li>广告管理</li>
    </ul>
    </div>
    <div class="rightinfo">
    <div class="tools">
        <ul class="toolbar">
        <li class="click"><a href="<?php echo _u('//adadd/');?>"><span><img src="<?php echo _img('t01.png');?>" /></span>添加</a></li>
        </ul>
    </div>
    <table class="tablelist">
    	<thead>
        <tr>
        <th>编号</th>
        <th>地区</th>
        <th>位置</th>        
        <th>文字</th>
        <th>图片地址</th>
        <th>连接</th>
        <th>点击次数</th>
        <th>状态</th>
        <th>排序</th>
        <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach(Page::$arr as $k=>$v){
        ?>
        <tr>
        <td><?php echo $v['id']?></td>
        <td><?php echo $v['code']?></td>
        <td><?php echo $v['postion']?></td>
        <td><?php echo $v['title']?></td>
        <td><?php echo $v['img']?></td>
        <td><?php echo $v['url']?></td>
        <td><?php echo $v['hits']?></td>
        <td><?php echo $_['state'][$v['state']]?></td>
        <td><?php echo $v['px']?></td>
        <td><a href="<?php echo _u('/ad/adedit/'.$v['id'].'/');?>" class="tablelink">编辑</a> <a href="<?php echo _u('/ad/del/'.$v['id'].'/');?>" class="tablelink">删除</a></td>
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