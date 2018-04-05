<?php

if(!class_exists('NP_BookMeta')){
	class NP_BookMeta{
		use NP_Metabox;

		function __construct() {
			$this->post_types = array($this->post_type_list['BOOK']);
			$this->id = 'book_meta';
			$this->title = 'Book Details';
			$this->relations = array(
				'belongs_to' => array($this->post_type_list['SERIES']),
				'has_many' => array(
						$this->post_type_list['CHARACTER'],
						$this->post_type_list['STORY_SETTING']
						)
				);
		}
			
		public function form(){

		}

	}

	$NP_BookMeta = new NP_BookMeta();
	$NP_BookMeta->init();
}