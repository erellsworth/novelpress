<?php

if(!class_exists('NP_Book')){
	class NP_Book{
		use NP_PostType;

		function __construct() {
			$this->post_type = 'book';
			$this->singular = 'Book';
			$this->plural = 'Books';
			$this->description = 'NovelPress Book Post Type';
		}		
	}

	$NP_Book = new NP_Book();

	add_action('init', array($NP_Book, 'register'));	
}