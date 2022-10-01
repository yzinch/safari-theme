<?php
/**
 * Text + Image block ACF fields config.
 *
 * @package WordPress
 * @subpackage Safari_Theme
 */

use \StoutLogic\AcfBuilder\FieldsBuilder;

$text_image = new StoutLogic\AcfBuilder\FieldsBuilder( 'textImage' );
$text_image
	->addImage( 'the_image' )
	->setLocation( 'block', '==', 'yz-safari/text-plus-image' );

acf_add_local_field_group( $text_image->build() );

