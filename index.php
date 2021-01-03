<?php
/*
Plugin Name: Comment Block
Plugin URI: https://www.damiencarbery.com
Description: A comment block that is only shown when editing content. It is not displayed on front end.
Version: 0.1
Author: Damien Carbery
*/


defined( 'ABSPATH' ) || exit;


// Register block js and editor css.
function dcwd_register_comment_block() {

	if ( ! function_exists( 'register_block_type' ) ) {
		// Gutenberg is not active.
		return;
	}

    // Load the block JS.
	wp_register_script(
		'dcwd-comment-block',
		plugins_url( 'block.js', __FILE__ ),
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'block.js' )
	);

    // Load the CSS for the block when in the editor.
	wp_register_style(
		'dcwd-comment-block-editor',
		plugins_url( 'editor.css', __FILE__ ),
		array( 'wp-edit-blocks' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'editor.css' )
	);

	register_block_type( 'dcwd-blocks/comment', array(
		'editor_style' => 'dcwd-comment-block-editor',
		'editor_script' => 'dcwd-comment-block',
        'render_callback' => 'dcwd_render_comment_block',
	) );

}
add_action( 'init', 'dcwd_register_comment_block' );


// Do not render this block on the front end - return empty string.
function dcwd_render_comment_block( $attributes ) {
    return '';
}