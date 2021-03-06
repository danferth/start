<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../../../config.php';

// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// CHANGE THIS TO SOMETHING REFLECTING mailchimpVerify
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//first check, this one needs to be changed
$check1 = false;
$check2 = false;
if($_SESSION['user'] != $_POST['user']){
	session_destroy();
	redirect('login');
}else{
  $check1 = true;
}
//check for submit
if(!isset($_POST['submit'])){
    //submit not set
    redirect('form-edit-profile');
}else{
  $check2 = true;
}

if($check1 && $check2){
  //set a few variables we will need
  $user         = $_POST['user'];
  $userID       = $_SESSION['userID'];
  //start updating user for edit of account
  $prefShipContact_attn     = filter_var($_POST['prefShipContact_attn'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
  $prefShipContact_bizName  = filter_var($_POST['prefShipContact_bizName'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
  $prefShipContact_phone    = filter_var($_POST['prefShipContact_phone'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
  $prefShipContact_ext      = filter_var($_POST['prefShipContact_ext'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
  $prefShipTo_address1      = filter_var($_POST['prefShipTo_address1'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
  $prefShipTo_address2      = filter_var($_POST['prefShipTo_address2'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
  $prefShipTo_city          = filter_var($_POST['prefShipTo_city'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
  $prefShipTo_state         = filter_var($_POST['prefShipTo_state'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
  $prefShipTo_zip           = filter_var($_POST['prefShipTo_zip'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
  $prefShipTo_notes         = filter_var($_POST['prefShipTo_notes'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);

  //checkboxes
  checkBox('shipOptions_residentialDelivery');
  $shipOptions_residentialDelivery  = $_POST['shipOptions_residentialDelivery'];
  checkBox('shipOptions_saturdayDelivery');
  $shipOptions_saturdayDelivery     = $_POST['shipOptions_saturdayDelivery'];
  checkBox('shipOptions_insurance');
  $shipOptions_insurance = $_POST['shipOptions_insurance'];
  checkBox('shipOptions_useCustomerAccount');
  $shipOptions_useCustomerAccount   = $_POST['shipOptions_useCustomerAccount'];
  $shipOptions_customerShipperPref    = filter_var($_POST['shipOptions_customerShipperPref'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
  //customer wants to use their shipping account so....
  if($shipOptions_useCustomerAccount === 1){
    $shipOptions_customerAccountNumber  = filter_var($_POST['shipOptions_customerAccountNumber'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
  }else{
    $shipOptions_customerAccountNumber  = "";
  }

  //UPDATE user into db
  $dbUpdateData = [
    "prefShipContact_attn"              =>$prefShipContact_attn,
    "prefShipContact_bizName"           =>$prefShipContact_bizName,
    "prefShipContact_phone"             =>$prefShipContact_phone,
    "prefShipContact_ext"               =>$prefShipContact_ext,
    "prefShipTo_address1"               =>$prefShipTo_address1,
    "prefShipTo_address2"               =>$prefShipTo_address2,
    "prefShipTo_city"                   =>$prefShipTo_city,
    "prefShipTo_state"                  =>$prefShipTo_state,
    "prefShipTo_zip"                    =>$prefShipTo_zip,
    "prefShipTo_notes"                  =>$prefShipTo_notes,
    "shipOptions_residentialDelivery"   =>$shipOptions_residentialDelivery,
    "shipOptions_saturdayDelivery"      =>$shipOptions_saturdayDelivery,
    "shipOptions_insurance"             =>$shipOptions_insurance,
    "shipOptions_useCustomerAccount"    =>$shipOptions_useCustomerAccount,
    "shipOptions_customerShipperPref"   =>$shipOptions_customerShipperPref,
    "shipOptions_customerAccountNumber" =>$shipOptions_customerAccountNumber
  ];
  $query = "UPDATE users
            SET prefShipContact_attn              = :prefShipContact_attn,
                prefShipContact_bizName           = :prefShipContact_bizName,
                prefShipContact_phone             = :prefShipContact_phone,
                prefShipContact_ext               = :prefShipContact_ext,
                prefShipTo_address1               = :prefShipTo_address1,
                prefShipTo_address2               = :prefShipTo_address2,
                prefShipTo_city                   = :prefShipTo_city,
                prefShipTo_state                  = :prefShipTo_state,
                prefShipTo_zip                    = :prefShipTo_zip,
                prefShipTo_notes                  = :prefShipTo_notes,
                shipOptions_residentialDelivery   = :shipOptions_residentialDelivery,
                shipOptions_saturdayDelivery      = :shipOptions_saturdayDelivery,
                shipOptions_insurance             = :shipOptions_insurance,
                shipOptions_useCustomerAccount    = :shipOptions_useCustomerAccount,
                shipOptions_customerShipperPref   = :shipOptions_customerShipperPref,
                shipOptions_customerAccountNumber = :shipOptions_customerAccountNumber
                WHERE ID =".$userID;

  $q = $db->prepare($query);
  $q->execute($dbUpdateData);
  $q->closeCursor();
  redirect('profile');
}
 ?>
