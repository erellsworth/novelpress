<?php

if(!class_exists('NP_Species')){
	class NP_Species{
		use NP_Taxonomy;

		function __construct() {
			$this->post_types = array(
					$this->post_type_list['CHARACTER']
				);
			$this->taxonomy = $this->taxonomy_list['SPECIES'];
			$this->singular = __('Species', 'novelpress' );
			$this->plural = __('Species', 'novelpress' );
		}		
	}

	$NP_Species = new NP_Species();

	add_action('init', array($NP_Species, 'register'));	
}