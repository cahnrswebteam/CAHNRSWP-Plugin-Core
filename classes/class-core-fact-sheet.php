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
		);
		
	
	public function the_editor( $post ){
		
		$html = '<fieldset id="core-fact-sheet">';
		
			$html .= '<div>';
			
				$html .= '<div class="core-field text-input">';
				
					$html .= '<label>Fact Sheet #</label>';
					
					$html .= '<input type="text" name="_fs_number" value="" />';
				
				$html .= '</div>';
			
			$html .= '</div>';
			
			$html .= '<h4>Authors</h4>';
			
			$index = 0;
			
			if ( isset( $post->fs_authors ) && is_array( $post->fs_authors ) ){
				
				foreach( $post->fs_authors as $i => $author ){
					
					$html .= $this->get_author_form( $i , $author );
					
					$index = $i;
					
				} // 
				
				$index++;
				
			} // end if
			
			$html .= $this->get_author_form( $index , $author );
		
		$html .= '</fieldset>';
		
		echo $html;
		
	} // end editor
	
	public function get_author_form( $index , $author ){
		
		$html .= '<div>';
			
			$html .= '<div class="core-field text-input core-field-25">';
			
				$html .= '<label>Author Name</label>';
				
				$html .= '<input type="text" name="_fs_author[' . $index . '][name]" value="" />';
			
			$html .= '</div>';
			
			$html .= '<div class="core-field text-input core-field-24">';
			
				$html .= '<label>Email</label>';
				
				$html .= '<input type="text" name="_fs_author[' . $index . '][email]" value="" />';
			
			$html .= '</div>';
			
			$html .= '<div class="core-field text-input core-field-50">';
			
				$html .= '<label>Title</label>';
				
				$html .= '<input type="text" name="_fs_author[' . $index . '][title]" value="" />';
			
			$html .= '</div>';
		
		$html .= '</div>';
		
		return $html;
		
	} // end get_author_form;
	
}