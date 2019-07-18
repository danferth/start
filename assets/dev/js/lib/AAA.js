//AAA should be loaded first when concatinating.

//removes class 'no-js' from body so you know js is enabled.  Do what you want with this information
document.querySelector('body').classList.remove('no-js');

var closeError = function(){
  $.ajax({
    type: "POST",
    url: "closeCallout.php",
    data: {callout: 'e'},
    complete: function(){
      window.location.reload(true);
    }
  })
};

var closeMessage = function(){
  $.ajax({
    type: "POST",
    url: "closeCallout.php",
    data: {callout: 'm'},
    complete: function(){
      window.location.reload(true);
    }
  })
};
