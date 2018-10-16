<?php

//is the site in production
$production    = false;
//if not in production, what is the version for css and js
$version        = '1.2.3';

//SERVER & MAINTENANCE settings
$https          = true;
$maintenance  = [
                'status' => false,
                'file'   => 'maintenance.php'
                ];

//enable scripts
$gsap           = true;
$sweetalert     = true;

//global loader
$globalLoader   = false;

// functions
require('functions.php');
?>