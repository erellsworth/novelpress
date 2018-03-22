<?php

if(!class_exists('NP_Book')){
	class NP_Book{
		use NP_PostType;

		function __construct() {
			$this->post_type = $this->post_type_list['BOOK'];
			$this->singular = __('Book', 'novelpress');
			$this->plural = __('Books', 'novelpress');
			$this->description = __('NovelPress Book Post Type', 'novelpress');
		}		
	}

	$NP_Book = new NP_Book();

	add_action('init', array($NP_Book, 'register'));	
}