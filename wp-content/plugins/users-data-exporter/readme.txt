=== Users Data Exporter ===
Contributors: taheruddin
Tags: user, meta, data, export, xls, xlsx, excel, spreadsheet, AJAX, filter by user id, filter by user role, filter by email, filter by login, filter by registration date, filter by paid membership pro level, filter by user meta  
Requires at least: 3.8.0
Tested up to: 4.4
Stable tag: 1.0
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Robust way to export selected users data to .xlsx spreadsheet, especially when number of users of a site is very big like 100,000+.


== Description ==

Robust way to export selected users data to .xlsx spreadsheet, especially when number of users of a site is very big like 100,000+.

Available Filters:
<br>- User Roles (One or more)
<br>- User Email
<br>- User Login
<br>- User ID
<br>- User Registration Date
<br>- Paid Membership Pro Level
<br>- User Meta Fields (One or more)

This plugin splits task of capturing users data by applying AJAX and protects from the issue of PHP execution timed out.

Filter option for Paid Membership Pro Level is available only if Paid Membership Pro plugin is installed and activated.

Single execution length can be increased to adjust with available server resources and number users intending to export.


== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/user-data-exporter` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Access at Users->Users Data Exporter


== Frequently Asked Questions ==

= Can I use "%" comparison for "equal to" filter? =

Yes, you can if the WordPress is using a MySQL database. But, not for email filter.

= Taking too long to complete the exporting. How can I shorten the duration? =

Increase the single execution length. But do not increase it too much to avoid PHP execution timeout.


== Screenshots ==

1. Initial Interface 

2. Waiting While Exporting 

3. Downloading 

4. Exported .xlsx File in Microsoft Excel 


== Changelog ==

= 1.0 =
* Initial release
