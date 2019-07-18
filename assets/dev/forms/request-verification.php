<?php
//this up top
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once('../../../config.php');
require_once('PHPMailer/PHPMailerAutoload.php');

if(isset($_SESSION['secure'])){

  if(isset($_POST['requestVerification']) && $_POST['requestVerification'] === $_SESSION['user']){
    //seems like alls good lets build the verification link
    $hashUser = hash("sha256", $_SESSION['user'], false);
    $verificationQuery = "verify/UZYh90cmlE.php?v=".$_SESSION['verificationCode']."&u=".$hashUser;
    $verificationLink = $siteRoot.$verificationQuery;



//all must be good, lets send the email==============================
$body  = sprintf("<html>");
$body .= sprintf("<body>");
$body .= sprintf("<h2>Email Verification</h2>\n");
$body .= sprintf("<hr />");
$body .= sprintf("\n<p>Hello %s,</p>\n",$_SESSION['name']);
$body .= sprintf("\n<p>Use the link below to verify your email.  If the link does not work, copy and paste it into your bowsers address bar.</p>");
$body .= sprintf("\n<p><a href='%s'>%s</a></p>",$verificationLink, $verificationLink);
$body .= sprintf("\n<p>If you did not request this verification code please contact us.</p>");
$body .= sprintf("<p>Thank you,</p>");
$body .= sprintf("</body>");
$body .= sprintf("</html>");


$mail = new PHPMailer;
//if($mail_method == true){
  $mail->isSMTP();
  //Enable SMTP debugging
  // 0 = off (for production use)
  // 1 = client messages
  // 2 = client and server messages
  //$mail->SMTPDebug = 3;
  //$mail->Debugoutput = 'html';
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
$mail->setFrom("dan@htslabs.com", "Marketing Dept.");
$mail->addReplyTo("dan@htslabs.com", "Marketing Dept.");

$mail->Sender='dan@htslabs.com';
//$mail->addAddress($_SESSION['user']);
$mail->addAddress($_SESSION['user']);
//$mail->Subject = $email_subject;
$mail->Subject = "Email Verification";
$mail->msgHTML($body);

if (!$mail->send()) {
  sessionRedirect('index', 'e', 'emailFailed');
  exit();
} else {
    sessionRedirect('verify', 'm', 'verificationSent');
}

}else{
  session_destroy();
  redirect('login');
}
}else{
session_destroy();
redirect('login');
}
?>
