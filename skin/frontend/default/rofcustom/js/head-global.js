/**
 * Global Javascript removed from HEAD
 * This file contains javascript that must get run on every page, or
 * needs to fire on the jQuery document.ready, with a conditional
 * based on the URL or DOM to determine if the code should run.
 */
jQuery(document).ready(function($){

    $(".nav-main-item:not(.selected)").on("click", function() {
        $(this).siblings(".selected").removeClass("selected").end().addClass("selected");
    });

    $("#mobile-search-toggle").on("click",function() {
        $(".nav-main-item.search").toggleClass("float-show");
        return false;
    });

    $(".main-nav-select").on("change", function() {
        if($(this).val()!='') {
            $(".main-nav-select-loading").show();
            window.location.href=$(this).val();
        }
    }).find("option.first").on("select", function() {
        if($(this).val()!='') {
            $(".main-nav-select-loading").show();
            window.location.href=$(this).val();
        }
    });

    $("#footer-newsletter").on("submit",function(e) {
        var $form    = $(this);
        var postUrl  = $form.prop("action");
        var email    = $form.find("#footer-newsletter-input").val();
        var $msgs    = $form.find("#footer-newsletter-msg").text('&nbsp;').removeClass("error overlay").stop(true,true);

        // Test for Valid Email Address
        if(!(/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{1,4}$/.test(email))) {
            $msgs.
                fadeOut(0).
                text("Invalid Email Address").
                addClass("error").
                fadeIn(500, function() {
                    var $this = $(this);
                    setTimeout(function() {
                        $this.fadeOut(500, function() {
                            $this.removeClass("error");
                        });
                    }, 1500);
                });
            return false;
        }

        $msgs.
            fadeOut(0).
            text("Joining Newsletter...").
            addClass("overlay").
            fadeIn(200);

        var formData = {
            "email": email
        };

        $.ajax({
            url: postUrl,
            method: "POST",
            data: formData,
            success: function() {
                $msgs.text("Thanks for Joining!");
            },
            error: function() {
                $msgs.stop().removeClass("overlay").
                    fadeOut(0).
                    text("Error: Try Again").
                    addClass("error").
                    fadeIn(500, function() {
                        var $this = $(this);
                        setTimeout(function() {
                            $this.fadeOut(500, function() {
                                $this.removeClass("error");
                            });
                        }, 1500);
                    });
            }
        });

        return false;

    });

    var $add_btns;
    if(($add_btns = $(".category-product-add")).length) {
        $add_btns.on("click", function(e) {
            e.preventDefault();
            e.stopPropagation();
            var addToCartUrl = $(this).data("url");
            setLocation(addToCartUrl);
        });
    }

    if($("#category-slider").length) {
        $("#category-slider-inner")
            .on("swiperight", function() {
                $("#category-slider-prev").trigger("click");
            })
            .on("swipeleft",function(){
                $("#category-slider-next").trigger("click");
            });
        $(".category-slider-nav").on("click", function(e) {
            var $btn = $(this);
            if($btn.parent().data('proc')==true) return false;
            $btn.parent().data('proc', true);
            if($btn.hasClass('disabled')) return false;
            var $oBtn  = $btn.siblings(".category-slider-nav");
            var dir    = $btn.attr("id") == "category-slider-prev" ? 1 : -1;
            var $wrap  = $("#category-slider-inner");
            var $table = $("table", $wrap);
            if(!$table.length) return false;
            var tableW = $table.width();
            var curOff = $table.position().left;
            var dist   = $table.find("td").width();
            var reset  = false;
            if(dir>0) {
                if((curOff*-1)<dist) { // No More Items To The Left
                    $table.find("tr").prepend($table.find("td").last()); // Move last item to front
                    $table.css("left",dist*-1); // compensate for movement
                }
            } else {
                if(tableW-$wrap.width()-(curOff*dir) < (dist-10)) { // No More Items to the Right
                    reset = true; // no more items, slide back to beginning
                }
            }
            var newLeft = reset ? "0" : "+=" + (dir*dist);
            var $aniDone = $table.animate({
                left: newLeft
            },{
                duration: 250
            });
            $.when($aniDone).done(function() {
                $btn.parent().data('proc',false);
            });
            return false;
        });
    }

    if(jQuery(".glob-search-focus").length) {
        window.flashSearch    = window.flashSearch || function() {};
        window.flashSearchRan = false;
        jQuery.getScript("/skin/frontend/default/rofcustom/js/jquery.animate-shadow-min.js", (function() {
            window.flashSearch = function() {
                var caller = window.flashSearch.caller;
                var $input = jQuery('#glob-search-input');
//                $input.focus();
//                $input.animate({opacity:1.0},1);
//                $input.animate({boxShadow:"0 0 0 transparent"},1);
                $input.animate(
                    {
                        //opacity: 0.2,
                        boxShadow: "-5px 0px 5px #8a6399"
                    },
                    (!!window.flashSearchRan?250:1),
                    "swing",
                    function() {
                        $input.animate(
                            {
                                //opacity: 1.0,
                                boxShadow: "none"
                            },
                            (!!window.flashSearchRan?250:1),
                            "swing",
                            function() {
                                $input.focus();
                                if(window.flashSearchRan!==true) {
                                    window.flashSearchRan=true;
                                    window.flashSearch();
                                }
                            }
                        );
                    }
                );
            };
        }));
        jQuery(".glob-search-focus").on("click", function(){
            var $body  = jQuery("body");
            var $input = jQuery('#glob-search-input');
            var inpTop = $input.offset().top;
            var curTop = $body.scrollTop();
            var intTop = inpTop - 20;
            if(curTop > intTop) {
                $body.animate({scrollTop:intTop},300,"linear",window.flashSearch);
            } else {
                window.flashSearch();
            }

            return false;
        });

    }

    var nextTabBtn;
    if((nextTabBtn = jQuery("#product-tabs-next")).length) {
        var $tabs = jQuery(".product-tab");
        var curTab = $tabs.filter(".active").index(".product-tab");
        var nextTab = curTab+1 >= $tabs.length ? 0 : curTab+1;
        var nextTitle = $tabs.eq(nextTab).find(".product-tab-title").text().split(" ")[0];
        jQuery("#product-tabs-next-label").text(nextTitle);
        nextTabBtn.on("click", function() {
            var $tabs = jQuery(".product-tab");
            var curTab = $tabs.filter(".active").index(".product-tab");
            var nextTab = curTab+1 >= $tabs.length ? 0 : curTab+1;
            var nextTitle = $tabs.eq(nextTab+1>=$tabs.length?0:nextTab+1).find(".product-tab-title").text().split(" ")[0];
            jQuery("#product-tabs-next-label").text(nextTitle);
            $tabs.eq(nextTab).find(".product-tab-title a").trigger("click");
        });
    }

    if(location.pathname.match(/^\/$/)) {
        if(jQuery(".home-slide").length>=3) {
            jQuery.homeSlider = function() {
                jQuery.homeSlider.slide = function() {
                    this.deferred   = jQuery.Deferred();
                    var $_def_current   = jQuery.Deferred();
                    var $_def_next      = jQuery.Deferred();
                    var $_slides        = jQuery('.home-slide');
                    var $_slide_current = $_slides.filter(".current");
                    var $_slide_next    = $_slides.filter(".next");
                    var $_new_next      = $_slide_next.next();
                    $_new_next      = !!$_new_next.length ? $_new_next : $_slides.first();
                    var $_slide_prev    = $_slides.filter(".prev");
                    $_slide_current.fadeOut(
                        "slow",
                        function() {
                            jQuery(this).
                                addClass("prev").
                                removeClass("current");
                            $_def_current.resolve();
                        }
                    );
                    $_slide_next.fadeIn(
                        "slow",
                        function(){
                            jQuery(this).
                                addClass("current").
                                removeClass("next");
                            $_def_next.resolve();
                        }
                    );
                    $_slide_prev.removeClass("prev");
                    $_new_next.addClass("next").removeClass("prev current");
                    jQuery.when($_def_current, $_def_next).done(this.deferred.resolve);

                };
                jQuery.homeSlider.deferred  = null;
                jQuery.homeSlider.timeout   = 5000;
                jQuery.homeSlider.stop      = function() {
                    clearTimeout(jQuery.homeSlider.To);
                };
                jQuery.homeSlider.ToFunc    = function() {
                    jQuery.homeSlider.slide();
                    jQuery.when(jQuery.homeSlider.deferred).done(function() {
                        clearTimeout(jQuery.homeSlider.To);
                        jQuery.homeSlider.To = setTimeout(jQuery.homeSlider.ToFunc,jQuery.homeSlider.timeout);
                    });
                };
                jQuery.homeSlider.To = setTimeout(jQuery.homeSlider.ToFunc,jQuery.homeSlider.timeout);
            };
            jQuery.homeSlider();
        }
    }
    if(location.href.match(/products/)) {
        jQuery(".product-details-options-color-swatch").bind("click", function(e) {
            var $this       = jQuery(this);
            $this.siblings(".selected").removeClass("selected");
            var selection   = $this.data('color');
            var parent      = $this.addClass("selected");
            jQuery("select[name^=options] option").filter(function() {
                $opt = jQuery(this);
                toSel = !!($opt.val()==selection);
                return toSel;
            }).prop('selected', true);
        });
    }
    if(location.href.match(/(onepage|checkout)/)) {
        /*
         | ----------------------------------------------------------------------------------
         | Password Generator
         | ----------------------------------------------------------------------------------
         */
        jQuery.password = function (length, special) {
            var iteration = 0;
            var password = "";
            var randomNumber;
            if(special == undefined){
                var special = false;
            }
            while(iteration < length){
                randomNumber = (Math.floor((Math.random() * 100)) % 94) + 33;
                if(!special){
                    if ((randomNumber >=33) && (randomNumber <=47)) { continue; }
                    if ((randomNumber >=58) && (randomNumber <=64)) { continue; }
                    if ((randomNumber >=91) && (randomNumber <=96)) { continue; }
                    if ((randomNumber >=123) && (randomNumber <=126)) { continue; }
                }
                iteration++;
                password += String.fromCharCode(randomNumber);
            }
            return password;
        };

        /*
         | ----------------------------------------------------------------------------------
         | Credit Card Type Selector
         | ----------------------------------------------------------------------------------
         */
        jQuery.getCreditCardType = function(val) {
            if(!val || !val.length) return undefined;

            switch(val.charAt(0)) {
                case '4': return 'VISA';
                case '5': return 'MC';
                case '3': return 'AMEX';
                case '6': return 'DISCOVER';
                default: return 'NN';
            };

            return undefined;
        };

        jQuery.fn.creditCardType = function(options) {
            var settings = {
                target: '#credit-card-type'
            };

            if(options) {
                jQuery.extend(settings, options);
            };

            var keyupHandler = function() {
                var background_position = '0 0';
                var card_code = "";
                switch(jQuery.getCreditCardType($(this).val())) {
                    case 'VISA':
                        background_position = '0 -23px';
                        card_code = "VI";
                        break;
                    case 'MC':
                        background_position = '0 -46px';
                        card_code = "MC";
                        break;
                    case 'AMEX':
                        background_position = '0 -69px';
                        card_code = "AE";
                        break;
                    case 'DISCOVER':
                        background_position = '0 -92px';
                        card_code = "DI";
                        break;
                    case 'NN':
                    default:
                        background_position = '0 0';
                        card_code = "NN";
                };
                if(card_code!=="") {
                    jQuery(".active",settings.target).removeClass("active");
                    jQuery(settings.target+" ."+card_code).addClass("active");
                    jQuery("select#paypal_direct_cc_type option").filter(function() {
                        return (jQuery(this).val() == card_code);
                    }).prop("selected", true);
                }
            };

            return this.each(function() {
                jQuery(this).parent().on('keyup', "input",keyupHandler).trigger('keyup');
            });
        };
        if(jQuery('#paypal_direct_cc_number').length) {
            jQuery('#paypal_direct_cc_number').creditCardType();
        }
    }
});