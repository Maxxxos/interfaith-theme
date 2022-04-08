<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BuddyBoss_Theme
 */
if (!is_user_logged_in()) {
    $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    if (strpos($url, 'members') !== false) {
?>
        <script>
            window.location.href = "/";
        </script>
<?php
        die();
    }
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <?php if (!is_singular('llms_my_certificate')) :

        do_action(THEME_HOOK_PREFIX . 'before_page');

    endif; ?>

    <div id="page" class="site">

        <?php do_action(THEME_HOOK_PREFIX . 'before_header'); ?>
        <header id="masthead" class="site-header site-header--bb ">
            <div class="container site-header-container flex default-header">
                <a href="#" class="bb-toggle-panel"><i class="bb-icon-menu-left"></i></a>

                <div id="site-logo" class="site-branding">
                    <h2 class="site-title">
                        <a href="https://interfaith.sitepreview.app/" rel="home">
                            <img width="600" height="131" src="https://interfaith.sitepreview.app/wp-content/uploads/2021/09/OneSpirit_Interfaith_Foundation_logo_RGB_inverse_600px_S.png" class="bb-logo" alt="" loading="lazy" srcset="https://interfaith.sitepreview.app/wp-content/uploads/2021/09/OneSpirit_Interfaith_Foundation_logo_RGB_inverse_600px_S.png 600w, https://interfaith.sitepreview.app/wp-content/uploads/2021/09/OneSpirit_Interfaith_Foundation_logo_RGB_inverse_600px_S-300x66.png 300w" sizes="(max-width: 600px) 100vw, 600px"> </a>
                    </h2>
                </div>
            </div>
            <div class="bb-mobile-header-wrapper bb-single-icon">
                <div class="bb-mobile-header flex align-items-center">
                      <div class="flex-1 mobile-logo-wrapper">

                        <h2 class="site-title">

                            <a href="https://interfaith.sitepreview.app/" rel="home">
                                <img width="600" height="131" src="https://interfaith.sitepreview.app/wp-content/uploads/2021/09/OneSpirit_Interfaith_Foundation_logo_RGB_inverse_600px_S.png" class="bb-mobile-logo" alt="" loading="lazy" srcset="https://interfaith.sitepreview.app/wp-content/uploads/2021/09/OneSpirit_Interfaith_Foundation_logo_RGB_inverse_600px_S.png 600w, https://interfaith.sitepreview.app/wp-content/uploads/2021/09/OneSpirit_Interfaith_Foundation_logo_RGB_inverse_600px_S-300x66.png 300w" sizes="(max-width: 600px) 100vw, 600px"> </a>

                        </h2>
                    </div>
                </div>
            </div>
        </header>

        <?php do_action(THEME_HOOK_PREFIX . 'after_header'); ?>

        <?php do_action(THEME_HOOK_PREFIX . 'before_content'); ?>

        <?php do_action(THEME_HOOK_PREFIX . 'begin_content'); ?>