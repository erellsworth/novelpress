<?php

if(!trait_exists('NP_PostType')){
	trait NP_PostType {

		public $singular, $plural, $post_type, $description;
		public $taxonomies = array();
		public $supports = array( 'title', 'editor', 'thumbnail' );

		function get_labels(){
			$labels = array(
				'name'                  => $this->plural,
				'singular_name'         => $this->singular,
				'menu_name'             => $this->plural,
				'name_admin_bar'        => $this->singular,
				'archives'              => $this->singular . ' Archives',
				'attributes'            => $this->singular . ' Attributes',
				'parent_item_colon'     => 'Parent ' . $this->singular . ':',
				'all_items'             => 'All ' . $this->plural,
				'add_new_item'          => 'Add New ' . $this->singular,
				'add_new'               => 'Add New',
				'new_item'              => 'New ' . $this->singular,
				'edit_item'             => 'Edit ' . $this->singular,
				'update_item'           => 'Update ' . $this->singular,
				'view_item'             => 'View ' . $this->singular,
				'view_items'            => 'View ' . $this->plural,
				'search_items'          => 'Search ' . $this->plural,
				'not_found'             => 'Not found',
				'not_found_in_trash'    => 'Not found in Trash',
				'featured_image'        => 'Featured Image',
				'set_featured_image'    => 'Set featured image',
				'remove_featured_image' => 'Remove featured image',
				'use_featured_image'    => 'Use as featured image',
				'insert_into_item'      => 'Insert into '. $this->singular,
				'uploaded_to_this_item' => 'Uploaded to this ' . $this->singular,
				'items_list'            => $this->plural . ' list',
				'items_list_navigation' => $this->plural . ' list navigation',
				'filter_items_list'     => 'Filter ' . $this->plural . ' list',
			);
			return apply_filters('novelpress_' . $this->post_type . '_post_type_labels', $labels);
		}

		public function get_supports(){
			return apply_filters('novelpress_' . $this->post_type . '_post_type_supports', $this->supports);
		}

		public function get_taxonomies(){
			return apply_filters('novelpress_' . $this->post_type . '_post_type_taxonomies', $this->taxonomies);
		}

		public function get_args(){
			$args = array(
				'label'                 => $this->singular,
				'description'           => $this->description,
				'labels'                => $this->get_labels(),
				'supports'              => $this->get_supports(),
				'taxonomies'            => $this->get_taxonomies(),
				'hierarchical'          => false,
				'public'                => true,
				'show_ui'               => true,
				'show_in_menu'          => true,
				'menu_position'         => 5,
				'show_in_admin_bar'     => true,
				'show_in_nav_menus'     => true,
				'can_export'            => true,
				'has_archive'           => true,
				'exclude_from_search'   => false,
				'publicly_queryable'    => true,
				'capability_type'       => 'page',
			);
			return apply_filters('novelpress_' . $this->post_type . '_post_type_args', $args);
		}

	    function register() {
			register_post_type( $this->post_type, $this->get_args() );
	    }
	}	
}

