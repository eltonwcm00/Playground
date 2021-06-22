<?php
/**
 * Plugin Name: LiveChat
 * Plugin URI: https://www.livechat.com/marketplace/apps/wordpress/
 * Description: Live chat software for live help, online sales and customer support. This plugin allows to quickly install LiveChat on any WordPress website.
 * Version: 4.4.6
 * Author: LiveChat
 * Author URI: https://www.livechat.com
 * Text Domain: wp-live-chat-software-for-wordpress
 * Domain Path: /languages
 *
 * Copyright: © 2020 LiveChat.
 * License: GNU General Public License v3.0
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 */

if ( class_exists( 'LiveChat\LiveChat' ) ) {
	return;
}

require_once dirname( __FILE__ ) . '/vendor/autoload.php';
require_once dirname( __FILE__ ) . '/config.php';

/**
 * Checks if WooCommerce plugin is active.
 *
 * @return bool
 */
function is_woo_plugin_active() {
	return in_array( 'woocommerce/woocommerce.php', get_option( 'active_plugins', array() ), true );
}

/**
 * Detects platform based on active plugins.
 *
 * @return string
 * @throws Exception
 */
function get_detected_platform() {
	require_once dirname( __FILE__ ) . '/plugin_files/Services/PlatformProvider.class.php';
	return \LiveChat\Services\PlatformProvider::create()->get();
}

define( 'PLATFORM', get_detected_platform() );

/**
 * Returns current platform.
 *
 * @return bool
 */
function get_platform() {
	// phpcs:ignore WordPress.WP.CapitalPDangit.Misspelled
	return defined( 'PLATFORM' ) ? PLATFORM : 'wordpress';
}

/**
 * Checks if WooCommerce is current platform.
 *
 * @return bool
 */
function is_woo() {
	return 'woocommerce' === get_platform();
}

if ( is_admin() ) {
	require_once dirname( __FILE__ ) . '/plugin_files/LiveChatAdmin.class.php';
	\LiveChat\LiveChatAdmin::get_instance();

	register_uninstall_hook( __FILE__, 'LiveChat\LiveChatAdmin::uninstall_hook_handler' );
} else {
	require_once dirname( __FILE__ ) . '/plugin_files/LiveChat.class.php';
	\LiveChat\LiveChat::get_instance();
}
