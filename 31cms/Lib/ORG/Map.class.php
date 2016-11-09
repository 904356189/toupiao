<?php
class Map
{	
	private $api_server_url;
	private $auth_params;

	public function __construct()
	{
		$this->api_server_url = "http://api.map.baidu.com/";
    	$this->auth_params = array();
   		$this->auth_params['key'] = "401f9a693dd267dd9a4661ec0895fb20";
        $this->auth_params['output'] = "json";
	}
	
	function getDistance_map($lat_a, $lng_a, $lat_b, $lng_b) {
		//R是地球半径（米）
		$R = 6366000;
		$pk = doubleval(180 / 3.14169);
		
		$a1 = doubleval($lat_a / $pk);
		$a2 = doubleval($lng_a / $pk);
		$b1 = doubleval($lat_b / $pk);
		$b2 = doubleval($lng_b / $pk);

		$t1 = doubleval(cos($a1) * cos($a2) * cos($b1) * cos($b2));
		$t2 = doubleval(cos($a1) * sin($a2) * cos($b1) * sin($b2));
		$t3 = doubleval(sin($a1) * sin($b1));
		$tt = doubleval(acos($t1 + $t2 + $t3));

		return round($R * $tt);
	}
	public function Place_search($query, $location, $radius) 
	{
		return $this->call("place/search", array("query" => $query, "location" => $location, "radius" => $radius));
	}
    
    protected function call($method, $params = array())
    {
		$headers = array(
			"User-Agent: Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1",
			"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
			"Accept-Language: en-us,en;q=0.5",
			//"Accept-Encoding: gzip, deflate",
			"Referer: http://developer.baidu.com/"
		);
    	$params = array_merge($this->auth_params, $params);
		$url = $this->api_server_url . "$method?".http_build_query($params);
		if (DEBUG_MODE){echo "REQUEST: $url" . "\n";}
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
     	$data = curl_exec($ch);
    	curl_close($ch);    
		$result = null;
		if (!empty($data)){
			if (DEBUG_MODE){
				echo "RETURN: " . $data . "\n";
			}
			$result = json_decode($data);
		}
        else{
            echo "cURL Error:". curl_error($ch);
        }
		//var_dump($result);
		return $result;
    }
}
?>