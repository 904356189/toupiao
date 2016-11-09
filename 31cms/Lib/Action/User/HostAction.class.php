<?php

class HostAction extends UserAction{
public function index(){
$IIIIIIl11l1I=M('token_open')->field('queryname')->where(array('token'=>session('token')))->find();
if(!strpos($IIIIIIl11l1I['queryname'],'host_kev')){
$this->error('您的VIP权限不够,请到升级会员VIP',U('Alipay/vip',array('token'=>session('token'),'id'=>session('wxid'))));
}
$IIIIIIIIIl11=M('Host');
$IIIIIIIII1ll      = $IIIIIIIIIl11->where(array('token'=>$_SESSION['token']))->count();
$IIIIIIll1lll       = new Page($IIIIIIIII1ll,12);
$IIIIIIIII11l       = $IIIIIIll1lll->show();
$IIIIIIIIlIII = $IIIIIIIIIl11->where(array('token'=>$_SESSION['token']))->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->select();
if(IS_POST){
$IIIIIIIlI11I = $this->_post('searchkey');
if(empty($IIIIIIIlI11I)){
$this->error("关键词不能为�?);
            }

            $IIIIII1IIlIl['token'] = $this->get('token'); 
            $IIIIII1IIlIl['keyword|title|tel2|tel'] = array('like',"%$IIIIIIIlI11I%"); 
            $IIIIIIIIlIII = M('Host')->where($IIIIII1IIlIl)->select();             
             
        }
		$this->assign('page',$IIIIIIIII11l);		
		$this->assign('list',$IIIIIIIIlIII);
		$this->display();		
	}
	 
	public function set(){
		
        $IIIIIIIII1I1 = $this->_get('id'); 
		$IIIIII1IIlI1 = M('Host')->where(array('token'=>$_SESSION['token'],'id'=>$IIIIIIIII1I1))->find();
		if(empty($IIIIII1IIlI1)){
            $this->error("没有商家记录.您现在可以添�?",U('Host/add',array('token'=>session('token'))));
        }
		if(IS_POST){ 
            $_POST['id']        = $this->_post('id');
            $_POST['token']     = session('token');
            $_POST['keyword']   = $this->_post('keyword');            
            $IIIIIIIIIl11=D('Host');
            $IIIIIIIIlIl1=array('id'=>$this->_post('id'),'token'=>$this->_post('token'));
			$IIIIIIl111Il=$IIIIIIIIIl11->where($IIIIIIIIlIl1)->find();
			if($IIIIIIl111Il==false)$this->error('非法操作');
			if($IIIIIIIIIl11->create()){
				if($IIIIIIIIIl11->where($IIIIIIIIlIl1)->save($_POST)){
					$IIIIIIllllI1['pid']=$_POST['id'];
					$IIIIIIllllI1['module']='Host';
					$IIIIIIllllI1['token']=session('token');
					$IIIIIIIlII11['keyword']=$_POST['keyword'];
					M('Keyword')->where($IIIIIIllllI1)->save($IIIIIIIlII11);
					$this->success('修改成功',U('Host/index',array('token'=>session('token'))));
				}else{
					$this->error('操作失败');
				}
			}else{
				$this->error($IIIIIIIIIl11->getError());
			}
		}else{ 
			$this->assign('set',$IIIIII1IIlI1);
			$this->display();	
		
		}
		
	}
    
	public function add(){ 
          if(IS_POST){   
            $this->all_insert('Host'); 
          }else{
			$this->display('set');
		  }
	}

	public function index_del(){

		if($this->_get('token')!=session('token')){$this->error('非法操作');}
        $IIIIIIIII1I1 = $this->_get('id');

        if(IS_GET){                              
            $IIIIIIIIlIl1=array('id'=>$IIIIIIIII1I1,'token'=>session('token'));
            $IIIIIIIIIl11=M('Host');
            $IIIIIIl111Il=$IIIIIIIIIl11->where($IIIIIIIIlIl1)->find();
            if($IIIIIIl111Il==false)   $this->error('非法操作');

            $IIIIIIIlIIIl=$IIIIIIIIIl11->where($IIIIII1IIllI)->delete();
            if($IIIIIIIlIIIl==true){
                M('Keyword')->where(array('pid'=>$IIIIIIIII1I1,'token'=>session('token'),'module'=>'Host'))->delete();
                $this->success('操作成功',U('Host/index',array('token'=>session('token'))));
            }else{
                 $this->error('服务器繁�?请稍后再�?,U('Host/index',array('token'=>session('token'))));
            }
        }        
	}

    public function lists(){
        $IIIIIIIIIl11=M('Host_list_add');
        $IIIIII1IIlll = $this->_get('id');
        $IIIIIIIII1ll      = $IIIIIIIIIl11->where(array('token'=>$_SESSION['token'],'hid'=>$IIIIII1IIlll))->count();
        $IIIIIIll1lll       = new Page($IIIIIIIII1ll,12);
        $IIIIIIIII11l       = $IIIIIIll1lll->show();
        $IIIIII1IIll1 = $IIIIIIIIIl11->where(array('token'=>$_SESSION['token'],'hid'=>$IIIIII1IIlll))->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->select(); 

        $this->assign('page',$IIIIIIIII11l);        
        $this->assign('li',$IIIIII1IIll1);
        $this->display();

    }

    public function list_add(){
        
        if(IS_POST){
             $IIIIIIIIIl11['hid']      = $this->_get('hid'); 
             if(empty($IIIIIIIIIl11['hid'] )){
                $this->error('链接失效�?);
                exit;
             }    

             $IIIIIIIIIl11['type']    = $this->_post('type');            
             $IIIIIIIIIl11['typeinfo']= $this->_post('typeinfo');
             $IIIIIIIIIl11['price']   = $this->_post('price');
             $IIIIIIIIIl11['yhprice'] = $this->_post('yhprice');
             $IIIIIIIIIl11['name']    = $this->_post('name');
             $IIIIIIIIIl11['picurl']  = $this->_post('picurl');
             $IIIIIIIIIl11['url']     = $this->_post('url');
             $IIIIIIIIIl11['info']    = $this->_post('info');
             $IIIIIIIIIl11['token']   = session('token');
             if(empty($IIIIIIIIIl11['type']) || 
                empty($IIIIIIIIIl11['typeinfo'])||
                empty($IIIIIIIIIl11['price'])|| 
                empty($IIIIIIIIIl11['yhprice'])|| 
                empty($IIIIIIIIIl11['info']) 
                ) {
                    $this->error("不能为空.");exit;
             }
             M('Host_list_add')->data($IIIIIIIIIl11)->add();
             $this->success('操作成功');
             //$this->display('list');
        }else{
			$this->display();
		}
    }

     public function list_edit(){
        
            $IIIIIIIII1I1 = $this->_get('id');
            $IIIIIIIIlIlI = session('token');
            $IIIIII1IIl1I = M('Host_list_add')->where(array('id'=>$IIIIIIIII1I1,'token'=>$IIIIIIIIlIlI))->find();
            if(IS_POST){
                 $IIIIIIIIIl11['type']    = $this->_post('type');
                 $IIIIIIIIIl11['typeinfo']= $this->_post('typeinfo');
                 $IIIIIIIIIl11['price']   = $this->_post('price');
                 $IIIIIIIIIl11['yhprice'] = $this->_post('yhprice');
                 $IIIIIIIIIl11['name']    = $this->_post('name');
                 $IIIIIIIIIl11['picurl']  = $this->_post('picurl');
                 $IIIIIIIIIl11['url']     = $this->_post('url');
                 $IIIIIIIIIl11['info']    = $this->_post('info');                  
                 if(empty($IIIIIIIIIl11['type']) || 
                    empty($IIIIIIIIIl11['typeinfo'])||
                    empty($IIIIIIIIIl11['price'])|| 
                    empty($IIIIIIIIIl11['yhprice'])|| 
                    empty($IIIIIIIIIl11['info']) 
                    ) {
                        $this->error("不能为空.");exit;
                 }
                 $IIIIIIIIlIl1 = array('id'=>$IIIIIIIII1I1,'token'=>session('token'));                 
                 M('Host_list_add')->where($IIIIIIIIlIl1)->save($IIIIIIIIIl11);
                 $this->success('操作成功',U('Host/index',array('token'=>session('token'))));

            }else{
				$this->assign('list',$IIIIII1IIl1I);
				$this->display('list_add');
			}
    }
	public function list_del(){
		$IIIIIIIII1I1 = $this->_get('id');
            $IIIIIIIIlIlI = session('token');
		 $IIIIIIIIIl11 = M('Host_list_add')->where(array('id'=>$IIIIIIIII1I1,'token'=>$IIIIIIIIlIlI))->delete();
		if($IIIIIIIIIl11==false){
			$this->error('删除失败');
		}else{
			$this->success('操作成功');
		}
	
	}



    public function admin(){

        $IIIIII1IIlll = $this->_get('id');        
        $IIIIIIIIIl11=M('Host_order');
        $IIIIIIIII1ll      = $IIIIIIIIIl11->where(array('token'=>$_SESSION['token'],'hid'=>$IIIIII1IIlll))->count();
        $IIIIII1IIl1l      = $IIIIIIIIIl11->where(array('token'=>$_SESSION['token'],'order_status'=>1,'hid'=>$IIIIII1IIlll))->count();
        $IIIIII1IIl11      = $IIIIIIIIIl11->where(array('token'=>$_SESSION['token'],'order_status'=>2,'hid'=>$IIIIII1IIlll))->count();
        $IIIIII1II1II      = $IIIIIIIIIl11->where(array('token'=>$_SESSION['token'],'order_status'=>3,'hid'=>$IIIIII1IIlll))->count();
        $IIIIIIll1lll       = new Page($IIIIIIIII1ll,20);
        $IIIIIIIII11l       = $IIIIIIll1lll->show();
        $IIIIII1IIll1 = $IIIIIIIIIl11->where(array('token'=>$_SESSION['token'],'hid'=>$IIIIII1IIlll))->limit($IIIIIIll1lll->firstRow.','.$IIIIIIll1lll->listRows)->select(); 
        $this->assign('count',$IIIIIIIII1ll);
        $this->assign('ok_count',$IIIIII1IIl1l);
        $this->assign('no_count',$IIIIII1II1II);
        $this->assign('lost_count',$IIIIII1IIl11);
        $this->assign('page',$IIIIIIIII11l);        
        $this->assign('li',$IIIIII1IIll1);
        if(IS_POST){
           $IIIIIIIlII11['check_in']     = strtotime($this->_post('check_in'));
           $IIIIIIIlII11['order_status'] = $this->_post('status');
           $IIIIIIIII1I1 = $this->_post('id');
           $IIIIII1IIlll = $this->_post('hid');
           $IIIIIIIIlIlI = session('token');
           M('Host_order')->where(array('id'=>$IIIIIIIII1I1,'token'=>$IIIIIIIIlIlI))->save($IIIIIIIlII11);
           $this->success('操作成功',U('Host/admin',array('token'=>session('token'),'id'=>$IIIIII1IIlll)));
           
        }else{
			$this->display();
		}
    }


}


?>

?>