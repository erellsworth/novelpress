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

		public function content($post){ ?>
			<form class="novelpress_metabox_form">
				<?php
				$this->form();
				if(count($this->relations)){
					$this->relation_meta();
				} ?>
			</form>
		<?php
		}

		public function form(){

		}

		public function relation_meta(){?>
			<h3>Relations:</h3>
			<?php
			foreach ($this->relations as $relation => $post_types) { 
				$this->relation_form($relation, $post_types);
			}
		}

		public function relation_form($relation, $post_types){ ?>
			<h4><?php echo ucfirst(str_replace('_', ' ', $relation)); ?></h4>
			<?php
			foreach ($post_types as $post_type) { ?>
				<label><?php echo $post_type; ?></label>
			<?php
				$this->post_selector($relation, $post_type);
			}
		}	

		public function post_selector($relation, $post_type){
			$args = array(
				'post_type' => $post_type,
				'posts_per_page' => -1
				);
			$the_query = new WP_Query( $args ); ?>
			<select class="widefat" name="np_meta[<?php echo $relation; ?>][<?php echo $post_type; ?>]">
				<option>Select a <?php echo $post_type; ?></option>
				<?php
				while ( $the_query->have_posts() ) { $the_query->the_post(); ?>
					<option><?php the_title(); ?></option>
				<?php } ?>
			</select>
			<?php
			wp_reset_postdata();			
		}	

	}	
}

