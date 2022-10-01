<?php
/**
 * Gutentberg block initialization class.
 *
 * @package WordPress
 * @subpackage Safari_Theme
 */

namespace Yz\Safari;

/**
 * Implementation class.
 */
class Acf_Block {

	/**
	 * Constructor.
	 *
	 * @param string $package_path Path to folder with Block package (with block.json).
	 */
	public function __construct( string $package_path ) {
		if ( ! file_exists( $package_path . '/block.json' ) ) {
			return new WP_Error( 'No block package at path provided' );
		}

		if ( file_exists( $package_path . '/fields.php' ) ) {
			require_once $package_path . '/fields.php';
		}

		register_block_type( $package_path . '/block.json' );
	}
}
