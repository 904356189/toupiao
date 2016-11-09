<?php

!defined('IN_INTER') && exit('Fobbiden!');

/**
 * ================================================================================
 * 该文件有代码包含了康盛创想（北京）科技有限公司Discuz!/UCenter的代码。根据相关协议的规定：
 *     “禁止在 Discuz! / UCenter 的整体或任何部分基础上以发展任何派生版本、修改版本或第三方版本用于重新分发。”
 * 故在此声明如下：
 *     本程序仅为作者学习和研究软件内含的设计思想和原理而作，不以盈利为目的，同时也无意侵犯第三方软件作者/公司的权益。
 *     如若侵犯权益，请发邮件告知。在本人接获通知的48小时之内将会把自己所发布的代码进行撤回操作。
 *     同时提醒第三方下载者和使用者使用这些代码时考虑本程序的法律风险，第三方下载者和使用者的一切行为与本人无关。
 * 
 * Discuz!/UCenter头文件注释：
 * (C)2001-2009 Comsenz Inc.
 * This is NOT a freeware, use is subject to license terms
 * ================================================================================
 * 
 * 基础controller，改动自UCenter base类
 * 本文件的参考过以下程序，在此一并致谢！
 *     - Comsenz UCenter {@link http://www.comsenz.com}
 *
 * @author Horse Luke<horseluke@126.com>
 * @license Mixed License. See the description above. 
 * @version $Id: Base.php 128 2010-07-05 13:45:44Z horseluke@126.com $
 */

class Controller_Base{
    
    public $input = array();
    
    public $config;
    
    /**
     * 构造函数，初始化参数(ok)
     *
     */
    public function __construct(){
        $this->config = common::getInstanceOf('config');
    }

    /**
     * 初始化输入（ok）
     *
     * @param string $getagent 指定的agent
     */
    public function init_input($getagent = '') {
        $input = common::getgpc('input', 'R');
        if($input) {
            $input = common::authcode($input, 'DECODE', $this->config->authkey);
            parse_str($input, $this->input);
            $this->input = common::addslashes($this->input, 1, TRUE);
            $agent = $getagent ? $getagent : $this->input['agent'];

            if(($getagent && $getagent != $this->input['agent']) || (!$getagent && md5($_SERVER['HTTP_USER_AGENT']) != $agent)) {
                exit('Access denied for agent changed');
            } elseif(time() - $this->input('time') > 3600) {
                exit('Authorization has expired');
            }
        }
        if(empty($this->input)) {
            exit('Invalid input');
        }
    }
    
    /**
     * 查找$this->input是否存在指定索引的变量？（ok）
     *
     * @param string $k 要查找的索引
     * @return mixed
     */
	public function input($k) {
		return isset($this->input[$k]) ? (is_array($this->input[$k]) ? $this->input[$k] : trim($this->input[$k])) : NULL;
	}
    
}