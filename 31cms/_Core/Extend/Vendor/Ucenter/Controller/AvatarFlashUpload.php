<?php

!defined('IN_INTER') && exit('Fobbiden!');
/**
 * ================================================================================
 * 该文件有代码包含了康盛创想（北京）科技有限公司Discuz!/UCenter的代码。根据相关协议的规定：
 *     “禁止在 Discuz! / UCenter 的整体或任何部分基础上以发展任何派生版本、修改版本或第三方版本用于重新分发。”
 * 故在此声明如下：
 *     本程序仅为作者学习和研究软件内含的设计思想和原理而作，不以盈利为目的，同时也无意侵犯第三方软件作者/公司的权益。
 *     如若侵犯权益，请发邮件告知。在本人接获通知的48小时之内将会把自己所发布的代码进行撤回操作。
 *     同时提醒第三方下载者和使用者使用这些代码时考虑本程序的法律风险，第三方下载者和使用者的一切行为与本人无关。
 * 
 * Discuz!/UCenter头文件注释：
 * (C)2001-2009 Comsenz Inc.
 * This is NOT a freeware, use is subject to license terms
 * ================================================================================
 * 
 * flash头像上传类，剥离自UCenter
 * 本文件的参考过以下程序，在此一并致谢！
 *     - Comsenz UCenter {@link http://www.comsenz.com}
 *     - Comsenz Discuz!NT {@link http://nt.discuz.net}
 *
 * @author Horse Luke<horseluke@126.com>
 * @license Mixed License. See the description above. 
 * @version $Id: AvatarFlashUpload.php 156 2010-07-22 01:25:53Z horseluke@126.com $
 */

class Controller_AvatarFlashUpload extends Controller_Base{

