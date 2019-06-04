<?php
session_start();
include '_connection.php';
include '../../../functions.php';
echo "current session:<br/>";
dump($_SESSION);
echo "destroy session!<br/>";
session_destroy();
echo "current session:<br/>";
dump($_SESSION);

echo "close db";

dbClose();

echo "<a href='" . $siteRoot . "'>back to index<a/>";


/*
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '_connection.php';
include '../../../functions.php';
sessionTimeout();


		$delete = $db->prepare("DELETE FROM table2 WHERE id=:ID;");
		$delete->bindParam(":ID",$_GET['ID']);
		$delete->execute();

		dbClose();

		redirect('list');
*/
 ?>
