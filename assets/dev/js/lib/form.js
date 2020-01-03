//these are used if there is a form on the page. If you do not want sweetalert to handle
//feedback from form entry wipe this and write your own and don't forget to alter
//the forms/submit.php to accommodate your own whatever you do.
if($('body').hasClass('hasForm')){



//=== HONEYPOT =================================================================
//==============================================================================
  //set honeypot var
  var honey = Math.floor(Math.random() * (66666 - 123) + 123);
  //honeypot is only added to contact form as all other forms are behind login
  var honeypot = "<input type='text' name='your-email247' id='your-email247' autocomplete='" + honey + "'/>";
  $('form#formContact').prepend(honeypot);
  $('form#formContact #your-email247').hide();



//=== UPS account number =======================================================
//==============================================================================
  //disable until checkbox is checked (this is on form-setup.php)
  $('#shipOptions_customerAccountNumber').prop('disabled', true);

  //if they are on the profile edit page we need to display this for editing so...
  if($('#shipOptions_useCustomerAccount').prop('checked') == true){
    $('#shipOptions_customerAccountNumber').prop('disabled', false);
  }

  $('#shipOptions_useCustomerAccount').on('click', function(e){
    if($(this).prop('checked') == true){
      $('#shipOptions_customerAccountNumber').prop('disabled', false);
      $('#shipOptions_customerAccountNumber').prop('required', true);
    }else{
      $('#shipOptions_customerAccountNumber').prop('disabled', true);
      $('#shipOptions_customerAccountNumber').prop('required', false);
      $('#shipOptions_customerAccountNumber').val("");
    }
  });

  //The UPS module
  if($('.UPScheck').prop('checked')){
    $('.UPScheckInput').addClass('yesUPS');
  }

  $('.UPScheck').on('click', function(e){
    var isChecked = $(this).prop('checked');
    if(isChecked == true){
    $('.UPScheckInput').addClass('yesUPS');
  }else{
    $('.UPScheckInput').removeClass('yesUPS');
  }
  });



//=== REQUIRED INPUT ADD .fulfilled WHEN NOT EMPTY =============================
//==============================================================================
  //inputs with required need to have a bit of style.
  $('input:required, textarea:required').on('focusout', function(e){
    if($(this).val() != ""){
      $(this).addClass('fulfilled');
    }else if ($(this).val() == ""){
      if($(this).hasClass('fulfilled')){
        $(this).removeClass('fulfilled');
      }
    }
  });






//===LOGIN MODULE===============================================================
//==============================================================================

// focusin on form itself
$('form#formLogin').on('focusin', function(e){
  $('.loginModule').addClass('loginFocus');
});
$('form#formLogin').on('focusout', function(e){
  $('.loginModule').removeClass('loginFocus');
});

// focus on password input
$('.loginModule input[type="password"]').on('focus', function(e){
    $('.loginModule input[type="email"]').addClass('noBottom');
});
$('.loginModule input[type="password"]').on('focusout', function(e){
    $('.loginModule input[type="email"]').removeClass('noBottom');
});
// input on username changes button
$('form#formLogin input[type="email"]').on('input', function(e){
  var usertext = $('form#formLogin input[type="email"]').val();
  if(usertext !== ""){
    $('form#formLogin button').removeClass('btn-primary');
    $('form#formLogin button').addClass('btn-success');
  }
  if(usertext == ""){
    $('form#formLogin button').removeClass('btn-success');
    $('form#formLogin button').addClass('btn-primary');
  }
});
// input on password changes button
$('form#formLogin input[type="password"]').on('input', function(e){
  var passtext = $('form#formLogin input[type="password"]').val();
  if(passtext !== ""){
    $('form#formLogin button i').removeClass('fa-user-circle');
    $('form#formLogin button i').addClass('fa-sign-in');
  }
  if(passtext == ""){
    $('form#formLogin button i').removeClass('fa-sign-in');
    $('form#formLogin button i').addClass('fa-user-circle');
  }
});
//===INDEX.PHP SIMPLE FORM MICROINTERACTION=====================================
//==============================================================================
$('.simpleFormTrigger').on('focusin', function(e){
  $(this).parentsUntil('.simpleFormWrap').siblings('.simpleFormTarget').children('button').removeClass('btn-info').addClass('btn-success');
  $(this).parentsUntil('.simpleFormWrap').siblings('.simpleFormTarget').children('button').children('i').removeClass('d-none').addClass('d-inline-block');
});
$('.simpleFormTrigger').on('focusout', function(e){
  $(this).parentsUntil('.simpleFormWrap').siblings('.simpleFormTarget').children('button').removeClass('btn-success').addClass('btn-info');
  $(this).parentsUntil('.simpleFormWrap').siblings('.simpleFormTarget').children('button').children('i').removeClass('d-inline-block').addClass('d-none');
});



//===Form watch (watch for required and if has password)====================
//==============================================================================
if($('form').hasClass('formWatch')){
  //disable submit button
  $('form.formWatch button[type="submit"]').prop('disabled', true);
  var passwordAccepted = false;
  //check required inputs
    var requiredInputs = $('input, select, textarea').filter('[required]');
    $(requiredInputs).on('input', function(e){
      var watchRequired = true;
      for (var i = 0; i < requiredInputs.length; i++) {
        if($(requiredInputs[i]).val() === ""){
          watchRequired = false;
        }
      }
      if(watchRequired){
        $('form.formWatch button[type = "submit"]').removeClass('btn-primary');
        $('form.formWatch button[type = "submit"]').addClass('btn-success');
        $('form.formWatch button[type="submit"]').prop('disabled', false);
      }else{
        $('form.formWatch button[type = "submit"]').removeClass('btn-success');
        $('form.formWatch button[type = "submit"]').addClass('btn-primary');
        $('form.formWatch button[type="submit"]').prop('disabled', true);
      }
    });


  //password check
  $('input#password, input#confirmPassword').on('input', function(e){
    var str = $('input#password').val();
    var match = $('input#confirmPassword').val();
    var reg_length_min = 6;
    var reg_length_max = 12;
    var regCapital = RegExp('[A-Z]+');
    var regLowercase = RegExp('[a-z]+');
    var regNumber = RegExp('[0-9]+');
    var regSpecial = RegExp('[^a-zA-Z0-9]+');
    //checks
    var check1 = false,
        check2 = false,
        check3 = false,
        check4 = false,
        check5 = false;
    var passwordAccepted = false;
    //length
    if(str.length >= reg_length_min && str.length <= reg_length_max){
      $('.passwordRuleLength').addClass('passwordRuleSuccess');
      check1 = true;
    }else{
      $('.passwordRuleLength').removeClass('passwordRuleSuccess');
      check1 = false;
    }
    //capital
    if(regCapital.test(str)){
      $('.passwordRuleCapital').addClass('passwordRuleSuccess');
      check2 = true;
    }else{
      $('.passwordRuleCapital').removeClass('passwordRuleSuccess');
      check2 = false;
    }
    //lowercase
    if(regLowercase.test(str)){
      $('.passwordRuleLowercase').addClass('passwordRuleSuccess');
      check3 = true;
    }else{
      $('.passwordRuleLowercase').removeClass('passwordRuleSuccess');
      check3 = false;
    }
    //number
    if(regNumber.test(str)){
      $('.passwordRuleNumber').addClass('passwordRuleSuccess');
      check4 = true;
    }else{
      $('.passwordRuleNumber').removeClass('passwordRuleSuccess');
      check4 = false;
    }
    //special
    if(regSpecial.test(str)){
      $('.passwordRuleSpecial').addClass('passwordRuleSuccess');
      check5 = true;
    }else{
      $('.passwordRuleSpecial').removeClass('passwordRuleSuccess');
      check5 = false;
    }

    if(check1 && check2 && check3 && check4 && check5){
      passwordAccepted = true;
    }else{
      passwordAccepted = false;
    }
    var ptb = "<i class='passwordCeckCheck fa fa-check text-warning animated rotateIn mr-2' role='status' aria-hidden='true'></i>";
    if(passwordAccepted){
        if(str === match){
            $('.passwordCardHeader').prepend(ptb);
          }else{
              $('.passwordCeckCheck').detach();
            }
          }
  });











} //END formWatch


  // onload=function(){
  //
  // };
}
