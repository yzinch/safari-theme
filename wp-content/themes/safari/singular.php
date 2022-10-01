<?php
/**
 * Singuler temaple.
 *
 * @package WordPress
 * @subpackage Safari_Theme
 */

get_header();
?>
<main>
	<?php
	if ( have_posts() ) :
		the_post();
		the_content();
	endif;
	?>
</main>	

<?php
get_footer();
