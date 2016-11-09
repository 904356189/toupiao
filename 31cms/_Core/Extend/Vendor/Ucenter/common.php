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
 * 各种公用函数的集合类，可使用静态方法调用
 * 本文件的参考过以下程序，在此一并致谢！
 *     - 论坛程序Discuz! {@link http://www.discuz.net/}
 *     - Comsenz UCenter {@link http://www.comsenz.com}
 *     - PHP框架Zend Framework{@link http://framework.zend.com/}
 *
 * @author Horse Luke<horseluke@126.com>
 * @license Mixed License. See the description above. 
 * @version $Id: common.php 128 2010-07-05 13:45:44Z horseluke@126.com $
 */
class common{
    
    //存储对象实例
    protected static $_objectInstance = array();
    
    /**
     * dz经典加解密函数
     * 来源：Discuz! 7.0
     * 依赖性：可独立提取使用
     *
     * @param string $string 要加密/解密的字符串
     * @param string $operation 操作类型，可选为'DECODE'（默认）或者'ENCODE'
     * @param string $key 密钥，必须传入，否则将中断php脚本运行。
     * @param int $expiry 有效期
     * @return string
     */
    public static function authcode($string, $operation = 'DECODE', $key, $expiry = 0) {

        $ckey_length = 4;	// 随机密钥长度 取值 0-32;
        // 加入随机密钥，可以令密文无任何规律，即便是原文和密钥完全相同，加密结果也会每次不同，增大破解难度。
        // 取值越大，密文变动规律越大，密文变化 = 16 的 $ckey_length 次方
        // 当此值为 0 时，则不产生随机密钥

        //取消UC_KEY，改为必须传入$key才能运行
        if(empty($key)){
            exit('PARAM $key IS EMPTY! ENCODE/DECODE IS NOT WORK!');
        }else{
            $key = md5($key);
        }


        $keya = md5(substr($key, 0, 16));
        $keyb = md5(substr($key, 16, 16));
        $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

        $cryptkey = $keya.md5($keya.$keyc);
        $key_length = strlen($cryptkey);

        $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
        $string_length = strlen($string);

        $result = '';
        $box = range(0, 255);

        $rndkey = array();
        for($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($cryptkey[$i % $key_length]);
        }

        for($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }

        for($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }

        if($operation == 'DECODE') {
            if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
                return substr($result, 26);
            } else {
                return '';
            }
        } else {
            return $keyc.str_replace('=', '', base64_encode($result));
        }

    }

    
    /**
     * 获取$_GET/$_POST/$_COOKIE/$_REQUEST数组的指定索引变量(ok)
     * 来源：Ucenter
     * 依赖性：可独立提取使用
     *
     * @param string $k 指定索引
     * @param string $var 获取来源。默认为'R'（即$_REQUEST），可选值'G'/'P'/'C'（对应$_GET/$_POST/$_COOKIE）
     * @return mixed
     */
    public static function getgpc($k, $var='R') {
        switch($var) {
            case 'G': $var = &$_GET; break;
            case 'P': $var = &$_POST; break;
            case 'C': $var = &$_COOKIE; break;
            case 'R': $var = &$_REQUEST; break;
        }
        return isset($var[$k]) ? $var[$k] : NULL;
    }
    
    /**
     * 转义处理，改动自daddslashes函数(ok)
     * 来源：Ucenter
     * 依赖性：需要修改才能独立使用
     * 
     * @param string $string
     * @param int $force
     * @param bool $strip
     * @return mixed
     */
    public static function addslashes($string, $force = 0, $strip = FALSE) {

        if(!ini_get('magic_quotes_gpc') || $force) {
            if(is_array($string)) {
                $temp = array();
                foreach($string as $key => $val) {
                    $key = addslashes($strip ? stripslashes($key) : $key);
                    $temp[$key] = self::addslashes($val, $force, $strip);
                }
                $string = $temp;
                unset($temp);
            } else {
                $string = addslashes($strip ? stripslashes($string) : $string);
            }
        }
        return $string;
    }
    
    /**
     * 返回文件的扩展名
     * 来源：Discuz!
     * 依赖性：可独立提取使用
     * 
     * @param string $filename 文件名
     * @return string
     */
    public static function fileext($filename) {
        return trim(substr(strrchr($filename, '.'), 1, 10));
    }
    
    
    /**
     * 获取指定对象或者指定索引对象的实例。没有则新建一个并且存储起来。
     *
     * @param string $classname 类名
     * @param string $index 索引，默认等同于$classname
     */
    public static function getInstanceOf( $classname , $index = null ){
        if( null === $index ){
            $index = $classname;
        }
        if( isset( self::$_objectInstance[$index] ) ){
            $instance = self::$_objectInstance[$index];
            if( !($instance instanceof $classname) ){
                throw new Exception( "Key {$index} has been tied to other thing." );
            }
        }else{
            $instance = new $classname();
            self::$_objectInstance[$index] = $instance;
        }
        return $instance;
    }

}