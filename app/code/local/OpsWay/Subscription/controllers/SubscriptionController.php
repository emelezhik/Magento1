<?php

class OpsWay_Subscription_SubscriptionController extends Mage_Adminhtml_Controller_action
{

    public function indexAction() {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('subscription/adminhtml_subscription'));
        $this->renderLayout();
    }

    public function newAction(){
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('subscription/adminhtml_subscription_edit'))
                ->_addLeft($this->getLayout()->createBlock('subscription/adminhtml_subscription_edit_tabs'));
        $this->renderLayout();
    }

    public function editAction(){
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('subscription/adminhtml_subscription_edit'))
                ->_addLeft($this->getLayout()->createBlock('subscription/adminhtml_subscription_edit_tabs'));
        $this->renderLayout();
    }

  public function saveAction() {
    if ($data = $this->getRequest()->getPost()) {
      $id = $this->getRequest()->getParam('id');
      $message = Mage::getModel('opsway_subscription/opswaymessage')->load($id);
      $message->setEmail($data['email']);
      $message->setCreatedAt(time());
      $message->setName($data['name']);
      $message->setPhone($data['phone']);
      $message->setStatus($data['status']);
      $message->setMessageBody($data['message_body']);
      $message->save();
    }
    $this->_redirect('adminhtml/subscription/index');
  }

  public function deleteAction() {
    $id = $this->getRequest()->getParam('id');
    $message = Mage::getModel('opsway_subscription/opswaymessage')->load($id);
    $message->delete();
    $this->_redirect('adminhtml/subscription/index');
  }

}