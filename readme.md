# Basset Foundation Theme
This is a parent theme for WordPress that adds quick configuration and a built-in LESS compiler.

**Version:** 0.9.9  
**Requires at least:** WordPress 4.0  
**Tested On:** 4.2.2

See [wiki](https://github.com/brentjett/Basset/wiki) for usage documentation. See [changelog](https://github.com/brentjett/Basset/blob/master/changelog.md) for version details

## Requirements
The basset theme requires two plugins for full functionality.

* Shortcake (Shortcode UI) - https://wordpress.org/plugins/shortcode-ui/
* Advanced Custom Fields v5+ - http://www.advancedcustomfields.com/

While the theme will activate without these plugins present and active, none of the admin pages or metaboxes will be available no will the shortcodes render their views in the editor. Basset will prompt you if you have not installed or activated the Shortcode UI plugin and you can do so automatically. Unfortunately, because the ACF is a premium plugin, it isn't able to prompt you to install it at this time.

## Configuration
The basset theme offers the option to use JSON to configure your WordPress child theme rather than putting logical code into your functions.php file. By default, Basset looks for a file in the root of your child theme called config.json. The format of that file looks like this:

```json
{
    "theme_support" : {
        "title_tag" : true,
        "html5" : [
			"comment-list",
			"comment-form",
			"search-form",
			"gallery",
			"caption"
		]
    },
    "register_styles" : {
		"arvo-font" : {
			"path" : "http://fonts.googleapis.com/css?family=Arvo"
		}
	},
	"enqueue_styles" : {
		"child-theme" : {
			"path" : "style.less",
			"dependancies" : ["open-sans", "arvo-font", "dashicons"]
		}
	},
    "enqueue_scripts" : {
		"theme" : {
			"path" : "libraries/theme.js",
			"dependancies" : ["jquery"]
		}
	},
	"nav_menus" : {
		"header" : "Header Menu",
		"footer" : "Footer Menu"
	},
	"meta_tags" : {
		"chars" : {
			"charset" : "UTF-8"
		},
		"ie-compat" : {
			"content" : "IE=edge",
			"http-equiv" : "X-UA-Compatible"
		},
		"viewport" : "width=device-width, initial-scale=1.0",
		"referrer" : "always"
	}
}
```

See [Configuration](https://github.com/brentjett/Basset/wiki/Configuration) for full documentation on things that can be configured with json.
