<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../../../config.php';

//check if admin
if($_SESSION['admin'] == 1){

	//check for submit
	if(isset($_POST['submit'])){
		//check for matching passwords
		if($_POST['password'] === $_POST['passwordConfirm']){
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
        $userFname 		 = filter_var($_POST['Fname'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
        $userLname 		 = filter_var($_POST['Lname'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
        $newUser 			 = filter_var($_POST['username'], FILTER_SANITIZE_EMAIL);
        $userCustID 	 = filter_var($_POST['custID'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
        $password 	 = filter_var($suppliedPass, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
        $admin 				 = $isAdmin;
        $userSetup		 = 0;
        $passwordReset = 0;
        $verificationCode = verificationCode();
				$hashedPass = password_hash($password, PASSWORD_BCRYPT, $bcryptOptions);


        //insert user into db
        $q = $db->prepare("INSERT INTO users (`ID`,`Fname`, `Lname`, `user`, `customerID`, `pass`, `admin`, `setupCompletion`, `passwordReset`, `verificationCode`) VALUES (NULL, :Fname, :Lname, :user, :customerID, :pass, :admin, :setupCompletion, :passwordReset, :verificationCode)");
        $q->bindParam(":Fname", $userFname);
        $q->bindParam(":Lname", $userLname);
        $q->bindParam(":user", $newUser);
        $q->bindParam(":customerID", $userCustID);
        $q->bindParam(":pass", $hashedPass);
        $q->bindParam(":admin", $admin);
        $q->bindParam(":setupCompletion", $userSetup);
        $q->bindParam(":passwordReset", $passwordReset);
        $q->bindParam(":verificationCode", $verificationCode);
        $q->execute();
        $q->closeCursor();
        sessionRedirect('admin','m','newUserSuccess');
			}
		}else{
			sessionRedirect('admin','e','badpass');
		}
	}else{
		redirect('admin');
	}
}else{
	session_destroy();
	redirect('login');
}
 ?>
