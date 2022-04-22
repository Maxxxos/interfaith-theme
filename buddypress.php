<?php

/**
 * The template for displaying BuddyPress pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BuddyBoss_Theme
 */
get_header();

$admin_custom_login = buddyboss_theme_get_option('boss_custom_login');
$admin_login_background_text = buddyboss_theme_get_option('admin_login_background_text');
$admin_login_background_textarea = buddyboss_theme_get_option('admin_login_background_textarea');
$admin_login_heading_position = buddyboss_theme_get_option('admin_login_heading_position');
$admin_login_background_switch = buddyboss_theme_get_option('admin_login_background_switch');

if ((function_exists('bp_is_register_page') && bp_is_register_page()) || (function_exists('bp_is_activation_page') && bp_is_activation_page())) {
    $class_bp_register = 'bs-bp-container-reg';

    if ($admin_login_heading_position) {
        $heading_postion_style = 'padding-top: ' . $admin_login_heading_position . '%;';
    } else {
        $heading_postion_style = 'padding-top: 8%;';
    }

    if ($admin_custom_login && $admin_login_background_switch) {
        echo '<div class="login-split"><div style="' . $heading_postion_style . '">';
        if ($admin_login_background_text) {
            echo wp_kses_post(sprintf(esc_html__('%s', 'buddyboss-theme'), $admin_login_background_text));
        }
        if ($admin_login_background_textarea) {
            echo '<span>';
            echo stripslashes($admin_login_background_textarea);
            echo '</span>';
        }
        echo '</div><div class="split-overlay"></div></div>';
    }
} else {
    $class_bp_register = 'bs-bp-container';
}
//echo $_SERVER['REQUEST_URI'];

$user_info = wp_get_current_user();
$profile_cover_width = buddyboss_theme_get_option('buddyboss_profile_cover_width');
$profile_cover_height = buddyboss_theme_get_option('buddyboss_profile_cover_height');
remove_filter('bp_get_add_follow_button', 'buddyboss_theme_bp_get_add_follow_button');

$has_cover_image = '';
$has_cover_image_position = '';
$displayed_user = bp_get_displayed_user();
$cover_image_url = bp_attachments_get_attachment(
    'url',
    array(
        'object_dir' => 'members',
        'item_id' => $displayed_user->id,
    )
);
$default_cover_image = buddyboss_theme_get_option('buddyboss_profile_cover_default');
?>
<div id="account-menu__toggle">My Student Dashboard</div>
<div class="account__sidebar-menu">
    <ul class="account__sidebar-list">
        <li><a href="/members/<?php echo $user_info->data->user_login; ?>/dashboard/"><span class="img-dashboard"></span>Dashboard</a></li>
        <li><a href="/members/<?php echo $user_info->data->user_login; ?>/my-courses/"><span class="img-courses"></span>My Courses</a></li>
        <?php if ($user_info->roles[0] == 'student' || $user_info->roles[0] == 'administrator') : ?>
            <li><a href="/members/<?php echo $user_info->user_login; ?>/my-classmates/"><span class="classmates"></span>My Classmates</a></li>
        <?php endif; ?>
        <?php if ($user_info->roles[0] == 'ministry' || $user_info->roles[0] == 'administrator' || $user_info->roles[0] == 'associate') : ?>
            <li><a href="/members/<?php echo $user_info->data->user_login; ?>/my-forums/"><span class="img-forum"></span>Forum</a></li>
            <?php if ($user_info->roles[0] != 'associate') : ?>
                <li><a href="/members/<?php echo $user_info->data->user_login; ?>/"><span class="img-profile"></span>My profile</a></li>
            <?php endif; ?>
        <?php endif; ?>
        <li><a href="/members/<?php echo $user_info->data->user_login; ?>/settings/"><span class="img-settings"></span>Account Settings</a>
        </li>
        <li class="logout"><a href="<?php echo esc_url(wp_logout_url(home_url())); ?>"><span class="img-logout"></span>Log Out</a></li>
    </ul>
