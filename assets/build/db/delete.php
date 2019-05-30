<?php
session_start();
include "_connection.php";
require_once "db_functions.php";
sessionTimeout();


		$delete = $db->prepare("DELETE FROM table2 WHERE id=:ID;");
		$delete->bindParam(":ID",$_GET['ID']);
		$delete->execute();

		dbClose();

		redirect('list');

 ?>
