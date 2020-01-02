//go nuts!



//doc ready
$(document).ready(function(){

  //active class for nav items
  var navLinks = $('li.nav-item a.nav-link');
  for (var i = 0; i < navLinks.length; i++) {
    var h = $(navLinks[i]).attr('href');
    //activePage is set in the footer with PHP
    if(h === activePage){
      $(navLinks[i]).addClass('active');
    }
  }


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


//order confirm page
if($('table#orderConfirm').length > 0){
  var tax = $('.totalTax').html();
  $('.item').each(function(){
    var qty = $(this).children('td.qty').html();
    var price = $(this).children('td.price').html();
    var total = currency(price).multiply(qty).format();
    $(this).children('td.total').html(total);
  });

  var wholeTotal = 0;
  var totalCol = $('.total');
  totalCol.each(function(){
    var tmp = $(this).html();
    wholeTotal = currency(tmp).add(wholeTotal).format();
  });
  var finalTotal = currency(tax).add(wholeTotal).format();
  $('.subTotal').html(wholeTotal);
  $('.wholeTotal').html(finalTotal);
}

}); //END Doc.ready
