<?php
  require('config.php');
  //set title and description for page
  $title          = 'change password';
  $description    = 'Users can change password with this page';
  $pageLoader     = false;
  $hasForm        = true;
  //for login use only
  $restrictedPage = true;
  $adminOnly      = false;

  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/db/_profile.php';

  //variables for password edit
  $_SESSION['original_password'] = $profile['pass'];
?>

<div class="page-wrap grid-x align-center align-middle" >
  <div class="cell small-12 medium-6">
    <p>Use this form to change your password. You will need your current password to complete this form. If you have lost your password please use the contact page to request a password reset.</p>
    <form id='formChangePassword' class='' action='assets/build/db/_change_password.php' method='post'>
      <!-- A honey pot will be added here in all forms with js and then hidden.-->
      <input type="hidden" name="user" value="<?php echo $_SESSION['user']; ?>">
      <fieldset>
        <p>Confirm your current password</p>
        <input id='currentPassword' type='password' name='currentPassword' placeholder='current password' required/>
      </fieldset>

      <fieldset>
        <p>Please choose a new password</p>
        <input id='password' type='password' name='password' placeholder='NEW password' required/>
        <input id='confirmPassword' type='password' name='confirmPassword' placeholder='confirm NEW Password' required/>
      </fieldset>
      <p><b>NOTE:</b> <i>You will be logged out and will have to log back in with your new password</i></p>
      <input class='button' type='submit' name="submit" value='change password'/>
    </form>
  </div>
</div>

<script type="text/javascript">
  //you have to set hasForm as a class to the body
  document.body.className += " "+"hasForm";
  var formID = 'formChangePassword';
</script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
