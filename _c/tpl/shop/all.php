<?php
if(!defined('PART'))exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
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
    <li>商品管理</li>
    </ul>
    </div>
    <div class="rightinfo">
    <form action="<?php echo $_wrap['ctrl_url'];?>shop/<?php echo $_vew[2];?>" method="post" class="keyform">关键词：<input type="text" name="key" class="kinput" value="<?php echo $_['key'];?>" /><input type="submit" class="sinput" value="搜索" /></form>
    <table class="tablelist">
    	<thead>
    	<tr>
        <th>编号</th>
        <th>所属分类</th>
        <th>商品名称</th>
        <th>货号</th>
        <th>进货价</th>
        <th><?php echo $_['config']['name'];?>价</th>
        <th>分利</th>
        <th>地服利润</th>
        <th><?php echo $_['config']['dummy'];?></th>
        <th>上传人</th>
        <th>销量</th>
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
        <td><?php echo $v['id'];?></td>
        <td><a href="<?php echo $_wrap['ctrl_url'];?>shop/list_class/<?php echo $v['class3']?>"><?php echo $v['class3'].'--'.$v['class3name']?></a></td>
        <td><a href="<?php echo $_wrap['index'].'?'.'shop/ware/index/'.$v['id'];?>" target="_blank"><?php echo $v['title'];?></a></td>
        <td><?php echo $v['number']?></td>
        <td><?php echo $v['price']?></td>
        <td><?php echo $v['mark']?></td>
        <td><?php echo $v['share']?></td>
        <td><?php echo $v['store']?></td>
        <td><?php echo $v['vou']?></td>
        <td><?php echo $v['uname']?></td>
        <td><?php echo $v['sale']?></td>
        <td><?php echo $_wrap['state'][$v['state']]?> <a href="<?php echo $_wrap['ctrl_url'];?>shop/state/<?php echo $_vew[2];?>/<?php echo $v['id']?>" class="tablelink">改变状态</a></td>
        <td><?php echo $v['px']?></td>
        <td><?php
        if(3==$v['type']){
        ?>
        <a href="<?php echo $_wrap['ctrl_url'];?>shop/type/<?php echo $v['id'];?>" class="tablelink">转换</a> 
        <?php
        }
        ?>
        <a href="<?php echo $_wrap['ctrl_url'];?>shop/edit/<?php echo $v['id']?>" class="tablelink">编辑</a> <a href="<?php echo $_wrap['ctrl_url'];?>shop/del/<?php echo $v['id']?>" class="tablelink">删除</a></td>
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