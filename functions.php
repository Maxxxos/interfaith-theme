<?php

add_action('wp_enqueue_scripts', 'my_scripts_method');
function my_scripts_method()
{
	wp_enqueue_style('style-owl', get_theme_file_uri()  . '/css/owl.carousel.min.css');
	wp_enqueue_style('style-owl-theme', get_theme_file_uri()  . '/css/owl.theme.default.min.css');
	wp_enqueue_script('script-owl', get_theme_file_uri()  . '/js/owl.carousel.min.js', array('jquery', 'jquery-core'), null, true);
	wp_enqueue_script('matchHeight', get_theme_file_uri()  . '/js/jquery.matchHeight-min.js', array('jquery'), null, true);
	wp_enqueue_script('child-script', get_theme_file_uri()  . '/js/script.js', array('jquery'), null, true);

	wp_enqueue_script('equalize', get_stylesheet_directory_uri() . '/js/equalize.js', array('jquery'));

	wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css');

	//wp_enqueue_script('google-map', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBFSCgv8k6moZ4e8q5l1M2EnGo0118fX7s&callback=initMap', array());
	wp_localize_script('child-script', 'ajax_posts', array(
		'ajaxurl' => admin_url('admin-ajax.php'), // WordPress AJAX
	));
}
function trim_characters($count, $after = '')
{
	$excerpt = get_the_content();
	$excerpt = strip_tags($excerpt);
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = mb_substr($excerpt, 0, $count);
	$excerpt = $excerpt . $after;
	return $excerpt;
}
add_action('wp_head', 'header_user', 99);
function header_user()
{
	global $user;
	$current_user = wp_get_current_user();

	if (!current_user_can('administrator')) {
		show_admin_bar(false);
?>
		<style>
			#wpadminbar {
				display: none !important;
			}

			html {
				margin-top: 0 !important;
			}

			#masthead {
				top: 0 !important;
			}

			@media screen and (max-width: 782px) {
				.admin-bar .bb-mobile-panel-wrapper {
					top: 0 !important;
					height: 100% !important;
				}

				a.bb-close-panel i {
					top: 20px !important;
				}
			}
		</style>
	<?php
	}
}

add_action('widgets_init', 'cr_register_sidebars');

function cr_register_sidebars()
{
	register_sidebar(array(
		'name'          => 'About page Sidebar',
		'id'            => 'about_sidebar',
		'description'   => '',
		'class'         => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget__inner">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>',
	));
}

add_action('wp_footer', 'add_form_login', 99);

function add_form_login()
{
	ob_start();
	?>
	<div class="popup-wrap" <?php if (isset($_GET['popup'])) {
								echo 'style="display: block;" ';
							} ?>>
		<div class="popup-overview">
			<div class="popup-block" id="login-form">
				<span id="popup-clouse" class="popup-block-close">+</span>
				<div class="popup-block__item1 color-bg">
					<div class="popup-logo__row">
						<img src="/wp-content/uploads/2021/09/image-11-1.png" alt="logo">
						<div class="popup-block__title">Welcome back!</div>
					</div>
				</div>
				<div class="popup-block__item2 form-sing-up">
					<div class="popup-form__row">
						<div id="btn-signup" class="signup">Sign up</div>
						<div class="rh_form__register" id="popup__form-1">

							<form method="post" id="login-form-popup">

								<div class="rh_form__row">
									<div class="rh_form__item rh_form--1-column rh_form--columnAlign">
										<label for="register_email"><?php esc_html_e('Email', 'framework'); ?><span></span></label>
										<input id="register_email" name="register_email" type="email" class="email required" title="<?php esc_html_e('* Provide valid email address!', 'framework'); ?>" required />
									</div>

								</div>

								<div class="rh_form__row">
									<div class="rh_form__item rh_form--1-column rh_form--columnAlign">
										<div class="login-agent__password-row">
											<label for="password"><?php esc_html_e('Password', 'framework'); ?><span></span></label>
											<a id="forgot-password" href=""><?php esc_html_e('Forgot password', 'framework') ?></a>
										</div>
										<span class="view-pass"></span>
										<input autocomplete="current-password" id="password-login-user" name="pwd" type="password" class="required" required />

									</div>

								</div>
								<div class="rh_form__row">
									<label class="label-remembe">
										<span class="checker" id="uniform-login-remember"><span><input type="checkbox" value="1" id="login-remember"></span>
								</div> Remember me
								</label>
						</div>
						<div class="rh_form__row">
							<div class="rh_form__item rh_input_btn_wrapper rh_form--3-column rh_form--columnAlign">

								<button type="submit" id="login-button-user" class="login-button"><?php esc_html_e('Log In', 'framework'); ?></button>
							</div>

						</div>
						<!-- /.rh_form__row -->

						<div class="rh_form__row">
							<div class="rh_form__item rh_form--1-column rh_form--columnAlign rh_form__response">
								<p id="login-message-user" class="rh_form__msg"></p>
							</div>

						</div>
						<!-- /.rh_form__row -->

						</form>
						<!-- /.rh_form__row -->

					</div>
					<div class="rh_form__register" id="popup__form-2">
						<div id="btn-login" class="signup">Log in</div>
						<form method="post" id="signup-form">
							<div class="rh_form__row-two">
								<div class="rh_form__row">
									<div class="rh_form__item rh_form--1-column rh_form--columnAlign">
										<label for="register_first-name"><?php esc_html_e('First name', 'framework'); ?><span></span></label>
										<input id="register_first-name" name="register_first-name" type="text" class="name-user required" title="<?php esc_html_e('* Provide valid name!', 'framework'); ?>" required />
									</div>

								</div>
								<div class="rh_form__row">
									<div class="rh_form__item rh_form--1-column rh_form--columnAlign">
										<label for="register_last-name"><?php esc_html_e('Last name', 'framework'); ?><span></span></label>
										<input id="register_last-name" name="register_last-name" type="text" class="name-user required" title="<?php esc_html_e('* Provide valid name!', 'framework'); ?>" required />
									</div>

								</div>
							</div>
							<div class="rh_form__row-two">
								<div class="rh_form__row">
									<div class="rh_form__item rh_form--1-column rh_form--columnAlign">
										<label for="register_mobile-phone"><?php esc_html_e('Mobile phone', 'framework'); ?><span></span></label>
										<input id="register_mobile-phone" name="register_mobile-phone" type="text" class="name-user required" title="<?php esc_html_e('* Provide valid phone!', 'framework'); ?>" required />
									</div>
								</div>
								<div class="rh_form__row">
									<div class="rh_form__item rh_form--1-column rh_form--columnAlign">
										<label for="register_email2"><?php esc_html_e('Email', 'framework'); ?><span></span></label>
										<input id="register_email2" name="register_email2" type="email" class="email required" title="<?php esc_html_e('* Provide valid email address!', 'framework'); ?>" required />
									</div>
								</div>
							</div>
							<div class="row-column">
								<div class="rh_form__row ">
									<input type="radio" id="contactChoice2" name="gender" value="male">
									<label for="contactChoice2">Male</label>
								</div>
								<div class="rh_form__row ">
									<input type="radio" id="contactChoice3" name="gender" value="female">
									<label for="contactChoice3">Femail</label>
								</div>
							</div>
							<div class="rh_form__row-two">
								<div class="rh_form__row">
									<div class="rh_form__item rh_form--1-column rh_form--columnAlign">
										<label for="register_country"><?php esc_html_e('Country', 'framework'); ?><span></span></label>
										<input id="register_country" name="register_country" type="text" class="country-user required" title="<?php esc_html_e('* Provide valid country!', 'framework'); ?>" required />
									</div>
								</div>
								<div class="rh_form__row">
									<div class="rh_form__item rh_form--1-column rh_form--columnAlign">
										<label for="register_zip"><?php esc_html_e('Zip code', 'framework'); ?><span></span></label>
										<input id="register_zip" name="register_zip" type="text" class="zip-user required" title="<?php esc_html_e('* Provide valid zip!', 'framework'); ?>" required />
									</div>
								</div>
							</div>
							<div class="rh_form__row-two">
								<div class="rh_form__row">
									<div class="rh_form__item rh_form--1-column rh_form--columnAlign">
										<label for="register_city"><?php esc_html_e('City', 'framework'); ?><span></span></label>
										<input id="register_city" name="register_city" type="text" class="city-user required" title="<?php esc_html_e('* Provide valid city!', 'framework'); ?>" required />
									</div>
								</div>
								<div class="rh_form__row">
									<div class="rh_form__item rh_form--1-column rh_form--columnAlign">
										<label for="register_street"><?php esc_html_e('Street', 'framework'); ?><span></span></label>
										<input id="register_street" name="register_street" type="text" class="street-user required" title="<?php esc_html_e('* Provide valid street!', 'framework'); ?>" required />
									</div>
								</div>
							</div>
							<div class="rh_form__row">
								<div class="rh_form__item rh_form--1-column rh_form--columnAlign">
									<div class="login-agent__password-row">
										<label for="password-signup-user"><?php esc_html_e('Password', 'framework'); ?><span></span></label>
										<a id="forgot-password" href=""><?php esc_html_e('Forgot password', 'framework') ?></a>
									</div>
									<span class="view-pass"></span>
									<input autocomplete="current-password" id="password-signup-user" name="password" type="password" class="required" required />

								</div>
							</div>
							<div class="rh_form__row">
								<div class="rh_form__item rh_input_btn_wrapper rh_form--3-column rh_form--columnAlign">

									<button type="submit" id="signup-button-user" class="login-button"><?php esc_html_e('Sign up', 'framework'); ?></button>
								</div>

							</div>
							<!-- /.rh_form__row -->

							<div class="rh_form__row">
								<div class="rh_form__item rh_form--1-column rh_form--columnAlign rh_form__response">
									<p id="singup-message-user" class="rh_form__msg"></p>
								</div>

							</div>
							<!-- /.rh_form__row -->

						</form>
						<!-- /.rh_form__row -->
					</div>
				</div>
			</div>
		</div>
		<div class="popup-block  <?php if (isset($_GET['popup']) && $_GET['popup'] == 'forgot-pass') {
										echo 'active';
									} ?>" id="custom-passreset">
			<span id="popup-clouse2" class="popup-block-close">+</span>
			<div class="popup-block__item1 color-bg">
				<div class="popup-logo__row">
					<img src="/wp-content/uploads/2021/09/image-11-1.png" alt="logo">
					<div class="popup-block__title">Forgot password?</div>
				</div>
			</div>
			<div class="popup-block__item2">
				<div class="signup-row">Not a member yet? <a id="signup">Sign Up</a></div>
				<div class="passreset-wrap">
					<?php echo do_shortcode('[custom_passreset]');
					?>
				</div>
			</div>
		</div>
	</div>
	</div>
<?php
}
add_action('wp_ajax_nopriv_signup_func', 'signup_func');
add_action('wp_ajax_signup_func', 'signup_func');

function signup_func()
{

	$first_name = sanitize_text_field(trim($_POST['first_name']));
	$last_name = sanitize_text_field(trim($_POST['last_name']));
	$mobile_phone = sanitize_text_field($_POST['mobile_phone']);
	$city = sanitize_text_field($_POST['city']);
	$country = sanitize_text_field($_POST['country']);
	$street = sanitize_text_field($_POST['street']);
	$gender = sanitize_text_field($_POST['gender']);
	$zip_code = sanitize_text_field($_POST['zip_code']);
	$email = sanitize_text_field(trim($_POST['email']));
	$password = sanitize_text_field(trim($_POST['login_password']));
	$username = $first_name . '_' . $last_name;

	$user_id = wp_create_user($first_name, $password, $email);

	update_user_meta($user_id, 'first_name', $first_name);
	update_user_meta($user_id, 'last_name', $last_name);
	global $wpdb;
	$wpdb->update(
		$wpdb->users,
		['mobile_phone' => $mobile_phone, 'user_roles' => 'subscriber', 'gender' => $gender, 'zip_code' => $zip_code, 'country' => $country, 'city' => $city, 'street' => $street,],
		['ID' => $user_id]
	);

	// add Knak
	// $url2 = 'https://api.knack.com/v1/objects/object_21/records';
	// $data2 = array(
	//     'field_181' => array(
	//         'first' => $first_name,
	//         'last' => $last_name,
	//     ),
	//     'field_182' => $email,
	//     'field_183' => md5($password),
	//     'field_185' => 'Student',
	//     'field_184' => 'active',
	//     'account_status' => 'active',
	//     'field_304' => ucfirst($gender),
	//     'field_409' => $mobile_phone, //контактный тел
	//     'field_263' => $mobile_phone,
	//     // 'field_264' => '333-33-33', //home phone
	//     //'field_259' => 'https://interfaith.sitepreview.app/wp-content/uploads/2021/10/Rectangle-55-2.jpg',
	//     //  'field_268' => '01/01/1978',
	//     //  'field_266' => 'England-test',
	//     'field_204' => array(
	//         'street' => $street,
	//         'city' => $city,
	//         'zip' => $zip_code,
	//         'country' => $country
	//     ),
	// );
	// $args2 = array(
	//     'headers' => array(
	//         "Content-type" => "application/json",
	//         'X-Knack-Application-ID' => '5b9e72d273ceb36d5e611a76',
	//         'X-Knack-REST-API-KEY' => '5d05e530-bb2d-11e8-afc6-e9e6b74e07a8'
	//     ),
	//     'body' => json_encode($data2),
	//     'timeout'     => 45,
	//     'redirection' => 5,
	//     // 'httpversion' => '1.0',
	//     // 'blocking'    => false
	// );


	//wp_remote_post($url2, $args2);

	wp_set_current_user($user_id);
	wp_set_auth_cookie($user_id);

	if (is_wp_error($user_id)) {
		$return = array('error' => $user_id->get_error_message());
	} else {
		$return = array('login' => get_user_meta($user_id, 'first_name'));
	}

	wp_send_json($return);
	die;
}

add_action('wp_ajax_nopriv_login_func', 'login_func');
add_action('wp_ajax_login_func', 'login_func');

function login_func()
{
	$user_data = array();
	$password = sanitize_text_field(trim($_POST['login_password']));
	if (!empty($_POST['login_remember'])) {
		$remember = sanitize_text_field($_POST['login_remember']);
	} else {
		$remember = 0;
	}
	$login_field = sanitize_text_field(trim($_POST['login_field']));

	$user_data['user_login'] = $login_field;
	$user_data['user_password'] = $password;
	$user_data['remember'] = $remember;

	$user = wp_signon($user_data, false);

	if ($user->get_error_message()) {
		$return = array('error' => $user->get_error_message());
	} else {
		$return = array('login' => $user->user_login);
	}

	wp_send_json($return);
	die;
}
// когда пользователь сам редактирует свой профиль
add_action('personal_options_update', 'true_save_profile_fields');
// когда чей-то профиль редактируется админом например
add_action('edit_user_profile_update', 'true_save_profile_fields');

