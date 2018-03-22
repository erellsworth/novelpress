<?php

if(!class_exists('NP_Culture')){
	class NP_Culture{
		use NP_PostType;

		function __construct() {
			$this->post_type = __('culture', 'novelpress');
			$this->singular = __('Culture', 'novelpress');
			$this->plural = __('Cultures', 'novelpress');
			$this->description = __('NovelPress Culture Post Type', 'novelpress');
		}		
	}

	$NP_Culture = new NP_Culture();

	add_action('init', array($NP_Culture, 'register'));	
}