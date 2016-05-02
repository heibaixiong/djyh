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
    <li>会员管理</li>
    <li><?php echo $_['title'];?></li>
    </ul>
    </div>
    <div class="rightinfo">
    <div class="tools">    
        <ul class="toolbar">
        <li class="click"><a href="<?php echo _u('//add/'._v(3).'/');?>"><span><img src="<?php echo _img('t01.png');?>" /></span>添加</a></li>
        </ul>
    </div>
    <table class="tablelist">
    	<thead>
        <tr>
        <th>编号</th>
        <th>账号</th>
        <th>姓名</th>
        <th>等级</th>
        <th>注册时间</th>
        <th>最后登录时间</th>
        <th>状态</th>
        <th>登录次数</th>
        <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach(Page::$arr as $k=>$v){
        ?>
        <tr>
        <td><?php echo $v['id']?></td>
        <td><?php echo $v['user']?></td>
        <td><?php echo $v['name']?></td>
        <td><?php echo $_['rank'][$v['rank']]?></td>
        <td><?php echo _time($v['regtime']); ?></td>
        <td><?php echo _time($v['updatetime']); ?></td>
        <td><?php echo $_['status'][$v['state']]?></td>
        <td><?php echo $v['hits']?></td>
        <td><a href="<?php echo _u('/user/edit/'.$v['id'].'/'._v(3).'/'._v(4).'/');?>" class="tablelink">编辑</a> <a href="<?php echo _u('/user/del/'.$v['id'].'/'._v(3).'/'._v(4).'/');?>" class="tablelink a-delete-btn">删除</a></td>
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

    $(document).delegate('a.a-delete-btn', 'click', function(e) {
        e.preventDefault();
        if (confirm('确定要删除吗？')) {
            window.location.href = $(this).attr('href');
        }

        return false;
    });
	</script>
</body>
</html>