function true_save_profile_fields($user_id)
{
	update_user_meta($user_id, 'name_agency', sanitize_text_field($_POST['name_agency']));
}

// форма восстановления пароля
add_shortcode('custom_passreset', 'misha_render_pass_reset_form'); // шорткод [custom_passreset]

function misha_render_pass_reset_form()
{

	// если пользователь авторизован, просто выводим сообщение и выходим из функции
	if (is_user_logged_in()) {
		return sprintf("You are already authorized on the site. <a href='%s'>Sign out</a>.", wp_logout_url());
	}

	$return = ''; // переменная, в которую всё будем записывать

	// обработка ошибок, если вам нужны такие же стили уведомлений, как в видео, CSS-код прикладываю чуть ниже
	if (isset($_REQUEST['errno'])) {
		$errors = explode(',', $_REQUEST['errno']);

		foreach ($errors as $error) {
			switch ($error) {
				case 'empty_username':
					$return .= '<p class="errno">You forgot to enter your email</p>';
					break;
				case 'password_reset_empty':
					$return .= '<p class="errno">Enter your password!</p>';
					break;
				case 'password_reset_mismatch':
					$return .= '<p class="errno">Password mismatch!</p>';
					break;
				case 'invalid_email':
				case 'invalidcombo':
					$return .= '<p class="errno">No user with the specified email was found on the site.</p>';
					break;
			}
		}
	}

	// тем, кто пришёл сюда по ссылке из email, показываем форму установки нового пароля
	if (isset($_REQUEST['login']) && isset($_REQUEST['key'])) {

		$return .= '<h3 class="lostpassword-title">Enter new password</h3>
            <form name="resetpassform" id="resetpassform" action="' . site_url('wp-login.php?action=resetpass') . '" method="post" autocomplete="off">
                <input type="hidden" id="user_login" name="login" value="' . esc_attr($_REQUEST['login']) . '" autocomplete="off" />
                <input type="hidden" name="key" value="' . esc_attr($_REQUEST['key']) . '" />

				<div class="rh_form__row form-row">
					<div class="rh_form__item rh_form--1-column rh_form--columnAlign">
						<label for="pass1">New password</label>
						<span class="view-pass"></span>
						    <input type="password" name="pass1" id="pass1" class="input" size="20" value="" autocomplete="off" />						
					</div>
				</div>
				<div class="rh_form__row form-row">
					<div class="rh_form__item rh_form--1-column rh_form--columnAlign">
						<label for="pass2">Confirm password</label>
						<span class="view-pass"></span>
                    	<input type="password" name="pass2" id="pass2" class="input" size="20" value="" autocomplete="off" />
						
					</div>
				</div>
                <p class="description lostpassword-description">' . wp_get_password_hint() . '</p>
 
				<div class="rh_form__row">
					<div class="rh_form__item rh_input_btn_wrapper rh_form--3-column rh_form--columnAlign resetpass-submit">
						 <input type="submit" name="submit" id="resetpass-button" class="button" value="Reset" />
					</div>
				</div>
            </form>';

		// возвращаем форму и выходим из функции
		return $return;
	}

	//всем остальным - обычная форма сброса пароля (1-й шаг, где указываем email)
	$return .= '
        <h3 class="lostpassword-title">Forgot password?</h3>
        <p class="lostpassword-description">Enter your email address, and we’ll send you a password reset link.</p>
        <form id="lostpasswordform" action="' . wp_lostpassword_url() . '" method="post">
				<div class="rh_form__row form-row">
					<div class="rh_form__item rh_form--1-column rh_form--columnAlign">
						<label for="register_email">E-mail<span></span></label>
						<input type="text" name="user_login" id="user_login">
					</div>
				</div>
				<div class="rh_form__row">
					<div class="rh_form__item rh_input_btn_wrapper rh_form--3-column rh_form--columnAlign lostpassword-submit">
						<input type="submit" name="submit" class="lostpassword-button" value="Reset" />
					</div>
				</div>
        </form>';

	//возвращаем форму и выходим из функции
	return $return;
}

/*
 * перенаправляем стандартную форму
 */
add_action('login_form_lostpassword', 'misha_pass_reset_redir');

function misha_pass_reset_redir()
{
	// если используете другой ярлык страницы сброса пароля, укажите здесь
	$forgot_pass_page_slug = '/?popup=forgot-pass';
	// если используете другой ярлык страницы входа, укажите здесь
	$login_page_slug = '/?popup=login';
	// если кто-то перешел на страницу сброса пароля
	// (!) именно перешел, а не отправил формой,
	// тогда перенаправляем на нашу кастомную страницу сброса пароля
	if ('GET' == $_SERVER['REQUEST_METHOD'] && !is_user_logged_in()) {
		wp_redirect(site_url($forgot_pass_page_slug));
		exit;
	} else if ('POST' == $_SERVER['REQUEST_METHOD']) {
		// если же напротив, была отправлена форма
		// юзаем retrieve_password()
		// которая отправляет на почту ссылку сброса пароля
		// пользователю, который указан в $_POST['user_login']
		$errors = retrieve_password();
		if (is_wp_error($errors)) {
			// если возникли ошибки, возвращаем пользователя назад на форму
			$to = site_url($forgot_pass_page_slug);
			$to = add_query_arg('errno', join(',', $errors->get_error_codes()), $to);
		} else {
			// если ошибок не было, перенаправляем на логин с сообщением об успехе
			$to = site_url($login_page_slug);
			$to = add_query_arg('errno', 'confirm', $to);
		}

		// собственно сам редирект
		wp_redirect($to);
		exit;
	}
}
/*
 * Манипуляции уже после перехода по ссылке из письма
 */
add_action('login_form_rp', 'misha_to_custom_password_reset');
add_action('login_form_resetpass', 'misha_to_custom_password_reset');

function misha_to_custom_password_reset()
{

	$key = $_REQUEST['key'];
	$login = $_REQUEST['login'];
	// если используете другой ярлык страницы сброса пароля, укажите здесь
	$forgot_pass_page_slug = '/?popup=forgot-pass';
	// если используете другой ярлык страницы входа, укажите здесь
	$login_page_slug = '/?popup=login';

	// проверку соответствия ключа и логина проводим в обоих случаях
	if (('GET' == $_SERVER['REQUEST_METHOD'] || 'POST' == $_SERVER['REQUEST_METHOD'])
		&& isset($key) && isset($login)
	) {

		$user = check_password_reset_key($key, $login);

		if (!$user || is_wp_error($user)) {
			if ($user && $user->get_error_code() === 'expired_key') {
				wp_redirect(site_url($login_page_slug . '?errno=expiredkey'));
			} else {
				wp_redirect(site_url($login_page_slug . '?errno=invalidkey'));
			}
			exit;
		}
	}

	if ('GET' == $_SERVER['REQUEST_METHOD']) {

		$to = site_url($forgot_pass_page_slug);
		$to = add_query_arg('login', esc_attr($login), $to);
		$to = add_query_arg('key', esc_attr($key), $to);

		wp_redirect($to);
		exit;
	} elseif ('POST' == $_SERVER['REQUEST_METHOD']) {

		if (isset($_POST['pass1'])) {

			if ($_POST['pass1'] != $_POST['pass2']) {
				// если пароли не совпадают
				$to = site_url($forgot_pass_page_slug);

				$to = add_query_arg('key', esc_attr($key), $to);
				$to = add_query_arg('login', esc_attr($login), $to);
				$to = add_query_arg('errno', 'password_reset_mismatch', $to);

				wp_redirect($to);
				exit;
			}

			if (empty($_POST['pass1'])) {
				// если поле с паролем пустое
				$to = site_url($forgot_pass_page_slug);

				$to = add_query_arg('key', esc_attr($key), $to);
				$to = add_query_arg('login', esc_attr($login), $to);
				$to = add_query_arg('errno', 'password_reset_empty', $to);

				wp_redirect($to);
				exit;
			}

			// тут кстати вы можете задать и свои проверки, например, чтобы длина пароля была 8 символов
			// с паролями всё окей, можно сбрасывать
			reset_password($user, $_POST['pass1']);
			wp_redirect(site_url($login_page_slug . '?errno=changed'));
		} else {
			// если что-то пошло не так
			echo "Error";
		}

		exit;
	}
}
// add Postal address user
add_action('show_user_profile', 'true_show_profile_fields');
// когда чей-то профиль редактируется админом например
add_action('edit_user_profile', 'true_show_profile_fields');

function true_show_profile_fields($user)
{
	global $wpdb;
	$user_data = $wpdb->get_results("SELECT * FROM $wpdb->users WHERE ID = " . $user->ID);
	$user_meta = get_userdata($user->ID);
	echo '<table class="form-table" style="margin-bottom: 60px; margin-top: 60px;"><tbody><tr class="user-email-wrap">';
	$date = date("Y-m-d");
	$date = strtotime($date);
	$date = strtotime("-18 year", $date);
	$max_date =  date('Y-m-d', $date);
	$select_female = '';
	$select_male = '';
	if (esc_attr($user_data[0]->gender) == "female") {
		$select_female = 'selected';
	} else {
		$select_male = 'selected';
	}
	echo
	'<th><label for="user_class">Learner status</label></th>
    <td><p><input type="text" name="status" id="user_status" value="' . esc_attr($user_data[0]->status) . '" class="regular-text" /></p></td></tr>
    <tr><th><label for="user_class">Class</label></th>
    <td><p><input type="text" name="class" id="user_class" value="' . esc_attr($user_data[0]->class) . '" class="regular-text" /></p></td></tr>
    <tr><th><label for="user_mobile_phone">Mobile Phone</label></th>
    <td><p><input type="text" name="mobile_phone" id="user_mobile_phone" value="' . esc_attr($user_data[0]->mobile_phone) . '" class="regular-text" /></p></td></tr>
    <tr><th><label for="user_home_phone">Home Phone</label></th>
    <td><p><input type="text" name="home_phone" id="user_home_phone" value="' . esc_attr($user_data[0]->home_phone) . '" class="regular-text" /></p></td></tr>
    <tr><th><label for="user_nation">Nation</label></th>
    <td><p><input type="text" name="nation" id="user_nation" value="' . esc_attr($user_data[0]->nation) . '" class="regular-text" /></p></td></tr>
 	<tr><th><label for="user_d_o_b">Gender</label></th>
    <td><p><select name="gender" class="regular-text">	
        <option value="male" '  . $select_male . '>Male</option>
        <option value="female"' . $select_female . '>Female</option>
    </select></p></td></tr>
    <th><label for="user_d_o_b">Birthday</label></th>
    <td><p><input type="date" name="d_o_b" id="user_d_o_b" value="' . esc_attr($user_data[0]->d_o_b) . '" class="regular-text" max="' . $max_date . '" /></p></td></tr>
    <tr><th><label for="user_address">Postal address</label></th>
    <td><p><input type="text" name="address" id="user_address" value="' . esc_attr($user_data[0]->address) . '" class="regular-text" /></p></td></tr>
    <tr><th><label for="zip-code">Zip code</label></th>
    <td><p><input type="text" name="zip_code" id="zip-code" value="' . esc_attr($user_data[0]->zip_code) . '" class="regular-text" /></p></td></tr>
    <tr><th><label for="country">Country</label></th>
    <td><p><input type="text" name="country" id="country" value="' . esc_attr($user_data[0]->country) . '" class="regular-text" /></p></td></tr>
    <tr><th><label for="city">City</label></th>
    <td><p><input type="text" name="city" id="city" value="' . esc_attr($user_data[0]->city) . '" class="regular-text" /></p></td></tr>
    <tr><th><label for="street">Street</label></th>
    <td><p><input type="text" name="street" id="street" value="' . esc_attr($user_data[0]->street) . '" class="regular-text" /></p></td></tr>
    <td><p><input type="hidden" name="knack_id" id="knack-id" value="' . esc_attr($user_data[0]->knack_id) . '" class="regular-text" /></p></td></tr>';
	if ($user_meta->roles[0] == 'ministry' || $user_meta->roles[0] == 'administrator' || $user_meta->roles[0] == 'project_manager') {
		echo '<th><label for="user_class">Short BIO</label></th>
    	<td><p><textarea rows="5" name="short-bio" class="regular-text">' . esc_attr($user_data[0]->short_bio) . '</textarea></p></td></tr>
		<th><label for="user_class">Also serving</label></th>
    	<td><p><input type="text" name="serving" id="serving" value="' . esc_attr($user_data[0]->serving) . '" class="regular-text" /></p></td></tr>
		<th><label for="user_class">Qualifications:</label></th>
    	<td><p><input type="text" name="qualifications" id="qualifications" value="' . esc_attr($user_data[0]->qualifications) . '" class="regular-text" /></p></td></tr>
		<th><label for="user_class">Available for:</label></th>
    	<td><p><textarea rows="2" name="available" class="regular-text">' . esc_attr($user_data[0]->available) . '</textarea></p></td></tr>
		<th><label for="user_class">Online Services:</label></th>
    	<td><p><input type="text" name="online-services" id="online-services" value="' . esc_attr($user_data[0]->online_services) . '" class="regular-text" /></p></td></tr>
		<th><label for="user_class">Ordained in:</label></th>
    	<td><p><input type="number" name="ordained" id="ordained" value="' . esc_attr($user_data[0]->ordained) . '" class="regular-text" /></p></td></tr>
		';
	}
	echo '</tbody></table>';
}
// когда пользователь сам редактирует свой профиль
add_action('personal_options_update', 'true_save_profile_address');
// когда чей-то профиль редактируется админом например
add_action('edit_user_profile_update', 'true_save_profile_address');

