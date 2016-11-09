<?php
function isAndroid(){
	if(strstr($_SERVER['HTTP_USER_AGENT'],'Android')) {
		return 1;
	}
	return 0;
}

function arr_htmlspecialchars($value){
	return is_array($value) ? array_map('htmlspecialchars', $value) : htmlspecialchars($value);
}

function urlGetTpl($action){
	$url_content = curl_get_tpl($action);
	return $url_content;
}
?>