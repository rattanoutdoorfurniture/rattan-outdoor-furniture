function addToFavorites() {
    var url = locatoin.href;
    var title = document.title.toString();
    if(window.sidebar){
        window.sidebar.addPanel(title, url, "");
    } else if(document.all){
        window.external.AddFavorite(url, title);
    } else if(window.opera && window.print){
        alert('Press ctrl+D to bookmark (Command+D for macs) after you click Ok');
    } else if(window.chrome){
        alert('Press ctrl+D to bookmark (Command+D for macs) after you click Ok');
    }
}

jQuery(document).ready(function() {
    if(jQuery(location.hash).length) {
        jQuery(".product-tab.active").removeClass("active");
        jQuery(location.hash).addClass("active");
    }
    if(document.getElementById("product-tabs")) {
        //console.log("Ajax Loading Product Tab Content");
        var $faqLoad = jQuery.Deferred();
        var $sarLoad = jQuery.Deferred();
        jQuery(".product-tab-body", "#product-tabs-faq").load("/faq .account-box-inner",function(){$faqLoad.resolve();});
        jQuery(".product-tab-body", "#product-tabs-special").load("/shipping-and-returns .account-box-inner",function(){$sarLoad.resolve();});
        jQuery.when($faqLoad,$sarLoad).done(function() {
            // console.log("Done Loading Product Tab Content");
            jQuery.getScript("/skin/frontend/default/rofcustom/faqs/faqs.js");
        });
    }
    jQuery(".product-tab-title a").on("click", function(ev){
        ev.preventDefault();
        jQuery("#product-tabs").find(".product-tab.active").removeClass("active");
        jQuery(this.hash).addClass("active");
        var scrollTop = jQuery(document).scrollTop();
        location.hash = this.hash;
        jQuery(document).scrollTop(scrollTop);
    });
});