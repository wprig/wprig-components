<?php
/**
 * WP_Rig\WP_Rig\Kinetic_Typography\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Kinetic_Typography;

use WP_Rig\WP_Rig\Component_Interface;
use WP_Rig\WP_Rig\Asset_Provider;
use function add_action;
use function wp_enqueue_script;
use function wp_enqueue_style;

/**
 * Class for the Kinetic Typography component.
 */
class Component implements Component_Interface, Asset_Provider {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug(): string {
		return 'kinetic-typography';
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
				'wp-rig-kinetic-typography' => array(
					'file'     => 'kinetic-type.min.js',
					'strategy' => 'async',
				),
			),
			'styles'  => array(
				'wp-rig-kinetic-typography' => array(
					'file' => 'kinetic-type.min.css',
				),
			),
		);
	}

	/**
	 * Enqueues the component assets.
	 */
	public function action_enqueue_assets() {
		// Assets enqueued by WP Rig based on manifest.
	}

	/**
	 * Outputs text wrapped in kinetic animation logic.
	 *
	 * @param string $text The text to animate.
	 * @param string $type The animation type.
	 * @param array  $args Additional arguments.
	 * @return string The formatted HTML.
	 */
	public function get_kinetic_text( string $text, string $type = 'reveal', array $args = array() ): string {
		wp_enqueue_script( 'wp-rig-kinetic-typography' );
		wp_enqueue_style( 'wp-rig-kinetic-typography' );

		$defaults = array(
			'duration' => 1000,
			'stagger'  => 0.05,
			'tag'      => 'span',
			'class'    => '',
		);

		$settings = array_merge( $defaults, $args );

		// Split text into characters
		// Note: Simplified for the registry. Real-world might need better UTF-8 handling.
		$chars = preg_split( '//u', $text, -1, PREG_SPLIT_NO_EMPTY );
		$output = sprintf(
			'<%1$s class="wprig-kinetic-text %2$s" data-wprig-kinetic="%3$s" data-kinetic-duration="%4$s" data-kinetic-stagger="%5$s">',
			\esc_attr( $settings['tag'] ),
			\esc_attr( $settings['class'] ),
			\esc_attr( $type ),
			\esc_attr( $settings['duration'] ),
			\esc_attr( $settings['stagger'] )
		);

		foreach ( $chars as $index => $char ) {
			if ( ' ' === $char ) {
				$output .= ' ';
			} else {
				$output .= sprintf(
					'<span class="char" style="--char-index: %d;">%s</span>',
					$index,
					\esc_html( $char )
				);
			}
		}

		$output .= sprintf( '</%s>', \esc_attr( $settings['tag'] ) );

		return $output;
	}
}

/**
 * Helper function to output kinetic text.
 *
 * @param string $text The text to animate.
 * @param string $type The animation type.
 * @param array  $args Additional arguments.
 */
function wprig_kinetic_text( string $text, string $type = 'reveal', array $args = array() ) {
	$component = new Component();
	echo $component->get_kinetic_text( $text, $type, $args );
}
