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
        <link rel="apple-touch-icon" sizes="180x180" href="/assets/build/favicons/apple-touch-icon.png?v=3">
        <link rel="icon" type="image/png" sizes="32x32" href="/assets/build/favicons/favicon-32x32.png?v=3">
        <link rel="icon" type="image/png" sizes="16x16" href="/assets/build/favicons/favicon-16x16.png?v=3">
        <link rel="manifest" href="/assets/build/favicons/site.webmanifest">
        <link rel="mask-icon" href="/assets/build/favicons/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="shortcut icon" href="/assets/build/favicons/favicon.ico?v=3">
        <meta name="msapplication-TileColor" content="#d7e8f2">
        <meta name="msapplication-config" content="/assets/build/favicons/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">
        <!-- ***********END FAVICON SETTINGS****************** -->

        <!-- Humans.txt-->
        <link type="text/plain" rel="author" href="/humans.txt">

        <!-- You know what would be cool? some google font action! -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&display=swap" rel="stylesheet"> -->

        <!-- css -->
        <!-- swal2 DARK theme -->
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/themes@2.0.3/dark/dark.min.css" integrity="sha256-1WVqXl+b1LYn/AjKAx4Jg8+p0sdD4UQLzY1JYS6S/lk=" crossorigin="anonymous"> -->
        <!-- swal2 borderless theme -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/themes@2.0.3/borderless/borderless.min.css" integrity="sha256-MOmeQsEYme0ThyBaGh2raVSmFWThv6ZQq7dQo75x0ug=" crossorigin="anonymous">
        <!-- intro.js CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intro.js@2.9.3/introjs.css" integrity="sha256-OYXGS5m4oWZAAqoAKpf7Y3bIdzdd9jBfly/xCavEpGw=" crossorigin="anonymous">
        <!-- intro.js MODERN theme -->
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intro.js@2.9.3/themes/introjs-modern.css" integrity="sha256-YQ16Ch8sowpl0SpkX7M2f/sSi+N+Vocexlp1nPbCTgA=" crossorigin="anonymous"> -->
        <!-- Animate.css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
        <!-- site css files for print and screan -->
        <link rel="stylesheet" href="/assets/build/css/site.css?ver=<?php echo $v; ?>" type="text/css" media="screen, projection" >
        <link rel="stylesheet" href="/assets/build/css/print.css?ver=<?php echo $v; ?>" type="text/css" media="print" >
    </head>
    <body class="no-js">
    <?php
    if(isset($form_success)){
      echo $form_message;
    }
    //need loader
      if($loader){
        echo "<div class='loader'>";
        echo "  <div class='spinner-grow text-warning' role='status'>";
        echo "    <span class='sr-only'>Loading...</span>";
        echo "  </div>";
        echo "</div>";
      }
    ?>
<!-- this containing <div> ends in foot.php -->
<div class="site-container">

<div class="container">

    <!-- Header -->
    <div class="row header p-2">
        <div class="col-sm-12 col-md-5 col-lg-4 col-xl-3">
          <a href='/'>
          SVG Logo Here
        </a>
        </div>

        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-3 offset-md-3 offset-lg-4 offset-xl-6 removeForPrint">
          <div class='welcomeMessage'>
          <?php
            if(isset($_SESSION['user'])){
              echo "<span class='d-sx-inline d-md-block mr-2 mr-md-0'>" . $welcomeMessage . "</span>";
              echo "<span class='d-sx-inline d-md-block'><a href='profile.php'><i class='fa fa-user-circle animated rotateIn'></i></a> <b>|</b> <a href='assets/build/db/_logout.php'>logout</a></span></div>";
            }else{
              echo "<span class='d-sx-inline d-md-block mr-2 mr-md-0'>" . $welcomeMessage . "</span>";
              echo "<span class='d-sx-inline d-md-block'><a href='login.php'>login</a></span></div>";
            }
           ?>
        </div>
    </div>
<!-- nav -->
<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/nav.php'; ?>
<!-- END container from head.php -->
</div>
<!-- this is the cell for the page -->
<div class="container">
