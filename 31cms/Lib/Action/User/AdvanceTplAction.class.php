<?php

class AdvanceTplAction extends UserAction{
public function _initialize() {
parent::_initialize();
$this->canUseFunction('advanceTpl');
header('Location:/cms/manage/index.php');
}
}
?>