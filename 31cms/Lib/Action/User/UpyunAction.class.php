<?php
class UpyunAction extends UserAction{
	public $token;
	public $bucket;
	public $form_api_secret;
	public $upyun_domain;
	public $upload_type;
	public function _initialize() {
		parent::_initialize();
		$this->token=$this->_session('token');
		if (!$this->token){
			$this->token='admin';
		}
		$this->bucket=UNYUN_BUCKET;
		$this->form_api_secret=UNYUN_FORM_API_SECRET;
		$this->upyun_domain=UNYUN_DOMAIN;
		$this->assign('upyun_domain','http://'.$this->upyun_domain);
		//
		$this->upload_type=C('upload_type')?C('upload_type'):'local';
		C('site_url','http://'.$_SERVER['HTTP_HOST']);
	}
	public function upload(){
		if (!isset($_SESSION['username'])&&!isset($_SESSION['uid'])){
			//exit('非法操作');
		}
		if ($this->upload_type=='upyun'){

			if (C('site_url')!='http://'.$_SERVER['HTTP_HOST']){
				exit('您的访问地址(http://'.$_SERVER['HTTP_HOST'].')和总后台配置地址('.C('site_url').')不一致，请修改总后台配置');
			}
			$bucket = $this->bucket; /// 空间名
			$form_api_secret = $this->form_api_secret; /// 表单 API 功能的密匙（请访问又拍云管理后台的空间管理页面获取）

			$options = array();
			$options['bucket'] = $bucket; /// 空间名
			$options['expiration'] = time()+600; /// 授权过期时间
			$options['save-key'] = '/'.$this->token.'/{year}/{mon}/{day}/'.time().'_{random}{.suffix}'; /// 文件名生成格式，请参阅 API 文档
			$options['allow-file-type'] = C('up_exts'); /// 控制文件上传的类型，可选
			$options['content-length-range'] = '0,'.intval(C('up_size'))*1024; /// 限制文件大小，可选
			if (intval($_GET['width'])){
				$options['x-gmkerl-type'] = 'fix_width';
				$options['fix_width '] = $_GET['width'];
			}
			$options['return-url'] = C('site_url').'/index.php?g=User&m=Upyun&a=uploadReturn'; /// 页面跳转型回调地址
			$policy = base64_encode(json_encode($options));
			$sign = md5($policy.'&'.$form_api_secret); /// 表单 API 功能的密匙（请访问又拍云管理后台的空间管理页面获取）
			$this->assign('bucket',$bucket);
			$this->assign('sign',$sign);
			$this->assign('policy',$policy);
			if (!isset($_GET['from'])){
				$this->display();
			}else {
				$this->display('wap');
			}
			
		}elseif ($this->upload_type=='local'){
			if (!function_exists('imagecreate')){
				exit('php不支持gd库，请配置后再使用');
			}
			if (IS_POST){
			
				$return=$this->localUpload();
				//$msg = '/index.php?g=User&m=Upyun&a=upload&error='.$return['error'].'&msg='.$return['msg'];
				//echo "<script>alert('23".$msg."');</script>";
				echo '<script>location.href="./index.php?g=User&m=Upyun&a=upload&error='.$return['error'].'&msg='.$return['msg'].'";</script>';
			}else {
				if (!isset($_GET['from'])){
					$this->display('local');
				}else {
					$this->display('waplocal');
				}
				
			}
		}
	}
	
	public function localUploadSNExcel(){
		$return=$this->localUpload(array('xls'));
		if ($return['error']){
			$this->error($return['msg']);
		}else {
			$data = new Spreadsheet_Excel_Reader();
			// 设置输入编码 UTF-8/GB2312/CP936等等
			$data->setOutputEncoding('UTF-8');
			$data->read(str_replace('http://'.$_SERVER['HTTP_HOST'],$_SERVER['DOCUMENT_ROOT'],$return['msg']));
			chmod(str_replace('http://'.$_SERVER['HTTP_HOST'],$_SERVER['DOCUMENT_ROOT'],$return['msg']),0777);
			//
			$sheet=$data->sheets[0];
			$rows=$sheet['cells'];
			if ($rows){
				$i=0;
				foreach ($rows as $r){
					if ($i!=0){
						$db=M('Lottery_record');
						$where=array('token'=>$this->token,'lid'=>intval($_POST['lid']),'sn'=>trim($r[1]));
						$check=$db->where($where)->find();
						if (!$check){
							$where['prize']=intval($r['2']);
							$db->add($where);
						}
					}
					$i++;
				}
			}
			$this->success('操作完成');
		}
	}
	public function localUploadUsecordExcel(){
		$token = $this->token;
		$wecha_id = $this->_post('wecha_id');
		$return=$this->localUpload(array('xls'));
		if ($return['error']){
			$this->error($return['msg']);
		}else {
		
			$data = new Spreadsheet_Excel_Reader();
			// 设置输入编码 UTF-8/GB2312/CP936等等
			$data->setOutputEncoding('UTF-8');
			$data->read(str_replace('http://'.$_SERVER['HTTP_HOST'],$_SERVER['DOCUMENT_ROOT'],$return['msg']));
			chmod(str_replace('http://'.$_SERVER['HTTP_HOST'],$_SERVER['DOCUMENT_ROOT'],$return['msg']),0777);
			//
			$sheet=$data->sheets[0];
			$rows=$sheet['cells'];
			if ($rows){
				$i=0;
				$record = M('Member_card_use_record');
				foreach ($rows as $r){
				//跳过表头
					if($i != 0){
						
						$info['itemid'] = (int)$r[1];
						$info['wecha_id'] = htmlspecialchars($r[2]);
						if($info['wecha_id'] == ''){
							$info['wecha_id'] = $wecha_id;
						}
						$info['staffid'] = (int)$r[3];
						
						if($r[4] == '兑换'){
							$info['cat'] = 2;
						}elseif($r[4] == '分享'){
							$info['cat'] = 98;
						}else{
							$info['cat'] = 3;
						}
						
						$info['expense'] = (int)$r[5];
						$info['score'] = (int)$r[6];
						$info['usecount'] = (int)$r[7];
						if($r[8] == ''){
							$r[8] = time();
						}else{
							$r[8] = str_replace(array('年','月','时','分','日','秒'),array('-','-',':',':','',''),$r[8]);
						
						}
						
						$info['time'] = strtotime($r[8]);

						$info['token'] = $this->token;
						$record->add($info);

					
					}
					$i++;
				
				}
				
			}
			$this->success('操作完成');
		}

	}
//导入会员卡消费记录

