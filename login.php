<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
  //set title and description for page
  $title          = 'Quick Order | Login';
  $description    = 'Quick Order login page';
  $pageLoader     = false;
  $hasForm        = true;
  //for login use only
  $restrictedPage = false; //you have to have this false so people can login
  $adminOnly      = false;

  require_once 'config.php';
  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
?>

<!-- START -->
<div class="page-wrap row justify-content-center">

  <div class='loginWrap col-sm-12 col-md-8 col-lg-6 mt-md-5 align-self-center'>
    <div class="card bg-light loginModule">
      <h1 class="h3 card-header border-bottom-0 mb-3 bg-primary text-white d-flex justify-content-end">Log In</h1>
      <div class="card-body">
    <form id='formLogin' action='assets/build/db/_login.php' method='POST'>
      <div class='row no-gutters'>
        <div class='col-sm-12'>
          <div class='form-group'>
            <input class='form-control' type='email' name='user' placeholder='username (email)' required>
          </div>
          <div class='form-group'>
            <input class='form-control' type='password' name='pass' pattern='<?php echo $passwordRegEx; ?>' placeholder='password' required>
          </div>
        </div>
        <div class='col-sm-12'>
          <button class='btn btn-block btn-primary' type='submit' name='submit'><i class='fa fa-user-circle'></i></button>
        </div>
      </div>
  </form>
  </div>
  <div class='card-footer border-top-0 bg-transparent pt-0 text-right'><small class='form-text'><a href='form-reset-password.php'>Forgot your password?</a> | <a href='form-contact.php'>Want an account?</a></small></div>
  </div>
  </div>
</div>


<!-- END -->
<script type="text/javascript">
  //you have to set hasForm as a class to the body
  document.body.className += " "+"hasForm";
  var formID = 'formLogin';
</script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
