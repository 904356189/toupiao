<?php

/**
 * 印美丽接口文件
 * 
 * @author st0p
 * @version 1.0
 * @copyright 2014
 */

class yinmeili
{
    private $api = 'http://www.yinmeili.com/api/index.php';
    private $username = '';
    private $secret = '';
    private $unique_id = '';
    private $uid = '';

    public function __construct($username = '', $secret = '', $unique_id = '',
        $uid = '')
    {
        $username = trim($username);
        $secret = trim($secret);
        $unique_id = trim($unique_id);
        $uid = trim($uid);

        $this->username = $username;
        $this->secret = $secret;
        $this->unique_id = $unique_id;
        $this->uid = $uid;
    }

    public function getMachineList()
    {
        $output = array();

        if ($this->username == '' || $this->secret == '')
        {
            return $output;
        }

        $arr = array(
            'api' => 'config',
            'act' => 'getMachineList',
            'username' => $this->username,
            'unique_id' => $this->unique_id);

        $sign = $this->createSign($arr);

        $arr['sign'] = $sign;

        $response = $this->http($arr);

        $arr = json_decode($response, true);

		// log_result(var_export($arr, true), 'yinmeili');

        if (isset($arr['status']) && $arr['status'] == 1)
        {
            $output = $arr['data']['list'];
            return $output;
        }
        else
        {
            return $output;
        }
    }

    public function getPrintConfig($mid = 0)
    {
        $mid = intval($mid);

        if ($this->username == '' || $this->secret == '' || $mid == 0)
        {
            return false;
        }

        $arr = array(
            'api' => 'config',
            'act' => 'getPrintConfig',
            'username' => $this->username,
            'unique_id' => $this->unique_id,
            'mid' => $mid);

        $sign = $this->createSign($arr);

        $arr['sign'] = $sign;

        $response = $this->http($arr);

        $arr = json_decode($response, true);

		// log_result(var_export($arr, true), 'yinmeili');

        if (isset($arr['status']) && $arr['status'] == 1)
        {
            return $arr['data'];
        }
        else
        {
            return false;
        }
    }

    public function updatePrintConfig($mid = 0, $print_limit = 0, $small_banner = '', $banner = '', $readme = '', $footer_url = '', $qrcode = '')
    {
        $mid = intval($mid);

		$print_limit = intval($print_limit);

		if ($print_limit < 0)
		{
			$print_limit = 0;
		}

        if ($this->username == '' || $this->secret == '' || $mid == 0)
        {
            return false;
        }

        $arr = array(
            'api' => 'config',
            'act' => 'updatePrintConfig',
            'username' => $this->username,
            'unique_id' => $this->unique_id,
            'mid' => $mid,
			'print_limit' => $print_limit,
            'small_banner' => $small_banner,
            'banner' => $banner,
            'readme' => $readme,
            'footer_url' => $footer_url,
            'qrcode' => $qrcode);

        $sign = $this->createSign($arr);

        $arr['sign'] = $sign;

        $response = $this->http($arr);

        $arr = json_decode($response, true);

		// log_result(var_export($arr, true), 'yinmeili');

        if (isset($arr['status']) && $arr['status'] == 1)
        {
            return 'ok';
        }
        else
        {
            return $arr['message'];
        }
    }

    public function addPrintTask($image_url = '')
    {
        $image_url = trim($image_url);

        $output = array(
            'task_id' => 0,
			'message' => '创建打印任务失败! ',
            'basic' => '',
            'advanced' => '');

        if ($this->username == '' || $this->secret == '' || $image_url == '')
        {
            return $output;
        }

        $arr = array(
            'api' => 'config',
            'act' => 'addPrintTask',
            'username' => $this->username,
            'unique_id' => $this->unique_id,
            'uid' => $this->uid,
            'image_url' => $image_url);

        $sign = $this->createSign($arr);

        $arr['sign'] = $sign;

        $response = $this->http($arr);

        $arr = json_decode($response, true);

		// log_result(var_export($arr, true), 'yinmeili');

        if (isset($arr['status']) && $arr['status'] == 1)
        {
            $output['task_id'] = $arr['data']['task_id'];
			$output['message'] = '创建打印任务成功! ';
            $output['basic'] = $arr['data']['basic'];
            $output['advanced'] = $arr['data']['advanced'];
            return $output;
        }
        else
        {
			$output['message'] = $arr['message'];
            return $output;
        }
    }

