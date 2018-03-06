<?php

/**
 * Plugin Name: Gutenberg Blocks
 * Plugin URI: #
 * Description: Awesome customizable blocks for the new WordPress Editor
 * Author: maximebj
 * Author URI: https://dysign.fr
 * Version: 1.0.0
 * License: GPL2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

defined('ABSPATH') or die('Cheatin&#8217; uh?');

use GutenbergBlocks\Initializer;


// Languages
load_plugin_textdomain( 'gutenblocks', false, basename( __DIR__ ) . '/languages' );


// List the registered blocks in WP Admin Gutenberg Blocks settings page
$gutenblocks_registered_blocks = array();

/**
*  Register blocks
*
*  id: (String) block identifier (from JS. Eg: gutenblock/plugin)
*  name: (String) Name of the block
*  icon: (String) Dashicon class
*  svg: (String) SVG image instead of Dashicon
*  category: (String) [Common, API, Woo ... ] category to display block
*  preview_image: (String) Image URL
*	 options_callback: (Function) Callback method to display block settings
*  available: (Boolean) Set to False to tease a not yet available block
*
*/
function gutenberg_blocks_register_blocks($id, $name, $args) {
	global $gutenblocks_registered_blocks;

	$defaults = array(
		'id' => $id,
		'name' => $name,
		'icon' => 'dashicons-slides',
		'svg' => false,
		'category' => 'common',
		'description' => false,
		'preview_image' => false,
		'options_callback' => false,
		'available' => true,
	);

	$args = array_merge($defaults, $args);

	$gutenblocks_registered_blocks[] = $args;
}


// Auto load classes
spl_autoload_register(function($class) {

	$class = str_replace('GutenbergBlocks', '', $class);

	require __DIR__ . '/classes' . str_replace('\\', '/', $class) . '.php';
});


// Launch Plugin
// Plugin Core encapsulation
$gutenblocks = new Initializer();
$gutenblocks->run();
