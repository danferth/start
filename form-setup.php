<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
  //set title and description for page
  $title          = 'Profile | Setup';
  $description    = 'Setup user profile';
  $pageLoader     = false;
  $hasForm        = true;
  //for login use only
  $restrictedPage = true;
  $adminOnly      = false;

  require_once 'config.php';
  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/db/_profile.php';

  //variables for password edit
  $_SESSION['original_password'] = $profile['pass'];
?>

<div class="page-wrap row">

  <div class="col-sm-12 col-md-6">
    <h1><i class='fa fa-user-circle-o text-primary'></i> Account Setup</h1>
    <p>Use this page to set up your accounts shipping options when placing an order.  You will be able to change this at any time in the future from your profile page.</p>
  </div>

  <form id='formSetup' class='formWatch' action='assets/build/db/_setup.php' method='post'>
    <input type="hidden" name="user" value="<?php echo $_SESSION['user']; ?>">


<div class="col-sm-12">
  <div class="form-row">


    <div class="col-sm-12 col-md-6 mb-3 mb-md-0">
      <div class="card">
        <h2 class='h3 bg-info text-white card-title card-header'>Contact</h2>
        <div class="card-body">
        <div class='form-row'>
          <div class="form-group col-sm-12">
            <input class='form-control lineInput' id='prefShipContact_attn' type='text' name='prefShipContact_attn' placeholder='Attention to *' required/>
            <label  for='prefShipContact_attn'>Attention to*</label>
          </div>
          <div class="form-group col-sm-12">
            <input class='form-control lineInput' id='prefShipContact_bizName' type='text' name='prefShipContact_bizName' placeholder='Business Name *' required/>
            <label  for='prefShipContact_bizName'>Business Name*</label>
          </div>
          <div class="form-group col-sm-10 col-md-9">
            <input class='form-control lineInput' id='prefShipContact_phone' type='tel' name='prefShipContact_phone' placeholder='Phone'/>
            <label  for='prefShipContact_phone'>Phone</label>
          </div>
          <div class="form-group col-sm-2 col-md-3">
            <input class='form-control lineInput' id='prefShipContact_ext' type='text' name='prefShipContact_ext' placeholder='ext.'/>
            <label  for='prefShipContact_ext'>ext.</label>
          </div>
        </div>

      </div>
    </div>
      </div>


      <div class="col-sm-12 col-md-6 mb-3 mb-md-0">
        <div class="card">
          <h2 class='h3 bg-info text-white card-title card-header'>Address</h2>
          <div class="card-body">
        <div class="form-row">
          <div class="form-group col-sm-12">
            <input class='form-control lineInput' id='prefShipTo_address1' type='text' name='prefShipTo_address1' placeholder='Address line 1'/>
            <label  for='prefShipTo_address1'>Address line 1</label>
          </div>
          <div class="form-group col-sm-12">
            <input class='form-control lineInput' id='prefShipTo_address2' type='text' name='prefShipTo_address2' placeholder='Address line 2'/>
            <label  for='prefShipTo_address2'>Address line 2</label>
          </div>
          <div class="form-group col-sm-6">
            <input class='form-control lineInput' id='prefShipTo_city' type='text' name='prefShipTo_city' placeholder='City'/>
            <label  for='prefShipTo_city'>City</label>
          </div>
          <div class="form-group col-sm-2">
            <input class='form-control lineInput' id='prefShipTo_state' type='text' name='prefShipTo_state' maxlength='2' placeholder='State'/>
            <label  for='prefShipTo_state'>State</label>
          </div>
          <div class="form-group col-sm-4">
            <input class='form-control lineInput' id='prefShipTo_zip' type='text' name='prefShipTo_zip' placeholder='Zip code'/>
            <label  for='prefShipTo_zip'>Zip code</label>
          </div>
        </div>

      </div>
    </div>
      </div>


   </div> <!-- END form-row -->
</div>


