<?php
/**
 * Slider block template.
 *
 * @package WordPress
 * @subpackage Safari_Theme
 */

$swiper_id = uniqid();
?>
<section class="block acf-block block-yz-safari-slider">
	<?php
	if ( have_rows( 'slider' ) ) :
		?>
		<style>
			.swiper-pagination-progressbar::after {
				content: "<?php echo sprintf( '%02d', count( get_field( 'slider' ) ) ); ?>";
			}
			.swiper-pagination-progressbar::before {
				content: "01";
			}
		</style>
		<!-- Swiper -->
		<div class="swiper swp-<?php echo $swiper_id; ?>">
			<div class="swiper-wrapper">
				<?php
				while ( have_rows( 'slider' ) ) :
					the_row();
					?>
					<div class="swiper-slide" style="background-image: url(<?php echo wp_get_attachment_image_url( get_sub_field( 'the_image' )['id'], 'full' ); ?>);">	
						<?php echo wp_get_attachment_image( get_sub_field( 'the_image' )['id'], 'full' ); ?>
						<div class="content-wrapper">
							<div class="content">
								<h2><?php the_sub_field( 'header' ); ?></h2>
								<?php
								if ( have_rows( 'content' ) ) :
									while ( have_rows( 'content' ) ) :
										the_row( 'content' );
										if ( file_exists( __DIR__ . '/parts/' . get_row_layout() . '.php' ) ) :
											include __DIR__ . '/parts/' . get_row_layout() . '.php';
										endif;
									endwhile;
								endif;
								?>
							</div>
						</div>
					</div>
					<?php
				endwhile;
				?>
			</div>
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
			<div class="swiper-pagination"></div>
		</div>
		<?php
	else :
		?>
		<!-- Swiper -->
		<div class="swiper swp-<?php echo $swiper_id; ?> empty">
			<div class="swiper-wrapper">
				<div class="swiper-slide">Slide 1</div>
				<div class="swiper-slide">Slide 2</div>
				<div class="swiper-slide">Slide 3</div>
				<div class="swiper-slide">Slide 4</div>
				<div class="swiper-slide">Slide 5</div>
				<div class="swiper-slide">Slide 6</div>
				<div class="swiper-slide">Slide 7</div>
			</div>
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
			<div class="swiper-pagination"></div>
		</div>
		<?php
	endif;
	?>
	<script>
		window.addEventListener('load', function () {
			var swiper = new Swiper(".swp-<?php echo $swiper_id; ?>", {
				loop: true,
				pagination: {
					el: ".swiper-pagination",
					type: "progressbar",
				},
				navigation: {
					nextEl: ".swiper-button-next",
					prevEl: ".swiper-button-prev",
				},
			});
		}, false);
		var swiper = new Swiper(".swp-<?php echo $swiper_id; ?>", {
			loop: true,
			pagination: {
				el: ".swiper-pagination",
				type: "progressbar",
			},
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},
		});
	</script>
</section>
