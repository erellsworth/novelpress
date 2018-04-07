<?php

if(!class_exists('NP_StorySettingMeta')){
	class NP_StorySettingMeta{
		use NP_Metabox;

		function __construct() {
			$this->post_types = array($this->post_type_list['STORY_SETTING']);
			$this->id = 'story_setting_meta';
			$this->title = 'Setting Details';
			$this->post_class = 'NP_StorySetting';
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
									'post_class' => 'NP_Culture',
									'inverse' => 'has_many'
								)	
							)
						);		
		}
			
		public function form(){

		}

	}

	$NP_StorySettingMeta = new NP_StorySettingMeta();
	$NP_StorySettingMeta->init();
}