/*!
 * jPushMenu.js
 * 1.1.1
 * @author: Tom Osborne
 */

//preload - add transition after page load

var preload = function() {
	$('.widget-area-left').addClass('transition');
	$('.widget-area-right').addClass('transition');
	$('.content-area').addClass('transition');		
};

$( ).ready( preload );

var openMenu = function() {
	$('.hamburger').click(function() {
		$('.widget-area-left').toggleClass('widget-area-left-closed');		
		$('.content-area').toggleClass('content-area-closed');	
		$('.widget-area-right').toggleClass('widget-area-right-closed');		
	});
};

$( document ).ready( openMenu );


// try to control toggle state with cookies
$('nav #mobileMenu').on('click', function() {
    // Get it from the cookie or data.
    if ($.cookie('isToggled') != undefined)
      var isToggled = $.cookie('isToggled');
    else
      var isToggled = $(this).data('isToggled');
    if(isToggled) {
        $("nav#menu").addClass("mobileMenuActive");
        $("nav ul").fadeIn(1000);
        $("nav em").fadeOut('fast');
    } else {
        $("nav#menu").removeClass("mobileMenuActive");
        $("nav ul").fadeOut(1000);
        $("nav em").fadeIn('fast');   
    }

    $(this).data('isToggled', !isToggled)
    $.cookie('isToggled', !isToggled, { expires: 7, path: '/' });
})
