<?php
if(!defined('PART'))exit;
define('STARTTIME',microtime(true));
if(!defined('APP_PATH'))define('APP_PATH',DIR.'/a/');
if(!defined('PROJECT'))define('PROJECT','pc');
if(!defined('PROJECT_PRE'))define('PROJECT_PRE','_');
if(!defined('PUB'))define('PUB',DIR.'public/');
if(!defined('UPLOAD'))define('UPLOAD',DIR.'upload/');
if(!defined('CACHE'))define('CACHE',DIR.'cache/');
if(!defined('LOGS'))define('LOGS',DIR.'logs/');
if(!defined('ERR'))define('ERR',true);
if(!defined('AUTO_LOAD'))define('AUTO_LOAD',true);
if(!defined('AUTO_CREATFILE'))define('AUTO_CREATFILE',true);
if(!defined('PRE'))define('PRE','_');
if(!defined('SALT'))define('SALT','@#@$$%%%$$#@');
if(!defined('UPLOAD_FIX'))define('UPLOAD_FIX','jpg');
if(!defined('INDEX'))define('INDEX','a.php');
if(!defined('HTML'))define('HTML','php');
?>