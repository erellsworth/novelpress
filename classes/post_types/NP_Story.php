<?php

if(!class_exists('NP_Story')){
	class NP_Story{
		use NP_PostType;

		function __construct() {
			$this->post_type =  __('story', 'novelpress');
			$this->singular =  __('Story', 'novelpress');
			$this->plural =  __('Stories', 'novelpress');
			$this->description =  __('NovelPress Story Post Type', 'novelpress');
		}		
	}

	$NP_Story = new NP_Story();

	add_action('init', array($NP_Story, 'register'));	
}