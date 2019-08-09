<?php
  require('config.php');
  //set title and description for page
  $title          = 'login';
  $description    = 'Users can login to site with email and password';
  $pageLoader     = false;
  $hasForm        = true;
  //for login use only
  $restrictedPage = false; //you have to have this false so people can login
  $adminOnly      = false;

  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
?>

<!-- START -->
<div class="page-wrap grid-x align-center align-middle">
  <div class="cell small-12 medium-4">
    <h4>Login Please</h4>
    <form id="formLogin" action="assets/build/db/_login.php" method="POST">
    	<input type="text" name="user" placeholder="username (email)" required>
    	<input type="password" name="pass" placeholder="password" required>
    	<input class="button expanded" type="submit" name="submit" value="Enter">
      <p><a href="form-reset-password.php">forgot your password?</a></p>

    </form>
  </div>
</div>
<!-- END -->
<script type="text/javascript">
  //you have to set hasForm as a class to the body
  document.body.className += " "+"hasForm";
  var formID = "formLogin";
</script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
