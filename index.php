<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BuddyBoss_Theme
 */

get_header();

$blog_type = 'masonry'; // standard, grid, masonry.
$blog_type = apply_filters('bb_blog_type', $blog_type);

$class = '';

if ('masonry' === $blog_type) {
	$class = 'bb-masonry';
} elseif ('grid' === $blog_type) {
	$class = 'bb-grid';
} else {
	$class = 'bb-standard';
}
?>

<div id="primary" class="content-area blog-page">
	<main id="main" class="site-main ">

		<?php if (have_posts()) : ?>

			<?php do_action(THEME_HOOK_PREFIX . '_template_parts_content_top'); ?>

			<div class="post-grid <?php echo esc_attr($class); ?>">
				<?php
				// main post
				$args = [
					'post_type' => 'post',
					'post_status' => 'publish',
					'order' => 'DESC',
					'posts_per_page' => 1,
					'cat' => [-32, -33],
					'tag__not_in' => [56, 57, 58, 59]
				];
				$query = new WP_Query($args); ?>

				<?php if ($query->have_posts()) : ?>
					<div class="blog-main-block">
						<div class="blog-wrap-1">
							<?php while ($query->have_posts()) : $query->the_post(); ?>
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<span class="main-post-date"><?php echo get_the_date('j.m.Y'); ?></span>
								<?php
								if (has_post_thumbnail()) {
									$img_url = get_the_post_thumbnail_url();
								} else {
									$img_url = '/wp-content/uploads/2021/09/images.png';
								}
								?>
								<!-- <a href="<?php // the_permalink();	
												?>"> -->
								<div class="main-post-img" style="background-image: url(<?php echo $img_url; ?>);"></div>
								<!-- </a> -->
								<div class="main-post-content">
									<?php
									echo strip_shortcodes(truncate_post(440, false, '', true));
									?>
								</div>
								<a href="<?php the_permalink(); ?>" class="main-post-link">Read more</a>
							<?php endwhile; ?>
						</div>

						<?php wp_reset_postdata(); ?>
					<?php else : ?>
						<p><?php esc_html_e('No posts.'); ?></p>
					<?php endif; ?>
					<?php
					// main post
					$args = [
						'post_type' => 'post',
						'post_status' => 'publish',
						'order' => 'ASC',
						//'offset' => 1,
						'posts_per_page' => 4,
						//'cat' => [-32, -33],
					];
					$query = new WP_Query($args); ?>
					<?php if ($query->have_posts()) : ?>
						<div class="blog-wrap-2">
							<?php while ($query->have_posts()) : $query->the_post(); ?>
								<div class="blog__item">
									<?php
									if (has_post_thumbnail()) {
										$img_url = get_the_post_thumbnail_url();
									} else {
										$img_url = '/wp-content/uploads/2021/09/images.png';
									}
									?>
									<div class="blog__item-img"><a href="<?php the_permalink(); ?>"><img src="<?php echo $img_url; ?>" alt="<?php the_title(); ?>" class="blog-sitebar-img"></a></div>
									<div class="blog__item-text">
										<div>
											<a href="<?php the_permalink(); ?>">
												<h4><?php the_title(); ?></h4>
											</a>
											<span class="blog__item-text-date"><?php echo get_the_date('j.m.Y'); ?></span>
										</div>
										<a href="<?php the_permalink(); ?>" class="main-post-link">Read more</a>
									</div>
								</div>
							<?php endwhile; ?>
						</div>
						<?php wp_reset_postdata(); ?>
					<?php else : ?>
						<p><?php esc_html_e('No posts.'); ?></p>
					<?php endif; ?>
					</div>

					<?php
					// запрос featured
					$args = [
						'post_type' => 'post',
						'post_status' => 'publish',
						'order' => 'DESC',
						'posts_per_page' => 1,
						'cat' => 32,
					];
					$query = new WP_Query($args); ?>

					<?php if ($query->have_posts()) : ?>

						<div class="featured-section">
							<div class="featured-wrap">
								<h2>Featured post</h2>

								<!-- цикл -->
								<?php while ($query->have_posts()) : $query->the_post(); ?>

									<div class="featured-row">
										<div class="featured-item__text">
											<span class="post-autor"><?php echo get_the_author(); ?></span>
											<h4><?php the_title();	?></h4>
											<div class="content">
												<?php
												echo strip_shortcodes(truncate_post(440, false, '', true));
												?>
											</div>
											<a href="<?php the_permalink();	?>">Read full post</a>
										</div>
										<?php
										if (has_post_thumbnail()) {
											$img_url = get_the_post_thumbnail_url();
										} else {
											$img_url = '/wp-content/uploads/2021/09/images.png';
										}
										?>
										<div class="featured-item__img"><a href="<?php the_permalink();	?>"><img src="<?php echo $img_url; ?>" alt="<?php the_title();	?>"></a></div>
									</div>

								<?php endwhile; ?>
							</div>
						</div>
						<!-- конец цикла -->
						<?php wp_reset_postdata(); ?>

					<?php else : ?>
						<p><?php esc_html_e('No posts.'); ?></p>
					<?php endif; ?>
			</div>
			<?php
			// запрос featured
			$args = [
				'post_type' => 'post',
				'post_status' => 'publish',
				'order' => 'DESC',
				'posts_per_page' => -1,
				'cat' => 40,
			];
			$query = new WP_Query($args); ?>

			<?php if ($query->have_posts()) : ?>
				<div class="ministery-section">
					<div class="ministery-wrap">
						<h2>News</h2>
						<div class="ministery-row owl-carousel owl-theme" id="post-slider">
							<?php while ($query->have_posts()) : $query->the_post(); ?>
								<div class="ministery__item item">
									<?php
									if (has_post_thumbnail()) {
										$img_url = get_the_post_thumbnail_url();
									} else {
										$img_url = '/wp-content/uploads/2021/09/images.png';
									} ?>
									<a href="<?php the_permalink(); ?>"><img src="<?php echo  $img_url; ?>" alt="<?php the_title(); ?>" class="img-carousel"></a>
									<h4><?php the_title(); ?></h4>
									<span class="date-post"><?php echo get_the_date('j.m.Y'); ?></span>
									<a href="<?php the_permalink(); ?>">Read more</a>
								</div>
								<!-- end Ministery section -->
							<?php endwhile; ?>
						</div>
					</div>
				</div>
				<!-- конец цикла -->
				<?php wp_reset_postdata(); ?>

			<?php else : ?>
				<p><?php esc_html_e('No posts.'); ?></p>
			<?php endif; ?>

		<?php
			buddyboss_pagination();

		else :
			get_template_part('template-parts/content', 'none');
		?>

		<?php endif; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php //get_sidebar(); 
?>
<?php
get_footer();
