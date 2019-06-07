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
  // shut up the console
  var form_success;
  //These are the swal2 popups on form completion.
  if(form_success == "true"){
  	window.onload = swal({
  		title: 'Success',
  		text: "success_message to be set in form.js",
  		type: 'success',
  		confirmButtonText: 'Thanks'
  });
  }else if(form_success == "false"){
  	window.onload = swal({
  		title: 'Whoops',
  		text: "error_message to be set in form.js",
  		type: 'error',
  		confirmButtonText: 'OK'
  });
  }
  //resets form on load. if you are using forms you may want to set up some sort of variable here for the target ID
  //maybe something in the confif.php file for the pages that contain forms
  onload=function(){document.forms["contactform"].reset()};
}
