<?php
$db_name    = 'test';
$db_server  = 'localhost';
$db_user    = 'tester';
$db_pass    = '123456';
// =================================================
$dsn = "mysql:host=".$db_server.";dbname=".$db_name;
$db = new PDO($dsn,$db_user,$db_pass);
?>
