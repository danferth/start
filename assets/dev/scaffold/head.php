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
  }
}
//*************************************
//START login stuffs
if($useDB && $useLogin){
  if($title === 'login'){
    if(isset($_SESSION['user'])){
  	   redirect('index');
     }

   }else{
     if(!isset($_SESSION['secure'])){
       session_destroy();
  	   redirect('login');
     }

      sessionTimeout();
      $_SESSION['timeout'] = time();

      if(!isset($_SESSION['user'])){
  	     $q = $db->prepare("SELECT * FROM users WHERE ID=:id");
  	     $q->bindParam(":id", $_GET['m']);
  	     $q->execute();
  	     $userResult = $q->fetch(PDO::FETCH_ASSOC);

  	     $_SESSION['user'] = $userResult['user'];
  	     $_SESSION['admin'] = $userResult['admin'];
  	     $q->closeCursor();

  	     $welcomeMessage = "<i>Welcome:</i> ". $_SESSION['user'];
        }else{
  	       $welcomeMessage = "<i>Logged in as:</i> ". $_SESSION['user'];
        }
           dbClose();
      }
}
//*************************************
//START $_GET[] mesages

if(!empty($_GET)){
  // 'm' or messages
  if(isset($_GET['m'])){
  	if($_GET['m'] === "newUserSuccess"){
  		$siteMessage = "New user created successfully";
    }
  }

  // 'e' or errors
  if(isset($_GET['e'])){
    if($_GET['e'] === "login-error"){
      $siteError = "Username or Password is Incorrect";
    }
    if($_GET['e'] === "timeout"){
  		$siteError = "Sorry but you have been logged out due to inactivity";
  	}
    if($_GET['e'] === "userAlreadyExists"){
      $siteError = "A user with that username already exist.";
    }
    if($_GET['e'] === "badpass"){
      $siteError = "passwords did not match, try again.";
    }
  }

  //form $_GET[] these set variables in javascript for swal2
  if(isset($_GET['success'])){
    $form_success = $_GET['success'];
    if($form_success === 'true'){
      $form_message = '<script type="text/javascript"> var form_success = "true"; </script>';
    }elseif($form_success === 'false') {
      $form_message = '<script type="text/javascript"> var form_success = "false"; </script>';
    }
  }
}
//*************************************
//START redirects cause, admin only page

if($adminOnly){
  if($_SESSION['admin'] === '0'){
    redirect('index');
  }
}
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
    </head>
    <body class="no-js">
    <?php
    //need loader
      if($GLOBALS['loader']){
        echo "<div class='loader'></div>";
      }
    ?>
<!-- this containing <div> ends in foot.php -->
<div class="grid-container fluid">

    <!-- a rudamentary navigation -->
    <div class="grid-x">
      <div class="cell small-12">
        <nav>
          <ul class="menu">
            <li><a href="index.php">home</a></li>
            <li><a href="form.php">contact</a></li>
            <li><a href="about.php">about</a></li>
            <?php
              if($useDB && $useLogin){
                if($_SESSION['admin'] === "1"){
                  echo "<li><a href='admin.php'>admin</a></li>";
                }elseif($_SESSION['admin'] === '0'){
                  echo "<li><a href='profile.php'>profile</a></li>";
                }
                if($_SESSION['user']){
                  echo "<li><a href='assets/build/db/_logout.php'>logout</a></li>";
                  echo "<li><span class='welcomeMessage'>" . $welcomeMessage . "</span></li>";
                }
              }
             ?>
          </ul>
        </nav>
      </div>
      <?php
        if(isset($siteMessage)){
          echo "<div class='small-12 callout secondary'  data-closable>";
          echo "<button class='close-button' aria-label='Close alert' type='button' data-close>";
          echo "<span aria-hidden='true'>&times;</span>";
          echo "</button>";
          echo "<h5>Message:</h5>";
          echo "<p>" . $siteMessage . "</p>";
          echo "</div>";
        }
        if(isset($siteError)){
          echo "<div class='small-12 callout alert'  data-closable>";
          echo "<button class='close-button' aria-label='Close alert' type='button' data-close>";
          echo "<span aria-hidden='true'>&times;</span>";
          echo "</button>";
          echo "<h5>Message:</h5>";
          echo "<p>" . $siteError . "</p>";
          echo "</div>";
        }
       ?>
    </div>
