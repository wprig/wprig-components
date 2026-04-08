<?php
/**
 * WP_Rig\WP_Rig\Hero_Canvas\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Hero_Canvas;

use WP_Rig\WP_Rig\Component_Interface;
use WP_Rig\WP_Rig\Asset_Provider;
use function add_action;
use function wp_enqueue_script;
use function wp_localize_script;

/**
 * Class for the Hero Canvas component.
 */
class Component implements Component_Interface, Asset_Provider {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug(): string {
		return 'hero-canvas';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'wp_enqueue_scripts', array( $this, 'action_enqueue_assets' ) );
	}

	/**
	 * Gets the asset manifest for the theme component.
	 *
	 * @return array Asset manifest.
	 */
	public function get_asset_manifest(): array {
		return array(
			'scripts' => array(
				'three-js'           => array(
					'file'     => 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js',
					'external' => true,
				),
				'wp-rig-hero-canvas' => array(
					'file'     => 'hero-canvas.min.js',
					'strategy' => 'async',
					'deps'     => array( 'three-js' ),
				),
			),
		);
	}

	/**
	 * Enqueues the component assets.
	 */
	public function action_enqueue_assets() {
		// Assets enqueued by WP Rig based on manifest.
		// We can add logic to only enqueue on specific pages if needed.
		if ( is_front_page() || is_home() ) {
			wp_enqueue_script( 'wp-rig-hero-canvas' );
		}
	}

	/**
	 * Outputs the hero canvas element.
	 *
	 * @param array $args Optional. Arguments for the canvas.
	 * @return void
	 */
	public function render_canvas( array $args = array() ) {
		$defaults = array(
			'opacity' => 0.5,
			'density' => 500,
			'color'   => '#333333',
		);

		$settings = array_merge( $defaults, $args );

		echo sprintf(
			'<canvas id="wprig-hero-canvas" data-hero-opacity="%s" data-hero-density="%s" data-hero-color="%s" style="position: absolute; top: 0; left: 0; pointer-events: none; z-index: 1;"></canvas>',
			esc_attr( $settings['opacity'] ),
			esc_attr( $settings['density'] ),
			esc_attr( $settings['color'] )
		);
	}
}

/**
 * Helper function to output the hero canvas.
 *
 * @param array $args Optional. Arguments for the canvas.
 */
function wprig_hero_canvas( array $args = array() ) {
	$component = new Component();
	$component->render_canvas( $args );
}
