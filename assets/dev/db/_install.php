<?php
/*
===============================================================
So you want a login system for the site, great.....

1. in config.php enable $useDB and $useLogin
2. create a DATABASE on your server
3. fill in db variables in assets/dev/db/_connection.php
4. Run this file from the browser after filling in the
   variables as needed and then delete from the server.
===============================================================
*/

//Connect to database***********************************************************
include '_connection.php';
//install variables*************************************************************


$firstUser = "admin";
$initialPass = "password";
$admin = 1; //first user needs to be admin to add subsequent users

//connect to MySQL & Database***************************************************
echo "<p>connecting to database...</p>";
try{
	$db = new PDO($dsn,$db_user,$db_pass);
	if($db){
		echo "<p><strong>connection established...</strong></p>";
	}
}catch(PDOEXception $e){
	echo "connection failed:" . $e->getMessage();
	exit;
}

//create USERS table************************************************************
echo "creating users table...</p>";
$q = "CREATE TABLE IF NOT EXISTS users(
	`ID` INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(ID),
	`user` VARCHAR(20),
	`pass` VARCHAR(250),
	`salt` VARCHAR(200),
	`admin` BOOLEAN
	)";
$result = $db->query($q);
if(!$result) {
    die(print_r($db->errorInfo(), TRUE));
}
echo "<p>testing to see if <strong>users</strong> table exists...</p>";
$q = "SHOW TABLES LIKE 'users'";
$result = $db->query($q);
if(!$result) {
    die(print_r($db->errorInfo(), TRUE));
}
if($result->rowCount()>0)
	{
		echo "<p><strong>table exists...</strong></p>";
		$result->closeCursor();
	}
//enter first user**************************************************************
$q = ("SELECT * FROM users LIMIT 1");
$query = $db->query($q);
$result = $query->fetch(PDO::FETCH_ASSOC);
if($result) {
    echo "<p>Users table contains users no need to input first user</p>";
}else{
	echo "<p>entering first user...</p>";
//Create first user*************************************************************
$createdSalt = rand(1000,1000000);
$suppliedPass = $initialPass;
$password = $suppliedPass.$createdSalt;
$hashedPass = hash('sha512',$password);
$q = $db->prepare("INSERT INTO users (`ID`, `user`, `pass`, `salt`, `admin`) VALUES (NULL,:user, :pass, :salt, :admin)");
	$q->bindParam(":user", $firstUser);
	$q->bindParam(":pass", $hashedPass);
	$q->bindParam(":salt", $createdSalt);
	$q->bindParam(":admin", $admin);
	$q->execute();
if(!$q){
		die(print_r($db->errorInfo(), TRUE));
	}
	if($q){
		echo "<p><strong>first user entered...</strong></p>";
		$q->closeCursor();
	}
}
//output user and close connection**********************************************
$q = "SELECT * FROM users";
$result = $db->query($q);
while($arr = $result->fetch(PDO::FETCH_ASSOC)){
	echo $arr['ID']." | <strong>username</strong> = " . $arr['user'] . " created as ADMIN ready to start<br>";
}
$result->closeCursor();
$db = null;
if(is_null($db)){
	echo "<p>connection closed...</p>";
}
echo "<a href='/login.php'>go to login</a>";
?>
