//go nuts!
//to have something parse before anything else add the code to ../lib/AAA.js it is the first file in the concatenation process
//initialize foundation
$(document).foundation();


//doc ready
$(document).ready(function(){

  //delete users from admin page
  $('.deleteUser').on('click', function(e){
    var userID = $(this).attr('data-userID');

    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete user!'
    }).then(function(result){
      if (result.value) {
        $.ajax({
          type: "POST",
          url: "assets/build/db/_deleteUser.php",
          data: {userID: userID},
          success: function(data){
            Swal.fire({
              title: 'Deleted!',
              text: data,
              type:'success',
              onClose: function(){
                window.location.reload(true);
              }
            })
          }
        })
      }
    })
  });

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