function true_save_profile_address($user_id)
{
	global $wpdb;

	$wpdb->update(
		$wpdb->users,
		array(
			'status' => sanitize_text_field($_POST['status']),
			'nation' => sanitize_text_field($_POST['nation']),
			'gender' => sanitize_text_field($_POST['gender']),
			'class' => sanitize_text_field($_POST['class']),
			'home_phone' => sanitize_text_field($_POST['home_phone']),
			'mobile_phone' => sanitize_text_field($_POST['mobile_phone']),
			'address' => sanitize_text_field($_POST['address']),
			'd_o_b' => sanitize_text_field($_POST['d_o_b']),
			'zip_code' => sanitize_text_field($_POST['zip_code']),
			'country' => sanitize_text_field($_POST['country']),
			'city' => sanitize_text_field($_POST['city']),
			'street' => sanitize_text_field($_POST['street']),
			'short_bio' => sanitize_text_field($_POST['short-bio']),
			'serving' => sanitize_text_field($_POST['serving']),
			'qualifications' => sanitize_text_field($_POST['qualifications']),
			'available' => sanitize_text_field($_POST['available']),
			'online_services' => sanitize_text_field($_POST['online-services']),
			'ordained' => sanitize_text_field($_POST['ordained'])

		),
		array('ID' => $user_id)
	);

	// edit page minister
	$user_data = get_userdata($user_id);
	if ($user_data->roles[0] == 'ministry') {
		$post_id = $wpdb->get_results("SELECT ID FROM $wpdb->posts WHERE user_id = $user_id");

		$wpdb->update(
			$wpdb->posts,
			[
				'post_title' => $_POST['first_name'] . ' ' . $_POST['last_name'],
			],
			['user_id' => $user_id]
		);
		$post_id = $wpdb->get_results("SELECT ID FROM $wpdb->posts WHERE user_id = $user_id");
		$attachment_id = get_user_meta($user_id, 'mm_sua_attachment_id', true);

		if (empty($attachment_id->errors)) {
			set_post_thumbnail($post_id, $attachment_id);
		}
	}

	//обновить данные в Кнак
	if (isset($_POST['email']) && !empty($_POST['email'])) {
		//id для обновления записи $user->id;

		//$data_user = $wpdb->get_results("SELECT knack_id, user_roles FROM $wpdb->users WHERE ID = $user_id");
		$data_user = get_userdata($user_id);
		if ($data_user->roles[0] == 'ministry') {
			$url_user = 'https://api.knack.com/v1/objects/object_19/records/' . $data_user->knack_id;
			$data = array(
				'field_172' => sanitize_text_field($_POST['email']),
			);
		} else {
			$url_user = 'https://api.knack.com/v1/objects/object_21/records/' . $data_user->knack_id;
			$data = array(
				'field_182' => sanitize_text_field($_POST['email']),
			);
		}
		$args2 = array(
			'headers' => array(
				"Content-type" => "application/json",
				'X-Knack-Application-ID' => '5b9e72d273ceb36d5e611a76',
				'X-Knack-REST-API-KEY' => '5d05e530-bb2d-11e8-afc6-e9e6b74e07a8'
			),
			'body' => json_encode($data),
			'timeout'     => 45,
			'redirection' => 5,
			'method' => 'PUT'
		);
		wp_remote_request($url_user, $args2);
	}
}


add_action('admin_post_nopriv_profile-ministry', 'edit_profile_ministry');
add_action('admin_post_profile-ministry', 'edit_profile_ministry');

function edit_profile_ministry()
{
	require_once(ABSPATH . 'wp-admin/includes/image.php');
	require_once(ABSPATH . 'wp-admin/includes/file.php');
	require_once(ABSPATH . 'wp-admin/includes/media.php');

	$user_info = wp_get_current_user();
	$user_id = $user_info->ID;

	$first_name = sanitize_text_field($_POST['first-name']) ?? '';
	$last_name = sanitize_text_field($_POST['last-name']) ?? '';
	$country = sanitize_text_field($_POST['country']) ?? '';
	$short_bio = sanitize_text_field($_POST['short-bio']) ?? '';
	$serving = sanitize_text_field($_POST['serving']) ?? '';
	$qualifications = sanitize_text_field($_POST['qualifications']) ?? '';
	$available = sanitize_text_field($_POST['available']) ?? '';
	$online_services = sanitize_text_field($_POST['online-services'])  ?? '';
	$ordained = sanitize_text_field($_POST['ordained']) ?? '';

	global $wpdb;

	$wpdb->update(
		$wpdb->users,
		array(
			'country' => $country,
			'short_bio' => $short_bio,
			'serving' => $serving,
			'qualifications' => $qualifications,
			'available' => $available,
			'online_services' => $online_services,
			'ordained' => (int) $ordained,
		),
		array('ID' => $user_id)
	);
	if (!empty($first_name)) {
		update_user_meta($user_id, 'first_name', $first_name);
	}
	if (!empty($last_name)) {
		update_user_meta($user_id, 'last_name', $last_name);
	}

	$post_data = $wpdb->get_results("SELECT ID FROM $wpdb->posts WHERE user_id = " . $user_id);
	//$post_id = $post_data[0]->ID;
	$post_id = 34227;

	if (isset($_POST['delete-img']) && !empty($_POST['delete-img'])) {
		$delete_imgs = $_POST['delete-img'];
		$delete_imgs_arr = explode("|", $delete_imgs);
		//if (in_array($delete_imgs_arr, $attachment_id)) {
		$attachment_id_new =  array_diff($attachment_id, $delete_imgs_arr);
		for ($k = 0; $k < count($attachment_id_new); $k++) {
			if ($k == 0) {
				update_post_meta($post_id, 'minister_gallery', $attachment_id_new[$k]);
			} else {
				add_post_meta($post_id, 'minister_gallery', $attachment_id_new[$k]);
			}
		}
		//}
	}

	//start
	if (isset($_FILES) && !empty($_FILES)) {
		if (!empty($_FILES['image-upload-0']['name'])) {
			$attachment_id = media_handle_upload('image-upload-0', $post_last_id);
			update_post_meta($post_id, 'minister_gallery', $attachment_id);
		}
		if (!empty($_FILES['image-upload-1']['name'])) {
			$attachment_id1 = media_handle_upload('image-upload-1', $post_last_id);
			add_post_meta($post_id, 'minister_gallery', intval($attachment_id1));
		}
		if (!empty($_FILES['image-upload-2']['name'])) {
			$attachment_id2 = media_handle_upload('image-upload-2', $post_last_id);
			add_post_meta($post_id, 'minister_gallery', intval($attachment_id2));
		}
		if (!empty($_FILES['image-upload-3']['name'])) {
			$attachment_id3 = media_handle_upload('image-upload-3', $post_last_id);
			add_post_meta($post_id, 'minister_gallery', intval($attachment_id3));
		}
		if (!empty($_FILES['image-upload-4']['name'])) {
			$attachment_id4 = media_handle_upload('image-upload-4', $post_last_id);
			add_post_meta($post_id, 'minister_gallery', intval($attachment_id4));
		}
		if (!empty($_FILES['image-upload-5']['name'])) {
			$attachment_id5 = media_handle_upload('image-upload-5', $post_last_id);
			add_post_meta($post_id, 'minister_gallery', intval($attachment_id5));
		}
		if (!empty($_FILES['image-upload-6']['name'])) {
			$attachment_id6 = media_handle_upload('image-upload-6', $post_last_id);
			add_post_meta($post_id, 'minister_gallery', intval($attachment_id6));
		}
		if (!empty($_FILES['image-upload-7']['name'])) {
			$attachment_id7 = media_handle_upload('image-upload-7', $post_last_id);
			add_post_meta($post_id, 'minister_gallery', intval($attachment_id7));
		}
		if (!empty($_FILES['image-upload-8']['name'])) {
			$attachment_id8 = media_handle_upload('image-upload-8', $post_last_id);
			add_post_meta($post_id, 'minister_gallery', intval($attachment_id8));
		}
		if (!empty($_FILES['image-upload-9']['name'])) {
			$attachment_id9 = media_handle_upload('image-upload-9', $post_last_id);
			add_post_meta($post_id, 'minister_gallery', intval($attachment_id9));;
		}
		if (!empty($_FILES['image-upload-10']['name'])) {
			$attachment_id10 = media_handle_upload('image-upload-10', $post_last_id);
			add_post_meta($post_id, 'minister_gallery', intval($attachment_id10));
		}
		if (!empty($_FILES['image-upload-11']['name'])) {
			$attachment_id11 = media_handle_upload('image-upload-11', $post_last_id);
			add_post_meta($$post_id, 'minister_gallery', intval($attachment_id11));
		}
		if (!empty($_FILES['image-upload-12']['name'])) {
			$attachment_id12 = media_handle_upload('image-upload-12', $post_last_id);
			add_post_meta($post_id, 'minister_gallery', intval($attachment_id12));
		}
		if (!empty($_FILES['image-upload-13']['name'])) {
			$attachment_id13 = media_handle_upload('image-upload-13', $post_last_id);
			add_post_meta($post_id, 'minister_gallery', intval($attachment_id13));
		}
		if (!empty($_FILES['image-upload-14']['name'])) {
			$attachment_id14 = media_handle_upload('image-upload-14', $post_last_id);
			add_post_meta($$post_id, 'minister_gallery', intval($attachment_id14));
		}
		if (!empty($_FILES['image-upload-15']['name'])) {
			$attachment_id15 = media_handle_upload('image-upload-15', $post_last_id);
			add_post_meta($post_id, 'minister_gallery', intval($attachment_id15));
		}
		if (!empty($_FILES['image-upload-16']['name'])) {
			$attachment_id16 = media_handle_upload('image-upload-16', $post_last_id);
			update_post_meta($post_id, 'minister_gallery', intval($attachment_id16));
		}
		if (!empty($_FILES['image-upload-17']['name'])) {
			$attachment_id17 = media_handle_upload('image-upload-17', $post_last_id);
			update_post_meta($post_id, 'minister_gallery', intval($attachment_id17));
		}
		if (!empty($_FILES['image-upload-18']['name'])) {
			$attachment_id18 = media_handle_upload('image-upload-18', $post_last_id);
			update_post_meta($post_id, 'minister_gallery', intval($attachment_id18));
		}
		if (!empty($_FILES['image-upload-19']['name'])) {
			$attachment_id19 = media_handle_upload('image-upload-19', $post_last_id);
			update_post_meta($post_id, 'minister_gallery', intval($attachment_id19));
		}
		if (!empty($_FILES['image-upload-20']['name'])) {
			$attachment_id20 = media_handle_upload('image-upload-20', $post_last_id);
			update_post_meta($post_id, 'minister_gallery', intval($attachment_id20));
		}
		if (!empty($_FILES['image-upload-21']['name'])) {
			$attachment_id21 = media_handle_upload('image-upload-21', $post_last_id);
			update_post_meta($post_id, 'minister_gallery', intval($attachment_id21));
		}
		if (!empty($_FILES['image-upload-22']['name'])) {
			$attachment_id22 = media_handle_upload('image-upload-22', $post_last_id);
			update_post_meta($post_id, 'minister_gallery', intval($attachment_id22));
		}
		if (!empty($_FILES['image-upload-23']['name'])) {
			$attachment_id23 = media_handle_upload('image-upload-23', $post_last_id);
			update_post_meta($post_id, 'minister_gallery', intval($attachment_id23));
		}
		if (!empty($_FILES['image-upload-24']['name'])) {
			$attachment_id24 = media_handle_upload('image-upload-24', $post_last_id);
			update_post_meta($post_id, 'minister_gallery', intval($attachment_id24));
		}
		if (!empty($_FILES['image-upload-25']['name'])) {
			$attachment_id25 = media_handle_upload('image-upload-25', $post_last_id);
			update_post_meta($post_id, 'minister_gallery', intval($attachment_id25));
		}
	}
	//end

	if ($_FILES) {
		$files = $_FILES["listing-image"];
		//die(var_dump($files));

		foreach ($files['name'] as $key => $value) {
			if ($files['name'][$key] && !in_array($files['name'][$key], $delete_img_arr)) {
				$file = array(
					'name' => $files['name'][$key],
					'type' => $files['type'][$key],
					'tmp_name' => $files['tmp_name'][$key],
					'error' => $files['error'][$key],
					'size' => $files['size'][$key]
				);
				$_FILES = array("listing-image" => $file);

				foreach ($_FILES as $file => $array) {
					if (!in_array($file["name"], $delete_img_arr)) {
						$newupload = kv_handle_attachment($file, $pid);
						if ($i == 0) {
							update_post_meta($post_last_id, '_thumbnail_id', $newupload);
						}
						if ($i >= 0) {
							$wpdb->insert(
								'minister_gallery',
								[
									'listing_id' => $post_last_id,
									'attribute' => 'gallery',
									'value' => $newupload,

								],
							);
						}
						$i++;
					}
				}
			}
		}
	}

	if ($user_info->roles[0] == 'ministry') {
		$headers = array(
			'content-type: text/html',
		);

		$admin_email = get_option('admin_email');
		$message = '<table style="border: none; font-size: 16px;">
					<tr><td style="width: 150px; margin: 20px; text-align:right; paddign-right:10px;"><b>Name Ministry</b></td> <td>' . $first_name . ' ' . $last_name . '</td>	</tr>				
					<tr><td style="width: 150px;  margin: 20px; text-align:right; paddign-right:10px;"><b>Email &nbsp;</b></td><td>' . $user_info->user_email . '</td></tr>				
					<tr><td style="width: 150px;  margin: 20px; text-align:right; paddign-right:10px;"><b>Date & time &nbsp;</b></td> <td>' . current_time('d.m.Y H:i') . '</td></tr>
				</table>';
		$them_message = 'Minister profile edited - ' . $first_name . ' ' . $last_name;
		wp_mail($admin_email, $them_message, $message, $headers);
	}

?> <script>
		window.location = "/members/<?php echo $user_info->user_login; ?>/";
	</script>
	<?php
	die;
}

function kv_handle_attachment($file_handler, $post_id, $set_thu = false)
{
	// check to make sure its a successful upload
	if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();

	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	require_once(ABSPATH . "wp-admin" . '/includes/media.php');

	$attach_id = media_handle_upload($file_handler, $post_id);

	// If you want to set a featured image frmo your uploads. 
	if ($set_thu) set_post_thumbnail($post_id, $attach_id);
	return $attach_id;
}

function website_name()
{
	$site_name = 'OneSpirit Interfaith Foundation';
	return $site_name;
}

add_filter('wp_mail_from_name', 'website_name');


