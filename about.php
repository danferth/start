<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
  //set title and description for page
  $title          = 'TIC | About';
  $description    = 'About Thomson Instrument Company';
  $pageLoader     = false;
  $hasForm        = false;
  //for login use only
  $restrictedPage = false;
  $adminOnly      = false;

  require_once 'config.php';
  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
?>

<!-- START -->
<div class="page-wrap row">

<div class="col-12">
  <p>this is the about us page. Go nuts!</p>
</div>

</div> <!-- END -->

<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
