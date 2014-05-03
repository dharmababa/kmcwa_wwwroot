=== Calendarize it! for WordPress ===
Author: Alberto Lau (RightHere LLC)
Author URL: http://plugins.righthere.com/calendarize-it/
Tags: WordPress, Calendar, Event, Recurring Events, Arbitrary Recurring Events, Venues, Organizers, jQuery
Requires at least: 3.1
Tested up to: 3.9
Stable tag: 2.7.9 rev49917

== CHANGELOG ==
Version 2.7.9 rev49917 - April 21, 2014
* Bug Fixed: Missing new lines breaking some application import features
* Bug Fixed: Match Background color feature is ending too early for very long spanning events.

Version 2.7.8 rev48814 - April 13, 2014
* Compatibility Fix: When NextGEN gallery is active images can not be uploaded
* Compatibility Fix: When clicking the NextGEN insert icon, a php error is shown in the dialog
* New Feature: Option to enable shortcode argument so that they can be passed through the page URL.

Version 2.7.7 rev48793 - April 10, 2014
* Compatibility Fix: Prevent WPML or other plugins using pre_get_posts from breaking Venue Page
* Bug Fixed: Prevent Month View image overlapping
* Bug Fixed: Month View Image not showing when switching views

Version 2.7.6 rev48786 - April 10, 2014
* New Feature: Support for featured image in Month View (enable feature in Options > Calendarize Shortcode and Month View)
* New Feature: Added separate option to enable Month View Image metabox
* Update: When either the Month View metabox or image option for Month View is set enable the image on the event Ajax data.
* Bug Fixed: Javascript error on Event List View after previous update. Increased version no. of Javascript to force non-cached file.

Version 2.7.5 rev48751 - April 10, 2014
* Update: New optimization feature Ajax data shrink for faster loading of Events (can be disabled in Options > Troubleshoot)
* Bug Fixed: When using the Match Events color feature, applying a filter does not reset the background color

Version 2.7.4 rev48555 - April 3, 2014
* Bug Fixed: Post info metabox was not showing on some Custom Post Types where it was enabled.
* Update: Increase Options Panel version no.
* Bug Fixed: Prevent php warning in Options Panel
* Bug Fixed: Super Admin in WordPress Multisite are getting Demo Mode error message
* Bug Fixed: Super Admin in WordPress Multisite can not save settings in Options.

Version 2.7.3 rev48332 - March 31, 2014
* Bug Fixed: Prevent some javascript error when post extra info goes into a bad state
* Bug Fixed: Remove empty space in dynamic tooltip when custom fields data is not entered
* Update: Change line height in new Calendar Widget.

Version 2.7.2 rev48275 - March 28, 2014
* Update: Added support for the new FLAT UI inspired Calendar Widget (free download).
* Bug Fixed: FLAT UI widget not translating month and day name
* Bug Fixed: iCal button space showing under FLAT UI Calendar widget

Version 2.7.1 rev48158 - March 26, 2014
* New Feature: Added buttons to restore specific default layouts individually (Event Details Box, Venue Details Box, Tooltip Details Box).

Version 2.7.0 rev47975 - March 25, 2014
* New Feature: Added a Upcoming Events Widget template with date range
* New Feature: Added a Skip Months feature in Calendar view.
* New Feature: Option to match the month view day cell background color with the event background color
* New Feature: Added support for dynamic Tooltip content (build your own layout)
* New Feature: Option to replace all events Custom Fields with the default template
* Bug Fixed: jQuery conflict fixed causing Sidelist on Events Map View add-on not to show
* Bug Fixed: Can not delete own events in draft status
* Bug Fixed: Improved styling for Social Network buttons in mobile view
* Bug Fixed: Super Admin on WordPress Multisite can not save Options in Calendarize it! 

Version 2.6.7 rev47746 - March 3, 2014
* Update: Changing spacing in custom buttons in wp-admin
* Update: Changed line height on navigation buttons

Version 2.6.6 rev47499 - February 24, 2014
* Bug Fixed: When clicking on the image in tooltip, not getting the correct recurring event instance.
* New Feature: Show version no. of latest installed add-on and available add-on version
* New Feature: Added support for displaying banner ads by category (requires Events Map View add-on and Advertising Options add-on)
* Update: Colors updated on ON and OFF switch in wp-admin to match new colors
* Update: Color for default event updated to match the new default color scheme for Calendarize it!
* Update: Updated Options Panel to version 2.6.0

Version 2.6.5 rev47386 - February 17, 2014
* Update: Added icon fonts for Calendar navigation
* New Feature: Added some arguments so that the External Event Sources (add-on) can be filtered by Author
* Update: If inserting Custom Field with post meta data fc_allday, replace the value with Yes or No.
* Update: Improved navigation for mobile devices when in month view.

Version 2.6.4 rev47073 — February 12, 2014
* New Feature: Added a settings link in the plugin list
* New Feature: Redirect to Option on plugin activation (this is done in order to get customers to enter the license key and download the Help)
* New Feature: Redirect to License tab on Activation
* New Feature: Message will be displayed in Options Panel if the Help is not installed and allow the user to dismiss the message permanently
* New Feature: Message will be displayed in Options Panel if the Initial Setup has not been performed: Create Event and Venue templates and create Calendar page with [calendarizeit] shortcode.
* New Feature: Show list of pages that uses Calendarize it! shortcode (Options Panel)
* New Feature: Updated default theme for Calendarize it! buttons (FLAT UI)
* Update: Add close icon to iCal dialog
* Update: Adjust color of close icon on Calendar filter dialog
* Update: Change Calendar filter tabs 
* Bug Fixed: iCal feed download fixed on individual events.
* Update: Changed iCal Feed dialog,  that appear when you click the button in the Event Details Box, to be the same as when you click the iCal button in the Month View.

