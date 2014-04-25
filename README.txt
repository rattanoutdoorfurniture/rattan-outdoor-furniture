Rattan Outdoor Furniture
========================

Overview
--------
This file will contain daily update information, along with general todos and
should generally cover the progress made and to be made on the Rattan Outdoor
Furniture web site project.

Global To Do:
-------------
*Global search functionality
*Add functionality to footer newsletter form
*Decide Product Categories and create pages/categories
*Fix "Selected" main menu style


Change Log:
------------

##2014-04-25##

*Set Listing image dimensions in the magento backend. __DO NOT FORGET TO UPLOAD DATABASE LATER__!
*Begin working on the product list (browse) page. Worry about 'selected' menu item later.

###2014-04-24###
*TODO: Next to be done, to be started tomorrow morning) continue syling the sub-pages: focus on the browse (/products.html) and product (/products/chairs/*.html) pages.
*Fixed 'About Us' menu issue, but need to fix the "selected" menu item code.
*At the end of the day, the home page should be pretty solid. The 'About Us' link in the header has a style issue when on sub-pages.
*Site structure looks good. Category and Product exist and are being read in place.
*Create fake product for system (there is going to have to be at least 1 category and 1 product for the store to make all the pages I will need to code. I am adding a fake category "Charis" which I am adding a fake product "Brighton Sling Chaise Lounge", which I will fill with the info from the design, for familiarity.
*Add FireGento plugin and php logger to help de-bug-ing.
*(3PM) Wrap up most of home page (complete for now). Fixed some elements in the header. Fix styles for main content area. Also fix footer styles, and fix issue causing footer to be extremely tall.
*Fix an issue with the navigation. it was only pulling in one item. Products would not show up. this is fixed. Next will be moving on to the footer.
*Get global search (in main nav bar) to be loaded through magento's sub-system for this. I was having issues, but it should be loading correctly now. This will need more work (to make the search actually work). Leave this the way it is for now, and come back to it. Move onto footer.
*Fix main nav to auto-load pages. Manually add Home link and Blog link.
*Pick back up where I had left off yesterday. Get list elements to read correctly. Fix classes for top nav and main nav.

###2014-04-23###
*Finish day with files open in location of last edits. In the middle of editing the main navigation.
*Note: var linkData = [];jQuery("li[data-link-data]").each(function(){linkData.push(jQuery.parseJSON($(this).attr('data-link-data')))});
*Disable wishlist in magento admin. I am just going to disable the wishlist plugin thru the magento admin panel. If this is something we want to re-enable later, that can be done, but for now, I do not want to waste time with it if we are not even using it now. System>Configuration>Customers>Wishlist>Enabled=No
*Begin creating new design layouts in magento. Pick up with the 1 column layout, where the header is being put in place. Continue working on header, and menues. The navigation must be edited across the magento file structure. The separation of files, while it will be nice later, is currently complicating getting everything in place.

###2014-04-22###
*Begin the magento install of the new Design pages. Start with the 1 column layout which everything else will be built off of. Started this process. Layout file is updated, and the 'head' of the page is tentatively in place. Need to continue working on the page header along with the menues.
