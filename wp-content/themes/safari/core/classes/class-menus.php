<?php
/**
 * Menu related functions class.
 *
 * @package WordPress
 * @subpackage Safari_Theme
 */

namespace Yz\Safari;

/**
 * Implementation class.
 */
class Menus {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( Core()->get_hooks_ns() . '/menu/main', [ $this, 'render_main_menu' ] );
		add_action( Core()->get_hooks_ns() . '/menu/footer', [ $this, 'render_footer_menu' ] );
	}

	/**
	 * Renders the top (main) menu.
	 *
	 * @param string $context Wether mobile or desktop menu is being rendered.
	 */
	public function render_main_menu( $context = 'dekstop' ) {
		wp_nav_menu(
			[
				'theme_location' => 'primary',
				'container' => false,
				'menu_class' => 'menu ' . $context,
			]
		);
	}

	/**
	 * Renders the footer menu.
	 */
	public function render_footer_menu() {

		wp_nav_menu(
			[
				'theme_location' => 'bottom',
				'container' => false,
				'items_wrap' => '<div class="col-6 col-md-4 col-lg-3">%3$s</div>',
				'walker' => new \Yz\Safari\Menu\Footer_Menu_Walker(),

			]
		);

	}
}
