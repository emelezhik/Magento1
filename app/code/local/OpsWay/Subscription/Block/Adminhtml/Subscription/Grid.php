<?php
 
class OpsWay_Subscription_Block_Adminhtml_Subscription_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('opswaymessagesGrid');
        $this->setDefaultSort('message_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }
 
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('opsway_subscription/opswaymessage')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
 
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    protected function _prepareColumns()
    {
        $this->addColumn('message_id', array(
          'header'    => 'ID',
          'align'     =>'center',
          'width'     => '30px',
          'index'     => 'message_id',
        ));
 
        $this->addColumn('email', array(
          'header'    => 'E-mail',
          'align'     =>'left',
          'index'     => 'email',
          'width'     => '200px',
        ));

        $this->addColumn('name', array(
          'header'    => 'Name',
          'align'     =>'left',
          'index'     => 'name',
          'width'     => '100px',
        ));

        $this->addColumn('phone', array(
          'header'    => 'Phone',
          'align'     =>'left',
          'index'     => 'phone',
          'width'     => '200px',
        ));
        
        $this->addColumn('message_body', array(
            'header'    => 'Message contents',
            'width'     => '300px',
            'index'     => 'message_body',
        ));

        $this->addColumn('status', array(
          'header'    => 'Status',
          'align'     =>'left',
          'index'     => 'status',
          'width'     => '100px',
        ));

        $this->addColumn('created_at', array(
          'header'    => 'Created / modified',
          'align'     =>'left',
          'index'     => 'created_at',
          'width'     => '200px',
        ));

        return parent::_prepareColumns();
    }
}