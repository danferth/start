<?php
  require('config.php');
  //set title and description for page
  $title          = 'reset password';
  $description    = 'User forgot password and request reset';
  $pageLoader     = false;
  $hasForm        = true;
  //for login use only
  $restrictedPage = false;
  $adminOnly      = false;

  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';

?>

<div class="page-wrap grid-x align-center align-middle">
  <div class="cell small-12 medium-4">
    <form id='formResetPassword' class='' action='assets/build/db/_reset_password.php' method='post'>
      <!-- A honey pot will be added here in all forms with js and then hidden.-->
        <p>Provide your username <i>(email)</i> and we will email you a new temporary password.</p>
        <input id='email' type='email' name='email' placeholder='username (email)' required/>
      <input class='button expanded' type='submit' name="submit" value='reset password'/>
    </form>
  </div>
</div>

<script type="text/javascript">
  //you have to set hasForm as a class to the body
  document.body.className += " "+"hasForm";
  var formID = 'formResetPassword';
</script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
