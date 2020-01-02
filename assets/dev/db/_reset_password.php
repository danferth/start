<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../forms/PHPMailer/PHPMailerAutoload.php';
require_once '../../../config.php';

// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// CHANGE THIS TO SOMETHING REFLECTING mailchimpVerify
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//first check, this one needs to be changed
$check1 = false;
$resetDone = false;
//check for submit
if(!isset($_POST['submit'])){
    //submit not set
    redirect('form-reset-password');
}else{
  $check1 = true;
  $userEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
}

if($check1){

    $ru = $db->prepare("SELECT * FROM users WHERE user=:userEmail");
    $ru->bindParam(":userEmail", $userEmail);
    $ru->execute();
    $checkForUser = $ru->rowCount();

    if($checkForUser <= 0){
      $ru->closeCursor();
      sessionRedirect('form-reset-password', 'e', 'userNotExsist');
      exit();
    }elseif($checkForUser > 0){
      $userData = $ru->fetch();
      $ru->closeCursor();
    }

}

      //set up for new password
      $password   = generatePassword();
      $hashedPass = password_hash($password, PASSWORD_BCRYPT, $bcryptOptions);

      //UPDATE user
      $dbUpdateData = [
        "password"  =>$hashedPass,
        "reset"     =>1,
        "userEmail" =>$userEmail
      ];
      $query = "UPDATE users
                SET pass          = :password,
                    passwordReset = :reset
                WHERE user        = :userEmail";

            $q = $db->prepare($query);
            $q->execute($dbUpdateData);
            $q->closeCursor();

$body  = sprintf("<html>");
$body .= sprintf("<body>");
$body .= sprintf("<h2>Your Password Has Been Reset</h2>\n");
$body .= sprintf("<hr />");
$body .= sprintf("\nHello %s %s,<br />\n",$userData['Fname'], $userData['Lname']);
$body .= sprintf("\nYour temporary password is: <b>%s</b><br /><br/>\n",$password);
$body .= sprintf("<b>NOTE:</b> When you log back in with this temporary password you will be prompted to reset your password to something more personal and easy to remember.<br/><br/>");
$body .= sprintf("Thank you,<br />");
$body .= sprintf("Thomson Instrument Company");
$body .= sprintf("<br />-----------------<br />\n");
$body .= sprintf("\nReceived: %s<br />\n",date("Y-m-d H:i:s"));
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
$mail->addAddress($userData['user']);
//$mail->Subject = $email_subject;
$mail->Subject = "Password RESET request";
$mail->msgHTML($body);
if (!$mail->send()) {
    sessionRedirect('index', 'e', 'emailFailed');
		exit();
} else {
  session_unset();
  //session_destroy();
  sessionRedirect('login', 'm', 'paswordReset');
}
 ?>
