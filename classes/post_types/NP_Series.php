<?php

if(!class_exists('NP_Series')){
	class NP_Series{
		use NP_PostType;

		function __construct() {
			$this->post_type = __('series', 'novelpress');
			$this->singular = __('Series', 'novelpress');
			$this->plural = __('Series', 'novelpress');
			$this->description = __('NovelPress Series Post Type', 'novelpress');
		}				
	}

	$NP_Series = new NP_Series();

	add_action('init', array($NP_Series, 'register'));	
}