<?php
/**
 * Hadles configuration data from processed JSON files.
 *
 * @package WordPress
 * @subpackage Safari_Theme
 */

namespace Yz\Safari;

/**
 * Implementation class.
 */
class Configurator {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'yz/safari/config/classes', [ $this, 'load_classes' ] );
		add_action( 'yz/safari/config/menus', [ $this, 'setup_menus' ] );
		add_action( 'yz/safari/config/styles', [ $this, 'load_styles' ] );
		add_action( 'yz/safari/config/scripts', [ $this, 'load_scripts' ] );
		add_action( 'yz/safari/config/editor-styles', [ $this, 'add_editor_styles' ] );
		add_action( 'yz/safari/config/editor-scripts', [ $this, 'add_editor_scripts' ] );
	}


	/**
	 * Initialize and load classes into registry.
	 *
	 * @param array $classes Classes config data.
	 * @return void
	 */
	public function load_classes( $classes ) {
		if ( empty( $classes ) || ! is_array( $classes ) ) {
			return;
		}

		foreach ( $classes as $class ) {
			$name = empty( $class['name'] ) ? array_slice( explode( '\\', $class['class'] ), -1 )[0] : $class['name'];
			Core()->put( $name, new $class['class']() );
		}
	}

	/**
	 * Setup nav menus.
	 *
	 * @param array $menu_config Menu configuration array.
	 * @return void
	 */
	public function setup_menus( $menu_config ) {
		add_action(
			'after_setup_theme',
			function() use ( $menu_config ) {
				foreach ( $menu_config as $location => $name ) {
					register_nav_menu( $location, $name );
				}
			}
		);
	}

	/**
	 * Enqueue frontend scripts.
	 *
	 * @param array $scripts_config Scripts configuration data.
	 */
	public function load_scripts( $scripts_config ) {
		$uri_to_js = Core()::$theme_base_uri . '/assets/js/';
		add_action(
			'wp_enqueue_scripts',
			function () use ( $scripts_config, $uri_to_js ) {
				foreach ( $scripts_config as $name => $single_config ) {

					wp_enqueue_script( $name, $uri_to_js . $single_config['filename'], $single_config['dependencies'], $single_config['version'], $single_config['in_footer'] );
				}
			}
		);
	}

	/**
	 * Enqueue frontend styles.
	 *
	 * @param array $styles_config Styles configuration data.
	 */
	public function load_styles( $styles_config ) {
		 $uri_to_css = Core()::$theme_base_uri . '/assets/css/';
		add_action(
			'wp_enqueue_scripts',
			function () use ( $styles_config, $uri_to_css ) {
				foreach ( $styles_config as $name => $single_config ) {
					wp_enqueue_style( $name, $uri_to_css . $single_config['filename'], $single_config['dependencies'], $single_config['version'], $single_config['media'] );
				}
			}
		);
	}

	/**
	 * Enqueue admin styles.
	 *
	 * @param array $styles_config Styles configuration data.
	 */
	public function add_editor_styles( $styles_config ) {
		add_theme_support( 'editor-styles' );
		$uri_to_css = Core()::$theme_base_uri . '/assets/css/';
		add_action(
			'enqueue_block_editor_assets',
			function() use ( $styles_config, $uri_to_css ) {
				foreach ( $styles_config as $name => $single_config ) {
					wp_enqueue_style( $name, $uri_to_css . $single_config['filename'], $single_config['dependencies'], $single_config['version'], $single_config['media'] );
				}
			}
		);

	}

	/**
	 * Enqueue admin scripts.
	 *
	 * @param array $scripts_config Scripts configuration data.
	 */
	public function add_editor_scripts( $scripts_config ) {
		 $uri_to_js = Core()::$theme_base_uri . '/assets/js/';
		add_action(
			'enqueue_block_editor_assets',
			function() use ( $scripts_config, $uri_to_js ) {
				foreach ( $scripts_config as $name => $single_config ) {
					wp_enqueue_script( $name, $uri_to_js . $single_config['filename'], $single_config['dependencies'], $single_config['version'], $single_config['in_footer'] );
				}
			}
		);

	}

}
