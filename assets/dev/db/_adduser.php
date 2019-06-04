<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '_connection.php';
include '../../../functions.php';

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
			//sanitize username for user check
			$sanitizedUser = $db->quote($newUser);
			$q = "SELECT * FROM users WHERE user =".$sanitizedUser;
			$result = $db->query($q);
			//check for existing user
			if($result->rowCount()>0){
				$result->closeCursor();
				dbClose();
				queryRedirect('admin','e','userAlreadyExists');
			}else{

				//start creating user
				$createdSalt = rand(1000,1000000);
				$password = $suppliedPass.$createdSalt;
				$hashedPass = hash('sha512',$password);
				//insert user into db
				$q = $db->prepare("INSERT INTO users (`ID`, `user`, `pass`, `salt`, `admin`) VALUES (NULL,:user, :pass, :salt, :admin)");
					$q->bindParam(":user", $newUser);
					$q->bindParam(":pass", $hashedPass);
					$q->bindParam(":salt", $createdSalt);
					$q->bindParam(":admin", $isAdmin);
					$q->execute();

				if(!$q){
						die(print_r($db_conn->errorInfo(), TRUE));
					}
					if($q){
						$q->closeCursor();
						queryRedirect('admin','m','newUserSuccess');
					}
				}

		}else{
			queryRedirect('admin','e','badpass');
		}

	}else{
		redirect('admin');
	}
}else{
	session_destroy();
	redirect('login');
}
 ?>
