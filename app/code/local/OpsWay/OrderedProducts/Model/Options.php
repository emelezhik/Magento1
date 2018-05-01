<?php

class OpsWay_OrderedProducts_Model_Options
{
  /**
   * Provide available options as a value/label array
   *
   * @return array
   */
  public function toOptionArray()
  {
    return array(
      array('value'=>1, 'label'=>'One'),
      array('value'=>2, 'label'=>'Two'),
      array('value'=>3, 'label'=>'Three'),
      array('value'=>4, 'label'=>'Four'),
      array('value'=>5, 'label'=>'Five'),
      array('value'=>6, 'label'=>'Six'),
      array('value'=>7, 'label'=>'Seven'),
      array('value'=>8, 'label'=>'Eight'),
      array('value'=>9, 'label'=>'Nine'),
      array('value'=>10, 'label'=>'Ten'),
    );
  }

}