	public function localUploadPayrecordExcel(){
		$token = $this->token;
		$wecha_id = $this->_post('wecha_id');
		$return=$this->localUpload(array('xls'));
		if ($return['error']){
			$this->error($return['msg']);
		}else {
		
			$data = new Spreadsheet_Excel_Reader();
			// 设置输入编码 UTF-8/GB2312/CP936等等
			$data->setOutputEncoding('UTF-8');
			$data->read(str_replace('http://'.$_SERVER['HTTP_HOST'],$_SERVER['DOCUMENT_ROOT'],$return['msg']));
			chmod(str_replace('http://'.$_SERVER['HTTP_HOST'],$_SERVER['DOCUMENT_ROOT'],$return['msg']),0777);
			//
			$sheet=$data->sheets[0];
			$rows=$sheet['cells'];
			if ($rows){
				$i=0;
				$record = M('Member_card_pay_record');
				foreach ($rows as $r){
				//跳过表头
					if($i != 0){
						//1.订单号	2.订单名称	3.第三方订单	4.支付类型	5.订单创建时间	6.金额	7.支付时间	8.支付状态	9.wecha_id	10.来源模块	11.类型

							$info['orderid'] = ltrim(htmlspecialchars($r[1]),'单号');
							$info['ordername'] = htmlspecialchars($r[2]);
							$info['transactionid'] = ltrim(htmlspecialchars($r[3]),'单号');
							$info['paytype'] = htmlspecialchars($r[4]);
							
							if($r[5] != ''){
								$r[5] = str_replace(array('年','月','时','分','日','秒'),array('-','-',':',':','',''),$r[5]);
								$info['createtime'] = strtotime($r[5]);
							}else{
								$info['createtime'] = '';
							}
							
							
							$info['price'] = htmlspecialchars($r[6]);
							
							if($r[7] != ''){
								$r[7] = str_replace(array('年','月','时','分','日','秒'),array('-','-',':',':','',''),$r[7]);
								$info['paytime'] = strtotime($r[7]);
							}else{
								$info['paytime'] = '';
							}
							
							if($r[8] == '交易成功'){
								$info['paid'] = 1;
							}else{
								$info['paid'] = 0;
							}
							
							
							
							
							$info['wecha_id'] = htmlspecialchars($r[9]);
							$info['module'] = htmlspecialchars($r[10]);
							
							if($r[11] == '充值'){
								$info['type'] = 1;
							}else{
								$info['type'] = 0;
							}
							

						$info['token'] = $token;
						
							$record->add($info);
						
						

					
					}
					$i++;
				
				}
				
			}
			$this->success('操作完成');
		}
	
	}
	
//导入excel会员卡
	
