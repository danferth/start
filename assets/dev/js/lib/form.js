//these are used if there is a form on the page. If you do not want sweetalert to handle
//feedback from form entry wipe this and write your own and don't forget to alter
//the forms/submit.php to accommodate your own whatever you do.
if($('body').hasClass('hasForm')){
  //set honeypot var
  var honey = Math.floor(Math.random() * (66666 - 123) + 123);
  //the honeypot
  var honeypot = "<input type='text' name='your-email247' id='your-email247' autocomplete='" + honey + "'/>";
  $('form').prepend(honeypot);
  $('#your-email247').hide();

  //hide a span until checkbox is checked (this is on form-setup.php)
  $('.custShippingAccountInfo').hide();
  $('#shipOptions_shipVia, #shipOptions_customerAccountNumber').prop('disabled', true);

  //if they are on the profile edit page we need to display this for editing so...
  if($('#shipOptions_useCustomerAccount').prop('checked') == true){
    $('.custShippingAccountInfo').show();
    $('#shipOptions_shipVia, #shipOptions_customerAccountNumber').prop('disabled', false);
  }

  $('#shipOptions_useCustomerAccount').on('click', function(e){
    if($(this).prop('checked') == true){
      $('.custShippingAccountInfo').show();
      $('#shipOptions_shipVia, #shipOptions_customerAccountNumber').prop('disabled', false);
    }else{
      $('.custShippingAccountInfo').hide();
      $('#shipOptions_shipVia, #shipOptions_customerAccountNumber').prop('disabled', true);
    }
  });
  //resets form on load. if you are using forms you may want to set up some sort of variable here for the target ID
  //maybe something in the confif.php file for the pages that contain forms
  onload=function(){document.forms[formID].reset()};
}
