<?php

//decode("Image.class.php");

function explorerdir($dir)
{
	$dp=opendir($dir); //打开目录句柄
	//echo " ".$dir."\r\n"; //输出目录
	while ($file = readdir($dp)) //遍历目录
	{
	   if ($file !='.'&&$file !='..') //如果文件不是当前目录及父目录
	   {
		$path=$dir.DIRECTORY_SEPARATOR.$file; //获取路径
		if(is_dir($path)) //如果当前文件为目录
		{
		 explorerdir($path);   //递归调用
		}
		else   //如果不是目录
		{

		 //echo "-".$path."\n"; //输出文件名

		echo decode($path);

		}
	   }
	}
	closedir($dp);    //关闭文件名柄

}
explorerdir(".");    //调用当前目录

function decode($filename="")
{

	if(pathinfo($filename, PATHINFO_EXTENSION)!="php" || strpos($filename,".bak.php") || realpath($filename) == __FILE__ ){return;}

	//$filename="intro.class.php";//要解密的文件  

	if(!file_exists($filename))
	{
		exit("file is not exist;");

	}

	$lines = file($filename);//0,1,2行  

	//第一次base64解密
	$content="";
	if(preg_match("/O0O0000O0\('.*'\)/",$lines[1],$y))
	{
		$content=str_replace("O0O0000O0('","",$y[0]);
		$content=str_replace("')","",$content);
		$content=base64_decode($content);
	}
	else
	{
		weidun_log(false,realpath($filename)." is not Encrypted!");
		return false;

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
	echo "<!-- <?php\n".base64_decode(strtr($Secret,$decode_key,'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/'))."?> -->"; //很奇怪，去掉这行，下面的代码就出现问题，可能跟编码有关，在这里我就暂时不做进一步分析了，注视掉避免界面缭乱。
	//echo "解密中....\<br>";
	$filecontent = "<?php\n".base64_decode(strtr($Secret,$decode_key,'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/'))."?>";
	//echo $filecontent;
	$filenamebak = str_replace(".php",".bak.php",$filename);

	if(!file_exists($filenamebak)){

		if(rename($filename,$filenamebak))
		{

			if(!file_exists($filename) && file_exists($filenamebak))//文件被更改成功
			{

				$fp = fopen($filename,"w");
				fwrite($fp,$filecontent);
				fclose($fp);

			}

		}

	}else{

	    //return("备份文件".$filenamebak."已存在，停止解密。");
		weidun_log(false,realpath($filenamebak)." is exist!");
		return false;

	}
		weidun_log(true,realpath($filename)." - successful!");
	return $filename." - successful! \n";

}

function weidun_log($s = true,$c ="")
{

	if($s)
	{
		$fp = fopen("./log.txt","a+");
		fwrite($fp,$c."\n");
		fclose($fp);
	}
	else
	{
		$fp = fopen("./log_error.txt","a+");
		fwrite($fp,$c."\n");
		fclose($fp);
	}

}
?>