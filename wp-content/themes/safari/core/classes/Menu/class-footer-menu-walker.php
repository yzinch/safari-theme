<?php
/**
 * Custom walker class for site footer.
 *
 * @package WordPress
 * @subpackage Safari_Theme
 */

namespace Yz\Safari\Menu;

/**
 * Custom walker class for site footer.
 * Overrides:
 * - displays first level menu items as headig
 * - each top level item starts new ul list within grid column
 * - outputs only 2 first top level items. The rest is ignored.
 */
class Footer_Menu_Walker extends \Walker_Nav_Menu {


	/**
	 * Nesting level counter.
	 *
	 * @var integer
	 */
	private $count = 1;

	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker_Nav_Menu::start_lvl()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {
		if ( $depth > 1 || $this->count > 2 ) {
			return;
		}

		if ( 0 === $depth ) {
			$classes = array( 'footer-menu', 'footer-menu-' . $this->count );
			/** This filter is documented in wp-includes/class-walker-nav-menu.php */
			$class_names = implode( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
			$output .= "<ul$class_names>";
			return;
		}

		parent::start_lvl( $output, $depth, $args );
	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker_Nav_Menu::end_lvl()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function end_lvl( &$output, $depth = 0, $args = null ) {
		if ( $depth > 1 || $this->count > 2 ) {
			return;
		}

		if ( 0 === $depth ) {
			$output .= '</ul>';
			if ( 2 == $this->count ) {
				$output .= '<a class="btn btn-alt" href="#">Book a tour</a>';
			}
			if ( 1 == $this->count ) {
				$output .= '</div>';
				$output .= '<div class="col-6 col-md-4 col-lg-3" style="position:relative;">';
			}
			$this->count++;
			return;
		}

		parent::end_lvl( $output, $depth, $args );
	}

	/**
	 * Starts the element output.
	 *
	 * @see Walker_Nav_Menu::start_el()
	 *
	 * @param string   $output            Used to append additional content (passed by reference).
	 * @param WP_Post  $data_object       Menu item data object.
	 * @param int      $depth             Depth of menu item. Used for padding.
	 * @param stdClass $args              An object of wp_nav_menu() arguments.
	 * @param int      $current_object_id Optional. ID of the current menu item. Default 0.
	 */
	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
		if ( $depth > 1 || $this->count > 2 ) {
			return;
		}

		if ( 0 === $depth ) {
			/** This filter is documented in wp-includes/post-template.php */
			$title = apply_filters( 'the_title', $data_object->title, $menu_item->ID );

			/** This filter is documented in wp-includes/class-walker-nav-menu.php */
			$title = apply_filters( 'nav_menu_item_title', $title, $data_object, $args, $depth );

			$output .= '<h6>' . $title . '</h6>';
			return;
		}
		parent::start_el( $output, $data_object, $depth, $args, $current_object_id );
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @see Walker_Nav_Menu::end_el()
	 *
	 * @param string   $output      Used to append additional content (passed by reference).
	 * @param WP_Post  $data_object Menu item data object. Not used.
	 * @param int      $depth       Depth of page. Not Used.
	 * @param stdClass $args        An object of wp_nav_menu() arguments.
	 */
	public function end_el( &$output, $data_object, $depth = 0, $args = null ) {
		if ( $depth > 1 || $this->count > 2 ) {
			return;
		}

		if ( 0 === $depth ) {
			return;
		}

		parent::end_el( $output, $data_object, $depth, $args );
	}
}
