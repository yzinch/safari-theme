<?php
/**
 * Slider block ACF fields config.
 *
 * @package WordPress
 * @subpackage Safari_Theme
 */

use \StoutLogic\AcfBuilder\FieldsBuilder;

$list = new FieldsBuilder( 'list_layout' );
$list
	->addRepeater(
		'list',
		[
			'layout' => 'block',
			'button_label' => 'Add Item',
		]
	)
		->addText( 'entry', [ 'label' => 'Entry' ] )
	->endRepeater();


$slider = new FieldsBuilder( 'slider' );
$slider
	->addRepeater(
		'slider',
		[
			'min' => 1,
			'layout' => 'block',
			'button_label' => 'Add slide',
			'collapsed' => 'the_image',
		]
	)
		->addImage( 'the_image', [ 'label' => 'Slide Image' ] )
		->addText( 'header', [ 'label' => 'Slide Header' ] )
		->addFlexibleContent(
			'content',
			[
				'label' => 'Slide Content',
				'button_label' => 'Add Content',
			]
		)
			->addLayout(
				'list',
				[
					'label' => 'List',
					'display' => 'block',
				]
			)
				->addRepeater(
					'list',
					[
						'layout' => 'block',
						'button_label' => 'Add Item',
					]
				)
					->addText( 'entry', [ 'label' => 'Entry' ] )
				->endRepeater()
			->addLayout(
				'text',
				[
					'label' => 'Text Content',
					'display' => 'block',
				]
			)
				->addTextArea(
					'text',
					[
						'label' => 'Text content',
						'new_lines' => 'br',
					]
				)
			->addLayout(
				'button',
				[
					'label' => 'Button',
					'display' => 'table',
				]
			)
				->addText( 'text', [ 'label' => 'Text' ] )
				->addText( 'link', [ 'label' => 'URL' ] )
		->endFlexibleContent()
	->endRepeater()
	->setLocation( 'block', '==', 'yz-safari/slider' );

acf_add_local_field_group( $slider->build() );
