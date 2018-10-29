<?php
  //set title and description for page
  $title        = 'has form';
  $description  = 'description for page';
  $pageLoader   = false;
  $hasForm = true;
  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
?>

<div class="page-wrap">

  <form id='contactform' class='first_contact' action='assets/build/forms/submit.php' method='post'>
    <input class='animated fadeIn' id='fname' type='text' name='fname' placeholder='first name' required/>
    <input class='animated fadeIn' id='lname' type='text' name='lname' placeholder='last name' required/>
    <input class='animated fadeIn' id='email' type='email' name='email' placeholder='email' required/>
    <input type='text' name='your-name925htj' id='your-name925htj' autocomplete='<?php echo $rand_str1; ?>'/>
    <input type='text' name='your-email247htj' id='your-email247htj' autocomplete='<?php echo $rand_str2; ?>'/>
    <input class='animated fadeIn' type='submit' value='submit'/>
  </form>
</div>

<script type="text/javascript">
  document.body.className += " "+"hasForm";
</script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>