<?php
$dsn = "mysql:host=".$db_server.";dbname=".$db_name;

$dbOptions = [
  PDO::ATTR_ERRMODE             => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES    => false
];

try{
  $db = new PDO($dsn, $db_user, $db_pass, $dbOptions);
} catch(PDOException $e){
  throw new PDOException($e->getMessage(), (int)$e->getCode());
}
?>
