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
        <li>网点管理</li>
        <li><?php echo $_['title'];?></li>
    </ul>
</div>
<div class="rightinfo">
    <div class="tools">
        <ul class="toolbar">
            <li class="click"><a href="<?php echo _u('//add_company/'._v(3).'/'._v(4).'/');?>"><span><img src="<?php echo _img('t01.png');?>" /></span>添加</a></li>
        </ul>
    </div>
    <table class="tablelist">
        <thead>
        <tr>
            <th>编号</th>
            <th>名称</th>
            <th>所在地</th>
            <th>电话</th>
            <th>登记时间</th>
            <th>等级</th>
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
                <td><?php echo $v['name']; ?></td>
                <td><?php echo $v['prov'].'/'.$v['city'].'/'.$v['area']; ?></td>
                <td><?php echo $v['phone']; ?></td>
                <td><?php echo _time($v['add_time']);?></td>
                <td><?php echo $_['user_ranks'][$v['rank']]; ?></td>
                <td><?php echo $_['status'][$v['status']]; ?></td>
                <td><a href="<?php echo _u('/user/edit_company/'.$v['id'].'/'._v(3).'/'._v(4).'/'); ?>" class="tablelink">编辑</a></td>
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