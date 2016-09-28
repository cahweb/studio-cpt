<?php

/*
 *
 * Plugin Name: Common - Studio CPT
 * Description: Wordpress Plugin for Studio Custom Post Type to be used on applicable UCF College of Arts and Humanities websites
 * Author: Austin Tindle + Alessandro Vecchi
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
	      'label' => 'Studios',
	        'public' => true,
	        'show_ui' => true,
	        'capability_type' => 'post',
	        'hierarchical' => false,
	        'rewrite' => array('slug' => 'studio'),
			'menu_icon'  => 'dashicons-format-audio',
	        'query_var' => true,
	        'supports' => array(
	            'title',
	            'excerpt',
	            'thumbnail')
	    );
	register_post_type( 'studio' , $args );
}

add_action("admin_init", "studio_init");
add_action('save_post', 'studio_save');

// Add the meta boxes to our CPT page
function studio_init() {
	add_meta_box("studio-options-meta", "Options", "studio_meta_options", "studio", "normal", "high");
	add_meta_box("studio-description-meta", "Description", "studio_meta_description", "studio", "normal", "low");
	add_meta_box("studio-media-meta", "Media", "studio_meta_media", "studio", "normal", "low");
	add_meta_box("studio-resources-meta", "Resources", "studio_meta_resources", "studio", "normal", "low");
}

// Options
function studio_meta_options() {
	global $post; // Get global WP post var
    $custom = get_post_custom($post->ID); // Set our custom values to an array in the global post var

    // Form markup 
    include_once('views/options.php');
}

// Description
function studio_meta_description() {
	global $post; // Get global WP post var
	global $settings;
    $custom = get_post_custom($post->ID); // Set our custom values to an array in the global post var

    wp_editor($custom['description'][0], 'description', $settings['md']);

}

// Media
function studio_meta_media() {
	global $post; // Get global WP post var
	global $settings;
    $custom = get_post_custom($post->ID); // Set our custom values to an array in the global post var

    wp_editor($custom['media'][0], 'media', $settings['md']);

}

// Resources
function studio_meta_resources() {
	global $post; // Get global WP post var
	global $settings;
    $custom = get_post_custom($post->ID); // Set our custom values to an array in the global post var

    wp_editor($custom['resources'][0], 'resources', $settings['md']);

}

// Save our variables
function studio_save() {
	global $post;

	update_post_meta($post->ID, "twitter", $_POST["twitter"]);
	update_post_meta($post->ID, "instagram", $_POST["instagram"]);
	update_post_meta($post->ID, "type", $_POST["type"]);
	update_post_meta($post->ID, "description", $_POST["description"]);
	update_post_meta($post->ID, "media", $_POST["media"]);
	update_post_meta($post->ID, "resources", $_POST["resources"]);
}

// Settings array. This is so I can retrieve predefined wp_editor() settings to keep the markup clean
$settings = array (
	'sm' => array('textarea_rows' => 3),
	'md' => array('textarea_rows' => 6),
);


?>