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
*Create Category Pages (As they are noted on the design)
*[FIXED] Finalize and Normalize canonicalization of category / product links (also fixed canonical link (html element), which is readable by google, so the lineage of the site should be good now. (SEO Win)
*Product reviews (just remove the reviews section for now.)
*Color swatches on Product page. for now just assign a name for each fake color, and pass that along.
*[FIXED]Add color options to the Product in the Magento Backend. This way we can remove a color if it's out of stock. (begin working on this now)


Change Log:
------------

###2014-05-02###

*Instead of moving past the colors, after talking to Larry, I thought this needed to just be fixed so i can move on to the cart. Fixed add to cart. Set and send color and quantity to cart. Working now on re-styling the quantity (now managed by magento too).
*Pulling in color options broke the Add-to-Cart functionality. This should be fixed. Needs to be styled on "container2" for add-to-buttons.
*Got the color options to pull into the product page. Now I'm about to make sure it gets passed to the cart, along with quantity.
*Continue on the product to cart process. Make sure color option and product gets added correctly and start styling the cart and checkout.
*Stop progress on the color swatches. Move this to a later date. Not a priority. we can manage it manually for now. Come back to this. Already added to the TODO.
*Get right back into the colors swatches custom product attribute. So we can manage the cushion color options from the magento admin.

###2014-05-01###
*Make it so you can add the product to the cart. The cart is still unstyled, but the products do add.
*Begin working on color options handled by magento.
*Fixes in the Product details section. Fix quantity to reflect inventory. fix price section. format price as currency.
*Fix the link to the product from the "Newest Products" page. Fixed that canonical / flat url problem with the url.
*Add a notice in the reviews box saying this feature is not available yet. (not a priority for launch). I added a bookmark link, so people can come back to the reviews section.
*Focus on the Product Detials tab box. Make this load the description and add a static block (same for every product) for the FAQ and Special. I think I will remove reviews for now. not needed at launch. add feature in later.
*Take a few minutes to talk to Lesley about a 1br house for rent. Schedule an appointment for later tonight? Also, reply to email regarding unlocked property. I would like to view these 2 tonight. Back into the product page now though.
*To remove Customer Product Tags: "To remove the product tags module (ie. not use product tags?  Admin->system->advanced-> Mage_Tag Disable"
*Take out the trash. And then back into the product page. Remove Customer Product Tagging. This is not a feature we need, at least especially not now. So i will disable it in the admin (require db update).
*I'm feeling pretty good with the product images for now. They pop-up and you can cycle thru them. and "Save Image As..." on right click works (we can make it not, if you'd like).
*Start at 8. Jump right into working on that product page more.

###2014-04-30###
*Some small amount of work done towards the product page. Continue this tomorrow.
*Spent most of the day working on finding a location to live at closer to work.

###2014-04-29###
*Continue working on the category / product linking, for now. once I have this to the point where it leads to no dead links, I will move on to styling the product page. I will come back to finalizing the canonicalization of the category/product links.
*Internet down this morning. Continuing with the category/product issues. I'm going to attempt to mostly just move ahead to the product page.

###2014-04-28###
*Setup all the site category pages, and lineage for flat url and logical url progression (The canonical link thing we talked about before.)
*Continue (move on past related products bug) with the product page. Add new markup, and begin styling.
*Working on a bug with the related products on the product page. This may be something that will solve itself when there are more products to be related to, but for now, change the logic in the "RelatedCategory" module (Related.php). For now just leave this with the fix added here. (@see: \Magebuzz_Relatedcategory_Block_Catalog_Product_List_Related::_prepareData )
*Work on category/product page lineage. "products" root category with url "../products" and sub-categories like "loungers" shouuld be "../products/loungers", and the individual product page would have a url something like "../products/loungers/brighton-sling-chaise-lounge"
*Finish working on the Browse (Category) page. Remove the ".html" from the link (Do this in the Admin interface / database update) Admin>System>Configuration>Catalog>Catalog>SEO>(Product & Category URL Suffix). This will require a flush of the cache.

###2014-04-25###
*List Products in browse. Get category logic fixed. Work on Category/Product view.
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
