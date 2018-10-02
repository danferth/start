<?php
session_start();
if(isset($_SESSION['formLoadTime'])){
  unset($_SESSION['formLoadTime']);
  $_SESSION['formLoadTime'] = time();
}else{
  $_SESSION['formLoadTime'] = time();
};
//grab the get from parse file
$first_name = $_GET['first_name'];
//grab get and custom fields
if(isset($_GET['success'])){
	$form_success = $_GET['success'];
}
$rand_str1 = substr(md5(rand()), 0, 7);
$rand_str2 = substr(md5(rand()), 0, 7);


include $_SERVER['DOCUMENT_ROOT'].'/head.php';
?>

<div class="page-wrap">

  <form id='landingpage' class='first_contact' action='assets/forms/submit.php' method='post'>
    <input class='animated fadeIn' id='fname' type='text' name='fname' placeholder='first name' required/>
    <input class='animated fadeIn' id='lname' type='text' name='lname' placeholder='last name' required/>
    <input class='animated fadeIn' id='email' type='email' name='email' placeholder='email' required/>
    <input type='text' name='your-name925htj' id='your-name925htj' autocomplete='<?php echo $rand_str1; ?>'/>
    <input type='text' name='your-email247htj' id='your-email247htj' autocomplete='<?php echo $rand_str2; ?>'/>
    <input class='animated fadeIn' type='submit' value='submit'/>
  </form>
</div>    <!-- end .wrap -->
    <script type="text/javascript">
    
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
	onload=function(){document.forms["landingpage"].reset()};
</script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/foot.php'; ?>