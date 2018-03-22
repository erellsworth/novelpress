<?php

if(!trait_exists('NP_Taxonomy')){
	trait NP_Taxonomy {

		public $post_type_list = NOVELPRESS_POST_TYPES;
		public $taxonomy_list = NOVELPRESS_TAXONOMIES;
		public $singular, $plural, $taxonomy;
		public $labels = array();
		public $args = array();
		public $post_types = array();

		public function get_labels(){
			$default_labels = array(
				'name'                       => $this->plural,
				'singular_name'              => $this->singular,
				'menu_name'                  => $this->plural,
				'all_items'                  => __('All', 'novelpress') . ' '   . ' ' . $this->singular,
				'parent_item'                => __( 'Parent', 'novelpress') . ' ' . $this->singular,
				'parent_item_colon'          => __( 'Parent', 'novelpress' ) . ' ' . $this->singular,
				'new_item_name'              => __( 'New', 'novelpress' ) . ' ' . $this->singular,
				'add_new_item'               => __( 'Add New', 'novelpress' ) . ' ' . $this->singular,
				'edit_item'                  => __( 'Edit', 'novelpress' ) . ' ' . $this->singular,
				'update_item'                => __( 'Update', 'novelpress' ) . ' ' . $this->singular,
				'view_item'                  => __( 'View', 'novelpress' ) . ' ' . $this->singular,
				'separate_items_with_commas' => __( 'Separate', 'novelpress')  . ' ' . $this->plural . ' ' . __('with commas', 'novelpress' ),
				'add_or_remove_items'        => __( 'Add or remove', 'novelpress' ) . ' ' . $this->plural,
				'choose_from_most_used'      => __( 'Choose from the most used', 'novelpress' ),
				'popular_items'              => __( 'Popular', 'novelpress' ) . ' ' . $this->plural,
				'search_items'               => __( 'Search', 'novelpress' ) . ' ' . $this->plural,
				'not_found'                  => __( 'Not Found', 'novelpress' ),
				'no_terms'                   => __( 'No', 'novelpress' ) . ' ' . $this->plural,
				'items_list'                 => $this->singular . ' ' . __( 'list', 'novelpress' ),
				'items_list_navigation'      =>$this->singular . ' ' . __( 'navigation', 'novelpress' ),
			);
			$labels = array_merge($default_labels, $this->labels);

			return apply_filters('novelpress_' . $this->taxonomy . '_taxonomy_labels', $labels);
		}

		public function get_args(){
			$default_args = array(
				'labels'                     => $this->get_labels(),
				'hierarchical'               => false,
				'public'                     => false,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => false,
				'show_tagcloud'              => false,
			);

			$args = array_merge($default_args, $this->args);

			return apply_filters('novelpress_' . $this->taxonomy . '_taxonomy_args', $args);			
		}
	    
	   	public function register() {
			register_taxonomy( $this->taxonomy, $this->post_types, $this->get_args() );	
	    }
	}	
}

