<?php

if(!class_exists('NP_StoryMeta')){
	class NP_StoryMeta{
		use NP_Metabox;

		function __construct() {
			$this->post_types = array($this->post_type_list['STORY']);
			$this->id = 'story_meta';
			$this->title = 'Story Details';
			$this->post_class = 'NP_Story';
			$this->relations = array(
						'belongs_to' => array(
								array(
									'post_class' => 'NP_Series',
									'inverse' => 'has_many'
								)
							),
						'has_many' => array(
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

	$NP_StoryMeta = new NP_StoryMeta();
	$NP_StoryMeta->init();
}