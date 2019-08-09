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
$gsap           = true;
$sweetalert     = true;
$hammer         = true;
$moment         = true;
$localforage    = true;

//Vue.js
$useVuejs       = false;

//google stuff
$googleAnalytics = "";
$gmailUser       = "email@gmail.com";
$gmailPass       = "gamilPassword";
$my_email        = "return or reply email";
//global loader
$globalLoader   = false;

//db settings
/* *******************************************************
before setting $useDB to true make sure you have a db in place
AND have assets/dev/db/_connection.php filled in
with the appropriate variables to connect to your db
******************************************************* */
$useDB          = false;
$useLogin       = false;
$fullSiteSecure = false;  //if set to true user MUST log in to see anything other than login.php
//This is the option array for password_hash()

// functions
require_once 'functions.php';

//uncomment block below and fill in variables

/*

// db CREDENTIALS===============================================================
$db_name    = 'databaseName';
$db_server  = 'localhost';
$db_user    = 'databaseUser';
$db_pass    = 'databaseUserPassword';
// first user (admin) CREDENTIALS for install===================================
$firstUserFname 		   = "firstAdmin";
$firstUserLname 		   = "lastAdmin";
$firstUser 					   = "admineamil@email.com";
$firstUserCustID 		   = "123456";
$password 				     = "password";

// CONNECTION===================================================================
$bcryptOptions = [ "cost" => 12];
require_once 'assets/build/db/_connection.php';

// in set everything up in browser go to [website URL]/assets/build/db/_install.php
//Then delete _install.php

*/
?>