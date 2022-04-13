<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package BuddyBoss_Theme
 */

get_header();
// get rosim
$post = get_post();
$rosim_id = $post->user_id;
if ($rosim_id == '') {
	$rosim_id = 16631;
}
$userdata = get_userdata($rosim_id);
?>
<?php
$share_box = buddyboss_theme_get_option('blog_share_box');
?>

<div id="primary" class="content-area single-post">
	<main id="main" class="site-main">

		<?php
		if (have_posts()) :

			do_action(THEME_HOOK_PREFIX . '_template_parts_content_top');


			while (have_posts()) :
				the_post();
				$id_post = get_the_ID();

				if (has_post_thumbnail()) {
					$foto = get_the_post_thumbnail_url();
				} else {
					$foto = '/wp-content/uploads/2022/01/default_avatar_male.jpg';
				}

				//do_action( THEME_HOOK_PREFIX . '_single_template_part_content', get_post_type() );
		?>
				<article id="post-<?php the_ID(); ?>" class="post-<?php the_ID(); ?> post type-post status-publish format-standard has-post-thumbnail hentry category-uncategorized full-fi-invert">

					<div class="entry-content-wrap" id="et-boc">

						<?php the_content(); ?>
						<?php //comments_template(); ?>
				</article>
		<?php endwhile; // End of the loop.

		endif;
		?>
		<?php wp_reset_postdata(); ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>

<?php
get_footer();
