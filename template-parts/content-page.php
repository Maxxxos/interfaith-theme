<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BuddyBoss_Theme
 */

if (empty(get_field('disable_slider'))) { ?>
	<div class="main-slide" style="background-image: url(<?php the_field('main_slider'); ?>);">
		<?php// if (!empty(get_field('main_title'))) { ?>
		<?php if (false) { ?>
			<h1><?php the_field('main_title'); ?></h1>
		<?php } ?>
	</div>
<?php } ?>
<!-- <div class="internal-wrap"> -->
	<?php 
		$page_menu = get_post_meta(get_the_ID(), 'page_menu', true);
		if (!empty($page_menu) && $page_menu != 'novalue') {
		?>
			<div class="internal-sitebar">
				<div class="internal-sitebar__mob">
					<?php
					$menu_items = wp_get_nav_menu_items($page_menu);

					$menu_list = '<select class="select">';
					$menu_list .= '<option disabled>Select</option>';
					foreach ((array) $menu_items as $key => $menu_item) {
						$current = '';
						if ($menu_item->object_id == get_the_ID()) {
							$current = 'class="current_page_item"';
						}
						$menu_list .= '<option data-href="' . $menu_item->url . '">' . $menu_item->title . '</option>';
					}

					$menu_list .= '</select>';
					echo $menu_list;
					?>
				</div>
				<div class="internal-sitebar__desc">
					<aside id="nav_menu-9" class="widget widget_nav_menu">
						<?php
						$menu_items = wp_get_nav_menu_items($page_menu);

						$menu_list = '<ul class="menu" id="menu-' . $page_menu . '">';

						foreach ((array) $menu_items as $key => $menu_item) {
							$current = '';
							if ($menu_item->object_id == get_the_ID()) {
								$current = 'class="current_page_item"';
							}
							$menu_list .= '<li ' . $current . '><a href="' . $menu_item->url . '">' . $menu_item->title . '</a></li>';
						}

						$menu_list .= '</ul>';
						echo $menu_list; ?>
					</aside>
				</div>
			</div>
	<?php } ?>
	<div class="internal-main-content entry-content">
		<?php the_content(); ?>
	</div>
<!-- </div> -->