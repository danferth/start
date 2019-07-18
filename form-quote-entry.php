<?php
  require('config.php');
  //set title and description for page
  $title          = 'has form';
  $description    = 'User enters quote';
  $pageLoader     = false;
  $hasForm        = true;
  //for login use only
  $restrictedPage = true;
  $adminOnly      = false;

  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
?>

<div class="page-wrap grid-x align-center align-middle" style="height:90vh;">
  <div class="cell small-12 medium-6">
    <form id='formQuoteEntry' class='' action='assets/build/db/_quote_entry.php' method='post'>
      <!-- A honey pot will be added here in all forms with js and then hidden.-->
      <input id='quoteNUM' type='text' name='quoteNUM' placeholder='Quote #' required/>
      <input class='button' type='submit' value='Retrieve Quote'/>
    </form>
  </div>
</div>

<script type="text/javascript">
  //you have to set hasForm as a class to the body
  document.body.className += " "+"hasForm";
  var formID = 'formQuoteEntry';
</script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
