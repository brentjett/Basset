# Changelog


## 0.9.9 (5-15-2015)
* Add TGM Activation library support for Shortcode UI Plugin. ACF not yet included.

---


April 26
Version 0.6
- Add full "theme supports" functionality to config.json reader

April 27
Version 0.7
- Update Shortcake Plugin support for [basset_cta] - content attribute change

Version 0.8
- Add [basset_phone] shortcode. Pulls from Settings -> Business Information. Allows for phone numbers to be displayed as links, wrapped in a span with the correct classes added, or simply returned as plain text.

Version 0.8.1
- Allow [basset_cta] shortcode to run shortcodes inside it's content.

April 29
Version 0.9
- Add Location Template

April 30
Version 0.9.1
- Fix [basset_phone] shortcode
- Update wp-classes.less for max-width

Version 0.9.2
- Add nav drop down support

Version 0.9.3
- Add filter to less compiler to hook into $less object
- BIG css library update. All CSS libraries use mixins to define helpers so nothing is rendered unless used.
- Incorporate semantic.gs grid - libraries/grid.less

May 1, 2015
Version 0.9.4
- Tighten up location template
- Add 404 template
- Add shortcode styles to basset.less - NOT a permanent solution.
- Added [basset_quote] shortcode & action
- Added [basset_social_icons] shortcode and action - Need to finish hookups.
- Removed shortcake support for [basset_phone] - Shortcake is breaking inline shortcodes

May 5, 2015
Version 0.9.6
- Added base support for template enqueue

May 6, 2015
Version 0.9.7
- Comment out template enqueue processor - not ready
- Add admin support for social icons. See Settings -> Business Information
- Add template enqueue support (Stylesheets and Scripts) for template and template parts.

May 13, 2015
Version 0.9.8
- Numerous changes since 0.9.7
- Intrduce sections api - Allows full width sections inside page content.
- Added full-width section support to blockquote shortcode.
