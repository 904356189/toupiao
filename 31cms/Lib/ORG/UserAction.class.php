<?php
class UserAction extends BaseAction
{
    public $userGroup;
    public $token;
    public $user;
    public $userFunctions;
    public $wxuser;
    protected function _initialize()
    {
        parent::_initialize();
        $userinfo = M('User_group')->where(array('id' => session('gid')))->find();
        $this->assign('userinfo', $userinfo);
        $this->userGroup = $userinfo;
        $users = M('Users')->where(array('id' => $_SESSION['uid']))->find();
        $this->user = $users;
        $this->assign('thisUser', $users);
        $this->assign('viptime', $users['viptime']);
        if (session('uid')) {
            if ($users['viptime'] < time()) {
                session(null);
                session_destroy();
                unset($_SESSION);
                $this->error('您的帐号已经到期，请充值后再使用');
            }
        }
        $wecha = M('Wxuser')->where(array('token' => session('token'), 'uid' => session('uid')))->find();
        $this->wxuser = $wecha;
        $this->assign('wxuser', $wecha);
        $this->assign('wecha', $wecha);
        $this->token = session('token');
        $this->assign('token', $this->token);
        $token_open = M('token_open')->field('queryname')->where(array('token' => $this->token))->find();
        $this->userFunctions = explode(',', $token_open['queryname']);
        if (MODULE_NAME != 'Upyun') {
            if (session('uid') == false) {
                $this->redirect('Home/Index/login');
            }
        } else {
            if (isset($_SESSION['administrator']) || isset($_SESSION['agentid']) || isset($_SESSION['uid']) || isset($_SESSION['wapupload'])) {
            } else {
                $this->redirect('Home/Index/login');
            }
        }
        if (session('companyLogin') == 1 && !in_array(MODULE_NAME, array('Attachment', 'Repast', 'Upyun', 'Hotels'))) {
            $this->redirect(U('User/Repast/index', array('cid' => session('companyid'))));
        }
        define('UNYUN_BUCKET', C('up_bucket'));
        define('UNYUN_USERNAME', C('up_username'));
        define('UNYUN_PASSWORD', C('up_password'));
        define('UNYUN_FORM_API_SECRET', C('up_form_api_secret'));
        define('UNYUN_DOMAIN', C('up_domainname'));
        $this->assign('upyun_domain', 'http://' . UNYUN_DOMAIN);
        $this->assign('upyun_bucket', UNYUN_BUCKET);
        $token = $this->_session('token');
        if (!$token) {
            if (isset($_GET['token'])) {
                $token = $this->_get('token');
            } else {
                $token = 'admin';
            }
        }
        $options = array();
        $now = time();
        $options['bucket'] = UNYUN_BUCKET;
        $options['expiration'] = $now + 600;
        $options['save-key'] = '/' . $token . '/{year}/{mon}/{day}/' . $now . '_{random}{.suffix}';
        $options['allow-file-type'] = C('up_exts');
        $options['content-length-range'] = '0,' . intval(C('up_size')) * 1000;
        if (intval($_GET['width'])) {
            $options['x-gmkerl-type'] = 'fix_width';
            $options['fix_width '] = $_GET['width'];
        }
        $policy = base64_encode(json_encode($options));
        $sign = md5($policy . '&' . UNYUN_FORM_API_SECRET);
        $this->assign('editor_upyun_sign', $sign);
        $this->assign('editor_upyun_policy', $policy);
    }
    public function canUseFunction($funname)
    {
        $token_open = M('token_open')->field('queryname')->where(array('token' => $this->token))->find();
        if (C('agent_version') && $this->agentid) {
            $function = M('Agent_function')->where(array('funname' => $funname, 'agentid' => $this->agentid))->find();
        } else {
            $function = M('Function')->where(array('funname' => $funname))->find();
        }
        if (intval($this->user['gid']) < intval($function['gid']) || strpos($token_open['queryname'], $funname) === false) {
            $this->error('您还没有开启该模块的使用权,请到功能模块中添加', U('Function/index', array('token' => $this->token)));
        }
    }
}