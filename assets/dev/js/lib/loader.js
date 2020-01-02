//function to start loader
var loaderOn = function(){
  if($('.loader').not(':visible')){
    //loader animation
    var loaderEnter = new TimelineMax();
        loaderEnter.add(TweenMax.to('.loader', .5, {autoAlpha:1}));
  }
};
//start loader on click of startLoader
$('.startLoader').on('click', function(e){
  var requiredInputs = $('input').filter('[required]');
  var go = 0;
  var vh = window.innerHeight;
  requiredInputs.each(function(){
    var temp = $(this).val();
    if(temp == ""){
      go = go + 1;
    }
  });
  if(go == 0){
    $('.site-container').css({
      'max-height':vh+'px',
      'overflow':'hidden'
    });
    loaderOn();
  }
});

//button loader
$('.buttonLoader').on('click', function(e){
  var requiredInputs = $('input, textarea').filter('[required]');
  var go = 0;
  var ptb = "<span class='spinner-grow spinner-grow-sm text-warning' role='status' aria-hidden='true'></span><span class='sr-only'>Loading...</span>";
  requiredInputs.each(function(){
    var temp = $(this).val();
    if(temp === ""){
      go = go + 1;
    }
  });
  if(go == 0){
    $(this).html(ptb);
  }
});



//start loader on load
$(window).on('load', function(){
  //if loader play()
  var loaded = function(){
    if($('.loader').is(':visible')){
      //loader animation
      var loaderExit = new TimelineMax();
          loaderExit.add(TweenMax.to('.loader', .5, {autoAlpha:0}));
	  }
  };

  loaded();
}); //END WIN.load
