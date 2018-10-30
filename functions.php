<?php

//site root
if($GLOBALS['https']){
    $GLOBALS['protocol'] = 'https://';
}else{
    $GLOBALS['protocol'] = 'http://';
}

$GLOBALS['siteRoot'] = $GLOBALS['protocol'] . $_SERVER['HTTP_HOST'] . '/';

if($GLOBALS['maintenance']['status']){
    header('Location: ' . $GLOBALS['siteRoot'] . $GLOBALS['maintenance']['file']);
	exit();
}

//check if production then set version.
if($GLOBALS['production']){ 
    $GLOBALS['v'] = $GLOBALS['version'];
    
}else{
    $GLOBALS['v'] = rand();
    
}

//header footer functions
function siteHeader(){
    if($GLOBALS['production']){
        include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/head.php';
        echo "production is true";
    }else{
        include $_SERVER['DOCUMENT_ROOT'].'/assets/dev/scaffold/head.php';
        echo "production is false";
    }
};

function siteFooter(){
    if($GLOBALS['production']){
        include $_SERVER['DOCUMENT_ROOT'].'/assets/build/scaffold/foot.php';
    }else{
        include $_SERVER['DOCUMENT_ROOT'].'/assets/dev/scaffold/foot.php';
    }
};




//global loader
if($GLOBALS['globalLoader']){
    $GLOBALS['gsap']   = true;
    $GLOBALS['loader'] = true;
}
//page loader
if($GLOBALS['pageLoader']){
    $GLOBALS['gsap']   = true;
    $GLOBALS['loader'] = true;
}

?>