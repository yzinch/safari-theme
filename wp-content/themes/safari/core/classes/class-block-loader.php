<?php
/**
 * Load Gutentberg block packages.
 *
 * @package WordPress
 * @subpackage Safari_Theme
 */

namespace Yz\Safari;

/**
 * Load Gutentberg block packages.
 * Scans for block packages (folders with block.json) in <theme_root>/blocks foler.
 * Loads and initializes those block. Adds some supplementary functions.
 */
class Block_Loader {

	/**
	 * Constructor.
	 */
	public function __construct() {
		 add_theme_support( 'align-wide' );
		add_action( 'acf/init', [ $this, 'load' ] );
		add_filter( 'render_block', [ $this, 'wrap_the_block' ], 10, 2 );
		add_filter( 'render_block_data', [ $this, 'block_data_pre_render' ], 10, 2 );
	}

	/**
	 * Scan for packages and load them. Uses Acf_Block class.
	 */
	public function load() {
		foreach ( glob( get_stylesheet_directory() . '/blocks/*', GLOB_ONLYDIR ) as $package ) {
			new Acf_Block( $package );
		}
	}

	/**
	 * Wrap block which does not provided by this theme with corresponding container markup.
	 * Only applies on top level blocks.
	 *
	 * @param string $block_content Content of the block.
	 * @param array  $block         Parsed Gutentberg block.
	 * @return string
	 */
	public function wrap_the_block( $block_content, $block ) {
		if ( substr( $block['blockName'], 0, strlen( 'yz-safari/' ) ) !== 'yz-safari/' && 0 === $block['attrs']['hasParent'] ) {
			$section_class = str_replace( '/', '-', $block['blockName'] );
			$block_content = '<div class="container">' . $block_content . '</div>';
			$block_content = '<section class="block ' . esc_attr( $section_class ) . '">' . $block_content . '</section>';
		}
		return $block_content;
	}

	/**
	 * Recursively process block data and set 'hasChild' and 'hasParent' flags
	 * to descript block hierarchy. Needed for wrapping top-level blocks.
	 *
	 * @param array $parsed_block Parsed block data.
	 * @param array $source_block Source block.
	 * @return array
	 */
	public function block_data_pre_render( $parsed_block, $source_block ) {
		$parsed_block['attrs']['hasChild'] = 0;
		if ( ! empty( $parsed_block['innerBlocks'] ) ) {
			$parsed_block['attrs']['hasChild'] = 1;
			array_walk( $parsed_block['innerBlocks'], [ $this, 'inner_block_looper' ] );
		}

		if ( empty( $parsed_block['attrs']['hasParent'] ) ) {
			$parsed_block['attrs']['hasParent'] = 0;
		}

		return $parsed_block;
	}

	/**
	 * Loop over children block data.
	 *
	 * @param mixed $item Block data chunk.
	 * @param mixed $key  Name of the chunk.
	 * @return void
	 */
	protected function inner_block_looper( &$item, $key ) {
		if ( 'attrs' === $key ) {
			$item['hasParent'] = 1;
		}
		if ( is_array( $item ) ) {
			array_walk( $item, [ $this, 'inner_block_looper' ] );
		}
	}
}
