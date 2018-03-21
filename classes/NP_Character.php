<?php

if(!class_exists('NP_Character')){
	class NP_Character{
		use NP_PostType;

		function __construct() {
			$this->post_type = 'character';
			$this->singular = 'Character';
			$this->plural = 'Characters';
			$this->description = 'NovelPress Character Post Type';
		}		
	}

	$NP_Character = new NP_Character();

	add_action('init', array($NP_Character, 'register'));	
}