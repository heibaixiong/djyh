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
    <script type=text/javascript>
        function selectTag(a,b,c,d,e,f){
            $(a).attr('class', 'selected');
            $(b).attr('class', '');
            $(c).attr('class', '');
            $(d).show();
            $(e).hide();
            $(f).hide();
        }
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
        <div class="itab">
            <ul>
                <li><a href="javascript:void(0);" id='a' class="selected" onClick="selectTag('#a','#b','#c','#tab1','#tab2','#tab3')">运单信息</a></li>
                <?php if (isset($_['order']['id'])) { ?>
                    <li><a href="javascript:void(0);" id='b' onClick="selectTag('#b','#c','#a','#tab2','#tab3','#tab1')">运单状态</a></li>
                    <li><a href="javascript:void(0);" id='c' onClick="selectTag('#c','#a','#b','#tab3','#tab1','#tab2')">配载记录</a></li>
                <?php } ?>
                <?php if ($_['order']['status'] == 3 && $_['order']['mid'] == 0) { ?>
                    <li style="float: right;"><a href="<?php echo _u('/ship/pick/'.$_['order']['id'].'/'._v(4).'/'._v(5).'/'); ?>" style="padding: 0px;"><input id="btn-save" type="button" class="btn" value="确认入仓" /></a></li>
                <?php } ?>
            </ul>
        </div>
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
                        <?php if ($_['order']['status']==3 && $_['order']['mid']>0) echo '[已入仓]';?>
                        <?php if (strlen($_['order']['ship_status'])>0) echo '['.$_['stowage_status'][$_['order']['ship_status']].']'; ?>
                    </p>
                </li>

            </ul>
        </div>
        <div id="tab2" class="tabson">
            <ul class="forminfo" style="padding-left: 0px;">
                <?php if ($_['order']['ship_status'] == 3 && $_['order']['ship_states'][0]['to_mid'] == floatval(_session('code'))) { ?>
                    <form method="post">
                <li><label>操作内容：</label>
                    <p style="padding-top: 10px;">
                        <textarea name="status_content" rows="6" cols="50" class=""></textarea>
                    </p>
                </li>
                <li><label>&nbsp;</label>
                    <p>
                        <input id="btn-status-deliver" type="button" class="btn" value="派件" />
                        <input id="btn-status-receive" type="button" class="btn" value="提货" />
                    </p>
                </li>
                    </form>
                    <script type="text/javascript">
                        $(document).ready(function(){
                                $('input[id="btn-status-deliver"]').click(function(){
                                    $(this).closest('form').attr('action', '<?php echo _u('/ship/deliver/'.$_['order']['id'].'/'._v(4).'/'._v(5).'/'); ?>');
                                    $(this).closest('form').submit();
                                });

                                $('input[id="btn-status-receive"]').click(function(){
                                    $(this).closest('form').attr('action', '<?php echo _u('/ship/receive/'.$_['order']['id'].'/'._v(4).'/'._v(5).'/'); ?>');
                                    $(this).closest('form').submit();
                                });
                            }
                        );
                    </script>
                <?php } ?>
                <li>
                    <table class="tablelist">
                        <thead>
                        <th width="20%">时间</th>
                        <th width="10%">前状态</th>
                        <th width="10%">后状态</th>
                        <th width="35%">内容</th>
                        <th width="25%">操作人</th>
                        </thead>
                        <tbody>
                        <?php foreach ($_['order']['status_history'] as $_state) { ?>
                            <tr>
                                <td><?php echo _time($_state['add_time']); ?></td>
                                <td><?php echo $_['order_status'][$_state['status_before']]; ?></td>
                                <td><?php echo $_['order_status'][$_state['status_after']]; ?></td>
                                <td><?php echo $_state['content']; ?></td>
                                <td><?php echo $_state['admin_name'].'['.$_state['admin_part'].']'; ?></td>
                            </tr>
                        <?php } ?>
                        <?php if (empty($_['order']['status_history'])) { ?>
                            <tr><td colspan="5" align="center">暂无记录</td></tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </li>
            </ul>
        </div>
        <div id="tab3" class="tabson">
            <ul class="forminfo" style="padding-left: 0px;">
                <li>
                    <table class="tablelist">
                        <thead>
                        <tr>
                            <th width="15%">配载单号</th>
                            <th width="15%">时间</th>
                            <th width="25%">发住</th>
                            <th width="25%">上一站</th>
                            <th width="10%">状态</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($_['order']['ship_states'] as $state) { ?>
                            <tr>
                                <td><?php echo str_repeat('0', 8-strlen($state['id'])).$state['id']; ?></td>
                                <td><?php echo _time($state['mod_time']); ?></td>
                                <td><?php echo $state['prov_e'].'/'.$state['city_e'].'/'.$state['area_e']; ?></td>
                                <td><?php echo $state['prov_s'].'/'.$state['city_s'].'/'.$state['area_s']; ?></td>
                                <td><?php echo $_['stowage_status'][$state['status']]; ?></td>
                            </tr>
                        <?php } ?>
                        <?php if (empty($_['order']['ship_states'])) { ?>
                            <tr><td colspan="5" align="center">暂无记录</td></tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </li>
            </ul>
        </div>
    </div>
</div>
<script type="text/javascript">
    //$('.tablelist tbody tr:odd').addClass('odd');
    $('.tablelist').each(function(){
        $(this).find('tbody tr:odd').addClass('odd');
    });
</script>
</body>
</html>