Version 2.6.3 rev44259 - January 9, 2014
* Update: Map View Optimization (improved load speed for Map View add-on)
* Update: Added a comment for changing the post info shortcode
* Update: Adjust CSS for Auto Publish add-on
* Bug Fixed: Adjust Featured Event Image in pop-up
* Bug Fixed: Premiere parameter was not applied to the rhc_upcoming_events shortcode

Version 2.6.2 rev43952 - January 1, 2014
* Compatibility Update: Added code to compensate for undetermined situation where the “no upcoming events” message is also shown when events are appearing.
* Bug Fix: Weekly recurring events were not showing on December 29, 30, 31 or January 1.

Version 2.6.1 rev43717 - December 23, 2013
* Update: Change Calendarize it! event default color
* Bug Fixed: Title alignment off
* Bug Fixed: Rename the pre-loader icon font to avoid conflicts with other plugins and themes that have not namespaced icomoon.
* New Feature: New and improved layout for Month View on mobile devices
* New Feature: Adding a mobile .fc-small class and code for handling calendar rendering on mobile (Setting in Options Panel)
* Bug Fixed: Make multi day events span correctly in mobile view

Version 2.6.0 rev43685 - December 21, 2013
* New Feature: Allow External Event Sources add-on to define its own tooltip link target.

Version 2.5.9 rev43680 - December 19, 2013
* Update: Changed styling of tooltip to better support mobile devices
* Update: Tooltip will pick up the color from the event in the Month View

Version 2.5.8 rev43502 - December 17, 2013
* Compatibility Fix: Renamed the spinner (pre-loader) font-face (icomoon) to avoid conflict with other plugins and themes.
* Bug Fixed: CSS Styling issues fixed in wp-admin (WordPress 3.8 compatibility)
* Update: Added name-spacing to font-face icon (icomoon) to avoid conflict with other plugins and themes. 
* Update: Optimization reduce the size of the plugin on memory per page load

Version 2.5.7 rev43111 - December 11, 2013
* Update: Improved layout for Social Network icons on iPad and Tablets. 

Version 2.5.6 rev43031 - December 10, 2013
* Bug Fixed: Moved misplaced tip html that breaks the styles with Twitter Boostrap 3
* Bug Fixed: php warning in troubleshooting tab
* Bug Fixed: Upcoming Events Widget targeting _blank on some events
* Update: Increase the Options Panel version (support for callback on Social Login Options)
* New Feature: Added support for Social Media login (Facebook, Twitter, Google+, LinkedIn and Microsoft Live)

Version 2.5.5 rev42214 - November 22, 2013
* Bug Fixed: Alignment of text in bubble on Google Map (Venue Details)
* Bug Fixed: Using a custom postmeta in post info fields returns a strange format in the wp-admin.
* Update: Allow pop option esc_attr for escaping html in options fields.
* Update: Redundant check, do not can get image scr if attachment id is not valid
* New Feature: Added a filter to add postmeta options to post info metabox form
* New Feature: Modify post info so that button add-on can be applied to a postmeta type (used for Community Events add-on)
* New Feature: Added option to set a default set of values for the Layout Options Metabox (applicable to new events)

Version 2.5.4 rev42165 - November 15, 2013
* Bug Fixed: Type error in textColor breaks the Event Color by Calendar add-on
* New Feature: Added new Role Manager field type for setting plugin capabilities per User Role

Version 2.5.3 rev42049 - November 12, 2013
* Bug Fixed: Incorrect localization fixed
* Bug Fixed: Font size of the Event Details Box title can not be edited with the CSS Editor
* Bug Fixed: When loading ends, remove min-height from view, as it sometimes creates unwanted space.
* New Feature: New FLAT UI Calendar Widget
* New Feature: Added support for customizing the FLAT UI Calendar Widget with the CSS Editor
* Update: Clear Event Cache on post (event) delete
* Update: Removing embed of Google font Lato in CSS
* Update: Embedding Google Lato font (The default Lato font can be changed with the CSS Editor. 600+ Google Fonts available)

Version 2.5.2 rev41962 - November 8, 2013
* Bug Fixed: Allow php on Widget Templates
* Bug Fixed: A space about 5px is added between the top view and the start of the lists of events. 
* Bug Fixed: Problems generating rhc post meta data
* Bug Fixed: FLAT UI missing modal shadows
* Bug Fixed: Saved events not showing in Calendar
* Bug Fixed: Events not appearing the first time they are saved

Version 2.5.1 rev41876 - November 6, 2013
* New Feature: Upcoming Events Widget allow to specify removing events by ending hour
* New Feature: Added an Agenda like template for Upcoming Events Widget
* New Feature: Specify Media source size for the image in the Events Details Box
* Update: Added in comments a sample for using ending time in the Upcoming Events Widget
* Bug Fixed: Used a theme specific selector to hide unused spaces in the Upcoming Events Widget
* Bug Fixed: Add fallback sql delete in case truncate fails for clearing the cache table. Fixes events not updating in the frontend
* Update: Added CSS for check box type on metabox save
* Update: Changed the namespace to FLAT UI styles

