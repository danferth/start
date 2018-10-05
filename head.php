<?php
session_start();
require('config.php');
$production = false;
if($production){ $v = "3.1.2"; }else{ $v = rand(); } ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $title; ?></title>
        <meta name="description" content="<?php echo $description; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- ***********FAVICON SETTINGS****************** -->
        <!-- generated with the heros at https://realfavicongenerator.net/ -->
        <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicons/favicon-16x16.png">
        <link rel="manifest" href="/assets/favicons/site.webmanifest">
        <link rel="mask-icon" href="/assets/favicons/safari-pinned-tab.svg" color="#e5b02a">
        <link rel="shortcut icon" href="/assets/favicons/favicon.ico">
        <meta name="msapplication-TileColor" content="#ffc40d">
        <meta name="msapplication-config" content="/assets/favicons/browserconfig.xml">
        <meta name="theme-color" content="#f8ebc9">
        <!-- ***********END FAVICON SETTINGS****************** -->
        
        <!-- Humans.txt-->
        <link type="text/plain" rel="author" href="/humans.txt">
        <!-- css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <!-- You know what would be cool? some google font action! -->
        <!-- Well..... we're waiting on the fonts bruh -->
        <link rel="stylesheet" href="/assets/build/css/site.css?ver=<?php echo $v; ?>">

    </head>
    <body class="no-js">
