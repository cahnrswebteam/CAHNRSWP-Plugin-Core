<?php

abstract class Core_Post_Type {
	
	// @var string $slug ID of the post type
	protected $slug;
	
	// @var string $url Slug to use of url rewrite
	protected $url;
	
	// @var string $label Label to use for the post type
	protected $label;
	
	// @var string $label Label to use for the post type
	protected $labels;
	
	// @var string $desc Desctipiton of the post type
	protected $desc;
	
	// @var bool do_save
	protected $do_save = false;
	
	protected $fields = array(
		'_cahnrs_redirect' => array( '', 'text' ),
		);
	
	/**
	 * Get post type slug
	 * @return string post type slug
	 */
	public function get_slug(){ return $this->slug; } 
	
	/**
	 * Get label for post type
	 * @return string post type label
	 */
	public function get_label(){ return $this->label; } 
	
	/**
	 * Get labels for post type
	 * @return array post type labels
	 */
	public function get_labels(){ return $this->labels; } 
	
	/**
	 * Get description for post type
	 * @return string post type description
	 */
	public function get_desc(){ return $this->desc; }
	
	/**
	 * Get label for post type
	 * @return string post type label
	 */
	public function get_url(){ return $this->url; }
	
	/**
	 * Get fields for post type
	 * @return string post type fields
	 */
	public function get_fields(){ return $this->fields; }
	
	
	public function init(){
		
		if ( $this->do_save ){
			
			add_action( 'save_post_' . $this->get_slug() , array( $this , 'save' ) );
			
		} // end if
		
		if ( method_exists( $this , 'the_editor' ) ){
			
			add_action( 'edit_form_after_title' , array( $this , 'the_editor' ) );
			
		} // end if
		
		if ( $this->do_save ){
			
			add_action( 'posts_results', array( $this , 'add_fields' ) );
			
		} // end if
		
		add_action( 'init' , array( $this , 'register' ) );
		
	} // end init
	
	
	public function register(){
		
		$args = array(
			'label'              => $this->get_label(),
			'description'        => $this->get_desc(),
			'public'             => true,
			'rewrite'            => array( 'slug' => $this->get_url() ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail','excerpt' ),
			'taxonomies'         => array( 'post_tag','category' ),
		);
	
		register_post_type( $this->get_slug(), $args );
		
	} // end register
	
	
	public function add_fields( $posts ) {
		
	} // end add_fields
	
	
	/**
	 * Save fields associated with post_type
	 * @param int $post_id ID of current post
	 */
	public function save( $post_id ){
		
		if ( ! $this->check_permissions( $post_id ) ) return false;
		
		$fields = $this->get_fields();
		
		foreach( $fields as $key => $field ){
			
			if ( isset( $_POST[ $key ] ) ){
				
				update_post_meta( $post_id , $key , sanitize_text_field( $_POST[ $key ] ) );
				
			} // end if
			
		} // end foreach
		
	} // end save
	
	/**
	 * Check user permissions
	 * @param int $post_id Post ID
	 * @return bool TRUE if has permissions otherwise FALSE
	 */
	protected function check_permissions( $post_id ){
		
		if ( wp_is_post_revision( $post_id ) ) {
			
			return false;
			
		} // end if
		
		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {

			return false;

		} // end if

		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

			if ( current_user_can( 'edit_page', $post_id ) ) {

				return true;

			} // end if

		} else {

			if ( current_user_can( 'edit_post', $post_id ) ) {

				return true;

			} // end if

		} // end if
		
		return false;
		
	}// end check_permissions
	
} // end Core_Post_Type