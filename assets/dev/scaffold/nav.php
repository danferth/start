<!-- a rudamentary navigation -->
<nav class="nav navbar navbar-expand-lg navbar-light removeForPrint border-top border-primary">
  <button class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item"><a class="nav-link" href="/index.php"><i class="fa fa-home"></i></a></li>
      <?php
        if($useDB && $useLogin){
          if(isset($_SESSION['admin']) && $_SESSION['admin'] === 1){
            echo "<li class='nav-item'><a class='nav-link' href='/admin.php'>Admin</a></li>";
            //the below pages or for testing either HTML or PHP idead for the site
            echo "<li class='nav-item'><a class='nav-link' href='/assets/build/db/_test.php'>PHP</a></li>";
            echo "<li class='nav-item'><a class='nav-link' href='/test.php'>HTML</a></li>";
          }
          if(isset($_SESSION['user'])){
            echo "<li class='nav-item'><a class='nav-link' href='/profile.php'>Profile</a></li>";
          }
        }
        ?>
        <li class="nav-item"><a class="nav-link" href="/form-contact.php">Contact</a></li>
        <li class="nav-item"><a class="nav-link" href="/about.php">About</a></li>
    </ul>
  </div>

</nav>
