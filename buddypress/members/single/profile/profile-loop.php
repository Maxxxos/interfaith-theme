<?php

/**
 * BuddyBoss - Members Profile Loop
 *
 * @since BuddyPress 3.0.0
 * @version 3.1.0
 */

$user_info = wp_get_current_user();
$edit_profile_link = trailingslashit(bp_displayed_user_domain() . bp_get_profile_slug() . '/edit');
$post_data = $wpdb->get_results("SELECT ID FROM $wpdb->posts WHERE user_id = " . $user_info->ID);
$post_id = $post_data[0]->ID;
?>
<?php if ((!isset($_GET['menu']) || empty($_GET['menu'])) || $_GET['menu'] == 'minister') { ?>
	<header class="entry-header profile-loop-header profile-header flex align-items-center">
		<h1 class="entry-title bb-profile-title"><?php esc_attr_e('Minister Profile', 'buddyboss-theme'); ?></h1>

		<?php if (bp_is_my_profile()) { ?>
			<a href="<?php echo $edit_profile_link; ?>" class="push-right button outline small"><?php esc_attr_e('Edit Profile', 'buddyboss-theme'); ?></a>
		<?php } ?>
	</header>
<?php } ?>
<?php if ($user_info->roles[0] == 'ministry' || $user_info->roles[0] == 'administrator' || $user_info->roles[0] == 'project_manager') :
?>
	<?php bp_nouveau_xprofile_hook('before', 'loop_content'); ?>

	<?php if (bp_has_profile()) : ?>

		<?php
		while (bp_profile_groups()) :
			bp_the_profile_group();
		?>

			<?php if (bp_profile_group_has_fields()) : ?>

				<?php bp_nouveau_xprofile_hook('before', 'field_content'); ?>

				<div class="bp-widget <?php bp_the_profile_group_slug(); ?>">

					<!-- <h3 class="screen-heading profile-group-title">
					<?php //bp_the_profile_group_name(); 
					?>
				</h3> -->
					<form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" enctype="multipart/form-data" id="profile-minister">
						<table class="profile-fields bp-tables-user <?php if (isset($_GET['menu']) && $_GET['menu'] == 'documents') {
																		echo 'mb-table';
																	} ?>">
							<?php if (isset($_GET['menu']) && $_GET['menu'] == 'documents') { ?>
								<!-- <tr>
									<th class="documents-title-table">Name</th>
									<th class="documents-title-table">Modified</th>
									<th class="documents-title-table" style="padding-left: 10px;">Visibility</th>
								</tr> -->
								<!-- <tr class=" visibility-public field_type_textbox">
									<td class="label documents-data" style="width: 100%"><svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M18.9346 5.83087L13.3097 0.206016C13.1785 0.0746719 12.9993 0 12.8125 0H2.96875C1.80564 0 0.859375 0.946266 0.859375 2.10938V21.8906C0.859375 23.0537 1.80564 24 2.96875 24H17.0312C18.1944 24 19.1406 23.0537 19.1406 21.8906V6.32812C19.1406 6.13641 19.0601 5.95636 18.9346 5.83087ZM13.5156 2.40061L16.74 5.625H14.2188C13.831 5.625 13.5156 5.30958 13.5156 4.92188V2.40061ZM17.0312 22.5938H2.96875C2.58105 22.5938 2.26562 22.2783 2.26562 21.8906V2.10938C2.26562 1.72167 2.58105 1.40625 2.96875 1.40625H12.1094V4.92188C12.1094 6.08498 13.0556 7.03125 14.2188 7.03125H17.7344V21.8906C17.7344 22.2783 17.419 22.5938 17.0312 22.5938Z" fill="black" />
											<path d="M14.2188 9.9375H5.78125C5.39294 9.9375 5.07812 10.2523 5.07812 10.6406C5.07812 11.0289 5.39294 11.3438 5.78125 11.3438H14.2188C14.6071 11.3438 14.9219 11.0289 14.9219 10.6406C14.9219 10.2523 14.6071 9.9375 14.2188 9.9375Z" fill="black" />
											<path d="M14.2188 12.75H5.78125C5.39294 12.75 5.07812 13.0648 5.07812 13.4531C5.07812 13.8414 5.39294 14.1562 5.78125 14.1562H14.2188C14.6071 14.1562 14.9219 13.8414 14.9219 13.4531C14.9219 13.0648 14.6071 12.75 14.2188 12.75Z" fill="black" />
											<path d="M14.2188 15.5625H5.78125C5.39294 15.5625 5.07812 15.8773 5.07812 16.2656C5.07812 16.6539 5.39294 16.9688 5.78125 16.9688H14.2188C14.6071 16.9688 14.9219 16.6539 14.9219 16.2656C14.9219 15.8773 14.6071 15.5625 14.2188 15.5625Z" fill="black" />
											<path d="M11.4062 18.375H5.78125C5.39294 18.375 5.07812 18.6898 5.07812 19.0781C5.07812 19.4664 5.39294 19.7812 5.78125 19.7812H11.4062C11.7946 19.7812 12.1094 19.4664 12.1094 19.0781C12.1094 18.6898 11.7946 18.375 11.4062 18.375Z" fill="black" />
										</svg>
										<p>Documents</p>
									</td>
									<td class="documents-data" style="width: 20%">
										<p>June 5, 2021</p>
									</td>
									<td class="documents-data" style="width: 20%">
										<p>Private</p>
									</td>
								</tr> -->
								<!-- <tr class="visibility-public field_type_textbox">
									<td class="label documents-data">
										<svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M18.9346 5.83087L13.3097 0.206016C13.1785 0.0746719 12.9993 0 12.8125 0H2.96875C1.80564 0 0.859375 0.946266 0.859375 2.10938V21.8906C0.859375 23.0537 1.80564 24 2.96875 24H17.0312C18.1944 24 19.1406 23.0537 19.1406 21.8906V6.32812C19.1406 6.13641 19.0601 5.95636 18.9346 5.83087ZM13.5156 2.40061L16.74 5.625H14.2188C13.831 5.625 13.5156 5.30958 13.5156 4.92188V2.40061ZM17.0312 22.5938H2.96875C2.58105 22.5938 2.26562 22.2783 2.26562 21.8906V2.10938C2.26562 1.72167 2.58105 1.40625 2.96875 1.40625H12.1094V4.92188C12.1094 6.08498 13.0556 7.03125 14.2188 7.03125H17.7344V21.8906C17.7344 22.2783 17.419 22.5938 17.0312 22.5938Z" fill="black" />
											<path d="M14.2188 9.9375H5.78125C5.39294 9.9375 5.07812 10.2523 5.07812 10.6406C5.07812 11.0289 5.39294 11.3438 5.78125 11.3438H14.2188C14.6071 11.3438 14.9219 11.0289 14.9219 10.6406C14.9219 10.2523 14.6071 9.9375 14.2188 9.9375Z" fill="black" />
											<path d="M14.2188 12.75H5.78125C5.39294 12.75 5.07812 13.0648 5.07812 13.4531C5.07812 13.8414 5.39294 14.1562 5.78125 14.1562H14.2188C14.6071 14.1562 14.9219 13.8414 14.9219 13.4531C14.9219 13.0648 14.6071 12.75 14.2188 12.75Z" fill="black" />
											<path d="M14.2188 15.5625H5.78125C5.39294 15.5625 5.07812 15.8773 5.07812 16.2656C5.07812 16.6539 5.39294 16.9688 5.78125 16.9688H14.2188C14.6071 16.9688 14.9219 16.6539 14.9219 16.2656C14.9219 15.8773 14.6071 15.5625 14.2188 15.5625Z" fill="black" />
											<path d="M11.4062 18.375H5.78125C5.39294 18.375 5.07812 18.6898 5.07812 19.0781C5.07812 19.4664 5.39294 19.7812 5.78125 19.7812H11.4062C11.7946 19.7812 12.1094 19.4664 12.1094 19.0781C12.1094 18.6898 11.7946 18.375 11.4062 18.375Z" fill="black" />
										</svg>
										Documents
									</td>
									<td class="documents-data">
										<p>June 5, 2021</p>
									</td>
									<td class="documents-data">
										<p>Private</p>
									</td>
								</tr> -->
							<?php } ?>
							<?php if ((!isset($_GET['menu']) || empty($_GET['menu'])) || $_GET['menu'] == 'minister') { ?>

								<tr class="field_4 field_email field_order_0 required-field visibility-public field_type_textbox">
									<td class="label">First Name</td>
									<td class="data">
										<?php $first_name = $user_info->first_name; ?>
										<p><input type="text" name="first-name" placeholder="" value="<?php echo $first_name ?? ''; ?>"></p>
									</td>
								</tr>
								<tr class="field_4 field_email field_order_0 required-field visibility-public field_type_textbox">
									<td class="label">Last Name</td>
									<td class="data">
										<?php $last_name = $user_info->last_name; ?>
										<p><input type="text" name="last-name" placeholder="" value="<?php echo $last_name ?? ''; ?>"></p>
									</td>
								</tr>
							<?php
							}
							?>
							<tr class="visibility-public field_type_textbox">
								<td class="label">Short BIO</td>
								<td class="data">
									<?php $short_bio = $user_info->short_bio; ?>
									<p><textarea rows="5" name="short-bio"><?php echo $short_bio  ?? ''; ?></textarea></p>
								</td>

							</tr>
							<tr class="visibility-public field_type_textbox">
								<td class="label">Location:</td>
								<td class="data">
									<?php $address = $user_info->country; ?>
									<p><input type="text" name="country" placeholder="" value="<?php echo $address ?? ''; ?>"></p>
								</td>
							</tr>
							<tr class="visibility-public field_type_textbox">
								<?php $serving = $user_info->serving; ?>
								<td class="label">Also serving:</td>
								<td class="data">
									<p><input type="text" name="serving" placeholder="" value="<?php echo $serving ?? ''; ?>"></p>
								</td>
							</tr>
							<tr class="visibility-public field_type_textbox">
								<td class="label">Qualifications:</td>
								<td class="data">
									<?php $qualifications = $user_info->qualifications; ?>
									<p><input type="text" name="qualifications" placeholder="" value="<?php echo $qualifications ?? ''; ?>"></p>
								</td>
							</tr>
							<tr class="visibility-public field_type_textbox">
								<td class="label">Available for:</td>
								<td class="data">
									<?php $available = $user_info->available; ?>
									<p><textarea rows="2" name="available"><?php echo $available  ?? ''; ?></textarea></p>
								</td>

							</tr>
							<tr class="visibility-public field_type_textbox">
								<td class="label">Online Services:</td>
								<td class="data">
									<?php $online_services = $user_info->online_services; ?>
									<p><input type="text" name="online-services" placeholder="" value="<?php echo $online_services ?? ''; ?>"></p>
								</td>
							</tr>
							<tr class="visibility-public field_type_textbox">
								<td class="label">Ordained in:</td>
								<td class="data">
									<?php $ordained = $user_info->ordained; ?>
									<p><input type="number" name="ordained" placeholder="" value="<?php echo $ordained ?? ''; ?>"></p>
								</td>
							</tr>
							<?php bp_nouveau_xprofile_hook('after', 'field_items'); ?>

						</table>
						<div class="gallery-wrap">
							<!-- begin  -->
							<div id="img-file-row" class="wrapper">
								<?php
								$post_id = 34227;
								$attachment_id = get_post_meta($post_id, 'minister_gallery');
								//update_post_meta($post_id, 'minister_gallery', 34486);
								// $delete_imgs_arr = [34486,34498];
								// var_dump($attachment_id_new);
								// //if (in_array($delete_imgs_arr, $attachment_id)) {
								//  	$attachment_id_new =  array_splice($attachment_id, 0, 7);
								//  var_dump($attachment_id);
									// for ($k = 0; $k < count($attachment_id_new); $k++) {
									// 	if ($k == 0) {
									// 		update_post_meta($post_id, 'minister_gallery', $attachment_id_new[$k]);
									// 	} else {
									// 		add_post_meta($post_id, 'minister_gallery', $attachment_id_new[$k]);
									// 	}
									// }
								//}
												for ($i = 0; $i < count($attachment_id); $i++) {
									if (!empty($attachment_id[$i])) {
										$img_bg[$i] = 'style="background-image:url(' . wp_get_attachment_image_url($attachment_id[$i], [270, 150]) . ')"';
								?>
										<div class="box not-empty">
											<span class="delete-img delete-img-this" data-id="<?php echo $attachment_id[$i]; ?>">+</span>
											<div class="js--image-preview" <?php echo $img_bg[$i] ?? ''; ?>></div>
											<div class="upload-options">
												<label>
													<input type="file" class="image-upload" accept="image/*" name="image-upload-<?php echo $i; ?>" />
												</label>
											</div>
										</div>
									<?php
									}
								}
								if (count($attachment_id) < 5) {
									for ($j = count($attachment_id); $j < 5; $j++) {
									?>
										<div class="box">
											<span class="delete-img delete-img-this">+</span>
											<div class="js--image-preview"></div>
											<div class="upload-options">
												<label>
													<input type="file" class="image-upload" accept="image/*" name="image-upload-<?php echo $j; ?>" />
												</label>
											</div>
										</div>
								<?php
									}
								}
								?>
								<div id="add-more-img" class="add-more-img">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<circle cx="12" cy="12" r="11.5" stroke="#870557" />
										<path d="M7.19922 12H16.7992" stroke="#870557" />
										<path d="M11.9993 7.2002L11.9993 16.8002" stroke="#870557" />
									</svg>
									<span>Add more</span>
								</div>
							</div>
							<!-- end -->
						</div>
						<input type="hidden" name="delete-img" id="delete-img">
						<input type="hidden" name="action" value="profile-ministry">
						<div class="form-btn_row">
							<input type="submit" id="btn-success" class="main-btn" name="submit" value="Update" />
						</div>
					</form>
				</div>
				<div class="testimonials-wrap">
					<?php

					//$post_id = 34277;

					$args = array(
						'comment_notes_after' => '',
						'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" class="comment-form" cols="45" rows="8" aria-required="true" placeholder="Ваш комментарий"></textarea></p>',
						'label_submit' => 'Отправить',
						'fields' => apply_filters('comment_form_default_fields', $fields)
					);
					?>
					<?php
					$query = new WP_Query([
						'post_type' => 'minister',
						'post__in' => [$post_id]
					]);
					if ($query->have_posts()) :
						while ($query->have_posts()) :
							$query->the_post();
							comments_template();

						endwhile; // End of the loop.

					endif;
					?>
					<form method="post" id="commentform" class="comment-form">
						<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="6" aria-required="true" placeholder="Write here your new testimonials ..."></textarea></p>
						<p><input type="text" name="comment-name" id="comment-name" placeholder="Put name of the client"></p>
						<p class=" add-site" id="add-site">
							<a id="submit-comment" class="main-btn" data-postId="<?php echo $post_id; ?>">Publish</a>
						</p>
						<p class="error__empty-fields">*Fill in the fields</p>
					</form>
				</div>

				<?php bp_nouveau_xprofile_hook('after', 'field_content'); ?>
				<?php //endif; 
				?>
			<?php endif; ?>

		<?php endwhile; ?>

		<?php bp_nouveau_xprofile_hook('', 'field_buttons'); ?>

	<?php else : ?>

		<div class="info bp-feedback">
			<span class="bp-icon" aria-hidden="true"></span>
			<p>
				<?php
				if (bp_is_my_profile()) {
					esc_html_e('You have not yet added details to your profile.', 'buddyboss-theme');
				} else {
					esc_html_e('This member has not yet added details to their profile.', 'buddyboss-theme');
				}
				?>
			</p>
		</div>

	<?php endif; ?>

<?php
endif;

bp_nouveau_xprofile_hook('after', 'loop_content');
