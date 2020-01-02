<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../../../config.php';

$check1 = false;
$check2 = false;
$check3 = false;

//check if admin
if($_SESSION['admin'] == 1){
  $check1 = true;
}else{
	session_destroy();
	redirect('login');
  exit;
}

//check for submit
if(isset($_POST['submit'])){
  $check2 = true;
}else{
  redirect('admin');
  exit;
}

//check for password syntax
$passRegCheck = passwordRegCheck($_POST['password']);
if($passRegCheck){
  $check3 = true;
}else{
  sessionRedirect('admin', 'e', 'passSyntax');
  exit;
}

if($check1 && $check2 && $check3){
  $newUser = $_POST['username'];
  $suppliedPass = $_POST['password'];
  checkBox('isAdmin');
  $isAdmin = $_POST['isAdmin'];
  $userCheck = $db->prepare("SELECT * FROM users WHERE user=:newUser");
  $userCheck->execute(["newUser" => $newUser]);
  $userCheck->closeCursor();
  //check for existing user
  if($userCheck->rowCount()>0){
	   sessionRedirect('admin','e','userAlreadyExists');
   }else{
	    //start creating user
      $userFname 		    = filter_var($_POST['Fname'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
      $userLname 		    = filter_var($_POST['Lname'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
      $newUser 			    = filter_var($_POST['username'], FILTER_SANITIZE_EMAIL);
      $userCustID 	    = filter_var($_POST['custID'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
      $password 	      = filter_var($suppliedPass, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
      $admin 				    = $isAdmin;
      $userSetup		    = 0;
      $passwordReset    = 0;
      $verificationCode = verificationCode();
	    $hashedPass       = password_hash($password, PASSWORD_BCRYPT, $bcryptOptions);
      $introViewed      = 0;

      //insert user into db
      $q = $db->prepare("INSERT INTO users (`ID`,`Fname`, `Lname`, `user`, `customerID`, `pass`, `admin`, `setupCompletion`, `passwordReset`, `verificationCode`, `introViewed`) VALUES (NULL, :Fname, :Lname, :user, :customerID, :pass, :admin, :setupCompletion, :passwordReset, :verificationCode, :introViewed)");
      $q->bindParam(":Fname", $userFname);
      $q->bindParam(":Lname", $userLname);
      $q->bindParam(":user", $newUser);
      $q->bindParam(":customerID", $userCustID);
      $q->bindParam(":pass", $hashedPass);
      $q->bindParam(":admin", $admin);
      $q->bindParam(":setupCompletion", $userSetup);
      $q->bindParam(":passwordReset", $passwordReset);
      $q->bindParam(":verificationCode", $verificationCode);
      $q->bindParam(":introViewed", $introViewed);
      $q->execute();
      $q->closeCursor();
      sessionRedirect('admin','m','newUserSuccess');
    }
}


 ?>
