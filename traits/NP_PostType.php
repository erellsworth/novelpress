<?php

if(!trait_exists('NP_PostType')){
	trait NP_PostType {

		public $post_type_list = NOVELPRESS_POST_TYPES;
		public $singular, $plural, $post_type, $description;
		public $labels = array();
		public $args = array();
		public $taxonomies = array();
		public $supports = array( 'title', 'editor', 'thumbnail' );

		function get_labels(){
			$default_labels = array(
				'name'                  => $this->plural,
				'singular_name'         => $this->singular,
				'menu_name'             => $this->plural,
				'name_admin_bar'        => $this->singular,
				'archives'              => $this->singular . ' Archives',
				'attributes'            => $this->singular . ' Attributes',
				'parent_item_colon'     => __('Parent', 'novelpress') . ' ' . $this->singular . ':',
				'all_items'             => __('All', 'novelpress') . ' ' . $this->plural,
				'add_new_item'          => __('Add New', 'novelpress') . ' ' . $this->singular,
				'add_new'               => __('Add New', 'novelpress'),
				'new_item'              => __('New', 'novelpress') . ' ' . $this->singular,
				'edit_item'             => __('Edit', 'novelpress') . ' ' . $this->singular,
				'update_item'           => __('Update', 'novelpress') . ' ' . $this->singular,
				'view_item'             => __('View', 'novelpress') . ' ' . $this->singular,
				'view_items'            => __('View', 'novelpress') . ' ' . $this->plural,
				'search_items'          => __('Search', 'novelpress') . ' ' . $this->plural,
				'not_found'             => __('Not found', 'novelpress'),
				'not_found_in_trash'    => __('Not found in Trash', 'novelpress'),
				'featured_image'        => __('Featured Image', 'novelpress'),
				'set_featured_image'    => __('Set featured image', 'novelpress'),
				'remove_featured_image' => __('Remove featured image', 'novelpress'),
				'use_featured_image'    => __('Use as featured image', 'novelpress'),
				'insert_into_item'      => __('Insert into', 'novelpress') . ' ' . $this->singular,
				'uploaded_to_this_item' => __('Uploaded to this', 'novelpress') . ' ' . $this->singular,
				'items_list'            => $this->plural . ' ' . __('list', 'novelpress'),
				'items_list_navigation' => $this->plural . ' ' . __('list navigation', 'novelpress'),
				'filter_items_list'     => __('Filter', 'novelpress') . ' ' . $this->plural . ' ' . __('list', 'novelpress'),
			);
			
			$labels = array_merge($default_labels, $this->labels);

			return apply_filters('novelpress_' . $this->post_type . '_post_type_labels', $labels);
		}

		public function get_supports(){
			return apply_filters('novelpress_' . $this->post_type . '_post_type_supports', $this->supports);
		}

		public function get_taxonomies(){
			return apply_filters('novelpress_' . $this->post_type . '_post_type_taxonomies', $this->taxonomies);
		}

		public function get_args(){
			$default_args = array(
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
				'show_in_rest' => true				
			);
			
			$args = array_merge($default_args, $this->args);

			return apply_filters('novelpress_' . $this->post_type . '_post_type_args', $args);
		}

	    function register() {
			register_post_type( $this->post_type, $this->get_args() );
	    }
	}	
}

