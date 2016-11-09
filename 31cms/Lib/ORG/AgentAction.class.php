<?php
class AgentAction extends BaseAction{
    public $agentid;
    public $agent_db;
    public $thisAgent;
    public $agentWhere;
    protected function _initialize(){
        parent :: _initialize();
        $this -> agentid = $_SESSION['agentid'];
        if (!$this -> agentid){
            $this -> error('没有权限', U('Login/index'));
        }
        $this -> agent_db = M('Agent');
        $this -> thisAgent = $this -> agent_db -> where(array('id' => $this -> agentid)) -> find();
        $this -> assign('thisAgent', $this -> thisAgent);
        $this -> assign('menus', $this -> menus());
        $this -> agentWhere = array('agentid' => $this -> thisAgent['id']);
    }
    public function menus(){
        $top = array();
        $homeLink = '?g=Agent&m=Index&a=home';
        $top['basic'] = array('text' => '基本信息', 'link' => $homeLink);
        $top['user'] = array('text' => '用户管理', 'link' => '?g=Agent&m=Users&a=index');
        $top['site'] = array('text' => '站点管理', 'link' => '?g=Agent&m=Site&a=index');
        return $top;
    }
    public function submenu_basic(){
        $home_menus['display'] = array('text' => '基本信息', 'icon' => 'image/display.png', 'folder' => 0, 'link' => '?g=Agent&m=Index&a=home');
        $home_menus['display']['submenu'][] = array('text' => '信息资料', 'link' => '?g=Agent&m=Basic&a=index');
        $home_menus['display']['submenu'][] = array('text' => '消费记录', 'link' => '?g=Agent&m=Basic&a=expenseRecords');
        $home_menus['display']['submenu'][] = array('text' => '充值续费', 'link' => '?g=Agent&m=Basic&a=recharge');
        $home_menus['display']['submenu'][] = array('text' => '修改密码', 'link' => '?g=Agent&m=Basic&a=changePassword');
        return $home_menus;
    }
    public function submenu_user(){
        $home_menus['display'] = array('text' => '用户管理', 'icon' => 'image/content.png', 'folder' => 0, 'link' => '?g=Agent&m=Users&a=index');
        $home_menus['display']['submenu'][] = array('text' => '用户组管理', 'link' => '?g=Agent&m=Users&a=groups');
        $home_menus['display']['submenu'][] = array('text' => '用户管理', 'link' => '?g=Agent&m=Users&a=index');
        $home_menus['display']['submenu'][] = array('text' => '公众号管理', 'link' => '?g=Agent&m=Users&a=wxusers');
        return $home_menus;
    }
    public function submenu_site(){
        $home_menus['display'] = array('text' => '站点管理', 'icon' => 'image/config.png', 'folder' => 0, 'link' => '?g=Agent&m=Site&a=index');
        $home_menus['display']['submenu'][] = array('text' => '网站信息', 'link' => '?g=Agent&m=Site&a=index');
        $home_menus['display']['submenu'][] = array('text' => '注册设置', 'link' => '?g=Agent&m=Site&a=regConfig');
        $home_menus['display']['submenu'][] = array('text' => '功能模块', 'link' => '?g=Agent&m=Site&a=functions');
        $home_menus['display']['submenu'][] = array('text' => '友情链接', 'link' => '?g=Agent&m=Site&a=links');
        $home_menus['display']['submenu'][] = array('text' => '成功案例', 'link' => '?g=Agent&m=Site&a=cases');
        return $home_menus;
    }
}
?>