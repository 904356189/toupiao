<?php
class Taobao
{
	public function collectCates()
	{
		setTimeLimit(3600);
		$ccate = FDB::fetchFirst('SELECT * FROM '.FDB::table('goods_cate_collect').' LIMIT 0,1');
		if(!$ccate)
			return false;
		
		FDB::query('DELETE FROM '.FDB::table('goods_cate_collect')." WHERE id = '$ccate[id]'");
		
		global $_FANWE;
		include_once FANWE_ROOT.'sdks/taobao/TopClient.php';
        include_once FANWE_ROOT.'sdks/taobao/request/ItemcatsGetRequest.php';
		Cache::getInstance()->loadCache('business');
		$sort_file = FANWE_ROOT.'/public/records/cate.sort.php';
		$sort = (int)@file_get_contents($sort_file);
		
		$client = new TopClient;
        $client->appkey = trim($_FANWE['cache']['business']['taobao']['app_key']);
        $client->secretKey = trim($_FANWE['cache']['business']['taobao']['app_secret']);
		
		$req = new ItemcatsGetRequest;
		$req->setFields("cid,parent_cid,name,is_parent");
		$req->setParentCid($ccate['cid']);
		$resp = $client->execute($req);
		if(isset($resp->item_cats) && isset($resp->item_cats->item_cat))
		{
			foreach($resp->item_cats->item_cat as $item)
			{
				$item = (array)$item;
				$cate = array();
				$cate['type'] = 'taobao';
				$cate['id'] = $item['cid'];
				$cate['pid'] = $item['parent_cid'] == 0 ? '' : $item['parent_cid'];
				$cate['name'] = $item['name'];
				$cate['pids'] = empty($ccate['pids']) ? $cate['pid'] : $ccate['pids'].','.$cate['pid'];
				$cate['sort'] = ++$sort;
				FDB::insert('goods_cates',$cate,false,true);
				if($item['is_parent'] == 'true')
					FDB::insert('goods_cate_collect',array('id'=>'NULL','cid'=>$item['cid'],'pids'=>$cate['pids']));
			}
			@file_put_contents($sort_file,$sort);
		}
		return true;
	}
	
	public function collectShopCates()
	{
		setTimeLimit(3600);
		global $_FANWE;
		include_once FANWE_ROOT.'sdks/taobao/TopClient.php';
        include_once FANWE_ROOT.'sdks/taobao/request/ShopcatsListGetRequest.php';
		Cache::getInstance()->loadCache('business');
		$sort_file = FANWE_ROOT.'/public/records/cate.sort.php';
		$sort = (int)@file_get_contents($sort_file);
		
		$client = new TopClient;
        $client->appkey = trim($_FANWE['cache']['business']['taobao']['app_key']);
        $client->secretKey = trim($_FANWE['cache']['business']['taobao']['app_secret']);
		
		$req = new ShopcatsListGetRequest;
		$req->setFields("cid,parent_cid,name,is_parent");
		$resp = $client->execute($req);
		$sort = 0;
		if(isset($resp->shop_cats) && isset($resp->shop_cats->shop_cat))
		{
			foreach($resp->shop_cats->shop_cat as $item)
			{
				$item = (array)$item;
				$cate = array();
				$cate['type'] = 'taobao';
				$cate['id'] = $item['cid'];
				$cate['pid'] = $item['parent_cid'] == 0 ? '' : $item['parent_cid'];
				$cate['name'] = $item['name'];
				$cate['pids'] = '';
				$cate['sort'] = ++$sort;
				FDB::insert('shop_cates',$cate,false,true);
			}
		}
		return true;
	}

