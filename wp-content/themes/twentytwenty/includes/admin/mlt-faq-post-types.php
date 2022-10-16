<?php
/**
 * Register Post type functionality
 *
 * @package mlt
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to register post type
 * 
 * @package mlt
 * @since 1.0.0
 */
function mlt_faq_register_post_type() {
  	// FAQ Post type
	$mlt_faq_labels = array(
		'name'                 	=> __('FAQs', 'mlt'),
		'menu_name'            	=> __('FAQs', 'mlt'),
		'all_items' 			=> __('All', 'mlt'),
		'singular_name'        	=> __('FAQ', 'mlt'),
		'add_new'              	=> __('Add New', 'mlt'),
		'add_new_item'         	=> __('Add New', 'mlt'),
		'edit_item'            	=> __('Edit FAQ', 'mlt'),
		'new_item'             	=> __('New FAQ', 'mlt'),
		'view_item'            	=> __('View FAQ', 'mlt'),
		'search_items'         	=> __('Search FAQ', 'mlt'),
		'not_found'            	=>  __('No FAQ Items found', 'mlt'),
		'not_found_in_trash'   	=> __('No FAQ Items found in Trash', 'mlt'),
		'parent_item_colon'    	=> '',
		'featured_image'		=> __('FAQ Image', 'mlt'),
		'set_featured_image'	=> __('Set FAQ Image', 'mlt'),
		'remove_featured_image'	=> __('Remove blog image', 'mlt'),
		'use_featured_image'	=> __('Use as blog image', 'mlt'),
	);

	$mlt_faq_args = array(
		'labels'              => $mlt_faq_labels,
		'public'              => false,
		'publicly_queryable'  => false,
		'exclude_from_search' => true,
		'show_ui'             => true,
		'show_in_rest'        => true,
		'show_in_menu'        => true, 
		'query_var'           => false,
		'capability_type'     	=> 'post',
		'has_archive'         	=> false,
		'hierarchical'        	=> false,
		'menu_position'       	=> 8,
		'menu_icon'   			=> 'dashicons-editor-ol',
		'supports'            	=> apply_filters('mlt_faq_blog_post_supports', array('title', 'publicize')),
		
	);
	
	// Register blog post type
	register_post_type( MLT_FAQ_POST_TYPE, apply_filters('mlt_faq_register_post_type_blog', $mlt_faq_args) );
}

// Action to register plugin post type
add_action('init', 'mlt_faq_register_post_type');



/**
 * Function to update post message for blog post type
 * 
 * @package mlt
 * @since 2.0.2
 */
function mlt_faq_post_updated_messages( $messages ) {
	global $post, $post_ID;
	$messages[MLT_FAQ_POST_TYPE] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'FAQ updated. <a href="%s">View FAQ</a>', 'mlt' ), esc_url( get_permalink( $post_ID ) ) ),
		2 => __( 'Custom field updated.', 'mlt' ),
		3 => __( 'Custom field deleted.', 'mlt' ),
		4 => __( 'FAQ updated.', 'mlt' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'FAQ restored to revision from %s', 'mlt' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'FAQ published. <a href="%s">View FAQ</a>', 'mlt' ), esc_url( get_permalink( $post_ID ) ) ),
		7 => __( 'FAQ saved.', 'mlt' ),
		8 => sprintf( __( 'FAQ submitted. <a target="_blank" href="%s">Preview FAQ</a>', 'mlt' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
		9 => sprintf( __( 'FAQ scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview FAQ</a>', 'mlt' ),
		  date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
		10 => sprintf( __( 'FAQ draft updated. <a target="_blank" href="%s">Preview FAQ</a>', 'mlt' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
	);
	return $messages;
}
// Filter to update blog post message
add_filter( 'post_updated_messages', 'mlt_faq_post_updated_messages' );