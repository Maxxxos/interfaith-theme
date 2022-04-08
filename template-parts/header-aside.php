<?php
$show_search        = buddyboss_theme_get_option('header_search');
$show_messages      = buddyboss_theme_get_option('messages') && is_user_logged_in();
$show_notifications = buddyboss_theme_get_option('notifications') && is_user_logged_in();
$show_shopping_cart = buddyboss_theme_get_option('shopping_cart');
$user_info = wp_get_current_user();
?>

<div id="header-aside" class="header-aside">
	<div class="header-aside-inner">
		<?php if (is_user_logged_in()) : ?>
			<div class="user-wrap user-wrap-container menu-item-has-children">
				<?php
				$current_user = wp_get_current_user();
				$user_link    = function_exists('bp_core_get_user_domain') ? bp_core_get_user_domain($current_user->ID) : get_author_posts_url($current_user->ID);
				$display_name = function_exists('bp_core_get_user_displayname') ? bp_core_get_user_displayname($current_user->ID) : $current_user->display_name;
				?>

				<a class="user-link" href="<?php echo esc_url($user_link); ?>">
					<span class="user-name"><?php echo esc_html($display_name); ?></span><i class="bb-icon-angle-down"></i>
					<?php echo get_avatar(get_current_user_id(), 100); ?>
				</a>

				<div class="sub-menu">
					<div class="wrapper">
						<ul class="sub-menu-inner">
							<li class="menupop"><a href="/members/<?php echo $user_info->user_login; ?>/dashbord/">Dashboard</a></li>
							<li class="menupop"><a href="/members/<?php echo $user_info->user_login; ?>/my-courses/">My Courses</a></li>
							<?php if ($user_info->roles[0] == 'student') : ?>
								<li class="menupop"><a href="/members/<?php echo $user_info->user_login; ?>/my-classmates/">My Classmates</a></li>
							<?php endif; ?>
							<?php if ($user_info->roles[0] == 'ministry' || $user_info->roles[0] == 'administrator' || $user_info->roles[0] == 'associate') : ?>								
								<li class="menupop"><a href="/members/<?php echo $user_info->user_login; ?>/forums/">Forum</a></li>
								<?php if ($user_info->roles[0] != 'associate') : ?>
									<li class="menupop"><a href="/members/<?php echo $user_info->user_login; ?>/">My profile</a></li>
								<?php endif; ?>
							<?php endif; ?>
							<li class="menupop"><a href="/members/<?php echo $user_info->user_login; ?>/settings/">Account Settings</a></li>
							<li class="menupop"><a href="<?php echo esc_url(wp_logout_url(home_url())); ?>">Log Out</a></li>
						</ul>
					</div>
				</div>
			</div>

			<?php
			if ((class_exists('SFWD_LMS') && buddyboss_is_learndash_inner()) || (class_exists('LifterLMS') && buddypanel_is_lifterlms_inner())) :
			?>

				<span class="bb-separator"></span>
				<a href="#" id="bb-toggle-theme">
					<span class="sfwd-dark-mode" data-balloon-pos="down" data-balloon="<?php esc_html_e('Dark Mode', 'buddyboss-theme'); ?>"><i class="bb-icon-moon-circle"></i></span>
					<span class="sfwd-light-mode" data-balloon-pos="down" data-balloon="<?php esc_html_e('Light Mode', 'buddyboss-theme'); ?>"><i class="bb-icon-sun"></i></span>
				</a>
				<a href="#" class="header-maximize-link course-toggle-view" data-balloon-pos="down" data-balloon="<?php esc_html_e('Maximize', 'buddyboss-theme'); ?>"><i class="bb-icon-maximize"></i></a>
				<a href="#" class="header-minimize-link course-toggle-view" data-balloon-pos="down" data-balloon="<?php esc_html_e('Minimize', 'buddyboss-theme'); ?>"><i class="bb-icon-minimize"></i></a>

				<?php
			else :
				if ($show_search || $show_messages || $show_notifications || $show_shopping_cart) :
				?>
					<span class="bb-separator"></span>
				<?php
				endif;

				if ($show_search) :
				?>
					<a href="#" class="header-search-link" data-balloon-pos="down" data-balloon="<?php esc_html_e('Search', 'buddyboss-theme'); ?>"><i class="bb-icon-search"></i></a>
				<?php
				endif;

				//if ( $show_messages && function_exists( 'bp_is_active' ) && bp_is_active( 'messages' ) ) :
				?>
				<?php //get_template_part( 'template-parts/messages-dropdown' ); 
				?>
				<?php
				//endif;

				//if ( $show_notifications && function_exists( 'bp_is_active' ) && bp_is_active( 'notifications' ) ) :
				?>
				<?php //get_template_part( 'template-parts/notification-dropdown' ); 
				?>
				<?php
				//endif;

				// if ( $show_shopping_cart && class_exists( 'WooCommerce' ) ) :
				// 	
				?>
				<?php //get_template_part( 'template-parts/cart-dropdown' ); 
				?>
			<?php
			// endif;
			endif;
			?>

		<?php else : ?>
			<div class="bb-header-buttons">
				<a class="btn-login" id="view-login-form">Login</a>
			</div>
			<span class="search-separator bb-separator" style="background: none;"></span>
			<?php if ($show_search) : ?>
				<a href="#" class="header-search-link" data-balloon-pos="down" data-balloon="<?php esc_attr_e('Search', 'buddyboss-theme'); ?>"><i class="bb-icon-search"></i></a>
			<?php endif; ?>

			<?php if ($show_shopping_cart && class_exists('WooCommerce')) : ?>
				<?php get_template_part('template-parts/cart-dropdown'); ?>
			<?php endif; ?>


		<?php endif; ?>

		<?php $header = buddyboss_theme_get_option('buddyboss_header'); ?>

		<?php if ('3' === $header || (class_exists('SFWD_LMS') && buddyboss_is_learndash_inner()) || (class_exists('LifterLMS') && buddypanel_is_lifterlms_inner())) : ?>
			<?php echo buddypanel_position_right(); ?>
		<?php endif; ?>
	</div>
</div>