    public function checkPrintVerifyCode($tid = 0, $verify_code = '')
    {
        $tid = intval($tid);
        $verify_code = $verify_code;

        $output = array(
            'status' => 0,
			'message' => '');

        if ($this->username == '' || $this->secret == '' || $tid == 0 || $verify_code == '')
        {
			$output['message'] = '系统错误!';
            return $output;
        }

        $arr = array(
            'api' => 'config',
            'act' => 'checkPrintVerifyCode',
            'username' => $this->username,
            'unique_id' => $this->unique_id,
            'uid' => $this->uid,
            'tid' => $tid,
            'verify_code' => $verify_code);

        $sign = $this->createSign($arr);

        $arr['sign'] = $sign;

        $response = $this->http($arr);

        $arr = json_decode($response, true);

		// log_result(var_export($arr, true), 'yinmeili');

        if (isset($arr['status']) && $arr['status'] == 1)
        {
			$output['status'] = 1;
            return $output;
        }
        else
        {
			$output['message'] = $arr['message'];
            return $output;
        }
    }

    public function check_utf8($str)
    {
        if (preg_match('/^([\xC0-\xDF][\xA0-\xBF])+$/', $str))
        {
            return 0;
        }

        return preg_match('%^(?: 
              [\x09\x0A\x0D\x20-\x7E]            # ASCII 
            | [\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte 
            |  \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs 
            | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte 
            |  \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates 
            |  \xF0[\x90-\xBF][\x80-\xBF]{2}     # planes 1-3 
            | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15 
            |  \xF4[\x80-\x8F][\x80-\xBF]{2}     # plane 16 
        )*$%xs', $str);
    }

    public function createSign($arr = array())
    {

        $str = '';
        $sign = '';

        ksort($arr);

        foreach ($arr as $key => $value)
        {
            if (!$this->check_utf8($key))
            {
                $key = iconv("GBK", "UTF-8//IGNORE", $key);
            }

            $str .= $key;

            if (!$this->check_utf8($value))
            {
                $value = iconv("GBK", "UTF-8//IGNORE", $value);
            }

            $str .= $value;
        }

        $sign = md5(md5($str) . md5($this->secret));

        return $sign;
    }

    public function http($params = array(), $type = 'post')
    {
        $uri = $this->api;

        $params = is_array($params) ? $params : array();

        if (!function_exists('curl_init'))
        {
            $context = array();

            if ($type == 'post')
            {
                ksort($params);
                $context['http'] = array(
                    'timeout' => 60,
                    'method' => 'POST',
                    'content' => http_build_query($params, '', '&'),
                    );
                $reponse = file_get_contents($uri, false, stream_context_create($context));
            }
            else
            {
                $context['http'] = array('timeout' => 60, 'method' => 'GET');
                $uri .= '?' . http_build_query($params, '', '&');
                $reponse = file_get_contents($uri, false, stream_context_create($context));
            }
            return $reponse;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT,
            "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727");
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        $queryStr = http_build_query($params);

        if ($type == 'get')
        {
            if (trim($queryStr) != '')
            {
                $uri .= '?' . $queryStr;
            }

            curl_setopt($ch, CURLOPT_URL, $uri);
        }
        else
        {
            curl_setopt($ch, CURLOPT_URL, $uri);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $queryStr);
        }
        $reponse = curl_exec($ch);

        if (curl_errno($ch))
        {
            throw new Exception(curl_error($ch), 0);
            return curl_error($ch);
        }
        else
        {
            $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if (200 !== $httpStatusCode)
            {
                throw new Exception($reponse, $httpStatusCode);
                return $reponse;
            }
        }

        curl_close($ch);
        return $reponse;
    }
}

?>