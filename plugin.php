<?php
/*
Plugin Name: CAHNRS Core 2.0
Plugin URI: http://cahnrs.wsu.edu/communications
Description: Core plugins and features for CAHNRS
Author: cahnrscommunications, Danial Bleile
Author URI: http://cahnrs.wsu.edu/communications
Version: 1.0.0
*/

class CAHNRSWP_Plugin_Core {
	
	/** @var object $instance Current instance */
	private static $instance;


	public static function get_instance(){
		
		if ( null == self::$instance ){
			
			self::$instance = new self;
			
			self::$instance->init();
			
		} // end if
		
		return self::$instance;
		
	} // end get_instance
	
	
	/**
	 * Set properties and call methods at initialization of the class
	 */
	private function init(){
		
		if ( is_admin() ) {
		
			require_once 'classes/class-core-admin.php';
			
			$admin = new Core_Admin();
			
			$admin->the_options();
			
			add_action( 'admin_enqueue_scripts', array( $this , 'admin_scripts' ) );
		
		} else {
			
			//add_action( 'wp_enqueue_scripts', array( $this , 'admin_scripts' ) );
			
		}// end if
		
		require_once 'classes/class-core-web-publication.php';
		
		$fact_sheet = new Core_Web_Publication();
		
		$fact_sheet->init();
		
	} // end init
	
	
	public function admin_scripts(){
		
		wp_enqueue_style( 'core_admin_css' , plugin_dir_url( __FILE__ ) . 'css/admin.css', array(), '0.0.1' );
		
	} // end admin_scripts
	
	public function public_scripts(){
	} // end admin_scripts
	

} // end CAHNRSWP_Plugin_Core

$core = CAHNRSWP_Plugin_Core::get_instance();