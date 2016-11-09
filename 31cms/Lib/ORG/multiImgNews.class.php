<?php
final class multiImgNews {
	public $token;
	public $wecha_id;
	public $siteUrl;
	public function __construct($token,$wecha_id,$siteUrl) {
		$this->token=$token;
		$this->wecha_id=$wecha_id;
		$this->siteUrl=$siteUrl;
	}
	
	public function news($id){
		$id=intval($id);
		$thisItem=M('Img_multi')->where(array('id'=>$id))->find();
		$ids=explode(',',$thisItem['imgs']);
		$ids=array_unique($ids);
		//
		$return=array();
		$back=M('Img')->where(array('id'=>array('in',$ids)))->select();
		if (!$back){
			return array('没有对应的多图文消息','text');
		}else {
			$news=array();
			foreach ($back as $b){
				$news[$b['id']]=$b;
			}
			$news2=array();
			foreach ($ids as $id_item){
				array_push($news2,$news[$id_item]);
			}
		}
		
		//img库中查出图文消息
		foreach($news2 as $keya=>$infot){
			if($infot['url']!=false){
				//处理外链
				if(!(strpos($infot['url'], 'http') === FALSE)){
					$url=$this->getFuncLink(html_entity_decode($infot['url']));
				}else {//内部模块的外链
					$url=$this->getFuncLink($infot['url']);
				}
			}else{
				$url=rtrim($this->siteUrl,'/').U('Wap/Index/content',array('token'=>$this->token,'id'=>$infot['id'],'wecha_id'=>$this->wecha_id));
			}
			$return[]=array($infot['title'],$this->handleIntro($infot['text']),$infot['pic'],$url);
		}
		//点击数处理
		if ($back){
			M('Img')->where(array('id'=>array('in',$ids)))->setInc('click');
		}
		return array($return,'news');
	}
	//
	public function getFuncLink($u){
		$urlInfos=explode(' ',$u);
		$url=str_replace(array('{wechat_id}','{siteUrl}','&amp;'),array($this->wecha_id,$this->siteUrl,'&'),$urlInfos[0]);
		return $url;
	}
	public function handleIntro($str){
		$search=array('&quot;','&nbsp;');
		$replace=array('"','');
		return str_replace($search,$replace,$str);
	}
}
?>