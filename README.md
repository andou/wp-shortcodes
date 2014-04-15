wp-shortcodes
=============

This Wordpress plugin provide a developer friendly way to handle shortcodes

To install the plugin:
- Change config.sample.json to config.json

To handle a new shortcode:
- Add a new entry in config.json. "name" is the shortcut name, "function" is the method name, "parameters" handle paramters defaults
- Add a new method into BitmamaShortcodes class, name of this method should be the same you specified in "function"
- If you plan to use a phtml file to render your shortcode, add a new phtml file under templates named after the shortcode name
- Start using your new shortcode

