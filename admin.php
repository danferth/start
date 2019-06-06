<?php
  require('config.php');
  //set title and description for page
  $title          = 'Admin';
  $description    = 'description for page';
  $pageLoader     = false;
  $hasForm        = true;
  //for login use only
  $restrictedPage = true;
  $adminOnly      = true;

  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
?>

<!-- START -->
<div class="page-wrap grid-x align-center" style="height:90vh;">
  <div class="cell small-12">
    <h1>Admin</h1>
    <p>Must be admin to see this page<i class="fa fa-smile-o"></i></p>
  </div>

  <div class="cell small-4">
    <h3>Add a user</h3>
    <form class="" action="assets/build/db/_adduser.php" method="post">
      <input type="text" name="username" placeholder="user name" required>
      <input type="text" name="password" placeholder="password" required>
      <input type="text" name="passwordConfirm" placeholder="confirm password" required>
      <label for="isAdmin">Will user have Admin privileges? <input id="isAdmin" type="checkbox" name="isAdmin"></label>
      <input class="button" type="submit" name="submit" value="Add User">
    </form>
  </div>

</div>
<!-- END -->

<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
