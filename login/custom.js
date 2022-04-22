jQuery(document).ready(function($) {
	
	if ($('#loginform').length){
		$('#loginform .user-pass-wrap').before('<div class="lost-pass-wrapper"><a href="/wp-login.php?action=lostpassword">Lost your password?</a></div>');
	}
		$('.login-action-login .ml-extra-div').append('<div class="welcome-wrapper"><a href="/"><img src="/wp-content/uploads/2022/04/OneSpirit_Interfaith_Foundation_logo.png"></a><span class="login-welcome">Welcome Back!</span></div>');
		$('.login-action-lostpassword .ml-extra-div').append('<div class="welcome-wrapper"><a href="/"><img src="/wp-content/uploads/2022/04/OneSpirit_Interfaith_Foundation_logo.png"></a><span class="login-welcome">Forgot Password?</span></div>');
		$('.login-action-rp .ml-extra-div').append('<div class="welcome-wrapper"><a href="/"><img src="/wp-content/uploads/2022/04/OneSpirit_Interfaith_Foundation_logo.png"></a><span class="login-welcome">Reset Password!</span></div>');


});