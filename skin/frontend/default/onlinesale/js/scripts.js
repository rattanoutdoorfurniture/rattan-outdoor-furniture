

/*
| ----------------------------------------------------------------------------------
| TABLE OF CONTENT
| ----------------------------------------------------------------------------------
|	1. Initialize Slider
|	2. Initialize carousel
|	3. Responsive multi level menu
|	4. Qty
|	5. Scroll Top
|	6. Nav cursor
|	7. Last item
|	8. NAV Mobile 
*/


jQuery(function () {
	

    /*
	| ----------------------------------------------------------------------------------
	| Initialize Slider
	| ----------------------------------------------------------------------------------
	*/


    jQuery('#iview').iView({
        pauseTime: 7000,
        pauseOnHover: true,
        directionNav: true,
        directionNavHide: false,
        controlNav: true,
        controlNavNextPrev: false,
        controlNavTooltip: false,
        nextLabel: "next",
        previousLabel: "prev",
        playLabel: "Jugada",
        pauseLabel: "Pausa",
        timer: "360Bar",
        timerBg: "#EEE",
        timerColor: "#000",
        timerDiameter: 40,
        timerPadding: 4,
        timerStroke: 8,
        timerPosition: "bottom-right",
		fx:'fade'
    });




    /*
	| ----------------------------------------------------------------------------------
	| Initialize carousel
	| ----------------------------------------------------------------------------------
	*/



    jQuery('.bxslider').bxSlider({
        slideWidth: 270,
        minSlides: 4,
        maxSlides: 4,
        slideMargin: 28
    });


    jQuery('.bxslider2').bxSlider({
        slideWidth: 180,
        minSlides: 7,
        maxSlides: 7,
        slideMargin: 0
    });




    jQuery('.category-full-image ul').bxSlider({
        auto: 'true',
        mode: 'vertical',
        pause: 10000
    });


    /*
	| ----------------------------------------------------------------------------------
	| Responsive multi level menu
	| Credits goes to: https://github.com/codrops/ResponsiveMultiLevelMenu
	| Licensed under the MIT License
	| ----------------------------------------------------------------------------------
	*/



    jQuery('#dl-menu ul ul').addClass('dl-submenu');

    jQuery('#dl-menu').dlmenu();
	
    jQuery(".sf-menu li.item").hover(
        function () {

            jQuery(this).children('a').addClass('hover');
        },
        function () {
            jQuery(this).children('a').removeClass('hover');
        }
    );




    /*
	| ----------------------------------------------------------------------------------
	| Qty
	| ----------------------------------------------------------------------------------
	*/


    jQuery(".input-qty-box a").click(function () {
        var inputEl = jQuery(this).parent().parent().children().next().children();
        var qty = inputEl.val();
        if (jQuery(this).parent().hasClass("plus"))
            qty++;
        else
            qty--;
        if (qty < 0)
            qty = 0;
        inputEl.val(qty);
    })

    /*
	| ----------------------------------------------------------------------------------
	| Scroll Top
	| ----------------------------------------------------------------------------------
	*/


    jQuery('.scroll-top-img').click(function (event) {
        event.preventDefault();

        jQuery('html, body').animate({
            scrollTop: 0
        }, 300);
    });

    /*
	| ----------------------------------------------------------------------------------
	| Nav cursor
	| ----------------------------------------------------------------------------------
	*/

    jQuery(".sf-menu li").hover(
        function () {
            jQuery(this).children('.level-top').addClass('hover');
            jQuery(this).children('.level-top').addClass('parent');
        },
        function () {
            jQuery(this).children('.level-top').removeClass('hover');
            jQuery(this).children('.level-top').removeClass('parent');
        }
    );




    /*
	| ----------------------------------------------------------------------------------
	| Add Last class
	| ----------------------------------------------------------------------------------
	*/



    jQuery('.footer-banner a:last-child').addClass('last');

    jQuery('.promo-right p:last-child').addClass('last');

    jQuery('.cms-index-index .products-grid li:nth-child(4n)').addClass('last');
	
	
	  /*
	| ----------------------------------------------------------------------------------
	| NAV Mobile 
	| ----------------------------------------------------------------------------------
	*/
  
	 jQuery(".dropdown-toggle").click(function () {
      jQuery('.btn-group-top-mobile .dropdown-menu').toggle();
    });
	
	
		  /*
	| ----------------------------------------------------------------------------------
	| NAV Footer
	| ----------------------------------------------------------------------------------
	*/
  
	 jQuery(" #footer h4").click(function () {
      jQuery(this).next('.block_content').toggle();
    });


});