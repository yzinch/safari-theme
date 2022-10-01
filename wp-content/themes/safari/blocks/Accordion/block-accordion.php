<?php
/**
 * Accordion block template.
 *
 * @package WordPress
 * @subpackage Safari_Theme
 */

$allowed_blocks = [ 'core/heading', 'core/paragraph', 'yz-safari/facts-grid' ];
$template = [
	[
		'core/heading',
		[
			'level' => 6,
			'content' => 'Interesting information',
		],
	],
	[
		'core/heading',
		[
			'level' => 2,
			'content' => 'Tips for the best experience of Tanzania',
		],
	],
];
$accordion_id = uniqid();
?>
<section class="block acf-block block-yz-safari-accordion">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-5">
				<InnerBlocks allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowed_blocks ) ); ?>" template="<?php echo esc_attr( wp_json_encode( $template ) ); ?>" templateLock="insert" />
			</div>
			<div class="col-12 col-md-7">
				<div class="accordion accordion-flush" id="accordion-<?php echo $accordion_id; ?>">
					<?php
					if ( have_rows( 'accordion' ) ) :
						$row = 1;
						while ( have_rows( 'accordion' ) ) :
							the_row();
							?>
							<div class="accordion-item">
								<h2 class="accordion-header" id="flush-heading-<?php echo $row; ?>">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-<?php echo $row; ?>" aria-expanded="false" aria-controls="flush-collapse-<?php echo $row; ?>">
										<?php the_sub_field( 'header' ); ?>
									</button>
								</h2>
								<div id="flush-collapse-<?php echo $row; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading-<?php echo $row; ?>" data-bs-parent="#accordion-<?php echo $accordion_id; ?>">
									<div class="accordion-body">
										<?php the_sub_field( 'content' ); ?>
									</div>
								</div>
							</div>
							<?php
							$row++;
						endwhile;
					else :
						?>
						<h4>Empty. Add data...</h4>
						<?php
					endif;
					?>
				</div>
			</div>
		</div>
	</div>
</section>
