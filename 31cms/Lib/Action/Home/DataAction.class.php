<?php
echo '﻿';
class DataAction extends Action{
private $IIIIIIIIlIlI;
private $IIIIIIIllllI;
private $IIIIIIIIIl11=array();
private $IIIIIIIlllll='晨优汇';
public function index(){
die("获取各种js调用的数据");
}
public function info(){
$IIIIIIIlll1I = array(
"ret"=>0,
"data"=>array(
"company"=>C("site_name"),
"is_deleted"=>"0",
"is_active"=>"1",
"dt_expire"=>"2029-1-1",
"mp_username"=>"",
"logo"=>"",
"web_name"=>"",
"contact_mobile"=>"",
"country"=>"",
"status"=>0,
"url"=>0,
)
);
die(json_encode($IIIIIIIlll1I));
}
public function footer(){
$IIIIIIIlll1I = array(
"ret"=>0,
"data"=>array(
"slogan"=>array(
array("title"=>"","href"=>"","ajax"=>0),
array("title"=>"","href"=>"","ajax"=>0),
array("title"=>"","href"=>"","ajax"=>0),
),
"support"=>array(
"title"=>C("site_name"),
"href"=>C("site_url"),
"ajax"=>0,
),
)
);
die(json_encode($IIIIIIIlll1I));
}
public function userinfo(){
$IIIIIIIll1II = $this->_post("wxid");
$IIIIIIIIlIlI = $this->_post("token");
$IIIIIIIlll1I = array(
"ret"=>0,
"data"=>array(
"id"=>"",
"fake_id"=>"",
"wid"=>"1",
"name"=>"1",
"mobile"=>"1",
"password"=>"1",
"invite_account_id"=>"1",
"money"=>"1",
"gift_money"=>"1",
"credit"=>"1",
"level_credit"=>"1",
"last_ip"=>"1",
"dt_login"=>"1",
"dt_add"=>"1",
"dt_update"=>"1",
)
);
die(json_encode($IIIIIIIlll1I));
}
public function account(){
$IIIIIIIll1II = $this->_get("wxid");
$IIIIIIIIlIlI = $this->_get("token");
$IIIIIIIlll1I = array(
"ret"=>0,
"data"=>array(
"wxid"=>$IIIIIIIll1II,
"id"=>$IIIIIIIll1II,
"fake_id"=>"",
"wid"=>"",
"name"=>"",
"mobile"=>"",
"password"=>"",
"invite_account_id"=>"1",
"money"=>"1",
"gift_money"=>"1",
"credit"=>"1",
"level_credit"=>"1",
"last_ip"=>"1",
"dt_login"=>"1",
"dt_add"=>"1",
"dt_update"=>"1",
)
);
die(json_encode($IIIIIIIlll1I));
}
}?>