<?php
  require('config.php');
  //set title and description for page
  $title        = 'about';
  $description  = 'description for page';
  $pageLoader   = false;
  $hasForm      = false;
  $adminOnly    = false;
  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
?>

<!-- START -->
<div class="page-wrap grid-x">
  <div class="cell small-12">
    <h1>About</h1>
    <p>About this site<i class="fa fa-smile-o"></i></p>
  </div>


</div>
<!-- END -->

<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
