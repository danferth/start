<?php

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

?>
