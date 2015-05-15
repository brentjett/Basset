# Basset Foundation Theme
This is a parent theme for WordPress that adds quick configuration and a built-in LESS compiler.

**Version:** 0.9.9  
**Requires at least:** WordPress 4.0  
**Tested On:** 4.2.2

See [wiki](https://github.com/brentjett/Basset/wiki) for usage documentation.

See [changelog](https://github.com/brentjett/Basset/blob/master/changelog.md) for version details

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
