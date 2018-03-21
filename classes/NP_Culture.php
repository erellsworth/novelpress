<?php

if(!class_exists('NP_Culture')){
	class NP_Culture{
		use NP_PostType;

		function __construct() {
			$this->post_type = 'culture';
			$this->singular = 'Culture';
			$this->plural = 'Cultures';
			$this->description = 'NovelPress Culture Post Type';
		}		
	}

	$NP_Culture = new NP_Culture();

	add_action('init', array($NP_Culture, 'register'));	
}