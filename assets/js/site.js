//go nuts!
//to have something parse before anything else add the code to ../lib/AAA.js it is the first file in the concatenation process
//initialize foundation
$(document).foundation();


//doc ready
$(document).ready(function(){
    console.log("doc ready: " + Date());
}); //END Doc.ready


//doc load
$(window).on('load', function(){
    console.log("doc loaded: " + Date());
}); //END WIN.load

