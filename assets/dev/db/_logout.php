<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../../../config.php';

session_unset();
session_destroy();

redirect('index');



 ?>
