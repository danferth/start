<?php
  require('config.php');
  //set title and description for page
  $title          = 'verify';
  $description    = 'to verify customer identity';
  $pageLoader     = false;
  $hasForm        = true;
  //for login use only
  $restrictedPage = true;
  $adminOnly      = false;

  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
?>

<!-- START -->
<div class="page-wrap grid-x align-center align-middle" style="height:90vh;">
  <div class="cell small-12 medium-4">
    <h4>Verification</h4>
    <p>Since this is your first time logging in we will need to verify that it is you that is loggining in.</p>
    <p>Click below and a verification link will be sent to the email we have on file.</p>
    <form id="formVerify" class="" action="/assets/build/forms/request-verification.php" method="post">
      <input type="hidden" name="requestVerification" value="<?php echo $_SESSION['user']; ?>">
      <input type="submit" class="button expanded" name="submit" value="request verification">
    </form>
  </div>
</div>
<!-- END -->
<script type="text/javascript">
  //you have to set hasForm as a class to the body
  document.body.className += " "+"hasForm";
  var formID = 'formVerify';
</script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
