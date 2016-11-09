<?php
class CronAction extends WapAction{
public function _initialize() {
parent::_initialize();
}



	public function index(){
		

     
		$vote= M('Vote')->where()->select();
		

		


		if(IS_POST){
			if($_POST['ajax']==1 && !empty($_POST['vote_id'])){
			$item= M('Vote_item')->where("vid=".$_POST['vote_id'])->select();
			$this->ajaxReturn($item);
			
			}else{
				 $data['vid']  =$_POST['vote']  ;
				 $data['item_id']  =$_POST['item']  ;
				 $data['wecha_id']=$_POST['openid'];
				 $data['ip']    =$_POST['ip']    ;
				 $data['area']  =$_POST['city']  ;
				 $data['touch_time']  =$_POST['time']  ;

				 $data['touched']  =1  ;
				 $data['qxgzys']  =1  ;

				 $data['token']  =$_POST['token'] ;

				 //print_r($data);
				 M('vote_record')->add($data);
				 M('vote_item')->where('vid='.$_POST['vote'])->setInc('vcount',1);
			}
		    exit;
		}

		$list=M('Vote_item')->select();
		$this->assign('list',$list);


        $this->assign('vote',$vote);
        $this->assign('item',$item);
		$this->display();
	}


}
?>