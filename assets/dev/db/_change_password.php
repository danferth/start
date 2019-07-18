<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../../../config.php';

// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// CHANGE THIS TO SOMETHING REFLECTING mailchimpVerify
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//first check, this one needs to be changed
$check1 = false;
$check2 = false;
$check3 = false;
$check4 = false;
//check for submit
if(!isset($_POST['submit'])){
  //submit not set
  redirect('form-change-password');
}else{
  $check1 = true;
}
//check if user is user
if($_SESSION['user'] != $_POST['user']){
	session_destroy();
	redirect('login');
}else{
  $check2 = true;
}
//check for matching passwords
if($_POST['password'] != $_POST['confirmPassword']){
  sessionRedirect('form-change-password','e','badpass');
}else{
  $check3 = true;
}
//check current password
if(!password_verify($_POST['currentPassword'], $_SESSION['original_password'])){
  sessionRedirect('form-change-password', 'e', 'badCurrentPass');
}else{
  $check4 = true;
}

if($check1 && $check2 && $check3 && $check4){
  //set a few variables we will need
  $suppliedPass = $_POST['password'];
  $user         = $_SESSION['user'];
  $userID       = $_SESSION['userID'];
  //set up for new password
  $hashedPass = password_hash($suppliedPass, PASSWORD_BCRYPT, $bcryptOptions);
  $passwordReset = 0;

  //UPDATE user into db
  $dbUpdateData = [
    "password"      =>$hashedPass,
    "passwordReset" =>$passwordReset,
    "userID"            =>$userID
  ];
  $query = "UPDATE users
            SET pass          = :password,
                passwordReset = :passwordReset
            WHERE ID          = :userID";

        $q = $db->prepare($query);
        $q->execute($dbUpdateData);
        $q->closeCursor();
        session_unset();
        session_destroy();
        redirect('login');
}
 ?>
