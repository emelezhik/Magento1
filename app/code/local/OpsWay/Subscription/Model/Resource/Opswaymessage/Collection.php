<?php
class OpsWay_Subscription_Model_Resource_Opswaymessage_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('opsway_subscription/opswaymessage');
    }
}