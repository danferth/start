<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
  //set title and description for page
  $title          = 'TIC | Quick Order';
  $description    = 'Home start page of site';
  $pageLoader     = true;
  $hasForm        = true;
  //for login use only
  $restrictedPage = false;
  $adminOnly      = false;

  require_once 'config.php';
  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
?>

<!-- START -->
<div class="jumbotron jumbotron-fluid bg-dark">
  <div class="container">
    <div class="row">
      <div class="col-8 ">
        <h1 class="display-4 text-white">Fast. Easy. Secure.</h1>
        <p class="lead text-white">Get Ready to Start Your Next Project</p>
        <hr class="my-4">
        <p class='text-white'>See the readme for more info</p>
        <a class="btn btn-warning text-black btn-lg" href="/" role="button">Do Something Grand</a>
      </div>
    </div>
  </div>
</div>

<div class="page-wrap row">
  <?php

  //if user is loged in
if(isset($_SESSION['secure'])){
  if($_SESSION['admin'] === 0){
    echo "<div class='index-card col-sm-12 mb-sm-3 mb-md-0 col-md-4 order-sm-1 order-md-2 mb-3 md-sm-0'>";
    echo "  <div class='card h-100 text-white bg-dark'>";
    echo "    <h1 class='h3 card-title card-header'>View Profile</h1>";
    echo "    <div class='card-body'>";
    echo "      <p class='card-text'>";
    echo "        View and edit your profile.";
    echo "      </p>";
    echo "    </div>";
    echo "    <div class='card-footer bg-transparent border-top-0'>";
    echo "      <a class='btn btn-block btn-info buttonLoader' href='profile.php'>Veiw <i class='fa fa-user-circle text-warning'></i> Profile</a>";
    echo "    </div>";
    echo "  </div>";
    echo "</div>";

    echo "<div class='index-card col-sm-12 mb-sm-3 mb-md-0 col-md-4 order-sm-2 order-md-1 mb-3 md-sm-0'>";
    echo "  <div class='card h-100 text-white bg-dark'>";
    echo "    <form id='' class='simpleFormWrap' action='/' method='post'>";
    echo "      <h1 class='h3 card-title card-header bg-black'>Module</h1>";
    echo "      <div class='card-body'>";
    echo "        <p class='card-text'>";
    echo "          This module does something but the developer hasn't figured it out yet";
    echo "        </p>";
    echo "        <input class='lineInput form-control simpleFormTrigger' id='' type='text' name='' placeholder='under construction'/>";
    echo "        <small>Got a question? <a class='text-warning' href='form-contact.php'>Contact us</a></small>";
    echo "      </div>";
    echo "      <div class='card-footer simpleFormTarget bg-transparent border-top-0'>";
    echo "        <button class='btn btn-info btn-block buttonLoader' type='submit'>Start <i class='d-none fa fa-hand-peace-o text-warning animated faster zoomIn'></i> Order</button>";
    echo "      </div>";
    echo "    </form>";
    echo "  </div>";
    echo "</div>";

    echo "<div class='index-card col-sm-12 col-md-4 order-sm-3 order-md-3'>";
    echo "  <div class='card h-100 text-white bg-dark'>";
    echo "    <form id='' class='simpleFormWrap' action='/' method='post'>";
    echo "      <h1 class='h3 card-title card-header'>Module</h1>";
    echo "      <div class='card-body'>";
    echo "        <p class='card-text'>";
    echo "          This module does something but the developer hasn't figured it out yet";
    echo "        </p>";
    echo "        <input class='lineInput form-control simpleFormTrigger' id='' type='text' name='' placeholder='under construction'/>";
    echo "        <small>Got a question? <a class='text-warning'  href='form-contact.php'>Contact us</a></small>";
    echo "      </div>";
    echo "      <div class='card-footer simpleFormTarget bg-transparent border-top-0'>";
    echo "        <button class='btn btn-info btn-block buttonLoader' type='submit'>Check <i class='d-none fa fa-hand-peace-o text-warning animated faster zoomIn'></i> Status</button>";
    echo "      </div>";
    echo "    </form>";
    echo "  </div>";
    echo "</div>";

  }
  //user is logged in and user is admin
  if($_SESSION['admin'] === 1){
    echo "<div class='col-sm-12 col-md-8 col-lg-6 col-xl-4 offset-md-2 offset-lg-3 offset-xl-4'>";
    echo "<div class='card bg-dark text-white'>";
    echo "<h1 class='h4 card-header'>Admin</h1>";
    echo "<div class='card-body'>";
    echo "<p class='card-text'>Add or remove users and view user profiles.</p>";
    echo "<a class='btn btn-warning text-black btn-block' href='admin.php'><i class='fa fa-group'></i></a>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
  }
  //else no one is loged in show this
}else{
  echo "<div class='col-sm-12 col-lg-7 order-2 order-lg-1'>";
  echo "  <h1>This is START</h1>";
  echo "  <p>A framework to start a site from simple to complex. Out of the box it is ready for setting up a site with admin and user login.</p>";
  echo "</div>";

  echo "<div class='col-sm-12 col-lg-5 align-self-center order-1 order-lg-2 mb-3 mb-lg-0'>";
  echo "  <div class='card bg-light loginModule'>";
  echo "    <h3 class='h4 card-header border-bottom-0 mb-3 bg-primary text-white d-flex justify-content-end'>Log In</h3>";
  echo "    <div class='card-body'>";
  echo "      <form id='formLogin' action='assets/build/db/_login.php' method='POST'>";
  echo "        <div class='row no-gutters'>";
  echo "          <div class='col-sm-12'>";
  echo "          <div class='form-group'>";
  echo "            <input class='form-control' type='email' name='user' placeholder='username (email)' required>";
  echo "          </div>";
  echo "          <div class='form-group'>";
  echo "            <input class='form-control' type='password' name='pass' pattern='".$passwordRegEx."' placeholder='password' required>";
  echo "          </div>";
  echo "          </div>";
  echo "          <div class='col-sm-12'>";
  echo "            <button class='btn btn-block btn-primary' type='submit' name='submit'><i class='fa fa-user-circle'></i></button>";
  echo "          </div>";
  echo "        </div>";
  echo "      </form>";
  echo "    </div>";
  echo "    <div class='card-footer border-top-0 bg-transparent pt-0 text-right'><small class='form-text'><a href='form-reset-password.php'>Forgot your password?</a> | <a href='form-contact.php'>Want an account?</a></small></div>";
  echo "  </div>";
  echo "</div>";
}

 ?>




</div>
<!-- END -->
<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
