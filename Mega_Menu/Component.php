<?php
/**
 * WP_Rig\WP_Rig\Mega_Menu\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Mega_Menu;

use WP_Rig\WP_Rig\Component_Interface;
use WP_Rig\WP_Rig\Asset_Provider;
use Walker_Nav_Menu;
use function add_filter;
use function add_action;
use function wp_enqueue_style;

/**
 * Class for the Mega Menu Builder component.
 */
class Component implements Component_Interface, Asset_Provider {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug(): string {
		return 'mega-menu';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_filter( 'wp_nav_menu_args', array( $this, 'filter_nav_menu_args' ) );
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
				'wp-rig-mega-menu' => array(
					'file'     => 'mega-menu.min.js',
					'strategy' => 'async',
				),
			),
			'styles'  => array(
				'wp-rig-mega-menu' => array(
					'file' => 'mega-menu.min.css',
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
	 * Filters the nav menu args to use the mega menu walker.
	 *
	 * @param array $args Nav menu args.
	 * @return array Modified nav menu args.
	 */
	public function filter_nav_menu_args( array $args ): array {
		// Use the mega menu walker for the primary menu location.
		if ( isset( $args['theme_location'] ) && 'primary' === $args['theme_location'] ) {
			$args['walker'] = new Mega_Menu_Walker();
		}
		return $args;
	}
}

/**
 * Custom walker for the mega menu.
 */
class Mega_Menu_Walker extends Walker_Nav_Menu {

	/**
	 * Starts the list before the elements are added.
	 *
	 * @param string $output Used to append additional content (passed by reference).
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of wp_nav_menu() arguments.
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$indent = str_repeat( "\t", $depth );
		$classes = array( 'sub-menu' );

		// Check if we're in a mega menu
		if ( 0 === $depth ) {
			$classes[] = 'mega-menu-content';
		}

		$output .= "\n$indent<ul class=\"" . esc_attr( implode( ' ', $classes ) ) . "\">\n";
	}

	/**
	 * Starts the element output.
	 *
	 * @param string $output Used to append additional content (passed by reference).
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of wp_nav_menu() arguments.
	 * @param int    $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		// Add column class if in a mega menu
		if ( 1 === $depth ) {
			$classes[] = 'mega-menu-column';
		}

		$args = (object) $args;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names . '>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
