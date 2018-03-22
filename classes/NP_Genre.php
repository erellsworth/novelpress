<?php

if(!class_exists('NP_Genre')){
	class NP_Genre{
		use NP_Taxonomy;

		function __construct() {
			$this->post_types = array(
					$this->post_type_list['SERIES'],
					$this->post_type_list['BOOK'],
					$this->post_type_list['STORY']
				);
			$this->taxonomy = $this->taxonomy_list['GENRE'];
			$this->singular = 'Genre';
			$this->plural = 'Genres';
		}		
	}

	$NP_Genre = new NP_Genre();

	add_action('init', array($NP_Genre, 'register'));	
}