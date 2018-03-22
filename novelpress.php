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
Text Domain: novelpress
*/

define('NOVELPRESS_PATH', dirname(__FILE__));
define('NOVELPRESS_URI', plugin_dir_url( __FILE__ ));

$config = array();

define('NOVELPRESS_CONFIG', $config);

require_once NOVELPRESS_PATH . '/traits/NP_PostType.php';
require_once NOVELPRESS_PATH . '/traits/NP_Taxonomy.php';
require_once NOVELPRESS_PATH . '/classes/NP_Series.php';
require_once NOVELPRESS_PATH . '/classes/NP_Book.php';
require_once NOVELPRESS_PATH . '/classes/NP_Story.php';
require_once NOVELPRESS_PATH . '/classes/NP_StorySetting.php';
require_once NOVELPRESS_PATH . '/classes/NP_Character.php';
require_once NOVELPRESS_PATH . '/classes/NP_Culture.php';

/*
	Post types:
	Series:
		taxonomies:
			-genres	
		meta:
			-books
			-stories

	Books and stories:
		taxonomies:
			-genres
		meta:
			-characters
			-story_settings
			-wordcount ['current' => 0, 'complete' =>0]
			-status
			-publisher
			-links
			-publication_date
			-date_completed
			-series
			-number_in_series
	
	Story Setting:
		taxonomies:
		meta:
			-books
			-characters
			-population
			-history
			-species
			-culture

	Cultures:
		taxonomies:
			-religion
		meta:
			-technology
			-magic
			-economy

	Characters:
		taxonomies:
			-species
			-language
		meta:
			-books
			-stories
			-story_settings
			-physical_description
			-history
*/
