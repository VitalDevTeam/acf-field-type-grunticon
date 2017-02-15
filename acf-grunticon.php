<?php

/*
Plugin Name: Advanced Custom Fields: Grunticon
Plugin URI: http://vtldesign.com
Description: Select a Grunticon
Version: 1.0.0
Author: Vital Design
Author URI: http://vtldesign.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;


// check if class already exists
if( !class_exists('acf_plugin_grunticon') ) :

class acf_plugin_grunticon {

	/*
	*  __construct
	*
	*  This function will setup the class functionality
	*
	*  @type	function
	*  @date	17/02/2016
	*  @since	1.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/

	function __construct() {

		// vars
		$this->settings = array(
			'version'	=> '1.0.0',
			'url'		=> plugin_dir_url( __FILE__ ),
			'path'		=> plugin_dir_path( __FILE__ )
		);


		// set text domain
		// https://codex.wordpress.org/Function_Reference/load_plugin_textdomain
		load_plugin_textdomain( 'acf-grunticon', false, plugin_basename( dirname( __FILE__ ) ) . '/lang' );


		// include field
		add_action('acf/include_field_types', 	array($this, 'include_field_types')); // v5
		add_action('admin_enqueue_scripts', array($this, 'vital_enqueue_admin_scripts'));

	}

	function vital_enqueue_admin_scripts(){
	    //Grunticon
	    wp_enqueue_script(
	        'admin_grunticon',
	        get_template_directory_uri() . '/assets/scripts/libraries/grunticon.js',
	        false,
	        filemtime(get_template_directory() . '/assets/scripts/libraries/grunticon.js'),
	        true
	    );

	    $site_info = array(
	        'homeUrl'        => get_home_url(),
	        'themeDirectory' => get_template_directory_uri(),
	        'grunticonPath'  => get_template_directory_uri() . '/assets/grunticon/dist/'
	    );
	    wp_localize_script('admin_grunticon', 'SiteInfo', $site_info);
	}


	/*
	*  include_field_types
	*
	*  This function will include the field type class
	*
	*  @type	function
	*  @date	17/02/2016
	*  @since	1.0.0
	*
	*  @param	$version (int) major ACF version. Defaults to false
	*  @return	n/a
	*/

	function include_field_types( $version = false ) {

		// support empty $version
		if( !$version ) $version = 4;

		if($version != 5){
			return;
		}


		// include
		include_once('fields/acf-grunticon-v5.php');

	}

}


// initialize
new acf_plugin_grunticon();


// class_exists check
endif;

?>