	public function collectReport($time,$page)
	{
		setTimeLimit(3600);
		global $_FANWE;
		
		if($page <= 1)
		{
			FDB::query('TRUNCATE TABLE '.FDB::table('taobaoke_report_temp'));
		}

		include_once FANWE_ROOT.'sdks/taobao/TopClient.php';
        include_once FANWE_ROOT.'sdks/taobao/request/TaobaokeReportGetRequest.php';
		Cache::getInstance()->loadCache('business');
		
		$client = new TopClient;
        $client->appkey = trim($_FANWE['cache']['business']['taobao']['app_key']);
        $client->secretKey = trim($_FANWE['cache']['business']['taobao']['app_secret']);
		
		$req = new TaobaokeReportGetRequest();
		$req->setFields("num_iid,outer_code,commission_rate,real_pay_fee,app_key,outer_code,pay_time,pay_price,commission,item_title,item_num,trade_id");
		$page_size = 100;
		$time = fToDate($time,'Ymd');
		$req->setDate($time);
		$req->setPageNo($page);
		$req->setPageSize($page_size);
		$resp = (array)$client->execute($req,trim($_FANWE["cache"]["business"]["taobao"]["session_key"]));
		$is_complete = false;
		$total_results = 0;

		if(isset($resp['taobaoke_report']))
		{
			$count = 0;
			$taobaoke_report = (array)$resp['taobaoke_report'];
			$total_results = (int)$taobaoke_report['total_results'];
			
			if($total_results > 0)
			{
				$taobaoke_report_members = $taobaoke_report['taobaoke_report_members'];
				foreach($taobaoke_report_members->taobaoke_report_member as $item)
				{
					$item = (array)$item;
					$item['pay_time'] = str2Time($item['pay_time']);
					$item['outer_code'] = isset($item['outer_code']) ? $item['outer_code'] : '';
					$pay_day = fToDate($item['pay_time'],'Y-m-d 00:00:00');
					$item['pay_day'] = str2Time($pay_day);
					$item['commission_rate'] = $item['commission_rate'] * 100;
					$item['item_title'] = addslashes($item['item_title']);

					if(!empty($item['outer_code']) && preg_match("/^o\d+$/",$item['outer_code']))
					{
						$order_id = (float)substr($item['outer_code'],1);
						if($order_id == 0)
							continue;

						$bln = (int)FDB::resultFirst('SELECT COUNT(id) FROM '.FDB::table('taobaoke_report')." 
							WHERE outer_code = '".addslashes($item['outer_code'])."' 
								AND num_iid = '".addslashes($item['num_iid'])."' 
								AND pay_time = '".addslashes($item['pay_time'])."'");

						if($bln > 0)
							continue;
						
						$is_insert = false;
						$res = FDB::query('SELECT * FROM '.FDB::table('goods_order').' 
							WHERE order_id = '.$order_id.' AND keyid = \'taobao_'.$item['num_iid'].'\' AND status = 0');
						
						while($order = FDB::fetch($res))
						{
							$commission = ((float)$item['commission']) * ((float)$order['commission_rate'] / 100);
							
							if($_FANWE['setting']['goods_buy_score_type'] > 0 && $_FANWE['setting']['goods_buy_score_rate'] > 0)
							{
								$score = 0;
								$rate = (float)$_FANWE['setting']['goods_buy_score_rate'];
								if($_FANWE['setting']['goods_buy_score_type'] == 1)
									$score = (float)$item['real_pay_fee'] * $rate;
								else
									$score = (float)$item['commission'] * $rate;
									
								$score = round($score);
								if($score > 0)
								{
									FS('User')->updateUserScore((int)$order['uid'],'goods','commission','成功购买商品 '.$item['item_title'].' 获得积分',$order_id,$score);
								}
							}
							
							FDB::query('UPDATE '.FDB::table('goods_order').' SET status = 1,settlement_time = '.TIME_UTC.',commission = '.$commission.' WHERE order_id = '.$order_id.' AND uid = '.(int)$order['uid']);
							$is_insert = true;
						}
						
						if($is_insert)
							FDB::insert('taobaoke_report_temp',$item);
					}
				}

				if($page * $page_size >= $total_results)
				{
					FDB::query('INSERT INTO '.FDB::table('taobaoke_report').'(id,trade_id,num_iid,item_title,item_num,pay_price,real_pay_fee,commission_rate,commission,outer_code,app_key,pay_time,pay_day) SELECT NULL AS id,trade_id,num_iid,item_title,item_num,pay_price,real_pay_fee,commission_rate,commission,outer_code,app_key,pay_time,pay_day FROM '.FDB::table('taobaoke_report_temp').' ORDER BY pay_time ASC,trade_id ASC');
					return 1;
				}
				else
					return 0;
			}
			else
				return 1;
		}
		return -1;
	}
}
?>