<?php
/**
 * Theme functions file.
 *
 * @package Wordpress
 * @subpackage SafariTheme
 */

define( 'THEME_DIR', get_stylesheet_directory() );

require_once __DIR__ . '/core/vendor/autoload.php';
require_once __DIR__ . '/core/classes/class-core.php';

/**
 * Returns instance of theme's main class.
 *
 * @return \Yz\Multipods\Core
 */
function Core() { //phpcs:ignore
	return \Yz\Safari\Core::instance();
}
Core();

new \Yz\Safari\Configurator();
Core()->configure( THEME_DIR . '/core/config.classes.json' );
Core()->configure( THEME_DIR . '/core/config.theme.json' );
