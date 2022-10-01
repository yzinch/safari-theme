<?php
/**
 * Accordion block ACF fields config.
 *
 * @package WordPress
 * @subpackage Safari_Theme
 */

use \StoutLogic\AcfBuilder\FieldsBuilder;

$facts_grid = new StoutLogic\AcfBuilder\FieldsBuilder( 'AccordionBlock' );
$facts_grid
	->addRepeater(
		'accordion',
		[
			'min' => 1,
			'layout' => 'block',
			'button_label' => 'Add section',
		]
	)
		->addText( 'header', [ 'label' => 'Header text' ] )
		->addWysiwyg( 'content', [ 'label' => 'Content' ] )
	->endRepeater()
	->setLocation( 'block', '==', 'yz-safari/accordion' );


acf_add_local_field_group( $facts_grid->build() );
