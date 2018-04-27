<?php

class OpsWay_Subscription_Model_Cron
{
  public function crontask()
  {
    $error_statuses = array("Error No. 1", "Error No. 2", "Error No. 3", "Error No. 4", "Error No. 5", "Error No. 6", "Error No. 7", "Error No. 8");

    $messages = Mage::getModel('opsway_subscription/opswaymessage')->getCollection();
    $messages->addFieldToFilter('status',array("New"));

    foreach($messages AS $message) {
      $send_success = rand(0,1);
      if($send_success) {
        $message->setStatus("Success");
        $message->setCreatedAt(time());
        $message->save();
      } else {
        Mage::log($error_statuses[array_rand($error_statuses)], null, "opsway_contacts.log");
        $message->setStatus("Failed");
        $message->save();
      }
    }
  }
}