	public function localUploadCardExcel(){
		$token = $this->token;
		$cardid = (int)$_POST['id'];
		$return=$this->localUpload(array('xls'));
		if ($return['error']){
			$this->error($return['msg']);
		}else {
		
			$data = new Spreadsheet_Excel_Reader();
			// 设置输入编码 UTF-8/GB2312/CP936等等
			$data->setOutputEncoding('UTF-8');
			$data->read(str_replace('http://'.$_SERVER['HTTP_HOST'],$_SERVER['DOCUMENT_ROOT'],$return['msg']));
			chmod(str_replace('http://'.$_SERVER['HTTP_HOST'],$_SERVER['DOCUMENT_ROOT'],$return['msg']),0777);
			//
			$sheet=$data->sheets[0];
			$rows=$sheet['cells'];
			if ($rows){
				$i=0;
				foreach ($rows as $r){
				//跳过表头
					if($i != 0){
						$db=M('Userinfo');
						$create_db = M('Member_card_create');
						//随机token
						if($r[15] == ''){
							$str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
							for($j=0;$j<28;$j++){
								$rand = mt_rand(0,61);
								$r[15] .= $str[$rand];
							}
						}
						//	2姓名	3手机号	4积分	5微信名	6性别	7出生年	8出生月	9出生日	10头像地址	11QQ号 12领卡时间  13消费总额 14余额  15 wecha_id
						//1卡号  cardid  token   
						if($r[6] == '男'){
							$r[6] = 1;
						}elseif($r[6] == '女'){
							$r[6] = 2;
						}else{
							$r[6] = 3;
						}
						$info = array('token'=>$this->token,'truename'=>htmlspecialchars($r[2]),'tel'=>htmlspecialchars($r[3]),'total_score'=>(int)$r[4],'wechaname'=>htmlspecialchars($r[5]),'sex'=>$r[6],'bornyear'=>(int)$r[7],'bornmonth'=>$r[8],'bornday'=>$r[9],'portrait'=>$r[10],'qq'=>htmlspecialchars($r[11]),'getcardtime'=>strtotime($r[12]),'expensetotal'=>$r[13],'balance'=>$r[14],'wecha_id'=>$r[15]);
						$info2 = array('number'=>$r[1],'cardid'=>(int)$_POST['id'],'token'=>$this->token,'wecha_id'=>$r[15]);
						
						$where = array('wecha_id'=>$r[15],'token'=>$this->token);
						
						$db_exist = $db->where($where)->field('id')->find();
						$create_db_exist = $create_db->where($where)->field('id')->find();// or ('number != '.$r[1])
						
						$number_exist = $create_db->where("cardid = $cardid AND number = '".$r[1]."' AND token = '".$this->token."'")->field('id,wecha_id')->find();
						
						if(!$db_exist){
							$db->add($info);	
						}
						
						if(!$create_db_exist && !$number_exist){
							$create_db->add($info2);
							
						}elseif(!$create_db_exist && $number_exist && $number_exist['wecha_id'] == ''){
						
							$create_db->where("cardid = $cardid AND token = '$token' AND number = '".$r[1]."'")->save($info2);
						}

					}
					$i++;
				}
			}
			$this->success('操作完成');

		}

	}
	public function uploadReturn(){
		$handled=0;
		$form_api_secret = $this->form_api_secret; /// 表单 API 功能的密匙（请访问又拍云管理后台的空间管理页面获取）
		if(!isset($_GET['code']) || !isset($_GET['message']) || !isset($_GET['url']) || !isset($_GET['time'])){
			header('HTTP/1.1 403 Not Access');
			die('非法操作哦');
		}
		if(isset($_GET['sign'])){ /// 正常签名
			if(md5("{$_GET['code']}&{$_GET['message']}&{$_GET['url']}&{$_GET['time']}&".$form_api_secret) == $_GET['sign']){
				/// 合法的上传回调
				if($_GET['code'] == '200'){
					/// 上传成功
					$handled=1;
					//
					$fileUrl='http://'.$this->upyun_domain.$_GET['url'];

					$fileinfo=get_headers($fileUrl,1);
					$fileinfo['Content-Type']=$fileinfo['Content-Type']?$fileinfo['Content-Type']:'';
					M('Users')->where(array('id'=>$this->user['id']))->setInc('attachmentsize',intval($fileinfo['Content-Length']));
					M('Files')->add(array('token'=>$this->token,'size'=>intval($fileinfo['Content-Length']),'time'=>time(),'type'=>$fileinfo['Content-Type'],'url'=>$fileUrl));
					if($this->_get('imgfrom') == 'photo_list'){
						echo $fileUrl;exit;
					}
				}else{
					$handled=1;
					/// 上传失败
				}
			}else{
				/// 回调的签名错误
				header('HTTP/1.1 403 Not Access');
				die('回调的签名错误,请检查总后台上传配置信息');
			}
		}elseif(isset($_GET['non-sign'])){ /// 缺少操作员密码的签名
			if(md5("{$_GET['code']}&{$_GET['message']}&{$_GET['url']}&{$_GET['time']}&") == $_GET['non-sign']){
				/// 合法的上传回调
				$handled=1;
				/// 上传失败
			}else{
				/// 回调的签名错误
				header('HTTP/1.1 403 Not Access');
				die('回调的签名错误,请检查总后台上传配置信息。。。');
			}
		}else{
			header('HTTP/1.1 403 Not Access');
			die('回调的签名错误,请检查总后台上传配置信息...');
		}
		$this->assign('result',1);
		if ($handled){
			$status=$this->_status($_GET['code'],$_GET['message']);
			$this->assign('error',$status['error']);
			$this->assign('message',$status['msg']);
			$this->display('upload');
		}
	}
	public function editorUploadReturn(){
		$handled=0;
		$form_api_secret = $this->form_api_secret; /// 表单 API 功能的密匙（请访问又拍云管理后台的空间管理页面获取）
		if(!isset($_GET['code']) || !isset($_GET['message']) || !isset($_GET['url']) || !isset($_GET['time'])){
			header('HTTP/1.1 403 Not Access');
			die();
		}
		if(isset($_GET['sign'])){ /// 正常签名
			if(md5("{$_GET['code']}&{$_GET['message']}&{$_GET['url']}&{$_GET['time']}&".$form_api_secret) == $_GET['sign']){
				/// 合法的上传回调
				if($_GET['code'] == '200'){
					$fileUrl=$status['msg'];
					$fileinfo=get_headers($fileUrl,1);
					M('Users')->where(array('id'=>$this->user['id']))->setInc('attachmentsize',intval($fileinfo['Content-Length']));
					M('Files')->add(array('token'=>$this->token,'size'=>intval($fileinfo['Content-Length']),'time'=>time(),'type'=>$fileinfo['Content-Type'],'url'=>$fileUrl));
					/// 上传成功
					$handled=1;
				}else{
					$handled=1;
					/// 上传失败
				}
			}else{
				/// 回调的签名错误
				header('HTTP/1.1 403 Not Access');
				die();
			}
		}elseif(isset($_GET['non-sign'])){ /// 缺少操作员密码的签名
			if(md5("{$_GET['code']}&{$_GET['message']}&{$_GET['url']}&{$_GET['time']}&") == $_GET['non-sign']){
				/// 合法的上传回调
				$handled=1;
				/// 上传失败
			}else{
				/// 回调的签名错误
				header('HTTP/1.1 403 Not Access');
				die();
			}
		}else{
			header('HTTP/1.1 403 Not Access');
			die();
		}
		//$this->assign('result',1);
		if ($handled){
			$status=$this->_status($_GET['code'],$_GET['message']);
			echo json_encode(array('error' => $status['error'], 'message' => $status['msg']));
		}else {
			echo json_encode(array('error' => 1, 'message' =>'未知错误'));
		}
	}
	function _status($code,$message){
		switch ($_GET['code']){
			default:
				$error=1;
				break;
			case 200:
				$error=0;
				break;
		}
		switch ($_GET['message']){
			default:
				return array('error'=>1,'msg'=>$message);
				break;
			case '':
				break;'';
			case '':
				break;'';
			case '':
				break;'';
			case '':
				break;'';
			case '':
				break;'';
			case '':
				break;'';
			case '':
				break;'';
			case '':
				break;'';
			case '':
				break;'';
			case '':
				break;'';
			case '':
				break;'';
			case '':
				break;'';
			case '':
				break;'';
			case '':
				break;'';
			case 200:
				return array('error'=>0,'msg'=>'文件上传成功');
				break;
		}
		return array('error'=>0,'msg'=>$message);
	}
	function deleteFile(){
		$upyun = new UpYun($this->bucket, 'user', 'pwd');
		$upyun->deleteFile($filePath);
	}
	function editorUpload(){
		echo $json->encode(array('error' => 1, 'message' => $msg));
	}
	function kindedtiropic(){
		if ($this->upload_type=='upyun'){
			$upyun_pic = new UpYun(UNYUN_BUCKET, UNYUN_USERNAME, UNYUN_PASSWORD, $api_access[0]);
			try{
				$api_access = array(UpYun::ED_AUTO, UpYun::ED_TELECOM, UpYun::ED_CNC, UpYun::ED_CTT);
				//$php_path = dirname(__FILE__) . '/';
				//$php_url = dirname($_SERVER['PHP_SELF']) . '/';

				//文件保存目录路径
				//$save_path = $php_path . '../attached/';


				//文件保存目录URL
				//$save_url = $php_url . '../attached/';

				//$domain_file = $_config['file']['domain'];
				$domain_pic = 'http://'.UNYUN_DOMAIN;
				//$dir_file = $_config['file']['dir'];
				$dir_pic = '/'.$this->token.'/';
				$save_path = '';
				$save_url = '';

				//定义允许上传的文件扩展名
				$ext_arr = array(
				'image' => explode(',',C('up_exts')),
				'flash' => array('swf', 'flv'),
				'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
				'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
				);
				//最大文件大小
				$max_size = intval(C('up_size'))*1000;

				//$save_path = realpath($save_path) . '/';

				//PHP上传失败
				if (!empty($_FILES['imgFile']['error'])) {
					switch($_FILES['imgFile']['error']){
						case '1':
							$error = '超过php.ini允许的大小。';
							break;
						case '2':
							$error = '超过表单允许的大小。';
							break;
						case '3':
							$error = '图片只有部分被上传。';
							break;
						case '4':
							$error = '请选择图片。';
							break;
						case '6':
							$error = '找不到临时目录。';
							break;
						case '7':
							$error = '写文件到硬盘出错。';
							break;
						case '8':
							$error = 'File upload stopped by extension。';
							break;
						case '999':
						default:
							$error = '未知错误。';
					}
					$this->alert($error);
				}

				//有上传文件时
				if (empty($_FILES) === false) {
					//原文件名
					$file_name = $_FILES['imgFile']['name'];
					//服务器上临时文件名
					$tmp_name = $_FILES['imgFile']['tmp_name'];
					//文件大小
					$file_size = $_FILES['imgFile']['size'];
					//检查文件名
					if (!$file_name) {
						$this->alert("请选择文件。");
					}
					//检查目录
					//if (@is_dir($save_path) === false) {
					// alert("上传目录不存在。");
					//}
					//检查目录写权限
					//if (@is_writable($save_path) === false) {
					// alert("上传目录没有写权限。");
					//}
					//检查是否已上传
					if (@is_uploaded_file($tmp_name) === false) {
						$this->alert("上传失败。");
					}
					//检查文件大小
					if ($file_size > $max_size) {
						$this->alert("上传文件大小超过限制。");
					}
					//检查目录名
					$dir_name = empty($_GET['dir']) ? 'image' : trim($_GET['dir']);
					if (empty($ext_arr[$dir_name])) {
						$this->alert("目录名不正确。");
					}
					//获得文件扩展名
					$temp_arr = explode(".", $file_name);
					$file_ext = array_pop($temp_arr);
					$file_ext = trim($file_ext);
					$file_ext = strtolower($file_ext);
					//检查扩展名
					if (in_array($file_ext, $ext_arr[$dir_name]) === false) {
						$this->alert("上传文件扩展名是不允许的扩展名。\n只允许" . implode(",", $ext_arr[$dir_name]) . "格式。");
					}
					//创建文件夹
					if ($dir_name !== '') {
						$save_path .= $dir_name . "/";
						$save_url .= $dir_name . "/";

						//if (!file_exists($save_path)) {
						// mkdir($save_path);
						//}
					}
					$ymd = date("Ymd");
					$save_path .= $ymd . "/";
					$save_url .= $ymd . "/";

					//if (!file_exists($save_path)) {
					// mkdir($save_path);
					//}

					//新文件名
					$new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
					//移动文件
					$file_path = $save_path . $new_file_name;
					$fh = fopen($tmp_name, 'r');
					$upyun_pic->writeFile($dir_pic . $file_path, $fh, True);
					$save_url = $domain_pic . $dir_pic . $save_url;
					fclose($fh);

					//if (move_uploaded_file($tmp_name, $file_path) === false) {
					// alert("上传文件失败。");
					//}
					//@chmod($file_path, 0644);
					$file_url = "./".$save_url . $new_file_name;

					header('Content-type: text/html; charset=UTF-8');
					echo json_encode(array('error' => 0, 'url' => $file_url));
					exit;
				}else{
					$this->alert('您就先别试这里了，我们服务器禁止写入文件了，O(∩_∩)O');
				}
			}catch(Exception $e) {
				$this->alert($e->getCode().':'.$e->getMessage());
			}
		}elseif ($this->upload_type=='local'){
			$return=$this->localUpload();
			if ($return['error']){
				$this->alert($return['msg']);
			}else {
				header('Content-type: text/html; charset=UTF-8');
				echo json_encode(array('error' => 0, 'url' =>$return['msg']));
				exit;
			}
		}
	}
	function localUpload($filetypes=''){
		$upload = new UploadFile();
		$upload->maxSize  = intval(C('up_size'))*1024 ;
		if (!$filetypes){
			$upload->allowExts  = explode(',',C('up_exts'));
		}else {
			$upload->allowExts  = $filetypes;
		}
		$upload->autoSub=1;
		if (isset($_POST['width'])&&intval($_POST['width'])){
			$upload->thumb = true;
			$upload->thumbMaxWidth=$_POST['width'];
			$upload->thumbMaxHeight=$_POST['height'];
			//$upload->thumbPrefix='';
			$thumb=1;
		}
		$upload->thumbRemoveOrigin=true;
		//
		$firstLetter=substr($this->token,0,1);
		$upload->savePath =  './uploads/'.$firstLetter.'/'.$this->token.'/';// 设置附件上传目录
		//
		if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads')||!is_dir($_SERVER['DOCUMENT_ROOT'].'/uploads')){
			mkdir($_SERVER['DOCUMENT_ROOT'].'/uploads',0777);
		}
		$firstLetterDir=$_SERVER['DOCUMENT_ROOT'].'/uploads/'.$firstLetter;
		if (!file_exists($firstLetterDir)||!is_dir($firstLetterDir)){
			mkdir($firstLetterDir,0777);
		}
		if (!file_exists($firstLetterDir.'/'.$this->token)||!is_dir($firstLetterDir.'/'.$this->token)){
			mkdir($firstLetterDir.'/'.$this->token,0777);
		}
		//
		$upload->hashLevel=4;
		if(!$upload->upload()) {// 上传错误提示错误信息
			$error=1;
			$msg=$upload->getErrorMsg();
		}else{// 上传成功 获取上传文件信息
			$error=0;
			$info =  $upload->getUploadFileInfo();
			$this->siteUrl=$this->siteUrl?$this->siteUrl:C('site_url');
			if ($thumb==1){
				$paths=explode('/',$info[0]['savename']);
				$fileName=$paths[count($paths)-1];
				$msg=$this->siteUrl.substr($upload->savePath,1).str_replace($fileName,'thumb_'.$fileName,$info[0]['savename']);
			}else {
				$msg=$this->siteUrl.substr($upload->savePath,1).$info[0]['savename'];
			}
			M('Users')->where(array('id'=>$this->user['id']))->setInc('attachmentsize',intval($info[0]['size']));
			M('Files')->add(array('token'=>$this->token,'size'=>intval($info[0]['size']),'time'=>time(),'type'=>$info[0]['extension'],'url'=>$msg));
		}
		
