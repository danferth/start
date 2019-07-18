<?php


// 'm' or messages
if(isset($_SESSION['m'])){
  switch ($_SESSION['m']) {
    case 'newUserSuccess':
      $siteMessage = "New user created successfully!";
      break;
    case 'newUserSetup':
      $siteMessage = "User setup complete!";
      break;
    case 'verificationSent':
      $siteMessage = "Your verification link has been sent to the email we have on file.  Please make sure to check your junk or spam folder if you do not see it in your inbox.";
      break;
    case 'emailSuccess':
      $siteMessage = "Your email has been sent. Thank you, we will get back to you as soon as we can.";
      break;
    default:
      $siteMessage = "";
      break;
  }
}

// 'e' or errors
if(isset($_SESSION['e'])){
  switch ($_SESSION['e']) {
    case 'login-error':
      $siteError = "Username or Password is Incorrect.";
      break;
    case 'timeout':
      $siteError = "Sorry but you have been logged out due to inactivity.";
      break;
    case 'userAlreadyExists':
      $siteError = "A user with that username already exist.";
      break;
    case 'badpass':
      $siteError = "Passwords did not match, try again.";
      break;
    case 'formtime':
      $siteError = "That was a bit fast? Are you a bot?";
      break;
    case 'honey':
      $siteError = "Looks like you left a few blank, try again please!";
      break;
    case 'email':
      $siteError = "Looks like one or more of your emails are bad, try again.";
      break;
    case 'requiredInput':
      $siteError = "You missed one or more required fields.";
      break;
    case 'userDoesNotExists':
      $siteError = "This user does not exist.";
      break;
    case 'badCurrentPass':
      $siteError = "Your current password did not match our records. Please try again.";
      break;
    case 'alreadyHaveQuoteNUM':
      $siteError = "A quote # has already been submitted. Please finish verification before entering a new quote.";
      break;
    case 'badVerification':
      $siteError = "your verification code did not match the one we have on file.";
      break;
    case 'userNotExsist':
      $siteError = "We are sorry but a user by that name does not exist in our system.";
      break;
    case 'systemError';
      $siteError = "There has been a system error. An email has been sent to our development team, so they can assess and fix any issues. Thank you.";
      break;
    case 'emailFailed':
      $siteError = "The email system seems to have failed! We apologize for this and will star working on it.";
      break;
    case 'requiredInput':
      $siteError = "Oops, somehow you seemed to have missed some required inputs!";
      break;
    case 'emailNotValid':
      $siteError = "Your email is not valid, please try again with a valid email.";
      break;
    case 'honeypot':
      $siteError = "Interesting....";
      break;
    case 'formTime':
      $siteError = "That was a bit quick, like to quick! Are you a bot by chance?";
      break;
    default:
      $siteError = "";
      break;
  }
}

 ?>