</div>
<div id="primary" class="content-area <?php echo $class_bp_register; ?>">
    <main id="main" class="site-main">
        <?php
        if (function_exists('bp_is_register_page') && bp_is_register_page()) {
            $logo_id = buddyboss_theme_get_option('admin_logo_media', 'id');
            $logo     = ($logo_id) ? wp_get_attachment_image($logo_id, 'full', '', array('class' => 'bb-logo')) : get_bloginfo('name');
            $enable_private_network = bp_get_option('bp-enable-private-network');
            if ('0' === $enable_private_network) {
        ?>
                <div class="register-section-logo private-on-div">
                    <?php echo $logo; ?>
                </div>
            <?php
            } else {
            ?>
                <div class="register-section-logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <?php echo $logo; ?>
                    </a>
                </div>
            <?php
            }
        } elseif (function_exists('bp_is_activation_page') && bp_is_activation_page()) {
            $logo_id = buddyboss_theme_get_option('admin_logo_media', 'id');
            $logo     = ($logo_id) ? wp_get_attachment_image($logo_id, 'full', '', array('class' => 'bb-logo')) : get_bloginfo('name');
            $enable_private_network = bp_get_option('bp-enable-private-network');
            if ('0' === $enable_private_network) {
            ?>
                <div class="activate-section-logo">
                    <?php echo $logo; ?>
                </div>
            <?php
            } else {
            ?>
                <div class="activate-section-logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <?php echo $logo; ?>
                    </a>
                </div>
        <?php
            }
        }
        ?>

        <?php if (have_posts()) : ?>
            <?php
            /* Start the Loop */
            while (have_posts()) :
                the_post();

                /*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
                get_template_part('template-parts/content', 'buddypress');

            endwhile;
            ?>

        <?php
        //buddyboss_pagination();

        else :
            get_template_part('template-parts/content', 'none');
        ?>

        <?php endif; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
if (!bp_is_group_create() && !bp_is_user_profile_edit() && !bp_is_user_change_avatar() && !bp_is_user_change_cover_image()) {
    get_sidebar('buddypress');
}
?>
<script>
    jQuery(document).ready(function($) {
        let url = window.location.href;
        let arr_url = url.split('/');
        if (jQuery.inArray('courses', arr_url) != -1) {
            jQuery('.account__sidebar-list li').removeClass('selected');
            jQuery('.account__sidebar-list li:eq(1)').addClass('selected');
            jQuery('#item-header').hide();
            jQuery('#object-nav').hide();

        } else if (jQuery.inArray('forums', arr_url) != -1) {
            jQuery('.account__sidebar-list li').removeClass('selected');
            jQuery('.account__sidebar-list li:eq(3)').addClass('selected');
            jQuery('#item-header').hide();
            jQuery('#object-nav').hide();

        } else if (jQuery.inArray('settings', arr_url) != -1) {
            jQuery('.account__sidebar-list li').removeClass('selected');
            jQuery('.account__sidebar-list li:eq(5)').addClass('selected');
            jQuery('#buddypress h1.entry-title.settings-title').text('Login Information');
            jQuery('#buddypress h1.entry-title.settings-title').addClass('new-style');
            jQuery('.subnav').show();
            jQuery('.subnav li:eq(2)').hide();
            jQuery('.subnav li:eq(3)').hide();
            jQuery('.subnav li:eq(4)').hide();

        } else {
            jQuery('#object-nav').hide();
            jQuery('.account__sidebar-list li').removeClass('selected');
            jQuery('.account__sidebar-list li:eq(4)').addClass('selected');
            // let res = url.split("?");
            // jQuery('#cover-image-container').css('opacity', 1);

            // jQuery('#courses-personal-li').hide();
            // jQuery('#object-nav ul').append('<li class="bp-personal-tab"><a href="' + res[0] + '?menu=documents">Documents</a></li><li class="bp-personal-tab"><a href="' + res[0] + '?menu=minister">Minister profile</a></li>');
            // if (res[1] == 'menu=documents') {
            //     jQuery('#object-nav ul li').removeClass('selected');
            //     jQuery('#object-nav ul li').removeClass('current');
            //     jQuery('#object-nav ul li:eq(3)').addClass('selected');
            //     jQuery('#object-nav ul li:eq(3)').addClass('current');
            // }
            // if (res[1] == 'menu=minister') {
            //     jQuery('#object-nav ul li').removeClass('selected');
            //     jQuery('#object-nav ul li').removeClass('current');
            //     jQuery('#object-nav ul li:eq(4)').addClass('selected');
            //     jQuery('#object-nav ul li:eq(4)').addClass('current');
            // }

        }
    });
</script>
<?php
get_footer('account');
