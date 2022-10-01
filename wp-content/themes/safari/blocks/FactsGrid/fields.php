<?php
/**
 * Facts grid block ACF fields config.
 *
 * @package WordPress
 * @subpackage Safari_Theme
 */

use \StoutLogic\AcfBuilder\FieldsBuilder;

$facts_grid = new StoutLogic\AcfBuilder\FieldsBuilder( 'FactsGrid' );
$facts_grid
	->addRepeater(
		'facts',
		[
			'min' => 1,
			'layout' => 'table',
		]
	)
		->addText( 'upper_text_1', [ 'label' => 'Left upper text' ] )
		->addText( 'lower_text_1', [ 'label' => 'Left lower text' ] )
		->addText( 'upper_text_2', [ 'label' => 'Right upper text' ] )
		->addText( 'lower_text_2', [ 'label' => 'Right lower text' ] )
	->endRepeater()
	->setLocation( 'block', '==', 'yz-safari/facts-grid' );


acf_add_local_field_group( $facts_grid->build() );
