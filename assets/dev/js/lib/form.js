//these are used if there is a form on the page. If you do not want sweetalert to handle
//feedback from form entry wipe this and write your own and don't forget to alter 
//the forms/submit.php to accommodate your own whatever you do.
if($('body').hasClass('hasForm')){
  if(form_success == "true"){
  	window.onload = swal({
  		title: 'Success',
  		text: success_message,
  		type: 'success',
  		confirmButtonText: 'Thanks'
  });
  }else if(form_success == "false"){
  	window.onload = swal({
  		title: 'Whoops',
  		text: error_message,
  		type: 'error',
  		confirmButtonText: 'OK'
  });
  }else if(form_success == "email"){
  	window.onload = swal({
  		title: 'Error',
  		text: 'It seems there was an error with your email entry, please make sure it is a valid email and try to submit again.',
  		type: 'error',
  		confirmButtonText: 'OK'
  });
  }
  //resets form on load. if you are using forms you may want to set up some sort of variable here for the target ID
  //maybe something in the confif.php file for the pages that contain forms
  onload=function(){document.forms["contactform"].reset()};
}