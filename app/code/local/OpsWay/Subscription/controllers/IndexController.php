<?php

class OpsWay_Subscription_IndexController extends Mage_Core_Controller_Front_Action {

  public function indexAction() {
    $this->loadLayout();
    $this->renderLayout();
  }

  public function messageAction() {
    $params = $this->getRequest()->getParams();
    $message = Mage::getModel('opsway_subscription/opswaymessage');
    echo("<p>Loading the message with an ID of ".$params['id'])."</p><p> &nbsp; </p>";
    $message->load($params['id']);
    echo "<p>Message ID: ".$message->getMessageId()."</p>";
    echo "<p>Author name: ".$message->getName()."</p>";
    echo "<p>Author e-mail: ".$message->getEmail()."</p>";
    echo "<p>Author phone: ".$message->getPhone()."</p>";
    echo "<p><u>Message:</u></p>";
    echo "<p>".$message->getMessageBody()."</p>";
  }

  public function appendMessageAction() {
    $params = $this->getRequest()->getParams();
    $message = Mage::getModel('opsway_subscription/opswaymessage');
    echo("<p>Altering the message with an ID of ".$params['id'])."</p><p> &nbsp; </p>";
    $message->load($params['id']);
    echo "<p>Message body was:</p><p>".$message->getMessageBody()."</p>";
    echo "<p>...</p>";
    echo "<p>...</p>";
    echo "<p>... modifications ...</p>";

    $message->setMessageBody($message->getMessageBody() . "<p>surprise!</p>");
    $message->save();

    echo "<p>... and now ...</p>";
    echo "<p>...</p>";
    echo "<p>...</p>";
    echo "<p><u>Message body is:</u></p>";
    echo "<p>".$message->getMessageBody()."</p>";
  }

  public function messagesAllAction() {
    $messages = Mage::getModel('opsway_subscription/opswaymessage')->getCollection();
    print "<h1>List of all stored opsway message entities</h1>";
    print "<table cellspacing='5' cellpadding='10' border='1'><tr><td>Message ID</td><td>Name</td><td>E-mail</td><td>Phone</td><td>Action links</td></tr>";
    foreach($messages AS $message) {
      $id = $message->getMessageId();
      echo "<tr>";
      echo "<td>{$id}</td>";
      echo "<td>".$message->getName()."</td>";
      echo "<td>".$message->getEmail()."</td>";
      echo "<td>".$message->getPhone()."</td>";
      echo "<td><a target=_blank href='/subscription/index/message/id/{$id}'>View full text</a> <br>";
      echo "<a target=_blank href='/subscription/index/appendMessage/id/{$id}'>Append message</a></td>";
      echo "</tr>";
    };
  }

  public function postAction() {
    $error_flag = FALSE;
    if(!isset($_POST['name']) || $_POST['name'] == "") {
      $error_flag = TRUE;
      echo "Error! Empty name!";
    };
    if(!isset($_POST['useremail']) || $_POST['useremail'] == "") {
      $error_flag = TRUE;
      echo "Error! Empty e-mail!";
    };
    if(!isset($_POST['phone']) || $_POST['phone'] == "") {
      $error_flag = TRUE;
      echo "Error! Empty phone!";
    };
    if(!isset($_POST['message']) || $_POST['message'] == "") {
      $error_flag = TRUE;
      echo "Error! Empty message!";
    };

    $name_filtered = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
    $mail_filtered = filter_var($_POST['useremail'], FILTER_SANITIZE_EMAIL);
    $phone_filtered = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
    $message_filtered = filter_var($_POST['message'], FILTER_SANITIZE_SPECIAL_CHARS);

    if($mail_filtered != $_POST['useremail']) {
      $error_flag = TRUE;
      echo "Error! E-mail in wrong format!";
    };

    if(!$this->validateEmail($_POST['useremail'])) {
      $error_flag = TRUE;
      echo "Error! E-mail in wrong format!";
    };

    if(!$error_flag) {
      $mess_text = "<p>Phone: {$phone_filtered}</p>
		<p>E-mail: {$mail_filtered}</p>
		<p>Message:</p>{$message_filtered}";
      mail("evmel@opsway.com", "Message from {$name_filtered}", $mess_text);
      echo "Successful! $mess_text";
    };
  }

  private function validateEmail($mail) {
    if (strpos($mail, '@') == false) {
      return FALSE;
    }
    if (strpos($mail, '.') == false) {
      return FALSE;
    }
    if (strpos($mail, '@') > strpos($mail, '.')) {
      return FALSE;
    }
    return TRUE;
  }

}
