<?php
  require('config.php');
  //set title and description for page
  $title        = 'login';
  $description  = 'description for page';
  $pageLoader   = false;
  $hasForm      = false;
  $adminOnly    = false;
  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
?>

<!-- START -->
<div class="page-wrap grid-x align-center align-middle" style="height:100vh;">
  <div class="cell small-12 medium-4">
    <h4>Login Please</h4>
    <form action="assets/build/db/_login.php" method="POST">
    	<input type="text" name="user" placeholder="username" required>
    	<input type="password" name="pass" placeholder="password" required>
    	<p><input class="button" type="submit" name="submit" value="Enter"></p>

    </form>
  </div>
</div>
<!-- END -->

<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
