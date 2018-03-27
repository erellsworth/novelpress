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

/*function gutenberg_boilerplate_block() {
    wp_register_script(
        'gutenberg-boilerplate-es5-step01',
        plugins_url( 'step-01/block.js', __FILE__ ),
        array( 'wp-blocks', 'wp-element' )
    );

    register_block_type( 'gutenberg-boilerplate-es5/hello-world-step-01', array(
        'editor_script' => 'gutenberg-boilerplate-es5-step01',
    ) );
}
add_action( 'init', 'gutenberg_boilerplate_block' );*/