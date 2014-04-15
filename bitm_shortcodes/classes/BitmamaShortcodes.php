<?php

class BitmamaShortcodes {

  /**
   * Keeps track of shortcodes attributes
   *
   * @var array 
   */
  protected $_shortcodes_atts;

  /**
   * Constructor that initialize the attributes array
   */
  public function __construct() {
    $this->_shortcodes_atts = array();
  }

  /**
   * Register a shortcode
   * 
   * @param string $shortcode_name
   * @param string $shortcode_function
   * @param array $params
   * @return boolean
   */
  public function registerShortcode($shortcode_name, $shortcode_function = NULL, $params = array()) {
    if (is_null($shortcode_function)) {
      $shortcode_function = sprintf("%s_func", $shortcode_name);
    }
    if (method_exists($this, $shortcode_function)) {
      $this->_shortcodes_atts[$shortcode_name] = $params;
      add_shortcode($shortcode_name, array($this, $shortcode_function));
      return TRUE;
    } else {
      return FALSE;
    }
  }

  /**
   * Renders a shortcode
   * 
   * @param string $template
   * @param array $atts
   * @return string
   */
  protected function _toHtml($template, $atts = array()) {
    ob_start();
    foreach ($atts as $att_name => $att_value) {
      $$att_name = $att_value;
    }
    include(dirname(__FILE__) . '/../templates/' . $template . '.phtml');
    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;
  }

  /**
   * Extract shortcode attributes
   * 
   * @param string $shortcode_name
   * @param array $attributes
   * @return array
   */
  protected function _extractParameters($shortcode_name, $attributes) {
    extract(shortcode_atts($this->_shortcodes_atts[$shortcode_name], $attributes));
    $params = array();
    foreach ($this->_shortcodes_atts[$shortcode_name] as $key => $value) {
      $params[$key] = $$key;
    }
    return $params;
  }

  /**
   * Sample shortcodes handling
   * 
   * @param array $atts
   * @return string
   */
  public function foobar_func($atts) {
    $_name = "foobar";
    return $this->_toHtml($_name, $this->_extractParameters($_name, $atts));
  }

}