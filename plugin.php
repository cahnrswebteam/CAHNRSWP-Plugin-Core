<?php
/*
Plugin Name: CAHNRS Core 2.0
Plugin URI: http://cahnrs.wsu.edu/communications
Description: Core plugins and features for CAHNRS
Author: cahnrscommunications, Danial Bleile
Author URI: http://cahnrs.wsu.edu/communications
Version: 0.0.1
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
		
		} // end if
		
		require_once 'classes/class-core-fact-sheet.php';
		
		$fact_sheet = new Core_Fact_Sheet();
		
		$fact_sheet->init();
		
	} // end init
	

} // end CAHNRSWP_Plugin_Core

$core = CAHNRSWP_Plugin_Core::get_instance();