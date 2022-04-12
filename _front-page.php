<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BuddyBoss_Theme
 */

get_header();
?>

<div id="primary" class="content-area bb-grid-cell">
    <main id="main" class="site-main">

        <?php if (have_posts()) :

            do_action(THEME_HOOK_PREFIX . '_template_parts_content_top');

            while (have_posts()) :
                the_post();

        ?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php
                    $switch_title = get_post_meta(get_the_ID(), 'fullwidth_options', true);
                    if (!empty($switch_title)) {
                        $show_title = $switch_title['fullwidth_title_switch'];
                    }

                    if (is_page_template('page-fullwidth.php')) {
                        if (empty($show_title)) { ?>
                            <header class="entry-header"><?php the_title('<h1 class="entry-title">', '</h1>'); ?></header>
                        <?php } else {
                            // hidden title
                        }
                    } elseif (!is_search() and !is_page_template('page-fullscreen.php') and !is_page_template('page-fullwidth-content.php')) { ?>
                        <header class="entry-header"><?php the_title('<h1 class="entry-title">', '</h1>'); ?></header>
                    <?php } ?>

                    <div class="entry-content">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'buddyboss-theme'),
                            'after'     => '</div>',
                        ));
                        ?>
                    </div><!-- .entry-content -->

                    <?php if (get_edit_post_link()) : ?>
                        <footer class="entry-footer">
                            <?php
                            edit_post_link(
                                sprintf(
                                    wp_kses(
                                        /* translators: %s: Name of current post. Only visible to screen readers */
                                        __('Edit <span class="screen-reader-text">%s</span>', 'buddyboss-theme'),
                                        array(
                                            'span' => array(
                                                'class' => array(),
                                            ),
                                        )
                                    ),
                                    get_the_title()
                                ),
                                '<span class="edit-link">',
                                '</span>'
                            );
                            ?>
                        </footer><!-- .entry-footer -->
                    <?php endif; ?>

                </article>

            <?php

            endwhile; // End of the loop.
        else :
            get_template_part('template-parts/content', 'none');
            ?>

        <?php endif; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
// if ( is_search() ) {
// 	get_sidebar( 'search' );
// } else {
// 	get_sidebar( 'page' );
// }
?>

<?php
get_footer();
