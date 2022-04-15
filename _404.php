<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package BuddyBoss_Theme
 */
get_header('404');

?>
<div id="content" class="site-content page-404" style="background-image: url(/wp-content/themes/child-buddyboss-theme/images/bg-404.jpg);">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found text-center">
				<p>there is nothing to see here</p>
				<h1 class="page-title">oops</h1>
				<div class="page-content">
					<a class="button" href="/">GO BACK</a>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->
</div>
<?php
get_footer('404');
