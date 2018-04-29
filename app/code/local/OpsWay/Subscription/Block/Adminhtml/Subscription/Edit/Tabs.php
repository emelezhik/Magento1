<?php
class OpsWay_Subscription_Block_Adminhtml_Subscription_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
 
  public function __construct()
  {
      parent::__construct();
      $this->setId('form_tabs');
      $this->setDestElementId('edit_form'); // this should be same as the form id define above
      $this->setTitle('Product Information');
  }
 
  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => 'Item Information',
          'title'     => 'Item Information',
          'content'   => $this->getLayout()->createBlock('subscription/adminhtml_subscription_edit_tab_form')->toHtml(),
      ));
      
      return parent::_beforeToHtml();
  }
}