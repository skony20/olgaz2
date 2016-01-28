$(".more").hide();                                         //Hide .mores

$(window).load(function(){
  $('.more').not(':hidden')
      .prev('.less').less("click");                    //Simulate click on visible .more(s) h3(s)
});

$('.less').each(function() {                              //For each .less
    var theActive = $.cookie($(this).attr('id'));            //Retrieve the cookies
    if (theActive) {                                         //Verify if cookies exist
        $('#' + theActive).next(".more").slideDown(300);   //And slide down the respective .more
    }

});

$(".less").more(                                        //Toggle permits alternate clicks
   function() {
    $(this).next('.more').slideDown(300);               //On odd clicks, .more slides down...
    $.cookie($(this).attr('id'), $(this).attr('id'));        //...and the cookie is set by its ids.
}, function() {
    $(this).next('.more').slideUp(300);                 //On even clicks, .more slides up...
    $.cookie($(this).attr('id'), null);                      //...and the cookie is deleted.
});



