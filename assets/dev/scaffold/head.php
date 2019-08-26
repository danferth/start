<?php
//start a session if one isn't started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//*************************************
// Include the logic end of the site
include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/logic_login.php';
include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/logic_form.php';
include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/logic_callout.php';
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $title; ?></title>
        <meta name="description" content="<?php echo $description; ?>">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="msapplication-tap-highlight" content="no" />

        <!-- ***********FAVICON SETTINGS****************** -->
        <!-- generated with the heros at https://realfavicongenerator.net/ -->
        <link rel="apple-touch-icon" sizes="180x180" href="/assets/build/favicons/apple-touch-icon.png?v=3abc">
        <link rel="icon" type="image/png" sizes="32x32" href="/assets/build/favicons/favicon-32x32.png?v=3abc">
        <link rel="icon" type="image/png" sizes="16x16" href="/assets/build/favicons/favicon-16x16.png?v=3abc">
        <link rel="manifest" href="/assets/build/favicons/site.webmanifest?v=3abc">
        <link rel="mask-icon" href="/assets/build/favicons/safari-pinned-tab.svg?v=3abc" color="#6c996c">
        <link rel="shortcut icon" href="/assets/build/favicons/favicon.ico?v=3abc">
        <meta name="msapplication-TileColor" content="#254366">
        <meta name="msapplication-config" content="/assets/build/favicons/browserconfig.xml?v=3abc">
        <meta name="theme-color" content="#ffffff">
        <!-- ***********END FAVICON SETTINGS****************** -->

        <!-- Humans.txt-->
        <link type="text/plain" rel="author" href="/humans.txt">

        <!-- You know what would be cool? some google font action! -->
        <!-- Well..... we're waiting on the fonts bruh -->

        <!-- css -->
        <link rel="stylesheet" href="/assets/build/css/site.css?ver=<?php echo $v; ?>">
    </head>
    <body class="no-js">
    <?php
    if(isset($form_success)){
      echo $form_message;
    }
    //need loader
      if($GLOBALS['loader']){
        echo "<div class='loader'></div>";
      }
    ?>
<!-- this containing <div> ends in foot.php -->
<div class="grid-container full">

<?php

if($splashPage['status']){
  echo "<!-- No navigation needed as looming set -->";
}else{
  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/nav.php';
}



 ?>
