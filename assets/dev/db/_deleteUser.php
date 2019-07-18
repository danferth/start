<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../../../config.php';
//check if admin
if($_SESSION['admin'] == 1){

  if(isset($_POST['userID'])){
    $userID = filter_var($_POST['userID'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);

      //check for user
      $cq = $db->prepare("SELECT * FROM users WHERE ID=:userID");
      $cq->bindParam("userID", $userID);
      $cq->execute();
      $checkResult = $cq->fetch(PDO::FETCH_ASSOC);
      $checkCount = $cq->rowCount();
      $userToDelete = $checkResult['user'];
      $cq->closeCursor();

    if($checkCount > 0){
      $deletQuery = "DELETE from users WHERE ID=".$userID;
      $dq = $db->prepare($deletQuery);
      $dq->execute();
      $dq->closeCursor();
      echo "user ".$userToDelete." has been deleted!";
    }
  }
}

 ?>
