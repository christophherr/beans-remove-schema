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
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
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

/**
 * Remove Schema markup.
 *
 * @since 1.0.0
 *
 * @return void
 */
function remove_schema() {
	beans_remove_attribute( 'beans_header', 'itemscope' );
	beans_remove_attribute( 'beans_header', 'itemtype' );
	beans_remove_attribute( 'beans_body', 'itemscope' );
	beans_remove_attribute( 'beans_body', 'itemtype' );
	beans_remove_attribute( 'beans_site_title_link', 'itemprop' );
	beans_remove_attribute( 'beans_site_title_tag', 'itemprop' );
	beans_remove_attribute( 'beans_primary_menu', 'itemscope' );
	beans_remove_attribute( 'beans_primary_menu', 'itemtype' );
	remove_itemprop_from_menu_items( 'primary' );
	beans_remove_attribute( 'beans_content', 'itemprop' );
	beans_remove_attribute( 'beans_content', 'itemscope' );
	beans_remove_attribute( 'beans_content', 'itemtype' );
	beans_remove_attribute( 'beans_sidebar_primary', 'itemscope' );
	beans_remove_attribute( 'beans_sidebar_primary', 'itemtype' );
	beans_remove_attribute( 'beans_sidebar_secondary', 'itemscope' );
	beans_remove_attribute( 'beans_sidebar_secondary', 'itemtype' );
	beans_remove_attribute( 'beans_post', 'itemscope' );
	beans_remove_attribute( 'beans_post', 'itemtype' );
	beans_remove_attribute( 'beans_post', 'itemprop' );
	beans_remove_attribute( 'beans_post_title', 'itemprop' );
	beans_remove_attribute( 'beans_post_body', 'itemprop' );
	beans_remove_attribute( 'beans_post_image_item', 'itemprop' );
	beans_remove_attribute( 'beans_post_content', 'itemprop' );
	beans_remove_attribute( 'beans_post_meta_date', 'itemprop' );
	beans_remove_attribute( 'beans_post_meta_author', 'itemprop' );
	beans_remove_attribute( 'beans_post_meta_author', 'itemscope' );
	beans_remove_attribute( 'beans_post_meta_author', 'itemtype' );
	beans_remove_attribute( 'beans_post_meta_author_name_meta', 'itemprop' );
	beans_remove_attribute( 'beans_comment', 'itemprop' );
	beans_remove_attribute( 'beans_comment', 'itemscope' );
	beans_remove_attribute( 'beans_comment', 'itemtype' );
	beans_remove_attribute( 'beans_comment_title', 'itemprop' );
	beans_remove_attribute( 'beans_comment_title', 'itemscope' );
	beans_remove_attribute( 'beans_comment_title', 'itemtype' );
	beans_remove_attribute( 'beans_comment_time', 'itemprop' );
	beans_remove_attribute( 'beans_comment_body', 'itemprop' );
	beans_remove_attribute( 'beans_footer', 'itemscope' );
	beans_remove_attribute( 'beans_footer', 'itemtype' );
}

/**
 * Remove itemprop from menu items.
 *
 * @since 1.0.0
 *
 * @param string $menu_location Menu location.
 * @return void
 */
function remove_itemprop_from_menu_items( $menu_location ) {
	$locations = get_nav_menu_locations();

	if ( $locations && isset( $locations[ $menu_location ] ) ) {
		$menu_object = wp_get_nav_menu_object( $locations[ $menu_location ] );
		$menu_items  = wp_get_nav_menu_items( $menu_object->term_id );

		foreach ( $menu_items as $menu_item ) {
			$menu_id = $menu_item->ID;
			beans_remove_attribute( 'beans_menu_item[_' . $menu_id . ']', 'itemprop' );
			beans_remove_attribute( 'beans_menu_item_link[_' . $menu_id . ']', 'itemprop' );
		}
	}
}
