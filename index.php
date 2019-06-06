<?php
  require('config.php');
  //set title and description for page
  $title          = 'home';
  $description    = 'description for page';
  $pageLoader     = false;
  $hasForm        = false;
  //for login use only
  $restrictedPage = false;
  $adminOnly      = false;

  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
?>

<!-- START -->
<div class="page-wrap grid-x" style="height:90vh;">
  <div class="cell small-12">
    <h3>Home</h3>
    <p>This is home<i class="fa fa-smile-o"></i></p>
  </div>

</div>
<!-- END -->

<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
