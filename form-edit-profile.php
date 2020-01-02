<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
  //set title and description for page
  $title          = 'Profile | Edit';
  $description    = 'Edit user profile';
  $pageLoader     = false;
  $hasForm        = true;
  //for login use only
  $restrictedPage = true;
  $adminOnly      = false;

  require_once 'config.php';
  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/db/_profile.php';
?>

<div class="page-wrap row" >

  <div class="col-sm-12 col-md-7">
    <h1><i class='fa fa-address-card-o text-primary'></i> Edit Profile</h1>
    <p>Use this form to make any changes to your account profile. These settings will be used when you place an order.</p>
  </div>

<div class="col-sm-12">

  <form id='formEditProfile' class='first_contact' action='assets/build/db/_edit_profile.php' method='post'>
    <input type="hidden" name="user" value="<?php echo $_SESSION['user']; ?>">

    <div class="form-row">

      <div class="col-sm-12 col-md-7 mb-3 mb-md-0">
        <div class="card h-100">
          <h2 class='h4 bg-info text-white card-title card-header'>Contact</h2>
          <div class="card-body">

      <div class="form-row">
      <div class="form-group col-sm-12 col-md-12">
        <input class='form-control lineInput' id='prefShipContact_attn' type='text' name='prefShipContact_attn' placeholder='Shipping Contact' value="<?php echo $profile['prefShipContact_attn']; ?>"/>
        <label  for='prefShipContact_attn'>Shipping Contact</label>
      </div>

      <div class="form-group col-sm-12 col-md-6">
        <input class='form-control lineInput' id='prefShipContact_bizName' type='text' name='prefShipContact_bizName' placeholder='Business Name' value="<?php echo $profile['prefShipContact_bizName']; ?>"/>
        <label  for='prefShipContact_bizName'>Business Name</label>
      </div>

      <div class="form-group col-sm-12 col-md-4">
        <input class='form-control lineInput' id='prefShipContact_phone' type='tel' name='prefShipContact_phone' placeholder='Phone' value="<?php echo $profile['prefShipContact_phone']; ?>"/>
        <label  for='prefShipContact_phone'>Phone</label>
      </div>

      <div class="form-group col-sm-12 col-md-2">
        <input class='form-control lineInput' id='prefShipContact_ext' type='text' name='prefShipContact_ext' placeholder='ext.' value="<?php echo $profile['prefShipContact_ext']; ?>"/>
        <label  for='prefShipContact_ext'>ext.</label>
      </div>

      <div class="form-group col-sm-12 col-md-12">
        <input class='form-control lineInput' id='prefShipTo_address1' type='text' name='prefShipTo_address1' placeholder='Address line 1' value="<?php echo $profile['prefShipTo_address1']; ?>"/>
        <label  for='prefShipTo_address1'>Address line 1</label>
      </div>

      <div class="form-group col-sm-12 col-md-12">
        <input class='form-control lineInput' id='prefShipTo_address2' type='text' name='prefShipTo_address2' placeholder='Address line 2' value="<?php echo $profile['prefShipTo_address2']; ?>"/>
        <label  for='prefShipTo_address2'>Address line 2</label>
      </div>

      <div class="form-group col-sm-7 col-md-6">
        <input class='form-control lineInput' id='prefShipTo_city' type='text' name='prefShipTo_city' placeholder='City' value="<?php echo $profile['prefShipTo_city']; ?>"/>
        <label  for='prefShipTo_city'>City</label>
      </div>

      <div class="form-group col-sm-2 col-md-2">
        <input class='form-control lineInput' id='prefShipTo_state' type='text' name='prefShipTo_state' placeholder='State' maxlength='2' value="<?php echo $profile['prefShipTo_state']; ?>"/>
        <label  for='prefShipTo_state'>State</label>
      </div>

      <div class="form-group col-sm-3 col-md-4">
        <input class='form-control lineInput' id='prefShipTo_zip' type='text' name='prefShipTo_zip' placeholder='Zip code' value="<?php echo $profile['prefShipTo_zip']; ?>"/>
        <label  for='prefShipTo_zip'>Zip code</label>
      </div>

      </div>
    </div>
  </div>
    </div>





  <div class="col-sm-12 col-md-5 mb-3 mb-md-0">
<div class="card h-100">
  <h2 class='h4 bg-info text-white card-title card-header'>Options</h2>
  <div class="card-body">
    <div class='custom-control custom-checkbox'>
      <?php boxChecked($profile['shipOptions_residentialDelivery'],'shipOptions_residentialDelivery'); ?>
      <label class='custom-control-label' for="shipOptions_residentialDelivery">Residential Delivery</label>
    </div>

    <div class='custom-control custom-checkbox'>
      <?php boxChecked($profile['shipOptions_saturdayDelivery'],'shipOptions_saturdayDelivery'); ?>
      <label class='custom-control-label' for="shipOptions_saturdayDelivery">Saturday Delivery</label>
    </div>

    <div class='custom-control custom-checkbox'>
      <?php boxChecked($profile['shipOptions_insurance'],'shipOptions_insurance'); ?>
      <label class='custom-control-label' for="shipOptions_insurance">Shipping Insurance</label>
    </div>


    <h3 class='h5 card-title mt-4'>Method</h3>

    <div class='custom-control custom-checkbox UPScheckInput'>
      <?php boxChecked($profile['shipOptions_useCustomerAccount'], 'shipOptions_useCustomerAccount', 'UPScheck'); ?>
      <label class='custom-control-label' for="shipOptions_useCustomerAccount">Use customer UPS Account</label>
      <input class='form-control' id='shipOptions_customerAccountNumber' type='text' name='shipOptions_customerAccountNumber' placeholder='Customer UPS Account #' value="<?php echo $profile['shipOptions_customerAccountNumber']; ?>"/>
    </div>

    <select class='form-control custom-select' id ='shipOptions_customerShipperPref' name='shipOptions_customerShipperPref'>
      <option <?php echo $profile['shipOptions_customerShipperPref'] === "UPSGRND" ? "selected" : ""; ?> value="UPSGRND">Ground (5-10 days)</option>
      <option <?php echo $profile['shipOptions_customerShipperPref'] === "UPS3DAYSEL" ? "selected" : ""; ?> value="UPS3DAYSEL">3-Day (3 days)</option>
      <option <?php echo $profile['shipOptions_customerShipperPref'] === "UPS2DAY" ? "selected" : ""; ?> value="UPS2DAY">2-Day (2 days)</option>
      <option <?php echo $profile['shipOptions_customerShipperPref'] === "UPSNXDAYAIRAM" ? "selected" : ""; ?> value="UPSNXDAYAIRAM">Overnight (10:30 next day)</option>
    </select>


    <h3 class='h5 card-title mt-4'>Notes</h3>
    <div class="form-group">
      <textarea class='form-control lineInput' id='prefShipTo_notes' name='prefShipTo_notes' cols="28" rows="3" placeholder='Shipping Notes'/><?php echo $profile['prefShipTo_notes']; ?></textarea>
      <small class="form-text text-muted"><b>Shipping Notes:</b> e.g. deliveries to back loading dock only</small>
    </div>
  </div>
</div>
  </div>




  <div class="form-group col-sm-12 col-md-4 offset-md-4 mt-sm-1 mt-md-3">
    <button class='btn btn-primary btn-block buttonLoader' type='submit' name="submit">Edit Profile</button>
  </div>

  </div>
  </form>
</div>

</div>

<script type="text/javascript">
  //you have to set hasForm as a class to the body
  document.body.className += " "+"hasForm";
  var formID = 'formEditProfile';
</script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
