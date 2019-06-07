<?php
//=============================================================================
//***************************site specific functions***************************
//=============================================================================
//site root
if($_SERVER['HTTPS'] === "on"){
    $protocol = 'https://';
}else{
    $protocol = 'http://';
}

$siteRoot = $protocol . $_SERVER['HTTP_HOST'] . '/';
if($maintenance['status']){
  header('Location: ' . $siteRoot . $maintenance['file']);
	exit();
}

//check if production then set version.
if($production){
    $v = $version;
}else{
    $v = rand();
}

//global loader
if($globalLoader){
    $gsap   = true;
    $loader = true;
}
//page loader
if($pageLoader){
    $gsap   = true;
    $loader = true;
}



//=============================================================================
//******************************helper functions******************************
//=============================================================================

function dump($value) {
echo '<pre>';
var_dump($value);
echo '</pre>';
};



//=============================================================================
//**************************form validation functions**************************
//=============================================================================
//form functions to trim all values from $_POST[]
function trim_value(&$value){
  if(gettype($value) == 'string'){
    $value = trim($value);
  }
  if(gettype($value) == 'array'){
      array_walk($value, 'trim_value');
  }
};

//check if required elements have a value
function checkRequired($requiredArray, $next_page){
  global $siteRoot;
  //set counter to 0
  $requiredCount = 0;
  //check for empty fields
  foreach($requiredArray as $require){
    if(empty($require)){
      ++$requiredCount;
    }
  }
  //redirect back with error
  if($requiredCount > 0){
    $query_string = '?e=requiredInput';
    header('Location:' . $siteRoot . $next_page . $query_string);
    exit();
  }
};

//check emails if they are valid or not and return with error if so
function checkEmailValid($emailArray, $next_page){
  global $siteRoot;
  $isEmailValid = 0;
  foreach($emailArray as $emailToCheck){
    $check = filter_var($emailToCheck, FILTER_VALIDATE_EMAIL);
      if($check === false){
        ++$isEmailValid;
      }
  }
  //if $isEmailValis is greater than 0 then there are issues with one
  //or more of the emails so redirect to form and trigger error message
  if($isEmailValid > 0){
    $query_string = '?e=email';
    header('Location:' . $siteRoot . $next_page . $query_string);
    exit();
  }
};

//check honeypots
function checkHoneypot($honeyArray, $next_page){
  global $siteRoot;
  $honeyCount = 0;
  foreach($honeyArray as $honey){
    if($honey !== ''){
      ++$honeyCount;
    }
  }
  if($honeyCount > 0){
    $query_string = '?e=honey';
		header('Location:' . $siteRoot . $next_page . $query_string);
		exit();
  }
};

//Form time to complete
function formTimeCheck($formTimeLimit, $next_page){
  global $siteRoot;
  if(!isset($_SESSION['formLoadTime'])){
    $query_string = '?e=formtime';
    header('Location:' . $siteRoot . $next_page . $query_string);
    exit();
  }else{
    $formLoadTime = $_SESSION['formLoadTime'];
    unset($_SESSION['formLoadTime']);
    $formSubmitTime = time();
    $formTimeSeconds = $formSubmitTime - $formLoadTime;
    if($formTimeSeconds < $formTimeLimit){
      $query_string = '?e=formtime';
      header('Location:' . $siteRoot . $next_page . $query_string);
      exit();
    }
  }
};



//=============================================================================
//********************************db functions********************************
//=============================================================================

//check radio for isset and output boolean to post variable
function checkBox($post){
				if(isset($_POST[$post])){
					$_POST[$post] = '1';
				}else{
					$_POST[$post] = '0';
					}
				}
//check if boolean in db was set or not. then output input with checked or not
//where $query = the mysql_query and $check is the column in the table queried
function boxChecked($query,$check,$name){
		if($query[$check] == 0){
			echo "<input type='checkbox' name=".$name.">";
		}elseif ($query[$check] == 1) {
			echo "<input type='checkbox' name=".$name." checked>";
		}
	}
//close connection to db
function dbClose(){
  global $db;
	$db = null;
}
//session timeout put into form action pages so page does not parse if timeout
function sessionTimeout(){
  global $siteRoot;
	$timeout = 600;
	if(isset($_SESSION['timeout'])){
		$sessionLife = time() - $_SESSION['timeout'];
		if($sessionLife > $timeout){
			session_destroy();
			header("Location:" . $siteRoot . "login.php?e=timeout");
		}
	}
}
//redirect with query
function queryRedirect($page, $type, $message){
  global $siteRoot;
	// Build the query string to be attached to the redirected URL
  //$type should be either m = messages or e = errors
	$query_string = '?' . $type . '=' . $message;
	// Redirection domain and phisical dir
	$next_page = $page . ".php";
	/* The header() function sends a HTTP message The 303 code asks the server to use GET when redirecting to another page */
	header('HTTP/1.1 303 See Other');
	header('Location: ' . $siteRoot . $next_page . $query_string);
}
//redirect without query
function redirect($page){
	// Redirection domain and phisical dir
	global $siteRoot;
	$next_page = $page . ".php";
	/* The header() function sends a HTTP message The 303 code asks the server to use GET when redirecting to another page */
	header('HTTP/1.1 303 See Other');
	header('Location: ' . $siteRoot . $next_page);
}
?>
