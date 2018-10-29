<?php
  require('config.php');
  //set title and description for page
  $title        = 'home';
  $description  = 'description for page';
  $pageLoader   = false;
  siteHeader();
?>

<!-- START -->
<div class="page-wrap grid-x">
  <div class="cell small-12">
    <h1>start</h1>
    <p>This is in a page wrap <i class="fa fa-smile-o"></i></p>
  </div>
</div>
<!-- END -->

<?php siteFooter(); ?>