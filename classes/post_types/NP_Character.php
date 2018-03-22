<?php

if(!class_exists('NP_Character')){
	class NP_Character{
		use NP_PostType;

		function __construct() {
			$this->post_type = __('character', 'novelpress');
			$this->singular = __('Character', 'novelpress');
			$this->plural = __('Characters', 'novelpress');
			$this->description =  __('NovelPress Character Post Type', 'novelpress');
		}		
	}

	$NP_Character = new NP_Character();

	add_action('init', array($NP_Character, 'register'));	
}