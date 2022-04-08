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
<?php
	$add_class = '';
	if(is_user_logged_in()) {
		$add_class = 'user-logged-in';
	}
?>
<body <?php body_class($add_class); ?>>

	<?php wp_body_open(); ?>

	<?php if (!is_singular('llms_my_certificate')) :

		do_action(THEME_HOOK_PREFIX . 'before_page');

	endif; ?>

	<div id="page" class="site">

		<?php do_action(THEME_HOOK_PREFIX . 'before_header'); ?>

		<header id="masthead" class="<?php echo apply_filters('buddyboss_site_header_class', 'site-header site-header--bb'); ?> <?php if (is_search()) {
																																	echo 'dark-bg';
																																} ?>">
			<?php do_action(THEME_HOOK_PREFIX . 'header'); ?>
		</header>

		<?php do_action(THEME_HOOK_PREFIX . 'after_header'); ?>

		<?php do_action(THEME_HOOK_PREFIX . 'before_content'); ?>

		<div id="content" class="site-content <?php if (is_archive() || is_home() || is_page('student-stories')) {
													echo 'page-archive';
												} else if (is_page_template() == 'internal.php') {
													echo 'templtate-internal';
												} ?>">
			<?php if (is_post_type_archive()) : ?>
				<div class="main-slide" style="background-image: url(<?php the_field('main_slider', 727); ?>);">
					<h1><?php echo get_the_title(727); ?></h1>
				</div>
			<?php elseif (is_archive() || is_home()) : ?>
				<div class="main-slide" style="background-image: url(/wp-content/uploads/2021/09/Rectangle-18-1-3.jpg);">
					<h1>News & Blog</h1>
				</div>
			<?php endif; ?>

			<?php if (is_page('student-stories')) : ?>
				<div class="main-slide" style="background-image: url(<?php the_field('main_image'); ?>);">
					<h1><?php echo get_the_title(); ?></h1>
				</div>
			<?php endif; ?>

			<?php do_action(THEME_HOOK_PREFIX . 'begin_content'); ?>

			<div class="container">
				<div class="<?php echo apply_filters('buddyboss_site_content_grid_class', 'bb-grid site-content-grid'); ?>">