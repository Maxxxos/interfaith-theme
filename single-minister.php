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
						<div class="section-main et-l">
							<div class="item-text">
								<img src="<?php echo $foto; ?>" alt="<?php the_title(); ?>">
								<h1><?php the_title(); ?></h1>
								<?php $short_bio = $userdata->short_bio; ?>
								<div class="content"><?php echo $short_bio  ?? ''; ?></div>
							</div>
							<div class="item-btn et_pb_module">
								<a class="main-btn" href="mailto:<?php echo $userdata->user_email ?? ''; ?>">Contact me</a>
							</div>
						</div>
						<div class="section-table">
							<table>
								<tr>
									<td>Location:</td>
									<?php if (!empty($userdata->data->address)) {
										$address = $userdata->data->address;
									} else {
										$address = 'N/A';
									} ?>
									<td><?php echo $address; ?></td>
								</tr>
								<tr>
									<?php $serving = $userdata->serving; ?>
									<td>Also serving:</td>
									<td><?php echo $serving ?? 'N/A'; ?></td>
								</tr>
								<tr>
									<?php $qualifications = $userdata->qualifications; ?>
									<td>Qualifications:</td>
									<td><?php echo $qualifications ?? 'N/A'; ?></td>
								</tr>
								<tr>
									<?php $available = $userdata->available; ?>
									<td>Available for:</td>
									<td><?php echo $available  ?? 'N/A'; ?></td>
								</tr>
								<tr>
									<?php $online_services = $userdata->online_services; ?>
									<td>Online Services:</td>
									<td><?php echo $online_services ?? 'N/A'; ?></td>
								</tr>
								<tr>
									<?php $online_services = $userdata->online_services; ?>
									<td>Ordained in:</td>
									<td><?php echo $online_services ?? 'N/A'; ?></td>
								</tr>
							</table>
						</div>
						<?php comments_template(); ?>
						<?php
						$attachment_id = get_post_meta($id_post, 'minister_gallery');
						if (!empty($attachment_id)) :
						?>
							<div class="ministery-section">
								<div class="ministery-wrap">
									<div class="ministery-row owl-carousel owl-theme" id="post-slider">

										<?php for ($i = 0; $i < count($attachment_id); $i++) :
											if (!empty($attachment_id[$i])) { ?>
												<div class="ministery__item item">
													<?php
													$img_url = wp_get_attachment_image_url($attachment_id[$i], [326, 250]);
													?>
													<img src="<?php echo  $img_url; ?>" alt="foto gallery <?php echo $i; ?>" class="ministry-gallery-img">
												</div>
											<?php } ?>
										<?php endfor; ?>
									</div>
								</div>
							</div>
							<!-- конец цикла -->

						<?php endif; ?>
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
