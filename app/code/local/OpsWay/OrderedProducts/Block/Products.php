<?php

class OpsWay_OrderedProducts_Block_Products extends Mage_Core_Block_Template
{

  protected function _construct()
  {
    parent::_construct();
  }

  public function getTestText() 
  {
    echo "<p>List of products will be HERE!!!</p>";
  }

}
