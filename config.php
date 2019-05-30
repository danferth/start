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
$https          = true;
$maintenance  = [
                'status' => false,
                'file'   => 'maintenance.php'
                ];

//db settings
$useDB          = false;

//enable scripts
$gsap           = true;
$sweetalert     = true;
$hammer         = true;
$moment         = true;
$localforage    = true;

//google stuff
$googleAnalytics = "";
$gmailUser       = "user@gmail.com";
$gmailPass       = "passW0rd";

//global loader
$globalLoader   = false;

// functions
require('functions.php');
?>
