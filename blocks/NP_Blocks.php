<?php

if(!class_exists('NP_Blocks')){
	class NP_Blocks{

		public static function register(){
		    wp_register_script(
		        'novelpress-blocks',
		        plugins_url( 'blocks.js', __FILE__ ),
		        array( 'wp-blocks', 'wp-element' )
		    );

		    register_block_type( 'novelpress/book-block', array('editor_script' => 'novelpress-blocks') );
		}	

	}

	add_action( 'init', array('NP_Blocks', 'register'));	
}