<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../../../config.php';

if(isset($_POST['submit'])){

	$suppliedUser = $_POST['user'];
	$suppliedPass = $_POST['pass'];
	$q = $db->prepare("SELECT * FROM users WHERE user=:user");
	$q->bindParam(":user",$suppliedUser);
	$q->execute();
	$result = $q->fetch();
	$q->closeCursor();

	if(password_verify($suppliedPass, $result['pass'])){
      $_SESSION['name']       = $result['Fname']." ".$result['Lname'];
			$_SESSION['secure']     = $result['verificationCode'];
      $_SESSION['user']       = $result['user'];
      $_SESSION['admin']      = $result['admin'];
      $_SESSION['userID']     = $result['ID'];
      $_SESSION['setup']      = $result['setupCompletion'];
      $_SESSION['customerID'] = $result['customerID'];

      if($_SESSION['setup'] === 1){
        if($result['passwordReset'] === 1){
          $_SESSION['passwordReset'] = $result['passwordReset'];
          redirect('form-change-password');
        }elseif($result['passwordReset'] === 0){
        redirect('index');
        }
      }elseif($_SESSION['setup'] === 0){
        $_SESSION['verificationCode'] = $result['verificationCode'];
        $_SESSION['verified'] = 0;
        redirect('verify');
      }
		}else{
			sessionRedirect('login', 'e', 'login-error');
		}
}

 ?>
