<?php
/**
 * @package NovelPress
 * @version 0.0.1
 */
/*
Plugin Name: NovelPress
Description: A WordPress plugin for novel writers
Author: E.R. Ellsworth
Plugin URI: https://erellsworth.com/wordpress
Version: 0.0.1
Author URI: https://erellsworth.com
*/

define('NOVELPRESS_PATH', dirname(__FILE__));
define('NOVELPRESS_URI', plugin_dir_url( __FILE__ ));

$config = array();

define('NOVELPRESS_CONFIG', $config);