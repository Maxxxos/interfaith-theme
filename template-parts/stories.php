<?php
/*
Template Name: Stories page
*/
get_header();
?>
<div id="primary" class="content-area blog-page">
    <main id="main" class="site-main ">
        <div class="post-grid bb-grid">

            <?php
            // запрос featured
            $args = [
                'post_type' => 'stories',
                'post_status' => 'publish',
                'order' => 'DESC',
                'posts_per_page' => 1,
            ];
            $query = new WP_Query($args); ?>

            <?php if ($query->have_posts()) : ?>

                <div class="featured-section">
                    <div class="featured-wrap page-story">
                        <h2><?php the_field('title_second'); ?></h2>

                        <!-- цикл -->
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <?php $last_stories_id = get_the_id(); ?>
                            <div class="featured-row">
                                <div class="featured-item__text">
                                   <!-- <h4><?php the_field('main_title');    ?></h4> -->
                                    <div class="content">
                                        <?php
                                        echo strip_shortcodes(truncate_post(440, false, '', true));
                                        ?>
                                    </div>
                                    <span class="post-autor post-author-story"><?php the_title(); ?></span>
                                </div>
                                <?php
                                if (has_post_thumbnail()) {
                                    $img_url = get_the_post_thumbnail_url();
                                } else {
                                    $img_url = '/wp-content/uploads/2021/09/images.png';
                                }
                                ?>
                                <div class="featured-item__img"><img src="<?php echo $img_url; ?>" alt="<?php the_title();    ?>"></div>
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
            'post_type' => 'stories',
            'post_status' => 'publish',
            'order' => 'DESC',
            'post__not_in' => [$last_stories_id],
            'posts_per_page' => 3,
        ];
        $query = new WP_Query($args); ?>

        <?php if ($query->have_posts()) : ?>
            <div class="ministery-section page-story">
                <div class="ministery-wrap">
                    <h2><?php the_field('title_last_section'); ?></h2>
                    <div class="student-stories__wrap" id="add-stories-row">
                        <?php while ($query->have_posts()) : $query->the_post(); ?>

                            <div class="student-stories__item">
                                <?php
                                if (has_post_thumbnail()) {
                                    $img_url = get_the_post_thumbnail_url();
                                } else {
                                    $img_url = '/wp-content/uploads/2021/09/images.png';
                                }
                                $date = new DateTime($user_info->user_registered);
                                ?>
                                <img src="<?php echo $img_url; ?>" alt="<?php the_title(); ?>">
                                <div class="student-stories__content">
                                    <div class="student-stories">
                                        <?php echo strip_tags(get_the_excerpt()); ?>
                                    </div>
                                    <div class="student-name"><?php the_title();
                                                                ?></div>
                                    <div class="student-stories-date"><?php echo $date->format('F Y'); ?></div>
                                </div>
                            </div>
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
        $max_num_pages = $query->max_num_pages;
        if ($max_num_pages > 1) {  ?>
            <div class="stories-more-row">
                <div class="stories-more" id="stories-more" data-lastId="<?php echo $last_stories_id; ?>" data-all="<?php echo $max_num_pages; ?>" data-pn="2">Load more</div>
            </div>
        <?php } ?>
</div>
</main>
</div>
<?php
get_footer();