add_shortcode('courses', 'get_courses');
function get_courses($attr)
{

	ob_start();

	global $wpdb;

	$datas = $wpdb->get_results("SELECT object_id FROM $wpdb->term_relationships WHERE term_taxonomy_id = 36");
	$cpd_courses_id = [];
	foreach ($datas as $data) {
		array_push($cpd_courses_id, $data->object_id);
	}
	if ($attr['col'] == '3') {
		$text_btn = 'Discover more';

		$args = array(
			'post_type' => 'sfwd-courses',
			'post_status' => 'publish',
			'posts_per_page' => 3,
			'post__not_in' => $cpd_courses_id,
			'orderby' => 'DESC'
		);
	} else {
		$text_btn = 'Learn more';

		$args = array(
			'post_type' => 'sfwd-courses',
			'post_status' => 'publish',
			'posts_per_page' => 2,
			'post__in' => $cpd_courses_id,
			'orderby' => 'DESC'
		);
	}

	$query = new WP_Query($args);

	// Цикл
	if ($query->have_posts()) {
		$i = 0;
		while ($query->have_posts()) {
			$query->the_post(); ?>
			<div class="courses-item">
				<div class="courses-item__wrap">
					<?php
					if (has_post_thumbnail()) {
						$img_url = get_the_post_thumbnail_url();
					} else {
						$img_url = '/wp-content/uploads/2021/09/images.png';
					}
					?>
					<?php
					if ($attr['col'] == 2) {
						$date = new DateTime($user_info->user_registered);
						if (!empty(get_field('course_starting'))) :
					?>
							<div class="date-course"><?php the_field('course_starting'); ?></div>
					<?php
						endif;
					}
					?>

					<img src="<?php echo $img_url; ?>" alt="<?php the_title(); ?>" class="resize-img-<?php echo $attr['col']; ?> <?php if ($attr['col'] == 2) echo 'resize-img'; ?>">
					<div class="width-block">
						<h5 class="title-<?php echo $attr['col']; ?>"><?php the_title(); ?></h5>
						<p><?php echo strip_tags(get_the_excerpt()); ?></p>
						<a class="main-btn" href="<?php the_permalink(); ?>"><?php echo $text_btn; ?></a>
					</div>
				</div>
			</div>
	<?php
			$i++;
		}
	} else {
		echo 'No courses';
	}
	wp_reset_postdata();
	?>
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode('posts-row', 'get_posts_row');
function get_posts_row($attr)
{

	ob_start();
	$text_btn = 'Learn more';

	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => 3,
		'tag__not_in' => [56, 57, 58, 59],
		'orderby' => 'DESC'
	);

	$query = new WP_Query($args);

	// Цикл
	if ($query->have_posts()) {
		$i = 0;
		while ($query->have_posts()) {
			$query->the_post(); ?>
			<div class="courses-item">
				<div class="courses-item__wrap">
					<?php
					if (has_post_thumbnail()) {
						$img_url = get_the_post_thumbnail_url();
					} else {
						$img_url = '/wp-content/uploads/2021/09/images.png';
					}
					?>
					<img src="<?php echo $img_url; ?>" alt="<?php the_title(); ?>" class="resize-img-3">
					<div class="width-block">
						<h5 class="title-3"><?php the_title(); ?></h5>
						<p><?php echo strip_tags(get_the_excerpt()); ?></p>
						<a class="main-btn" href="<?php the_permalink(); ?>"><?php echo $text_btn; ?></a>
					</div>
				</div>
			</div>
	<?php
			$i++;
		}
	} else {
		echo 'No posts';
	}
	wp_reset_postdata();
	?>
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}


function dynamic_page()
{
	ob_start();

	$user_info = wp_get_current_user();
	$page_slug = 'members/' . $user_info->user_login . '/dashbord/';
	$uri       = $_SERVER['REQUEST_URI'];
	$path      = wp_parse_url($uri, PHP_URL_PATH);
	if ('/' . trailingslashit($page_slug) === trailingslashit($path)) {
		get_header();
		// Output here any content.
	?>
		<div class="account__sitebar-menu">
			<ul class="account__sitebar-list">
				<li class="selected"><a href="/members/<?php echo $user_info->user_login; ?>/dashbord/"><span class="img-dashbord"></span>Dashboard</a></li>
				<li><a href="/members/<?php echo $user_info->user_login; ?>/my-courses/"><span class="img-courses"></span>My Courses</a></li>
				<?php if ($user_info->roles[0] == 'student' || $user_info->roles[0] == 'administrator') : ?>
					<li><a href="/members/<?php echo $user_info->user_login; ?>/my-classmates/"><span class="classmates"></span>My Classmates</a></li>
				<?php endif; ?>
				<?php if ($user_info->roles[0] == 'ministry' || $user_info->roles[0] == 'administrator' || $user_info->roles[0] == 'associate') : ?>
					<li><a href="/members/<?php echo $user_info->user_login; ?>/my-forums/"><span class="img-forum"></span>Forum</a></li>
					<?php if ($user_info->roles[0] != 'associate') : ?>
						<li><a href="/members/<?php echo $user_info->user_login; ?>/"><span class="img-profile"></span>My profile</a></li>
					<?php endif; ?>
				<?php endif; ?>
				<li><a href="/members/<?php echo $user_info->user_login; ?>/settings/"><span class="img-settings"></span>Account Settings</a></li>
				<li class="logout"><a href="<?php echo esc_url(wp_logout_url(home_url())); ?>"><span class="img-logout"></span>Log Out</a></li>
			</ul>
		</div>
		<div id="primary" class="content-area bs-bp-container">
			<main id="main" class="site-main">
				<div id="account-menu__toggle">My Student Dashboard</div>
				<article id="post-24" class="bp_members type-bp_members post-24 page type-page status-publish hentry">
					<div class="entry-content">
						<div id="buddypress" class="buddypress-wrap bp-dir-hori-nav">
							<div id="item-header" role="complementary" data-bp-item-id="1" data-bp-item-component="members" class="users-header single-headers">

								<div id="cover-image-container">


									<div id="header-cover-image" class="cover-<?php echo $profile_cover_height; ?> <?php echo 'width-' . $profile_cover_width; ?> <?php echo $has_cover_image_position;
																																									echo $has_cover_image; ?>">
										<?php

										if (!empty($cover_image_url)) {
											echo '<img class="header-cover-img" src="' . esc_url($cover_image_url) . '"' . ('' !== $cover_image_position ? ' data-top="' . $cover_image_position . '"' : '') . ('' !== $cover_image_position ? ' style="top: ' . $cover_image_position . 'px"' : '') . ' />';
										} elseif (!empty($default_cover_image['url'])) {
											echo '<img class="header-cover-img" src="' . esc_url($default_cover_image['url']) . '"' . ('' !== $cover_image_position ? ' data-top="' . $cover_image_position . '"' : '') . ('' !== $cover_image_position ? ' style="top: ' . $cover_image_position . 'px"' : '') . ' />';
										}
										?>

										<?php if (bp_is_my_profile()) { ?>

											<?php if (!empty($cover_image_url) || !empty($default_cover_image['url'])) { ?>
												<a href="#" class="position-change-cover-image" data-balloon-pos="right" data-balloon="<?php _e('Reposition Cover Ppage_menuo', 'buddyboss-theme'); ?>">
													<span class="dashicons dashicons-move"></span>
												</a>
												<div class="header-cover-reposition-wrap">
													<a href="#" class="button small cover-image-cancel"><?php _e('Cancel', 'buddyboss-theme'); ?></a>
													<a href="#" class="button small cover-image-save"><?php _e('Save Changes', 'buddyboss-theme'); ?></a>
													<span class="drag-element-helper"><i class="bb-icon-menu"></i><?php _e('Drag to move cover ppage_menuo', 'buddyboss-theme'); ?></span>
													<?php if (!empty($cover_image_url)) { ?>
														<img src="<?php echo esc_url($cover_image_url);  ?>" alt="<?php _e('Cover ppage_menuo', 'buddyboss-theme'); ?>" />
													<?php } elseif (!empty($default_cover_image['url'])) { ?>
														<img src="<?php echo esc_url($default_cover_image['url']);  ?>" alt="<?php _e('Cover ppage_menuo', 'buddyboss-theme'); ?>" />
													<?php } ?>

												</div>
											<?php } ?>

										<?php } ?>
									</div>


									<div id="item-header-cover-image" class="item-header-wrap bb-enable-cover-img">
										<?php

										// $user_img_id = get_user_meta(get_current_user_id(), 'mm_sua_attachment_id', true);
										// $user_img = wp_get_attachment_url($user_img_id);

										$code_img = get_avatar_url(get_current_user_id());
										$user_img_arr = explode('"', $code_img);
										$user_img = $user_img_arr[0];

										if (empty($user_img)) {
											$user_img = '/wp-content/plugins/buddyboss-platform/bp-core/images/mystery-man.jpg';
										}
										?>
										<div id="item-header-avatar">
											<img loading="lazy" src="<?php echo $user_img; ?>" class="avatar user-1-avatar avatar-300 ppage_menuo" width="300" height="300" alt="Profile ppage_menuo of wpdev">
										</div><!-- #item-header-avatar -->

										<div id="item-header-content">
											<div class="flex">
												<div class="bb-user-content-wrap">
													<div class="flex align-items-center member-title-wrap">
														<h2 class="user-nicename"><?php echo $user_info->user_login; ?></h2>
													</div>
													<div class="item-meta">
														<span class="mention-name"><a href="mailto:<?php echo $user_info->user_email; ?>"><?php echo $user_info->user_email; ?></a></span>
														<span class="activity"><?php echo $user_info->first_name . ' ' . $user_info->last_name; ?></span>
													</div>
													<div class="flex align-items-center">
													</div>
												</div>

											</div>

										</div><!-- #item-header-content -->

									</div><!-- #item-header-cover-image -->
								</div><!-- #cover-image-container -->
							</div>
							<div class="post-container">
								<?php
								$args = array(
									'post_type' => 'post',
									'post_status' => 'publish',
									'posts_per_page' => -1,
									'orderby' => 'DESC',
									'tag' => $user_info->roles[0]
								);
								$query = new WP_Query($args);
								$i = 0;
								while ($query->have_posts()) {
									$query->the_post();

									if (has_post_thumbnail()) {
										$img_url = get_the_post_thumbnail_url();
									} else {
										$img_url = '/wp-content/uploads/2021/09/images.png';
									}

								?>
									<div class="post-item <?php if ($i % 2 != 0) {
																echo 'row-reverse';
															} ?>">
										<div class="post-item__content">
											<h4><?php the_title(); ?></h4>
											<div class="date-post"><?php echo get_the_date('F j, Y'); ?></div>
											<p><?php echo wp_strip_all_tags(get_the_content()); ?></p>
										</div>
										<div class="post-item__img" style="background-image: url(<?php echo $img_url; ?>);">
										</div>
									</div>
									<?php $i++; ?>
								<?php } ?>
							</div>
							<?php
							global $wpdb;

							$datas = $wpdb->get_results("SELECT object_id FROM $wpdb->term_relationships WHERE term_taxonomy_id = 36");
							$cpd_courses_id = [];
							foreach ($datas as $data) {
								array_push($cpd_courses_id, $data->object_id);
							}

							$arr_course_user = [];
							$user_id = get_current_user_id();
							$datas_user = get_user_meta($user_id, '_sfwd-course_progress');
							if (!empty($datas_user)) :
							?>
								<div class="section-pickup">
									<div class="section-pickup-title">
										<h2>Pick up where you left off</h2>
									</div>
									<div class="slider-course">
										<?php
										foreach ($datas_user as $data_user) {

											foreach ($data_user as $key => $value) {
												if (!in_array($key, $cpd_courses_id)) {
													array_push($arr_course_user, $key);
												}
											}

											// user last course

											$args = array(
												'post_type' => 'sfwd-courses',
												'post_status' => 'publish',
												'posts_per_page' => -1,
												'post__in' => $arr_course_user,
												'orderby' => 'DESC'
											);

											$query = new WP_Query($args);
											// Цикл
											if ($query->have_posts()) {
												echo '<div class="owl-carousel owl-theme" id="dashbord-slider">';
												$query->the_post();
										?>
												<?php
												if (has_post_thumbnail()) {
													$img_url = get_the_post_thumbnail_url();
												} else {
													$img_url = '/wp-content/uploads/2021/09/images.png';
												}
												?>

												<div class="item">
													<div class="slider-course__img slider-course__item" style="background-image: url(<?php echo $img_url; ?>);"></div>
													<div class="slider-course__content slider-course__item">
														<?php
														$this_course_id = get_the_ID();
														// data lessons this courses in progress
														$datas_user = $wpdb->get_results("SELECT meta_value FROM $wpdb->usermeta WHERE meta_key = '_sfwd-course_progress' ");
														$data_user_lessons = maybe_unserialize($datas_user[0]->meta_value);
														foreach ($data_user_lessons as $key => $value) {
															if ($key == $this_course_id) {
																$course_progress_id = $value['last_id'];
																$course_total = $value['total'];

																$i = 1;
																foreach ($value['lessons'] as $key => $value) {
																	if ($key !==  $course_progress_id) {
																		$i++;
																	} else {
																		break;
																	}
																}

																$progress_num = ($i * 100) / $course_total;
																$progress_max = 314 - ($progress_num * 3.14);
																$progress_min = $progress_num * 3.14;
															}
														}
														// end code lessons this courses in progress
														?>
														<div class="course-progress">

															<svg id="svg1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="50" height="50" viewBox="0 0 120 120">
																<!-- Фон серого цвета       -->
																<rect width="100%" height="100%" fill="#fff" />
																<!-- Путь заполнения линии прогрессбара     -->
																<circle cx="60" cy="60" r="50" fill="none" stroke="#fafafa" stroke-width="10" />
																<circle cx="60" cy="60" r="50" transform="rotate(-90 60 60)" fill="none" stroke-dashoffset="314" stroke-dasharray="<?php echo $progress_min; ?>, <?php echo $progress_max; ?>" stroke="#FF6800" stroke-width="8">
																	<!-- Анимация изменения длины черты stroke-dasharray от нуля до максимума 314 -->
																	<animate attributeName="stroke-dasharray" dur="4s" begin="svg1.click" values="0,314;314,0" fill="freeze" />
																</circle>
																<text id="count" x="50%" y="50%" fill="#FF6800" text-anchor="middle" dy="7" font-size="25"><?php echo round($progress_num, 1); ?>%</text>

															</svg>
														</div>

														<div>
															<span>Lesson <?php echo $i; ?> to Journeys of the Soul Course</span>
															<h4><?php echo get_the_title($course_progress_id); ?></h4>
															<div clas="slider-course__content"><?php echo strip_tags(get_the_excerpt()); ?></div>
															<a href="<?php echo get_the_permalink($course_progress_id); ?>" class="slider-course-link">Continue Course</a>
														</div>
													</div>
												</div>

										<?php
											}
											wp_reset_postdata();
										} ?>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<div class="section-new-courses-user">
						<h2>New courses</h2>
						<div class="new-courses-user-wrap">
							<?php
							global $wpdb;
							$datas = $wpdb->get_results("SELECT object_id FROM $wpdb->term_relationships WHERE term_taxonomy_id = 36");
							$courses_id = [];
							foreach ($datas as $data) {
								array_push($courses_id, $data->object_id);
							}

							$args = array(
								'post_type' => 'sfwd-courses',
								'post_status' => 'publish',
								'posts_per_page' => 2,
								'post__not_in' => $courses_id,
								'orderby' => 'DESC',
							);
							$query = new WP_Query($args);
							?>
							<?php while ($query->have_posts()) {
								$query->the_post(); ?>
								<div class="new-courses-user-item">
									<?php
									if (has_post_thumbnail()) {
										$img_url = get_the_post_thumbnail_url();
									} else {
										$img_url = '/wp-content/uploads/2021/09/images.png';
									}
									?>
									<img src="<?php echo $img_url; ?>" alt="<?php the_title(); ?>" class="new-courses-img">
									<div class="courses-user-description">
										<div class="courses-user-date"><?php echo get_the_date('F Y'); ?></div>
										<div class="courses-user-tile-row">
											<h4><?php the_title(); ?></h4>
											<a href="<?php the_permalink(); ?>" class="courses-user-link">Enroll</a>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
		</div>
		</div>
		</div>
		</div>
		</article>
		</main><!-- #main -->
		</div>
	<?php
		get_footer('account');
		exit;
	}
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
	exit;
}

