#Rattan Outdoor Furniture#

##Overview##
This file will contain daily update information, along with general todos and
should generally cover the progress made and to be made on the Rattan Outdoor
Furniture web site project.

##Notes:##
I wanted to start a more general notes section of this file.
Here I will append this section with little notes relative to what I'm working on.
More detailed than in the TODO section, but more general than the change log.

* When there are no color optoins left for a product, magento assumes you will not sell it without a color option to choose. This is something we will have to decice what we want to do. I am thinking that we make a kind of "default" color, so people can still order the product.
* Each product will have 4 images, not 3. The main image should not be re-used in the thumbnail section. (Really weird when cycling through the photos to see the same one twice.)
* Collections section. Like Products, but a top-level category that is called collections, and each collection is a sub-category of that, and all products of a collection (the site [skinny] viewable ones anyway). This does not have to be added to the main menu, but could be. It could also replace the "related" products on the cateogry page (cause that's kind of what a category page is already), so have a "Collections" section below the lounger results, where it would list 4 collections, going to that collection page.

##Global TODO:##
* TONIGHT: Think over other options as to why this is not working. Perhaps a little break from the code will give me a fresh view on the issue. This often helps.

* MUST DO: When you fix something COMMIT IT BEFORE DOING __ANYTHING__ ELSE!
* MUST DO: A Magento DATABASE BACKUP BEFORE __EVERY__ COMMIT!

* Global search functionality
* Add functionality to footer newsletter form
* Fix "Selected" main menu style
* Product reviews (just remove the reviews section for now.)
* Color swatches on Product page. for now just assign a name for each fake color, and pass that along.
* Add-To-Cart bug!!!
* Figure out how we want to handle orders that do not have any available color options (this may be playing a part in why the add-to-cart is broken.)
* Create all sub-category pages. These are going to be based on keyword lists
* Create all products for all sub-category pages. Attach images, details, price, color, and inventory.
* 4 Images per product
* If we're making collections pages, which we should, a link to the collection page for each product should be on the product page. like "View Collection" or something.

* [DONE]     Merge retro branch (working add-to-cart code) with the develop branch (who's add-to-cart code is broken). The develop branch has further work of styling, but this is the purpose of GIT, so that different work can be done, and synced later.
* [DONE]     Create Main Category Pages (As they are noted on the design)
* [FIXED]    Finalize and Normalize canonicalization of category / product links (also fixed canonical link (html element), which is readable by google, so the lineage of the site should be good now. (SEO Win)
* [FIXED]    Add color options to the Product in the Magento Backend. This way we can remove a color if it's out of stock. (begin working on this now)
* [KEYWORDS] Decide Product Categories and create pages/categories


##Change Log:##

###2014-05-07###
* Finished re-basing (which is the industry term for this process) the code into the development branch, fixing the mal-edited Magento-core files. And Fix the Add-To-Cart bug. Removed the styling for the color and qty, but as noted below, this will be fixed soon, with the process I described. For now, I would like to just move on to the cart so I feel like I'm making significant progress, and I will come back to making the product page prettier.
* Last night I figured out how I am going to handle the product page color issue. I am going to let Magento handle it Magento's way, and I will display the colors swatches the way we want them to display. I will hide Magento's drop-down from user's view, and when they select the color swatch option, I will use javascript to set the Magento drop-down (hidden), so that passing values will not be an issue. And I can begin styling the cart. I am going to beign working on this, this is my initial morning note. So I will begin here, and update with another note on progress in an hour or so.

###2014-05-06###
* I FIXED IT!!!! It's not the prettiest, but as far as functionality goes, that's FAR more important. I can change the styles later. It just needs to work now. But the product is adding to the cart, with the color-swatch option, quantity, and price. Now, This is on a seperate branch, so i didn't break anything worse. I will merge these two tomorrow, but for today, I want to make sure the working version is accurately backed up, and so that no matter what, we can always revert back to this point where it works, and has the majority of the Theme installed.
* That didn't affect it. I'm going to clear the magento cache and sessions, as suggested  to do on the magento forum, and I'll re-index. Magento is just not pointing something to the right place, and at this point i'm honestly not sure what it is. If this does not work, I am going to go back to leafing through that hugh change set, and adding back in working elements. This had proved to be incredibly slow and tedious, so if i could have fixed it without having to do that, it would be better, but at this point, i am just not certain which method will come up with a solution in the least amount of time.
* Try to fix the issue from the suggestions on Magento's forum. This seems to suggest that the redirect may be caused by the "flat" category.
* Change the magento configuration to not redirect to the cart after adding a product. I've been meaning to do this, and I feel that now it will help figure out where the issue is (trying to remove any unneeded re-directs, so I can pin-point the place where it is failing.)
* I'm running two parallel instances of the magento store, where one has the code from where the add-to-cart worked, and the current (develop) which has the new template, but not working when add to cart.
* I was under the impression that the email was of priority number 1. I cannot afford to waste any more time on it, and need to get back into fixing this magento bug. So I am jumping back into that now.
* I just talked to Larry, I was working on setting up the info@nauticaldepot.com email on his laptop. Corey did not leave very much info on where everything is. After very much poking around, NauticalDeopt.com is registered with goDaddy, not sure where email is pointing to, if it's handled by goDaddy, or if by Network Solutions, which is who the domain seems to point to. He has this set up very oddly.
* The line below is referencing where the options are compiled (a sub-call) but the quantity controll element is defined here. Make sure EVERYTHING points where it should!
* See this: /* @var $this Mage_Catalog_Block_Product_View_Options */, search for it, app/design/frontend/base/default/template/catalog/product/view/options.phtml
* Progressing though the data in the exception. It is looking like I have a lock on the place where the bug is beginning.
* After the quick sync of data. Jump right into working on that bug. I am making another branch that will revert back to when i had the cart working, and I wil see what Magento changed. I am hoping this will work pretty easily. I also have the option of bypassing the Internal Integrity check, but this will more than likely cause security flaws, and is something I would like to avoid if at all possible. I will make another note in about an hour with progress.
* Back in the office today. Get everything synced up from development at home yesterday.

###2014-05-05##

* take advantage of git to figure this out. i made a commit when i got it to work, minus the layout of the buttons and qty. i'm going to make a new directory that reverts to when this worked, and then i will re-add back in the newer patches. This should be a more time-efficient way to fix this problem.
* Okay, I have to have it this time. The bug seems to be with the name of the control element. This should be an array of "options" values, with the option (i.e. 'color'), as the array key, and the passed value should be the option actually chosen by the customer.
* I think i might have just figured out what is wrong with the cart and i want to jot it down before i forget. I want to try to add each attribute to the form submit URL, delineated by forward slashes, key-value pairs. Do this with javascript. capture the button press. parse the current URL. add the color and quantity options. Mark product internal ID. and send to [root]/checkout/cart/add/[prop-pairs(product/1/qty/2/color/blue)...
* ___Stop working for today___. Just scared the HELL out of myself. (thought I lost all of the work i did today. nothing before today, but all of today wasted would have SUCKED!!!) There's no problem. But the database NEEDS TO BE BACKED UP WITH EVERY COMMIT! they are state related, and overlaps are not good! This is HIGHLY IMPORTANT for the future security, up-time and reliabilty of service.
* In the mix of fixing the add-to-cart issue, i ran into a bug with the images. For it to work the way we want, we will need 4 images per product. http://dev.rattanoutdoorfurniture.com/products/loungers/brighton-sling-chaise-lounger-beta has the corrected images (but no coushoin colors, so you can't purchase it. the last note.)
* Fixed a partial issue... Related to the color and quantity selection. This also made me aware that if there is no color to be offered, Magento thinks the item is not for sale. How should we handle that?
* I was able to get internet on my laptop thru my phone. Got last weeks code updates and resources updates as well. Beginning working on the bug.
* Today Larry says we have the day off. That sounds great and all, but I can't afford to lose a day's work. So, with that said, I'm continuing to fix the add-to-cart bug. This can't be broken for another whole day. Progress must be made on the checkout, so this has to be completed as soon as possilble.

###2014-05-02###
* Work on a little bug that keeps plaguing me today with the cart details. I was hung up on this, then I stopped to work on the Laptop Recovery. I'm back working on it now. I will update this with details on the fix.
* Instead of moving past the colors, after talking to Larry, I thought this needed to just be fixed so i can move on to the cart. Fixed add to cart. Set and send color and quantity to cart. Working now on re-styling the quantity (now managed by magento too).
* Pulling in color options broke the Add-to-Cart functionality. This should be fixed. Needs to be styled on "container2" for add-to-buttons.
* Got the color options to pull into the product page. Now I'm about to make sure it gets passed to the cart, along with quantity.
* Continue on the product to cart process. Make sure color option and product gets added correctly and start styling the cart and checkout.
* Stop progress on the color swatches. Move this to a later date. Not a priority. we can manage it manually for now. Come back to this. Already added to the TODO.
* Get right back into the colors swatches custom product attribute. So we can manage the cushion color options from the magento admin.

###2014-05-01###
* Make it so you can add the product to the cart. The cart is still unstyled, but the products do add.
* Begin working on color options handled by magento.
* Fixes in the Product details section. Fix quantity to reflect inventory. fix price section. format price as currency.
* Fix the link to the product from the "Newest Products" page. Fixed that canonical / flat url problem with the url.
* Add a notice in the reviews box saying this feature is not available yet. (not a priority for launch). I added a bookmark link, so people can come back to the reviews section.
* Focus on the Product Detials tab box. Make this load the description and add a static block (same for every product) for the FAQ and Special. I think I will remove reviews for now. not needed at launch. add feature in later.
* Take a few minutes to talk to Lesley about a 1br house for rent. Schedule an appointment for later tonight? Also, reply to email regarding unlocked property. I would like to view these 2 tonight. Back into the product page now though.
* To remove Customer Product Tags: "To remove the product tags module (ie. not use product tags?  Admin->system->advanced-> Mage_Tag Disable"
* Take out the trash. And then back into the product page. Remove Customer Product Tagging. This is not a feature we need, at least especially not now. So i will disable it in the admin (require db update).
* I'm feeling pretty good with the product images for now. They pop-up and you can cycle thru them. and "Save Image As..." on right click works (we can make it not, if you'd like).
* Start at 8. Jump right into working on that product page more.

###2014-04-30###
* Some small amount of work done towards the product page. Continue this tomorrow.
* Spent most of the day working on finding a location to live at closer to work.

###2014-04-29###
* Continue working on the category / product linking, for now. once I have this to the point where it leads to no dead links, I will move on to styling the product page. I will come back to finalizing the canonicalization of the category/product links.
* Internet down this morning. Continuing with the category/product issues. I'm going to attempt to mostly just move ahead to the product page.

###2014-04-28###
* Setup all the site category pages, and lineage for flat url and logical url progression (The canonical link thing we talked about before.)
* Continue (move on past related products bug) with the product page. Add new markup, and begin styling.
* Working on a bug with the related products on the product page. This may be something that will solve itself when there are more products to be related to, but for now, change the logic in the "RelatedCategory" module (Related.php). For now just leave this with the fix added here. (@see: \Magebuzz__Relatedcategory_Block_Catalog_Product_List_Related::__prepareData )
* Work on category/product page lineage. "products" root category with url "../products" and sub-categories like "loungers" shouuld be "../products/loungers", and the individual product page would have a url something like "../products/loungers/brighton-sling-chaise-lounge"
* Finish working on the Browse (Category) page. Remove the ".html" from the link (Do this in the Admin interface / database update) Admin>System>Configuration>Catalog>Catalog>SEO>(Product & Category URL Suffix). This will require a flush of the cache.

###2014-04-25###
* List Products in browse. Get category logic fixed. Work on Category/Product view.
* Set Listing image dimensions in the magento backend. ___DO NOT FORGET TO UPLOAD DATABASE LATER___!
* Begin working on the product list (browse) page. Worry about 'selected' menu item later.

###2014-04-24###
* TODO: Next to be done, to be started tomorrow morning) continue syling the sub-pages: focus on the browse (/products.html) and product (/products/chairs/*.html) pages.
* Fixed 'About Us' menu issue, but need to fix the "selected" menu item code.
* At the end of the day, the home page should be pretty solid. The 'About Us' link in the header has a style issue when on sub-pages.
* Site structure looks good. Category and Product exist and are being read in place.
* Create fake product for system (there is going to have to be at least 1 category and 1 product for the store to make all the pages I will need to code. I am adding a fake category "Charis" which I am adding a fake product "Brighton Sling Chaise Lounge", which I will fill with the info from the design, for familiarity.
* Add FireGento plugin and php logger to help de-bug-ing.
* (3PM) Wrap up most of home page (complete for now). Fixed some elements in the header. Fix styles for main content area. Also fix footer styles, and fix issue causing footer to be extremely tall.
* Fix an issue with the navigation. it was only pulling in one item. Products would not show up. this is fixed. Next will be moving on to the footer.
* Get global search (in main nav bar) to be loaded through magento's sub-system for this. I was having issues, but it should be loading correctly now. This will need more work (to make the search actually work). Leave this the way it is for now, and come back to it. Move onto footer.
* Fix main nav to auto-load pages. Manually add Home link and Blog link.
* Pick back up where I had left off yesterday. Get list elements to read correctly. Fix classes for top nav and main nav.

###2014-04-23###
* Finish day with files open in location of last edits. In the middle of editing the main navigation.
* Note: var linkData = [];jQuery("li[data-link-data]").each(function(){linkData.push(jQuery.parseJSON($(this).attr('data-link-data')))});
* Disable wishlist in magento admin. I am just going to disable the wishlist plugin thru the magento admin panel. If this is something we want to re-enable later, that can be done, but for now, I do not want to waste time with it if we are not even using it now. System>Configuration>Customers>Wishlist>Enabled=No
* Begin creating new design layouts in magento. Pick up with the 1 column layout, where the header is being put in place. Continue working on header, and menues. The navigation must be edited across the magento file structure. The separation of files, while it will be nice later, is currently complicating getting everything in place.

###2014-04-22###
* Begin the magento install of the new Design pages. Start with the 1 column layout which everything else will be built off of. Started this process. Layout file is updated, and the 'head' of the page is tentatively in place. Need to continue working on the page header along with the menues.
