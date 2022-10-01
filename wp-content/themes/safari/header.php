<?php
/**
 * Header template.
 *
 * @package WordPress
 * @subpackage Safari_Theme
 */

?>
<hmtl>
	<head>
		<meta http-equiv="Content-Type" content="text/html" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<meta name="language" content="en-US" />
		<meta name="encoding" content="utf-8" />
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<header>
			<nav class="navbar bg-light fixed-top">
				<div class="container">
					<a class="navbar-brand" href="#">
						SAFARI
					</a>
					<?php do_action( Core()->get_hooks_ns() . '/menu/main', 'desktop' ); ?>
					<div class="spacer">&nbsp;</div>
					<div class="spacer">&nbsp;</div>
					<div class="spacer">&nbsp;</div>
					<a class="btn" href="#">Book a tour</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
						<div class="offcanvas-header">
							<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
						</div>
						<div class="offcanvas-body">
							<?php do_action( Core()->get_hooks_ns() . '/menu/main', 'mobile' ); ?>
							<a class="btn" href="#">Book a tour</a>
						</div>
					</div>
				</div>
			</nav>
		</header>
