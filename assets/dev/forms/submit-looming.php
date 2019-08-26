<?php
//this up top
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once('../../../config.php');
require_once('PHPMailer/PHPMailerAutoload.php');
$next_page = 'looming';
//trim post
array_walk($_POST, 'trim_value');
//Honeypot variable
$honeypotJS = filter_var($_POST['your-email247'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
//Email variables
$fname   = filter_var($_POST['fname'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$lname   = filter_var($_POST['lname'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$email   = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
//==========================================================
//Let's check for a few things and then go forward shall we
//==========================================================
//CHECK form completion time=====================================
//first variable passed to function should be seconds for minimum completion
formTimeCheck(1, $next_page);
//CHECK required inputs=====================================
//put required variables into array
$required = array($fname, $lname, $email);
checkRequired($required, $next_page);
//Validate email===========================================
//put any emails that need to be validated into an array
$checkTheseEmails = array($email);
checkEmailValid($checkTheseEmails, $next_page);

//check the honeypots======================================
//put honeypots into array
$honeypots = array($honeypotJS);
checkHoneypot($honeypots,  $next_page);
//all must be good, lets send a few emails==============================
$body  = sprintf("<html>");
$body .= sprintf("<body>");
$body .= sprintf("<h2>Contact from looming</h2>\n");
$body .= sprintf("<hr />");
$body .= sprintf("\n<p>Email: <strong>%s</strong></p>\n",$email);
$body .= sprintf("\n<p>Name: <strong>%s %s</strong></p>\n",$fname, $lname);
$body .= sprintf("<hr />");
$body .= sprintf("<p>For internal use:</p>\n");
$body .= sprintf("\n<p>Sender's IP: %s</p>\n", $_SERVER['REMOTE_ADDR']);
$body .= sprintf("\n<p>Received: %s</p>\n",date("Y-m-d H:i:s"));
$body .= sprintf("</body>");
$body .= sprintf("</html>");

$mail = new PHPMailer;
//if($mail_method == true){
  $mail->isSMTP();
  //Enable SMTP debugging
  // 0 = off (for production use)
  // 1 = client messages
  // 2 = client and server messages
  $mail->SMTPDebug = 3;
  $mail->Debugoutput = 'html';
  //after testing comment out the above two(2) lines
  $mail->Host = 'smtp.gmail.com';
  //$mail->Host = gethostbyname('smtp.gmail.com');
  $mail->Port = 587;
  $mail->SMTPSecure = 'tls';
  $mail->SMTPAuth = true;
  //*************************************
  //need to fill these out in /config.php
  //*************************************
  $mail->Username = $gmailUser;
  $mail->Password = $gmailPass;
//}
$mail->setFrom($email, $fname." ".$lname);
$mail->addReplyTo($email, $fname." ".$lname);
$mail->addAddress($my_email);
//$mail->Subject = $email_subject;
$mail->Subject = "Looming site Contact";
$mail->msgHTML($body);
if (!$mail->send()) {
  sessionRedirect('index', 'e', 'emailFailed');
  exit();
} else {
    sessionredirect($next_page, 'm', 'emailSuccess');
}
?>