add_action('init', 'dynamic_page');

// page 3
function dynamic_page3()
{
	ob_start();
	$user_info = wp_get_current_user();
	$page_slug = 'members/' . $user_info->user_login . '/my-courses/';
	$uri       = $_SERVER['REQUEST_URI'];
	$path      = wp_parse_url($uri, PHP_URL_PATH);

	if ('/' . trailingslashit($page_slug) === trailingslashit($path)) {
		get_header();
		// Output here any content.
	?>
		<div id="account-menu__toggle">My Student Dashboard</div>
		<div class="account__sitebar-menu">
			<ul class="account__sitebar-list">
				<li><a href="/members/<?php echo $user_info->user_login; ?>/dashbord/"><span class="img-dashbord"></span>Dashboard</a></li>
				<li class="selected"><a href="/members/<?php echo $user_info->user_login; ?>/my-courses/"><span class="img-courses"></span>My Courses</a></li>
				<?php if ($user_info->roles[0] == 'student' || $user_info->roles[0] == 'administrator') : ?>
					<li><a href="/members/<?php echo $user_info->user_login; ?>/my-classmates/"><span class="classmates"></span>My Classmates</a></li>
				<?php endif; ?>
				<?php if ($user_info->roles[0] == 'ministry' || $user_info->roles[0] == 'administrator' || $user_info->roles[0] == 'associate') : ?>

					<li><a href="/members/<?php echo $user_info->user_login; ?>/my-forums/"><span class="img-forum"></span>Forum</a></li>
					<?php if ($user_info->roles[0] != 'associate') : ?>
						<li><a href="/members/<?php echo $user_info->user_login; ?>/"><span class="img-profile"></span>My profile</a></li>
					<?php endif; ?>
				<?php endif; ?>
				<li><a href="/members/<?php echo $user_info->user_login; ?>/settings/"><span class="img-settings"></span>Account Settings</a></li>
				<li class="logout"><a href="<?php echo esc_url(wp_logout_url(home_url())); ?>"><span class="img-logout"></span>Log Out</a></li>
			</ul>
		</div>

		<div id="primary" class="content-area bs-bp-container">
			<main id="main" class="site-main">
				<div class="dashbord-my-course-row">
					<div class="dashbord-my-course__item">
						<h1 class="new-page-dashbord__title">My Courses</h1>
					</div>
					<div class="dashbord-my-course__item item-last">
						<select name="course-progress" class="course-progress" id="select-sortby">
							<option value="all">All</option>
							<option value="in-progress" <?php selected($_GET['ld-status'], 'in-progress'); ?>>In progress</option>
							<option value="completed" <?php selected($_GET['ld-status'], 'completed'); ?>>Completed</option>
							<!-- <option value="expired">Expired</option> -->
						</select>
					</div>
				</div>
				<article class="bp_members type-bp_members post-24 page type-page status-publish hentry">
					<div id="course-dir-list" class="course-dir-list bs-dir-list my-course-page">
						<?php
						global $wpdb;

						$datas = $wpdb->get_results("SELECT object_id FROM $wpdb->term_relationships WHERE term_taxonomy_id = 36");
						$cpd_courses_id = [];
						foreach ($datas as $data) {
							array_push($cpd_courses_id, $data->object_id);
						}

						$arr_course_user = [];
						$user_id = get_current_user_id();
						$datas_user = get_user_meta($user_id, '_sfwd-course_progress');

						// echo '<pre>';
						// var_dump($datas_user);
						// echo '</pre>';

						foreach ($datas_user as $data_user) {
							// условие отображения курсов
							foreach ($data_user as $key => $value) {
								if (!in_array($key, $cpd_courses_id) && ($user_info->roles[0] != 'ministry' || $user_info->roles[0] != 'administrator' || $user_info->roles[0] != 'associate')) {
									array_push($arr_course_user, $key);
								} else {
									array_push($arr_course_user, $key);
								}
							}

							$args = array(
								'post_type' => 'sfwd-courses',
								'post_status' => 'publish',
								'posts_per_page' => -1,
								'post__in' => $arr_course_user,
								'orderby' => 'DESC',
							);

							$query = new WP_Query($args);
							// Цикл
							if ($query->have_posts()) { ?>
								<ul class="bb-course-list bb-course-items grid-view bb-grid">
									<?php while ($query->have_posts()) {
										$query->the_post();  ?>
										<?php

										$course_id = $this_course_id = get_the_ID();
										// data lessons this courses in progress
										$datas_user = $wpdb->get_results("SELECT meta_value FROM $wpdb->usermeta WHERE meta_key = '_sfwd-course_progress' ");
										$data_user_lessons = maybe_unserialize($datas_user[0]->meta_value);
										$course_pricing = learndash_get_course_price($course_id);

										/**
										 * Action to add custom content inside the breadcrumbs (before)
										 *
										 * @since 3.0
										 */
										do_action('learndash-course-infobar-access-progress-before', get_post_type(), $course_id, $user_id);

										$progress_bar = learndash_get_template_part('modules/progress.php', array(
											'context'   =>  'course',
											'user_id'   =>  $user_id,
											'course_id' =>  $course_id
										), false);

										/**
										 * Action to add custom content inside the breadcrumbs before the progress bar
										 *
										 * @since 3.0
										 */
										do_action('learndash-course-infobar-access-progress-before', get_post_type(), $course_id, $user_id);

										/**
										 * Action to add custom content inside the breadcrumbs after the progress bar
										 *
										 * @since 3.0
										 */
										do_action('learndash-course-infobar-access-progress-after', get_post_type(), $course_id, $user_id);
										$status = learndash_course_status_legacy($course_id, $user_id,  true);
										if ('completed' == $status) {
											$status_str = 'Completed';
											$class = 'ld-status-complete ld-secondary-background';
										} else if ('in-progress' == $status) {
											$status_str = 'Progress';
											$class = 'ld-status-in-progress';
										}
										$i = 0;
										if (isset($_GET['ld-status']) && !empty($_GET['ld-status']) && $_GET['ld-status'] == $status) :

										?>
											<li class="bb-course-item-wrap">
												<div class="bb-cover-list-item ">
													<div class="bb-course-cover">
														<a title="MINISTRY TRAINING" href="https://interfaith.sitepreview.app/courses/ministry-training/" class="bb-cover-wrap">
															<div class="ld-status <?php echo $class ?? ''; ?>"><?php echo $status_str ?? ''; ?></div>

															<img width="300" height="218" src="https://interfaith.sitepreview.app/wp-content/uploads/2021/09/image-5-1-300x218.jpg" class="attachment-medium size-medium wp-post-image" alt="" loading="lazy" srcset="https://interfaith.sitepreview.app/wp-content/uploads/2021/09/image-5-1-300x218.jpg 300w, https://interfaith.sitepreview.app/wp-content/uploads/2021/09/image-5-1.jpg 400w" sizes="(max-width: 300px) 100vw, 300px">
														</a>
													</div>

													<div class="bb-card-course-details bb-card-course-details--hasAccess">
														<?php $count_lessons = get_post_meta(get_the_ID(), '_ld_course_steps_count', true); ?>
														<div class="course-lesson-count"><?php echo $count_lessons; ?> Lesson<?php if ($count_lessons > 1) {
																																	echo 's';
																																} ?>
														</div>
														<h2 class="bb-course-title">
															<a title="MINISTRY TRAINING" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
														</h2>

														<div class="course-progress-wrap">

															<div class="ld-course-status ld-course-status-enrolled">

																<?php
																echo $progress_bar;
																$course_status = learndash_course_status($course_id, $user_id, true);

																if ('in-progress' === $course_status) {
																	$course_status = 'progress';
																}
																//learndash_status_bubble($course_status);

																/**
																 * Action to add custom content inside the breadcrumbs after the status
																 *
																 * @since 3.0
																 */
																do_action('learndash-course-infobar-access-status-after', get_post_type(), $course_id, $user_id); ?>

															</div>

														</div>


														<div class="bb-course-excerpt">
															Curious about spiritual development and leadership? Our 2 year Spiritual Development and Ministry Training may be for you
														</div>

													</div>
												</div>
											</li>
											<?php $i++; ?>
										<?php elseif (!isset($_GET['ld-status']) || $_GET['ld-status'] == 'all') :
										?><li class="bb-course-item-wrap">
												<div class="bb-cover-list-item ">
													<div class="bb-course-cover">
														<a title="MINISTRY TRAINING" href="https://interfaith.sitepreview.app/courses/ministry-training/" class="bb-cover-wrap">
															<div class="ld-status <?php echo $class ?? ''; ?>"><?php echo $status_str ?? ''; ?></div>

															<img width="300" height="218" src="https://interfaith.sitepreview.app/wp-content/uploads/2021/09/image-5-1-300x218.jpg" class="attachment-medium size-medium wp-post-image" alt="" loading="lazy" srcset="https://interfaith.sitepreview.app/wp-content/uploads/2021/09/image-5-1-300x218.jpg 300w, https://interfaith.sitepreview.app/wp-content/uploads/2021/09/image-5-1.jpg 400w" sizes="(max-width: 300px) 100vw, 300px">
														</a>
													</div>

													<div class="bb-card-course-details bb-card-course-details--hasAccess">
														<?php $count_lessons = get_post_meta(get_the_ID(), '_ld_course_steps_count', true); ?>
														<div class="course-lesson-count"><?php echo $count_lessons; ?> Lesson<?php if ($count_lessons > 1) {
																																	echo 's';
																																} ?>
														</div>
														<h2 class="bb-course-title">
															<a title="MINISTRY TRAINING" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
														</h2>

														<div class="course-progress-wrap">

															<div class="ld-course-status ld-course-status-enrolled">

																<?php
																echo $progress_bar;
																$course_status = learndash_course_status($course_id, $user_id, true);

																if ('in-progress' === $course_status) {
																	$course_status = 'progress';
																}
																//learndash_status_bubble($course_status);

																/**
																 * Action to add custom content inside the breadcrumbs after the status
																 *
																 * @since 3.0
																 */
																do_action('learndash-course-infobar-access-status-after', get_post_type(), $course_id, $user_id); ?>

															</div>

														</div>


														<div class="bb-course-excerpt">
															Curious about spiritual development and leadership? Our 2 year Spiritual Development and Ministry Training may be for you
														</div>

													</div>
												</div>
											</li>
										<?php elseif (isset($_GET['ld-status']) && !empty($_GET['ld-status']) && $_GET['ld-status'] != $status && $i == 0) : ?>
											<li>
												<div class="no-courses">
													<p>No courses</p>
												</div>
											</li>
										<?php break;
										endif; ?>

									<?php } ?>
								</ul>
						<?php
							} else {
								echo '<div class="no-courses"><p>No courses</p></div>';
							}
							wp_reset_postdata();
						}
						if (empty($datas_user)) {
							echo '<div class="no-courses" style="margin-top: 0;"><p>No courses</p></div>';
						}
						?>
					</div>
					</aticle>
			</main>
		</div>
	<?php
		get_footer('account');
		exit;
	}
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
	exit;
}

add_action('init', 'dynamic_page3');

