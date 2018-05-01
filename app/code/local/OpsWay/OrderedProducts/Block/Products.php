<?php

class OpsWay_OrderedProducts_Block_Products extends Mage_Core_Block_Template
{

    protected function _construct()
    {
        parent::_construct();
    }

    public function getProductsList() 
    {
        $default_items_quantity = 5;
        $items_quantity = Mage::getStoreConfig('orderedproducts_options/opsway_group/opsway_displayquantity');
        $items_quantity = isset($items_quantity) ? (int) $items_quantity : $default_items_quantity;
        $items_quantity = $items_quantity != 0 ? $items_quantity : $default_items_quantity;
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        $email = $customer->getEmail();
        if(isset($email) && $email != "") {
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

}
