<?php
class Express{

	public function __construct($name,$num){
		
		return $this->getExpressInfo($this->searchExpress($name),$num);
		
	} 
	function searchExpress($keyword)
	{
		$expresses = array (
			"AAE" => "aae",
			"安捷" => "anjie",
			"安信达" => "anxinda",
			"Aramex" => "aramex",
			"CCES" => "cces",
			"长通" => "changtong",
			"程光" => "chengguang",
			"城市100" => "chengshi100",
			"传喜" => "chuanxi",
			"传志" => "chuanzhi",
			"CityLink" => "citylink",
			"东方" => "coe",
			"城市之星" => "cszx",
			"大田" => "datian",
			"大洋" => "dayang",
			"德邦" => "debang",
			"DHL" => "dhl",
			"店通" => "diantong",
			"递达" => "dida",
			"递四方" => "disifang",
			"DPEX" => "dpex",
			"D速" => "dsu",
			"百福东方" => "ees",
			"EMS" => "ems",
			"ems" => "ems",
			"凡宇" => "fanyu",
			"Fedex" => "fedex",
			"联邦" => "fedexcn",
			"飞邦" => "feibang",
			"飞豹" => "feibao",
			"原飞航" => "feihang",
			"飞狐" => "feihu",
			"飞远" => "feiyuan",
			"丰达" => "fengda",
			"飞康达" => "fkd",
			"广东邮政" => "gdyz",
			"共速达" => "gongsuda",
			"国通" => "guotong",
			"海盟" => "haimeng",
			"昊盛" => "haosheng",
			"河北建华" => "hebeijianhua",
			"华企" => "huaqi",
			"华夏龙" => "huaxialong",
			"华宇" => "huayu",
			"汇强" => "huiqiang",
			"汇通" => "huitong",
			"佳吉" => "jiaji",
			"佳怡" => "jiayi",
			"加运美" => "jiayunmei",
			"京广" => "jingguang",
			"晋越" => "jinyue",
			"急先达" => "jixianda",
			"嘉里大通" => "jldt",
			"快捷" => "kuaijie",
			"乐捷递" => "lejiedi",
			"联昊通" => "lianhaotong",
			"立即送" => "lijisong",
			"龙邦" => "longbang",
			"能达" => "nengda",
			"OCS" => "ocs",
			"平安达" => "pinganda",
			"邮政" => "pingyou",
			"全晨" => "quanchen",
			"全峰" => "quanfeng",
			"全际通" => "quanjitong",
			"全日通" => "quanritong",
			"全一" => "quanyi",
			"RPX" => "rpx",
			"如风达" => "rufeng",
			"赛澳递" => "saiaodi",
			"三态" => "santai",
			"伟邦" => "scs",
			"圣安" => "shengan",
			"盛丰" => "shengfeng",
			"盛辉" => "shenghui",
			"申通" => "shentong",
			"顺丰" => "shunfeng",
			"穗佳" => "suijia",
			"速尔" => "sure",
			"天天" => "tiantian",
			"TNT" => "tnt",
			"通成" => "tongcheng",
			"通和" => "tonghe",
			"UPS" => "ups",
			"USPS" => "usps",
			"万家" => "wanjia",
			"新邦" => "xinbang",
			"信丰" => "xinfeng",
			"源安达" => "yad",
			"亚风" => "yafeng",
			"一邦" => "yibang",
			"银捷" => "yinjie",
			"优速" => "yousu",
			"一统飞鸿" => "ytfh",
			"远成" => "yuancheng",
			"圆通" => "yuantong",
			"元智" => "yuanzhi",
			"越丰" => "yuefeng",
			"韵达" => "yunda",
			"运通" => "yuntong",
			"源伟丰" => "ywfex",
			"宅急送" => "zhaijisong",
			"芝麻开门" => "zhima",
			"中铁" => "zhongtie",
			"中通" => "zhongtong",
			"忠信达" => "zhongxinda",
			"中邮" => "zhongyou"
			);
		
		return $expresses[$keyword];
		
	}

	function getExpressInfo($companyEn, $number)
	{
		$key = "1DC833D5BE7F70E20413A370D858B4E4";
		$url= "http://api.ickd.cn/?id=1DC833D5BE7F70E20413A370D858B4E4&com=".$companyEn."&nu=".$number."&type=json&encode=utf8";
		//$url= "http://api.kuaidi100.com/api?id=".$key."&com=".$companyEn."&nu=".$number."&show=0&muti=1&order=asc";
		//var_dump($url);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		//var_dump($output);

		if(curl_errno($ch))
		{ echo 'CURL ERROR Code: '.curl_errno($ch).', reason: '.curl_error($ch);}

		curl_close($ch);

		$AllInfo = json_decode($output, true);

		if($AllInfo['message'] != "" ){
			return $AllInfo['message'];
		}else{
			$result = "";
			foreach ($AllInfo["data"] as $singleStep)
			{
				//$result .= $singleStep["time"]." ".$singleStep["context"]."<br />";
				$result .= $singleStep["time"]." ".$singleStep["context"]."\n";
			}
			return $result;
		}
	}
}
?>