<?php

if(!trait_exists('NP_Metabox')){
	trait NP_Metabox {
		public $id, $title;
		public $post_type_list = NOVELPRESS_POST_TYPES;
		public $post_types = array();
		public $context = 'normal';
		public $priority = 'low';
		public $params = '';
		public $relations = array();

		public function init(){
			add_action( 'add_meta_boxes', array($this, 'add_box') );
			add_action('save_post', array($this, 'save_post'), 10, 2); // save the custom fields
		}
		
		public function add_box(){
	        add_meta_box(
	            $this->id,           // Unique ID
	            $this->title,  // Box title
	            array($this, 'content'),  // Content callback, must be of type callable
	            $this->post_types, // Post type
	            $this->context,
	            $this->priority,
	            $this->params
	        );
		}		

		public function save_post($post_id, $post){
			if($this->verify($_POST, $post_id)){
				foreach ($_POST['np_meta'] as $key => $value) {
					if(is_array($value)){
						$this->save_meta_array($post_id, $key, $value);
					} else {
						update_post_meta($post_id, apply_filters('novelpress_meta_key', $key), $value);
					}
				}
			}
		}

		public function save_meta_array($post_id, $key, $values){
				foreach ($values as $sub_key => $value) {
					update_post_meta($post_id, apply_filters('novelpress_meta_key', $sub_key), $value);
				}
		}

		public function verify($data, $post_id){
			if(!isset($data['np_meta_nonce']) || 
				!wp_verify_nonce($data['np_meta_nonce'], 'save_np_meta') ||
				!current_user_can( 'edit_post', $post_id )){
					return false;
			}

			return true;		    
		}		

		public function content($post){ ?>
			<form class="novelpress_metabox_form">
				<?php
				wp_nonce_field('save_np_meta', 'np_meta_nonce');
				$this->form();
				if(count($this->relations)){
					$this->relation_meta();
				} ?>
			</form>
		<?php
		}

		public function form(){

		}

		public function relation_meta(){ ?>
			<h3>Relations:</h3>
			<?php
			foreach ($this->relations as $relation => $post_types) { 
				if(method_exists($this, $relation)){
					$this->$relation($post_types);
				}					
			}
		}	

		public function has_many($post_types){ ?>
			<h4>Has many:</h4>
			<?php 
			foreach ($post_types as $post_type) {
				$post_type_label = ucfirst(str_replace('_', ' ', $post_type)); ?>
				<label><?php echo $post_type_label; ?></label>
				<?php		
				$args = array(
					'post_type' => $post_type,
					'posts_per_page' => -1
					);		
				$the_query = new WP_Query( $args ); ?>
				<select multiple class="widefat" name="np_meta[has_many][<?php echo $post_type; ?>][]">
					<option>Select a <?php echo $post_type_label; ?></option>
					<?php
					while ($the_query->have_posts() ) { $the_query->the_post(); ?>
						<option><?php the_title(); ?></option>
					<?php } ?>
				</select>
				<?php
				wp_reset_postdata();							
			}
		}

		public function belongs_to($post_types){ ?>
		<h4>Belongs to:</h4>
			<?php
			foreach ($post_types as $post_type) {
				$post_type_label = ucfirst(str_replace('_', ' ', $post_type)); ?>
				<label><?php echo $post_type_label; ?></label>
				<?php		
				$args = array(
					'post_type' => $post_type,
					'posts_per_page' => -1
					);
				$the_query = new WP_Query( $args ); ?>
				<select class="widefat" name="np_meta[belongs_to][<?php echo $post_type; ?>]">
					<option>Select a <?php echo $post_type_label; ?></option>
					<?php
					while ($the_query->have_posts() ) { $the_query->the_post(); ?>
						<option><?php the_title(); ?></option>
					<?php } ?>
				</select>
				<?php
				wp_reset_postdata();
			}		
		}
	}	
}