		if($this->_get('imgfrom') == 'photo_list'){
			echo $msg;exit;
		}else{
			return array('error'=>$error,'msg'=>$msg);
		}
		
	}
	function alert($msg) {
		header('Content-type: text/html; charset=UTF-8');
		//$json = new Services_JSON();
		echo json_encode(array('error' => 1, 'message' => $msg));
		exit;
	}
}



class UpYunException extends Exception {/*{{{*/
    public function __construct($message, $code, Exception $previous = null) {
        parent::__construct($message, $code);   // For PHP 5.2.x
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}/*}}}*/

class UpYunAuthorizationException extends UpYunException {/*{{{*/
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, 401, $previous);
    }
}/*}}}*/

class UpYunForbiddenException extends UpYunException {/*{{{*/
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, 403, $previous);
    }
}/*}}}*/

class UpYunNotFoundException extends UpYunException {/*{{{*/
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, 404, $previous);
    }
}/*}}}*/

class UpYunNotAcceptableException extends UpYunException {/*{{{*/
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, 406, $previous);
    }
}/*}}}*/

class UpYunServiceUnavailable extends UpYunException {/*{{{*/
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, 503, $previous);
    }
}/*}}}*/

class UpYun {
    const VERSION            = '2.0';

/*{{{*/
    const ED_AUTO            = 'v0.api.upyun.com';
    const ED_TELECOM         = 'v1.api.upyun.com';
    const ED_CNC             = 'v2.api.upyun.com';
    const ED_CTT             = 'v3.api.upyun.com';

