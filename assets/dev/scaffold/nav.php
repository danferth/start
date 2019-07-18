<!-- a rudamentary navigation -->
<div class="grid-x">
  <div class="cell small-12">
    <nav>
      <ul class="menu">
        <li><a href="index.php">home</a></li>
        <li><a href="form-contact.php">contact</a></li>
        <li><a href="about.php">about</a></li>
        <?php
          if($useDB && $useLogin){
            if(isset($_SESSION['admin']) && $_SESSION['admin'] === 1){
              echo "<li><a href='admin.php'>admin</a></li>";
            }elseif(isset($_SESSION['admin']) && $_SESSION['admin'] === 0){
              echo "<li><a href='profile.php'>profile</a></li>";
            }
            if(isset($_SESSION['user']) && $_SESSION['user']){
              echo "<li><a href='assets/build/db/_logout.php'>logout</a></li>";
              echo "<li><span class='welcomeMessage'>" . $welcomeMessage . "</span></li>";
              echo "<li><a href='form-quote-entry.php'>quote entry</a></li>";
            }else{
              echo "<li><a href='login.php'>login</a></li>";
            }
          }
         ?>
      </ul>
    </nav>
  </div>
</div>
<?php


consoleDump($_SESSION);
?>
