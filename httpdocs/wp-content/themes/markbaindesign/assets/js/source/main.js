/*
===============================================
		
		Remove "no-js" class  
	
===============================================
*/	

jQuery( document ).ready( function( $ ) {
	document.documentElement.className = 
       document.documentElement.className.replace("no-js","js");
});

/*
===============================================
		
		Google Analytics  
	
===============================================
*/	

jQuery( document ).ready( function( $ ) {

	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-32506607-1', 'auto');
	ga('send', 'pageview');

});

/*
===============================================
		
		Headroom.js  
	
===============================================
*/		

jQuery( document ).ready( function( $ ) { // Wrap all scripts in this


// grab an element
var myElement = document.querySelector(".site-header");
// construct an instance of Headroom, passing the element
var headroom  = new Headroom(myElement, {
  "tolerance": 5,
  "offset": 205,
  "classes": {
    "initial": "animated",
    "pinned": "slideDown",
    "unpinned": "slideUp",
    "top": "headroom--top",
    "notTop": "headroom--not-top"
  }
});
// initialise
headroom.init();

(function($) {

});

}); // Wrap all scripts in this

/*
===============================================
		
		FitVids  
	
===============================================
*/		

jQuery( document ).ready( function( $ ) { // Wrap all scripts in this
	
	$(document).ready(function(){
    $("#content").fitVids();
  });

}); // Wrap all scripts in this




/*
=====================================================
		
		Masonry.js
	
=====================================================
*/	

jQuery(document).ready(function($) { // Wrap all scripts in this

		// initialize Masonry

		$container = $('.masonrycontainer').masonry({
			columnWidth: '.grid-sizer',
			gutter: '.gutter-sizer',
			itemSelector: "article"
		
		});
		
		// layout Masonry again after all images have loaded
		
		$container.imagesLoaded( function() {
		$container.masonry();
		});

		

}); // end Wrap all scripts in this


/*
=====================================================
		
		Responsive-nav.js
	
=====================================================
*/

jQuery(document).ready(function($) { // Wrap all scripts in this

	var navigation = responsiveNav(".nav-collapse", {
			animate: true,                    // Boolean: Use CSS3 transitions, true or false
			transition: 284,                  // Integer: Speed of the transition, in milliseconds
			label: "Menu",                    // String: Label for the navigation toggle
			insert: "before",                  // String: Insert the toggle before or after the navigation
			customToggle: "main-menu-toggle",                 // Selector: Specify the ID of a custom toggle
			closeOnNavClick: false,           // Boolean: Close the navigation when one of the links are clicked
			openPos: "relative",              // String: Position of the opened nav, relative or static
			navClass: "nav-collapse",         // String: Default CSS class. If changed, you need to edit the CSS too!
			navActiveClass: "js-nav-active",  // String: Class that is added to <html> element when nav is active
			// jsClass: " ",                    // String: 'JS enabled' class which is added to <html> element
			// Swapping no-js to js with Modernizr instead
			init: function(){},               // Function: Init callback
			open: function(){},               // Function: Open callback
			close: function(){}               // Function: Close callback
		});

}); // end Wrap all scripts in this

/*
=====================================================
		
		Wow.js
	
=====================================================
*/	

jQuery(document).ready(function($) { // Wrap all scripts in this
	new WOW().init();
});

/*
=====================================================
		
		Back to top scrolling
	
=====================================================
*/		

jQuery(document).ready(function($) { // Wrap all scripts in this

	$(document).ready(function(){
		// scroll body to 0px on click
		$('#back-to-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});

});