Version 2.5.0 rev41852 - November 4, 2013
* New Feature: Added the parameter “days in the past” to the Upcoming Events Widget, to allow showing x number of days passed.
* New Feature: Added feature in Options Panel that allow to hide specific weekdays from the Calendar.
* New Feature: Allowing to enable the Details Metabox for other post types.
* Compatibility Fix: Added a troubleshooting option for theme integration. It helps fixing issues with themes that store layout information in the Post Meta Data.
* Update: Separate scripts and styles loading to a separate class.
* Update: Added a filter for triggering advertising banners based on taxonomy filters (Requires Map View add-on).
* Bug Fixed: Prevent several “Strict Standards: Non-static method” php warnings on single events pages.
* Bug Fixed: Event list broken
* Bug Fixed: wp hook is not fired in the wp-admin
* Bug Fixed: $post_types array
* Bug Fixed: Prevent a php warning in the Calendar widget drop down on strict php settings.
* Update: Added hook rhc_calendar_metabox_post_types to allow specifying what post type gets the calendarize metabox (besides options)
* Update: Apply some important changes to pass local feeds slug and term_id needed for matching ads (Requires Map View add-on).
* Update: Improved support for theme meta data in the template, when the theme uses get_post_custom instead of get_post_meta
* Update: Added hook save_post_meta_boxes to chain save_post actions better. Fixes a bug where the end date was replaced with the start date
* Update: Upgrade to fullCalendar 1.64
* Update: Added option to specify single days NOT to show in Calendar

Version 2.4.9 rev41734 - October 30, 2013
* Bug Fixed: Added a check to prevent agenda views from crashing. 0 is not a valid minute slot value
* Bug Fixed: remove ob_gzhandler from the Ajax. Apparently many hosting providers are not handling this very well.
* Update: Added iCal Location and Geo Event properties based on the rhc build in venue
* Update: Added a close button to the iCal feed tooltip. Close icon was lost when changing from jQuery UI dialog to tooltip

Version 2.4.8 rev41688 - October 28, 2013
* Bug Fixed: Replace brackets in some sites that break in the admin when the Ajax URL contains brackets
* Bug Fixed: If site uses SSL, load the https version of Google Maps library
* Bug Fixed: Saving bracket in week title not working in front end (this is when setting date/time format in the Options Panel)
* Update: Make email and website in the Organizer page hyperlinks
* Improvement: Added some filters for better time zone support.

Version 2.4.7 rev41610 - October 23, 2013
* Bug Fixed: Custom Fields metabox broken after W3C validation
* Bug Fixed: Sorting of 2 column elements broken in custom fields metabox
* Bug Fixed: Calendar filter broken after W3C validation

Version 2.4.6 rev41581 - October 23, 2013
* Improvement: W3C HTML5 validation.
* Improvement: Gzip compression if supported by browser compress events data
* Improvement: CSS minified
* Improvement: Moved location (load) of some JS and CSS files for improved load time.
* Update: Removed duplicate unused resources
* Update: Cleanup, will not use init_in_footer, remove code for edit view mode since not used
* Update: Remove unused JS
* Update: Convert iCal dates to UTC according to the WordPress settings GMT offset.
* Bug Fixed: On All Day events, exdate most be date and not date time.

