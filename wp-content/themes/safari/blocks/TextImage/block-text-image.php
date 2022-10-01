<?php
/**
 * Text + Image block template.
 *
 * @package WordPress
 * @subpackage Safari_Theme
 */

$allowed_blocks = array( 'core/heading', 'core/paragraph', 'yz-safari/facts-grid' );
$template = array(
	[
		'core/heading',
		[
			'level' => 6,
			'content' => '1 day safari Serengeti national park',
		],
	],
	[
		'core/heading',
		[
			'level' => 2,
			'content' => '1 day safari Serengeti national park',
		],
	],
	[
		'yz-safari/facts-grid',
		[
			'data' => [
				'field_factsgrid_facts' => [
					'row-0' => [
						'field_factsgrid_facts_upper_text_1' => '200',
						'field_factsgrid_facts_lower_text_1' => 'facts',
						'field_factsgrid_facts_upper_text_2' => '300',
						'field_factsgrid_facts_lower_text_2' => 'idiots',
					],
					'row-1' => [
						'field_factsgrid_facts_upper_text_1' => '200',
						'field_factsgrid_facts_lower_text_1' => 'facts',
						'field_factsgrid_facts_upper_text_2' => '300',
						'field_factsgrid_facts_lower_text_2' => 'idiots',
					],
				],
			],
		],
	],
);
?>
<section class="block acf-block block-yz-safari-text-image">
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-6">
				<?php
				$image = get_field( 'the_image' );
				if ( ! empty( $image ) ) :
					echo wp_get_attachment_image( $image['id'], 'full' );
				else :
					?>
					<img src="https://placehold.co/600x600?text=Image+here" alt="Placeholder image">
					<?php
				endif;
				?>
			</div>
			<div class="col-12 col-sm-6 d-flex align-items-center">
				<InnerBlocks allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowed_blocks ) ); ?>" template="<?php echo esc_attr( wp_json_encode( $template ) ); ?>" templateLock="insert" />
			</div>
	</div>
</section>
