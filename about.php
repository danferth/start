<?php
  require('config.php');
  //set title and description for page
  $title          = 'about';
  $description    = 'description for page';
  $pageLoader     = false;
  $hasForm        = false;
  //for login use only
  $restrictedPage = true;
  $adminOnly      = false;

  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
?>

<!-- START -->
<div class="page-wrap grid-x" style="height:90vh;">
  <div class="cell small-12">
    <h3>About</h3>
    <p>About this site<i class="fa fa-smile-o"></i></p>
    <p>This page is also set to be restricted so you would have to have logged in to see it</p>
  </div>


</div>
<!-- END -->

<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
