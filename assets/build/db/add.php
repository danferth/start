<?php
session_start();
include "_connection.php";
require_once "db_functions.php";
sessionTimeout();

	if(!$_POST['submit']){
		echo "nothing added to database";
		header('Location:index.php');
	}else{

		checkBox('boolean');

		$text 			= 	$_POST['text'];
		$boolean 		= 	$_POST['boolean'];

		$query = $db->prepare("INSERT INTO fliers (`ID`, `text`, `boolean`) VALUES (NULL, :text, :boolean)");

		$query->bindParam(":text",$text);
		$query->bindParam(":boolean",$boolean);
		$query->execute();

		dbClose();

		redirect('list');

	}
 ?>
