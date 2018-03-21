<?php

if(!class_exists('NP_Story')){
	class NP_Story{
		use NP_PostType;

		function __construct() {
			$this->post_type = 'story';
			$this->singular = 'Story';
			$this->plural = 'Stories';
			$this->description = 'NovelPress Story Post Type';
		}		
	}

	$NP_Story = new NP_Story();

	add_action('init', array($NP_Story, 'register'));	
}