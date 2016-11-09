<?php

class PageClass
{
private $myde_count;       //总记录数
public $myde_size;        //每页记录数
private $myde_page;        //当前页
private $myde_page_count; //总页数
private $page_url;         //页面url
private $page_i;           //起始页
private $page_ub;          //结束页
public $page_limit;


function __construct($myde_count=0,$myde_size=1,$myde_page=1,$page_url)   //构造函数,初始化
{  
   $this->myde_count=$this->numeric($myde_count);
   $this->myde_size=$this->numeric($myde_size);
   $this->myde_page=$this->numeric($myde_page);
   $this->page_limit=($this->myde_page * $this -> myde_size) - $this -> myde_size; //下一页的开始记录
   $this->page_url=$page_url; //连接的地址
   if($this->myde_page<1)$this->myde_page=1; //当前页小于1的时候，，值赋值为1
   if($this->myde_count<0)$this->myde_page=0;
   $this->myde_page_count=ceil($this->myde_count/$this->myde_size);//总页数
   if($this->myde_page_count<1)
    $this->myde_page_count=1;
   if($this->myde_page > $this->myde_page_count)
     $this->myde_page = $this->myde_page_count;
  
  
   //控制显示出来多少个页码（这个是原来的）
   //$this->page_i = $this->myde_page-2;
   //$this->page_ub = $this->myde_page+2;


   $this->page_i = $this->myde_page;
   $this->page_ub = $this->myde_page+4;
   //以下这个if语句是保证显示5个页码
   if($this->page_ub > $this->myde_page_count)
   {
    $this->page_ub = $this->myde_page_count;
	$this->page_i = $this->page_ub-4;
   }
  
  
   if($this->page_i<1)$this->page_i=1;       
        if($this->page_ub>$this->myde_page_count){$this->page_ub=$this->myde_page_count; }
}
      private function numeric($id) //判断是否为数字
    {
if (strlen($id))
         {
             if (!ereg("^[0-9]+$",$id)) $id = 1;
         }
      else
         {
             $id = 1;
         }
      return $id;
    }


private function page_replace($page) //地址替换
{return str_replace("{page}", $page, $this -> page_url);}


private function myde_home() //首页
{ if($this -> myde_page != 1){
    return "    <li><a href=\"".$this -> page_replace(1)."\" title=\"首页\" ><span>首页</span></a></li>\n";  
   }else{
    return "    <li><span>首页</span></li>\n";  
   }
}
private function myde_homewx() //首页
{ if($this -> myde_page != 1){
    return "<li><a href=\"".$this -> page_replace(1)."\">&lt;&lt;</a></li>\n";  
   }else{
    return "";  
   }
}
private function myde_homewxa() //首页
{ if($this -> myde_page != 1){
    return "<dd class=\"home\"><a href=\"".$this -> page_replace(1)."\">首页</a></dd>\n";  
   }else{
    return "<dd class=\"home_no\">首页</dd>\n";  
   }
}

private function myde_prev() //上一页
{ if($this -> myde_page != 1){
    return "    <li><a href=\"".$this -> page_replace($this->myde_page-1) ."\" title=\"上一页\" ><span>上一页</span></a></li>\n";
   }else{
    return "    <li><span>上一页</span></li>\n";  
   }
}
private function myde_prevwx() //上一页
{ if($this -> myde_page != 1){
    return "<li><a href=\"".$this -> page_replace($this->myde_page-1) ."\">&lt;</a></li>\n";
   }else{
    return "";  
   }
}


private function myde_next() //下一页
{
if($this -> myde_page != $this -> myde_page_count){
     return "    <li><a href=\"".$this -> page_replace($this->myde_page+1) ."\" title=\"下一页\" ><span>下一页</span></a></li>\n";
   }else
     {
    return "    <li><span>下一页</span></li>\n";  
   }
}

private function myde_nextwx() //下一页
{
if($this -> myde_page != $this -> myde_page_count){
     return "<li><a href=\"".$this -> page_replace($this->myde_page+1) ."\">&gt;</a></li>\n";
   }else
     {
    return "";  
   }
}


private function myde_last() //尾页
{
   if($this -> myde_page != $this -> myde_page_count){
     return "    <li><a href=\"".$this -> page_replace($this -> myde_page_count)."\" title=\"末页\" ><span>末页</span></a></li>\n";
   }else{
     return "    <li><span>末页</span></li>\n";  
   }
}

private function myde_lastwx() //尾页
{
   if($this -> myde_page != $this -> myde_page_count){
     return "<li><a href=\"".$this -> page_replace($this -> myde_page_count)."\">&gt;&gt;</a></li>\n";
   }else{
     return "";  
   }
}
private function myde_lastwxa() //尾页
{
   if($this -> myde_page != $this -> myde_page_count){
     return "<dd class=\"last\"><a href=\"".$this -> page_replace($this -> myde_page_count)."\">末页</a></dd>\n";
   }else{
     return "<dd class=\"last_no\">末页</dd>\n";  
   }
}


function myde_write($id='page') //输出
{
   $str = $this -> myde_home(); //调用方法，显示“首页”
   $str .= $this -> myde_prev(); //调用方法，显示“上一页”

   //以下显示1,2,3...分页
   for($page_for_i=$this->page_i;$page_for_i <= $this -> page_ub;$page_for_i++){
    if($this -> myde_page == $page_for_i){  
            $str .= "<li><span class=\"currentpage\">".$page_for_i."</span></li>\n";   
    }  
    else{  
     $str .= "<li><a href=\"".$this -> page_replace($page_for_i)."\"><span>";   
     $str .= $page_for_i . "</span></a></li>\n";   
    }
        }
   $str .= $this -> myde_next(); //调用方法，显示“下一页”
   $str .= $this -> myde_last(); //调用方法，显示“尾页”

    //以下是显示跳转页框
   return $str;
}


function myde_writewx($id='page') //输出
{
   $str = $this -> myde_homewx(); //调用方法，显示“首页”
   $str .= $this -> myde_prevwx(); //调用方法，显示“上一页”

   //以下显示1,2,3...分页
   for($page_for_i=$this->page_i;$page_for_i <= $this -> page_ub;$page_for_i++){
    if($this -> myde_page == $page_for_i){  
            $str .= "<li  class=\"active\"><a href=\"javascript:;\">".$page_for_i."</a></li>\n";   
    }  
    else{  
     $str .= "<li ><a href=\"".$this -> page_replace($page_for_i)."\">";   
     $str .= $page_for_i . "</a></li>\n";   
    }
        }
   $str .= $this -> myde_nextwx(); //调用方法，显示“下一页”
   $str .= $this -> myde_lastwx(); //调用方法，显示“尾页”

    //以下是显示跳转页框
   return $str;
}

function myde_writewxa($id='page') //输出
{
   $str = $this -> myde_homewxa(); //调用方法，显示“首页”

   //以下显示1,2,3...分页
   for($page_for_i=$this->page_i;$page_for_i <= $this -> page_ub;$page_for_i++){
    if($this -> myde_page == $page_for_i){  
            $str .= "<dd class=\"num_out\">".$page_for_i."</dd>\n";   
    }  
    else{  
     $str .= "<dd class=\"num\"><a href=\"".$this -> page_replace($page_for_i)."\">";   
     $str .= $page_for_i . "</a></dd>\n";   
    }
        }
   $str .= $this -> myde_lastwxa(); //调用方法，显示“尾页”

    //以下是显示跳转页框
   return $str;
}

private function myde_homehd() //首页
{ if($this -> myde_page != 1){
    return "    <a href=\"".$this -> page_replace(1)."\" title=\"首页\" class=\"page-first\" >首页</a>\n";  
   }
}
private function myde_prevhd() //上一页
{ if($this -> myde_page != 1){
    return "    <a href=\"".$this -> page_replace($this->myde_page-1) ."\" title=\"上一页\" class=\"page-prev\">上一页</a>";
   }
}
private function myde_nexthd() //下一页
{
if($this -> myde_page != $this -> myde_page_count){
     return "    <a href=\"".$this -> page_replace($this->myde_page+1) ."\" title=\"下一页\" class=\"page-next\">下一页</a>";
   }
}
private function myde_lasthd() //尾页
{
   if($this -> myde_page != $this -> myde_page_count){
     return "   <a href=\"".$this -> page_replace($this -> myde_page_count)."\" title=\"末页\" class=\"page-last\">末页</a>";
   }
}



function myde_writehd($id='page') //输出
{
   $str = $this -> myde_homehd(); //调用方法，显示“首页”
   $str .= $this -> myde_prevhd(); //调用方法，显示“上一页”

   //以下显示1,2,3...分页
   for($page_for_i=$this->page_i;$page_for_i <= $this -> page_ub;$page_for_i++){
    if($this -> myde_page == $page_for_i){  
            $str .= "<strong>".$page_for_i."</strong>";   
    }  
    else{  
     $str .= "<a href=\"".$this -> page_replace($page_for_i)."\">";   
     $str .= $page_for_i . "</a>";   
    }
        }
   $str .= $this -> myde_nexthd(); //调用方法，显示“下一页”
   $str .= $this -> myde_lasthd(); //调用方法，显示“尾页”

    //以下是显示跳转页框
   return $str;
}



function myde_write1($id='page') //输出
{
   $str = "<div id=\"".$id."\" class=\"pages\">\n <ul>\n ";
   $str .= "<li><span>".$this -> myde_count."</span></li>\n";
   $str .= "<li><span>".$this -> myde_page."</span>/<span>".$this -> myde_page_count."</span></li>\n";
   $str .= $this -> myde_home(); //调用方法，显示“首页”
   $str .= $this -> myde_prev(); //调用方法，显示“上一页”
   //以下显示1,2,3...分页
   for($page_for_i=$this->page_i;$page_for_i <= $this->page_ub;$page_for_i++){
    if($this -> myde_page == $page_for_i)
{  
            $str .= "<li class=\"on\">".$page_for_i."</li>\n";   
    }  
    else{  
     $str .= "<li class=\"page_a\"><a href=\"".$this -> page_replace($page_for_i)."\" title=\"".$page_for_i."\">";   
     $str .= $page_for_i . "</a></li>\n";   
    }
    //以上显示1,2,3...分页
}
   $str .= $this -> myde_next(); //调用方法，显示“下一页”
   $str .= $this -> myde_last(); //调用方法，显示“尾页”
    //以下是显示下拉式跳转页框
$str .="<li ><select class=\"**********\" onchange=\" javascript: location='".$this->page_replace("'+this.value+'")."';return false; \">";
    $str .="<option value=\"\"></option>";
for($i=1;$i <= $this->myde_page_count;$i++)
     {
    $str .="<option value=\"".$i."\">".$i."</option>";
     }
$str .="</select></li>\n";
   //以下是显示下拉式跳转页框
  
   //以下是显示跳转页框
   $str .= "<li class=\"pages_input\"><input type=\"text\" value=\"".$this -> myde_page."\"";
   $str .= "onmouseover=\"javascript:this.value='';this.focus();\" onkeydown=\"javascript: if(event.keyCode==13){ location='";
   $str .= $this -> page_replace("'+this.value+'")."';return false;}\"";
   $str .= "title=\"\" /></li>\n";
   //以上是显示跳转页框
   $str .= " </ul></div>";
   return $str;
}
}
/*-------------------------实例--------------------------------*
$page = new PageClass(1000,5,$_GET['page'],'?page={page}');//用于动态
$page = new PageClass(1000,5,$_GET['page'],'list-{page}.html');//用于静态或者伪静态
$page -> myde_write();//显示
*/
?>