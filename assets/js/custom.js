// nav js start here 
function openNav() {
  document.getElementById("mySidenav").style.width = "300px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
// nav js start here 

$('#pro-owl1').owlCarousel({
loop:true,
autoplay:true,
autoplayTimeout:5000,
margin:10,
nav:true,
responsive:{
0:{
items:1
},
600:{
items:3
},
1000:{
items:4
}
}
})
$('#pro-owl2').owlCarousel({
loop:true,
autoplay:true,
autoplayTimeout:5000,
margin:10,
nav:true,
responsive:{
0:{
items:1
},
600:{
items:3
},
1000:{
items:4
}
}
})
$('#pro-owl3').owlCarousel({
loop:true,
autoplay:true,
autoplayTimeout:5000,
margin:10,
nav:true,
responsive:{
0:{
items:1
},
600:{
items:3
},
1000:{
items:4
}
}
})

$('#pro-owl4').owlCarousel({
loop:true,
autoplay:true,
autoplayTimeout:5000,
margin:10,
nav:true,
responsive:{
0:{
items:1
},
600:{
items:3
},
1000:{
items:4
}
}
})


$('#brand-owl1').owlCarousel({
loop:true,
autoplay:true,
autoplayTimeout:5000,
margin:10,
nav:true,
responsive:{
0:{
items:1
},
600:{
items:3
},
1000:{
items:4
}
}
})

$('#customer-owl2').owlCarousel({
loop:true,
autoplay:false,
autoplayTimeout:5000,

nav:true,
responsive:{
0:{
items:1
},
600:{
items:3
},
1000:{
items:4
}
}
})


$(document).ready(function(){

var quantitiy=0;
$('.quantity-right-plus').click(function(e){

// Stop acting like a button
e.preventDefault();
// Get the field name
var quantity = parseInt($('#quantity').val());

// If is not undefined

$('#quantity').val(quantity + 1);


// Increment

});

$('.quantity-left-minus').click(function(e){
// Stop acting like a button
e.preventDefault();
// Get the field name
var quantity = parseInt($('#quantity').val());

// If is not undefined

// Increment
if(quantity>0){
$('#quantity').val(quantity - 1);
}
});

});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


$('input,select,textarea').focus(function(){
  $(this).parents('.form-group').addClass('focused');
});

$('input,select,textarea').blur(function(){
  var inputValue = $(this).val();
  if ( inputValue == "" ) {
    $(this).removeClass('filled');
    $(this).parents('.form-group').removeClass('focused');  
  } else {
    $(this).addClass('filled');
  }
}) ;

$('#new,#cancel').click(function(){
$('#form-address').toggle();

});

function readURL(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
          $('#blah')
              .attr('src', e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
  }
}