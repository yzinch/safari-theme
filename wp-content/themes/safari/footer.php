<?php
 /**
  * Footer template.
  *
  * @package WordPress
  * @subpackage Safari_Theme
  */

?>
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-4 col-lg-6">
					<a class="navbar-brand-white" href="#">
						SAFARI
					</a>
				</div>
				<?php do_action( Core()->get_hooks_ns() . '/menu/footer' ); ?>
				<div class="col-12">
					<a href="#" class="btn btn-alt mobile">Book a tour</a>
				</div>
			</div>
			<div class="row">
				<div class="col-12 bottom">
					<ul class="left">
						<li>© 2022 Tanzania</li>
						<li><a href="#">Terms and conditions</a></li>
						<li><a href="#">Privacy policy</a></li>
					</ul>
					<ul class="right">
						<li><a href="#"><i class="bi-instagram"></i></a></li>		
						<li><a href="#"><i class="bi-facebook"></i></a></li>		
						<li><a href="#"><i class="bi-twitter"></i></a></li>		
						<li><a href="#"><i class="bi-pinterest"></i></a></li>		
					</ul>
				</div>
			</div>
		</div>
	</footer>	
	<?php wp_footer(); ?>
	</body>
</html>
