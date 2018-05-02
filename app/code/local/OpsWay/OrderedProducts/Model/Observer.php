<?php

class OpsWay_OrderedProducts_Model_Observer extends Varien_Event_Observer
{

    public function BlockCacheFlush($observer)
    {
        $cache = Mage::app()->getCache();
        $cache->remove(Mage::helper('opsway_orderedproducts')->getCacheKey());

        Mage::log("Cache flushed for cache key: " . Mage::helper('opsway_orderedproducts')->getCacheKey(), null, "opsway_cacheflush.log");
    }

}
