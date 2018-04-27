<?php
 
$messages = Mage::getModel('opsway_subscription/opswaymessage')
                ->getCollection();
 
foreach ($messages as $message) {
    $message->setCreatedAt(time())
	   ->setStatus("New")
           ->save();
}