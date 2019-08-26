<?php
  require('config.php');
  //set title and description for page
  $title          = 'looming site';
  $description    = 'General contact page';
  $pageLoader     = false;
  $hasForm        = true;
  //for login use only
  $restrictedPage = false;
  $adminOnly      = false;

  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
  dump($_SESSION);
?>



<div class="looming grid-x grid-margin-x">


<div class="hero-image cell small-12">
  <img src="assets/build/images/looming.jpg" alt="">
</div>

<div class="cell small-12">
  <h1>Something Awesome is Looming</h1>
</div>

<div class="cell small-12">
  <form id='formLooming' class='' action='assets/build/forms/submit-looming.php' method='post'>
  <div class="grid-x grid-padding-x">

      <div class="cell small-12 medium-6 large-4 xlarge-3">
        <!-- A honey pot will be added here in all forms with js and then hidden.-->
        <input id='fname' type='text' name='fname' placeholder='first name' required/>
      </div>

      <div class="cell small-12 medium-6 large-4 xlarge-3">
        <input id='lname' type='text' name='lname' placeholder='last name' required/>
      </div>

      <div class="cell small-12 medium-12 large-4 xlarge-4">
        <input id='email' type='email' name='email' placeholder='email' required/>
      </div>

      <div class="cell small-12 medium-12 large-6 large-offset-3 xlarge-2 xlarge-offset-0">
        <input class='button expanded' type='submit' value='submit'/>
      </div>

  </div>
</form>
</div>

<div class="cell small-12">

<p>Something awesome is looming on the interwebs and you definitely want to be part of it!  Submit your name and email and we will make sure you're on the list to be the first to know what it's al about!</p>

</div>


</div>







<script type="text/javascript">
  //you have to set hasForm as a class to the body
  document.body.className += " "+"hasForm";
  var formID = 'formLooming';
</script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
