<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../../../config.php';

echo "you are on the page for db tests<br/><br/><br/>";
//******************************************************************************
//******************************************************************************
//**********************************START HERE**********************************
//******************************************************************************
//******************************************************************************

$q = $db->query("SELECT * FROM users");
foreach($q as $user){
  echo $user['Fname']." ".$user['Lname']."<br/>";
}
$q->closeCursor();

$q = $db->prepare("SELECT Fname FROM users WHERE setupCompletion=:setupCompletion");
$q->execute(["setupCompletion" => 0]);

$rslt = $q->fetchAll();

dump($rslt);
$q->closeCursor();
echo "<br/><br/>";

$q = $db->query("SELECT Fname FROM users");
$rslt = $q->fetchAll();
dump($rslt);




echo "<br/><br/><br/>Done";




 ?>
