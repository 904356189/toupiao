<?php
class HttpClient {
    // Request vars
    public $oldurl;
    public $host;
    public $port;
    public $path;
    public $method;
    public $postdata = '';
    public $cookies = array();
    public $referer;
    public $accept = '*/*';
    public $accept_encoding = 'gzip';
    public $accept_language = 'zh-cn';
    public $user_agent = 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0)';
    public $justhtml = false;
    // Options
    public $timeout = 20;
    public $use_gzip = true;
    //网页中继开启此项
    public $persist_cookies = false;  // If true, received cookies are placed in the $this->cookies array ready for the next request
                                  // Note: This currently ignores the cookie path (and time) completely. Time is not important, 
                                  //       but path could possibly lead to security problems.
    public $persist_referers = true; // For each request, sends path of last request as referer
    public $debug = false;
    public $handle_redirects = true; // Auaomtically redirect if Location or URI header is found
    public $max_redirects = 5;
    public $headers_only = false;    // If true, stops receiving once headers have been read.
    // Basic authorization variables
    public $username;
    public $password;
    // Response vars
    public $status;
    public $headers = array();
    public $content = '';
    public $errormsg;
    // Tracker variables
    public $redirect_count = 0;
    public $cookie_host = '';
    public $charset = null;
    function HttpClient($host, $port=80) {
        $this->host = $host;
        $this->port = $port;
    }
    function get($path, $data = false) {
        $this->path = $path;
        $this->method = 'GET';
        if ($data) {
            $this->path .= '?'.$this->buildQueryString($data);
        }
        return $this->doRequest();
    }
    function post($path, $data) {
        $this->path = $path;
        $this->method = 'POST';
        $this->postdata = $this->buildQueryString($data);
    	return $this->doRequest();
    }
    function buildQueryString($data) {
        $querystring = '';
        if (is_array($data)) {
            // Change data in to postable data
    		foreach ($data as $key => $val) {
    			if (is_array($val)) {
    				foreach ($val as $val2) {
    					$querystring .= urlencode($key).'='.urlencode($val2).'&';
    				}
    			} else {
    				$querystring .= urlencode($key).'='.urlencode($val).'&';
    			}
    		}
    		$querystring = substr($querystring, 0, -1); // Eliminate unnecessary &
    	} else {
    	    $querystring = $data;
    	}
    	return $querystring;
    }
    function doRequest($initrequest=null) {
        // Performs the actual HTTP request, returning true or false depending on outcome
		if (!$fp = @fsockopen($this->host, $this->port, $errno, $errstr, $this->timeout)) {
		    // Set error message
            switch($errno) {
				case -3:
					$this->errormsg = 'Socket creation failed (-3)';
				case -4:
					$this->errormsg = 'DNS lookup failure (-4)';
				case -5:
					$this->errormsg = 'Connection refused or timed out (-5)';
				default:
					$this->errormsg = 'Connection failed ('.$errno.')';
			    $this->errormsg .= ' '.$errstr;
			    $this->debug($this->errormsg);
			}
			return false;
        }
        socket_set_timeout($fp, $this->timeout);
        if($initrequest===null)
        $request = $this->buildRequest();
        else $request = $initrequest;
        $this->debug('Request', $request);
        fwrite($fp, $request);
    	// Reset all the variables that should not persist between requests
    	$this->headers = array();
    	$this->content = '';
    	$this->errormsg = '';
    	// Set a couple of flags
    	$inHeaders = true;
    	$atStart = true;
    	$htmlval = true;
    	// Now start reading back the response
    	while (!feof($fp)) {    		
    	    $line = fgets($fp);
    	    if ($atStart) {
    	        // Deal with first line of returned data
    	        $atStart = false;
    	        if (!preg_match('/HTTP\/(\\d\\.\\d)\\s*(\\d+)\\s*(.*)/', $line, $m)) {
    	            $this->errormsg = "Status code line invalid: ".htmlentities($line);
    	            $this->debug($this->errormsg);
    	            return false;
    	        }
    	        $http_version = $m[1]; // not used
    	        $this->status = $m[2];
    	        $status_string = $m[3]; // not used
    	        if($this->status == '404'){
    	        	$this->content = null;
    	        	fclose($fp);
    	        	return false;
    	        }
    	        $this->debug(trim($line));
    	        continue;
    	    }
    	   
    	    if ($inHeaders) {
    	        if (trim($line) == '') {
    	            $inHeaders = false;
    	            $this->debug('Received Headers', $this->headers);
    	            if ($this->headers_only) {
    	                break; // Skip the rest of the input
    	            }
    	            continue;
    	        }
    	        if (!preg_match('/([^:]+):\\s*(.*)/', $line, $m)) {
    	        	
    	            // Skip to the next header
    	            continue;
    	        }
    	        $key = strtolower(trim($m[1]));
    	        $val = trim($m[2]);
    	        // Deal with the possibility of multiple headers of same name
    	        if (isset($this->headers[$key])) {
    	            if (is_array($this->headers[$key])) {
    	                $this->headers[$key][] = $val;
    	            } else {
    	                $this->headers[$key] = array($this->headers[$key], $val);
    	            }
    	        } else {
    	            $this->headers[$key] = $val;
    	        }
    	        continue;
    	    }
    	    
    	    if($htmlval && $this->justhtml){
    	    	$head = $this->headers;    	    	
    	    	if(stripos($this->headers['content-type'], 'text/html') === false){
    	    		$this->content = null;
    	    		fclose($fp);
    	    		return false;
    	    	}    	    	
    	    }
    	    $htmlval = false;
    	    // We're not in the headers, so append the line to the contents
    	    $this->content .= $line;
        }
        fclose($fp);
        
		
        
        //判断页面编码
        if(stripos($this->headers['content-type'], 'charset') !== false){
        	
        	$encode = explode('=', $encode);
        	if(isset($encode[1])){
        		$this->charset = trim($encode[1]);
        	}
        }        
        
      	//解决重定向的问题
    	    if($this->status=='301'||$this->status=='302' || isset( $this->headers['location']) && trim( $this->headers['location']) != ''){
    	    	$mburl = $this->headers['location'];
    	    	$mburl = self::dealUrl($this->oldurl,$mburl);
    	    	$this->content = HttpClient::quickGet($mburl,30,$this->cookies);    	    	
    	    	return true;
    	    }
        // If data is compressed, uncompress it
        if (isset($this->headers['content-encoding']) && $this->headers['content-encoding'] == 'gzip') {
            $this->debug('Content is gzip encoded, unzipping it');
            $this->content = substr($this->content, 10); // See http://www.php.net/manual/en/function.gzencode.php
            $this->content = gzinflate($this->content);
        }
        // If $persist_cookies, deal with any cookies
        
        if ($this->persist_cookies && isset($this->headers['set-cookie'])) {
            $cookies = $this->headers['set-cookie'];
            
            if (!is_array($cookies)) {
                $cookies = array($cookies);
            }
            foreach ($cookies as $cookie) {
                if (preg_match('/([^=]+)=(.+)/', $cookie, $m)) {
                	$value = explode(';', $m[2]);
                    $this->cookies[$m[1]] = $value[0];
                    //中继器的 Cookie还原
                    //setcookie($m[1],urldecode($m[2]));
                }
            }
            // Record domain of cookies for security reasons
            $this->cookie_host = $this->host;
        }
        // If $persist_referers, set the referer ready for the next request
        if ($this->persist_referers) {
            $this->debug('Persisting referer: '.$this->getRequestURL());
            $this->referer = $this->getRequestURL();
        }
        // Finally, if handle_redirects and a redirect is sent, do that
        if ($this->handle_redirects) {
            if (++$this->redirect_count >= $this->max_redirects) {
                $this->errormsg = 'Number of redirects exceeded maximum ('.$this->max_redirects.')';
                $this->debug($this->errormsg);
                $this->redirect_count = 0;
                return false;
            }
            $location = isset($this->headers['location']) ? $this->headers['location'] : '';
            $uri = isset($this->headers['uri']) ? $this->headers['uri'] : '';
            if ($location || $uri) {
                $url = parse_url($location.$uri);
                // This will FAIL if redirect is to a different site
                return $this->get($url['path']);
            }
        }
        return true;
    }
    function buildRequest() {
        $headers = array();
        $headers[] = "{$this->method} {$this->path} HTTP/1.0"; // Using 1.1 leads to all manner of problems, such as "chunked" encoding
        $headers[] = "Host: {$this->host}";
        $headers[] = "User-Agent: {$this->user_agent}";
        $headers[] = "Accept: {$this->accept}";
        if ($this->use_gzip) {
            $headers[] = "Accept-encoding: {$this->accept_encoding}";
        }
        $headers[] = "Accept-Language: {$this->accept_language}";
        if ($this->referer) {
            $headers[] = "Referer: {$this->referer}";
        }
    	// Cookiesf
    	if ($this->cookies) {
    	    $cookie = 'Cookie: ';
    	    foreach ($this->cookies as $key => $value) {    	    	
    	        $cookie .= "$key=$value; ";
    	    }
    	    $headers[] = $cookie;
    	}
    	// Basic authentication
    	if ($this->username && $this->password) {
    	    $headers[] = 'Authorization: BASIC '.base64_encode($this->username.':'.$this->password);
    	}
    	// If this is a POST, set the content type and length
    	if ($this->postdata) {
    	    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    	    $headers[] = 'Content-Length: '.strlen($this->postdata);
    	}
    	$request = implode("\r\n", $headers)."\r\n\r\n".$this->postdata;
    	return $request;
    }
    function getStatus() {
        return $this->status;
    }
    function getContent($native = false) {
    	if($native){
    		return $this->content;
    	}
    	if($this->charset === null){
    		
    		if($encode ==''){
    			
    		}
    		if($encode!=''){
    			$encode = explode('=', $encode);    			
    			if(isset($encode[1])){
    				$encode = trim($encode[1]);
    				$encode = str_replace('"', '', $encode);
    				$encode = str_replace("'", '', $encode);
    				$this->charset = $encode;
    			}
    		}
    	}
    	if($this->charset !=null && $this->charset != 'utf8' && $this->charset != 'utf-8'){
    		return iconv($this->charset, "utf-8//IGNORE",$this->content);
    	}
    	return $this->content;
    }
    function getHeaders() {
        return $this->headers;
    }
    function getHeader($header) {
        $header = strtolower($header);
        if (isset($this->headers[$header])) {
            return $this->headers[$header];
        } else {
            return false;
        }
    }
    function getError() {
        return $this->errormsg;
    }
    function getCookies() {
        return $this->cookies;
    }
    function getRequestURL() {
        $url = 'http://'.$this->host;
        if ($this->port != 80) {
            $url .= ':'.$this->port;
        }            
        $url .= $this->path;
        return $url;
    }
    // Setter methods
    function setUserAgent($string) {
        $this->user_agent = $string;
    }
    function setAuthorization($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }
    function setCookies($array) {
        $this->cookies = $array;
    }
    // Option setting methods
    function useGzip($boolean) {
        $this->use_gzip = $boolean;
    }
    function setPersistCookies($boolean) {
        $this->persist_cookies = $boolean;
    }
    function setPersistReferers($boolean) {
        $this->persist_referers = $boolean;
    }
    function setHandleRedirects($boolean) {
        $this->handle_redirects = $boolean;
    }
    function setMaxRedirects($num) {
        $this->max_redirects = $num;
    }
    function setHeadersOnly($boolean) {
        $this->headers_only = $boolean;
    }
    function setDebug($boolean) {
        $this->debug = $boolean;
    }
    // "Quick" static methods
    static function quickGet($url,$time = 30, $justhtml = true, $cks=array()) {
        $bits = parse_url($url);
        $host = $bits['host'];
        $port = isset($bits['port']) ? $bits['port'] : 80;
        $path = isset($bits['path']) ? $bits['path'] : '/';
        if (isset($bits['query'])) {
            $path .= '?'.$bits['query'];
        }
        $client = new HttpClient($host, $port);
        $client->oldurl = $url;
        $client->setCookies($cks);
        $client->timeout = $time;
        $client->justhtml = $justhtml;
        
        if (!$client->get($path)) {
            return false;
        } else {
            return $client->getContent();
        }
    }
    
    static function quickPost($url, $data,$time = 30,$cks=array()) {
        $bits = parse_url($url);
        $host = $bits['host'];
        $port = isset($bits['port']) ? $bits['port'] : 80;
        $path = isset($bits['path']) ? $bits['path'] : '/';
        $client = new HttpClient($host, $port);
        $client->setCookies($cks);
        $client->timeout = $time;
        if (!$client->post($path, $data)) {
        	unset($client);
            return false;
        } else {
        	$res = $client->getContent(true);
        	unset($client);
            return $res;
        }
    }
    static function quickUpload($url,$files, $data,$cks=array(),$time = 300) {
        $bits = parse_url($url);
        $host = $bits['host'];
        $port = isset($bits['port']) ? $bits['port'] : 80;
        $path = isset($bits['path']) ? $bits['path'] : '/';        
        $client = new HttpClient($host, $port);
        $client->path = $path;
        $client->setCookies($cks);
        $client->timeout = $time;
        if (!$client->upload($files, $data)) {
        	unset($client);
            return false;
        } else {
        	$res = $client->getContent(true);        	
        	unset($client);
            return $res;
        }
    }
	function upload($files = array(), $data = array()) {
        $this->method = 'POST';
        $boundary = "---------------------------" . substr(md5(time()), -12 );
        $postString = '';
        $postData = array();
		foreach($data as $k => $v ){
			$row   = array();
			$row[] = "--".$boundary;
			$row[] = "Content-Disposition: form-data; name=\"$k\"\r\n";
			$row[] = "$v";
			$postData[] = join( "\r\n", $row );
		}
		$postString =  join( "\r\n", $postData);
		$fileString = '';
		$fileData = array();
        foreach($files as $k=>$v) {
        	$vnames = basename($v);
        	$row   = array();
            $row[] = "--".$boundary;
            $row[] = "Content-Disposition: form-data; name=\"$k\"; filename=\"".$vnames[1]."\"\r\n";
            $row[] = file_get_contents($v);
            $fileData[] = join( "\r\n", $row );
        }
        $fileString =  join( "\r\n", $fileData)."\r\n"."--$boundary--";
        $headers = array();        
        $headers[] = "{$this->method} {$this->path} HTTP/1.0"; // Using 1.1 leads to all manner of problems, such as "chunked" encoding
        $headers[] = "Host: {$this->host}";
        $headers[] = "User-Agent: {$this->user_agent}";
        $headers[] = "Accept: {$this->accept}";
        $headers[] = "Accept-Language: {$this->accept_language}";
        $headers[] = "Connection: Keep-Alive";        
        if ($this->referer) {
            $headers[] = "Referer: {$this->referer}";
        }
    	// Cookiesf
    	if ($this->cookies) {
    	    $cookie = 'Cookie: ';
    	    foreach ($this->cookies as $key => $value) {
    	        $cookie .= "$key=$value; ";
    	    }
    	    $headers[] = $cookie;
    	}
    	// Basic authentication
    	if ($this->username && $this->password) {
    	    $headers[] = 'Authorization: BASIC '.base64_encode($this->username.':'.$this->password);
    	}
    	$headers[] = "Cache-Control: no-cache";
    	// If this is a POST, set the content type and length
    	$headers[] = "Content-Type: multipart/form-data; boundary=".$boundary;
    	$headers[] = "Content-Length: ".(strlen($postString) + strlen("\r\n") + strlen($fileString))."\r\n";        
        $headers[] = $postString;
        $headers[] = $fileString;
    	$request = implode("\r\n", $headers);
    	$this->doRequest($request);
    	return true;
    }
    function debug($msg, $object = false) {
        if ($this->debug) {
            print '<div style="border: 1px solid red; padding: 0.5em; margin: 0.5em;"><strong>HttpClient Debug:</strong> '.$msg;
            if ($object) {
                ob_start();
        	    print_r($object);
        	    $content = htmlentities(ob_get_contents());
        	    ob_end_clean();
        	    print '<pre>'.$content.'</pre>';
        	}
        	print '</div>';
        }
    }
	static function dealUrl($baseUrl,$myUrl){
		if(stripos($myUrl, 'http')===0){
			return $myUrl;
		}
		$urlbz = parse_url($baseUrl);
		if(strpos($myUrl, '/')===0){
			return $urlbz['scheme'].'://'.$urlbz['host'].$myUrl;
		}else {
			if(stripos($myUrl, './')===0){
				$myUrl = substr($myUrl, 2);
			}
			if(isset($urlbz['path'])){
				$subpath = $urlbz['path'];
				if(substr($subpath, strlen($subpath)-1)!='/'){
					$ind = strrpos($subpath, '/');
					$subpath = substr($subpath, 0,$ind+1);
				}
				while(strpos($myUrl, '../')===0){
					$subpath = substr($subpath, 0,strlen($subpath)-1);
					$myUrl = substr($myUrl, 3);
					$ind = strrpos($subpath, '/');
					$subpath = substr($subpath, 0,$ind+1);
				}
				//最后一位是：/
				return $urlbz['scheme'].'://'.$urlbz['host'].$subpath.$myUrl;				
			}else{
				return $urlbz['scheme'].'://'.$urlbz['host'].'/'.$myUrl;
			}
		}
	}  
}
?>
