<?php

        ini_set('display_errors', '1');

$installer = $this;
 
$installer->startSetup();
 
$installer->getConnection()
    ->addColumn($installer->getTable('opsway_subscription/opswaymessage'),'status', 
      array(
        'type'      => Varien_Db_Ddl_Table::TYPE_TEXT,
        'nullable'  => true,
        'length'    => 255,
        'default'   => '',
        'comment'   => 'Status'
      )
    );

$installer->endSetup();
