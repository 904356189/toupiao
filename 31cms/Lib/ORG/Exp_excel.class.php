<?php
class Exp_excel {
	private $header = "<?xml version=\"1.0\" encoding=\"%s\"?\>\n<Workbook xmlns=\"urn:schemas-microsoft-com:office:spreadsheet\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns:ss=\"urn:schemas-microsoft-com:office:spreadsheet\" xmlns:html=\"http://www.w3.org/TR/REC-html40\">";  
	  
	private $footer = "</Workbook>";    
	private $lines = array();  
	private $sEncoding;  
	private $bConvertTypes;  
	private $sWorksheetTitle;  
	function __construct()
	{
		$this->bConvertTypes = false;  
		$this->setEncoding('UTF-8');  
		$this->setWorksheetTitle('Table1'); 
	}
	public function setEncoding($sEncoding)  
	{  
		$this->sEncoding = $sEncoding;  
	}  
	public function setWorksheetTitle ($title)  
	{  
		$title = preg_replace ("/[\\\|:|\/|\?|\*|\[|\]]/", "", $title);  
		$title = mb_substr($title, 0, 31);  
		$this->sWorksheetTitle = $title;  
	}  
	private function addRow ($array)  
	{  
	$cells = "";  
	foreach ($array as $k => $v):  
	$type = 'String';  
	if ($this->bConvertTypes === true && is_numeric($v)):  
	$type = 'Number';  
	endif;  
	//$v = htmlentities($v, ENT_COMPAT, $this->sEncoding);
    $v = htmlspecialchars($v, ENT_COMPAT, $this->sEncoding);	
	$cells .= "<Cell><Data ss:Type=\"$type\">" . $v . "</Data></Cell>\n";   
	endforeach;  
	$this->lines[] = "<Row>\n" . $cells . "</Row>\n";  
	}  
	public function addArray ($array)  
	{  
	foreach ($array as $k => $v)  
	$this->addRow ($v);  
	}  

	public function generateXML ($filename = 'excel-export')  
	{  

	$filename = preg_replace('/[^aA-zZ0-9\_\-]/', '', $filename);  
	  
 
	header("Content-Type: application/vnd.ms-excel; charset=" . $this->sEncoding);  
	header("Content-Disposition: inline; filename=\"" . $filename . ".xls\"");  
	   
	echo stripslashes (sprintf($this->header, $this->sEncoding));  
	echo "\n<Worksheet ss:Name=\"" . $this->sWorksheetTitle . "\">\n<Table>\n";  
	foreach ($this->lines as $line)  
	echo $line;  
	  
	echo "</Table>\n</Worksheet>\n";  
	echo $this->footer;  
	}  
}
?>