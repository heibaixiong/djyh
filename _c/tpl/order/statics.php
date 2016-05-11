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
    _js('highcharts');
    _js('exporting');
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
        <li>订单统计</li>
        <li><?php echo $_['title'];?></li>
    </ul>
</div>
<div class="rightinfo">
    <div class="tools">
        <ul class="toolbar" style="margin-bottom: 5px;">
            <li style="margin-bottom: 5px;padding: 0 5px 0 5px;">时间：<input type="text" name="" value="" class="dfinput" style="width: 100px;" id="date-picker-start" /> - <input type="text" name="" value="" class="dfinput" style="width: 100px;" id="date-picker-end" /></li>
            <li style="margin-bottom: 5px;padding: 0 5px 0 5px;">
                订单状态：<select name="">
                    <option value="">全部</option>
                    <?php foreach ($_['order_status'] as $k => $item) { ?>
                        <option value="<?php echo $k; ?>"><?php echo $item; ?></option>
                    <?php } ?>
                </select>
            </li>
            <li class="click"><a href="<?php echo _u('//add/'._v(3).'/'._v(4).'/');?>"><span><img src="<?php echo _img('ico06.png');?>" /></span>统计</a></li>
        </ul>
    </div>
    <div id="container" style="width:100%; height:500px;"></div>
</div>
<script type="text/javascript">
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

        $('#container').highcharts({
            chart: {
                type: 'spline'
            },
            title: {
                text: '东家物流订单统计',
                style: {
                    color: '#000',
                    font: 'bold 16px "Microsoft YaHei", "Trebuchet MS", Verdana, sans-serif'
                }
            },
            subtitle: {
                text: '<?php echo date('Y.m.d', strtotime('-14 days')) . ' - ' . date('Y.m.d'); ?>',
                style: {
                    color: '#666666',
                    font: 'bold 12px "Microsoft YaHei", "Trebuchet MS", Verdana, sans-serif'
                }
            },
            xAxis: {
                title: {
                    text: '日期'
                },
                categories: [<?php echo $_['x-labels']; ?>]
            },
            yAxis: {
                title: {
                    text: '订单数量'
                },
                labels: {
                    formatter: function() {
                        return this.value +' 件'
                    }
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true,
                valueSuffix: ' 件'
            },
            plotOptions: {
                spline: {
                    lineWidth: 4,
                    states: {
                        hover: {
                            lineWidth: 5
                        }
                    },
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1,
                        enabled: false
                    }
                }
            },
            series: [{
                name: '下单量',
                marker: {
                    symbol: 'circle'
                },
                data: [7, 6, 9, 14, 18, 21, 25, 26, 23, 18, 13, 9, 11, 45, 16]

            }, {
                name: '成交量',
                marker: {
                    symbol: 'square'
                },
                data: [3, 4, 5, 8, 11, 15, 17, 16, 14, 10, 6, 4, 8, 32, 9]
            }]
        });
    });
</script>
</body>
</html>