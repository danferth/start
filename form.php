<?php
  require('config.php');
  //set title and description for page
  $title        = 'has form';
  $description  = 'description for page';
  $pageLoader   = false;
  $hasForm = true;
  siteHeader();
?>

<div class="page-wrap grid-x align-center align-middle" style="height:100vh;">
  <div class="cell small-12 medium-6">
    <form id='contactform' class='first_contact' action='assets/build/forms/submit.php' method='post'>
      <input class='animated fadeIn' id='fname' type='text' name='fname' placeholder='first name' required/>
      <input class='animated fadeIn' id='lname' type='text' name='lname' placeholder='last name' required/>
      <input class='animated fadeIn' id='email' type='email' name='email' placeholder='email' required/>

      <!-- the following two honeypot inputs are hidden first one with js the second with css-->
      <input type='text' name='your-name925htj' id='your-name925htj' autocomplete='<?php echo $rand_str1; ?>'/>
      <input type='text' name='your-email247htj' id='your-email247htj' autocomplete='<?php echo $rand_str2; ?>'/>

      <input class='button' type='submit' value='submit'/>
    </form>
  </div>
</div>

<script type="text/javascript">
  document.body.className += " "+"hasForm";
</script>
<?php siteFooter(); ?>
