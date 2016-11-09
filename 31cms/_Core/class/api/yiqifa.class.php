<?php
include_once FANWE_ROOT."sdks/yiqifa/YiqifaOpen.php";
class Yiqifa
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
		
		$yiqifa = new YiqifaOpen(trim($_FANWE['cache']['business']['yiqifa']['app_key']),trim($_FANWE['cache']['business']['yiqifa']['app_secret']));
		if($ccate['cid'] == '0')
			$list = $yiqifa->getCategoryList();
		else
			$list = $yiqifa->getSubCategory($ccate['cid'],1,10000);
		
		$sort_file = FANWE_ROOT.'/public/records/cate.sort.php';
		$sort = (int)@file_get_contents($sort_file);
		if(isset($list['categorys']))
		{
			foreach($list['categorys'] as $item)
			{
				$cate = array();
				$cate['type'] = 'yiqifa';
				if($ccate['cid'] == '0')
				{
					$cate['id'] = $item['catName'];
					$cate['name'] = $item['catName'];
				}
				else
				{
					$cate['id'] = $item['subCatName'];
					$cate['name'] = $item['subCatName'];
				}
				$cate['pid'] = $ccate['cid'] == '0' ? '' : $ccate['cid'];
				$cate['pids'] = empty($ccate['pids']) ? $cate['pid'] : $ccate['pids'].','.$cate['pid'];
				$cate['sort'] = ++$sort;
				FDB::insert('goods_cates',$cate,false,true);
				if($ccate['cid'] == '0')
					FDB::insert('goods_cate_collect',array('id'=>'NULL','cid'=>$item['catName'],'pids'=>$cate['pids']));
			}
			@file_put_contents($sort_file,$sort);
		}
		return true;
	}
}
?>