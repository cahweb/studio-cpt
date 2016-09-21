<?php

/*
 *
 * Plugin Name: Common - Studio CPT
 * Description: Wordpress Plugin for Studio Custom Post Type to be used on applicable UCF College of Arts and Humanities websites
 * Author: Austin Tindle
 *
 */

/* Custom Post Type ------------------- */

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Load our CSS
function studio_load_plugin_css() {
    wp_enqueue_style( 'studio-plugin-style', plugin_dir_url(__FILE__) . 'css/style.css');
}
add_action( 'admin_enqueue_scripts', 'studio_load_plugin_css' );

// Add create function to init
add_action('init', 'studio_create_type');

// Create the custom post type and register it
function studio_create_type() {
	$args = array(
	      'label' => 'studio',
	        'public' => true,
	        'show_ui' => true,
	        'capability_type' => 'post',
	        'hierarchical' => false,
	        'rewrite' => array('slug' => 'studio'),
			'menu_icon'  => 'dashicons-groups',
	        'query_var' => true,
	        'supports' => array(
	            'title',
	            'thumbnail')
	    );
	register_post_type( 'studio' , $args );
}

add_action("admin_init", "studio_init");
add_action('save_post', 'studio_save');

// Add the meta boxes to our CPT page
function studio_init() {
	add_meta_box("studio-required-meta", "Required Information", "studio_meta_required", "studio", "normal", "high");
}

// Meta box functions
function studio_meta_required() {
	global $post; // Get global WP post var
    $custom = get_post_custom($post->ID); // Set our custom values to an array in the global post var

    // Form markup 
    include_once('views/required.php');
}

// Save our variables
function studio_save() {
	global $post;

	update_post_meta($post->ID, "studio", $_POST["studio"]);
}

// Settings array. This is so I can retrieve predefined wp_editor() settings to keep the markup clean
$settings = array (
	'sm' => array('textarea_rows' => 3),
	'md' => array('textarea_rows' => 6),
);


?>