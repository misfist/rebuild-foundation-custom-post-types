=== Rebuild Foundation Custom Post Types ===
Contributors: Pea
Tags: plugin, custom post type
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.en.html

== Description ==

This plugin registers custom post types. It also registers taxonomies and custom field metaboxes.  If featured images are selected, they will be displayed in the column view.

This plugin doesn't change how custom post items are displayed in your theme.  You'll need to add templates for archive-{post_type}.php and single-{post_type}.php if you want to customize the display of portfolio items.

= Post Types =
Sites: `rebuild_sites` 

Custom Taxonomies: `rebuild_sites_category`

Custom Fields
* show_blog_posts (checkbox)
* category (`rebuild_sites_category` taxonomy select)
* gallery
* location
* hours

Exhibitions: `rebuild_exhibitions`

Custom Taxonomies: n/a (uses build-in taxonomy and `rebuild_sites_category`)

Custom Fields
* site_category
* gallery
* location
* hours
* date_range

== Installation ==

Install and activate.
Two new content types will appear in the left: Sites and Exhibitions