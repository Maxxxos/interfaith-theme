<?php
/*
Template Name: Events
*/
get_header(); ?>
<div class="main-slide" style="background-image: url(<?php the_field('main_slider'); ?>);">
    <h1><?php the_title(); ?></h1>
</div>
<div class="internal-wrap page-contact">
    <?php
    // запрос featured
    $args = [
        'post_type' => 'tribe_events',
        'post_status' => 'publish',
        'order' => 'DESC',
        'posts_per_page' => 20,
    ];
    $query = new WP_Query($args); ?>

    <?php if ($query->have_posts()) : ?>
        <div class="ministery-section page-events">
            <div class="ministery-wrap">
                <h2>EVENTS</h2>
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
                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <span class="date-post"><?php echo get_the_date('j.m.Y'); ?></span>
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

</div>

<div class="section-quote">
    <div class="section-quote__item1">
        <div class="blockquote-row">
            <blockquote>“<?php the_field('text_quote'); ?>”</blockquote>
            <span><?php the_field('author_quote'); ?></span>
        </div>
    </div>
    <div class="section-quote__item2" style="background-image: url(<?php the_field('image_quote'); ?>);"></div>
</div>
<div class="section-newsletter">
    <?php echo do_shortcode('[contact-form-7 id="113" title="sign up for our newsletter"]'); ?>
</div>

<?php
get_footer();
