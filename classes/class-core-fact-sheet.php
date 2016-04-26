<?php

require_once 'class-core-post-type.php';

class Core_Fact_Sheet extends Core_Post_Type{
	
	// @var string $slug ID of the post type
	protected $slug = 'fact_sheet';
	
	// @var string $url Slug to use of url rewrite
	protected $url = 'fact-sheet';
	
	// @var string $label Label to use for the post type
	protected $label = 'Fact Sheets';
	
	// @var string $label Label to use for the post type
	protected $labels;
	
	// @var string $desc Desctipiton of the post type
	protected $desc = 'Web Fact Sheets';
	
	// @var bool do_save
	protected $do_save = true;
	
	protected $fields = array(
		'_fs_number' => array('', 'text'),
		'_fs_authors' => array( array() , 'array' ),
		);
		
	
	public function the_editor( $post ){
		
		$settings = $this->get_settings( $post->ID );
		
		$html = '<fieldset id="core-fact-sheet">';
		
			$html .= '<div>';
			
				$html .= '<div class="core-field text-input core-field-25">';
				
					$html .= '<label>Fact Sheet #</label>';
					
					$html .= '<input type="text" name="_fs_number" value="' . $settings['_fs_number'] . '" />';
				
				$html .= '</div>';
			
			$html .= '</div>';
			
			$html .= '<h4>Authors</h4>';
			
			$index = 0;
			
			if ( is_array( $settings['_fs_authors'] ) ){
				
				foreach( $settings['_fs_authors'] as $i => $author ){
					
					if ( $author['name'] ){
					
						$html .= $this->get_author_form( $i , $author );
					
						$index = $i;
					
					} // end if
					
				} // 
				
				$index++;
				
			} // end if
			
			$html .= $this->get_author_form();
		
		$html .= '</fieldset>';
		
		echo $html;
		
	} // end editor
	
	public function get_author_form( $index = false , $author = false ){
		
		if ( $index === false ){
			
			$index = 0;
			
		} // end if
		
		if ( ! $author ){
			
			$author = array( 'name' => '', 'email' => '', 'title' => '' );
			
		} // end if
		
		$html .= '<div>';
			
			$html .= '<div class="core-field text-input core-field-25">';
			
				$html .= '<label>Author Name</label>';
				
				$html .= '<input type="text" name="_fs_authors[' . $index . '][name]" value="' . $author['name'] .'" />';
			
			$html .= '</div>';
			
			$html .= '<div class="core-field text-input core-field-25">';
			
				$html .= '<label>Email</label>';
				
				$html .= '<input type="text" name="_fs_authors[' . $index . '][email]" value="' . $author['email'] .'" />';
			
			$html .= '</div>';
			
			$html .= '<div class="core-field text-input core-field-50">';
			
				$html .= '<label>Title</label>';
				
				$html .= '<input type="text" name="_fs_authors[' . $index . '][title]" value="' . $author['title'] .'" />';
			
			$html .= '</div>';
		
		$html .= '</div>';
		
		return $html;
		
	} // end get_author_form;
	
}