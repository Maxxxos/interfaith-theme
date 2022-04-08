<?php
//data button
global $wpdb;
$is_enrolled         = false;
$current_user_id     = get_current_user_id();
$course_price        = learndash_get_course_meta_setting($course_id, 'course_price');
$course_price_type   = learndash_get_course_meta_setting($course_id, 'course_price_type');
$course_button_url   = learndash_get_course_meta_setting($course_id, 'custom_button_url');
$paypal_settings     = LearnDash_Settings_Section::get_section_settings_all('LearnDash_Settings_Section_PayPal');
$course_video_embed  = get_post_meta($course_id, '_buddyboss_lms_course_video', true);
$course_certificate  = learndash_get_course_meta_setting($course_id, 'certificate');
$courses_progress    = buddyboss_theme()->learndash_helper()->get_courses_progress($current_user_id);
$course_progress     = isset($courses_progress[$course_id]) ? $courses_progress[$course_id] : null;
$course_progress_new = buddyboss_theme()->learndash_helper()->ld_get_progress_course_percentage(get_current_user_id(), $course_id);
$admin_enrolled      = LearnDash_Settings_Section::get_section_setting('LearnDash_Settings_Section_General_Admin_User', 'courses_autoenroll_admin_users');
$lesson_count        = learndash_get_lesson_list($course_id, array('num' => -1));
$course_pricing      = learndash_get_course_price($course_id);
$has_access          = sfwd_lms_has_access($course_id, $current_user_id);
$file_info           = pathinfo($course_video_embed);

if (buddyboss_theme_get_option('learndash_course_participants', null, true)) {
	$course_members_count = buddyboss_theme()->learndash_helper()->buddyboss_theme_ld_course_enrolled_users_list($course_id);
	$members_arr          = learndash_get_users_for_course($course_id, array('number' => 5), false);

	if (($members_arr instanceof WP_User_Query) && (property_exists($members_arr, 'results')) && (!empty($members_arr->results))) {
		$course_members = $members_arr->get_results();
	} else {
		$course_members = array();
	}
}

if ('' != $course_video_embed) {
	$thumb_mode = 'thumbnail-container-vid';
} else {
	$thumb_mode = 'thumbnail-container-img';
}

if (sfwd_lms_has_access($course->ID, $current_user_id)) {
	$is_enrolled = true;
} else {
	$is_enrolled = false;
}

// end data button
$course_cover_photo = false;
if (class_exists('\BuddyBossTheme\BuddyBossMultiPostThumbnails')) {
	$course_cover_photo = \BuddyBossTheme\BuddyBossMultiPostThumbnails::get_post_thumbnail_url(
		'sfwd-courses',
		'course-cover-image'
	);
}