    const CONTENT_TYPE       = 'Content-Type';
    const CONTENT_MD5        = 'Content-MD5';
    const CONTENT_SECRET     = 'Content-Secret';

    // 缩略图
    const X_GMKERL_THUMBNAIL = 'x-gmkerl-thumbnail';
    const X_GMKERL_TYPE      = 'x-gmkerl-type';
    const X_GMKERL_VALUE     = 'x-gmkerl-value';
    const X_GMKERL_QUALITY   = 'x­gmkerl-quality';
    const X_GMKERL_UNSHARP   = 'x­gmkerl-unsharp';
/*}}}*/

    private $_bucket_name;
    private $_username;
    private $_password;
    private $_timeout = 30;

    /**
     * @deprecated
     */
    private $_content_md5 = NULL;

    /**
     * @deprecated
     */
    private $_file_secret = NULL;

    /**
     * @deprecated
     */
    private $_file_infos= NULL;

    protected $endpoint;

	/**
	* 初始化 UpYun 存储接口
	* @param $bucketname 空间名称
	* @param $username 操作员名称
	* @param $password 密码
    *
	* @return object
	*/
	public function __construct($bucketname, $username, $password, $endpoint = NULL, $timeout = 30) {/*{{{*/
		$this->_bucketname = $bucketname;
		$this->_username = $username;
		$this->_password = md5($password);
        $this->_timeout = $timeout;

        $this->endpoint = is_null($endpoint) ? self::ED_AUTO : $endpoint;
	}/*}}}*/

