<?php
session_start(); //starts the session

$_SESSION['user'] = "Danferth"; //stores session data, here user "Danferth"


//=============================================================================
//you can use $_GET from login like so...
include "connection.php"; //connect to db
if(!isset($_SESSION['user'])){

  $q = $db->prepare("SELECT * FROM users WHERE ID=:id"); 	//prepared SQL
	$q->bindParam(":id", $_GET['message']); 				//bind parameter
	$q->execute(); 											//execute query
	$userResult = $q->fetch(PDO::FETCH_ASSOC);				//put query into array
	$_SESSION['user'] = $userResult['user'];				//set session veriable

	$welcomeMessage = "<p>Welcome ". $_SESSION['user']."</p>";
}else{
	$welcomeMessage = "<p>Welcome back ". $_SESSION['user']."</p>";
}

echo $welcomeMessage;
//=============================================================================

unset($_SESSION['user']);  //unsets session variable

session_unset();  //unsets all session data
//THE ABOVE STILL HAS ACTIVE SESSION THOUGH ONLY ALL DATA IS UNSET

session_destroy();  //ends session

//you can set a time out

$timeout = 120; //secconds so this would be 2 minutes
if(isset($_SESSION['timeout'])){
	$sessionlife = time() - $_SESSION['timeout'];
	if($sessionlife > $timeout){
		session_destroy();
		header("Location: back to login");
	}
}
$_SESSION['timeout'] = time();


/*****************************************************
NOTE: Always destroy session with session_destroy()
You can use session_regenerate_id() for furter
security but was not needed at this time so
further study is required for this method
******************************************************/
 ?>
