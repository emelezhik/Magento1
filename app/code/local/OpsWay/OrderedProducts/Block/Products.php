<?php

class OpsWay_OrderedProducts_Block_Products extends Mage_Core_Block_Template
{

    protected function _construct()
    {
        parent::_construct();
    }

    public function getProductsList() 
    {
        $items_quantity = Mage::helper('opsway_orderedproducts')->getDisplayQuantity();

        if(Mage::getSingleton('customer/session')->isLoggedIn()) {
            $email = Mage::getSingleton('customer/session')->getCustomer()->getEmail();
            return $this->getProductsListAuthorized($items_quantity, $email);
        } else {
            return $this->getProductsListAnonymous($items_quantity);
        }
    }

    private function getProductsListAuthorized($items_quantity, $email) {
        $output = "";
        $orderedProductIds = [];
        $orderCollection = Mage::getModel('sales/order')->getCollection();
        $orderCollection->addFieldToFilter('customer_email', $email);

        foreach($orderCollection AS $order) {
            $orderedItems = $order->getAllVisibleItems();
            foreach ($orderedItems as $item) {
                $orderedProductIds[] = $item->getData('product_id');
            }
        }

        $productCollection = Mage::getModel('catalog/product')->getCollection()
            ->setPageSize($items_quantity)
            ->addAttributeToFilter('status', 1)
            ->addUrlRewrite()
            ->addAttributeToSelect('price')
            ->addAttributeToSelect('name')
            ->addAttributeToSelect('image')
            ->addIdFilter($orderedProductIds);

        $productCollection->getSelect()->order(new Zend_Db_Expr('RAND()'));

        foreach($productCollection AS $result) {
            $output .= $this->renderProductEntity($result);
        }

        return $output;
    }

    private function getProductsListAnonymous($items_quantity) {
        $output = "";
        $productCollection = Mage::getModel('catalog/product')->getCollection()
            ->setPageSize($items_quantity)
            ->addAttributeToFilter('status', 1)
            ->addUrlRewrite()
            ->addAttributeToSelect('price')
            ->addAttributeToSelect('name')
            ->addAttributeToSelect('image');

        $productCollection->getSelect()->order(new Zend_Db_Expr('RAND()'));

        foreach($productCollection AS $result) {
            $output .= $this->renderProductEntity($result);
        }
        return $output;
    }

    private function renderProductEntity($product) {
        $url = $product->getProductUrl();
        $imgurl = (string) Mage::helper('catalog/image')->init($product, 'image')->resize(100);
        $data = (object) $product->getData();
        $price = isset($data->price) && is_numeric($data->price) ? "$" . number_format($data->price, 2, '.', '') : "";
        $output = "<div class='listimage'><img src='{$imgurl}'><p class='prdesc'><a target='_blank' href='{$url}'>{$data->name}, <br> {$price}</a></p></div>";
        return $output;
    }

    protected function _toHtml()
    {
        return Mage::helper('opsway_orderedproducts')->isEnabled() ? parent::_toHtml() : '';
    }

}
