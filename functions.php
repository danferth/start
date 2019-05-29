<?php
//=============================================================================
//***************************site specific functions***************************
//=============================================================================
//site root
if($https){
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

//header footer functions
function siteHeader(){
    global $production;
    if($production){
        include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
        echo "production is true";
    }else{
        include $_SERVER['DOCUMENT_ROOT'].'/assets/dev/scaffold/head.php';
        echo "production is false";
    }
};

function siteFooter(){
    global $production;
    if($production){
        include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php';
    }else{
        include $_SERVER['DOCUMENT_ROOT'].'/assets/dev/scaffold/foot.php';
    }
};

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
//fun helper function for debugging from http://net.tutsplus.com/tutorials/tools-and-tips/xdebug-professional-php-debugging/

function dump($value) {
echo ‘<pre>';
var_dump($value);
echo ‘</pre>';
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
function checkRequired($requiredArray,  $siteRoot, $next_page, $query_string){
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
    $query_string .= '&success=required';
    header('Location:' . $siteRoot . $next_page . $query_string);
    exit();
  }
};

//check emails if they are valid or not and return with error if so
function checkEmailValid($emailArray, $siteRoot, $next_page, $query_string){
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
    $query_string .= '&success=email';
    header('Location:' . $siteRoot . $next_page . $query_string);
    exit();
  }
};

//check honeypots
function checkHoneypot($honeyArray, $siteRoot, $next_page, $query_string){
  $honeyCount = 0;
  foreach($honeyArray as $honey){
    if($honey !== ''){
      ++$honeyCount;
    }
  }
  if($honeyCount > 0){
    $query_string = '?first_name=Edward';
		$query_string .= '&success=true';
		header('Location:' . $siteRoot . $next_page . $query_string);
		exit();
  }
};

//Form time to complete
function formTimeCheck($formTimeLimit, $siteRoot, $next_page, $query_string){

  if(!isset($_SESSION['formLoadTime'])){
    $query_string .= '&success=false';
    header('Location:' . $siteRoot . $next_page . $query_string);
    exit();
  }else{
    $formLoadTime = $_SESSION['formLoadTime'];
    unset($_SESSION['formLoadTime']);
    $formSubmitTime = time();
    $formTimeSeconds = $formSubmitTime - $formLoadTime;
    if($formTimeSeconds < $formTimeLimit){
      $query_string .= '&success=false';
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
	$db = null;
}
//session timeout put into form action pages so page does not parse if timeout
function sessionTimeout(){
	$timeout = 3600;
	if(isset($_SESSION['timeout'])){
		$sessionLife = time() - $_SESSION['timeout'];
		if($sessionLife > $timeout){
			session_destroy();
			header("Location: index.php?message=timeout");
		}
	}
}
//redirect with query
function queryRedirect($page,$message){
	// Build the query string to be attached to the redirected URL
	$query_string = '?message=' . $message;
	// Redirection domain and phisical dir
	$server_dir = $_SERVER['HTTP_HOST'] . rtrim(dirname('/www/print/asset/'), '/\\') . '/';
	$next_page = $page.".php";
	/* The header() function sends a HTTP message The 303 code asks the server to use GET when redirecting to another page */
	header('HTTP/1.1 303 See Other');
	header('Location: https://' . $server_dir . $next_page . $query_string);
}
//redirect without query
function redirect($page){
	// Redirection domain and phisical dir
	$server_dir = $_SERVER['HTTP_HOST'] . rtrim(dirname('/www/print/asset/'), '/\\') . '/';
	$next_page = $page.".php";
	/* The header() function sends a HTTP message The 303 code asks the server to use GET when redirecting to another page */
	header('HTTP/1.1 303 See Other');
	header('Location: https://' . $server_dir . $next_page);
}
?>
