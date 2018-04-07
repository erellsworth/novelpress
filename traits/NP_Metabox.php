<?php

if(!trait_exists('NP_Metabox')){
	trait NP_Metabox {
		public $id, $title, $post;
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
						$this->save_meta_array($post->ID, $key, $value);
					} else {
						$this->save_meta_single($post->ID, $key, $value);
					}
				}
			}
		}

		public function save_meta_single($post_id, $key, $value){	
				update_post_meta($post_id, apply_filters('novelpress_meta_key', $key), $value);				
		}

		public function save_meta_array($post_id, $key, $values){
			
			$this->updated_connected_posts($post_id, $values);
			
			foreach ($values as $sub_key => $value) {
				$this->save_meta_single($post_id, $sub_key, $value);
			}
		}

		public function updated_connected_posts($post_id, $values){
			//these methods update related posts with the current post id
			foreach ($values as $post_type => $connected_post) {
				$inverse_relation = $_POST['np_connections'][$post_type]['inverse_relation'];
				$inverse_class = $_POST['np_connections'][$post_type]['inverse_class'];

				if(is_array($connected_post)){
					$this->updated_connected_post_array($connected_post, $inverse_relation, $inverse_class, $post_id);
				} else {
					$this->updated_connected_post_single($connected_post, $inverse_relation, $inverse_class, $post_id);					
				}
			}
		}

		public function updated_connected_post_array($connected_posts, $inverse_relation, $inverse_class, $post_id){
			foreach ($connected_posts as $connected_post_id) {
				$this->updated_connected_post_single($connected_post_id, $inverse_relation, $inverse_class, $post_id);
			}
		}		

		public function updated_connected_post_single($connected_post_id, $inverse_relation, $inverse_class, $post_id){
			$connected_post_meta = $post_id;
			if($inverse_relation === 'has_many'){
				$connected_post_meta = get_post_meta($connected_post_id, apply_filters('novelpress_meta_key', $inverse_class), true);
				if(!$connected_post_meta){ $connected_post_meta = array();}
				if(!in_array($post_id, $connected_post_meta)){
					$connected_post_meta[] = $post_id;
				}
			} 
			$this->save_meta_single($connected_post_id, $inverse_class, $connected_post_meta);				
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
				$this->post = $post;
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
			foreach ($this->relations as $relation_type => $relations) { 
				if(method_exists($this, $relation_type)){
					$this->$relation_type($relations);
				}					
			}
		}	

		public function has_many($relations){ ?>
			<h4>Has many:</h4>
			<?php 
			foreach ($relations as $relation) {
				$post_class = new $relation['post_class']();
				$selected_types = get_post_meta($this->post->ID, apply_filters('novelpress_meta_key', $relation['post_class']), true); ?>
				
				<label><?php echo $post_class->plural; ?></label>
				<?php		
				$args = array(
					'post_type' => $post_class->post_type,
					'posts_per_page' => -1
					);		
				$the_query = new WP_Query( $args ); ?>
				<select multiple class="widefat" name="np_meta[has_many][<?php echo $relation['post_class']; ?>][]">
					<option>None</option>
					<?php
					while ($the_query->have_posts() ) { $the_query->the_post();
						$selected = false;
						if($selected_types && in_array(get_the_id(), $selected_types)){
							$selected = true;
						}
					 ?>
						<option <?php if($selected){echo 'selected="selected"';} ?> value="<?php the_ID(); ?>"><?php the_title(); ?></option>
					<?php } ?>
				</select>
				<input type="hidden" name="np_connections[<?php echo $relation['post_class']; ?>][inverse_relation]" value="<?php echo $relation['inverse']; ?>" />
				<input type="hidden" name="np_connections[<?php echo $relation['post_class']; ?>][inverse_class]" value="<?php echo $this->post_class; ?>" />				
				<?php
				wp_reset_postdata();							
			}
		}

		public function belongs_to($relations){ ?>
		<h4>Belongs to:</h4>
			<?php
			foreach ($relations as $relation) {
				$post_class = new $relation['post_class']();
				$selected_type = get_post_meta($this->post->ID, apply_filters('novelpress_meta_key', $relation['post_class']), true); ?>
				<label><?php echo $post_class->plural; ?></label>
				<?php		
				$args = array(
					'post_type' => $post_class->post_type,
					'posts_per_page' => -1
					);
				$the_query = new WP_Query( $args ); ?>
				<select class="widefat" name="np_meta[belongs_to][<?php echo $relation['post_class']; ?>]">
					<option>Select a <?php echo $post_class->plural; ?></option>
					<?php
					while ($the_query->have_posts() ) { $the_query->the_post(); ?>
						<option <?php selected(get_the_id(),$selected_type); ?> value="<?php the_ID(); ?>"><?php the_title(); ?></option>
					<?php } ?>
				</select>
				<input type="hidden" name="np_connections[<?php echo $relation['post_class']; ?>][inverse_relation]" value="<?php echo $relation['inverse']; ?>" />
				<input type="hidden" name="np_connections[<?php echo $relation['post_class']; ?>][inverse_class]" value="<?php echo $this->post_class; ?>" />
				<?php
				wp_reset_postdata();
			}		
		}
	}	
}