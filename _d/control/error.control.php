<?php
if(!defined('PART'))exit;
function __index() {
	die('Error Page.');
}

function __not_found() {
	die('Page Not Found.');
}

function __denied() {
	die('Access Denied.');
}
