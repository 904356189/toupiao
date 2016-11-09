<?php
require_once FANWE_ROOT.'sdks/paipai/PaiPaiOpenApiOauth.php';
require_once FANWE_ROOT.'sdks/paipai/Util.php';
class Paipai
{
	public function collectCates()
	{
		setTimeLimit(3600);
		$ccate = FDB::fetchFirst('SELECT * FROM '.FDB::table('goods_cate_collect').' LIMIT 0,1');
		if(!$ccate)
			return false;
		
		FDB::query('DELETE FROM '.FDB::table('goods_cate_collect')." WHERE id = '$ccate[id]'");
		
		global $_FANWE;
		Cache::getInstance()->loadCache('business');
		
		//QQ号
		define('PAIPAI_API_UIN',trim($_FANWE['cache']['business']['paipai']['uin']));
		//令牌
		define('PAIPAI_API_APPOAUTHID',trim($_FANWE['cache']['business']['paipai']['appoauthid']));
		//APP_KEY
		define('PAIPAI_API_APPOAUTHKEY',trim($_FANWE['cache']['business']['paipai']['appoauthkey']));
		define('PAIPAI_API_ACCESSTOKEN',trim($_FANWE['cache']['business']['paipai']['accesstoken']));
		define('PAIPAI_API_USERID',trim($_FANWE['cache']['business']['paipai']['userid']));
		
		$sdk = new PaiPaiOpenApiOauth(PAIPAI_API_APPOAUTHID,PAIPAI_API_APPOAUTHKEY,PAIPAI_API_ACCESSTOKEN,PAIPAI_API_UIN);
		$sdk->setApiPath("/attr/getNavigationChildList.xhtml");
		$sdk->setMethod("get");
		$sdk->setCharset("utf-8");
		$sdk->setFormat("json");
		$params = &$sdk->getParams();
		$params["navigationId"] = $ccate['cid'];
		
		//请求数据
		$json = $sdk->invoke();
		$json = preg_replace("/[\r\n]/",'',$json);
		preg_match("/getNavigationChildListSuccess\((.+?)\);\}catch\(/",$json,$list);
		$list = json_decode($list[1],true);
		
		$sort_file = FANWE_ROOT.'/public/records/cate.sort.php';
		$sort = (int)@file_get_contents($sort_file);
		if(isset($list['childList']))
		{
			foreach($list['childList'] as $item)
			{
				$cate = array();
				$cate['type'] = 'paipai';
				$cate['id'] = (int)$item['navigationId'];
				if($cate['id'] > 0)
				{
					$cate['pid'] = $ccate['cid'] == 0 ? '' : $ccate['cid'];
					$cate['name'] = (string)$item['navigationName'];
					$cate['pids'] = empty($ccate['pids']) ? $cate['pid'] : $ccate['pids'].','.$cate['pid'];
					$cate['sort'] = ++$sort;
					FDB::insert('goods_cates',$cate,false,true);
					if((int)$item['isClass'] == 0)
						FDB::insert('goods_cate_collect',array('id'=>'NULL','cid'=>$cate['id'],'pids'=>$cate['pids']));
				}
			}
			@file_put_contents($sort_file,$sort);
		}
		return true;
	}
}
?>