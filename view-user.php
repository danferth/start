<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
  //set title and description for page
  $title          = 'User | View';
  $description    = 'Admin page for Viewing user accounts';
  $pageLoader     = false;
  $hasForm        = false;
  //for login use only
  $restrictedPage = true;
  $adminOnly      = true;

  require_once 'config.php';
  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
  if(isset($_SESSION['secure'])){
    $userID = $_GET['id'];
    $qry = "SELECT * FROM users WHERE ID=".$userID;
    $q = $db->prepare($qry);
    $q->execute();
    $profile = $q->fetch(PDO::FETCH_ASSOC);
    $q->closeCursor();
  }
?>

<!-- START -->
<div class="page-wrap row">
  <div class="col-sm-12">
    <h1><i class="fa fa-user-circle-o text-primary"></i> <?php echo $profile['Fname']; ?>'s Profile</h1>
  </div>

  <div class="admin_user_list col-sm-12 col-md-6 mb-3">
    <div class="card h-100">
    <h2 class='h4 bg-dark text-white card-header'>User Basics</h2>
    <table class="table table-sm table-stripped user-profile">
      <tr>
        <th scope="row">Name</th>
        <td><?php echo $profile['Fname'] . " " . $profile['Lname']; ?></td>
      </tr>
      <tr>
        <th  scope="row">Email</th>
        <td><?php echo $profile['user']; ?></td>
      </tr>
      <tr>
        <th  scope="row">Company</th>
        <td><?php echo $profile['prefShipContact_bizName']; ?></td>
      </tr>
      <tr>
        <th  scope="row">Cust ID</th>
        <td><?php echo $profile['customerID']; ?></td>
      </tr>
      <tr>
        <th  scope="row">Setup?</th>
        <td><?php echo yesno($profile['setupCompletion']); ?></td>
      </tr>
      <tr>
        <th  scope="row">Last Login</th>
        <td><?php echo ($profile['lastLogin']); ?></td>
      </tr>
    </table>

    </div>
  </div>


  <div class="admin_user_list col-sm-12 col-md-6 mb-3">
    <div class="card h-100">
    <h2 class='h4 bg-dark text-white card-header'>Ship To</h2>
    <table class="table table-sm table-stripped user-profile">
      <tr>
        <th  scope="row">Attention</th>
        <td><?php echo $profile['prefShipContact_attn']; ?></td>
      </tr>
      <tr>
        <th  scope="row">Address 1</th>
        <td><?php echo $profile['prefShipTo_address1']; ?></td>
      </tr>
      <tr>
        <th  scope="row">Address 2</th>
        <td><?php echo $profile['prefShipTo_address2']; ?></td>
      </tr>
      <tr>
        <th  scope="row">City</th>
        <td><?php echo $profile['prefShipTo_city']; ?></td>
      </tr>
      <tr>
        <th  scope="row">State</th>
        <td><?php echo $profile['prefShipTo_state']; ?></td>
      </tr>
      <tr>
        <th  scope="row">Zip</th>
        <td><?php echo $profile['prefShipTo_zip']; ?></td>
      </tr>
    </table>

    </div>
  </div>

  <div class="admin_user_list col-sm-12 col-md-6 mb-3">
    <div class="card h-100">
    <h2 class='h4 bg-dark text-white card-header'>Shipping Options</h2>
    <table class="table table-sm table-stripped user-profile">
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
        <th  scope="row">Use Customer UPS</th>
        <td><?php echo yesno($profile['shipOptions_useCustomerAccount']); ?></td>
      </tr>
      <tr>
        <th  scope="row">Customer UPS Acount</th>
        <td><?php echo $profile['shipOptions_customerAccountNumber']; ?></td>
      </tr>
      <tr>
        <th  scope="row">Shipping Method</th>
        <td><?php echo $profile['shipOptions_customerShipperPref']; ?></td>
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
