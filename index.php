<?php
  require('config.php');
  //set title and description for page
  $title        = 'home';
  $description  = 'description for page';
  $pageLoader   = false;
  $hasForm      = false;
  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
?>

<!-- START -->
<div class="page-wrap grid-x">
  <div class="cell small-12">
    <h1>start</h1>
    <p>This is in a page wrap<i class="fa fa-smile-o"></i></p>
  </div>
  <?php

    if($useDB && $useLogin){
      echo '<div class="cell small-12">';
      echo '<a href="assets/build/db/_logout.php">logout</a>';
      echo '</div>';
    }


   ?>

</div>
<!-- END -->

<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