Version 2.4.5 rev41505 - October 21, 2013
* Bug Fix: WordPress 3.7 compatibility. Permalinks for the Event details pages are broken in WordPress 3.7. If you still experience issues after updating re-save your WordPress permalink settings and the fix will be applied.
* Bug Fixed: Problem with recurring events in Upcoming Event List.
* New Feature: Added troubleshooting feature to try catching PHP warnings in the Ajax output (When to use: When the calendar is rendered, but events doesn't seem to load)
* New Feature: Added new troubleshooting feature to allow specifying page ids where the Calendarize it! JS and CSS should be loaded. Important: If left empty it will load on all pages as the JS and CSS is needed for the Sidebar Widget. If you know that you are only using Calendarize it! on a specific page and also using the Sidebar Widget on a specific page you can use this feature to reduce load time.

Version 2.4.4 rev41417 - October 19, 2013
* New Feature: Implemented Ajax response caching for improvement performance.
* New Feature: Added taxonomy term rendering to upcoming events widget template.
* New Feature: Optimization of the Events query.
* New Feature: Added French .mo and .po files to /languages/ folder. Will load Calendarize it! in French if WPLANG is set to fr_FR in wp-config.php. 
* Update: Make the Upcoming Events Widget fetch events from the hour zero, so that at least same day upcoming events are cached.
* Bug Fixed: Only show upcoming events in sidelist (requires Events Map View add-on).
* Bug Fixed: Remove some extra quotes from the template
* Bug Fixed: When loading calendar in Event List view, ajax was called twice. The first one was an invalid event fetch.
* Bug Fixed: Do not apply the font Lato on the wp-admin
* Bug Fixed: Link in sidebar Widget opening Event in two tabs on some browsers.

Version 2.4.3 rev41161 - October 14, 2013
* Update: Event Details box and Venue Details box font updated to Lato (Matching RSVP Events, Ratings and Reviews and Events Map View add-ons)
* Bug Fixed: When clicking on rrule settings, browser jumps to the top of the page (Recurring events interface)
* Bug Fixed: When loading the WordPress jQuery-UI set non-conflict so any Bootstrap button returns back the old button defined by jQuery-UI, which is what is used in the metabox in the admin.

Version 2.4.2 rev41012 - October 12, 2013
* Update: Added a single event template content filter for post processing of the Event content template (needed when loading add-ons like RSVP Events)

Version 2.4.1 rev41037 - October 10, 2013
* Update: Correctly implement rh_enqueue_script, which is for loading the latest version of a script within our own plugins. 
* Bug Fixed: CSS fix for IE9 and IE10
* Update: Identify External Event Sources (added external_feed property to event object)
* Update: Mark local events, not remote
* New Feature: Added option to load the dynamic version of the Event Details Box in the Event List (Ajax loading). Feature can be enabled in the Options Panel > Calendarize Shortcode panel.
* New Feature: Added backend option to change the date, time and datetime format of the dates in the extended details box on the Event List view.

Version 2.4.0 rev40745 - October 4, 2013
* Bug Fixed: Critical update. Sites with no add-ons installed crash

Version 2.3.9 rev40737 - October 4, 2013
* Bug Fixed: Remove a fix that we added for very few sites, that actually breaks more sites. Related to PHP warnings in Ajax.

Version 2.3.8 rev40705 - October 4, 2013
* Bug Fixed: Upcoming Events not showing when using taxonomy arguments in shortcode. This affects the Venue page too.

Version 2.3.7 rev40593 - October 3, 2013
* Bug Fixed: Removed php warning
* Bug Fixed: Prevent Firefox from opening two tabs when clicking on tooltip Event title.
* Bug Fixed: Widget template Agenda Like - no repeat was broken.
* Update: Set minimum height on sidebar widget in order to show pre-loader.
* Update: Remove the Shortcode template Option tab (this feature has been depreciated after the new templates was introduced)

Version 2.3.6 rev40541 - October 2, 2013
* New Feature: Added support for Social Auto Publish Metabox (requires Social Auto Publish add-on)
* New Feature: Added core procedure to insert End Date into Widget template
* New Feature: Added jQuery UI Mouse to the dependency (requires Community Events add-on)
* Update: Adjusted side list font and size
* Update: Adjusted items fonts and line height

Version 2.3.5 rev40453 - September 29, 2013
* Bug Fixed: Local events not showing properly in the Upcoming Events Widget
* Bug Fixed: Label changed in Default Event Fields tab (Second Date Format field should be Time Format)

Version 2.3.4 rev40437 - September 27, 2013
* Bug Fixed: If any php warning is generated on the Ajax call the calendar breaks. Avoid this by capturing and suppressing warnings on the Ajax using ob.

Version 2.3.3 rev40399 - September 26, 2013
* Update: Moved taxonomy filter from Calendarize Shortcode tab in the Options Panel to the Google Map View tab (requires Map View add-on)

Version 2.3.2 rev40391 - September 26, 2013
* Update: Added version no. inside CSS import to try and overcome a Chrome cache problem

Version 2.3.1 rev40376 - September 25, 2013
* Bug Fixed: Show unlimited number of Pages on the Template Settings drop down.
* Update: Adjusted CSS for Upcoming Events Widget.

Version 2.3.0 rev40373 - September 24, 2013
* New Feature: Added new pre-loader. Webkit browsers will show a spinner, which uses CSS3 animations. Other browsers fallback to an hourglass icon.
* New Feature: Added support for events in Google Map (requires Map View add-on).
* New Feature: Added year and month taxonomy filter (requires Map View add-on)
* New Feature: Added option to disable taxonomies from filter bar through shortcode argument "tax_filter_skip" using comma separated taxonomy slug (requires Map View add-on)
* New Feature: Added support for External Event Sources showing in Upcoming Events Widget (requires External Event Sources add-on)
* Update: Change direct query for get_posts, some sites seem to be blocking direct query.
* Update: Added support for Bootstrap 3.0 (FLAT UI)
* Bug Fixed: When General Settings > Disable link is "yes", do not show event title in tooltip as link as it confuses the user.
* Compatibility Fix: In WPML show calendar events in the language of the page that defined the [calendarizeit] shortcode.

Version 2.2.9 rev39716 - September 9, 2013
* Bug Fixed: When option "Show multi months events" is ON, old events are showing on the events list when repeat date is set.

Version 2.2.8 rev39500 - September 5, 2013
* Bug Fixed: Event not showing when the last event is a repeat date event, and it is the first calendar day of the view
* Bug Fixed: Javascript error on pre WordPress 3.5 admin
* Update: Added an event for post rendering callbacks (currently does nothing and it is provided for future add-ons)
* New Feature: Added option to load the WordPress jQuery UI files.

Version 2.2.7 rev39258 - August 26, 2013
* New Feature: Added new Shortcode making it possible to display a calendar based on the current user logged in. Use [calendarizeit author="current_user"]

Version 2.2.6 rev39168 - August 23, 2013
* Bug Fixed: When adding an event the drop downs for selecting click action are blank (WordPress 3.6)

Version 2.2.5 rev39081 - August 22, 2013
* Bug Fixed: "Get Directions" link in Venue Details Box was broken
* Update: Make e-mail link and website URL render as links in the Agenda List (Venue details)
* Update: Output multiple venues in separate lines if added to the same event.

Version 2.2.4 rev38933 - August 18, 2013
* New Feature: Added support for using WPML (WPML makes a copy of all posts and pages. This will prevent Events from showing up as duplicates in the calendar)

Version 2.2.3 rev38900 - August 14, 2013
* Bug Fixed: Prevent some php warnings
* Bug Fixed: Error in Firefox when modifying a custom field
* Update: Improve CSS styles for certain themes
* Update: Add support for new Map View add-on

Version 2.2.2 rev38819 - August 12, 2013
* Bug Fixed: Prevent php warning
* Update: Added jQuery-UI 1.10.3 for WordPress 3.6 support

Version 2.2.1 rev38684 - August 6, 2013
* Bug Fixed: Events are removed from the Upcoming Events Widget too early

Version 2.2.0. rev38631 - August 2, 2013
* New Feature: Enable Capability filtering for register taxonomies, so that taxonomy capabilities can be customized (requires Capability and Taxonomy add-on for Calendarize it! is installed)

* New Feature: Add filter for event capabilities setup

Version 2.1.9 rev38603 - August 1, 2013
* New Feature: Added filters for Calendar Taxonomy Color Support (add-on needed)

Version 2.1.8 rev38595 - July 31, 2013
* Update: Support dot "." in time fields
* Update: Added the option to change the API registration URL and implement it.

Version 2.1.7 rev38548 - July 30, 2013
* Bug Fixed: When Venue and Organizer taxonomies are disabled, do not output related taxonomy meta fields in post info.
* Bug Fixed: Error when Calendar taxonomy is disabled.
* Update: Add some filters for the no vscroll add-on.

Version 2.1.6 rev38527 - July 26, 2013
* Update: Rollback point: added support for add-ons to customize custom post info types. Initially for Custom Buttons.

Version 2.1.5 rev38499 - July 24,2013
* Update: Add filter for add-ons to be able to add custom post info field rendering methods
* New Feature: Allow adding quick access button with filter

Version 2.1.4 rev38424 - July 22, 2013
* New Feature: Provided alternate accordion script for site themes that are breaking the Twitter Bootstrap accordion used in the Visual CSS Edtior
* Update: Reduced the space between tabs in the Calendar filter so that it is possible to fit more taxonomies.

Version 2.1.3 rev38415 - July 19, 2013
* New Feature: Added support for use of [btn_ical_feed] shortcode in custom fields. Will allow you to create a feed for a single event for Google Calendar or iCal.

Version 2.1.2 rev38110 - July 8, 2013
* Bug Fixed: Tooltip in Firefox was mispositioned

Version 2.1.1 rev37861 - July 1, 2013
* Bug Fixed: Event Sources filter by taxonomy is not working when used in a shortcode
* Bug Fixed: Filter by calendar only works when using the calendar filter button

Version 2.1.0 rev37701 - June 26, 2013
* Update: Behavior change, let the CSS Editor have control of the Event and Venue details boxes
* Update: Center Event and Venue boxes when not set to 100% width

Version 2.0.9 rev37669 - June 25, 2013
* New Feature: Added option (Troubleshooting) to load Javascripts in the footer
* Update: Compatibility fix for some themes where CSS is breaking event positioning in the calendar
* Update: Missing textdomains for Internationalization (translation) has been added

Version 2.0.8 rev37530 - June 21, 2013
* New Feature: Add troubleshooting option to load bootstrap in the footer in an attempt to prevent a jQuery-ui/boostrap conflict with buttons (this is for the CSS Editor)
* Bug Fixed: Visibility check script jQuery dependency.
* Bug Fixed: Line height decimals should not be removed.

Version 2.0.7 rev37479 - June 19, 2013
* Update: Add a default line height to boxes labels
* Bug Fixed: Remove several php warnings
* Update: In wp-admin load js only on rhc admin screens (fixing conflict with Revolution Slider)

Version 2.0.6 rev37191 - June 18, 2013
* Improvement: Added class for a 640px width browser in order to make the calendar navigation and header look nicer in themes where the calendar is inserted on a page with a sidebar.
* New Feature: Added a global option to enable/disable Google Map zoom with mouse wheel.

Version 2.0.5 rev37111 - June 6, 2013
* Bug Fixed: Event and Taxonomy pages not loading content or post info boxes on some themes and plugins that make use of wp_reset_query()
* Bug Fixed: Taxonomy pages should not show external feed (feed from External Event Sources add-on)
* Bug Fixed: Venue Detail Box not showing right venue detail on newly created events
* Update: When creating new posts set the post info box post id to the newly created event.

Version 2.0.4 rev37015 - June 5, 2013
* Bug Fixed: Prevent rhc template loader from taking over non-rhc taxonomy templates.

Version 2.0.3 rev36966 - June 4, 2013
* Update: Add style to compensate for some themes that are breaking the mobile styles on the calendar.
* Update: Compatibility fix, IE8 breaks when upcoming widgets are loaded.

Version 2.0.2 rev36833 - June 1, 2013
* Update: Modified the registration tab so that it uses its own capability. Modified implementation so that Options now require rhc_options instead of manage_options and rhc_license for registration (you need to deactivate and activate the plugin in order to insert he new capabilities)
* Bug Fixed: Problem with [calendarize feed=1] shortcode used with External Event Sources add-on fixed.

Version 2.0.1 rev36824 - May 30, 2013
* Update: Added support for translating values in custom fields, by adding a variable eg. _($instance['Event Details'],'rhc'). You will need to manually add the translation string (this can easily be done if you use our Easy Translation Manager).
* New Feature: Paid Add-ons and Free Add-ons in Downloads (require entering a valid License Key)

Version 2.0.0 rev36624 - May 23, 2013
* New Feature: Added Visual CSS Editor for advanced styling of Calendarize it!
* New Feature: Added Downloads section for installing add-ons and skins (templates)
* New Feature: Allow specifying the zoom value for the Google Map
* New Feature: Detail Venue Box added
* New Feature: Detail Event Box added
* New Feature: Added option to disable a shortcode based on meta_key, implemented this on the venue box and added guy to events to enable/disable venue box
* New Feature: Added .mo and .po files for Italian support
* New Feature: Added metaboxes in wp-admin for Top image on Event Details Page and Event Details box image.
* New Feature: Implemented Top image on Events Details Page and Event Details box (single event template)
* New Feature: Implemented a Visual Layout Selector for custom fields
* New Feature: Implemented new interface for adding custom fields to the Detail Event Box and the Detail Venue Box
* New Feature: Added button to save Default Templates for Detail Event Box and Detail Venue Box
* New Feature: Added button for resetting custom event fields and custom venue fields
* New Feature: Added Contextual Help for Calendarize it!
* New Feature: Added option to enable week numbers and replace the week number label
* New Feature: New navigation for mobile devices (iPhone and Smartphones)
* New Feature: Added Shortcodes [eventpage], [venuepage] and [organizerpage] for use with frameworks like Thesis (Important: The Shortcodes are NOT to be used inside a Post or Page content, as this might crash the website. They are exclusively to be used directly in the templates, or in the Thesis template editor). Install the free add-on "Calendarize it! Content Shortcodes" in order to use the three shortcodes. 
* Update: Moved calendar initialization to the head of the page
* Update: iCal dialog has been rewritten and added option to download .ics file.
* Update: Updated Options Panel to latest version 2.3.1
* Update: fullCalender updated to 1.6.1
* Bug Fixed: Changing the month in the calendar widget was affecting other calendarize instances on the same page
* Bug Fixed: Calendar Widget events spanning more than a day in the next months first days where also rendering in the main month.
* Bug Fixed: First day not considered on the Widget
* Bug Fixed: Compatibility fix. Avoid extending the JS array.prototype object, which in combination with some other plugins seems to overwrite Array methods.

Version 1.3.6 rev36001 - April 24, 2013
* New Feature: Added the taxonomy and terms parameters to the Upcoming Events Widget admin, so that custom taxonomies can be specified as filer in the widget.

Version 1.3.5 rev36001 - April 14 2013
* Bug Fixed: Problem with some parameters in the Upcoming Events Widget Shortcode has been fixed.

Version 1.3.4 rev35967 - April 12, 2013
* Update: Fixed some CSS on Venue and Event Details Page.
* Update: Fixed some CSS related to mobile device support.

Version 1.3.3 rev35961 - April 10, 2013
* New Feature: Allow using the taxonomy and terms argument in the shortcode for upcoming events.
* Update: CSS fixes on the event page and venue page.

Version 1.3.2 rev35791 - April 5, 2013
* Bug Fixed: On events with a long duration, the event was not showing if a repeat date is set, and the event does not start on the same month.

Version 1.3.1 rev35763 - April 4, 2013
* Bug Fixed: Version 2 (template settings) was replacing the Category Archive template.
* Bug Fixed: Use slug in Calendar, Venue or Organizer argument instead of ID.
* Update: Moving map on Venue page
* Update: Event Details Page CSS updated

Version 1.3.0 rev35657 - April 2, 2013
* Update: Fixed issue with responsiveness related to month and navigation
* Update: Fixed issue with Print CSS

Version 1.2.9 rev35442 - March 26, 2013
* Update: Fixed some CSS styling issues on the venue page

Version 1.2.8 rev35248 - March 23, 2013
* New Feature: Add placeholder for print styles and option to disable print styles
* New Feature: Print CSS
* Update: Cleaning up tooltip font size and spacing
* Update: Cleaning up event details page font size and spacing

Version 1.2.7 rev35017 - March 15, 2013
* Bug Fixed: Handle a situation where the event list links where not doing anything when target was not set. Now default is _self.

Version 1.2.6 rev33938 - February 11, 2013
* New Feature: Update Options Panel with Auto Update
* New Feature: Allow download of ics file
* New Feature: Enable shortcode for a single event feed
* New Feature: Enable choosing post types in the upcoming event widgets (this makes the add-on obsolete)
* New Feature: Added styling Modal A option to check more post types and option to choose widget templates
* New Feature: Add additional template widgets where the agenda like data box will not be shown if the same date as previous event date.
* New Feature: Added Modal B widget agents (repeat and no repeat)
* Ne Feature: Implement option to use ajax to fetch events, instead of server side loading of the event in the upcoming events widget
* Update: Adjust fluid content, and fixed agenda box width
* Bug Fixed: Removed debugging code
* Bug Fixed: Missing localization string and incorrect text domain
* Bug Fixed: Correctly disable overlay
* Bug Fixed: When both coordinates and address is set, prefer coordinates
* Bug Fixed: js error when adding a non recurring event
* Bug Fixed: Make the admin show the first day of the week, same as the fronted, and also the labels
* Update: Added new Spanish translation file
* Update: Increase gmap version number to force cache
* Update: Added argument to allow ical feed to display single event
* Update: Force new style.css
* Update: Add a class to differentiate widget calendar from main calendar
* Update: Add specificity to selector to try avoid theme overwriting calendar

Version 1.2.5 rev32988 - January 21, 2013
* Bug Fixed: The old events fix was completely changing the start data of events in the upcoming events.
* Bug Fixed: jQuery.live is depreciated, updated js libraries.

Version 1.2.4 rev31652 - December 26, 2012
* Update: Disable date formatting for Custom Field info
* Update: English .po and .mo files with new labels
* Bug Fixed: Interoperability fix: Let WordPress handle the menu position, as fixed positions have a risk of already be claimed by other plugins.
* Bug Fixed: Use the datetime of the end and start date rather than just the time. Then the programmer can choose what format to display
* New Feature: New function that will output a repeat date following the event list fullcalendar date format
* New Feature: Added the day and month names to the function so the output can be localized
* New Feature: New function for easier setup of the event template when manually setting it: get_repeat_start_date($post_id,$date_format)

Version 1.2.3 rev30654 - November 27, 2012
* Bug Fixed: Date not showing on the admin in Firefox (PC)
* Bug Fixed: Prevent php warning
* New Feature: Allow specifying alternate event source
* New Feature: Added rdate to iCalendar
* Update: Implement the prev and next label settings when generating the cal shortcode
* Update: Enable the field for changing the prev and next button text

Version 1.2.2 rev29705 - November 2, 2012
* New Feature: Allow setting a content wrap on Pages used as templates
* Update: Simplify templates, replace php functions with shortcodes, so that templates can optionally be fully setup at the template page
* New Feature: Added option to enable thumbnail support in case the theme don't
* New Feature: Added option to specify the page id to which the widget links to by default
* Update: Remove spaces from organizer template as they get converted to <p> and </br>
* Update: Separated the event list js code for easier maintenance
* Bug Fixed: If the address is empty do not display the address label in the tooltip
* Bug Fixed: If website field is empty, don't show the field
* Bug Fixed: Remove extra space when fields are empty
* Bug Fixed: Do not show map if all required fields for map are empty
* Bug Fixed: One event list, when address venue or organizer is empty, do not show the label
* Bug Fixed: Do not show description on event list if it is empty (double border lines)
* Bug Fixed: Multiple day events, incorrectly displayed on IE9 and old Firefox. Technical: IE is not capable of using date string yyyy-mm-dd on new Date(date string) odd.
* Bug Fixed: Added an option to ignore a WordPress recommendation, so that event does not return a 404 on sites with plugins or themes that also ignores this recommendation
* Bug Fixed: Load options before init to catch the new ignore standard troubleshooting setting

Version 1.2.1 rev29610 - October 27, 2012
* Bug Fixed: Google calendar treats dtend exclusively 
* Bug Fixed: Modify in_array function, on certain conditions events do not show on any browser but Firefox.
* Bug Fixed: Compatibility fix, added id to a div with postbox class, as it seams that cardamom theme js needs the id or else it crashes.
* Bug Fixed: First date should not contain date into in the URL
* Bug Fixed: Non recurring events that have repeat dates, do not repeat if the start date and end interval is not in the current view date range.
* New Feature: Option to disable link in calendar pop-up
* New Feature: Added option to turn on or off the debug menu


Version 1.2.0 rev29423 - October 19, 2012
* New Feature: Added support for Exceptions when creating recurring events
* New Feature: Added support for arbitrary recurring events
* New Feature: Added option to specify calendar URL to link the upcoming events widget
* Bug Fixed: Adjusted margin on "Calendar" and "Today" button
* Bug Fixed: Show correct date of repeat instance info fields on event page when clicking on a repeat event. 
* Bug Fixed: When choosing to filter by several taxonomies (it was only filtering by 1 taxonomy)
* Updated: Layout fixed for WordPress 3.5


Version 1.1.4 rev29164 - September 23, 2012
* New Feature: Provided an option to display all Calendarize It! Post Types in the main calendar
* Bug Fixed: Add Organizer image and HTML content

Version 1.1.3 rev29014 - August 31, 2012
* Bug Fixed: Make sure featured image is used for events
* Bug Fixed: $.curCSS is depreciated in jQuery 1.8, updated full calendar.js
* Improvement: Optional Tooltip title link disable or enable
* Bug Fixed: All Day events where showing time in start and end dates in popup
* Bug Fixed: Option to enable/disable ical button on the calendar widget

Version 1.1.2 rev28899 - August 18, 2012
* New Feature: Render short codes in before/after template HTML; added shortcode rhc_sidebar for adding sidebars to the template
* New Feature: Option to make taxonomies into fields, hyperlinks to the taxonomy page
* Update: Allow the parameter to be 'false' so that the specified template does not render any sidebar
* Update: Missing text domain on the words: Start, End and Address in the pop-up
* Update: Added optional rewrite procedures for sites with problems with permalinks, updated Options Panel, pushed plugin init to after_theme_setup for theme integration support. Added default organizers template, include code (but not enabled) for handling calendar inside a tab
* Bug Fixed: Multiple day events were only highlighted the first day in the calendar widget
* Bug Fixed: When the end date time is less than start time it was incorrectly calculating the number of days
* Bug Fixed: Upcoming Events Widget, when event is all day, time should not display
* Bug Fixed: On most themes, the image pushes the content on the event list
* Bug Fixed: Prevent CSS3 transition from modifying the event rendering behavior

Version 1.1.1 rev28549 - August 1, 2012
* Bug Fixed: Frontend breaking when showing Calendar and Upcoming Events Widget at the same time
* Update: jQuery updated to version 1.8.22
* New Feature: Option to disable built-in Taxonomies from Options

Version 1.1.0 rev28238 - July 27, 2012
* New Feature: Provide option to disable loading Calendarize It! templates
* New Feature: Hide dialog when pressing escape key
* New Feature: Support for iCal (OSX Calendar) and Google Calendar feed
* New Feature: Allow to set iCal parameters
* New Feature: Added better support for setting time and data format 
* New Feature: Added month and day names to the Options Panel
* New Feature: Enable default options in Calendar in widget
* New Feature: Implement day and month names in upcoming events widget from Shortcode options
* New Feature: Included Spanish .mo files
* Update: Modified widget for current rule event, changed date format to full calendar format to support only one date format
* Update: Added new language strings in .po and .mo files
* Bug Fixed: Provide a custom URL for the calendar link (implemented non-default event and calendar display slugs)
* Bug Fixed: Recurring events that repeat many times where being excluded from the upcoming events widget
* Bug Fixed: Recurring events only showing in Chrome. rule UNTIL, if time not set, should include that days event in recurring events
* Bug Fixed: Missing end date time, added formatting to info box inside the admin so it looks like the frontend
* Bug Fixed: Upcoming events not showing on Internet Explorer, Firefox and Safari
* Bug Fixed: Spacing on Upcoming Events widget
* Bug Fixed: Default time format with 2 digit minutes
* Bug Fixed: When any of the taxonomy slugs is left empty in the options panel, in WordPress 3.4.1 every pages becomes not found
* Bug Fixed: Missing textdomain for "Every year", "Custom Interval", "No access"


Version 1.0.2 rev27083 - July 7, 2012
* Bug Fixed: HTML entries in event title
* Bug Fixed: Set first day of the week was not working
* Bug Fixed: Typographical error "Wednsday" changed to "Wednesday" in drop down for choosing start day of the week
* New Feature: Added backend options to customizing month, week, day and event list time formats. As well as title, column, event time and agenda axis
* New Feature: Added sort by date in the event admin
* New Feature: Allow hookup of external jQuery UI themes (this allows you to easily add your own jQuery UI themes by using the http://jqueryui.com/themeroller/. It is important that you add a CSS Scope (.rhcalendar) when exporting the theme in order to limit the usage of the CSS to Calendarize it)
* New Feature: Allow hookup of external templates (this allow you to update the plugin without overwriting any customizations you have made to the templates)
* New Feature: Provide configuration options for agenda view
* Update: added latest strings to localization files

Version 1.0.1 rev26587 - June 30, 2012
* Bug Fixed: Incorrect localization function giving warning
* Bug Fixed: Start and End date subtitle where not being localized
* Update: Added filters to event list in wp-admin
* Update: Added load text domain for Calendarize
* Update: Added base files for translation (/languages)
* Update: Added argument to control the start and end formats in the event list

Version 1.0.0 rev26066 - June 21, 2012
* First release.


== DESCRIPTION ==
Calendarize It - a powerful Calendar and Event plugin for WordPress.

The main features are: 

- Easy Point and Click interface to add new events
- Preview when entering event in wp-admin (single event)
- Support for Recurring Events
- Show Individual Calendars per user in WordPress- Advanced filtering (Custom Taxonomies)- Sidebar Widget for Upcoming Events
- Sidebar Widget for Mini Calendar - Event List per day, per week, monthly
- Support for Custom Fields for Events- Creating and manage Venues, Organizers and Calendars- Support for Shortcodes - Support for Custom Post Types
- Detailed Event Page- Detailed Venue Page
- Google Map integration for Events and Venues
- Support for internationalization

If you want to enable other user roles besides the Administrator to create and manage Events you can add the following capabilities. You will need a Role and Capability Manager  like our White Label Branding for WordPress. Or any other plugin that lets you update the capabilities of a user role.

== INSTALLATION ==

1. Upload the 'calendarize-it' folder to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. In the menu you will find Calendarize It. 

== FREQUENTLY ASKED QUESTIONS ==

If you have any questions or trouble using this plugin you are welcome to contact us through our profile on Codecanyon (http://codecanyon.net/user/RightHere)

Or visit our HelpDesk at http://support.righthere.com


== HOW CAN I PROVIDE ACCESS TO CALENDARIZE IT TO OTHER USERS THAN THE ADMINISTRATOR? ==

Use the following capabilities:

- manage_venue
- manage_calendar
- manage_organizer

- edit_event
- read_event
- read_private_events
- delete_event
- delete_others_events
- edit_events
- edit_others_events
- edit_published_events
- publish_events
- read_private_events

== HOW DO I INSERT CALENDARIZE IT IN A PAGE OR POST? ==

You can insert Calendars in any Page, Post or Custom Post Type you want.
Use the following Shortcodes to insert Calendars:

[calendarizeit]
This Shortcode will insert the Calendar and will display all events created by all users.

[calendarizeit author_name='username']
This Shortcode will insert the Calendar and only display events created by the 'username'. Replace 'username' with any user from WordPress

[calendarizeit author='ID,ID']
This Shortcode will insert the Calendar and display events created by multiple authors. Replace ID with the ID number of the author. You can find the ID number of an author by holding the cursor over "edit" in the Users List, and then view the bottom line. It will show something like /user-edit.php?user_id=2. In this case enter the number "2" as the ID.

[calendarizeit post_type="post"]
This Shortcode will insert the Calendar and display the post type that you enter. You will need to enable the Custom Post Type in the options panel.

[calendarizeit taxonomy='calendar' terms='concerts']
This Shortcode will insert the Calendar and based on the Custom Taxonomy that you have defined you can display e.g. a Concert Calendar. 

[calendarizeit venue='place']
This Shortcode will insert the Calendar and based on the 'place' (venue) it will display all events assigned to the specific venue.

[calendarizeit organizer='name']
This Shortcode will insert the Calendar and based on the 'name' (organizer) it will display all events assigned to the specific organizer.

[calendarizeit calendar='name']
This Shortcode will insert the Calendar and based on the 'name' (calendar) it will display all events assigned to the specific calendar.


== SOURCES - CREDITS & LICENSES ==

We have used the following open source projects, graphics, fonts, API's or other files as listed. Thanks to the author for the creative work they made.

1) FullCalendar jQuery plugin
   http://arshaw.com/fullcalendar/

DISCLAIMER: FullCalendar is great for displaying events, but it isn't a complete solution for event content-management. Beyond dragging an event to a different time/day, you cannot change an event's name or other associated data. It is up to you to add this functionality through FullCalendar's event hooks.

2) jQuery UI ThemeRoller
   http://jqueryui.com/themeroller/

