<?php
 
class OpsWay_Subscription_Model_Resource_Opswaymessage extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('opsway_subscription/opswaymessage', 'message_id');
    }
}