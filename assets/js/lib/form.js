if($('body').hasClass('hasForm')){
  console.log("ladies and gentalmen, we have a form on the table");
  var form_success    = "<?php echo $form_success; ?>";
  var success_message = "<?php echo $success_message; ?>";
  var error_message   = "<?php echo $error_message; ?>";
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

  onload=function(){document.forms["contactform"].reset()};
}