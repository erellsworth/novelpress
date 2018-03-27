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

//post types:
$post_types = array(
		'SERIES' => __('series', 'novelpress'),
		'BOOK' => __('book', 'novelpress'),
		'STORY' =>  __('story', 'novelpress'),
		'STORY_SETTING' =>  __('story_setting', 'novelpress'),
		'CULTURE' =>  __('culture', 'novelpress'),
		'CHARACTER' =>  __('character', 'novelpress')
	);
define('NOVELPRESS_POST_TYPES', $post_types);

require_once NOVELPRESS_PATH . '/traits/NP_PostType.php';
require_once NOVELPRESS_PATH . '/classes/post_types/NP_Series.php';
require_once NOVELPRESS_PATH . '/classes/post_types/NP_Book.php';
require_once NOVELPRESS_PATH . '/classes/post_types/NP_Story.php';
require_once NOVELPRESS_PATH . '/classes/post_types/NP_StorySetting.php';
require_once NOVELPRESS_PATH . '/classes/post_types/NP_Character.php';
require_once NOVELPRESS_PATH . '/classes/post_types/NP_Culture.php';


//categories and tags
$taxonomies = array(
		'GENRE' => __('genre', 'novelpress'),
		'RELIGION' => __('religion', 'novelpress'),
		'SPECIES' =>  __('species', 'novelpress'),
		'LANGUAGE' =>  __('language', 'novelpress')
	);
define('NOVELPRESS_TAXONOMIES', $taxonomies);

require_once NOVELPRESS_PATH . '/traits/NP_Taxonomy.php';
require_once NOVELPRESS_PATH . '/classes/taxonomies/NP_Genre.php';
require_once NOVELPRESS_PATH . '/classes/taxonomies/NP_Religion.php';
require_once NOVELPRESS_PATH . '/classes/taxonomies/NP_Language.php';
require_once NOVELPRESS_PATH . '/classes/taxonomies/NP_Species.php';

//gutenberg blocks
require_once NOVELPRESS_PATH . '/blocks/NP_Blocks.php';


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
			-language
		meta:
			-technology
			-magic
			-economy

	Characters:
		taxonomies:
			-species
			-language
			-religion
		meta:
			-books
			-stories
			-story_settings
			-physical_description
			-history
*/
