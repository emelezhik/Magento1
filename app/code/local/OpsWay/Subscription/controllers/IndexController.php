<?php

class OpsWay_Subscription_IndexController extends Mage_Core_Controller_Front_Action {

  public function indexAction() {
    $this->loadLayout();
    $this->renderLayout();
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
