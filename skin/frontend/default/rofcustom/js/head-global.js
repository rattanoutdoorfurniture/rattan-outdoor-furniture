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

    if($("#category-slider").length) {
        $(".cateogry-slider-inner")
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
            if($btn.hasClass('disabled')) return /*console.log("disabled")&&*/false;
            var $oBtn  = $btn.siblings(".category-slider-nav");
            var dir    = $btn.attr("id") == "category-slider-prev" ? 1 : -1;
            var $wrap  = $("#category-slider-inner");
            var $table = $("table", $wrap);
            if(!$table.length) return /*console.log("no table")&&*/false;
            var tableW = $table.width();
            var curOff = $table.position().left;
            var dist   = $table.find("td").width();
            if(dir>0) {
                if((curOff*-1)<dist) return /*console.log("offset less than dist")&&*/false;
            } else {
                if(tableW-$wrap.width()-(curOff*dir) < 0) return false;
            }
            var newLeft = "+=" + (dir*dist);
            var $aniDone = $table.animate({
                left: newLeft
            },{
                duration: 400
            });
            var newOff = curOff+(dir*dist);
            var wrapWid = $wrap.width();

            var canNext = (tableW + newOff) > (wrapWid);
            var canPrev = newOff < 0;
            $.when($aniDone).done(function() {
                if(dir==-1) {
                    // NEXT BUTTON PRESSED
                    if(!canNext) {
                        $btn.addClass("disabled");
                    }
                    if(canPrev) {
                        $oBtn.removeClass("disabled");
                    } else {
                        $oBtn.addClass("disabled");
                    }
                } else {
                    //PREV BUTTON PRESSED
                    if(!canPrev) {
                        $btn.addClass("disabled");
                    }
                    if(canNext) {
                        $oBtn.removeClass('disabled');
                    } else {
                        $oBtn.addClass("disabled");
                    }
                }
                $btn.parent().data('proc',false);
            });
//            if((curOff<dist)&&(tableW-$wrap.width()-(curOff*dir) < 0)) {
//                $btn.addClass("disabled");
//                $oBtn.removeClass("disabled");
//            } else {
//                $btn.removeClass("disabled");
//            }
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