<?php
/**
 * Inter框架核心文件之错误处理
 * 本组件依赖性：可独立使用。
 * 本文件的错误处理思路参考过以下程序，在此一并致谢！
 *     - 论坛程序Mybb{@link http://www.mybbchina.net/}
 *     - PHP框架Slightphp{@link http://phpchina.com/bbs/thread-150396-1-1.html}
 *     - PHP框架DooPHP{@link http://doophp.com/blog/article/diagnostic-debug-view-in-doophp}
 *
 * @author Horse Luke<horseluke@126.com>
 * @copyright Horse Luke, 2009
 * @license the Apache License, Version 2.0 (the "License"). {@link http://www.apache.org/licenses/LICENSE-2.0}
 * @version $Id: Error.php 128 2010-07-05 13:45:44Z horseluke@126.com $
 * @package Inter_PHP_Framework
 */

class Inter_Error
{

    /**
	 * 本类的数组配置。依据索引，从上到下为：
	 * debugMode：
     * 是否开启debug模式？若为true，将在在浏览器显示详细信息。否则将不显示。
     * 参数选择：默认为false，可选参数true或者false。
     * 参数类型：bool
     * 
     * friendlyExceptionPage：
     * 系统遇到exception的时候抛出的友好网页文件完整路径
     * 参数选择：默认为空。本参数只有当debugMode为false时才有效
     * 请指定为网页文件的完整路径（但不需要是绝对路径）。若文件不存在或者为空，则不进行任何操作。
     * 存在时则采取require模式。所以请自行保证防止xss的攻击！
     * 参数类型：string
     * 
     * logType：
     * 对错误进行包括错误追踪在内的详细记录（detail）、还是只需要简单记录（simple）【均使用PHP函数error_log进行记录】？
     * false将不进行任何记录。
     * 参数选择：默认为false。可选择'detail'或者'simple'或者布尔值false。
     * 不建议在生产环境进行详细记录（detail），否则在高访问量的情况下，日志的条目将非常混乱！
     * 参数类型：bool|string
	 * 
	 * logDir：
     * 记录日志的文件夹（目录路径），结尾不要含有斜杠。
     * 参数选择： 默认为空。本参数只有当logType不为false时才有效；
     * 并且当为若为空、或者不是目录、或者目录不存在，则按照php.ini的设置进行错误记录处理。
     * 参数类型：string
     * 
     * suffix：
     * 记录日志的文件后缀。
     * 参数类型：string
     * 
     * variables：
     * 指定要检测和输出的变量名。
     * 参数类型：array
     * 
	 * @var array
	 */
    public static $conf = array(
                                'debugMode' => false,
                                'friendlyExceptionPage' => '',
                                'logType' => false,
                                'logDir' => '',
                                'suffix' => '-Inter-ErrorLog.log',
                                'variables' => array("_GET", "_POST", "_SESSION", "_COOKIE")
                                );

    /**
	 * (私有)所有错误、异常的信息存储数组
	 * @var array
	 */
    private static $_allError = array();

    /**
	 * (私有)是否借助PHP的register_shutdown_function注册了本类静态方法error_display和error_display
	 *
	 * @var unknown_type
	 */
    private static $_registered = false;


    /**
     * 处理PHP抛出的exception
     *
     * @param Exception $e
     */
    public static function exception_handler(Exception $e){

        self::init();

        $errorInfo = array();
        $errorInfo['time'] = time();
        $errorInfo['type'] = 'EXCEPTION';
        $errorInfo['name'] = get_class($e);
        $errorInfo['code'] = $e->getCode();
        $errorInfo['message'] = $e->getMessage();
        $errorInfo['file'] = $e->getFile();
        $errorInfo['line'] = $e->getLine();
        $errorInfo['trace'] = self::_format_trace($e->getTrace());

        self::$_allError[] = $errorInfo;

        //$debugMode为false时候，根据self::$friendlyExceptionPage进行友好错误操作
        if(false == self::$conf['debugMode']){
            if(is_file(self::$conf['friendlyExceptionPage'])){
                require(self::$conf['friendlyExceptionPage']);
            }
        }

    }


    /**
     * 处理PHP发现的错误
     *
     * @param integer $errno 错误代号
     * @param string $errstr 错误信息
     * @param string $errfile 错误所在文件
     * @param string $errline 错误所在行
     */
    public static function error_handler($errno, $errstr, $errfile, $errline) {

        self::init();

        $errorInfo = array();
        $errorInfo['time'] = time();
        $errorInfo['type'] = 'ERROR';

        //对error类型进行直观化处理~
        $errorText = array("1"=>"E_ERROR",
                            "2"=>"E_WARNING",
                            "4"=>"E_PARSE",
                            "8"=>"E_NOTICE",
                            "16"=>"E_CORE_ERROR",
                            "32"=>"E_CORE_WARNING",
                            "64"=>"E_COMPILE_ERROR",
                            "128"=>"E_COMPILE_WARNING",
                            "256"=>"E_USER_ERROR",
                            "512"=>"E_USER_WARNING",
                            "1024"=>"E_USER_NOTICE",
                            "2047"=>"E_ALL",
                            "2048"=>"E_STRICT"
                          );
        if(!empty($errorText[$errno])){
            $errorInfo['name'] = $errorText[$errno];
        }else{
            $errorInfo['name'] = '__UNKNOWN';
        }

        $errorInfo['code'] = $errno;
        $errorInfo['message'] = $errstr;
        $errorInfo['file'] = $errfile;
        $errorInfo['line'] = $errline;
        $trace = debug_backtrace();
        unset($trace[0]);    //调用该类自身的error_handler方法所产生的trace，故删除
        $errorInfo['trace'] = self::_format_trace($trace);

        self::$_allError[] = $errorInfo;
    }

