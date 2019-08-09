<?php
  require('config.php');
  //set title and description for page
  $title          = 'has form';
  $description    = 'General contact page';
  $pageLoader     = false;
  $hasForm        = true;
  //for login use only
  $restrictedPage = false;
  $adminOnly      = false;

  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
?>

<div class="page-wrap grid-x align-center align-middle">
  <div class="cell small-12 medium-6">
    <form id='formContact' class='first_contact' action='assets/build/forms/submit-contact.php' method='post'>
      <!-- A honey pot will be added here in all forms with js and then hidden.-->
      <input id='fname' type='text' name='fname' placeholder='first name' required/>
      <input id='lname' type='text' name='lname' placeholder='last name' required/>
      <input id='email' type='email' name='email' placeholder='email' required/>
      <input type="text" name="company" placeholder="company" required>
      <textarea name="message" rows="8" cols="80" placeholder="message:" required></textarea>
      <input class='button' type='submit' value='submit'/>
    </form>
  </div>
</div>

<script type="text/javascript">
  //you have to set hasForm as a class to the body
  document.body.className += " "+"hasForm";
  var formID = 'formContact';
</script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
