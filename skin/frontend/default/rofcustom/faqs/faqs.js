jQuery(document).ready(function() {
    jQuery("h2,.expanded").on("click", function(e) {
        var breakAfterHide = false;
        if(jQuery(this).hasClass("expanded")) breakAfterHide = true;
        if(jQuery(".expanded").length) {
            jQuery(".expanded").removeClass("expanded qbreak");
        }
        if(breakAfterHide) return false;
        var $this    = jQuery(this);
        var toExpand = jQuery();
        toExpand = toExpand.add($this);
        var $curElem = $this;
        while($curElem.next()[0].tagName.toLowerCase() == "p") {
            $curElem = $curElem.next();
            toExpand = toExpand.add($curElem);
        }
        toExpand.addClass("expanded").filter("p:last").addClass("qbreak");
    });
});