$(document).ready(function(){

    // function to show our popups
    function showPopup(whichpopup,linkSrc){
        var docHeight = $(document).height(); //grab the height of the page
        var scrollTop = $(window).scrollTop(); //grab the px value from the top of the page to where you're scrolling
        $('.overlay-bg').show().css({'height' : docHeight}); //display your popup background and set height to the page height
        $('.popup'+whichpopup).show().css({'top': scrollTop+200+'px'}); //show the appropriate popup and set the content 20px from the window top
        //var linkSrc = $(this).parents('.popup-slider').find('a').attr('rel');
        //console.log(linkSrc);
        //var linkSrc = 'http://www.youtube.com/embed/ze1DA3z02io';
        $('.popup1 .pop-pic').find('iframe').attr('src', linkSrc);
    }

    // function to close our popups
    function closePopup(){
        $('.popup1 .pop-pic').find('iframe').attr('src', '');
        $('.overlay-bg, .overlay-content').hide(); //hide the overlay
    }

    // show popup when you click on the link
    $('.show-popup').click(function(event){
        event.preventDefault(); // disable normal link function so that it doesn't refresh the page
        var selectedPopup = $(this).data('showpopup'); //get the corresponding popup to show
        var linkSrc = $(this).parents('.popup-slider').find('a').attr('rel');
        //console.log(linkSrc);
        showPopup(selectedPopup,linkSrc); //we'll pass in the popup number to our showPopup() function to show which popup we want
    });

    // hide popup when user clicks on close button or if user clicks anywhere outside the container
    $('.close-btn, .overlay-bg').click(function(){
        closePopup();
    });
    
    // hide the popup when user presses the esc key
    $(document).keyup(function(e) {
        if (e.keyCode == 27) { // if user presses esc key
            closePopup();
        }
    });
});