// page 4
function dynamic_page4()
{
	ob_start();
	$user_info = wp_get_current_user();
	$page_slug = 'members/' . $user_info->user_login . '/my-forums';
	$uri       = $_SERVER['REQUEST_URI'];
	$path      = wp_parse_url($uri, PHP_URL_PATH);

	if ('/' . trailingslashit($page_slug) === trailingslashit($path)) {
		get_header();
		// Output here any content.
	?>
		<div id="account-menu__toggle">My Student Dashboard</div>
		<div class="account__sitebar-menu">
			<ul class="account__sitebar-list">
				<li><a href="/members/<?php echo $user_info->user_login; ?>/dashbord/"><span class="img-dashbord"></span>Dashboard</a></li>
				<li><a href="/members/<?php echo $user_info->user_login; ?>/my-courses/"><span class="img-courses"></span>My Courses</a></li>
				<?php if ($user_info->roles[0] == 'student' || $user_info->roles[0] == 'administrator') : ?>
					<li><a href="/members/<?php echo $user_info->user_login; ?>/my-classmates/"><span class="classmates"></span>My Classmates</a></li>
				<?php endif; ?>
				<?php if ($user_info->roles[0] == 'ministry' || $user_info->roles[0] == 'administrator' || $user_info->roles[0] == 'associate') : ?>

					<li class="selected"><a href="/members/<?php echo $user_info->user_login; ?>/my-forums/"><span class="img-forum"></span>Forum</a></li>
					<?php if ($user_info->roles[0] != 'associate') : ?>
						<li><a href="/members/<?php echo $user_info->user_login; ?>/"><span class="img-profile"></span>My profile</a></li>
					<?php endif; ?>
				<?php endif; ?>
				<li><a href="/members/<?php echo $user_info->user_login; ?>/settings/"><span class="img-settings"></span>Account Settings</a></li>
				<li class="logout"><a href="<?php echo esc_url(wp_logout_url(home_url())); ?>"><span class="img-logout"></span>Log Out</a></li>
			</ul>
		</div>
		<div id="primary" class="content-area bs-bp-container dashbord-forums-page">
			<main id="main" class="site-main">
				<div class="dashbord-forums-slide" style="background-image: url(/wp-content/themes/interfaith-theme/images/forums-bg.jpg); ">
					<h1 class="forums-slide__title">Here you can find answers and ask questions </h1>
					<?php get_search_form(); ?>
				</div>
				<article class="bp_members type-bp_members post-24 page type-page status-publish hentry">
					<div id="course-dir-list" class="course-dir-list bs-dir-list my-course-page my-forums-page">
						<?php
						global $wpdb;

						$datas = $wpdb->get_results("SELECT object_id FROM $wpdb->term_relationships WHERE term_taxonomy_id = 36");
						$cpd_courses_id = [];
						foreach ($datas as $data) {
							array_push($cpd_courses_id, $data->object_id);
						}

						$arr_course_user = [];
						$user_id = get_current_user_id();
						// $datas_user = get_user_meta($user_id, '_sfwd-course_progress');

						//foreach ($datas_user as $data_user) {

						// foreach ($data_user as $key => $value) {
						//     if (!in_array($key, $cpd_courses_id)) {
						//         array_push($arr_course_user, $key);
						//     }
						// }

						$args = array(
							'post_type' => 'forum',
							'post_status' => 'publish',
							'posts_per_page' => 9,
							'orderby' => 'DESC',
						);

						$query = new WP_Query($args);

						// Цикл
						if ($query->have_posts()) { ?>
							<ul class="bb-course-list bb-course-items grid-view bb-grid">
								<?php while ($query->have_posts()) {
									$query->the_post();
									//var_dump($query);
								?>

									<li class="item-forum-list"><a href="<?php the_permalink(); ?>">
											<?php
											if (has_post_thumbnail()) {
												$url_img = get_the_post_thumbnail_url();
											} else {
												$url_img = '/wp-content/themes/interfaith-theme/images/forum-img.jpg';
											}
											?>
											<div class="item-forum forum-list-img" style="background-image: url(<?php echo $url_img ?? ''; ?>); ">
												<h4><?php the_title(); ?></h4>
												<h6><?php the_content(); ?></h6>
											</div>
										</a>
									</li>

								<?php } ?>
							</ul>
						<?php
						} else {
							echo 'No courses';
						}
						wp_reset_postdata();
						//  }
						?>
					</div>
					</aticle>
					<?php do_action('bbp_template_before_user_topics_created'); ?>

					<div class="section-second-dashbord page-my-forums">
						<div class="item-forum">
							<?php do_action('bbp_template_before_topics_loop'); ?>

							<ul id="bbp-forum-<?php bbp_forum_id(); ?>" class="bbp-topics1 bs-item-list bs-forums-items list-view page-dashbord">

								<li class="bs-item-wrap bs-header-item align-items-center no-hover-effect">
									<div class="flex-1 item-forum-bock">
										<h4>All discussions</h4>
									</div>
								</li>
								<?php
								$user_id = get_current_user_id();
								$data_user = $wpdb->get_results("SELECT * FROM m9s_users WHERE  ID = " . $user_id);
								$args = array(
									'post_type' => 'topic',
									'post_status' => 'publish',
									'posts_per_page' => -1,
									'post_author' => $user_id,
									'orderby' => 'DESC'
								);

								$query = new WP_Query($args);
								// Цикл


								if ($query->have_posts()) {
									while ($query->have_posts()) :
										$query->the_post();

										//bbp_get_template_part('loop', 'topic-list'); 
								?>
										<li>
											<div class="bs-item-wrap ">
												<div class="flex flex-1">
													<div class="item-avatar bb-item-avatar-wrap">
														<img src="<?php echo get_avatar_url($user_id); ?>" alt="user foto">
													</div>
													<div class="item">
														<div class="item-title">
															<a href="<?php the_permalink(); ?>"><?php the_content(); ?></a>
														</div>
														<?php
														$voice_count = bbp_get_topic_voice_count(bbp_get_topic_id());
														$voice_text = $voice_count > 1 ? __('Members', 'buddyboss-theme') : __('Member', 'buddyboss-theme');

														$topic_reply_count = bbp_get_topic_reply_count(bbp_get_topic_id());
														$topic_post_count = bbp_get_topic_post_count(bbp_get_topic_id());
														$topic_reply_text = '';
														?>
														<div class="item-meta bb-reply-meta">
															<div>
																<a href="<?php the_permalink();
																			?>"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
																		<path d="M15.5268 7.31284C14.5623 4.91404 11.9582 3.71461 7.71422 3.71461H5.71425V1.42893C5.71425 1.27407 5.65767 1.14013 5.54462 1.02708C5.43151 0.913963 5.2977 0.857391 5.14287 0.857391C4.988 0.857391 4.85406 0.913963 4.74101 1.02708L0.169622 5.59844C0.056572 5.71165 0 5.84553 0 6.0003C0 6.15503 0.056572 6.28891 0.169622 6.40205L4.74104 10.9735C4.85422 11.0865 4.98816 11.1433 5.1429 11.1433C5.2976 11.1433 5.43151 11.0866 5.54465 10.9735C5.65774 10.8605 5.71428 10.7266 5.71428 10.5718V8.28592H7.71425C8.29745 8.28592 8.8197 8.30368 9.28097 8.33933C9.74221 8.37507 10.2008 8.43906 10.656 8.53144C11.1114 8.62369 11.5073 8.75006 11.8437 8.91093C12.1799 9.0718 12.4939 9.27857 12.7857 9.53144C13.0774 9.78456 13.3155 10.085 13.5001 10.4333C13.6845 10.7816 13.8289 11.1936 13.9331 11.6698C14.0372 12.1461 14.0894 12.6848 14.0894 13.2858C14.0894 13.6131 14.0744 13.9793 14.0448 14.384C14.0448 14.4196 14.0374 14.4896 14.0224 14.5938C14.0076 14.6981 14.0001 14.7768 14.0001 14.8303C14.0001 14.9195 14.0254 14.9939 14.0759 15.0535C14.1266 15.1129 14.1966 15.1426 14.2859 15.1426C14.3811 15.1426 14.4644 15.0921 14.5359 14.9909C14.5774 14.9373 14.6159 14.8718 14.6519 14.7944C14.6876 14.7171 14.7279 14.6278 14.7724 14.5266C14.8172 14.4254 14.8484 14.3542 14.8662 14.3125C15.622 12.6163 16 11.2741 16 10.2859C16 9.10154 15.8423 8.11035 15.5268 7.31284Z" fill="#C0C0C0" />
																	</svg></a>
																<span class="bbp-topic-freshness-author user-name-forum"><?php echo $data_user[0]->user_nicename; ?></span>
																<span class="bs-replied">
																	replied <span><?php bbp_topic_freshness_link(); ?></span></span>
																<span class="bs-voices-wrap">
															</div>
															<div>
																<span class="bs-voices"><?php bbp_topic_voice_count(); ?> <?php echo $voice_text; ?></span>
																<span class="bs-separator">·</span>
																<span class="bs-replies"><?php
																							if (bbp_show_lead_topic()) {
																								bbp_topic_reply_count();
																								$topic_reply_text = $topic_reply_count > 1 ? __('Replies', 'buddyboss-theme') : __('Reply', 'buddyboss-theme');
																							} else {
																								bbp_topic_post_count();
																								$topic_reply_text = $topic_post_count > 1 ? __('Replies', 'buddyboss-theme') : __('Reply', 'buddyboss-theme');
																							}
																							?>

																	<?php echo $topic_reply_text; ?></span>
																</span>
															</div>
														</div>
													</div>
												</div>

											</div>
										</li>
								<?php endwhile;
								} else {
									echo '<p class="no-course">No posts</p>';
								}
								?>

							</ul><!-- #bbp-forum-<?php bbp_forum_id(); ?> -->

							<?php do_action('bbp_template_after_topics_loop'); ?>
						</div>
					</div>
			</main>
		</div>
	<?php
		get_footer('account');
		exit;
	}
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
	exit;
}

add_action('init', 'dynamic_page4');

// page 5
function dynamic_page5()
{
	ob_start();
	$user_info = wp_get_current_user();
	$page_slug = 'members/' . $user_info->user_login . '/my-classmates/';
	$uri       = $_SERVER['REQUEST_URI'];
	$path      = wp_parse_url($uri, PHP_URL_PATH);

	if ('/' . trailingslashit($page_slug) === trailingslashit($path)) {
		get_header();
		// Output here any content.
	?>
		<div id="account-menu__toggle">My Student Dashboard</div>
		<div class="account__sitebar-menu">
			<ul class="account__sitebar-list">
				<li><a href="/members/<?php echo $user_info->user_login; ?>/dashbord/"><span class="img-dashbord"></span>Dashboard</a></li>
				<li><a href="/members/<?php echo $user_info->user_login; ?>/my-courses/"><span class="img-courses"></span>My Courses</a></li>
				<?php if ($user_info->roles[0] == 'student' || $user_info->roles[0] == 'administrator') : ?>
					<li class="selected"><a href="/members/<?php echo $user_info->user_login; ?>/my-classmates/"><span class="classmates"></span>My Classmates</a></li>
				<?php endif; ?>
				<?php if ($user_info->roles[0] == 'ministry' || $user_info->roles[0] == 'administrator' || $user_info->roles[0] == 'associate') : ?>

					<li><a href="/members/<?php echo $user_info->user_login; ?>/my-forums/"><span class="img-forum"></span>Forum</a></li>
					<?php if ($user_info->roles[0] != 'associate') : ?>
						<li><a href="/members/<?php echo $user_info->user_login; ?>/"><span class="img-profile"></span>My profile</a></li>
					<?php endif; ?>
				<?php endif; ?>
				<li><a href="/members/<?php echo $user_info->user_login; ?>/settings/"><span class="img-settings"></span>Account Settings</a></li>
				<li class="logout"><a href="<?php echo esc_url(wp_logout_url(home_url())); ?>"><span class="img-logout"></span>Log Out</a></li>
			</ul>
		</div>
		<div id="primary" class="content-area bs-bp-container dashbord-forums-page">
			<main id="main" class="site-main page-class-users">
				<div class="dashbord-my-course-row">
					<div class="dashbord-my-course__item">
						<h1 class="new-page-dashbord__title">My Classmates</h1>
					</div>
				</div>
				<article class="bp_members type-bp_members post-24 page type-page status-publish hentry">
					<div id="course-dir-list" class="course-dir-list bs-dir-list class-users__grid">
						<div class="bb-course-list bb-course-items grid-view bb-grid">
							<?php
							$current_user = wp_get_current_user();
							global $wpdb;
							$users = $wpdb->get_results("SELECT * FROM $wpdb->users WHERE class = '" . $current_user->class . "' AND user_roles = 'student' ");
							foreach ($users as $user) { ?>
								<?php $role = get_userdata($user->ID);
								if ($role->roles[0] == 'student' || $role->roles[0] == 'administrator') {
								?>
									<div class="user-item__wrap">
										<!-- <a href=""> -->
										<?php
										$user_foto = '';
										$first_name = get_user_meta($user->ID, 'first_name', true);
										$last_name = get_user_meta($user->ID, 'last_name', true);
										$foto = get_user_meta($user->ID, 'mm_sua_attachment_id', true);
										if (!empty($foto)) {
											if ($foto == 1) {
												$user_foto = '/wp-content/plugins/buddyboss-platform/bp-core/images/mystery-man.jpg';
											} else {
												$user_foto = wp_get_attachment_url($foto);
											}
										} elseif (!empty(get_avatar_url($user->ID))) {
											$user_foto = get_avatar_url($user->ID);
										} else {
											$user_foto = '/wp-content/plugins/buddyboss-platform/bp-core/images/mystery-man.jpg';
										}

										?>
										<div class="user-item">
											<img src="<?php echo $user_foto; ?>" alt="foto <?php echo $first_name . ' ' . $last_name; ?>">
											<h4><?php echo $first_name . ' ' . $last_name; ?></h4>
											<?php if (!empty($user->country)) : ?>
												<p><?php echo $user->country; ?></p>
											<?php elseif (!empty($user->nation)) : ?>
												<p><?php echo $user->nation; ?></p>
											<?php else : ?>
												<p>N/A</p>
											<?php endif; ?>
										</div>
										<!-- </a> -->
									</div>
							<?php  }
							}
							?>
						</div>
					</div>
				</article>
			</main>
		</div>
	<?php
		get_footer('account');
		exit;
	}
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
	exit;
}

add_action('init', 'dynamic_page5');

//page archive courses
add_shortcode('main-courses', 'view_main_courses'); // шорткод [main-courses]
function view_main_courses()
{

	ob_start();

	global $wpdb;

	$datas = $wpdb->get_results("SELECT object_id FROM $wpdb->term_relationships WHERE term_taxonomy_id = 36");
	$cpd_courses_id = [];
	foreach ($datas as $data) {
		array_push($cpd_courses_id, $data->object_id);
	}
	$args = array(
		'post_type' => 'sfwd-courses',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'post__not_in' => $cpd_courses_id,
		'orderby' => 'DESC',
	);
	$query = new WP_Query($args);
	$i = 0; ?>

	<?php if ($query->have_posts()) : ?>
		<div class="section-main-courses">
			<div class="main-courses-wrap">

				<!-- цикл -->
				<?php while ($query->have_posts()) : $query->the_post(); ?>
					<?php
					if ($i % 2 == 0) {
						$class = 'right-content ';
					} else {
						$class = 'left-content';
					}
					?>
					<div class="main-courses-row <?php echo $class; ?>">
						<div class="main-courses-item__text <?php echo $class; ?>">
							<div class="courses-text_wrap">
								<span class="post-date"><?php the_field('course_starting'); ?></span>
								<h4><?php the_title(); ?></h4>
								<div class="content">
									<?php
									the_excerpt();
									?>
								</div>
								<a href="<?php the_permalink(); ?>">Find out more</a>
							</div>
						</div>
						<?php
						if (has_post_thumbnail()) {
							$img_url = get_the_post_thumbnail_url();
						} else {
							$img_url = '/wp-content/uploads/2021/09/images.png';
						}
						?>
						<div class="main-courses__img <?php echo $class; ?>"><a href="<?php the_permalink();    ?>"><img src="<?php echo $img_url; ?>" alt="<?php the_title();    ?>"></a></div>
					</div>
					<?php $i++; ?>
				<?php endwhile; ?>
			</div>
		</div>
		<!-- конец цикла -->
		<?php wp_reset_postdata(); ?>

	<?php else : ?>
		<p><?php esc_html_e('No courses.'); ?></p>
		<?php endif;
	// }
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
	exit;
}
add_shortcode('all-courses', 'get_all_courses');
function get_all_courses()
{

	ob_start();

	global $wpdb;

	$datas = $wpdb->get_results("SELECT object_id FROM $wpdb->term_relationships WHERE term_taxonomy_id = 36");
	$cpd_courses_id = [];
	foreach ($datas as $data) {
		array_push($cpd_courses_id, $data->object_id);
	}
	$datas2 = $wpdb->get_results("SELECT object_id FROM $wpdb->term_relationships WHERE term_taxonomy_id = 36");

	foreach ($datas2 as $data2) {
		array_push($cpd_courses_id, $data2->object_id);
	}
	$result = array_unique($cpd_courses_id);

	$arr_course_user = [];
	$user_id = get_current_user_id();
	$datas_user = get_user_meta($user_id, '_sfwd-course_progress');
	//foreach ($datas_user as $data_user) {

	// foreach ($data_user as $key => $value) {
	//     if (!in_array($key, $cpd_courses_id)) {
	//         array_push($arr_course_user, $key);
	//     }
	// }


	$args2 = array(
		'post_type' => 'sfwd-courses',
		'post_status' => 'publish',
		'posts_per_page' => 2,
		'post__in' => $result,
		'orderby' => 'DESC',
	);

	$query = new WP_Query($args2);

	// Цикл
	if ($query->have_posts()) {
		$i = 0;
		while ($query->have_posts()) {
			$query->the_post(); ?>
			<div class="courses-item">
				<div class="courses-item__wrap">
					<?php
					if (has_post_thumbnail()) {
						$img_url = get_the_post_thumbnail_url();
					} else {
						$img_url = '/wp-content/uploads/2021/09/images.png';
					}
					$date = new DateTime($user_info->user_registered);
					if (!empty(get_field('course_starting'))) :
					?>
						<div class="date-course"><?php the_field('course_starting'); ?></div>
					<?php endif; ?>
					<img src="<?php echo $img_url; ?>" alt="<?php the_title(); ?>" class="resize-img">
					<div class="content-width">
						<h5><?php the_title(); ?></h5>
						<?php the_excerpt(); ?>
						<a class="main-btn" href="<?php the_permalink(); ?>">Find out more</a>
					</div>
				</div>
			</div>
	<?php
			$i++;
		}
	} else {
		echo '<h4>No courses</h4>';
	}
	// wp_reset_postdata();
	//}
	?>
<?php
	$content2 = ob_get_contents();
	ob_end_clean();
	return $content2;
}

