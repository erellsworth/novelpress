<?php

if(!class_exists('NP_BookMeta')){
	class NP_BookMeta{
		use NP_Metabox;

		function __construct() {
			$this->post_types = array($this->post_type_list['BOOK']);
			$this->id = 'book_meta';
			$this->title = 'Book Details';
			$this->post_class = 'NP_Book';
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

	$NP_BookMeta = new NP_BookMeta();
	$NP_BookMeta->init();
}