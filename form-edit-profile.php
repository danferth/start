<?php
  require('config.php');
  //set title and description for page
  $title          = 'edit profile';
  $description    = 'User can edit profile with this page';
  $pageLoader     = false;
  $hasForm        = true;
  //for login use only
  $restrictedPage = true;
  $adminOnly      = false;

  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
  include $_SERVER['DOCUMENT_ROOT'].'/assets/build/db/_profile.php';
?>

<div class="page-wrap grid-x align-center align-middle" >
  <div class="cell small-12 medium-6">
    <form id='formEditProfile' class='first_contact' action='assets/build/db/_edit_profile.php' method='post'>
      <!-- A honey pot will be added here in all forms with js and then hidden.-->
      <input type="hidden" name="user" value="<?php echo $_SESSION['user']; ?>">
      <fieldset>
        <p>Use the form to edit the preferred Shipping contact & address to be used with this account</p>
        <input id='prefShipContact_attn' type='text' name='prefShipContact_attn' placeholder='Shipping Contact' value="<?php echo $profile['prefShipContact_attn']; ?>"/>
        <input id='prefShipContact_bizName' type='text' name='prefShipContact_bizName' placeholder='Business Name' value="<?php echo $profile['prefShipContact_bizName']; ?>"/>
        <input id='prefShipTo_address1' type='text' name='prefShipTo_address1' placeholder='Address line 1' value="<?php echo $profile['prefShipTo_address1']; ?>"/>
        <input id='prefShipTo_address2' type='text' name='prefShipTo_address2' placeholder='Address line 2' value="<?php echo $profile['prefShipTo_address2']; ?>"/>
        <input id='prefShipTo_city' type='text' name='prefShipTo_city' placeholder='City' value="<?php echo $profile['prefShipTo_city']; ?>"/>
        <input id='prefShipTo_state' type='text' name='prefShipTo_state' placeholder='State' value="<?php echo $profile['prefShipTo_state']; ?>"/>
        <input id='prefShipTo_zip' type='text' name='prefShipTo_zip' placeholder='Zip code' value="<?php echo $profile['prefShipTo_zip']; ?>"/>
        <textarea id='prefShipTo_notes' name='prefShipTo_notes' cols="28" rows="6" placeholder='Shipping Notes: e.g. deliveries to back loading dock only'/><?php echo $profile['prefShipTo_notes']; ?></textarea>
      </fieldset>

      <fieldset>
        <p>Please choose the default shipping options to be used with this account</p>
        <label for="shipOptions_residentialDelivery">Residential Delivery <?php boxChecked($profile['shipOptions_residentialDelivery'],'shipOptions_residentialDelivery'); ?></label>
        <label for="shipOptions_saturdayDelivery">Saturday Delivery <?php boxChecked($profile['shipOptions_saturdayDelivery'],'shipOptions_saturdayDelivery'); ?></label>
        <label for="shipOptions_insurance">Shiiping Insurance <?php boxChecked($profile['shipOptions_insurance'],'shipOptions_insurance'); ?></label>

      </fieldset>

      <fieldset>
        <p>Would you like to use your own shipping provider?</p>
        <label for="shipOptions_useCustomerAccount">Use Customer Shipping Account <?php boxChecked($profile['shipOptions_useCustomerAccount'], 'shipOptions_useCustomerAccount'); ?></label>
        <span class="custShippingAccountInfo">
          <input id='shipOptions_customerShipperPref' type='text' name='shipOptions_customerShipperPref' placeholder='Customer preferred shipper' value="<?php echo $profile['shipOptions_customerShipperPref']; ?>"/>
          <input id='shipOptions_customerAccountNumber' type='text' name='shipOptions_customerAccountNumber' placeholder='Customer Shipping Account #' value="<?php echo $profile['shipOptions_customerAccountNumber']; ?>"/>
        </span>
      </fieldset>
      <input class='button' type='submit' name="submit" value='complete profile edit'/>
    </form>
  </div>
</div>

<script type="text/javascript">
  //you have to set hasForm as a class to the body
  document.body.className += " "+"hasForm";
  var formID = 'formEditProfile';
</script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php'; ?>
