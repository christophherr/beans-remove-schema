<?php
/**
 * Beans Remove Schema
 *
 * @package     ChristophHerr\BeansRemoveSchema
 * @author      christophherr
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Beans Remove Schema
 * Plugin URI: https://github.com/christophherr/beans-remove-schema
 * Description: Remove the built-in Schema.org markup from Beans.
 * Version: 1.0.0
 * Author: Christoph Herr
 * Author URI: https://www.christophherr.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: christophherr/beans-simple-hook-guide
 * Text Domain: beans-remove-schema
 * Requires PHP: 5.6
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

namespace ChristophHerr\BeansRemoveSchema;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Nothing to see here.' );
}

register_activation_hook( __FILE__, __NAMESPACE__ . '\maybe_activate_plugin' );
/**
 * This function runs on plugin activation. It checks to make sure the
 * Beans Framework is active. If not, it deactivates the plugin.
 *
 * @since 1.0.0
 *
 * @return void
 */
function maybe_activate_plugin() {

	if ( ! function_exists( '\beans_define_constants' ) ) {
		// Deactivate.
		deactivate_plugins( plugin_basename( __FILE__ ) );
		add_action( 'admin_notices', __NAMESPACE__ . '\admin_notice_message' );
	}
}

add_action( 'admin_init', __NAMESPACE__ . '\maybe_deactivate_plugin' );
add_action( 'switch_theme', __NAMESPACE__ . '\maybe_deactivate_plugin' );
/**
 * This function is triggered when the WordPress theme is changed.
 * It checks if the Beans Framework is active. If not, it deactivates the plugin.
 *
 * @since 1.0.0
 *
 * @return void
 */
function maybe_deactivate_plugin() {

	if ( ! function_exists( '\beans_define_constants' ) ) {
		// Deactivate.
		deactivate_plugins( plugin_basename( __FILE__ ) );
		add_action( 'admin_notices', __NAMESPACE__ . '\admin_notice_message' );
	}
}

/**
 * Error message if you're not using the Beans Framework.
 *
 * @since 1.0.0
 *
 * @return void
 */
function admin_notice_message() {
	// phpcs:disable WordPress.XSS.EscapeOutput -- Need to build the link.
	$error = sprintf(
		// translators: Link to the Beans website.
		__( 'Sorry, you can\'t use the Beans Remove Schema Plugin unless the <a href="%s">Beans Framework</a> is active. The plugin has been deactivated.', 'beans-remove-schema' ),
		'https://getbeans.io'
	);

	printf( '<div class="error"><p>%s</p></div>', $error );
	// phpcs:enable

	if ( isset( $_GET['activate'] ) ) { // phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification -- Internal usage
		unset( $_GET['activate'] );
	}
}

/**
 * Get the plugin's absolute directory path.
 *
 * @since  1.0.0
 * @ignore
 * @access private
 *
 * @return string
 */
function _get_plugin_directory() {
	return __DIR__;
}

/**
 * Launch the plugin
 *
 * @since 1.0.0
 *
 * @return void
 */
function launch() {

	if ( ! function_exists( '\beans_define_constants' ) ) {
		return;
	}

	if ( is_admin() ) {
		return;
	}

	require __DIR__ . '/src/remove-attributes.php';

	remove_schema();
}

add_action( 'plugins_loaded', __NAMESPACE__ . '\setup' );
/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 *
 * @return void
 */
function setup() {
	load_plugin_textdomain( 'beans-remove-schema', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );

	add_action( 'init', __NAMESPACE__ . '\launch' );
}

