<?php

if(!class_exists('NP_CultureMeta')){
	class NP_CultureMeta{
		use NP_Metabox;

		function __construct() {
			$this->post_types = array($this->post_type_list['CULTURE']);
			$this->id = 'culture_meta';
			$this->title = 'Culture Details';
			$this->post_class = 'NP_Culture';
			$this->relations = array(
						'belongs_to' => array(
								array(
									'post_class' => 'NP_Series',
									'inverse' => 'has_many'
								)
							),
						'has_many' => array(
								array(
									'post_class' => 'NP_Book',
									'inverse' => 'has_many'
								),
								array(
									'post_class' => 'NP_Character',
									'inverse' => 'has_many'
								),
								array(
									'post_class' => 'NP_StorySetting',
									'inverse' => 'has_many'
								)	
							)
						);		
		}
			
		public function form(){

		}

	}

	$NP_CultureMeta = new NP_CultureMeta();
	$NP_CultureMeta->init();
}