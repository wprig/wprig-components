<?php
/**
 * WP_Rig\WP_Rig\TGM_Plugin_Activation\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\TGM_Plugin_Activation;

use WP_Rig\WP_Rig\Component_Interface;
use function add_action;
use function apply_filters;
use function tgmpa;
use function esc_html__;

/**
 * Class for the TGM Plugin Activation component.
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug(): string {
		return 'tgm-plugin-activation';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		/**
		 * Load the TGMPA library.
		 *
		 * We load it here to ensure it's available when we need it, but it only
		 * runs logic when the appropriate hooks are triggered.
		 */
		$library_path = __DIR__ . '/inc/class-tgm-plugin-activation.php';
		if ( file_exists( $library_path ) ) {
			require_once $library_path;
		}

		add_action( 'tgmpa_register', array( $this, 'register_plugins' ) );
	}

	/**
	 * Registers the curated list of plugins.
	 */
	public function register_plugins() {
		/**
		 * Filters the list of plugins for TGMPA.
		 *
		 * @param array $plugins List of plugins.
		 */
		$plugins = apply_filters( 'wprig_tgm_plugins', array() );

		/**
		 * Configuration settings for TGMPA.
		 *
		 * These are sensible defaults for a WP Rig theme.
		 */
		$config = array(
			'id'           => 'wp-rig-tgm',
			'default_path' => '',
			'menu'         => 'tgmpa-install-plugins',
			'has_notices'  => true,
			'dismissable'  => true,
			'dismiss_msg'  => '',
			'is_automatic' => false,
			'message'      => '',
		);

		tgmpa( $plugins, $config );
	}
}
