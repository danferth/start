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

$currentPage = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

//maintenance mode
if($maintenance['status']){
  if($currentPage !== $siteRoot . $maintenance['file']){
    header('Location: ' . $siteRoot . $maintenance['file']);
	  exit();
  }
}

//splash page mode
if($splashPage['status'] && !$maintenance['status']){
  if($currentPage !== $siteRoot . $splashPage['file']){
    if($currentPage === $siteRoot . "assets/build/forms/" . $splashPage['submit']){
      //it doesn need to be parsed
    }else{
      header('Location: ' . $siteRoot . $splashPage['file']);
	    exit();
    }
  }
}

//check if production then set version.
if($production){
    $v = $version;
}else{
    $v = rand();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    /*
    NOTICE: display_errors = off
    (this needs to be set in /etc/php/7.2/apache2/php.ini for production)
    */
}

//global loader
//set $loader (variable to display the actual loader markup)
//to false and set to true with if's below
$loader = false;
if($globalLoader){
    $gsap   = true;
    $loader = true;
}
//page loader
if(isset($pageLoader)){
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

function consoleDump($array){
  global $production;
  if(!$production){
    echo "<script type='text/javascript'> var str = JSON.stringify(".json_encode($array).", null, 2); console.log(str); </script>";
  }
};

function get_browser_name($user_agent){
  if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
  elseif (strpos($user_agent, 'Edge')) return 'Edge';
  elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
  elseif (strpos($user_agent, 'Safari')) return 'Safari';
  elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
  elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';

  return 'Other';
}
//=============================================================================
//*****************************Redirects functions*****************************
//=============================================================================
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

//redirect with setting session variable
function sessionRedirect($page, $type, $message){
  global $siteRoot;
	// Build the query string to be attached to the redirected URL
  //$type should be either m = messages or e = errors
  $_SESSION[$type] = $message;
	// Redirection domain and phisical dir
	$next_page = $page . ".php";
	header('Location: ' . $siteRoot . $next_page);
}

//redirect without query
function redirect($page){
	// Redirection domain and phisical dir
	global $siteRoot;
	$next_page = $page . ".php";
	header('Location: ' . $siteRoot . $next_page);
}
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
    sessionRedirect($next_page, 'e', 'requiredInput');
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
    sessionRedirect($next_page, 'e', 'emailNotValid');
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
    sessionRedirect($next_page, 'e', 'honeypot');
		exit();
  }
};

//Form time to complete
function formTimeCheck($formTimeLimit, $next_page){
  global $siteRoot;
  if(!isset($_SESSION['formLoadTime'])){
    sessionRedirect($next_page, 'e', 'formTime');
    exit();
  }else{
    $formLoadTime = $_SESSION['formLoadTime'];
    unset($_SESSION['formLoadTime']);
    $formSubmitTime = time();
    $formTimeSeconds = $formSubmitTime - $formLoadTime;
    if($formTimeSeconds < $formTimeLimit){
      sessionRedirect($next_page, 'e', 'formTime');
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
					$_POST[$post] = 1;
				}else{
					$_POST[$post] = 0;
					}
				}
//check if boolean in db was set or not. then output input with checked or not
//where $query = the mysql_query and $check is the column in the table queried
function boxChecked($query,$name){
		if($query === 0){
			echo "<input type='checkbox' id=".$name." name=".$name.">";
		}elseif ($query === 1) {
			echo "<input type='checkbox' id=".$name." name=".$name." checked>";
		}
	}

//YES | NO function for displaying boolean values in the form of yes or no
function yesno($bool){
  if($bool === 0 || $bool === "0"){
    return "No";
  }else{
    return "Yes";
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
	$timeout = 3600;
	if(isset($_SESSION['timeout'])){
		$sessionLife = time() - $_SESSION['timeout'];
		if($sessionLife > $timeout){
			session_destroy();
      redirect("login");
		}
	}
}

//generate a random verification code for users to verify Account
function verificationCode(){
  //string of characters to shuffle
  $permitted_chars = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
  $start = mt_rand(0, 46);
  $str = substr(str_shuffle($permitted_chars), $start, 25);
  $rslt = hash("sha256", $str, false);
  return $rslt;
}

//generate a random password code for users to verify Account
function generatePassword(){

  //string of characters to shuffle
  $permitted_chars = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randomStart = mt_rand(0, 53);
  $rslt = substr(str_shuffle($permitted_chars), $randomStart, 8);
  return $rslt;
}

?>
