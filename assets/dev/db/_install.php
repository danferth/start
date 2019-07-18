<?php
/*
================================================================================
So you want a login system for the site, great.....

1. in config.php enable $useDB and $useLogin
2. create a DATABASE on your server
3. fill in db variables in assets/dev/db/_connection.php
4. Run this file from the browser after filling in the
   variables as needed and then delete from the server.
================================================================================
*/

//Connect to database & a few functions from here*******************************
require_once '../../../config.php';
//install variables*************************************************************

$firstUserFname 		   = "firstAdmin";
$firstUserLname 		   = "lastAdmin";
$firstUser 					   = "admineamil@email.com";
$firstUserCustID 		   = "123456";
$password 				     = "password";
$verificationCode      = verificationCode();
$admin 							   = 1; //first user needs to be admin to add subsequent users
$firstUserSetup			   = 1;
$passwordReset         = 0;



//see if table exsist.
$q = $db->query("SHOW TABLES LIKE 'users'");
$testCount = $q->rowCount();
$q->closeCursor();
if($testCount !== 0){
  echo "table already exsist! why are you trying to install again?";
  die();
}



//create USERS table************************************************************
echo "creating users table...</p>";
$q = "CREATE TABLE IF NOT EXISTS users(
	`ID` INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(ID),
	`Fname` VARCHAR(20),
	`Lname` VARCHAR(20),
	`user` VARCHAR(200),
	`customerID` VARCHAR(200),
	`pass` VARCHAR(250),
	`admin` BOOLEAN,
  `verificationCode` VARCHAR(200),
	`setupCompletion` BOOLEAN,
  `passwordReset` BOOLEAN,
	`prefShipContact_attn` VARCHAR(50),
	`prefShipContact_bizName` VARCHAR(50),
	`prefShipTo_address1` VARCHAR(200),
	`prefShipTo_address2` VARCHAR(200),
	`prefShipTo_city` VARCHAR(50),
	`prefShipTo_state` VARCHAR(50),
	`prefShipTo_zip` VARCHAR(20),
	`prefShipTo_notes` VARCHAR(250),
	`shipOptions_residentialDelivery` BOOLEAN,
	`shipOptions_saturdayDelivery` BOOLEAN,
	`shipOptions_insurance` BOOLEAN,
	`shipOptions_useCustomerAccount` BOOLEAN,
	`shipOptions_customerShipperPref` VARCHAR(200),
	`shipOptions_customerAccountNumber` VARCHAR(200),
	`completedOrders` VARCHAR(250)
	)";

  $createTable = $db->query($q);
  $createTable->execute();
  $createTable->closeCursor();


echo "<p>Created table <b>users</b>...</p>";








//Create first user*************************************************************
echo "<p>entering first user...</p>";
$hashedPass = password_hash($password, PASSWORD_BCRYPT, $bcryptOptions);
$q = $db->prepare("INSERT INTO users (`ID`,
                                      `Fname`,
                                      `Lname`,
                                      `user`,
                                      `customerID`,
                                      `pass`,
                                      `admin`,
                                      `verificationCode`,
                                      `setupCompletion`,
                                      `passwordReset`)
                                      VALUES (NULL,
                                              :Fname,
                                              :Lname,
                                              :user,
                                              :customerID,
                                              :pass, :admin,
                                              :verificationCode,
                                              :setupCompletion,
                                              :passwordReset)");
$q->bindParam(":Fname", $firstUserFname);
$q->bindParam(":Lname", $firstUserLname);
$q->bindParam(":user", $firstUser);
$q->bindParam(":customerID", $firstUserCustID);
$q->bindParam(":pass", $hashedPass);
$q->bindParam(":admin", $admin);
$q->bindParam(":verificationCode", $verificationCode);
$q->bindParam(":setupCompletion", $firstUserSetup);
$q->bindParam(":passwordReset", $passwordReset);
$q->execute();
$q->closeCursor();
echo "<p><b>first user entered...</b></p>";









//output user and close connection**********************************************
$q = "SELECT * FROM users WHERE ID=1";
$result = $db->query($q);

while($arr = $result->fetch()){
	echo $arr['ID']." | <b>username</b> = " . $arr['user'] . " created as ADMIN ready to start<br>";
}
$result->closeCursor();
$db = null;
if(is_null($db)){
	echo "<p>connection closed...</p>";
}
echo "<a href='/login.php'>go to login</a>";


?>
