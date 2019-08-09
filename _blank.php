<?php
  require('config.php');
  //set title and description for page
  $title          = '_blank';
  $description    = 'Use this to start a page';
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


    <!-- This is a blank page. Add content here -->
    <!-- See foundation examples at https://foundation.zurb.com/sites/docs/kitchen-sink.html -->


  </div>
</div>
<!-- END -->

<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
