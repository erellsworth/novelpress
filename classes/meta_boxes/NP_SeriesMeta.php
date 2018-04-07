<?php

if(!class_exists('NP_SeriesMeta')){
	class NP_SeriesMeta{
		use NP_Metabox;

		function __construct() {
			$this->post_types = array($this->post_type_list['SERIES']);
			$this->id = 'series_meta';
			$this->title = 'Series Details';
			$this->post_class = 'NP_Series';
			$this->relations = array(
						'has_many' => array(
								array(
									'post_class' => 'NP_Book',
									'inverse' => 'belongs_to'
								),
								array(
									'post_class' => 'NP_Story',
									'inverse' => 'belongs_to'
								)
							)
						);			
		}
			
		public function form(){

		}

	}

	$NP_SeriesMeta = new NP_SeriesMeta();
	$NP_SeriesMeta->init();
}