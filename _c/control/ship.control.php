<?php
if(!defined('PART'))exit;

function __list(){
	global $_;
	$s=_v(3);
	$p=_v(4);
	if(strlen($s) > 0 && !array_key_exists(intval($s), $_['order_status'])){
		$s = '';
	}
	if(empty($p)){
		$p=0;
	}
	$key=_post('key');
	$session_key=_session('key');
	if(!empty($key)){
		_session('key',$key);
	}
	if(empty($key)&&!empty($session_key)){
		$key=_session('key');
	}
	$_['key']=$key;
	$sql = "o.status >= '3'";
	if(!empty($key)){
		$sql .= ' and (o.ship_number like \'%'._escape($key).'%\' or o.ship_phone like \'%'._escape($key).'%\' or o.ship_name like \'%'._escape($key).'%\')';
	}
	if ($s <> '') {
		$sql .= ' and o.status = \''.$s.'\'';
	}

	$sql = _pre('ship_order')." as o " .
		   "inner join "._pre('ship_user')." as u on o.wx_open_id=o.rob_open_id " .
		   "left join "._pre('ship_user_info')." as ui on u.id=ui.uid " .
		   "where " . $sql
	;
	if (!(strlen(_session('adminrank')) > 0 && _session('adminrank') == '0')) $sql .= " ui.mid='".floatval(_session('code'))."'";

	//Page::start('ship_order', $p, $sql, 'id desc');
	Page::select($sql, 'o.*, ui.real_name as rob_name', '', 'o.id desc', $p);

	foreach (Page::$arr as $k => $order) {
		//$sql = "select u.*, ui.* from "._pre('ship_user')." u left join "._pre('ship_user_info')." ui on u.id=ui.uid where u.wx_open_id='{$order['rob_open_id']}'";
		//$rob_user = _sqlselect($sql);
		//Page::$arr[$k]['rob_user'] = $rob_user?$rob_user[0]:array();
		Page::$arr[$k]['ship_status'] = '';
		if ($order['status'] > 3) {
			$sql = "select s.status from "._pre('ship_to_stowage')." as s2s inner join "._pre('ship_stowage')." as s on s2s.stowage_id=s.id where s2s.ship_number='{$order['ship_number']}' and s.status>0 order by s.id desc";
			$res = _sqlselect($sql);
			if (!empty($res)) {
				Page::$arr[$k]['ship_status'] = $res[0]['status'];
			}
		}
	}

	_c('title', $s==''?'全部':$_['order_status'][$s]);
	_c('order_status', $_['order_status']);

	_tpl('/list');
}

function __show(){
	$order =  _sqlone('ship_order','id='.intval(_v(3)));

	if (empty($order)) {
		_alerturl('运单不存在！', _u('//list/'._v(4).'/'._v(5).'/'));
	}

	$order['ship_status'] = '';
	$order['ship_states'] = array();
	if ($order['status'] > 3) {
		$sql = "select s.* from "._pre('ship_to_stowage')." as s2s inner join "._pre('ship_stowage')." as s on s2s.stowage_id=s.id where s2s.ship_number='{$order['ship_number']}' and s.status>0 order by s.id desc";
		$res = _sqlselect($sql);
		if (!empty($res)) {
			$order['ship_status'] = $res[0]['status'];
			$order['ship_states'] = $res;
		}
	}

	$sql = "select s.*, a.name as admin_name, a.company as admin_part from "._pre('ship_order_status')." as s left join "._pre('ship_admin')." as a on s.mid=a.id where s.ship_number='{$order['ship_number']}' order by s.add_time desc, id desc";
	$order['status_history'] = _sqlselect($sql);

	_c('order', $order);

	_tpl('/show');
}
