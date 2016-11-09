<?php
class templateNews{
	

	public $thisWxUser;

	public function __construct(){
		
		$where=array('token'=>session('token'));

		$this->thisWxUser=M('Wxuser')->field('appid','appsecret')->where($where)->find();

	}


	public function sendTempMsg($tempKey,$dataArr){
return;

	/* //example
		$tempKey = 'TM00130';
		$dataArr = array('href' => 'http://www.baidu.com' , 'wecha_id' => 'oLA6VjgLrB3qPspOBRMYZZJpVkGQ' , 'first' => '您好，您已成功预约看房。' , 'apartmentName' => '丽景华庭' , 'roomNumber' => 'A栋534' , 'address' => '广州市微信路88号', 'time' => '2013年10月30日 15:32', 'remark' => '请您准时到达看房。');
	*/
		$open = M('Tempmsg')->where(array('token'=>session('token'),'tempkey'=>"$tempKey"))->getField('status');
	if($open){
	// 获取配置信息
		$dbinfo = M('Tempmsg')->where(array('token'=>session('token'),'tempkey'=>"$tempKey"))->find();


	//	获取access_token  $json->access_token
		$url_get='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->thisWxUser['appid'].'&secret='.$this->thisWxUser['appsecret'];

		$json=json_decode($this->curlGet($url_get));

		if ($json->errmsg){
			 
			 $this->error('获取access_token发生错误：错误代码'.$json->errcode.',微信返回错误信息：'.$json->errmsg);
		}


	// 准备发送请求的数据 
		$requestUrl = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$json->access_token;

		$data = $this->getData($tempKey,$dataArr,$dbinfo['textcolor']);

		$sendData = '{"touser":"'.$dataArr["wecha_id"].'","template_id":"'.$dbinfo["tempid"].'","url":"'.$dataArr["href"].'","topcolor":"'.$dbinfo["topcolor"].'","data":'.$data.'}';


		$this->postCurl($requestUrl,$sendData);
		
	}

	}

// Get Data.data
	public function getData($key,$dataArr,$color){


		$tempsArr = $this->templates();

		$data = $tempsArr["$key"]['vars'];
		$data = array_flip($data);

		foreach($dataArr as $k => $v){
			if(in_array($k,array_flip($data))){
				$jsonData .= '"'.$k.'":{"value":"'.$v.'","color":"'.$color.'"},';
			}
		}

		$jsonData = rtrim($jsonData,',');

		return "{".$jsonData."}"; 
	}

	
	public function templates(){
		return array(

		'TM00130' =>
			array(
				'name'=>'预约看房通知',
				'vars'=>array('first','apartmentName','roomNumber','address','time','remark'),
				'content'=>	
'{{first.DATA}}
预约楼盘：{{apartmentName.DATA}}
房号：{{roomNumber.DATA}}
楼盘地址：{{address.DATA}}
预约时间：{{time.DATA}}
{{remark.DATA}}'
				),
/*			'TM00667' =>
			array(
				'name'=>'订单交易完成通知',
				'vars'=>array('first','keynote1','keynote2','keynote3','keynote4','keynote5','remark'),
				'content'=>
'{{first.DATA}}   
{{keynote1.DATA}}微信昵称：{{keynote2.DATA}}           
房屋交易服务商：{{keynote3.DATA}}
交易完成时间：{{keynote4.DATA}} 
房屋名称：{{keynote5.DATA}}
{{remark.DATA}}'
				),
		'TM00666' =>
			array(
				'name'=>'新订单待处理通知',
				'vars'=>array('first','keynote1','keynote2','keynote3','remark'),
				'content'=>
'{{first.DATA}}   
对方微信昵称：{{keynote1.DATA}}           
订单时间：{{keynote2.DATA}}
房屋名称：{{keynote3.DATA}}
{{remark.DATA}}'
				), */
		'TM00785' =>
			array(
				'name'=>'开奖结果通知',
				'vars'=>array('first','program','result','remark'),
				'content'=>'
{{first.DATA}}
开奖项目：{{program.DATA}}
中奖详情：{{result.DATA}}
{{remark.DATA}}'
			),
		'TM00820' =>
			array(
				'name'=>'服务完成通知',
				'vars'=>array('first','keynote1','keynote2','remark'),
				'content'=>'
{{first.DATA}}
完成情况：{{keynote1.DATA}}
完成日期：{{keynote2.DATA}}
{{remark.DATA}}'
			),

		);
	}

// Post Request
	function postCurl($url, $data){
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_SSLVERSION, 3);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$tmpInfo = curl_exec($ch);
		$errorno=curl_errno($ch);
		if ($errorno) {
			return array('rt'=>false,'errorno'=>$errorno);
		}else{
			$js=json_decode($tmpInfo,1);
			if ($js['errcode']=='0'){
				return array('rt'=>true,'errorno'=>0);
			}else {
				//$this->error('模板消息发送失败。错误代码'.$js['errcode'].',错误信息：'.$js['errmsg']);
				return array('rt'=>false,'errorno'=>$js['errcode'],'errmsg'=>$js['errmsg']);

			}
		}
	}




// Get Access_token Request
	function curlGet($url){
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_SSLVERSION, 3);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$temp = curl_exec($ch);
		return $temp;
	}



}
