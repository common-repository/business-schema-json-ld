=== Business Schema JSON-LD ===
Contributors: poxrud
Donate link: https://www.twitter.com/poxrud
Tags: JSON-LD, schema.org, schema, structured data, seo
Requires at least: 4.0
Tested up to: 4.9.1
Requires PHP: 5.4
Stable tag: trunk
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Generate Structured Data in JSON-LD format for Product based businesses. Supports popular schema.org types that would be commonly used by a typical business. 

== Description ==

This plugin generates Structured Data Schema in JSON-LD format. This could potentially improve your site's visibility and SEO.

To learn more about Structured Data and Schema please visit Google's [Introduction to Structured Data](https://developers.google.com/search/docs/guides/intro-structured-data).

Make sure to test your website's structured data using the [Structured Data Testing tool](https://search.google.com/structured-data/testing-tool).

While there are hundreds of differet Schema types this plugin's focus is on those types that releate to Product based businesses.

Currently as of version 1.0.0 the plugin supports the following Schema types:

* [WebSite](http://schema.org/WebSite)
* [Organization](https://developers.google.com/search/docs/data-types/corporate-contacts)
* [Products](https://developers.google.com/search/docs/data-types/products)
* New types will be added in future versions.

NOTICE: This plugin is offered free of charge. It has been written by [Phil Oxrud](https://www.twitter.com/poxrud). 

= Features =
* Specifically Tailored for Google's structured data schema
* WebSite Schema
* Organization Schema
* Indicate multiple contact phone numbers using schema
* Indicate multiple social media accounts using schema (twitter, facebook, and youtube)
* Supports Products Schema
* Generate defaults or customize the schema of every individual product.

== Installation ==
1. Upload the plugin files to the `/wp-content/plugins/business-schema` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the "Settings->Business Schema" screen to configure the plugin
4. Under the **Products Schema Settings** section select the post type that represents your products. (i.e. "product", "car", or even "post")
5. _Optional_: Visit every individual product to customize its schema properties in the **Business Schema Products Settings** box.

== Frequently Asked Questions ==

= Are blog posts supported? =

An "Article" schema type is scheduled to be released in the next version.

= Does the plugin support product reviews? =

Not yet but it is the top priority feature.

== Screenshots ==

1. Location of Business Schema Settings Page
2. Business Schema Settings Page. Configure site wide settings. 
3. Business Schema Products Settings box for individual product settings
4. Example of a generated schema in the html source code

== Changelog ==

= 1.0.0 =
* First release
* Supports WebSite Schema
* Supports Organization Schema, including multiple contacts, social media
* Supports Products Schema

== Upgrade Notice ==

None at the moment.
