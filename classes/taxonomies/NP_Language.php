<?php

if(!class_exists('NP_Language')){
	class NP_Language{
		use NP_Taxonomy;

		function __construct() {
			$this->post_types = array(
					$this->post_type_list['CHARACTER'],
					$this->post_type_list['CULTURE'],
				);
			$this->taxonomy = $this->taxonomy_list['LANGUAGE'];
			$this->singular = __('Language', 'novelpress' );
			$this->plural = __('Languages', 'novelpress' );
		}		
	}

	$NP_Language = new NP_Language();

	add_action('init', array($NP_Language, 'register'));	
}