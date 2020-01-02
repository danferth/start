<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
  //set title and description for page
  $title          = 'test';
  $description    = 'test page';
  $pageLoader     = true;
  $hasForm        = false;
  //for login use only
  $restrictedPage = false;
  $adminOnly      = false;

  require_once 'config.php';
  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
?>

<!-- START -->

 <div class='page-wrap row'>







  </div>
<!-- END -->
<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>

<script type='text/javascript'>



</script>
