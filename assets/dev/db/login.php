<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "_connection.php";
require_once "db_functions.php";

if(isset($_POST['submit'])){

		$suppliedUser = $_POST['user'];
		$suppliedPass = $_POST['pass'];

	$q = $db->prepare("SELECT * FROM users WHERE user=:user");
		$q->bindParam(":user",$suppliedUser);
		$q->execute();

		$result = $q->fetch(PDO::FETCH_ASSOC);
		$q->closeCursor();
		$testPass = $suppliedPass.$result['salt'];
		$hashedTestPass = hash('sha512',$testPass);

	if($hashedTestPass === $result['pass']){
			$_SESSION['secure'] = $result['salt'];
			queryRedirect('list',$result['ID']);
		}else{

			queryRedirect('index','error');
		}

}
 ?>
