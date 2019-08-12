<?php
  require('config.php');
  //set title and description for page
  $title          = 'home';
  $description    = 'Home start page of site';
  $pageLoader     = false;
  $hasForm        = false;
  //for login use only
  $restrictedPage = false;
  $adminOnly      = false;

  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
?>

<!-- START -->
<div class="page-wrap grid-x">
  <div class="cell small-12">
    <h3>Home</h3>
    <p>This is home <i class="fa fa-smile-o"></i></p>
    <p><a class ="button small" href="assets/build/db/_test.php">go to db/_test.php</a> <a class ="button small" href="_test.php">go to /_test.php</a></p>
  </div>



</div>
<!-- END -->

<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
