<?php
if(isset($_SESSION['secure'])){
  $userID = $_SESSION['userID'];
  $qry = "SELECT * FROM users WHERE ID=".$userID;
  $q = $db->prepare($qry);
  $q->execute();
  $profile = $q->fetch(PDO::FETCH_ASSOC);
  $q->closeCursor();
}
?>
