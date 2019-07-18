<?php
  require('config.php');
  //set title and description for page
  $title          = 'Account Setup';
  $description    = 'User acount setup';
  $pageLoader     = false;
  $hasForm        = true;
  //for login use only
  $restrictedPage = true;
  $adminOnly      = false;

  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
?>

<div class="page-wrap grid-x align-center align-middle" >
  <div class="cell small-12 medium-6">
    <form id='formSetup' class='' action='assets/build/db/_setup.php' method='post'>
      <!-- A honey pot will be added here in all forms with js and then hidden.-->
      <input type="hidden" name="user" value="<?php echo $_SESSION['user']; ?>">
      <fieldset>
        <p>Please fill in the preferred Shipping contact & address to be used with this account</p>
        <input id='prefShipContact_attn' type='text' name='prefShipContact_attn' placeholder='Shipping Contact'/>
        <input id='prefShipContact_bizName' type='text' name='prefShipContact_bizName' placeholder='Business Name'/>
        <input id='prefShipTo_address1' type='text' name='prefShipTo_address1' placeholder='Address line 1'/>
        <input id='prefShipTo_address2' type='text' name='prefShipTo_address2' placeholder='Address line 2'/>
        <input id='prefShipTo_city' type='text' name='prefShipTo_city' placeholder='City'/>
        <input id='prefShipTo_state' type='text' name='prefShipTo_state' placeholder='State'/>
        <input id='prefShipTo_zip' type='text' name='prefShipTo_zip' placeholder='Zip code'/>
        <textarea id='prefShipTo_notes' name='prefShipTo_notes' cols="28" rows="6" placeholder='Shipping Notes: e.g. deliveries to back loading dock only'/></textarea>
      </fieldset>

      <fieldset>
        <p>Please choose the default shipping options to be used with this account</p>
        <label for="shipOptions_residentialDelivery">Residential Delivery <input type='checkbox'id='shipOptions_residentialDelivery' name='shipOptions_residentialDelivery'/></label>
        <label for="shipOptions_saturdayDelivery">Saturday Delivery <input type='checkbox'id='shipOptions_saturdayDelivery' name='shipOptions_saturdayDelivery'/></label>
        <label for="shipOptions_insurance">Shiiping Insurance <input type='checkbox'id='shipOptions_insurance' name='shipOptions_insurance'/></label>

      </fieldset>

      <fieldset>
        <p>Would you like to use your own shipping provider?</p>
        <label for="shipOptions_useCustomerAccount">Use Customer Shipping Account <input type='checkbox' id='shipOptions_useCustomerAccount' name='shipOptions_useCustomerAccount'/></label>
        <span class="custShippingAccountInfo">
          <input id='shipOptions_customerShipperPref' type='text' name='shipOptions_customerShipperPref' placeholder='Customer preferred shipper'/>
          <input id='shipOptions_customerAccountNumber' type='text' name='shipOptions_customerAccountNumber' placeholder='Customer Shipping Account #'/>
        </span>
      </fieldset>
      <fieldset>
        <p>Please choose a new password</p>
        <input id='password' type='password' name='password' placeholder='NEW password' required/>
        <input id='confirmPassword' type='password' name='confirmPassword' placeholder='confirm NEW Password' required/>
      </fieldset>
      <p><b>NOTE:</b> <i>You will be logged out and will have to log back in with your new password</i></p>
      <input class='button' type='submit' name="submit" value='complete setup'/>
    </form>
  </div>
</div>

<script type="text/javascript">
  //you have to set hasForm as a class to the body
  document.body.className += " "+"hasForm";
  var formID = 'formSetup';
</script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
