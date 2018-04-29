<?php

class OpsWay_Subscription_Block_Adminhtml_Subscription_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();

	$id = $this->getRequest()->getParam('id');
        $message = Mage::getModel('opsway_subscription/opswaymessage')->load($id);

        $this->setForm($form);
        $fieldset = $form->addFieldset('form_form', array('legend' => 'Item information'));
          
        $fieldset->addField('email', 'text', array(
          'label'     => 'E-mail',
          'class'     => 'required-entry validate-email',
          'required'  => true,
          'name'      => 'email',
	  'value'     => $message->getEmail(),
        ));

        $fieldset->addField('name', 'text', array(
          'label'     => 'Name',
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'name',
	  'value'     => $message->getName(),
        ));

        $fieldset->addField('phone', 'text', array(
          'label'     => 'Phone',
          'class'     => 'required-entry validate-phoneStrict',
          'required'  => true,
          'name'      => 'phone',
	  'value'     => $message->getPhone(),
        ));

        $fieldset->addField('status', 'select', array(
          'label'     => 'Status',
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'status',
	  'value'     => $message->getStatus(),
          'options'   => array('New' => 'New (to be sent)', 'Failed' => 'Failed', 'Success' => 'Success'),
        ));

        $fieldset->addField('message_body', 'textarea', array(
          'label'     => 'Message body',
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'message_body',
	  'value'     => $message->getMessageBody(),
        ));
          
        return parent::_prepareForm();
    }
}