<?php

if(!class_exists('NP_StorySetting')){
	class NP_StorySetting{
		use NP_PostType;

		function __construct() {
			$this->post_type = 'story_setting';
			$this->singular = 'Story Setting';
			$this->plural = 'Story Settings';
			$this->description = 'NovelPress Story Setting Post Type';
		}		
	}

	$NP_StorySetting = new NP_StorySetting();

	add_action('init', array($NP_StorySetting, 'register'));	
}