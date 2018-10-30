<?php

//is the site in production
$GLOBALS['production']    = false;
//if not in production, what is the version for css and js
$GLOBALS['version']        = '1.0.0';

//SERVER & MAINTENANCE settings
$GLOBALS['https']          = true;
$GLOBALS['maintenance']  = [
                'status' => false,
                'file'   => 'maintenance.php'
                ];

//enable scripts
$GLOBALS['gsap']           = true;
$GLOBALS['sweetalert']     = true;
$GLOBALS['hammer']         = true;
$GLOBALS['moment']         = true;
$GLOBALS['localforage']    = true;

//google stuff
$GLOBALS['googleAnalytics'] = "";
$GLOBALS['gmailUser']       = "user@gmail.com";
$GLOBALS['gmailPass']       = "passW0rd";

//global loader
$GLOBALS['globalLoader']   = false;

// functions
require('functions.php');
?>