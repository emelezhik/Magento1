<?php

class OpsWay_Subscription_IndexController extends Mage_Core_Controller_Front_Action {

  public function indexAction() {
	var_dump($_POST);
        $this->loadLayout();
        $this->renderLayout();
  }

}
