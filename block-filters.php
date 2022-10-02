<?php
/**
 * Plugin Name: Block Filters
 * Description: Plugin to add custom options and functionality to blocks
 * Author: Top Draw 
 * Version: 0.1.0
 * @package     BlockFilters
 */

namespace BlockFilters;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
};

function frontend_assets() {

	wp_enqueue_style(
		'block-filters-frontend-style',
		plugin_dir_url( __FILE__ ) . 'assets/frontend.css',
		[],
		'0.1.0'
	);
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\frontend_assets' );

function editor_assets() {
	wp_enqueue_script(
		'block-filters-editor-script',
		plugin_dir_url( __FILE__ ) . 'build/index.js',
		[ 'wp-blocks', 'blockfilters', 'wp-element', 'wp-editor', 'wp-edit-post' ],
		'0.1.0'
	);

	wp_enqueue_style(
		'block-filters-editor-style',
		plugin_dir_url( __FILE__ ) . 'assets/editor.css',
		[],
		'0.1.0'
	);
}
add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\editor_assets' );