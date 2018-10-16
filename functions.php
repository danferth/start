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
if($production){ $v = $version; }else{ $v = rand(); }


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