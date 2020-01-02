<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
  //set title and description for page
  $title          = 'Profile | Verify';
  $description    = 'User email verification page';
  $pageLoader     = false;
  $hasForm        = true;
  //for login use only
  $restrictedPage = true;
  $adminOnly      = false;

  require_once 'config.php';
  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
?>

<!-- START -->
<div class="page-wrap row justify-content-center">

  <div class="col-sm-12 col-md-8 col-lg-6 col-xl-4">
    <div class="card">
      <h1 class="h3 bg-primary text-white card-title card-header">Verification</h1>
      <div class="card-body">
    <p class='card-text'>Since this is your first time logging in, we will need to verify your email.</p>
    <p>Click below and a verification link will be sent to the email we have on file.</p>
    <form id="formVerify" class="" action="/assets/build/forms/request-verification.php" method="post">
      <input type="hidden" name="requestVerification" value="<?php echo $_SESSION['user']; ?>">
      <div class="form-group">
        <button type="submit" class="btn btn-success text-black btn-block buttonLoader" name="submit">Request Verification</button>
      </div>
    </form>
  </div>
  </div>
</div>



</div>
<!-- END -->
<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
