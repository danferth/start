<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
  //set title and description for page
  $title          = 'TIC | Contact';
  $description    = 'General contact page for Quick Order';
  $pageLoader     = true;
  $hasForm        = true;
  //for login use only
  $restrictedPage = false;
  $adminOnly      = false;

  require_once 'config.php';
  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
?>

<div class="page-wrap row">
  <div class="col-12">
    <h1>Contact Us</h1>
  </div>
  <div class="col-sm-12 col-lg-6">

    <form id='formContact' class='first_contact formWatch' action='assets/build/forms/submit-contact.php' method='post'>
    <div class="form-row">

      <div class="form-group col-sm-12 col-md-6">
        <input class='lineInput form-control' id='fname' type='text' name='fname' placeholder='First Name *' required/>
      </div>

      <div class="form-group col-sm-12 col-md-6">
        <input class='lineInput form-control' id='lname' type='text' name='lname' placeholder='Last Name *' required/>
      </div>

      <div class="form-group col-sm-12 col-md-6">
        <input class='lineInput form-control' id='email' type='email' name='email' placeholder='Email *' required/>
      </div>

      <div class="form-group col-sm-12 col-md-6">
        <input class='lineInput form-control' type="text" name="company" placeholder="Company *" required>
      </div>

      <div class="form-group col-sm-12 col-md-12">
        <textarea class='lineInput form-control' name="message" rows="4" cols="80" placeholder="Message *" required></textarea>
      </div>

      <div class="form-group col-sm-12 col-md-6">
        <div class="requestAccount custom-control custom-checkbox">
          <input class='requestAccountTrigger custom-control-input' type='checkbox'id='accountRequest' name='accountRequest'/>
          <label class='custom-control-label' for='accountRequest'>Request Account</label>
        </div>
      </div>

      <div class="form-group col-sm-12 col-md-6">
        <button class='btn btn-primary btn-block buttonLoader' type='submit'>Contact Us</button>
      </div>

  </div>
</form>

  </div>

</div>

<script type="text/javascript">
  //you have to set hasForm as a class to the body
  document.body.className += " "+"hasForm";
  var formID = 'formContact';
</script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
