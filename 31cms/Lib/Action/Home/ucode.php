<?php
 
$filename="WeixinAction.class.php";//要解密的文件
$lines = file($filename);//0,1,2行
 
//第一次base64解密
$content="";
if(preg_match("/O0O0000O0\('.*'\)/",$lines[1],$y))
{
    $content=str_replace("O0O0000O0('","",$y[0]);
    $content=str_replace("')","",$content);
    $content=base64_decode($content);
}
//第一次base64解密后的内容中查找密钥
$decode_key="";
if(preg_match("/\),'.*',/",$content,$k))
{
    $decode_key=str_replace("),'","",$k[0]);
    $decode_key=str_replace("',","",$decode_key);
}
//查找要截取字符串长度
$str_length="";
if(preg_match("/,\d*\),/",$content,$k))
{
    $str_length=str_replace("),","",$k[0]);
    $str_length=str_replace(",","",$str_length);
}
//截取文件加密后的密文
$Secret=substr($lines[2],$str_length);
//echo $Secret;
 
//直接还原密文输出
echo "<?php\n".base64_decode(strtr($Secret,$decode_key,
'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/')).
"?>";
 
?>