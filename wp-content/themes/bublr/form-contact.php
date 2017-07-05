<?php
session_start();

$salt = "BublrContactForm";

if ($_POST['confirmationCAP'] == "") {
  if (
      $_POST[md5('name' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
      $_POST[md5('email' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
      $_POST[md5('help' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
      $_POST[md5('message' . $_POST['ip'] . $salt . $_POST['timestamp'])] != ""
     )
  {
    // If mailing list box is checked, add them
    if (isset($_POST['mailinglist'])) {
      include_once "inc/fintoozler.php";

      $data = array(
        'email'  => $_POST[md5('email' . $_POST['ip'] . $salt . $_POST['timestamp'])],
        'status' => 'subscribed'
      );
      
      function syncMailchimp($data) {
        global $apiKey, $listId;

        $memberId = md5(strtolower($data['email']));
        $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
        $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listId . '/members/' . $memberId;

        $json = json_encode(array(
          'email_address' => $data['email'],
          'status'        => $data['status']
        ));

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);                                                                                                                 

        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpCode;
      }

      syncMailchimp($data);
    }

    // Send email
    $Subject = $_POST[md5('help' . $_POST['ip'] . $salt . $_POST['timestamp'])];
    // $SendTo = "info@bublrbikes.com";
    $SendTo = "lippert@gmail.com";
    $Headers = "From: Contact Form <contactform@bublrbikes.com>\r\n";
    $Headers .= "Reply-To: " . $_POST[md5('email' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "\r\n";
    // $Headers .= "Bcc: mark@foresitegrp.com\r\n";

    $Message = $_POST[md5('name' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "\n";
    $Message .= $_POST[md5('email' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "\n";
    if ($_POST[md5('company' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "")
      $Message .= $_POST[md5('company' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "\n";
    if ($_POST[md5('phone' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "")
      $Message .= $_POST[md5('phone' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "\n";

    $Message .= "\n";

    $Message .= "Message:\n" . $_POST[md5('message' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "\n";

    $Message = stripslashes($Message);
  
    mail($SendTo, $Subject, $Message, $Headers);
    
    $feedback = "Thank you for your interest in Bublr Bikes. You will be contacted soon.";
    
    if (!empty($_REQUEST['src'])) {
      header("HTTP/1.0 200 OK");
      echo $feedback;
    }
  } else {
    $feedback = "Some required information is missing! Please go back and make sure all required fields are filled.";

    if (!empty($_REQUEST['src'])) {
      header("HTTP/1.0 500 Internal Server Error");
      echo $feedback;
    }
  }
}

if (empty($_REQUEST['src'])) {
  $_SESSION['feedback'] = $feedback;
  header("Location: " . $_POST['referrer'] . "#contact-form");
}
?>