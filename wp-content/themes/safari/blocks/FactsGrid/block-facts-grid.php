<?php
/**
 * Facts block template.
 *
 * @package WordPress
 * @subpackage Safari_Theme
 */

?>
<section class="block acf-block block-yz-safari-facts-grid">
	<?php
	if ( have_rows( 'facts' ) ) :
		while ( have_rows( 'facts' ) ) :
			the_row();
			?>
			<div class="row">
				<div class="col-6 fact">
					<?php the_sub_field( 'upper_text_1' ); ?>
					<span><?php the_sub_field( 'lower_text_1' ); ?></span>
				</div>
				<div class="col-6 fact">
					<?php the_sub_field( 'upper_text_2' ); ?>
					<span><?php the_sub_field( 'lower_text_2' ); ?></span>
				</div>
			</div>
			<?php
		endwhile;
	else :
		?>
		<h3>Empty. Add rows...</h3>
		<?php
	endif;
	?>
</section>

