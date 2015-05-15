# Basset Foundation Theme
This is a parent theme for WordPress that adds quick configuration and a built-in LESS compiler.

**Version:** 0.9.9  
**Requires at least:** WordPress 4.0  
**Tested On:** 4.2.2

See [wiki](https://github.com/brentjett/Basset/wiki) for usage documentation.

See [changelog](https://github.com/brentjett/Basset/blob/master/changelog.md) for version details

## configuration
The basset theme offers the option to use JSON to configure your WordPress child theme rather than putting logical code into your functions.php file. By default, Basset looks for a file in the root of your child theme called config.json. The format of that file looks like this:

```json
{
    "theme_support" : {

    }
}
```
