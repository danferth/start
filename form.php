<?php
  require('config.php');
  //set title and description for page
  $title          = 'has form';
  $description    = 'description for page';
  $pageLoader     = false;
  $hasForm        = true;
  //for login use only
  $restrictedPage = false;
  $adminOnly      = false;

  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
?>

<div class="page-wrap grid-x align-center align-middle" style="height:90vh;">
  <div class="cell small-12 medium-6">
    <form id='contactform' class='first_contact' action='assets/build/forms/submit.php' method='post'>
      <input class='animated fadeIn' id='fname' type='text' name='fname' placeholder='first name'/>
      <input class='animated fadeIn' id='lname' type='text' name='lname' placeholder='last name'/>
      <input class='animated fadeIn' id='email' type='email' name='email' placeholder='email'/>

      <input class='button' type='submit' value='submit'/>
    </form>
  </div>
</div>

<script type="text/javascript">
  //you have to set hasForm as a class to the body
  document.body.className += " "+"hasForm";
</script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