add_action('init', 'my_custom_init');
function my_custom_init()
{
	register_post_type('stories', array(
		'labels'             => array(
			'name'               => 'Student stories', // Основное название типа записи
			'singular_name'      => 'Student story', // отдельное название записи типа Book
			'menu_name'          => 'Student stories'

		),
		'public'             => true,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'exclude_from_search' => 0,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		//'taxonomies' => 'visitors',
		'supports'           => array('title', 'editor', 'author', 'thumbnail')
	));
}

add_action('wp_ajax_nopriv_add_stories_func', 'add_stories_func');
add_action('wp_ajax_add_stories_func', 'add_stories_func');

function add_stories_func()
{
	$paged = (isset($_POST['numPage'])) ? $_POST['numPage'] : 2;
	$last_stories_id = $_POST['last_id'];

	header("Content-Type: text/html");

	$args = [
		'post_type' => 'stories',
		'post_status' => 'publish',
		'order' => 'DESC',
		'post__not_in' => [$last_stories_id],
		'paged' => $paged,
		'posts_per_page' => 3,
	];
	$query = new WP_Query($args); ?>

	<?php if ($query->have_posts()) : ?>
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
	<?php else : ?>
		<p><?php esc_html_e('No posts.'); ?></p>
	<?php endif;
	wp_reset_postdata();
	die;
}

// add comment ministry
add_action('wp_ajax_nopriv_form_comment_add', 'form_comment_add');
add_action('wp_ajax_form_comment_add', 'form_comment_add');

function form_comment_add()
{
	$post_id = $_POST['post_id'];
	$author = $_POST['name'];
	$comment = $_POST['comment'];

	$data = [
		'comment_post_ID'      => $post_id,
		'comment_author'       => $author,
		'comment_author_url'   => '',
		'comment_content'      => $comment,
		'comment_type'         => 'comment',
		'comment_parent'       => 0,
		'user_id'              => 1,
		'comment_date'         => null, // получим current_time('mysql')
		'comment_approved'     => 1,
	];
	add_comment_meta(3, 'name', 'Danny & Kellie Menter Dunskey Estate');

	$comment_id = wp_insert_comment(wp_slash($data));
	update_comment_meta($comment_id, 'name', $author);
	return $comment_id;
	die();
}

add_filter('comment_text', 'filter_function_name_6816', 10, 3);
function filter_function_name_6816($comment_text, $comment, $args)
{
	return '“ ' . $comment_text . ' ”';
}

add_action('comment_post', 'add_comment_metadata_field');

function add_comment_metadata_field($comment_id)
{

	$meta_val = sanitize_text_field($_POST['name']);

	add_comment_meta($comment_id, 'name', $meta_val);
}

// Добавляем новый метабокс на страницу редактирования комментария
add_action('add_meta_boxes_comment', 'extend_comment_add_meta_box');
function extend_comment_add_meta_box()
{
	add_meta_box('title', __('Comment Metadata - Extend Comment'), 'extend_comment_meta_box', 'comment', 'normal', 'high');
}

// Отображаем наши поля
function extend_comment_meta_box($comment)
{
	$name  = get_comment_meta($comment->comment_ID, 'name', true);

	wp_nonce_field('extend_comment_update', 'extend_comment_update', false);
	?>
	<p>
		<label for="name"><?php _e('Name author'); ?></label>
		<input type="text" name="name" value="<?php echo esc_attr($name); ?>" class="widefat" />
	</p>
<?php
}
add_action('edit_comment', 'extend_comment_edit_meta_data');
function extend_comment_edit_meta_data($comment_id)
{
	if (!isset($_POST['extend_comment_update']) || !wp_verify_nonce($_POST['extend_comment_update'], 'extend_comment_update'))
		return;

	if (!empty($_POST['name'])) {
		$name = sanitize_text_field($_POST['name']);
		update_comment_meta($comment_id, 'name', $name);
	} else
		delete_comment_meta($comment_id, 'name');
}
function buddyboss_comment_new($comment, $args, $depth)
{
	$name_author = get_comment_meta($comment->comment_ID);
?>
	<li id="comment-<?php comment_ID(); ?>">
		<div class="comment-text"><?php comment_text(); ?></div>
		<p class="name"><?php echo $name_author['name'][0] ?? 'Not known'; ?> | <?php comment_date('F Y'); ?> </p>
	<?php
}
// Получим объект данных роли "Автор"
$author = get_role('author');


// Rest Api Knak Student
// $arr_img = $wpdb->get_results("SELECT ID FROM $wpdb->posts WHERE post_type = 'attachment' AND post_date > '2021-10-20' ");

//$url = 'https://api.knack.com/v1/objects/object_21/records?page=1&rows_per_page=500';


// $args = array(
//     'headers' => array("Content-type" => "application/json",
//     'X-Knack-Application-ID' => '5b9e72d273ceb36d5e611a76',
//     'X-Knack-REST-API-KEY' => '5d05e530-bb2d-11e8-afc6-e9e6b74e07a8')
// );

// $response = wp_remote_request($url, $args);
// $arr_user = json_decode($response['body']);
// $i = 1;
// foreach ($arr_user->records as $user) {
//     global $wpdb;
//     //$datas = $wpdb->get_results("SELECT * FROM m9s_bp_activity WHERE  user_id = 1");
//     // // $data_user_lessons = maybe_unserialize($datas_user[0]->meta_value);

//     // echo '<pre>';
//     // var_dump($user->field_184);
//     // echo '</pre>';
//     if($user->field_184 == 'inactive') {

//         $wpdb->delete($wpdb->users, ['user_email' => sanitize_text_field($user->field_182 )]);

//     }
// }


// global $wpdb;
//     $user_email = sanitize_text_field($user->field_182);
//     $data = $wpdb->get_results("SELECT ID FROM $wpdb->users WHERE  user_email ='" . $user_email . "' ");
//     $user_id = $data[0]->ID;

// $wpdb->get_results("DELETE FROM $wpdb->users WHERE ID > 20");

// require_once ABSPATH . 'wp-admin/includes/image.php';
// require_once ABSPATH . 'wp-admin/includes/file.php';
// require_once ABSPATH . 'wp-admin/includes/media.php';
// добавили данные пользователей
// $name  = $user->field_181;

// $arr_name = explode(" ", $name);
// $arr_name_1 = '';
// $arr_name_2 = '';
//     $last_name_1 = '';
//     $last_name_2 = '';
// if (!empty($arr_name[1]) && isset($arr_name[1])) {
//     $arr_name_1 = '_' . $arr_name[1];
//     $last_name_1 = $arr_name[1];
// } 
// if (!empty($arr_name[2]) && isset($arr_name[2])) {
//     $arr_name_2 = '-' . $arr_name[2];
//     if (!empty($arr_name[1]) && isset($arr_name[1])) {
//         $last_name_2 = ' ' . $arr_name[2];
//     } else {
//         $last_name_2 = $arr_name[2];
//     }

// } 

// $user_login = $arr_name[0] . $arr_name_1 . $arr_name_2;
// $user_email = sanitize_text_field($user->field_182);


// $random_password = wp_generate_password(12);
// $user_id = wp_create_user($user_login, $random_password, $user_email);
// $date = date($user->field_268);
// $date = strtotime($date);
// $d_o_b =  date('Y-m-d', $date);
// $wpdb->update(
//     $wpdb->users,
//     [
//         'display_name' => $arr_name[0],
//          'home_phone' => sanitize_text_field($user->field_262), 'mobile_phone' => sanitize_text_field($user->field_409), 'class' => sanitize_text_field($user->field_719),
//         'address' => sanitize_text_field($user->field_204), 'gender' => $user->field_304, 'nation' => sanitize_text_field($user->field_266), 'd_o_b' => $d_o_b
//     ],
//     ['ID' => $user_id]
// );
// update_user_meta($user_id, 'first_name', $arr_name[0]);
// update_user_meta($user_id, 'last_name', $last_name_1 . $last_name_2);

//     //end
// $user_email = sanitize_text_field($user->field_182);
// $url  = sanitize_text_field($user->field_259_raw->url);
// echo '<pre>';
// echo  "'" . $user_email . "' => '" . $url . "'";
// echo '</pre>';
// //  Загружаем файл во временную директорию
//     $tmp = download_url($url);

// // Устанавливаем переменные для размещения
//     $file_array = [
//         'name'     => basename($url),
//         'tmp_name' => $tmp
//     ];
// $desc = 'logo user_id=' . $user_id;
//     //  Удаляем временный файл, при ошибке
//     if (is_wp_error($tmp)) {
//         $file_array['tmp_name'] = '';
//         if ($debug) echo 'Ошибка нет временного файла! <br />';
//     }
//     $id = media_handle_sideload($file_array, $user_id, $desc);

//     // Проверяем работу функции
//     if (is_wp_error($id)) {
//         var_dump($id->get_error_messages());
//         echo '-------------';
//     } else {
//         update_user_meta($user_id, 'mm_sua_attachment_id', $attachment_id);
// }

// // удалим временный файл
//  @unlink($tmp);

//}

// add user in Knak
// $url = 'https://api.knack.com/v1/objects/object_17/records';

// $data = array(
//     'field_161' => array('first' => 'Test1',
//                             'last' => 'Test2',
//                             ),
//     'field_162' => 'testmain@gmail.com',
//     'field_163' => md5(12345),
//     'field_165' => 'Student',
//     'account_status' => 'active',

// );

// $args = array(
//     'headers' => array("Content-type" => "application/json",
//                         'X-Knack-Application-ID' => '5b9e72d273ceb36d5e611a76',
//                          'X-Knack-REST-API-KEY' => '5d05e530-bb2d-11e8-afc6-e9e6b74e07a8'),
//     'body' => json_encode($data),
//     'timeout'     => 45,
//     'redirection' => 5,
//     'httpversion' => '1.0',
//     'blocking'    => false
// );

//$response = wp_remote_post($url, $args);

// if (is_wp_error($response2)) {
//     $error_message = $response->get_error_message();
//     echo "Что-то пошло не так: $error_message2";
// } else {
//     echo 'Ответ: <pre>';
//     print_r($response2);
//     echo '</pre>';
// }

//global $wpdb;
// $data_user = $wpdb->get_results("SELECT * FROM $wpdb->users WHERE ID = 16578");
//     echo '<pre>';
//     var_dump($data_user[0]);
//     echo '</pre>';

// удалить изображения за сегодня
//$wpdb->get_results("DELETE FROM $wpdb->posts WHERE post_type = 'attachment' AND post_date > '2021-11-30' ");


// $user_id = get_current_user_id();
// $userdata = get_userdata($user_id);
// $user_email = $userdata->user_email;
// update_user_meta($user_id, 'mm_sua_attachment_id', $avatar);

//Api Knak;
// $url = 'https://api.knack.com/v1/objects/object_21/records?page=1&rows_per_page=1000';

// $args = array(
//     'headers' => array(
//         "Content-type" => "application/json",
//         'X-Knack-Application-ID' => '5b9e72d273ceb36d5e611a76',
//         'X-Knack-REST-API-KEY' => '5d05e530-bb2d-11e8-afc6-e9e6b74e07a8'
//     )
// );

// обновить данные в Кнак

// $response = wp_remote_request($url, $args);
// $arr_user = json_decode($response['body']);
// foreach ($arr_user->records as $user) {
//     if (sanitize_text_field($user->field_182) == $user_email) {
//         //id для обновления записи $user->id;
//         $url_user = 'https://api.knack.com/v1/objects/object_21/records/' . $user->id;
//         $data = array(
//             'field_259' => 'https://interfaith.sitepreview.app/wp-content/uploads/2021/10/dunnrani-12.jpg',
//         );
//         $args2 = array(
//             'headers' => array(
//                 "Content-type" => "application/json",
//                 'X-Knack-Application-ID' => '5b9e72d273ceb36d5e611a76',
//                 'X-Knack-REST-API-KEY' => '5d05e530-bb2d-11e8-afc6-e9e6b74e07a8'
//             ),
//             'body' => json_encode($data),
//             'timeout'     => 45,
//             'redirection' => 5,
//             'method' => 'PUT'
//         );
//         wp_remote_request($url_user, $args2);
//     }
// }

//Knack cron task
add_action('admin_head', 'task_knack_activation');
function task_knack_activation()
{
	if (!wp_next_scheduled('get_task_knack')) {
		wp_schedule_event(time(), 'twicedaily', 'get_task_knack');
	}
}
// добавляем функцию к указанному хуку
add_action('get_task_knack', 'update_users');