    /**
     * 获取当前SDK版本号
     */
    public function version() {
        return self::VERSION;
    }

    /** 
     * 创建目录
     * @param $path 路径
     * @param $auto_mkdir 是否自动创建父级目录，最多10层次
     *
     * @return void
     */
    public function makeDir($path, $auto_mkdir = false) {/*{{{*/
        $headers = array('Folder' => 'true');
        if ($auto_mkdir) $headers['Mkdir'] = 'true';
        return $this->_do_request('PUT', $path, $headers);
    }/*}}}*/

    /**
     * 删除目录和文件
     * @param string $path 路径
     *
     * @return boolean
     */
    public function delete($path) {/*{{{*/
        return $this->_do_request('DELETE', $path);
    }/*}}}*/


    /**
     * 上传文件
     * @param string $path 存储路径
     * @param mixed $file 需要上传的文件，可以是文件流或者文件内容
     * @param boolean $auto_mkdir 自动创建目录
     * @param array $opts 可选参数
     */
    public function writeFile($path, $file, $auto_mkdir = False, $opts = NULL) {/*{{{*/
        if (is_null($opts)) $opts = array();
        if (!is_null($this->_content_md5) || !is_null($this->_file_secret)) {
            //if (!is_null($this->_content_md5)) array_push($opts, self::CONTENT_MD5 . ": {$this->_content_md5}");
            //if (!is_null($this->_file_secret)) array_push($opts, self::CONTENT_SECRET . ": {$this->_file_secret}");
            if (!is_null($this->_content_md5)) $opts[self::CONTENT_MD5] = $this->_content_md5;
            if (!is_null($this->_file_secret)) $opts[self::CONTENT_SECRET] = $this->_file_secret;
        }

        // 如果设置了缩略版本或者缩略图类型，则添加默认压缩质量和锐化参数
        //if (isset($opts[self::X_GMKERL_THUMBNAIL]) || isset($opts[self::X_GMKERL_TYPE])) {
        //    if (!isset($opts[self::X_GMKERL_QUALITY])) $opts[self::X_GMKERL_QUALITY] = 95;
        //    if (!isset($opts[self::X_GMKERL_UNSHARP])) $opts[self::X_GMKERL_UNSHARP] = 'true';
        //}

        if ($auto_mkdir === True) $opts['Mkdir'] = 'true';

        $this->_file_infos = $this->_do_request('PUT', $path, $opts, $file);

        return $this->_file_infos;
    }/*}}}*/

