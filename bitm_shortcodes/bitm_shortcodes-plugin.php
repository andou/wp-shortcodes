<?php

/*
  Plugin Name: Bitmama Shortcodes
  Description: This plugin provide a developers friendly way to handle shortcodes
  Version: 1.0
  Author: Antonio Pastorino <antonio.pastorino@gmail.com>
 */

//Catch anyone trying to directly acess the plugin - which isn't allowed
if (!function_exists('add_action')) {
  header('Status: 403 Forbidden');
  header('HTTP/1.1 403 Forbidden');
  exit();
}

////////////////////////////////////////////////////////////////////////////////
////////////////////////////  SHORTCODES   /////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

if (!class_exists("BitmamaShortcodes")) {
  include_once dirname(__FILE__) . '/classes/BitmamaShortcodes.php';
}

if (class_exists("BitmamaShortcodes") && file_exists(dirname(__FILE__) . "/config.json")) {
  $shortcodes = new BitmamaShortcodes();
  $config_file = file_get_contents(dirname(__FILE__) . "/config.json");
  $config = json_decode($config_file, true);
  foreach ($config['shortcodes'] as $shortcode) {
    $shortcodes->registerShortcode($shortcode['name'], $shortcode['function'],$shortcode['parameters']);
  }
}