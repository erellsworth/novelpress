<?php

if(!class_exists('NP_StorySetting')){
	class NP_StorySetting{
		use NP_PostType;

		function __construct() {
			$this->post_type =  __('story_setting', 'novelpress');
			$this->singular =  __('Story Setting', 'novelpress');
			$this->plural =  __('Story Settings', 'novelpress');
			$this->description =  __('NovelPress Story Setting Post Type', 'novelpress');
		}		
	}

	$NP_StorySetting = new NP_StorySetting();

	add_action('init', array($NP_StorySetting, 'register'));	
}