=== Filament ===
Contributors: kynatro, dtelepathy, dtlabs, bethanydt, heyshawn
Donate link: http://filament.io/wordpress
Tags: analytics, performance, dashboard, social, sharing, engagement, content marketing, scroll rate, visitor behavior, engagement score, mobile sharing, Google Analytics, Google Analytics Plugin, WordPress analytics, tracking, SlideDeck, Flare, Pinterest, Twitter, social bar, dtelepathy, Facebook, Adjusted Bounce
Requires at least: 3.0
Tested up to: 4.3.1
License: GPL3
Stable tag: trunk

The Filament WordPress plugin enables you to easily connect your blog to Filament, which tracks your blog visitor behavior, social activity and more.

== Description ==

Filament is the only analytics tool designed specifically for growing your blog, identifying what is working well and where to best promote your content.

The Filament plugin is also necessary to install Flare, the free social sharing bar. It’s completely customizable and the Pro version is optimized for iOS and Android mobile sharing.

Try Filament Blog Analytics and Flare Pro completely free. Flare will default to the Lite version if you choose not to upgrade.

[Sign up for your free account now][signup_url]

*Built by Digital Telepathy, creators of SlideDeck and Hello Bar*

[signup_url]: http://filament.io/wordpress?utm_source=filament_wp&utm_medium=link&utm_content=repo&utm_campaign=filament

== Screenshots ==

1. Blog activity overview including sharing and traffic activity over time
2. Individual post performance summary
3. Individual post details, including traffic and social breakdown and top social supporters with automatically generated tips for improvement
4. Individual post details continued, including engagement detail, category comparison, page retention and scroll depth
5. Easily run new reports to see how various content is performing
7. Easy to connect to your WordPress blog, just copy and paste your unique Filament code snippet.

== Installation ==

The plugin is simple to install:

1. Download `filament.zip`
1. Unzip
1. Upload `filament` directory to your `/wp-content/plugins` directory
1. Go to the plugin management page and enable the plugin

== Changelog ==
= 1.2.14 =
* Update tested up to version number
* Improve design and usability of plugin

= 1.2.13 =
* Moved Filament code snippet output to `wp_footer()` instead of `wp_header()`. Meta tags are still output in `wp_header()` however.

= 1.2.12 =
* Bump "Tested up to" WordPress version to most recent release

= 1.2.11 =
* Fix ampersand encoding in local StumbleUpon and Google+ stats URLs

= 1.2.10 =
* Only bind route() action to `init` if not `DOING_AJAX`

= 1.2.9 =
* Update social stats urls to use {{}} instead of ERB style brackets for templating

= 1.2.8 =
* Add meta tag for detection of previews

= 1.2.7 =
* Add Google+ and StumbleUpon JSONP proxy end-points to improve reliability of Flare and Insights social statistic retrieval and remove dependency on centralized Filament proxy server.
* Update compatible-up-to version

= 1.2.6 =
* Change permissions to access Filament menu items for better compatibility with WordPress Network installations
* Update cache clear message prompt to accommodate for un-known cache systems

= 1.2.5 =
* Improve user interface flow for easier on-boarding with Filament application

= 1.2.0 =
* Modify AJAX end-point to respond to JSONP requests with a _REQUEST['callback'] parameter
* Restructure post_types structure in AJAX end-point response to respond with a key/value pair of name and label
* Plugin UI redesign

= 1.1.0 =
* Add save messaging to admin view
* Add <meta> tag output to describe post data for Filament Apps to read
* Add end-point for Filament App to ping to get category, tag and public post_type information to help improve Filament App UI experience for WordPress sites
* Add translation compatibility for messaging

= 1.0.4 =
* Update compatible-up-to version
* Fix typos

= 1.0.3 =
* Compatibility adjustment to routing to remove static method references
* Works-with version update

= 1.0.2 =
* Fix form routing and submission handling

= 1.0.1 =
* Improve sanitization
* Fix code escaping issue
* MP6 admin theme compatibility updates
* Update compatible with to WordPress core 3.7.1
* Switch to non-static Class structure for better backwards compatibility

= 1.0.0 =
* Initial commit

== Upgrade Notice ==
= 1.2.7 =
If you are using Google+ or StumbleUpon in your Flare, this update helps improve social stat retrieval for these networks.

= 1.0.2 =
Fixed critical form submission bugs, update now!

= 1.0.1 =
Fix some code escaping output issues, make sure to upgrade if you're having problems getting Filament to show up. You may need to re-paste your code snippet.

= 1.0.0 =
Signup for a Filament account and install it on your WordPress site!
