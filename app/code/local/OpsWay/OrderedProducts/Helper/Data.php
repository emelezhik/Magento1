<?php

class OpsWay_OrderedProducts_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_ENABLED = 'opsway_orderedproducts_options/general/visibility';
    const XML_PATH_DISPLAY_QUANTITY = 'opsway_orderedproducts_options/general/display_quantity';
    const DEFAULT_ITEMS_TO_BE_DISPLAYED = 5;

    public function isEnabled()
    {
        return (bool) Mage::getStoreConfig(self::XML_PATH_ENABLED);
    }

    public function getDisplayQuantity()
    {
        $items_quantity = Mage::getStoreConfig(self::XML_PATH_DISPLAY_QUANTITY);
        $items_quantity = isset($items_quantity) ? (int) $items_quantity : self::DEFAULT_ITEMS_TO_BE_DISPLAYED;
        $items_quantity = $items_quantity > 0 ? $items_quantity : self::DEFAULT_ITEMS_TO_BE_DISPLAYED;
        return $items_quantity;
    }
}
