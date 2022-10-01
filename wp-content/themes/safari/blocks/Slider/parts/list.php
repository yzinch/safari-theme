<?php
/**
 * Template partial: List.
 *
 * @package WordPress
 * @subpackage Safari_Theme
 */

if ( have_rows( 'list' ) ) :
	?>
	<div class="subsection">
		<ul>
			<?php
			while ( have_rows( 'list' ) ) :
				the_row();
				?>
				<li><i class="bi bi-check-circle"></i> <?php the_sub_field( 'entry' ); ?></li>
				<?php
			endwhile;
			?>
		</ul>
		<?php the_sub_field( 'text' ); ?>
	</div>
	<?php
endif;
