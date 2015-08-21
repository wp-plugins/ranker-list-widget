=== Ranker List Widget ===
Contributors: paulranker
Donate link: http://www.ranker.com/
Tags: poll, polls, polling, survey, list, lists, rate, ranking, Ranker, vote, voting, community, sidebar
Requires at least: 3.4
Tested up to: 4.2
Stable tag: 2.2.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

!!!This Plugin has reached End of Life!!! - Please upgrade to Polling Widget: Ranker Lists to continue receiving updates.


== Description ==

!!!This Plugin has reached End of Life!!! - Please upgrade to [Polling Widget: Ranker Lists](https://wordpress.org/plugins/polling-widget-ranker-lists/ "New Plugin") to continue receiving updates.

Use Ranker's free widget to create a fully-customizable "ranking poll" - a list about any topic that your visitors impact by voting items up and down, reranking the list, or adding items. Use it as a "POLL: _____" blog post, to add instant community engagement to an existing "list" blog post as a "reader's version", or stick Ranker lists on your sidebar to increase time on site.

The plugin comes with a built in shortcode generator, you only need the URL of the list on Ranker, we'll do the rest. Setup defaults for your site including colors, fonts, size and layout.

= How it works =
1. Find a ranking you want your visitors to vote on from the [Ranker.com](http://www.ranker.com/ "Ranker") site, or create a new one there. 
2. Copy the URL 
3. Enter that URL into Settings->Ranker Options->Shortcodes
4. Put that shortcode into any post. 

Multiple shortcodes can be used per post.

For more information please see : [Ranker Widget FAQ](http://www.ranker.com/list/the-ranker-widget-frequently-asked-questions/ranker?limit=25 "Widget FAQ")


== Installation ==

1. Upload the 'rnkr-wp' folder to the '/wp-content/plugins/' directory (or install via the Plugins Add New menu).
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Set required options though admin menu.
4. Place generated short codes in your posts.

== Frequently Asked Questions ==

= Why has this plugin reached End of Life? =
We have for the past two years been maintaining two plugins, both containing very similar functionality. For ease and speed of updates we have chosen to roll both feature sets together and support only one Ranker plugin. 
[Polling Widget: Ranker Lists](https://wordpress.org/plugins/polling-widget-ranker-lists/ "New Plugin") will continue to support all the features you use today, but you'll also have access to our latest platform and updates. 
We recommend you immediatly upgrade to the new plugin. In some cases you will need to reconfigure your options but, all embedded widget codes will continue to work.

= How do I create a short code for my posts? =
That's easy! Once the plugin is installed and activated head to the settings page and switch to the 'short codes' tab. Now find the list you want to embed on [Ranker.com](http://Ranker.com/ "List the universe"), copy it's full URL (I.E. http://www.ranker.com/crowdranked-list/my-favorite-cartoons-of-all-time) and paste that into the input on the shortcodes page. We do some magic and then the usable short code for that list will be displayed below.

= Will my old V1 short codes work with the V2 plugin? =
Yes they will! Version 2 is fully backwards compatible, all older short codes will continue to work with the new widget.

= I've found styling errors with the widget, what should I do? =
Some themes are built to override global style definitions, sometimes these styles can cause layout issues with our widget. While we've done our best to avoid themes adjusting the widget display, on occasion one can slip through. If you find any styling errors with the widget in your theme, please leave a support ticket and we'll get them fixed as soon as possible.

= Are there any tips to building a Ranker List or Widget? =
For an in-depth FAQ on widget building please see the [Ranker Widget FAQ](http://www.ranker.com/list/the-ranker-widget-frequently-asked-questions/ranker?limit=25 "Widget FAQ")

= Wait a minute, what is Ranker, I've never heard of this service? =
Ranker has millions of items in its database - everything from universities to comic book heroes to candy brands to your favorite band's discography. To make a list, all you have to do is tell us the topic and pick the items you want to include. Ranker takes care of the rest. Once you've built your own lists, we give you the tools to share them with your friends, or to open them up for voting and let the community decide the rankings!

For a full rundown of the service please see the [Ranker FAQ](http://www.ranker.com/app/faq.htm "Full Ranker Serive FAQ"). 
For more information on using Ranker widgets please see the [Widget Info page](http://www.ranker.com/widget/info.htm "Widget Info")


== Screenshots ==

1. Example of the Ranker plugin options screen.
2. Example of the Ranker plugin short code creation screen.
3. Example of Ranker widget in post loaded via short code.
4. Example of customized widget in post loaded via short code.


== Changelog ==

= 2.2.4 =
- End of Life messaging and upgrade instructions added to readme.txt
- End of Life FAQ question added.
- End of Life messaging added to admin area. 

= 2.2.3 =
- Bug fix for an internal CDN issue where certain widgets were rendering blank.

= 2.2.0 =
- Responding to plugin user feedback, we've reworked some code and now widgets can have all of their header items (including list name) turned off.
- Included in this update are some major widget styling changes: The widget now has a more generic look by default to allow for easier site integration.
- CSS interference between your existing themes and the widget should be greatly reduced.
- We've also run a pass on de-cluttering the header and footer: Sharing icons have been moved to the footer and display in a more neutral color. Footer button functionality has been changed to text links.

= 2.1.1 =
- Added an option to the Ranker settings panel to allow turning item descriptions off for slideshow widgets.
- Removed reactive widget messaging.

= 2.1.0 =
- The Slideshow/Mobile widget update! See below for a full list of features and changes;
- NEW! Slideshow widgets are now enabled in the plugin. Any list you embed that is defaulted to slideshow view will show in this new format. Older widget shortcodes will need to be updated to enable the new view (we chose this option to best serve your original embed intent).
- The widget code is now fully reactive and will adjust to your themes width, this allows for proper widget display on mobile platforms. This change will be rolled out to all lists, including your older embeds. To fix a widget at a specific size you should place the shortcode in a container (div, p etc).
- Related to the above: Widget width options have been removed from the settings panel. A note regarding the change is in its place and will be removed at a later date.
- Default properties have been updated to support Slideshow widgets.
- Thumbnail Gallery option added.
- Slide Background color option added.
- Adjusted settings section headers for clarity.

= 2.0.1 =
- Bug fix for list names that have double quotes. Additional double quotes were causing some short codes to display incorrectly.

= 2.0 =
- The version 2 widget has been completely rewritten from the ground up using HTML5. See below for a full list of features and changes;
- Use of iframes has been completely removed.
- Need for short code recalculation on certain setting changes removed.
- Removed the need for an internal DB stored changelog and cleared the DB entry for it.
- Embed button in widget footer removed.
- Amount of rows is now fully customizable.
- Selecting All rows will now correctly expand the widget when new items are added.
- Optional list image added.
- Optional list author added.
- Optional list criteria added.
- List items may now have their font color changed.
- Additional color options added for widget footer.
- Viewable "list stats" button added to widget footer.
- Open lists can now have items added directly in the widget via an "add item" button.
- Updated plugin FAQ section.
- Updated existing screenshots to reflect plugin and widget changes.
- Added screenshot of a customized widget to plugin folder.

= 1.0 =
- First official release added to directory.

= 0.4/RC1.0 =
- Adjusted options screen to give visual feedback when a 'recalculation' setting is changed.

= 0.3 =
- Updated read me with additional FAQ and description details.
- Added screenshots to plugin folder.

= 0.2 =
- Fixed issue with shortcode height calculations.
- Adjusted settings CSS for readability.
- Ensured loading of widget is inside content.

= 0.1 =
- Initial beta plugin.


== Upgrade Notice ==

= 2.2.4 =
This plugin has reached End of Life, please upgrade to ["Polling Widget: Ranker Lists"](https://wordpress.org/plugins/polling-widget-ranker-lists/ "New Plugin") immediatly to continue receiving updates.

= 2.2.3 =
Bug fix for blank widgets, recommended for all users.

= 2.2.0 =
Settings and widget styling updates, recommended for all users.

= 2.1.1 =
Minor update to slideshow widget display options, upgrade for additional slideshow control. Low priority patch, but recommended.

= 2.1.0 =
The Slideshow widget update! This release updates the plugin to enable our new Slideshow widget product. Widgets will now also properly display on mobile platforms. Recommended for all users!

= 2.0.1 =
Bug fix for list names that have double quotes. Additional double quotes were causing some short codes to display incorrectly. Low priority patch, but recommended.

= 2.0 =
V2 is out! This release updates the Wordpress plugin to our new HTML5 widget. Many bugs fixed and new features added, please see changelog for more info. V1 widgets will continue to work for some time but we recommend you upgrade immediately for the best experience.

= 1.0 =
First official release. This update fixes all outstanding bugs and changes all API's to final locations.  Upgrade immediately.
