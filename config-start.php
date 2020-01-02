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
/* NOTICE:
display_errors = off
(this needs to be set in /etc/php/7.2/apache2/php.ini for production)
*/

$version        = '1.0.0';

//SERVER & MAINTENANCE settings
$maintenance  = [
                'status' => false,
                'file'   => 'maintenance.php'
                ];

//enable scripts
$gsap           = false;
$sweetalert     = true;
$hammer         = false;
$moment         = false;
$localforage    = false;

//Vue.js
$useVuejs       = false;

//google stuff
$googleAnalytics = "";
$gmailUser       = "yourGmail@gmail.com";
$gmailPass       = "gmailPassword";
$my_email        = "email you want to be the sender";
//global loader
$globalLoader   = false;

//regEx stuff for password
$passwordRegEx = '(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W|_])(?=.*[^\s])[a-zA-Z\d\W_]{6,12}';



//db settings
/* *******************************************************
before setting $useDB to true make sure you have a db in place
AND have assets/dev/db/_connection.php filled in
with the appropriate variables to connect to your db
******************************************************* */
$useDB          = true;
$useLogin       = true;
$fullSiteSecure = false;
//This is the option array for password_hash()
$bcryptOptions = [ "cost" => 12];

//Default Time DateTimeZone
date_default_timezone_set('America/Los_Angeles');

// functions
require_once 'functions.php';
//uncomment _connection line below and go to file and fill in credentials
require_once 'assets/build/db/_connection.php';
?>
