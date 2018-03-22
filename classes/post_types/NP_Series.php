<?php

if(!class_exists('NP_Series')){
	class NP_Series{
		use NP_PostType;

		function __construct() {
			$this->post_type = 'series';
			$this->singular = 'Series';
			$this->plural = 'Series';
			$this->description = 'NovelPress Series Post Type';
		}		
	}

	$NP_Series = new NP_Series();

	add_action('init', array($NP_Series, 'register'));	
}