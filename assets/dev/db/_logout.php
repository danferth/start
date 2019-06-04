<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '_connection.php';
include '../../../functions.php';

session_unset();
session_destroy();

redirect('index');



 ?>
