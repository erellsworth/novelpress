<?php

if(!class_exists('NP_Religion')){
	class NP_Religion{
		use NP_Taxonomy;

		function __construct() {
			$this->post_types = array(
					$this->post_type_list['CULTURE'],
					$this->post_type_list['CHARACTER']
				);
			$this->taxonomy = $this->taxonomy_list['RELIGION'];
			$this->singular = __('Religion', 'novelpress' );
			$this->plural = __('Religions', 'novelpress' );
			$this->args = array('hierarchical' => true);
		}		
	}

	$NP_Religion = new NP_Religion();

	add_action('init', array($NP_Religion, 'register'));	
}