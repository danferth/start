<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../config.php';

if(!empty($_GET)){
  $v = filter_var($_GET['v'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
  $u = filter_var($_GET['u'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);

  $vqry = "SELECT * FROM users WHERE verificationCode='".$v."'";

  $checkUser = $db->prepare($vqry);
  $checkUser->execute();
  $userResult = $checkUser->fetch(PDO::FETCH_ASSOC);
  $rowCheck = $checkUser->rowCount();
  if($rowCheck > 0){
    $checkUser->closeCursor();
    $hashTest = hash("sha256", $userResult['user'], false);
    if($hashTest === $u){
      $_SESSION['name']       = $userResult['Fname']." ".$userResult['Lname'];
			$_SESSION['secure']     = $userResult['verificationCode'];
      $_SESSION['user']       = $userResult['user'];
      $_SESSION['admin']      = $userResult['admin'];
      $_SESSION['userID']     = $userResult['ID'];
      $_SESSION['setup']      = $userResult['setupCompletion'];
      $_SESSION['customerID'] = $userResult['customerID'];
      $_SESSION['verified']   = 1;
      redirect('form-setup');

    }else{
      session_destroy();
      dbClose();
      redirect('login');
    }
  }else{
    session_destroy();
    dbClose();
    redirect('login');
  }
}else{
  session_destroy();
  dbClose();
  redirect('login');
}













?>
