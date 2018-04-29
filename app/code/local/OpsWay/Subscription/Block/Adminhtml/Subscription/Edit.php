<?php

class OpsWay_Subscription_Block_Adminhtml_Subscription_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_subscription';
        $this->_blockGroup = 'subscription';

        parent::__construct();

        $this->_updateButton('save', 'label', 'Save Message');
        $this->_updateButton('delete', 'label', 'Delete Message');
    }

    /**
     * Get edit form container header text
     *
     * @return string
     */
    public function getHeaderText()
    {
	return "Edit message Form";
    }
}