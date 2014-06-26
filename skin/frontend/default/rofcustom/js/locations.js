jQuery(document).ready(function() {
    jQuery("<aside>").addClass("cms-widget-state-toggle").html(
        '<a href="#" onclick="' +
        "jQuery('.cms-widget-state-list.collapsed').removeClass('collapsed').addClass('expanded')" +
        ".find('.cms-widget-state-list-more-link').text('view less');return false;" +
        '">show</a>' +
        '<span>&nbsp;/&nbsp;</span>' +
        '<a href="#" onclick="' +
        "jQuery('.cms-widget-state-list.expanded').removeClass('expanded').addClass('collapsed')" +
        ".find('.cms-widget-state-list-more-link').text('view more');return false;" +
        '">hide</a>' +
        '<span>&nbsp;all</span>'
    ).appendTo(".page-title");
    jQuery(".cms-widget-state-list-more-link").on("click", function(e){
        e.preventDefault();
        if(jQuery(this).parents(".collapsed,.expanded").toggleClass("collapsed expanded").hasClass("expanded")) {
            jQuery(this).text("view less");
        }else{
            jQuery(this).text("view more");
        }
    });
    jQuery(".std").gridalicious({
        width: 225,
        selector: '.cms-widget-state-list'
    });
});
