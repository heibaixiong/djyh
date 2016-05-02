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
        <li>运单管理</li>
        <li>查看运单</li>
    </ul>
</div>
<div class="formbody">
    <div id="usual1" class="usual">
        <div id="tab1" class="tabson">
            <ul class="forminfo">
                <li><label>运 单 号：</label><p style="padding-top: 10px;"><?php echo $_['order']['ship_number']; ?></p></li>
                <li><label>发 货 人：</label><p style="padding-top: 10px;"><?php echo $_['order']['ship_name']; ?></p></li>
                <li><label>手　　机：</label><p style="padding-top: 10px;"><?php echo $_['order']['ship_phone']; ?></p></li>
                <li><label>发货地址：</label><p style="padding-top: 10px;"><?php echo $_['order']['ship_prov'].$_['order']['ship_city'].$_['order']['ship_area'].$_['order']['ship_address']?></p></li>
                <li><label>收 货 人：</label><p style="padding-top: 10px;"><?php echo $_['order']['consignee_name']; ?></p></li>
                <li><label>手　　机：</label><p style="padding-top: 10px;"><?php echo $_['order']['consignee_phone']; ?></p></li>
                <li><label>发货地址：</label><p style="padding-top: 10px;"><?php echo $_['order']['consignee_prov'].$_['order']['consignee_city'].$_['order']['consignee_area'].$_['order']['consignee_address']?></p></li>
                <li><label>重　　量：</label><p style="padding-top: 10px;"><?php echo $_['order']['ship_weight']; ?>kg</p></li>
                <li><label>体　　积：</label><p style="padding-top: 10px;"><?php echo $_['order']['ship_cubic']; ?>m³</p></li>
                <li><label>数　　量：</label><p style="padding-top: 10px;"><?php echo $_['order']['ship_quantity']; ?>件</p></li>
                <li><label>内　　容：</label><p style="padding-top: 10px;"><?php echo $_['order']['ship_desc']; ?></p></li>
                <li><label>照　　片：</label>
                    <?php if (is_file(DIR.$_['order']['ship_image'])) echo '<img src="'._resize($_['order']['ship_image'], 100, 100).'" />'; ?>&nbsp;
                    <?php if (is_file(DIR.$_['order']['ship_image1'])) echo '<img src="'._resize($_['order']['ship_image1'], 100, 100).'" />'; ?>&nbsp;
                    <?php if (is_file(DIR.$_['order']['ship_image2'])) echo '<img src="'._resize($_['order']['ship_image2'], 100, 100).'" />'; ?>&nbsp;
                </li>
                <li><label>运　　费：</label><p style="padding-top: 10px;">￥<?php echo _rmb($_['order']['ship_amount']); ?></p></li>
                <li><label>付款方式：</label><p style="padding-top: 10px;"><?php echo $_['order']['pay_method']=='cash'?'现付':'到付'; ?></p></li>
                <li><label>代收货款：</label><p style="padding-top: 10px;"><?php echo $_['order']['ship_cod']>0?'是':'否'; ?></p></li>
                <li><label>备　　注：</label><p style="padding-top: 10px;"><?php echo $_['order']['ship_note']; ?></p></li>
                <li><label>下单时间：</label><p style="padding-top: 10px;"><?php echo _time($_['order']['add_time']); ?></p></li>
                <li><label>运单状态：</label>
                    <p style="padding-top: 10px;">
                        <?php echo $_['order_status'][$_['order']['status']]; ?>
                        <?php if (strlen($_['order']['ship_status'])>0) echo '['.$_['stowage_status'][$_['order']['ship_status']].']'; ?>
                    </p>
                </li>
                <?php if ($_['order']['ship_states']) { ?>
                    <li><label>物流跟踪：</label>
                        <table class="tablelist">
                            <thead>
                            <tr>
                                <th width="30%">时间</th>
                                <th width="25%">发住</th>
                                <th width="25%">上一站</th>
                                <th width="10%">状态</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($_['order']['ship_states'] as $state) { ?>
                            <tr>
                                <td><?php echo _time($state['mod_time']); ?></td>
                                <td><?php echo $state['prov_e'].'/'.$state['city_e'].'/'.$state['area_e']; ?></td>
                                <td><?php echo $state['prov_s'].'/'.$state['city_s'].'/'.$state['area_s']; ?></td>
                                <td><?php echo $_['stowage_status'][$state['status']]; ?></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.tablelist tbody tr:odd').addClass('odd');
</script>
</body>
</html>