<?php
 
$filename="WeixinAction.class.php";//Ҫ���ܵ��ļ�
$lines = file($filename);//0,1,2��
 
//��һ��base64����
$content="";
if(preg_match("/O0O0000O0\('.*'\)/",$lines[1],$y))
{
    $content=str_replace("O0O0000O0('","",$y[0]);
    $content=str_replace("')","",$content);
    $content=base64_decode($content);
}
//��һ��base64���ܺ�������в�����Կ
$decode_key="";
if(preg_match("/\),'.*',/",$content,$k))
{
    $decode_key=str_replace("),'","",$k[0]);
    $decode_key=str_replace("',","",$decode_key);
}
//����Ҫ��ȡ�ַ�������
$str_length="";
if(preg_match("/,\d*\),/",$content,$k))
{
    $str_length=str_replace("),","",$k[0]);
    $str_length=str_replace(",","",$str_length);
}
//��ȡ�ļ����ܺ������
$Secret=substr($lines[2],$str_length);
//echo $Secret;
 
//ֱ�ӻ�ԭ�������
echo "<?php\n".base64_decode(strtr($Secret,$decode_key,
'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/')).
"?>";
 
?>