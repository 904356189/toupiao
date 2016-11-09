<?php

!defined('IN_INTER') && exit('Fobbiden!');
/**
 * 参数类
 * 本文件参考过以下程序，在此一并致谢！
 *     - PHP框架LotusPHP{@link http://code.google.com/p/lotusphp/}
 *
 * @author Horse Luke<horseluke@126.com>
 * @copyright Horse Luke, 2009
 * @license the Apache License, Version 2.0 (the "License"). {@link http://www.apache.org/licenses/LICENSE-2.0}
 * @version $Id: config.php 128 2010-07-05 13:45:44Z horseluke@126.com $
 * @package Inter_PHP_Framework
 */

class config extends ArrayObject{

    /**
     * 构建函数
     *
     */
    public function __construct(){
    }

    /**
     * 从dz6.1f同步参数值
     */
    /*
    public function syncFromDZ(){
        
    }
    */
    
    /**
     * 对参数进行设置(ok)
     *
     * @param array $newConfig 新的参数数组
     */
    public function set( $newConfig = array() ){
        foreach ($newConfig as $key => $value){
            $this->$key = $value;
        }
    }
    
    public function __get($name){
        $this->$name = null;
        return null;
    }
}

