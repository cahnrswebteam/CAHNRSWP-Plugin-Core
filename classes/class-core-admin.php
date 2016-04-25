<?php
class Core_Admin {
	
	
	public function the_options(){
		
		add_action('admin_menu', array( $this , 'add_options_page' ), 10 );
		
	} // end the_options
	
	
	public function add_options_page(){
		
		if ( ! empty( $_POST['is_update'] ) ) {
			
			$this->update_options();
			
		} // end if
		
		add_submenu_page( 'options-general.php', 'CAHNRS Core Settings','CAHNRS Core', 'manage_options', 'cahnrscore', array( $this, 'the_options_page' ) );
		
	} // end add_options_page
	
	
	public function the_options_page(){
	}
	
	
	public function update_options(){
	} // end update_options
	
}