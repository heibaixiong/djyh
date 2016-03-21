<?php
if(!defined('PART'))exit;
function __show(){
	_c('rs',_sqlone('notice','id='._v(3)));
	_tpl();
}
?>