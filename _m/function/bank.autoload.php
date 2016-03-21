<?php
if(!defined('PART'))exit;
function _id_bank($id){
	return _sqlfield('bank','title','id='.$id);
}
?>