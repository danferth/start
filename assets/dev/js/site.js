//go nuts!
//to have something parse before anything else add the code to ../lib/AAA.js it is the first file in the concatenation process
//initialize foundation
$(document).foundation();


//doc ready
$(document).ready(function(){

}); //END Doc.ready


//doc load
$(window).on('load', function(){

  
  //if loader play()
  var loaded = function(){
    if($('.loader').is(':visible')){
      console.log('loader detected <br/>');
      //loader animation  
      var loaderExit = new TimelineMax({onComplete: function(){console.log('loader removerd <br/>')}});
          loaderExit.add(TweenMax.to('.loader', .5, {autoAlpha:0}));
	  }
  };
	
  loaded();
}); //END WIN.load