    /**
     * 下载文件
     * @param string $path 文件路径
     * @param mixed $file_handle
     *
     * @return mixed
     */
    public function readFile($path, $file_handle = NULL) {/*{{{*/
        return $this->_do_request('GET', $path, NULL, NULL, $file_handle);
    }/*}}}*/

    /**
     * 获取目录文件列表
     *
     * @param string $path 查询路径
     *
     * @return mixed
     */
    public function getList($path = '/') {/*{{{*/
        $rsp = $this->_do_request('GET', $path);

        $list = array();
        if ($rsp) {
            $rsp = explode("\n", $rsp);
            foreach($rsp as $item) {
                @list($name, $type, $size, $time) = explode("\t", trim($item));
                if (!empty($time)) {
                    $type = $type == 'N' ? 'file' : 'folder';
                }

                $item = array(
                    'name' => $name,
                    'type' => $type,
                    'size' => intval($size),
                    'time' => intval($time),
                );
                array_push($list, $item);
            }
        }

        return $list;
    }/*}}}*/

    /**
     * @deprecated
     * @param string $path 目录路径
     * @return mixed
     */
    public function getFolderUsage($path = '/') {/*{{{*/
        $rsp = $this->_do_request('GET', '/?usage');
        return floatval($rsp);
    }/*}}}*/

    /**
     * 获取文件、目录信息
     *
     * @param string $path 路径
     *
     * @return mixed
     */
    public function getFileInfo($path) {/*{{{*/
        $rsp = $this->_do_request('HEAD', $path);

        return $rsp;
    }/*}}}*/

	/**
	* 连接签名方法
	* @param $method 请求方式 {GET, POST, PUT, DELETE}
	* return 签名字符串
	*/
	private function sign($method, $uri, $date, $length){/*{{{*/
        //$uri = urlencode($uri);
		$sign = "{$method}&{$uri}&{$date}&{$length}&{$this->_password}";
		return 'UpYun '.$this->_username.':'.md5($sign);
	}/*}}}*/

    /**
     * HTTP REQUEST 封装
     * @param string $method HTTP REQUEST方法，包括PUT、POST、GET、OPTIONS、DELETE
     * @param string $path 除Bucketname之外的请求路径，包括get参数
     * @param array $headers 请求需要的特殊HTTP HEADERS
     * @param array $body 需要POST发送的数据
     *
     * @return mixed
     */
    protected function _do_request($method, $path, $headers = NULL, $body= NULL, $file_handle= NULL) {/*{{{*/
        $uri = "/{$this->_bucketname}{$path}";
        $ch = curl_init("http://{$this->endpoint}{$uri}");

        $_headers = array('Expect:');
        if (!is_null($headers) && is_array($headers)){
            foreach($headers as $k => $v) {
                array_push($_headers, "{$k}: {$v}");
            }
        }

        $length = 0;
		$date = gmdate('D, d M Y H:i:s \G\M\T');

        if (!is_null($body)) {
            if(is_resource($body)){
                fseek($body, 0, SEEK_END);
                $length = ftell($body);
                fseek($body, 0);

                array_push($_headers, "Content-Length: {$length}");
                curl_setopt($ch, CURLOPT_INFILE, $body);
                curl_setopt($ch, CURLOPT_INFILESIZE, $length);
            }
            else {
                $length = @strlen($body);
                array_push($_headers, "Content-Length: {$length}");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
            }
        }
        else {
            array_push($_headers, "Content-Length: {$length}");
        }

        array_push($_headers, "Authorization: {$this->sign($method, $uri, $date, $length)}");
        array_push($_headers, "Date: {$date}");

        curl_setopt($ch, CURLOPT_HTTPHEADER, $_headers);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->_timeout);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        if ($method == 'PUT' || $method == 'POST') {
			curl_setopt($ch, CURLOPT_POST, 1);
        }
        else {
			curl_setopt($ch, CURLOPT_POST, 0);
        }

