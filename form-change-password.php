<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
  //set title and description for page
  $title          = 'Password | Change';
  $description    = 'Change user password';
  $pageLoader     = false;
  $hasForm        = true;
  //for login use only
  $restrictedPage = true;
  $adminOnly      = false;

  require_once 'config.php';
  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/db/_profile.php';

  //variables for password edit
  $_SESSION['original_password'] = $profile['pass'];
?>

<div class="page-wrap row justify-content-center">
  <div class="col-sm-12 col-md-10 col-lg-6">

    <div class="card">
      <h1 class='h3 bg-info text-white card-title card-header passwordCardHeader'>Change Password</h1>
      <div class="card-body">
    <p class='card-text'>Use this form to change your password. You will need your current password to complete this form.</p>
    <form id='formChangePassword' class='formWatch' action='assets/build/db/_change_password.php' method='post'>
      <input type="hidden" name="user" value="<?php echo $_SESSION['user']; ?>">

        <h2 class='h6'>Confirm your current password</h2>
        <div class='form-group'>
          <input class='form-control lineInput' id='currentPassword' type='password' name='currentPassword' placeholder='Current Password' required/>
        </div>

        <h2 class='h6'>Choose a new password</h2>
        <div class='form-group'>
          <input class='form-control lineInput' id='password' type='password' name='password' pattern="<?php echo $passwordRegEx; ?>" placeholder='NEW Password' required/>
        </div>
        <div class='form-group'>
          <input class='form-control lineInput' id='confirmPassword' type='password' name='confirmPassword' pattern="<?php echo $passwordRegEx; ?>" placeholder='Confirm NEW Password' required/>
        </div>

        <ol class='passwordRules'>
          <h3 class='h6'>Create a new password that:</h3>
          <li class='passwordRuleLength'><span>6-12 characters long</span></li>
          <li class='passwordRuleCapital'><span>Includes one capital letter</span></li>
          <li class='passwordRuleLowercase'><span>Includes one lowercase letter</span></li>
          <li class='passwordRuleNumber'><span>Includes one number</span></li>
          <li class='passwordRuleSpecial'><span>Includes one special character</span></li>
        </ol>

      <button class='btn btn-primary btn-block buttonLoader' type='submit' name="submit">Change Password</button>
    </form>
  </div>
  <div class="card-footer">
    <small class='form-text'><b>NOTE:</b> <i>You will be logged out and will have to log back in with your new password</i></small>
  </div>
</div>

  </div>
</div>

<script type="text/javascript">
  //you have to set hasForm as a class to the body
  document.body.className += " "+"hasForm";
  var formID = 'formChangePassword';
</script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
