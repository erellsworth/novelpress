<?php

if(!class_exists('NP_CharacterMeta')){
	class NP_CharacterMeta{
		use NP_Metabox;

		function __construct() {
			$this->post_types = array($this->post_type_list['CHARACTER']);
			$this->id = 'character_meta';
			$this->title = 'Character Details';
			$this->post_class = 'NP_Character';
			$this->relations = array(
						'has_many' => array(
								array(
									'post_class' => 'NP_Book',
									'inverse' => 'has_many'
								),
								array(
									'post_class' => 'NP_Story',
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

	$NP_CharacterMeta = new NP_CharacterMeta();
	$NP_CharacterMeta->init();
}