        if ($method == 'GET' && is_resource($file_handle)) {
            curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_FILE, $file_handle);
        }

        if ($method == 'HEAD') {
            curl_setopt($ch, CURLOPT_NOBODY, true);
        }

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($http_code == 0) throw new UpYunException('Connection Failed', $http_code);

        curl_close($ch);

        $header_string = '';
        $body = '';

        if ($method == 'GET' && is_resource($file_handle)) {
            $header_string = '';
            $body = $response;
        }
        else {
            list($header_string, $body) = explode("\r\n\r\n", $response, 2);
        }

        //var_dump($http_code);
        if ($http_code == 200) {
            if ($method == 'GET' && is_null($file_handle)) {
                return $body;
            }
            else {
                $data = $this->_getHeadersData($header_string);
                return count($data) > 0 ? $data : true;
            }
            //elseif ($method == 'HEAD') {
            //    //return $this->_get_headers_data(substr($response, 0 , $header_size));
            //    return $this->_getHeadersData($header_string);
            //}
            //return True;
        }
        else {
            $message = $this->_getErrorMessage($header_string);
            if (is_null($message) && $method == 'GET' && is_resource($file_handle)) {
                $message = 'File Not Found';
            }
            switch($http_code) {
                case 401:
                    throw new UpYunAuthorizationException($message);
                    break;
                case 403:
                    throw new UpYunForbiddenException($message);
                    break;
                case 404:
                    throw new UpYunNotFoundException($message);
                    break;
                case 406:
                    throw new UpYunNotAcceptableException($message);
                    break;
                case 503:
                    throw new UpYunServiceUnavailable($message);
                    break;
                default:
                    throw new UpYunException($message, $http_code);
            }
        }
    }/*}}}*/

    /**
     * 处理HTTP HEADERS中返回的自定义数据
     *
     * @param string $text header字符串
     *
     * @return array
     */
    private function _getHeadersData($text) {/*{{{*/
        $headers = explode("\r\n", $text);
        $items = array();
        foreach($headers as $header) {
            $header = trim($header);
			if(strpos($header, 'x-upyun') !== False){
				list($k, $v) = explode(':', $header);
                $items[trim($k)] = in_array(substr($k,8,5), array('width','heigh','frame')) ? intval($v) : trim($v);
			}
        }
        return $items;
    }/*}}}*/

    /**
     * 获取返回的错误信息
     *
     * @param string $header_string
     *
     * @return mixed
     */
    private function _getErrorMessage($header_string) {
        list($status, $stash) = explode("\r\n", $header_string, 2);
        list($v, $code, $message) = explode(" ", $status, 3);
        return $message;
    }

    /**
     * 删除目录
     * @deprecated 
     * @param $path 路径
     *
     * @return void
     */
    public function rmDir($path) {/*{{{*/
        $this->_do_request('DELETE', $path);
    }/*}}}*/

    /**
     * 删除文件
     *
     * @deprecated 
     * @param string $path 要删除的文件路径
     *
     * @return boolean
     */
    public function deleteFile($path) {/*{{{*/
        $rsp = $this->_do_request('DELETE', $path);
    }/*}}}*/

    /**
     * 获取目录文件列表
     * @deprecated
     * 
     * @param string $path 要获取列表的目录
     * 
     * @return array
     */
    public function readDir($path) {/*{{{*/
        return $this->getList($path);
    }/*}}}*/

    /**
     * 获取空间使用情况
     *
     * @deprecated 推荐直接使用 getFolderUsage('/')来获取
     * @return mixed
     */
    public function getBucketUsage() {/*{{{*/
        return $this->getFolderUsage('/');
    }/*}}}*/

	/**
	* 获取文件信息
    *
    * #deprecated
	* @param $file 文件路径（包含文件名）
	* return array('type'=> file | folder, 'size'=> file size, 'date'=> unix time) 或 null
	*/
	//public function getFileInfo($file){/*{{{*/
    //    $result = $this->head($file);
	//	if(is_null($r))return null;
	//	return array('type'=> $this->tmp_infos['x-upyun-file-type'], 'size'=> @intval($this->tmp_infos['x-upyun-file-size']), 'date'=> @intval($this->tmp_infos['x-upyun-file-date']));
	//}/*}}}*/

	/**
	* 切换 API 接口的域名
    *
    * @deprecated
	* @param $domain {默然 v0.api.upyun.com 自动识别, v1.api.upyun.com 电信, v2.api.upyun.com 联通, v3.api.upyun.com 移动}
	* return null;
	*/
	public function setApiDomain($domain){/*{{{*/
		$this->endpoint = $domain;
	}/*}}}*/

	/**
	* 设置待上传文件的 Content-MD5 值（如又拍云服务端收到的文件MD5值与用户设置的不一致，将回报 406 Not Acceptable 错误）
    *
    * @deprecated
	* @param $str （文件 MD5 校验码）
	* return null;
	*/
	public function setContentMD5($str){/*{{{*/
		$this->_content_md5 = $str;
	}/*}}}*/

	/**
	* 设置待上传文件的 访问密钥（注意：仅支持图片空！，设置密钥后，无法根据原文件URL直接访问，需带 URL 后面加上 （缩略图间隔标志符+密钥） 进行访问）
	* 如缩略图间隔标志符为 ! ，密钥为 bac，上传文件路径为 /folder/test.jpg ，那么该图片的对外访问地址为： http://空间域名/folder/test.jpg!bac
    *
    * @deprecated
	* @param $str （文件 MD5 校验码）
	* return null;
	*/
	public function setFileSecret($str){/*{{{*/
		$this->_file_secret = $str;
	}/*}}}*/

	/**
     * @deprecated
	* 获取上传文件后的信息（仅图片空间有返回数据）
	* @param $key 信息字段名（x-upyun-width、x-upyun-height、x-upyun-frames、x-upyun-file-type）
	* return value or NULL
	*/
	public function getWritedFileInfo($key){/*{{{*/
		if(!isset($this->_file_infos))return NULL;
		return $this->_file_infos[$key];
	}/*}}}*/
}
?>