    /**
     * 初始化本类
     */
    public static function init(){
        if( false == self::$_registered ){
            register_shutdown_function(array('Inter_Error', 'write_errorlog'));
            register_shutdown_function(array('Inter_Error', 'error_display'));
            self::$_registered = true;
        }
    }


    /**
     * (私有)对错误回溯追踪信息进行格式化输出处理。
     *
     * @param array $trace 错误回溯追踪信息数组
     * @return array $trace 错误回溯追踪信息数组
     */
    private static function _format_trace($trace){
        $return = array();
        //逐条追踪记录处理
        foreach ($trace as $stack => $detail){
            if(!empty($detail['args'])){
                $args_string = self::_args_to_string($detail['args']);
            }else{
                $args_string = '';
            }

            //规范追踪记录（感慨PHP太过自由，连trace记录也是不尽相同-_-||）
            $return[$stack]['class'] = isset($trace[$stack]['class']) ? $trace[$stack]['class'] : '';
            $return[$stack]['type'] = isset($trace[$stack]['type']) ? $trace[$stack]['type'] : '';
            //只有存在function的时候，才可能存在args，故以此合并之
            $return[$stack]['function'] = isset($trace[$stack]['function']) ? $trace[$stack]['function'].'('.$args_string.')' : '';
            $return[$stack]['file']=isset($trace[$stack]['file']) ? $trace[$stack]['file'] :'' ;
            $return[$stack]['line']=isset($trace[$stack]['line']) ? $trace[$stack]['line'] :'' ;
        }
        return $return;
    }


    /**
     * (私有)将参数转变为可读的字符串
     * 力求做到$e->getTraceAsString()的效果
     *
     * @param array $args
     * @return string
     */
    private static function _args_to_string($args){
        $string = '';
        $argsAll = array();
        foreach ($args as $key => $value){
            if(true == is_object($value)){
                $argsAll[$key] = 'Object('.get_class($value).')';
            }elseif(true == is_numeric($value)){
                $argsAll[$key] = $value;
            }elseif(true == is_string($value)){
                $temp = $value;
                if(!extension_loaded('mbstring')){
                    if(strlen($temp) > 300){
                        $temp = substr($temp, 0 ,300).'...';
                    }
                }else{
                    if(mb_strlen($temp) > 300){
                        $temp = mb_substr($temp, 0 ,300).'...';
                    }
                }
                $argsAll[$key] = "'{$temp}'";
                $temp = null;
            }elseif(true == is_bool($value)){
                if(true == $value){
                    $argsAll[$key] = 'true';
                }else{
                    $argsAll[$key] = 'false';
                }
            }else{
                $argsAll[$key] = gettype($value);
            }
        }
        $string = implode(',', $argsAll);
        return $string;
    }


    /**
     * 写入错误日志
     */
    public static function write_errorlog(){
        if( (false != (bool)self::$conf['logType']) && !empty(self::$_allError) ){
            $logText = '';

            foreach (self::$_allError as $key => $errorInfo){
                //为避免PHP5.1.0及以上版本关于时区的STRICT ERROR，在运行前请使用date_default_timezone_set设置之~
                $logText .= date("Y-m-d H:i:s", $errorInfo['time']). "\t".
                $_SERVER["REQUEST_URI"]."\t".
                $errorInfo['type']. "\t".
                $errorInfo['name']. "\t".
                'Code '. $errorInfo['code']. "\t".
                $errorInfo['message']. "\t".
                $errorInfo['file']. "\t".
                'Line '. $errorInfo['line']. "\n";

                if('detail' == self::$conf['logType'] && !empty($errorInfo['trace'])){
                    $prefix = "TRACE\t#";
                    foreach ( $errorInfo['trace'] as $stack => $trace ){
                        $logText .= $prefix. $stack. "\t". $trace['file']. "\t". $trace['line']. "\t". $trace['class']. $trace['type']. $trace['function']. "\n";
                    }
                }

            }

            if(empty(self::$conf['logDir']) || false == is_dir(self::$conf['logDir'])){
                error_log($logText);
            }else{
                $logFilename= date("Y-m-d",time()). self::$conf['suffix'];
                error_log($logText, 3, self::$conf['logDir']. DIRECTORY_SEPARATOR. $logFilename);
            }
        }
    }