$course = get_post($course_id);
$has_access = sfwd_lms_has_access($course_id, get_current_user_id());
$lessons = learndash_get_lesson_list($course_id);
?>
<div class="bb-vw-container bb-learndash-banner">

	<?php if (!empty($course_cover_photo)) { ?>
		<img src="<?php echo $course_cover_photo; ?>" alt="<?php the_title_attribute(array('post' => $course_id)); ?>" class="banner-img wp-post-image" />
	<?php } ?>

	<div class="bb-course-banner-info container bb-learndash-side-area">
		<div class="flex flex-wrap">
			<div class="bb-course-banner-inner">
				<?php
				if (taxonomy_exists('ld_course_category')) {
					//category
					$course_cats = get_the_terms($course->ID, 'ld_course_category');
					if (!empty($course_cats)) { ?>
						<div class="bb-course-category">
							<?php foreach ($course_cats as $course_cat) { ?>
								<span class="course-category-item"><a title="<?php echo $course_cat->name; ?>" href="<?php echo home_url() ?>/courses/?search=&filter-categories=<?php echo $course_cat->slug; ?>"><?php echo $course_cat->name; ?></a><span>,</span></span>
							<?php } ?>
						</div>
				<?php }
				}
				?>
				<h1 class="entry-title"><?php echo get_the_title($course_id); ?></h1>
				<div class="course-starting">Begins <?php echo get_field('course_starting'); ?></div>
				<?php if (has_excerpt($course_id)) { ?>
					<div class="bb-course-excerpt">
						<?php echo get_the_excerpt($course_id); ?>
					</div>
				<?php } ?>
				<!-- start button  -->
				<div class="add-button-start">
					<div class="bb-button-wrap">
						<?php
						$resume_link = '';

						if (empty($course_progress) && $course_progress < 100) {
							$btn_advance_class = 'btn-advance-start';
							$btn_advance_label = sprintf(__('Start %s', 'buddyboss-theme'), LearnDash_Custom_Label::get_label('course'));
							$resume_link       = buddyboss_theme()->learndash_helper()->boss_theme_course_resume($course_id);
						} elseif ($course_progress == 100) {
							$btn_advance_class = 'btn-advance-completed';
							$btn_advance_label = __('Completed', 'buddyboss-theme');
						} else {
							$btn_advance_class = 'btn-advance-continue';
							$btn_advance_label = __('Continue', 'buddyboss-theme');
							$resume_link       = buddyboss_theme()->learndash_helper()->boss_theme_course_resume($course_id);
						}

						$login_model = LearnDash_Settings_Section::get_section_setting('LearnDash_Settings_Theme_LD30', 'login_mode_enabled');
						$login_url   = apply_filters('learndash_login_url', ($login_model === 'yes' ? '#login' : wp_login_url(get_the_permalink($course_id))));

						if ($course_price_type == 'open' || $course_price_type == 'free') {
							if (apply_filters('learndash_login_modal', true, $course_id, $current_user_id) && !is_user_logged_in() && $course_price_type != 'open') :
						?>
								<div class="learndash_join_button <?php echo $btn_advance_class; ?>">
									<a href="<?php echo esc_url($login_url); ?>" class="btn-advance ld-primary-background"><?php echo __('Login to Enroll', 'buddyboss-theme'); ?></a>
								</div><?php
									else :
										if ($course_price_type == 'free' && false === $is_enrolled) {
											$button_text = LearnDash_Custom_Label::get_label('button_take_this_course');
										?>
									<div class="learndash_join_button <?php echo $btn_advance_class; ?>">
										<form method="post">
											<input type="hidden" value="<?php echo $course_id; ?>" name="course_id" />
											<input type="hidden" name="course_join" value="<?php echo wp_create_nonce('course_join_' . get_current_user_id() . '_' . $course_id); ?>" />
											<input type="submit" value="<?php echo $button_text; ?>" class="btn-join" id="btn-join" />
										</form>
									</div><?php
										} else {
											?>
									<div class="learndash_join_button <?php echo $btn_advance_class; ?>">
										<a href="<?php echo esc_url($resume_link); ?>" class="btn-advance ld-primary-background"><?php echo $btn_advance_label; ?></a>
									</div>
								<?php
										}
									endif;

									if ($course_price_type == 'open') {
								?>
								<!-- <span class="bb-course-type bb-course-type-open"><?php //_e('Open Registration', 'buddyboss-theme'); ?></span> -->
								<?php
																																		} else {
																																			?>
								<span class="bb-course-type bb-course-type-free"><?php _e('Free', 'buddyboss-theme'); ?></span><?php
																																		}
																																	} elseif ($course_price_type == 'closed') {
																																		$learndash_payment_buttons = learndash_payment_buttons($course);
																																		if (empty($learndash_payment_buttons)) :
																																			if (false === $is_enrolled) {
																																				echo '<span class="ld-status ld-status-incomplete ld-third-background ld-text">' . __('This course is currently closed', 'buddyboss-theme') . '</span>';
																																				if (!empty($course_price)) {
																																					echo '<span class="bb-course-type bb-course-type-paynow">' . wp_kses_post($course_pricing['price']) . '</span>';
																																				}
																																			} else { ?>
									<div class="learndash_join_button <?php echo $btn_advance_class; ?>">
										<a href="<?php echo esc_url($resume_link); ?>" class="btn-advance ld-primary-background"><?php echo $btn_advance_label; ?></a>
									</div>
								<?php
																																			}
																																		else :
								?>
								<div class="learndash_join_button <?php echo 'btn-advance-continue '; ?>"> <?php
																																			echo $learndash_payment_buttons; ?>
								</div>
								<?php
																																			if (!empty($course_price)) {
																																				echo '<span class="bb-course-type bb-course-type-paynow">' . wp_kses_post($course_pricing['price']) . '</span>';
																																			}
																																		endif;
																																	} elseif ($course_price_type == 'paynow' || $course_price_type == 'subscribe') {
																																		if (false === $is_enrolled) {
																																			$meta                = get_post_meta($course_id, '_sfwd-courses', true);
																																			$course_price_type   = @$meta['sfwd-courses_course_price_type'];
																																			$course_price        = @$meta['sfwd-courses_course_price'];
																																			$course_no_of_cycles = @$meta['sfwd-courses_course_no_of_cycles'];
																																			$course_price        = @$meta['sfwd-courses_course_price'];
																																			$custom_button_url   = @$meta['sfwd-courses_custom_button_url'];
																																			$custom_button_label = @$meta['sfwd-courses_custom_button_label'];

																																			if ($course_price_type == 'subscribe' && $course_price == '') {
																																				if (empty($custom_button_label)) {
																																					$button_text = LearnDash_Custom_Label::get_label('button_take_this_course');
																																				} else {
																																					$button_text = esc_attr($custom_button_label);
																																				}
																																				$join_button = '<div class="learndash_join_button"><form method="post">
									<input type="hidden" value="' . $course->ID . '" name="course_id" />
									<input type="hidden" name="course_join" value="' . wp_create_nonce('course_join_' . get_current_user_id() . '_' . $course->ID) . '" />
									<input type="submit" value="' . $button_text . '" class="btn-join" id="btn-join" /></form></div>';
																																				echo $join_button;
																																			} else {
																																				echo learndash_payment_buttons($course);
																																			}
																																		} else {
								?>
								<div class="learndash_join_button <?php echo $btn_advance_class; ?>">
									<a href="<?php echo esc_url($resume_link); ?>" class="btn-advance ld-primary-background"><?php echo $btn_advance_label; ?></a>
								</div><?php
																																		}

																																		if (apply_filters('learndash_login_modal', true, $course_id, $user_id) && !is_user_logged_in()) :
																																			echo '<span class="ld-status">' . __('or ', 'buddyboss-theme') . '<a class="ld-login-text" href="' . esc_attr($login_url) . '">' . __('Login', 'buddyboss-theme') . '</a></span>';
																																		endif;

																																		if (false === $is_enrolled) {
																																			if ($course_price_type == 'paynow') {
										?><span class="bb-course-type bb-course-type-paynow">
										<?php
																																				echo wp_kses_post('<span class="ld-currency">' . learndash_30_get_currency_symbol() . '</span> ');
																																				echo wp_kses_post($course_pricing['price']); ?></span>
								<?php
																																			} else {
																																				$course_price_billing_p3 = get_post_meta($course_id, 'course_price_billing_p3', true);
																																				$course_price_billing_t3 = get_post_meta($course_id, 'course_price_billing_t3', true);
																																				if ($course_price_billing_t3 == 'D') {
																																					$course_price_billing_t3 = 'day(s)';
																																				} elseif ($course_price_billing_t3 == 'W') {
																																					$course_price_billing_t3 = 'week(s)';
																																				} elseif ($course_price_billing_t3 == 'M') {
																																					$course_price_billing_t3 = 'month(s)';
																																				} elseif ($course_price_billing_t3 == 'Y') {
																																					$course_price_billing_t3 = 'year(s)';
																																				}
								?>
									<span class="bb-course-type bb-course-type-subscribe">
										<?php
																																				if ('' === $course_price && $course_price_type == 'subscribe') {
										?>
											<span class="bb-course-type bb-course-type-subscribe"><?php _e('Free', 'buddyboss-theme'); ?></span>
										<?php
																																				} else {
																																					echo wp_kses_post('<span class="ld-currency">' . learndash_30_get_currency_symbol() . '</span> ');
																																					echo wp_kses_post($course_pricing['price']);
																																				}

																																				$recuring = ('' === $course_price_billing_p3) ? 0 : $course_price_billing_p3;

																																				//if ( !empty( $course_price_billing_p3 ) ) { 
										?>
										<span class="course-bill-cycle"> / <?php echo $recuring . ' ' . $course_price_billing_t3; ?> </span><?php
																																				//} 
																																			?>
									</span>
						<?php
																																			}
																																		}
																																	} ?>
					</div>
				</div>
				<!-- end button -->

				<!-- <div class="bb-course-points">
					<a class="anchor-course-points" href="#learndash-course-content">
						<?php //echo sprintf(esc_html_x('View %s details', 'link: View Course details', 'buddyboss-theme'), LearnDash_Custom_Label::get_label('course')); 
						?>
						<i class="bb-icons bb-icon-chevron-down"></i>
					</a>
				</div> -->

				<?php
				// if (buddyboss_theme_get_option('learndash_course_author') || buddyboss_theme_get_option('learndash_course_date')) {
				// 	$bb_single_meta_pfx = 'bb_single_meta_pfx';
				// } else {
				// 	$bb_single_meta_pfx = 'bb_single_meta_off';
				// }
				?>

				<!-- <div class="bb-course-single-meta flex align-items-center <?php //echo $bb_single_meta_pfx; 
																				?>">
					<?php //if (buddyboss_theme_get_option('learndash_course_author')) { 
					?>
						<?php //if (class_exists('BuddyPress')) { 
						?>
							<a href="<?php //echo bp_core_get_user_domain($course->post_author); 
										?>">
							<? php // } else { 
							?>
								<a href="<?php //echo get_author_posts_url(get_the_author_meta('ID', $course->post_author), get_the_author_meta('user_nicename', $course->post_author)); 
											?>">
								<?php //} 
								?>
								<?php //echo get_avatar(get_the_author_meta('email', $course->post_author), 80); 
								?>
								<span class="author-name"><?php //the_author(); 
															?></span>
								</a>
							<?php //} 
							?>

				</div> -->

			</div>
		</div>
	</div>
</div>