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
	if(!is_null($key)){
		if (empty($key)) $key = null;
		_session('key',$key);
	}

	$key=_session('key');
	$_['key']=$key;
	$sql = "o.status >= '3' and o.ship_number != ''";
	if(!empty($key)){
		$sql .= ' and (o.ship_number like \'%'._escape($key).'%\' or o.ship_phone like \'%'._escape($key).'%\' or o.ship_name like \'%'._escape($key).'%\')';
	}
	if ($s <> '') {
		$sql .= ' and o.status = \''.$s.'\'';
	}

	$sql = _pre('ship_order')." as o " .
		   "left join "._pre('ship_user')." as u on o.wx_open_id=o.rob_open_id " .
			"left join "._pre('ship_user_info')." as ui on u.id=ui.uid " .
			"left join "._pre('ship_to_stowage')." as s2s on o.ship_number=s2s.ship_number " .
			"left join "._pre('ship_stowage')." as ss on ss.id=s2s.stowage_id " .
		   "where " . $sql
	;
	if (!(strlen(_session('adminrank')) > 0 && _session('adminrank') == '0')) $sql .= "  and (ui.mid='".floatval(_session('code'))."' OR (o.mid > 0 and o.mid='".floatval(_session('code'))."') OR (ss.mid='".floatval(_session('code'))."' OR ss.to_mid='".floatval(_session('code'))."'))";

	//Page::start('ship_order', $p, $sql, 'id desc');
	Page::select($sql, 'o.*, ui.real_name as rob_name', 'o.ship_number', 'o.id desc', $p);

	foreach (Page::$arr as $k => $order) {
		//$sql = "select u.*, ui.* from "._pre('ship_user')." u left join "._pre('ship_user_info')." ui on u.id=ui.uid where u.wx_open_id='{$order['rob_open_id']}'";
		//$rob_user = _sqlselect($sql);
		//Page::$arr[$k]['rob_user'] = $rob_user?$rob_user[0]:array();
		Page::$arr[$k]['ship_status'] = '';
		if ($order['status'] == 4) {
			$sql = "select s.status from "._pre('ship_to_stowage')." as s2s inner join "._pre('ship_stowage')." as s on s2s.stowage_id=s.id where s2s.ship_number='{$order['ship_number']}' and s.status>0 order by s.id desc";
			$res = _sqlselect($sql);
			if (!empty($res)) {
				Page::$arr[$k]['ship_status'] = $res[0]['status'];
			}
		}
		if (empty($order['rob_name']) && $order['mid'] > 0) {
			Page::$arr[$k]['rob_name'] = _sqlfield('ship_company', 'name', 'id=\''.(int)$order['mid'].'\'');
		}
	}

	_c('title', $s==''?'全部':$_['order_status'][$s]);
	_c('order_status', $_['order_status']);

	_tpl('/list');
}

function __pick() {
	$order =  _sqlone('ship_order','status=3 and mid=0 and id='.intval(_v(3)));

	if (empty($order)) {
		_alerturl('运单不存在或当前状态不允许此操作！', _u('//list/'._v(4).'/'._v(5).'/'));
	}

	$data = array();
	$data['mid'] = intval(_session('code'));
	$data['ship_time'] = time();
	if ($done = _sqlupdate('ship_order', $data, 'status=3 and mid=0 and id='.intval(_v(3)))) {
		_sqlinsert('ship_order_status', array(
			'ship_number' => floatval($order['ship_number']),
			'status_before' => $order['status'],
			'status_after' => $order['status'],
			'content' => '已到达：【'._session('admincompany').'】',
			'mid' => floatval(_session('adminid')),
			'add_time' => time(),
			'sys' => 1
		));
		_alerturl('操作成功！', _u('//list/'._v(4).'/'._v(5).'/'));
	} else {
		_alertback('操作失败，请稍后再试！');
	}
}

