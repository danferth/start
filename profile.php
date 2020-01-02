<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
  //set title and description for page
  $title          = 'Profile | View';
  $description    = 'View user profile';
  $pageLoader     = false;
  $hasForm        = false;
  //for login use only
  $restrictedPage = true;
  $adminOnly      = false;

  require_once 'config.php';
  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';

  if(isset($_SESSION['secure'])){
    $userID = $_SESSION['userID'];

    $qry = "SELECT * FROM users WHERE ID=".$userID;
    $q = $db->prepare($qry);
    $q->execute();
    $profile = $q->fetch();
    $q->closeCursor();
  }
?>

<!-- START -->
<div class="page-wrap row">
  <div class="col-sm-12 mb-sm-1 mb-md-3">
    <h1><i class="fa fa-user-circle-o text-primary"></i> <?php echo $profile['Fname']; ?>'s Profile</h1>
    <small><b><i class='fa fa-sign-in text-success'></i> Last Login:</b> <?php echo ($profile['lastLogin']); ?></small>
    <small class='d-block'>
      <a href="form-edit-profile.php" id="changeProfile" name="changeProfile">edit profile</a> |
      <a href="form-change-password.php" id="changePassword" name="changePassword">change password</a>
    </small>
  </div>



  <div class="admin_user_list col-sm-12 col-md-5 col-lg-7 my-3 my-md-0">
    <div class="card h-100">
      <h2 class='h4 bg-info text-white card-title card-header'>Contact</h2>
    <table class="user-profile table table-sm">
      <tr>
        <th  scope="row"><span class='d-none d-lg-block'>Name</span><i class='fa fa-user d-lg-none'></i></th>
        <td><?php echo $profile['Fname'] . " " . $profile['Lname']; ?></td>
      </tr>
      <tr>
        <th  scope="row"><span class='d-none d-lg-block'>Company</span><i class='fa fa-building d-lg-none'></i></th>
        <td><?php echo $profile['prefShipContact_bizName']; ?></td>
      </tr>
      <tr>
        <tr>
          <th  scope="row"><span class='d-none d-lg-block'>Ship To</span><i class='fa fa-map-marker d-lg-none'></i></th>
          <td>
            <?php echo $profile['prefShipContact_attn']; ?><br/>
            <?php echo $profile['prefShipTo_address1']; ?><br/>
            <?php if($profile['prefShipTo_address2'] !== ""){echo $profile['prefShipTo_address2']."<br/>";} ?>
            <?php echo $profile['prefShipTo_city'] . ", " . $profile['prefShipTo_state'] . " " . $profile['prefShipTo_zip']; ?>
          </td>
        </tr>
        <th  scope="row"><span class='d-none d-lg-block'>Phone</span><i class='fa fa-phone d-lg-none'></i></th>
        <?php
          $phone = $profile['prefShipContact_phone'];
          if(isset($profile['prefShipContact_ext']) && $profile['prefShipContact_ext'] != ""){
            $phone .= " ext." . $profile['prefShipContact_ext'];
          }
         ?>
        <td><?php echo $phone; ?></td>
      </tr>
      <tr>
        <th  scope="row"><span class='d-none d-lg-block'>Email</span><i class='fa fa-envelope d-lg-none'></i></th>
        <td><?php echo $profile['user']; ?></td>
      </tr>
    </table>
</div>
  </div>



  <div class="admin_user_list col-sm-12 col-md-7 col-lg-5">
    <div class="card h-100">
      <h2 class='h4 bg-info text-white card-title card-header'>Shipping Options</h2>
    <table class="user-profile table table-sm">
      <tr>
        <th  scope="row">Residential Delivery</th>
        <td><?php echo yesno($profile['shipOptions_residentialDelivery']); ?></td>
      </tr>
      <tr>
        <th  scope="row">Saturday Delivery</th>
        <td><?php echo yesno($profile['shipOptions_saturdayDelivery']); ?></td>
      </tr>
      <tr>
        <th  scope="row">Shipping Insurance</th>
        <td><?php echo yesno($profile['shipOptions_insurance']); ?></td>
      </tr>
      <tr>
        <th  scope="row">Use Customer UPS Account</th>
        <td><?php echo yesno($profile['shipOptions_useCustomerAccount']);
            if($profile['shipOptions_useCustomerAccount'] == 1){
              echo " (# " . $profile['shipOptions_customerAccountNumber'] . ")";
            }
        ?></td>
      </tr>
      <tr>
        <th  scope="row">Shipping Method</th>
        <td><?php
           if($profile['shipOptions_customerShipperPref'] == "UPSGRND"){
             $shipOptions_customerShipperPref = "Ground (5-10 days)";
           }
           elseif($profile['shipOptions_customerShipperPref'] == "UPS3DAYSEL"){
             $shipOptions_customerShipperPref = "3-Day (3 days)";
           }
           elseif($profile['shipOptions_customerShipperPref'] == "UPS2DAY"){
             $shipOptions_customerShipperPref = "2-Day (2 days)";
           }
           elseif($profile['shipOptions_customerShipperPref'] == "UPSNXDAYAIRAM"){
             $shipOptions_customerShipperPref = "Overnight (10:30 next day)";
           }
        echo $shipOptions_customerShipperPref; ?></td>
      </tr>
      <tr>
        <th  scope="row">Notes:</th>
        <td><?php echo $profile['prefShipTo_notes']; ?></td>
      </tr>
    </table>
</div>
  </div>



</div>
<!-- END -->

<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
