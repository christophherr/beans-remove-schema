<?php
/**
 * Beans remove Schema attributes functionality
 *
 * @package     ChristophHerr\BeansRemoveSchema
 * @author      christophherr
 * @license     GPL-2.0+
 */

namespace ChristophHerr\BeansRemoveSchema;

/**
 * Remove Schema markup.
 *
 * @since 1.0.0
 *
 * @return void
 */
function remove_schema() {
	$remove_attributes = require _get_plugin_directory() . '/config/remove-attributes-config.php';

	remove_itemprop_from_menu_items( 'primary' );

	foreach ( $remove_attributes as $hook => $value ) {
		if ( ! is_array( $value ) ) {
			beans_remove_attribute( $hook, $value );
		} else {
			foreach ( $value as $item ) {
				beans_remove_attribute( $hook, $item );
			}
		}
	}
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
