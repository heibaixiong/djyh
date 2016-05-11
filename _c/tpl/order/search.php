<?php
if(!defined('PART'))exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php
    _css('style');
    _css('jquery.datetimepicker');
    _jq();
    _js('jquery.datetimepicker');
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
        <li>订单搜索</li>
        <li><?php echo $_['title'];?></li>
    </ul>
</div>
<div class="rightinfo">
    <div class="tools">
        <ul class="toolbar" style="margin-bottom: 5px;">
            <li style="margin-bottom: 5px;padding: 0 5px 0 5px;">发件人：<input type="text" name="" value="" class="dfinput" style="width: 150px;" /></li>
            <li style="margin-bottom: 5px;padding: 0 5px 0 5px;">发件人电话：<input type="text" name="" value="" class="dfinput" style="width: 150px;" /></li>
            <li style="margin-bottom: 5px;padding: 0 5px 0 5px;">发货地址：<input type="text" name="" value="" class="dfinput" style="width: 200px;" /></li>
            <li style="margin-bottom: 5px;padding: 0 5px 0 5px;">下单时间：<input type="text" name="" value="" class="dfinput" style="width: 100px;" id="date-picker-start" /> - <input type="text" name="" value="" class="dfinput" style="width: 100px;" id="date-picker-end" /></li>

            <li style="margin-bottom: 5px;padding: 0 5px 0 5px; clear: both;">收件人：<input type="text" name="" value="" class="dfinput" style="width: 150px;" /></li>
            <li style="margin-bottom: 5px;padding: 0 5px 0 5px;">收件人电话：<input type="text" name="" value="" class="dfinput" style="width: 150px;" /></li>
            <li style="margin-bottom: 5px;padding: 0 5px 0 5px;">收货地址：<input type="text" name="" value="" class="dfinput" style="width: 200px;" /></li>
            <li style="margin-bottom: 5px;padding: 0 5px 0 5px;">
                订单状态：<select name="">
                    <option value="">全部</option>
                    <?php foreach ($_['order_status'] as $k => $item) { ?>
                        <option value="<?php echo $k; ?>"><?php echo $item; ?></option>
                    <?php } ?>
                </select>
            </li>
            <li class="click"><a href="javascript:void(0);"><span><img src="<?php echo _img('ico06.png');?>" /></span>搜索</a></li>
        </ul>
    </div>
    <table class="tablelist">
        <thead>
        <tr>
            <th>订单号</th>
            <th>发件人</th>
            <th>发件人电话</th>
            <th>发货地</th>
            <th>收货地</th>
            <th>运费</th>
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
                <td><?php echo str_repeat('0', 12-strlen($v['id'])).$v['id']; ?></td>
                <td><?php echo $v['ship_name']; ?></td>
                <td><?php echo $v['ship_phone']?></td>
                <td><?php echo $v['ship_prov'].'/'.$v['ship_city'].'/'.$v['ship_area']; ?></td>
                <td><?php echo $v['consignee_prov'].'/'.$v['consignee_city'].'/'.$v['consignee_area']; ?></td>
                <td>￥<?php echo _rmb($v['ship_amount']);?> 元</td>
                <td><?php echo _time($v['mod_time']);?></td>
                <td><?php echo $_['order_status'][$v['status']]; ?></td>
                <td><a href="<?php echo _u('/order/edit/'.$v['id'].'/'); ?>" class="tablelink">查看</a></td>
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
    $(document).ready(function(){
        $('#date-picker-start').datetimepicker({
            lang:'ch',
            timepicker:false,
            format:'Y-m-d',
            formatDate:'Y/m/d',
            maxDate:'+1970/01/01'
        });
        $('#date-picker-end').datetimepicker({
            lang:'ch',
            timepicker:false,
            format:'Y-m-d',
            formatDate:'Y/m/d',
            maxDate:'+1970/01/01'
        });
    });
</script>
</body>
</html>