<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package BuddyBoss_Theme
 */

get_header();
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

				//do_action( THEME_HOOK_PREFIX . '_single_template_part_content', get_post_type() );
		?>
				<article id="post-<?php the_ID(); ?>" class="post-<?php the_ID(); ?> post type-post status-publish format-standard has-post-thumbnail hentry category-uncategorized full-fi-invert">

					<?php
					$url_img = get_field('main_image');
					if (!empty($url_img)) {
						$main_img = $url_img;
					} else {
						$main_img = '/wp-content/uploads/2021/09/Rectangle-18-3.jpg';
					}
					?>

					<div class="entry-content-wrap">
						<figure class="entry-media entry-img bb-vw-container1">
							<img width="640" height="290" src="<?php echo $main_img; ?>" class="attachment-large size-large wp-post-image" alt="" loading="lazy" sizes="(max-width:768px) 768px, (max-width:1024px) 1024px, (max-width:1920px) 1920px, 1024px" srcset="<?php echo $main_img; ?> 730w, <?php echo $main_img; ?> 300w, <?php echo $main_img; ?> 624w">
						</figure>



						<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
						</header><!-- .entry-header -->



						<div class="entry-meta">
							<div class="bb-user-avatar-wrap">
								<div class="meta-wrap">
									<?php 
										$author = get_field('author');
                                        if ($author['user_firstname'] || $author['user_lastname']){ ?>
                                            <span class="post-author">By <?php echo $author['user_firstname'] . ' ' . $author['user_lastname']; ?></span>
                                        <?php } else { ?>
                                            <span class="post-author">By <?php echo $author['display_name']; ?></span>
                                       <?php } ?>
									
									
								</div>
							</div>
							<div class="bb-user-avatar-wrap">
								<div class="meta-wrap">
									<span class="post-date"><?php echo get_the_date(); ?></span>
								</div>
							</div>
							<!-- <div class="push-right flex align-items-center top-meta">
								<a href="https://interfaith.sitepreview.app/couple-hold-wedding-in-dublin-airport-8/#respond" class="flex align-items-center bb-comments-wrap"><i class="bb-icon-comment"></i><span class="comments-count">0 <span class="bb-comment-text">Comments</span></span></a>
							</div> -->
						</div>


						<div class="entry-content">
							<?php the_content(); ?>
						</div><!-- .entry-content -->
						<?php //if (get_field('text_quote_post')) { ?>
						<?php if (false) { ?>
						<div class="row-quote-single" id="quote-single">
							<div class="text-quote"><?php the_field('text_quote_post'); ?> </div>
						</div>
						<?php } ?>
					</div>


				</article>
		<?php endwhile; // End of the loop.

		endif;
		?>
		<div class="row">
			<div class="section-share" id="share-view">
				<div class="popup-share">
					<?php if (!empty($share_box) && is_singular('post')) :
						get_template_part('template-parts/share');
					endif; ?>
				</div>
				<div class="share-block"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M22.2343 3.99994C22.2343 5.79492 20.7793 7.25006 18.9843 7.25006C17.1893 7.25006 15.7344 5.79492 15.7344 3.99994C15.7344 2.20514 17.1893 0.75 18.9843 0.75C20.7793 0.75 22.2343 2.20514 22.2343 3.99994Z" />
						<path d="M18.9843 8.00006C16.7783 8.00006 14.9844 6.20599 14.9844 3.99994C14.9844 1.79407 16.7783 0 18.9843 0C21.1904 0 22.9843 1.79407 22.9843 3.99994C22.9843 6.20599 21.1904 8.00006 18.9843 8.00006ZM18.9843 1.5C17.6053 1.5 16.4844 2.62207 16.4844 3.99994C16.4844 5.37799 17.6053 6.50006 18.9843 6.50006C20.3633 6.50006 21.4843 5.37799 21.4843 3.99994C21.4843 2.62207 20.3633 1.5 18.9843 1.5Z" />
						<path d="M22.2343 19.9991C22.2343 21.7939 20.7793 23.2491 18.9843 23.2491C17.1893 23.2491 15.7344 21.7939 15.7344 19.9991C15.7344 18.2042 17.1893 16.749 18.9843 16.749C20.7793 16.749 22.2343 18.2042 22.2343 19.9991Z" />
						<path d="M18.9843 23.9991C16.7783 23.9991 14.9844 22.205 14.9844 19.9991C14.9844 17.7931 16.7783 15.999 18.9843 15.999C21.1904 15.999 22.9843 17.7931 22.9843 19.9991C22.9843 22.205 21.1904 23.9991 18.9843 23.9991ZM18.9843 17.499C17.6053 17.499 16.4844 18.6211 16.4844 19.9991C16.4844 21.377 17.6053 22.4991 18.9843 22.4991C20.3633 22.4991 21.4843 21.377 21.4843 19.9991C21.4843 18.6211 20.3633 17.499 18.9843 17.499Z" />
						<path d="M8.23444 12.0009C8.23444 13.7959 6.7793 15.2509 4.98431 15.2509C3.18951 15.2509 1.73438 13.7959 1.73438 12.0009C1.73438 10.2059 3.18951 8.75098 4.98431 8.75098C6.7793 8.75098 8.23444 10.2059 8.23444 12.0009Z" />
						<path d="M4.98431 16.0009C2.77844 16.0009 0.984375 14.207 0.984375 12.0009C0.984375 9.79486 2.77844 8.00098 4.98431 8.00098C7.19037 8.00098 8.98444 9.79486 8.98444 12.0009C8.98444 14.207 7.19037 16.0009 4.98431 16.0009ZM4.98431 9.50098C3.60535 9.50098 2.48438 10.6229 2.48438 12.0009C2.48438 13.379 3.60535 14.5009 4.98431 14.5009C6.36346 14.5009 7.48444 13.379 7.48444 12.0009C7.48444 10.6229 6.36346 9.50098 4.98431 9.50098Z" />
						<path d="M7.3467 11.5217C6.99862 11.5217 6.6606 11.3406 6.47658 11.0167C6.20357 10.5377 6.37166 9.92671 6.85067 9.6526L16.1295 4.36268C16.6085 4.08766 17.2196 4.25575 17.4937 4.73658C17.7667 5.21559 17.5986 5.82661 17.1196 6.10072L7.84054 11.3906C7.68453 11.4796 7.51461 11.5217 7.3467 11.5217Z" />
						<path d="M16.6236 19.7706C16.4555 19.7706 16.2856 19.7285 16.1296 19.6395L6.85053 14.3495C6.37153 14.0765 6.20362 13.4655 6.47663 12.9854C6.74854 12.5055 7.36048 12.3365 7.84058 12.6115L17.1196 17.9014C17.5986 18.1744 17.7665 18.7855 17.4935 19.2656C17.3086 19.5895 16.9706 19.7706 16.6236 19.7706Z" />
					</svg>Share</div>
			</div>
		</div>
		<?php
		// main post
		$args = [
			'post_type' => 'post',
			'post_status' => 'publish',
			'order' => 'DESC',
			'posts_per_page' => 3,
			'post__not_in' => [$id_post],
			//'cat' => [-32, -33],
		];
		$query = new WP_Query($args); ?>
		<?php if ($query->have_posts()) : ?>
			<div class="section-similar">
				<div class="similar-wrap">
					<h2>Similar posts</h2>
					<div class="similar-row">
						<?php while ($query->have_posts()) : $query->the_post(); ?>
							<div class="similar-item">
                               
								<div class="similar-item-img">
                                    <a href="<?php the_permalink(); ?>">
									<?php
									if (has_post_thumbnail()) {
										$img_url = get_the_post_thumbnail_url();
									} else {
										$img_url = '/wp-content/uploads/2021/09/images.png';
									}
									?>
									<img src="<?php echo $img_url; ?>" alt="<?php the_title(); ?>">
                                    </a>
								</div>
								<div class="similar-item-content">
                                    
									<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
									<span class="post-date"><?php echo get_the_date('d.m.Y'); ?></span>
									<a href="<?php the_permalink(); ?>" class="post-link">Read more</a>
								</div>
                                
							</div>
						<?php endwhile; ?>
						<!-- конец цикла -->
					</div>
				</div>
			</div>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>

<?php
get_footer();