    /**
     * 显示错误
     */
    public static function error_display(){
        if(false != self::$conf['debugMode'] && !empty(self::$_allError) ){
            $htmlText = '';
            foreach (self::$_allError as $key => $errorInfo){


                //错误div头
                $htmlText .= '<div class="intererrorblock">
    							<div class="intererrortitle">['.$errorInfo['name'].'][Code '.$errorInfo['code'].'] '.$errorInfo['message'].'</div>
    							<div class="intererrorsubtitle">Line '.$errorInfo['line'].' On <a href="'.$errorInfo['file'].'">'.$errorInfo['file'].'</a></div>
    							<div class="intererrorcontent">
							';

                //trace显示区
                if(empty($errorInfo['trace'])){
                    $htmlText .= 'No Traceable Information.';
                }else{
                    $htmlText .= '<table width="100%" border="1" cellpadding="1" cellspacing="1" rules="rows">
									<tr>
										<th scope="col">#</th>
										<th scope="col">File</th>
										<th scope="col">Line</th>
										<th scope="col">Class::Method(Args)</th>
									</tr>';
                    foreach ($errorInfo['trace'] as $stack => $trace){
                        $htmlText .= '<tr>
										<td>'.$stack.'</td>
										<td><a href="'.$trace['file'].'">'.$trace['file'].'</a></td>
										<td>'.$trace['line'].'</td>
										<td>'.$trace['class']. $trace['type']. htmlspecialchars($trace['function']) .'</td>
									</tr>';
                    }
                    $htmlText .= '</table>';
                }

                //错误div尾
                $htmlText .= '	</div>
    						</div>
							';
            }

            //输出
            echo <<<END
<style type="text/css">
<!--
.intererrorblock {
	font-size: 12pt;
	background-color: #FFC;
	text-align: left;
	vertical-align: middle;
	display: inline-block;
	border-collapse: collapse;
	word-break: break-all;
	padding: 3px;
	width: 100%;
}

.intererrorblock a:link {
	color: #00F;
	text-decoration: none;
}
.intererrorblock a:visited {
	text-decoration: none;
	color: #00F;
}
.intererrorblock a:hover {
	text-decoration: underline;
	color: #00F;
}
.intererrorblock a:active {
	text-decoration: none;
	color: #00F;
}

.intererrortitle {
	color: #FFF;
	background-color: #963;
	padding: 3px;
	font-weight: bold;
}

.intererrorsubtitle {
	padding: 3px;
	font-weight: bold;
	color: #F00;
}

.intererrorcontent {
	font-size: 11pt;
	color: #000;
	background-color: #FFF;
	padding: 3px;
}

.intererrorcontent table{
	font-size:14px;
	word-break: break-all;
	background-color:#D4D0C8;
	border-color:#000000;
}

.intererrorblock table a:link {
	color: #00F;
	text-decoration: none;
}
.intererrorblock table a:visited {
	text-decoration: none;
	color: #00F;
}
.intererrorblock table a:hover {
	text-decoration: underline;
	color: #00F;
}
.intererrorblock table a:active {
	text-decoration: none;
	color: #00F;
}

-->
</style>
{$htmlText}
END;

        self::show_variables();
        }
    }
    
    /**
     * 指定变量名检测和显示
     */
    public static function show_variables(){
        $variables_link = '';
        $variables_content = '';
        foreach( self::$conf['variables'] as $key ){
            $variables_link .= '<a href="#variables'.$key.'">$'.$key.'</a>&nbsp;';
            $variables_content .= '<div class="variablessubtitle"><a name="variables'.$key.'" id="variables'.$key.'"></a>$'.$key.'</strong></div>
						  <div class="variablescontent">';
            if(!isset($GLOBALS[$key])){
                $variables_content .= '$'. $key .' IS NOT SET.';
            }else{
                $variables_content .= nl2br(htmlspecialchars(var_export($GLOBALS[$key], true)));
            }
             $variables_content .= '</div>';
        }
        
            //输出
            echo <<<END
<style type="text/css">
<!--
.variablesblock {
	font-size: 12pt;
	background-color: #CCC;
	text-align: left;
	vertical-align: middle;
	display: inline-block;
	border-collapse: collapse;
	word-break: break-all;
	padding: 3px;
	width: 100%;
	color: #000;
}

.variablesblock a:link {
	color: #000;
	text-decoration: none;
}
.variablesblock a:visited {
	text-decoration: none;
	color: #000;
}
.variablesblock a:hover {
	text-decoration: underline;
	color: #000;
}
.variablesblock a:active {
	text-decoration: none;
	color: #000;
}

.variablessubtitle {
	padding: 3px;
	font-weight: bold;
	border: 1px solid #FFF;
}

.variablescontent {
	font-size: 11pt;
	color: #000;
	background-color: #FFF;
	padding: 3px;
}
-->
</style>
<div class="variablesblock">
    <div class="variablessubtitle">Variables: {$variables_link}</div>
    {$variables_content}
</div>
END;

    }

}