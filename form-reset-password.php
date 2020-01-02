<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
  //set title and description for page
  $title          = 'Password | Reset';
  $description    = 'Request password reset';
  $pageLoader     = false;
  $hasForm        = true;
  //for login use only
  $restrictedPage = false;
  $adminOnly      = false;

  require_once 'config.php';
  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';

?>

<div class="page-wrap row justify-content-center">
  <div class="col-sm-12 col-md-8 col-lg-6">
    <div class="card">
      <h1 class='h3 card-title card-header bg-info text-white'>Reset Password Request</h1>
      <div class="card-body">
    <form id='formResetPassword' class='' action='assets/build/db/_reset_password.php' method='post'>
        <div class="form-group">
          <p>Provide your username <i>(email)</i> and we will email you a new temporary password.</p>
          <input class='form-control lineInput' id='email' type='email' name='email' placeholder='username (email)' required/>
        </div>
        <div class="form-group">
          <button class='btn btn-primary btn-block buttonLoader' type='submit' name="submit">Reset Password</button>
        </div
    </form>
  </div>
</div>
  </div>
</div>

<script type="text/javascript">
  //you have to set hasForm as a class to the body
  document.body.className += " "+"hasForm";
  var formID = 'formResetPassword';
</script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
