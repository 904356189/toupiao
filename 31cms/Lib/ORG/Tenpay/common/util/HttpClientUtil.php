<?php
//---------------------------------------------------------
//httpclient请求处理类
//---------------------------------------------------------

class HttpClientUtil{
	var $_fp; // HTTP socket
	var $_url; // full URL
	var $_host; // HTTP host
	var $_protocol; // protocol (HTTP/HTTPS)
	var $_uri; // request URI
	var $_port; // port
	
	
	function httpClientCall($allUrl, $charset) {

		$this->_url = $allUrl;
		$this->_scan_url();
		
		$crlf = "\r\n";
		$response="";
		// generate request
		$req = 'GET ' . $this->_uri . ' HTTP/1.0' . $crlf
		. 'Host: ' . $this->_host . $crlf
		. $crlf;

		// fetch
		try {
			$this->_fp = fsockopen(($this->_protocol == 'https' ? 'ssl://' : '') . $this->_host, $this->_port);
			fwrite($this->_fp, $req);
			while(is_resource($this->_fp) && $this->_fp && !feof($this->_fp))
			$response .= fread($this->_fp, 1024);
		}catch (Exception $e) {
			fclose($this->_fp);
			throw new SDKRuntimeException("http请求失败:" + $e.getMessage());
		}catch (SDKRuntimeException $e)
		{
			die($e->errorMessage());
		}

		// split header and body
		$pos = strpos($response, $crlf . $crlf);
		if($pos === false)
		return($response);
		$header = substr($response, 0, $pos);
		$body = substr($response, $pos + 2 * strlen($crlf));
		
		

		// parse headers
		$headers = array();
		$lines = explode($crlf, $header);
		foreach($lines as $line)
		if(($pos = strpos($line, ':')) !== false)
		$headers[strtolower(trim(substr($line, 0, $pos)))] = trim(substr($line, $pos+1));

		// redirection?
		if(isset($headers['location']))
		{
			$http = new HTTPRequest($headers['location']);
			return($http->DownloadToString($http));
		}
		else
		{
			return($body);
		}
	}
	
	// scan url
	function _scan_url()
	{
		$req = $this->_url;

		$pos = strpos($req, '://');
		$this->_protocol = strtolower(substr($req, 0, $pos));

		$req = substr($req, $pos+3);
		$pos = strpos($req, '/');
		if($pos === false)
		$pos = strlen($req);
		$host = substr($req, 0, $pos);
		//echo $host;exit;
		if(strpos($host, ':') !== false)
		{
			list($this->_host, $this->_port) = explode(':', $host);
		}
		else
		{
			$this->_host = $host;
			$this->_port = ($this->_protocol == 'https') ? 443 : 80;
		}

		$this->_uri = substr($req, $pos);
		//echo $this->_uri;exit;
		if($this->_uri == '')
		$this->_uri = '/';
	}
}


?>