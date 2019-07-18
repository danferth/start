<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$callout = $_POST['callout'];

if($callout === "m"){
  unset($_SESSION['m']);
}

if($callout === "e"){
  unset($_SESSION['e']);
}

 ?>
