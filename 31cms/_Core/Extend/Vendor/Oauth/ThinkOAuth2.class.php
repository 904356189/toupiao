<?php  
/** 
 * @category ORG
 * @package ORG
 */  
  
// OAUTH2_DB_DSN  数据库连接DSN  
// OAUTH2_CODES_TABLE 服务器表名称  
// OAUTH2_CLIENTS_TABLE 客户端表名称  
// OAUTH2_TOKEN_TABLE 验证码表名称  
  
import("ORG.OAuth.OAuth2");  
  
class ThinkOAuth2 extends OAuth2 {  
  
    private $db;  
    private $table;  
  
    /** 
     * 构造 
     */  
    public function __construct() {  
        parent::__construct();  
        $this -> db = Db::getInstance(C('OAUTH2_DB_DSN'));  
        $this -> table = array(  
            'auth_codes'=>C('OAUTH2_CODES_TABLE'),  
            'clients'=>C('OAUTH2_CLIENTS_TABLE'),  
            'tokens'=>C('OAUTH2_TOKEN_TABLE')  
        );  
    }  
  
    /** 
     * 析构 
     */  
    function __destruct() {  
        $this->db = NULL; // Release db connection  
    }  
  
    private function handleException($e) {  
        echo "Database error: " . $e->getMessage();  
        exit;  
    }  
  
    /** 
     *  
     * 增加client 
     * @param string $client_id 
     * @param string $client_secret 
     * @param string $redirect_uri 
     */  
    public function addClient($client_id, $client_secret, $redirect_uri) {  
          
        $time = time();  
        $sql = "INSERT INTO {$this -> table['clients']} ".  
            "(client_id, client_secret, redirect_uri, create_time) VALUES (\"{$client_id}\", \"{$client_secret}\", \"{$redirect_uri}\",\"{$time}\")";  
          
        $this -> db -> execute($sql);  
          
    }  
  
    /** 
     * Implements OAuth2::checkClientCredentials() 
     * @see OAuth2::checkClientCredentials() 
     */  
    protected function checkClientCredentials($client_id, $client_secret = NULL) {  
          
        $sql = "SELECT client_secret FROM {$this -> table['clients']} ".  
            "WHERE client_id = \"{$client_id}\"";  
          
        $result = $this -> db -> query($sql);  
        if ($client_secret === NULL) {  
            return $result !== FALSE;  
        }  
          
        //Log::write("checkClientCredentials : ".$result);  
        //Log::write("checkClientCredentials : ".$result[0]);  
        //Log::write("checkClientCredentials : ".$result[0]["client_secret"]);  
          
        return $result[0]["client_secret"] == $client_secret;  
          
    }  
  
    /** 
     * Implements OAuth2::getRedirectUri(). 
     * @see OAuth2::getRedirectUri() 
     */  
    protected function getRedirectUri($client_id) {  
          
        $sql = "SELECT redirect_uri FROM {$this -> table['clients']} ".  
            "WHERE client_id = \"{$client_id}\"";  
          
        $result = $this -> db -> query($sql);  
          
        if ($result === FALSE) {  
            return FALSE;  
        }  
          
        //Log::write("getRedirectUri : ".$result);  
        //Log::write("getRedirectUri : ".$result[0]);  
        //Log::write("getRedirectUri : ".$result[0]["redirect_uri"]);  
          
        return isset($result[0]["redirect_uri"]) && $result[0]["redirect_uri"] ? $result[0]["redirect_uri"] : NULL;  
          
    }  
  
    /** 
     * Implements OAuth2::getAccessToken(). 
     * @see OAuth2::getAccessToken() 
     */  
    protected function getAccessToken($access_token) {  
          
        $sql = "SELECT client_id, expires, scope FROM {$this -> table['tokens']} ".  
            "WHERE access_token = \"{$access_token}\"";  
          
        $result = $this -> db -> query($sql);  
          
        //Log::write("getAccessToken : ".$result);  
        //Log::write("getAccessToken : ".$result[0]);  
          
        return $result !== FALSE ? $result : NULL;  
          
    }  
  
    /** 
     * Implements OAuth2::setAccessToken(). 
     * @see OAuth2::setAccessToken() 
     */  
    protected function setAccessToken($access_token, $client_id, $expires, $scope = NULL) {  
          
        $sql = "INSERT INTO {$this -> table['tokens']} ".  
            "(access_token, client_id, expires, scope) ".  
            "VALUES (\"{$access_token}\", \"{$client_id}\", \"{$expires}\", \"{$scope}\")";  
          
        $this -> db -> execute($sql);  
          
    }  
  
    /** 
     * Overrides OAuth2::getSupportedGrantTypes(). 
     * @see OAuth2::getSupportedGrantTypes() 
     */  
    protected function getSupportedGrantTypes() {  
        return array(  
            OAUTH2_GRANT_TYPE_AUTH_CODE  
        );  
    }  
  
    /** 
     * Overrides OAuth2::getAuthCode(). 
     * @see OAuth2::getAuthCode() 
     */  
    protected function getAuthCode($code) {  
          
        $sql = "SELECT code, client_id, redirect_uri, expires, scope ".  
            "FROM {$this -> table['auth_codes']} WHERE code = \"{$code}\"";  
          
        $result = $this -> db -> query($sql);  
          
        //Log::write("getAuthcode : ".$result);  
        //Log::write("getAuthcode : ".$result[0]);  
        //Log::write("getAuthcode : ".$result[0]["code"]);  
          
        return $result !== FALSE ? $result[0] : NULL;  
  
    }  
  
    /** 
     * Overrides OAuth2::setAuthCode(). 
     * @see OAuth2::setAuthCode() 
     */  
    protected function setAuthCode($code, $client_id, $redirect_uri, $expires, $scope = NULL) {  
          
        $time = time();  
        $sql = "INSERT INTO {$this -> table['auth_codes']} ".  
            "(code, client_id, redirect_uri, expires, scope) ".  
            "VALUES (\"${code}\", \"${client_id}\", \"${redirect_uri}\", \"${expires}\", \"${scope}\")";  
          
        $result = $this -> db -> execute($sql);  
  }  
    
  /** 
   * Overrides OAuth2::checkUserCredentials(). 
   * @see OAuth2::checkUserCredentials() 
   */  
  protected function checkUserCredentials($client_id, $username, $password){  
    return TRUE;  
  }  
}