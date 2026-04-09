<?php
/**
 * WP_Rig\WP_Rig\Animate_on_Scroll\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Animate_on_Scroll;

use WP_Rig\WP_Rig\Component_Interface;
use WP_Rig\WP_Rig\Asset_Provider;
use function add_filter;
use function add_action;
use function wp_enqueue_script;
use function wp_enqueue_style;

/**
 * Class for the Animate on Scroll (AOS) component.
 */
class Component implements Component_Interface, Asset_Provider {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug(): string {
		return 'animate-on-scroll';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_filter( 'render_block', array( $this, 'filter_render_block_aos' ), 10, 2 );
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
				'wp-rig-animation' => array(
					'file'     => 'animation.min.js', // This will be the compiled JS.
					'strategy' => 'async',
				),
			),
			'styles'  => array(
				'wp-rig-animation' => array(
					'file' => 'animation.css', // This will be the compiled CSS.
				),
			),
		);
	}

	/**
	 * Enqueues the component assets.
	 */
	public function action_enqueue_assets() {
		wp_enqueue_script( 'wp-rig-animation' );
		wp_enqueue_style( 'wp-rig-animation' );
	}

	/**
	 * Filters the block content to add AOS data attributes.
	 *
	 * @param string $block_content The block content.
	 * @param array  $block         The full block, including name and attributes.
	 * @return string Modified block content.
	 */
	public function filter_render_block_aos( string $block_content, array $block ): string {
		$target_blocks = array(
			'core/group',
			'core/image',
			'core/heading',
			'core/media-text',
		);

		if ( in_array( $block['blockName'], $target_blocks, true ) ) {
			// Check if already has AOS attribute to avoid double injection.
			if ( false === strpos( $block_content, 'data-wprig-aos' ) ) {
				// Simple injection: find the first tag and add the attribute.
				// This is a "hardcoded approach" for the registry demonstration.
				$block_content = preg_replace(
					'/(<[a-z0-9]+)/i',
					'$1 data-wprig-aos="fade-up"',
					$block_content,
					1
				);
			}
		}

		return $block_content;
	}
}