function __deliver() {
	$order =  _sqlone('ship_order','status=4 and id='.intval(_v(3)));

	if (empty($order)) {
		_alerturl('运单不存在或当前状态不允许此操作！', _u('//list/'._v(4).'/'._v(5).'/'));
	}

	$sql = "select s.* from "._pre('ship_to_stowage')." as s2s inner join "._pre('ship_stowage')." as s on s2s.stowage_id=s.id where s2s.ship_number='{$order['ship_number']}' and s.status>0 order by s.id desc";
	$res = _sqlselect($sql);
	if (!empty($res) && $res[0]['status'] == 3 && $res[0]['to_mid'] == floatval(_session('code'))) {
		$data = array();
		$data['status'] = 5;
		$data['complete_time'] = time();
		if ($done = _sqlupdate('ship_order', $data, 'status=4 and id='.intval(_v(3)))) {
			_sqlinsert('ship_order_status', array(
				'ship_number' => floatval($order['ship_number']),
				'status_before' => 4,
				'status_after' => 5,
				'content' => '派件中：【'._session('admincompany').'】',
				'mid' => floatval(_session('adminid')),
				'add_time' => time(),
				'sys' => 0
			));
			if (!empty(_post('status_content'))) {
				_sqlinsert('ship_order_status', array(
					'ship_number' => floatval($order['ship_number']),
					'status_before' => 5,
					'status_after' => 5,
					'content' => _post('status_content'),
					'mid' => floatval(_session('adminid')),
					'add_time' => time(),
					'sys' => 1
				));
			}
			$check = _sqlone('ship_order', 'status=5 and ship_number=\''.floatval($order['ship_number']).'\'');
			if ($check) {
				_sendWxMsg($check['wx_open_id'], '您的订单：['.str_repeat('0', 12-strlen($check['id'])).$check['id'].'], 由：【'._session('admincompany').'】正在派件中');
			}
			_alerturl('操作成功！', _u('//list/'._v(4).'/'._v(5).'/'));
		} else {
			_alertback('操作失败，请稍后再试！');
		}
	}
}

function __receive() {
	$order =  _sqlone('ship_order','status=4 and id='.intval(_v(3)));

	if (empty($order)) {
		_alerturl('运单不存在或当前状态不允许此操作！', _u('//list/'._v(4).'/'._v(5).'/'));
	}

	$sql = "select s.* from "._pre('ship_to_stowage')." as s2s inner join "._pre('ship_stowage')." as s on s2s.stowage_id=s.id where s2s.ship_number='{$order['ship_number']}' and s.status>0 order by s.id desc";
	$res = _sqlselect($sql);
	if (!empty($res) && $res[0]['status'] == 3 && $res[0]['to_mid'] == floatval(_session('code'))) {
		$data = array();
		$data['status'] = 6;
		$data['complete_time'] = time();
		if ($done = _sqlupdate('ship_order', $data, 'status=4 and id='.intval(_v(3)))) {
			_sqlinsert('ship_order_status', array(
				'ship_number' => floatval($order['ship_number']),
				'status_before' => 4,
				'status_after' => 6,
				'content' => '已提货：【'._session('admincompany').'】',
				'mid' => floatval(_session('adminid')),
				'add_time' => time(),
				'sys' => 0
			));
			if (!empty(_post('status_content'))) {
				_sqlinsert('ship_order_status', array(
					'ship_number' => floatval($order['ship_number']),
					'status_before' => 6,
					'status_after' => 6,
					'content' => _post('status_content'),
					'mid' => floatval(_session('adminid')),
					'add_time' => time(),
					'sys' => 1
				));
			}
			$check = _sqlone('ship_order', 'status=6 and ship_number=\''.floatval($order['ship_number']).'\'');
			if ($check) {
				_sendWxMsg($check['wx_open_id'], '您的订单：['.str_repeat('0', 12-strlen($check['id'])).$check['id'].'], 已在：【'._session('admincompany').'】完成提货！');
			}
			_alerturl('操作成功！', _u('//list/'._v(4).'/'._v(5).'/'));
		} else {
			_alertback('操作失败，请稍后再试！');
		}
	}
}

function __show(){
	$order =  _sqlone('ship_order','id='.intval(_v(3)));

	if (empty($order)) {
		_alerturl('运单不存在！', _u('//list/'._v(4).'/'._v(5).'/'));
	}

	$order['ship_status'] = '';
	$order['ship_states'] = array();
	if ($order['status'] == 4) {
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
