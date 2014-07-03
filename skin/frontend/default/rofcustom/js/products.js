function addToFavorites() {
    url = "<?php echo $url; ?>";
    title = document.title.toString();
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
    if(location.hash) {
        jQuery(location.hash).parents("#product-tabs").find(".product-tab").removeClass("active").end().addClass("active");
    }
    if(document.getElementById("product-tabs")) {
        //console.log("Ajax Loading Product Tab Content");
        var $faqLoad = jQuery.Deferred();
        var $sarLoad = jQuery.Deferred();
        jQuery(".product-tab-body", "#product-tabs-faq").load("/faq .account-box-inner",function(){$faqLoad.resolve();});
        jQuery(".product-tab-body", "#product-tabs-special").load("/shipping-and-returns .account-box-inner",function(){$sarLoad.resolve();});
        jQuery.when($faqLoad,$sarLoad).done(function() {
            console.log("Done Loading Product Tab Content");
        });
    }

});