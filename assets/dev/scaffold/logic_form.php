<?php
//Form session logic for timeout
if($hasForm){
  if(isset($_SESSION['formLoadTime'])){
    unset($_SESSION['formLoadTime']);
    $_SESSION['formLoadTime'] = time();
  }else{
    $_SESSION['formLoadTime'] = time();
  }
}elseif(!$hasForm){
  if(isset($_SESSION['formLoadTime'])){
    unset($_SESSION['formLoadTime']);
  }
}

 ?>
