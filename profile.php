<?php
  require('config.php');
  //set title and description for page
  $title          = 'profile';
  $description    = 'Users can view and edit their profile also users can change password';
  $pageLoader     = false;
  $hasForm        = false;
  //for login use only
  $restrictedPage = true;
  $adminOnly      = false;

  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/db/_profile.php';
  //profile page db

?>

<!-- START -->
<div class="page-wrap grid-x">
  <div class="cell small-12">
    <h3>profile</h3>
    <p>The user profile page<i class="fa fa-smile-o"></i></p>
    <div class="profile">
      <ul>
        <li><b>Name: </b><?php echo $profile['Fname']." ".$profile['Lname'] ?></li>
        <li><b>Email: </b><?php echo $profile['user'] ?></li>
        <li><b>Shipping Contact: </b><?php echo $profile['prefShipContact_attn'] ?></li>
        <li><b>Company: </b><?php echo $profile['prefShipContact_bizName'] ?></li>
        <li><b>Address Line 1: </b><?php echo $profile['prefShipTo_address1'] ?></li>
        <?php
        if($profile['prefShipTo_address2'] != ""){ echo "<li><b>Address Line 2: </b>" . $profile['prefShipTo_address2'] . "</li>";}
        ?>
        <li><b>City: </b><?php echo $profile['prefShipTo_city'] ?></li>
        <li><b>State: </b><?php echo $profile['prefShipTo_state'] ?></li>
        <li><b>Zip Code: </b><?php echo $profile['prefShipTo_zip'] ?></li>
        <li><b>Shipping Notes: </b><?php echo $profile['prefShipTo_notes'] ?></li>
        <li><b>Residential Delivery: </b><?php echo yesno($profile['shipOptions_residentialDelivery']); ?></li>
        <li><b>Saturday Delivery: </b><?php echo yesno($profile['shipOptions_saturdayDelivery']); ?></li>
        <li><b>Insurance: </b><?php echo yesno($profile['shipOptions_insurance']); ?></li>
        <li><b>Use Customer Account: </b><?php echo yesno($profile['shipOptions_useCustomerAccount']); ?></li>
        <?php
          if($profile['shipOptions_useCustomerAccount'] === 1){
            echo "<li><b>Customer Preferred Shipper: </b>".$profile['shipOptions_customerShipperPref']."</li>";
            echo "<li><b>Customer Shipping Account #: </b>".$profile['shipOptions_customerAccountNumber']."</li>";
          }
         ?>

      </ul>
    </div>
    <a href="form-edit-profile.php" class="button" id="changeProfile" name="changeProfile">edit profile</a>
    <a href="form-change-password.php" class="button" id="changePassword" name="changePassword">change password</a>
  </div>

</div>
<!-- END -->

<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
