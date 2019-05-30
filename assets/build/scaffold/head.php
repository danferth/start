<?php
//start a session if one isn't started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//*************************************
//START form stuffs

//set $hasForm to true before on any page that contains a form
if($hasForm){
  if(isset($_SESSION['formLoadTime'])){
    unset($_SESSION['formLoadTime']);
    $_SESSION['formLoadTime'] = time();
  }else{
    $_SESSION['formLoadTime'] = time();
  };
  //grab the get from parse file
  if(empty($_GET)){
    $rand_str1 = substr(md5(rand()), 0, 7);
    $rand_str2 = substr(md5(rand()), 0, 7);
  }else{
    $first_name = $_GET['first_name'];
    $form_success = $_GET['success'];
  }
}
//END form stuffs
//*************************************
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $GLOBALS['title']; ?></title>
        <meta name="description" content="<?php echo $GLOBALS['description']; ?>">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="msapplication-tap-highlight" content="no" />

        <!-- ***********FAVICON SETTINGS****************** -->
        <!-- generated with the heros at https://realfavicongenerator.net/ -->
        <link rel="apple-touch-icon" sizes="180x180" href="/assets/build/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/assets/build/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/assets/build/favicons/favicon-16x16.png">
        <link rel="manifest" href="/assets/build/favicons/site.webmanifest">
        <link rel="mask-icon" href="/assets/build/favicons/safari-pinned-tab.svg" color="#e5b02a">
        <link rel="shortcut icon" href="/assets/build/favicons/favicon.ico">
        <meta name="msapplication-TileColor" content="#ffc40d">
        <meta name="msapplication-config" content="/assets/build/favicons/browserconfig.xml">
        <meta name="theme-color" content="#f8ebc9">
        <!-- ***********END FAVICON SETTINGS****************** -->

        <!-- Humans.txt-->
        <link type="text/plain" rel="author" href="/humans.txt">

        <!-- You know what would be cool? some google font action! -->
        <!-- Well..... we're waiting on the fonts bruh -->

        <!-- css -->
        <link rel="stylesheet" href="/assets/build/css/site.css?ver=<?php echo $GLOBALS['v']; ?>">
        <?php
					if(isset($_GET['success'])){
						echo ("<script type='text/javascript'> var form_success = '" . $form_success . "'; </script>");
					}else{
						echo ("<script type='text/javascript'> var form_success = 'noForm'; </script>");
					}
				?>
    </head>
    <body class="no-js">
    <?php
    //need loader
      if($GLOBALS['loader']){
        echo "<div class='loader'></div>";
      }
    ?>