<div class="col-sm-12 mt-sm-2 mt-md-4">
          <div class="form-row">


          <div class="col-sm-12 col-md-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
              <h3 class='h4 bg-info text-white card-title card-header'>Options</h3>
              <div class="card-body">
            <div class="custom-control custom-checkbox">
              <input class='custom-control-input' type='checkbox'id='shipOptions_residentialDelivery' name='shipOptions_residentialDelivery'/>
              <label class="custom-control-label" for="shipOptions_residentialDelivery">Residential Delivery</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input class='custom-control-input' type='checkbox'id='shipOptions_saturdayDelivery' name='shipOptions_saturdayDelivery'/>
              <label class="custom-control-label" for="shipOptions_saturdayDelivery">Saturday Delivery</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input class='custom-control-input' type='checkbox'id='shipOptions_insurance' name='shipOptions_insurance'/>
              <label class="custom-control-label" for="shipOptions_insurance">Shipping Insurance</label>
            </div>
          </div>
        </div>
          </div>

          <div class="col-sm-12 col-md-6 col-lg-4 mb-3 mb-lg-0">
            <div class="card h-100">
              <h3 class='h4 bg-info text-white card-title card-header'>Method</h3>
              <div class="card-body">

            <div class='custom-control custom-checkbox UPScheckInput'>
              <input class='custom-control-input UPScheck' type='checkbox' id='shipOptions_useCustomerAccount' name='shipOptions_useCustomerAccount'/>
              <label class='custom-control-label' for="shipOptions_useCustomerAccount">Use Customer UPS Account</label>
              <input class='form-control' id='shipOptions_customerAccountNumber' type='text' name='shipOptions_customerAccountNumber' placeholder='Customer UPS Account #'/>
            </div>

            <select class='form-control custom-select' id ='shipOptions_customerShipperPref' name='shipOptions_customerShipperPref'>
              <option value="UPSGRND">Ground (5-10 days)</option>
              <option value="UPS3DAYSEL">3-Day (3 days)</option>
              <option value="UPS2DAY">2-Day (2 days)</option>
              <option value="UPSNXDAYAIRAM">Overnight (10:30 next day)</option>
            </select>
          </div>
        </div>
          </div>

          <div class="col-sm-12 col-lg-5 mb-3 mb-md-0">
            <div class="card h-100">
              <h3 class='h4 bg-info text-white card-title card-header'>Notes</h3>
              <div class="card-body">
            <div class="form-group">
              <textarea class='form-control lineInput' id='prefShipTo_notes' name='prefShipTo_notes' cols="28" rows="5" placeholder="Shipping Notes:"/></textarea>
              <small class='form-text text-muted'>Shipping Notes: e.g. deliveries to back loading dock only</small>
            </div>
          </div>
        </div>
          </div>



        </div>
</div>




          <div class="col-sm-12 mt-sm-2 mt-md-4">
            <div class="form-row">

              <div class="col-sm-12 col-md-7 mb-3 mb-md-0">
                <div class="card h-100">
                  <h3 class='h4 bg-info text-white card-title card-header passwordCardHeader'>Create New Password</h3>
                  <div class="card-body">
                <div class="form-group">
                <input class='form-control lineInput' id='password' type='password' name='password' pattern="<?php echo $passwordRegEx; ?>" placeholder='NEW password *' required/>
                </div>
                <div class="form-group">
                <input class='form-control lineInput' id='confirmPassword' type='password' name='confirmPassword' pattern="<?php echo $passwordRegEx; ?>" placeholder='Confirm NEW Password *' required/>
                </div>
              </div>
              <div class='card-footer'>
                <small><b>NOTE:</b> <i>You will be logged out and will have to log back in with your new password</i></small>
              </div>
            </div>
          </div>

              <div class="col-sm-12 col-md-5 mb-3 mb-md-0">
                <div class="card h-100">
                  <div class="card-body">
                <ol class='passwordRules'>
                  <h6>Create a new password that:</h6>
                  <li class='passwordRuleLength'><span>6-12 characters long</span></li>
                  <li class='passwordRuleCapital'><span>Includes one capital letter</span></li>
                  <li class='passwordRuleLowercase'><span>Includes one lowercase letter</span></li>
                  <li class='passwordRuleNumber'><span>Includes one number</span></li>
                  <li class='passwordRuleSpecial'><span>Includes one special character</span></li>
                </ol>
              </div>
            </div>
          </div>

            </div>
          </div>


          <div class="col-sm-6 offset-sm-3 col-md-6 col-lg-4 offset-lg-4 offset-md-3 mt-sm-2 mt-md-4">
            <button class='btn btn-primary btn-block buttonLoader' type='submit' name="submit">Complete Setup</button>
          </div>



        </form>
</div> <!-- end wrap -->

<script type="text/javascript">
  //you have to set hasForm as a class to the body
  document.body.className += " "+"hasForm";
  var formID = 'formSetup';
</script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
