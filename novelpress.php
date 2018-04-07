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

//meta boxes
require_once NOVELPRESS_PATH . '/traits/NP_Metabox.php';
require_once NOVELPRESS_PATH . '/classes/meta_boxes/NP_BookMeta.php';
require_once NOVELPRESS_PATH . '/classes/meta_boxes/NP_StoryMeta.php';
require_once NOVELPRESS_PATH . '/classes/meta_boxes/NP_StorySettingMeta.php';
require_once NOVELPRESS_PATH . '/classes/meta_boxes/NP_SeriesMeta.php';
require_once NOVELPRESS_PATH . '/classes/meta_boxes/NP_CharacterMeta.php';
require_once NOVELPRESS_PATH . '/classes/meta_boxes/NP_CultureMeta.php';



//gutenberg blocks
//require_once NOVELPRESS_PATH . '/blocks/NP_Blocks.php';


/*
	Post types:
	Series:
		taxonomies:
			-genres	
		meta:
			-books
			-stories
		relations:
			has many books
			has many stories

	Books and stories:
		taxonomies:
			-genres
		meta:
			-wordcount ['current' => 0, 'complete' =>0]
			-status
			-publisher
			-links
			-publication_date
			-date_completed
			-number_in_series
		relations:
			has many story_settings	
			has many characters					
	
	Story Setting:
		taxonomies:
		meta:
			-population
			-history
			-species
		relations
			belongs to series
			has many books
			has many characters
			has many cultures		

	Cultures:
		taxonomies:
			-religion
			-language
		meta:
			-books
			-technology
			-magic
			-economy
		relations
			belongs to series
			has many books
			has many characters
			has many story_settings				

	Characters:
		taxonomies:
			-species
			-language
			-religion
		meta:
			-physical_description
			-history
		relations
			-has many books
			-has many stories
			-has many story_settings

*/
