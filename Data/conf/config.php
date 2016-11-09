<?php
/**
 *项目公共配置
 *@package imicms
 *@author imicms
 **/
return array(
	'LOAD_EXT_CONFIG' 		=> 'db,info,email,safe,upfile,cache,route,app,alipay,tenpay,rippleos_key,sms,platform',		
	'APP_AUTOLOAD_PATH'     =>'@.ORG',
	'OUTPUT_ENCODE'         =>  true, 			//页面压缩输出
	'PAGE_NUM'				=> 15,
	/*Cookie配置*/
	'COOKIE_PATH'           => '/',     		// Cookie路径
    'COOKIE_PREFIX'         => '',      		// Cookie前缀 避免冲突
	/*定义模版标签*/
	'TMPL_L_DELIM'   		=>'{iMicms:',			//模板引擎普通标签开始标记
	'TMPL_R_DELIM'			=>'}',				//模板引擎普通标签结束标记
	'url'                  =>'http://',
	
	//'SHOW_PAGE_TRACE' =>1,
);
?>