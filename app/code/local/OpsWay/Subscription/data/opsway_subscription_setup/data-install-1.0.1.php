<?php
 
$opswaymessages = array(
    array(
        'email' => 'sdfgdf@sfd.ua',
	'name' => 'John',
	'phone' => '024-134-2434',
	'message_body' => 'Hey get me out of here!!!',
    ),
    array(
        'email' => 'ljhsfsd@ads.ru',
	'name' => 'Brown',
	'phone' => '035-243-6767',
	'message_body' => 'Yohooooo! Test data populated!',
    ),
);
 
foreach ($opswaymessages as $opswaymessage) {
    Mage::getModel('opsway_subscription/opswaymessage')
        ->setData($opswaymessage)
        ->save();
}