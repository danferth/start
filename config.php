<?php
/*
==========is the site in production?==========
the main thing is if production is false then all js and css files will
have a random version number to eliminate any cacheing issues while
in development.

Once production is set to true then
$version below is used for cacheing css and js files
*/
$production    = false;
$version        = '1.0.0';

//SERVER & MAINTENANCE settings
$maintenance  = [
                'status' => false,
                'file'   => 'maintenance.php'
                ];

//db settings
/* *******************************************************
before setting $useDB to true make sure you have a db in place
AND have assets/dev/db/_connection.php filled in
with the appropriate variables to connect to your db
******************************************************* */
$useDB          = false;
$useLogin       = false;
$fullSiteSecure = false;
//uncomment _connection line below and go to file and fill in credentials
//include 'assets/build/db/_connection.php';

//enable scripts
$gsap           = true;
$sweetalert     = true;
$hammer         = true;
$moment         = true;
$localforage    = true;

//Vue.js
$useVuejs       = true;

//google stuff
$googleAnalytics = "";
$gmailUser       = "user@gmail.com";
$gmailPass       = "passW0rd";

//global loader
$globalLoader   = false;

// functions
require('functions.php');
?>
