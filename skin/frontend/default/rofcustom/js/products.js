function addToFavorites() {
    var url = location.href;
    var title = document.title.toString();
    if(window.sidebar){
        window.sidebar.addPanel(title, url, "");
    } else if(document.all){
        window.external.AddFavorite(url, title);
    } else if(window.opera && window.print){
        alert('Press ctrl+D to bookmark (Command+D for macs) after you click Ok');
    } else if(typeof(window.chrome)!="undefined"){
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
        //location.hash = this.hash;
        jQuery(document).scrollTop(scrollTop);
        return false;
    });
    if(jQuery(".grouped-items-table").length) {
        var $price = jQuery("#product-details-price-sale-price");
        var $qtys = jQuery("input[name^='super_group']");
        $qtys.on("keyup change", function() {
            var newPrice = 0;
            var NaNbreak = false;
            $qtys.each(function() {
                var $qty  = jQuery(this);
                var qty   = parseInt($qty.val());
                if(isNaN(qty)) {
                    NaNbreak = true;
                }
                var qprice = parseFloat($qty.parents("tr").find(".price").text().replace(/,/g,'').match(/\d+\.?\d{1,2}/).toString());
                newPrice += (qty * qprice);
            });
            if(NaNbreak) {
                NaNbreak = false;
                $price.html("-------");
                return;
            }
            newPrice = Math.round(newPrice);
            var newPriceParts = newPrice.toString().split(".");
            var npDollars     = newPriceParts[0];
            //var npCents       = newPriceParts.length == 2 ? newPriceParts[1] : "00";
            npDollars     = npDollars.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            //newPrice = npDollars+"."+(npCents+"00").slice(0,2);
            //$price.html("$"+newPrice);
            $price.html("$"+npDollars);
        });
    }
});

document.observe("bundle:reload-price",function(event) {
    var orgPrice;
    if((orgPrice = $("product-details-price-original-price")) && !isNaN(event.memo.price)) {
        orgPrice.update("$"+(event.memo.price*1.2).toFixed(2).toString());
    }
});