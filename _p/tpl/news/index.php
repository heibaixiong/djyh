<?php
if(!defined('PART'))exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_['title'];?></title>
<?php
_css('default');
_css('v1.0');
_css('style');
?>
</head>
<body>
<?php
_part('top');
_part('head');
_part('nav');
?>
<!-- 主体 -->
<div class="layout_wrap">
                <?php
                _part('newsleft');
                ?>
                <div class="prod_return khfwrightCon">
                    <div class="cont">                        
                        <div>
							<div class="zhjf-title">
							    新闻中心
							    <span style="float: right; font-size: 8px; color: gray"></span>
							</div>
							<div class="pad10">
							    <div style="margin-top: 10px;" class="zh_jf_table">
							        <table cellspacing="0" cellpadding="0" width="100%" class="tip-table">
							            <thead>
							                <tr><th width="50%">标题</th><th>日期</th>
							            </tr></thead>
							                <tbody>
							                	<?php
							                	foreach(Page::$arr as $k=>$v){
							                	?>
							                	<tr>
							                    <td style="cursor: pointer;"><a href="<?php echo _u('/news/show/'.$v['id'].'/');?>"><?php echo $v['title'];?></a></td>
							                    <td><?php echo _time($v['addtime']);?></td>
							                	</tr>
							                	<?php
							                	}
							                	?>
							        </tbody></table>
							    </div>
							</div>
							<div class="pageWrap">
							    <div class="turn_page clearfix">
							    	<div class="fl"><a disabled="disabled" href="<?php echo _u('///'._v(3).'/0/');?>">首页</a><a disabled="disabled" href="<?php echo _u('///'._v(3).'/'.Page::$pre.'/');?>">上一页</a><span class="page_cur"><?php echo Page::$p;?></span><a href="<?php echo _u('///'._v(3).'/'.Page::$next.'/');?>">下一页</a><a href="<?php echo _u('///'._v(3).'/'.Page::$pnum.'/');?>">尾页</a></div>
							    </div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
<!-- //主体 -->
<?php
_part('footer1');
_part('footer2');
_part('footer3');
?>
</body>
</html>