    /**
     * 构造函数。(ok)
     * 
     */
    public function __construct(){
        parent::__construct();
    }

    
    /**
     * 获取显示上传flash的代码(ok)
     * 来源：Ucenter的uc_avatar函数
     * 依赖性：
     *     逻辑代码上为依赖本类和common类；实际操作中还须配合如下文件/组件：
     *         - Ucenter的头像上传flash文件（swf文件）
     */
    public function showuploadAction() {
        $uid = abs((int)common::getgpc('uid', 'G'));
        if( $uid === null || $uid == 0 ){
            return -1;
        }
        $returnhtml = common::getgpc('returnhtml', 'G');
        if( $returnhtml === null  ){
            $returnhtml =  1;
        }
        
        $uc_input = urlencode(common::authcode('uid='.$uid.
                                               '&agent='.md5($_SERVER['HTTP_USER_AGENT']).
                                               "&time=".time(), 
                                                   'ENCODE', $this->config->authkey)
                             );
        
        $uc_avatarflash = '/Public/images/camera.swf?nt=1&inajax=1&input='.$uc_input.'&agent='.md5($_SERVER['HTTP_USER_AGENT']).'&ucapi='.urlencode($this->config->uc_api. substr( $_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/') ) ).'&uploadSize='.$this->config->uploadsize;
        if( $returnhtml == 1 ) {
            $result = '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="450" height="253" id="mycamera" align="middle">
			<param name="allowScriptAccess" value="always" />
			<param name="scale" value="exactfit" />
			<param name="wmode" value="transparent" />
			<param name="quality" value="high" />
			<param name="bgcolor" value="#ffffff" />
			<param name="movie" value="'.$uc_avatarflash.'" />
			<param name="menu" value="false" />
			<embed src="'.$uc_avatarflash.'" quality="high" bgcolor="#ffffff" width="450" height="253" name="mycamera" align="middle" allowScriptAccess="always" allowFullScreen="false" scale="exactfit"  wmode="transparent" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
		</object>';
            return $result;
        } else {
            return array(
            'width', '450',
            'height', '253',
            'scale', 'exactfit',
            'src', $uc_avatarflash,
            'id', 'mycamera',
            'name', 'mycamera',
            'quality','high',
            'bgcolor','#ffffff',
            'wmode','transparent',
            'menu', 'false',
            'swLiveConnect', 'true',
            'allowScriptAccess', 'always'
            );
        }
    }

    /**
     * 头像上传第一步，上传原文件到临时文件夹（ok）
     *
     * @return string
     */
    function uploadavatarAction() {
        header("Expires: 0");
        header("Cache-Control: private, post-check=0, pre-check=0, max-age=0", FALSE);
        header("Pragma: no-cache");
        //header("Content-type: application/xml; charset=utf-8");
        $this->init_input(common::getgpc('agent', 'G'));
        $uid = $this->input('uid');
        if(empty($uid)) {
            return -1;
        }
        if(empty($_FILES['Filedata'])) {
            return -3;
        }
        
        $imgext = strtolower('.'. common::fileext($_FILES['Filedata']['name']));
        if(!in_array($imgext, $this->config->imgtype)) {
            unlink($_FILES['Filedata']['tmp_name']);
            return -2;
        }
        
        if( $_FILES['Filedata']['size'] > ($this->config->uploadsize * 1024) ){
            unlink($_FILES['Filedata']['tmp_name']);
            return 'Inage is TOO BIG, PLEASE UPLOAD NO MORE THAN '. $this->config->uploadsize .'KB';
        }
        
        list($width, $height, $type, $attr) = getimagesize($_FILES['Filedata']['tmp_name']);
        
        $filetype = $this->config->imgtype[$type];
        $tmpavatar = realpath($this->config->tmpdir).'/upload'.$uid.$filetype;
        file_exists($tmpavatar) && unlink($tmpavatar);
        if(is_uploaded_file($_FILES['Filedata']['tmp_name']) && move_uploaded_file($_FILES['Filedata']['tmp_name'], $tmpavatar)) {
            list($width, $height, $type, $attr) = getimagesize($tmpavatar);
            if($width < 10 || $height < 10 || $type == 4) {
                unlink($tmpavatar);
                return -2;
            }
        } else {
            unlink($_FILES['Filedata']['tmp_name']);
            return -4;
        }

        $avatarurl = $this->config->uc_api. '/'. $this->config->tmpdir. '/upload'.$uid.$filetype;

        return $avatarurl;
    }
    
    /**
     * 头像上传第二步，上传到头像存储位置
     *
     * @return string
     */
    function rectavatarAction() {
        header("Expires: 0");
        header("Cache-Control: private, post-check=0, pre-check=0, max-age=0", FALSE);
        header("Pragma: no-cache");
        header("Content-type: application/xml; charset=utf-8");
        $this->init_input(common::getgpc('agent'));
        $uid = abs((int)$this->input('uid'));
        if( empty($uid) || 0 == $uid ) {
            return '<root><message type="error" value="-1" /></root>';
        }

        $avatarpath = $this->get_avatar_path($uid) ;
        $avatarrealdir  = realpath( $this->config->avatardir. DIRECTORY_SEPARATOR . $avatarpath );
        if(!is_dir( $avatarrealdir )) {
            $this->make_avatar_path( $uid, realpath($this->config->avatardir) );
        }
        $avatartype = common::getgpc('avatartype', 'G') == 'real' ? 'real' : 'virtual';
        
        $avatarsize = array( 1 => 'big', 2 => 'middle', 3 => 'small');
        
        $success = 1;
        
        foreach( $avatarsize as $key => $size ){
            $avatarrealpath = realpath( $this->config->avatardir) . DIRECTORY_SEPARATOR. $this->get_avatar_filepath($uid, $size, $avatartype);
            $avatarcontent = $this->_flashdata_decode(common::getgpc('avatar'.$key, 'P'));
            if(!$avatarcontent){
                $success = 0;
                return '<root><message type="error" value="-2" /></root>';
                break;
            }
            $writebyte = file_put_contents( $avatarrealpath, $avatarcontent, LOCK_EX );
            if( $writebyte <= 0 ){
                $success = 0;
                return '<root><message type="error" value="-2" /></root>';
                break;
            }
            $avatarinfo = getimagesize($avatarrealpath);
            if(!$avatarinfo || $avatarinfo[2] == 4 ){
                $this->clear_avatar_file( $uid, $avatartype );
                $success = 0;
                break;
            }
        }

        //原uc bugfix  gif/png上传之后不能删除
        foreach ( $this->config->imgtype as $key => $imgtype ){
            $tmpavatar = realpath($this->config->tmpdir.'/upload'. $uid. $imgtype);
            file_exists($tmpavatar) && unlink($tmpavatar);
        }
        
        if($success) {
            return '<?xml version="1.0" ?><root><face success="1"/></root>';
        } else {
            return '<?xml version="1.0" ?><root><face success="0"/></root>';
        }
    }
    
    /**
     * flash data decode
     * 来源：Ucenter
     * 
     * @param string $s
     * @return unknown
     */
    protected function _flashdata_decode($s) {
        $r = '';
        $l = strlen($s);
        for($i=0; $i<$l; $i=$i+2) {
            $k1 = ord($s[$i]) - 48;
            $k1 -= $k1 > 9 ? 7 : 0;
            $k2 = ord($s[$i+1]) - 48;
            $k2 -= $k2 > 9 ? 7 : 0;
            $r .= chr($k1 << 4 | $k2);
        }
        return $r;
    }
    

    /**
     * 获取指定uid的头像规范存放目录格式
     * 来源：Ucenter base类的get_home方法
     * 
     * @param int $uid uid编号
     * @return string 头像规范存放目录格式
     */
    public function get_avatar_path($uid) {
        $uid = sprintf("%09d", $uid);
        $dir1 = substr($uid, 0, 3);
        $dir2 = substr($uid, 3, 2);
        $dir3 = substr($uid, 5, 2);
        return $dir1.'/'.$dir2.'/'.$dir3;
    }

    /**
     * 在指定目录内，依据uid创建指定的头像规范存放目录
     * 来源：Ucenter base类的set_home方法
     * 
     * @param int $uid uid编号
     * @param string $dir 需要在哪个目录创建？
     */
    public function make_avatar_path($uid, $dir = '.') {
        $uid = sprintf("%09d", $uid);
        $dir1 = substr($uid, 0, 3);
        $dir2 = substr($uid, 3, 2);
        $dir3 = substr($uid, 5, 2);
        !is_dir($dir.'/'.$dir1) && mkdir($dir.'/'.$dir1, 0777);
        !is_dir($dir.'/'.$dir1.'/'.$dir2) && mkdir($dir.'/'.$dir1.'/'.$dir2, 0777);
        !is_dir($dir.'/'.$dir1.'/'.$dir2.'/'.$dir3) && mkdir($dir.'/'.$dir1.'/'.$dir2.'/'.$dir3, 0777);
    }

    /**
     * 获取指定uid的头像文件规范路径
     * 来源：Ucenter base类的get_avatar方法
     *
     * @param int $uid
     * @param string $size 头像尺寸，可选为'big', 'middle', 'small'
     * @param string $type 类型，可选为real或者virtual
     * @return unknown
     */
	public function get_avatar_filepath($uid, $size = 'big', $type = '') {
		$size = in_array($size, array('big', 'middle', 'small')) ? $size : 'big';
		$uid = abs(intval($uid));
		$uid = sprintf("%09d", $uid);
		$dir1 = substr($uid, 0, 3);
		$dir2 = substr($uid, 3, 2);
		$dir3 = substr($uid, 5, 2);
		$typeadd = $type == 'real' ? '_real' : '';
		return  $dir1.'/'.$dir2.'/'.$dir3.'/'.substr($uid, -2).$typeadd."_avatar_$size.jpg";
	}
	
	/**
	 * 一次性清空指定uid用户已经存储的头像
	 *
	 * @param int $uid
	 */
	public function clear_avatar_file( $uid ){
	    $avatarsize = array( 1 => 'big', 2 => 'middle', 3 => 'small');
	    $avatartype = array( 'real', 'virtual' );
	    foreach ( $avatarsize as $size ){
	        foreach ( $avatartype as $type ){
	            $avatarrealpath = realpath( $this->config->avatardir) . DIRECTORY_SEPARATOR. $this->get_avatar_filepath($uid, $size, $type);
	            file_exists($avatarrealpath) && unlink($avatarrealpath);
	        }
	    }
	    return true;
	}

}