function update_users()
{
	global $wpdb;
	$data_users = $wpdb->get_results("SELECT user_email, ID, status FROM $wpdb->users");

	$url = 'https://api.knack.com/v1/objects/object_21/records?page=1&rows_per_page=1000';

	$args = array(
		'headers' => array(
			"Content-type" => "application/json",
			'X-Knack-Application-ID' => '5b9e72d273ceb36d5e611a76',
			'X-Knack-REST-API-KEY' => '5d05e530-bb2d-11e8-afc6-e9e6b74e07a8'
		)
	);
	$response = wp_remote_request($url, $args);
	$arr_user = json_decode($response['body']);

	$stack_email = [];
	foreach ($data_users as $data_user) {

		array_push($stack_email, $data_user->user_email);
	}
	foreach ($arr_user->records as $user) {

		if (in_array(sanitize_text_field($user->field_182), $stack_email)) {
			$wpdb->update(
				$wpdb->users,
				array(
					'status' => sanitize_text_field($user->field_722),
					'class' =>  sanitize_text_field($user->field_719),
				),
				array('ID' => $data_user->ID)
			);
		}

		if (!in_array(sanitize_text_field($user->field_182), $stack_email) && sanitize_text_field($user->field_184) == 'active') {

			$name  = $user->field_181;
			$arr_name = explode(" ", $name);
			$arr_name_1 = '';
			$arr_name_2 = '';
			$last_name_1 = '';
			$last_name_2 = '';
			if (!empty($arr_name[1]) && isset($arr_name[1])) {
				$arr_name_1 = '_' . $arr_name[1];
				$last_name_1 = $arr_name[1];
			}
			if (!empty($arr_name[2]) && isset($arr_name[2])) {
				$arr_name_2 = '-' . $arr_name[2];
				if (!empty($arr_name[1]) && isset($arr_name[1])) {
					$last_name_2 = ' ' . $arr_name[2];
				} else {
					$last_name_2 = $arr_name[2];
				}
			}
			$user_login = $arr_name[0] . $arr_name_1 . $arr_name_2;
			$user_email = sanitize_text_field($user->field_182);
			$random_password = wp_generate_password(12);
			$user_id = wp_create_user($user_login, $random_password, $user_email);

			$date = date($user->field_268);
			$date = strtotime($date);
			$d_o_b =  date('Y-m-d', $date);

			$wpdb->update(
				$wpdb->users,
				[
					'display_name' => $arr_name[0],
					'status' =>  sanitize_text_field($user->field_722),
					'gender' =>  mb_strtolower(sanitize_text_field($user->field_304)),
					'class' =>  sanitize_text_field($user->field_719),
					'd_o_b' =>  $d_o_b,
					'home_phone' => sanitize_text_field($user->field_263),
					'mobile_phone' => sanitize_text_field($user->field_264),
					'class' => sanitize_text_field($user->field_719),
					'address' => sanitize_text_field($user->field_204),
					'nation' => sanitize_text_field($user->field_266),
					'knack_id' => sanitize_text_field($user->id),
					//   'zip_code' =>  sanitize_text_field($user->field_262),
					'country' =>  sanitize_text_field($user->field_981),
					'city' =>  sanitize_text_field($user->field_980),
					// 'street' =>  sanitize_text_field($user->field_262),
				],
				['ID' => $user_id]
			);
			update_user_meta($user_id, 'first_name', $arr_name[0]);
			update_user_meta($user_id, 'last_name', $last_name_1 . $last_name_2);

			//загрузка фото
			$url_img  = sanitize_text_field($user->field_259_raw->url);
			require_once ABSPATH . 'wp-admin/includes/image.php';
			require_once ABSPATH . 'wp-admin/includes/file.php';
			require_once ABSPATH . 'wp-admin/includes/media.php';
			// Загрузим файл
			$tmp = download_url($url_img);

			// Установим данные файла
			$file_array = [
				'name'     => basename($url_img), // ex: wp-header-logo.png
				'tmp_name' => $tmp,
				'error'    => 0,
				'size'     => filesize($tmp),
			];

			// загружаем файл
			$attachment_id = media_handle_sideload($file_array, 0);
			update_user_meta($user_id, 'mm_sua_attachment_id', $attachment_id);

			// удалим временный файл
			@unlink($tmp);
			//  break;

		}
	}
}

//Knack cron task
add_action('admin_head', 'task_knack_activation_2');
function task_knack_activation_2()
{
	if (!wp_next_scheduled('get_task_knack_2')) {
		wp_schedule_event(time(), 'twicedaily', 'get_task_knack_2');
	}
}
// добавляем функцию к указанному хуку
add_action('get_task_knack_2', 'update_ministers');

function update_ministers()
{
	global $wpdb;
	$data_users = $wpdb->get_results("SELECT user_email, ID, status FROM $wpdb->users");

	$url = 'https://api.knack.com/v1/objects/object_19/records?page=1&rows_per_page=1000';

	$args = array(
		'headers' => array(
			"Content-type" => "application/json",
			'X-Knack-Application-ID' => '5b9e72d273ceb36d5e611a76',
			'X-Knack-REST-API-KEY' => '5d05e530-bb2d-11e8-afc6-e9e6b74e07a8'
		)
	);
	$response = wp_remote_request($url, $args);
	$arr_user = json_decode($response['body']);

	$stack_email = [];
	foreach ($data_users as $data_user) {

		array_push($stack_email, $data_user->user_email);
	}
	foreach ($arr_user->records as $user) {
		$str = '';
		foreach ($user->field_721_raw as $class) {
			$str .= $class->identifier . ', ';
		}
		$class_str = rtrim($str, ", ");

		if (in_array(sanitize_text_field($user->field_172), $stack_email)) {
			$wpdb->update(
				$wpdb->users,
				array(
					'status' => sanitize_text_field($user->field_174),
					'class' =>  $class_str,
				),
				array('ID' => $data_user->ID)
			);
		}

		if (!in_array(sanitize_text_field($user->field_172), $stack_email) && sanitize_text_field($user->field_184) == 'active') {

			$name  = $user->field_171;
			$arr_name = explode(" ", $name);
			$arr_name_1 = '';
			$arr_name_2 = '';
			$last_name_1 = '';
			$last_name_2 = '';
			if (!empty($arr_name[1]) && isset($arr_name[1])) {
				$arr_name_1 = '_' . $arr_name[1];
				$last_name_1 = $arr_name[1];
			}
			if (!empty($arr_name[2]) && isset($arr_name[2])) {
				$arr_name_2 = '-' . $arr_name[2];
				if (!empty($arr_name[1]) && isset($arr_name[1])) {
					$last_name_2 = ' ' . $arr_name[2];
				} else {
					$last_name_2 = $arr_name[2];
				}
			}
			$user_login = $arr_name[0] . $arr_name_1 . $arr_name_2;
			$user_email = sanitize_text_field($user->field_172);
			$random_password = wp_generate_password(12);
			$user_id = wp_create_user($user_login, $random_password, $user_email);

			$wpdb->update(
				$wpdb->users,
				[
					'display_name' => $arr_name[0],
					'status' =>  sanitize_text_field($user->field_174),
					'class' =>   $class_str,
					'home_phone' => sanitize_text_field($user->field_405),
					'mobile_phone' => sanitize_text_field($user->field_404),
					'knack_id' => sanitize_text_field($user->id),
				],
				['ID' => $user_id]
			);
			update_user_meta($user_id, 'first_name', $arr_name[0]);
			update_user_meta($user_id, 'last_name', $last_name_1 . $last_name_2);

			$u = new WP_User($data_user->ID);
			// set role
			$u->remove_role('student');
			$u->set_role('ministry');

			//загрузка фото
			$url_img  = sanitize_text_field($user->field_259_raw->url);
			require_once ABSPATH . 'wp-admin/includes/image.php';
			require_once ABSPATH . 'wp-admin/includes/file.php';
			require_once ABSPATH . 'wp-admin/includes/media.php';
			// Загрузим файл
			$tmp = download_url($url_img);

			// Установим данные файла
			$file_array = [
				'name'     => basename($url_img), // ex: wp-header-logo.png
				'tmp_name' => $tmp,
				'error'    => 0,
				'size'     => filesize($tmp),
			];

			// загружаем файл
			$attachment_id = media_handle_sideload($file_array, 0);
			update_user_meta($user_id, 'mm_sua_attachment_id', $attachment_id);

			// удалим временный файл
			@unlink($tmp);
			//  break;

		}
	}
}

// metabox menu

add_action('add_meta_boxes', 'add_custom_box');

function add_custom_box($post)
{

	add_meta_box(
		'Meta Box', // ID, should be a string.
		'Page menu', // Meta Box Title.
		'page_menu_meta_box', // Your call back function, this is where your form field will go.
		'page', // The post type you want this to show up on, can be post, page, or custom post type.
		'side', // The placement of your meta box, can be normal or side.
		'core' // The priority in which this will be displayed.
	);
}

function page_menu_meta_box($post)
{

	wp_nonce_field('my_awesome_nonce', 'awesome_nonce');
	$checkboxMeta = get_post_meta($post->ID);
	$menus = wp_get_nav_menus($args);
	?> <p><input type="radio" name="page_menu" id="page_menu-none" value="novalue" <?php if (isset($checkboxMeta['page_menu'])) checked($checkboxMeta['page_menu'][0],  ''); ?> />None</p>
		<?php
		foreach ($menus as $menu) {
		?>
			<p><input type="radio" name="page_menu" id="page_menu-<?php echo $menu->term_id; ?>" value="<?php echo $menu->term_id; ?>" <?php if (isset($checkboxMeta['page_menu'])) checked($checkboxMeta['page_menu'][0],  $menu->term_id); ?> /><?php echo $menu->name; ?></p>
		<?php }
	}

	add_action('save_post', 'save_page_menu_checkboxes');
	function save_page_menu_checkboxes($post_id)
	{
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return;
		if ((isset($_POST['my_awesome_nonce'])) && (!wp_verify_nonce($_POST['my_awesome_nonce'], plugin_basename(__FILE__))))
			return;
		// if ((isset($_POST['post_type'])) && ('page' == $_POST['post_type'])) {
		// 	if (!current_user_can('edit_page', $post_id)) {
		// 		return;
		// 	}
		// } else {
		// 	if (!current_user_can('edit_post', $post_id)) {
		// 		return;
		// 	}
		// }

		//saves page_menu's value
		if (isset($_POST['page_menu'])){
			if ($_POST['page_menu'] != 'novalue') {
				update_post_meta($post_id, 'page_menu', $_POST['page_menu']);
			} else {
				update_post_meta($post_id, 'page_menu', 'novalue');
			}
		}
	}

	add_action('get_footer', 'action_function_name_7220', 10, 2);
	function action_function_name_7220($name, $args)
	{
		if (!empty(get_field('text_quote'))) : ?>
			<div class="section-quote <?php if (empty(get_field('image_quote'))) echo 'section-quote__new'; ?>">
				<div class="section-quote__item1">
					<div class="blockquote-row">
						<blockquote>“<?php the_field('text_quote'); ?>”</blockquote>
						<span>– <?php the_field('author_quote'); ?></span>
					</div>
				</div>
				<?php if (!empty(get_field('image_quote'))) : ?>
					<div class="section-quote__item2" style="background-image: url(<?php the_field('image_quote'); ?>);"></div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<?php
		if (get_field('form_newsletter')[0] == 1) : ?>
			<div class="section-newsletter">
				<?php echo do_shortcode('[contact-form-7 id="113" title="sign up for our newsletter"]'); ?>
			</div>
	<?php endif;
	}

// Обновить данные
// global $wpdb;
// $data_users = $wpdb->get_results("SELECT user_email, ID, status FROM $wpdb->users");

// $url = 'https://api.knack.com/v1/objects/object_21/records?page=1&rows_per_page=1000';

// $args = array(
//     'headers' => array(
//         "Content-type" => "application/json",
//         'X-Knack-Application-ID' => '5b9e72d273ceb36d5e611a76',
//         'X-Knack-REST-API-KEY' => '5d05e530-bb2d-11e8-afc6-e9e6b74e07a8'
//     )
// );
// $response = wp_remote_request($url, $args);
// $arr_user = json_decode($response['body']);

// $stack_email = [];
// //foreach ($data_users as $data_user) {
// foreach ($arr_user->records as $user) {

//    // if (sanitize_text_field($user->field_182) == 'ceribuckmaster@gmail.com') {
//         $wpdb->update(
//             $wpdb->users,
//             array(
//               //  'knack_id' => sanitize_text_field($user->id),
// 				'class' => sanitize_text_field($user->field_719),
//             ),
//             array('user_email' => sanitize_text_field($user->field_182))
//         );
//         echo '<pre>';
//         var_dump($user->field_182);
// 		echo '------';
// 		var_dump($user->field_719);
//          echo '</pre>';
//   //  }

// }

// добавление страниц министров
//global $wpdb;
// Добавить столбец к постам для министров user_id
//$sql = "ALTER TABLE $wpdb->posts ADD `user_id` INT";
// $sql = "ALTER TABLE $wpdb->posts ADD PRIMARY KEY (`user_id`)";
// $res = $wpdb->query($sql);

// $posts = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_type = 'minister'");
// echo '<pre>';
// $res = $wpdb->get_results("SELECT ID FROM $wpdb->posts WHERE post_type = 'minister'");
// var_dump($res[0]->ID);
// echo '</pre>';

// $users = $wpdb->get_results("SELECT ID FROM $wpdb->users");

// foreach ($users as $user) {
// 	$user_data= get_userdata($user->ID);
// 	if($user_data->roles[0] == 'ministry') {
// $post_id = $wpdb->get_results("SELECT ID FROM $wpdb->posts WHERE user_id = $user->ID");
// if (empty($post_id[0]->ID)) {
// $wpdb->insert($wpdb->posts, 
// 	[
// 		'post_title' => $user_data->first_name . ' ' . $user_data->last_name,
// 		'post_type' => 'minister',
// 		'post_name' => mb_strtolower($user_data->user_login),
// 		'user_id' => $user->ID
// 	]);
// $post_last_id = $wpdb->update(
// 	$wpdb->posts,
// 	[
// 		'post_name' => mb_strtolower($user_data->user_login),
// 	],
// 	['user_id' => $user->ID]
// );
// $post_id = $wpdb->get_results("SELECT ID FROM $wpdb->posts WHERE user_id = $user->ID");
// $attachment_id = get_user_meta($user->ID, 'mm_sua_attachment_id', true);
// if (empty($attachment_id->errors)) {
// 	set_post_thumbnail($post_id, $attachment_id);
// }


//	}
//}
//}


// add fields
// $query = "ALTER TABLE $wpdb->users ADD `serving` VARCHAR( 100 );";
// $wpdb->query($query);
// $query1 = "ALTER TABLE $wpdb->users ADD `qualifications` VARCHAR( 100 );";
// $wpdb->query($query1);
// $query2 = "ALTER TABLE $wpdb->users ADD `available` VARCHAR( 250 );";
// $wpdb->query($query2);
// $query3 = "ALTER TABLE $wpdb->users ADD `short_bio` TEXT;";
// $wpdb->query($query3);
// $query4 = "ALTER TABLE $wpdb->users ADD `online_services` VARCHAR( 100 );";
// $wpdb->query($query4);
// $query5 = "ALTER TABLE $wpdb->users ADD `ordained` INT";
// $wpdb->query($query5);
// $query6 = "ALTER TABLE $wpdb->users DROP COLUMN available";
// $wpdb->query($query6);

// $post_id = $wpdb->get_results("SELECT * FROM $wpdb->users WHERE ID = 1");
// echo '<pre>';
// var_dump($post_id[0]);
// echo '</pre>';
