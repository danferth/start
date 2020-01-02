<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../../../config.php';

$check1 = false; //is admin
$check2 = false; //is post
$check3 = false; //password passed

//check if admin
if($_SESSION['admin'] == 1){
  $check1 = true;
}else{
	session_destroy();
	redirect('login');
  exit;
}

//check for submit
if(isset($_POST['multipleSubmit'])){
  $check2 = true;
}else{
  redirect('admin');
  exit;
}

$multiUserInput =  json_decode($_POST['inputMultipleUsers'], true);

for ($i=0; $i < count($multiUserInput); $i++) {
  $userFname    = $multiUserInput[$i]['fname'];
  $userLname    = $multiUserInput[$i]['lname'];
  $newUser      = $multiUserInput[$i]['email'];
  $userCustID   = $multiUserInput[$i]['custID'];
  $password     = $multiUserInput[$i]['Password'];

  //check for password syntax
  $passRegCheck = passwordRegCheck($password);
  if($passRegCheck){
    $check3 = true;
  }else{
    echo "Password for <b>" . $userFname . " " . $userLname . "</b> FAILED check<br/>";
    exit;
  }

  if($check1 && $check2 && $check3){

    //check if existing user
    $userCheck = $db->prepare("SELECT * FROM users WHERE user=:newUser");
    $userCheck->execute(["newUser" => $newUser]);
    $userCheck->closeCursor();
    if($userCheck->rowCount()>0){
      echo "User <b>" . $newUser . "</b> | <i>" . $userFname . " " . $userLname . "</i> Already exist.<br/>";
      exit;
    }else{
  	    //start creating user
        $admin 				    = 0;
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
      }
  }

}

redirect('admin');

 ?>
