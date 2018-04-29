<?php

class OpsWay_Subscription_Block_Adminhtml_Subscription extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_subscription';
    $this->_blockGroup = 'subscription';
    $this->_headerText = 'Messages Manager';
    $this->_addButtonLabel = 'Add Message';
    parent::__construct();
  }
}