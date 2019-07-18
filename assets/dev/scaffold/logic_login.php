<?php
// This is the logic involved with logins and useing the site
if($useDB && $useLogin){
  if(isset($_SESSION['secure'])){
    //user is logged in, check timeout and then set timeout
    sessionTimeout();
    $_SESSION['timeout'] = time();
    $welcomeMessage = "<b>" . $_SESSION['name'] . "</b> <i>is logged in!</i>";
    //send to index if trying to go to login
    if($title === 'login'){
      redirect('index');
    }
    //if page is $adminOnly and they are not admin send to index
    if($adminOnly === true){
      if($_SESSION['admin'] === 0){
        redirect('index');
      }
    }

    //User has not set up account yet
    if($_SESSION['setup'] === 0){
      if($_SESSION['verified'] == 0 && $title !== "verify"){
        redirect('verify');
      }
      if($_SESSION['verified'] == 1 && $title !== "Account Setup"){
        redirect('form-setup');
      }
    }
    //user has set up account restrict verify and setup pages
    if($_SESSION['setup'] === 1){
      if($title === 'Account Setup'){
        redirect('index');
      }
      if($title === "verify"){
        redirect('index');
      }
    }

    //reset password set to true
    if(isset($_SESSION['passwordReset'])){
      if($_SESSION['passwordReset'] === 1 && $title !== 'change password'){
        redirect('form-change-password');
      }
    }
  //else NOT logged in
  }elseif(!isset($_SESSION['secure'])){
    $welcomeMessage = "";
    if(isset($_SESSION['timeout'])){
      unset($_SESSION['timeout']);
    }

    //if sit is set to $fullSiteSecure redirect to login
    if($fullSiteSecure){
      if($title !== 'login'){
        redirect('login');
      }
      //not full site but has restricted page
    }elseif(!$fullSiteSecure){
      if($restrictedPage){
        redirect('login');
      }
    }
  }
}


 ?>
