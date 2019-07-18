<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../../../config.php';

echo "QUOTE ENTRY<br/><br/><br/>";

//******************************************************************************
//******************************************************************************
//**********************************START HERE**********************************
//******************************************************************************
//******************************************************************************

//is post set and is quoteNUM not blank
if(isset($_POST['quoteNUM']) && $_POST['quoteNUM'] != ""){

  //lets sanitize the $_POST
  $quoteNUM = filter_var($_POST['quoteNUM'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);

  //check for $_SESSION['quoteNUM']
  if(isset($_SESSION['quoteNUM'])){
    sessionRedirect('form-quote-entry','e', 'alreadyHaveQuoteNUM');
  }else{
    //set $_SESSION var
    $_SESSION['quoteNUM'] = $quoteNUM;
  }

//we have the quote number and customer ID in a session variable and can now connect to Acumatica for quote retrival.









}else{
  //post not set OR quoteNUM is blank
  redirect('form-quote-entry');
}
?>
