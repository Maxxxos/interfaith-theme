jQuery(document).ready(function($) {
    setTimeout(() => {
        let count_p = jQuery('.sqs-block-content p').length - 3;
        jQuery(".sqs-block-content p:eq(" + count_p + ")").append(jQuery('#quote-single'));
    }, 500);
    jQuery('.view-pass').click(function() {
        jQuery(this).toggleClass('active');

        if (jQuery(this).hasClass('active')) {
            jQuery(this).next().attr('type', 'text');
        } else {
            jQuery(this).next().attr('type', 'password');
        }
    });
    $('#popup-clouse, #popup-clouse2').click(function(e) {
        e.preventDefault();
        $('.popup-wrap').fadeOut();
        $('.popup-block').removeClass('active');
    });
    $('#forgot-password').click(function(e) {
        e.preventDefault();
        $('.popup-block').removeClass('active');
        $('#custom-passreset').addClass('active');
    });
    $('#view-login-form, #view-login-form').click(function(e) {
        e.preventDefault();
        $('.popup-wrap').fadeIn();
        $('#login-form').addClass('active');
    });
    // валидация
    jQuery('#register_email, #password-login-user').focus(function() {
        jQuery(this).removeClass('wp-not-valid');
        jQuery(this).next().remove();
    });
    // user login
    jQuery('#login-button-user').click(function(e) {
        e.preventDefault();
        let login_field = jQuery('#register_email');
        let login_password = jQuery('#password-login-user');
        let login_remember = 1;

        login_field.removeClass('wp-not-valid');
        login_field.next().remove();
        login_password.removeClass('wp-not-valid');
        login_password.next().remove();

        // проверка полей
        if (login_field.val() == "") {
            setTimeout(() => {
                login_field.addClass('wp-not-valid');
                login_field.parent().append('<span class="not-valid-field">The field is required</span>');
            }, 100);
        }

        let pattern = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        //let pattern2 = /^[0-9]/i;

        if (!pattern.test(login_field.val()) && login_field.val() !== "") {
            setTimeout(() => {
                login_field.addClass('wp-not-valid');
                login_field.parent().append('<span class="not-valid-field">Please enter correct field</span>');
            }, 100);
        }
        if (login_password.val().length < 6) {
            setTimeout(() => {
                login_password.addClass('wp-not-valid');
                login_password.parent().append('<span class="not-valid-field">Password is too short</span>');
            }, 100);
        }
        if (login_password.val().length > 6 && pattern.test(login_field.val()) && login_field.val() !== "") {
            $.ajax({
                type: "POST",
                dataType: "html",
                url: ajax_posts.ajaxurl,
                data: {
                    login_field: login_field.val(),
                    login_password: login_password.val(),
                    login_remember: login_remember,
                    action: 'login_func'
                },
                success: function(data) {
                    let user_data = jQuery.parseJSON(data);
                    console.log(user_data);
                    if (user_data.hasOwnProperty('login')) {
                        
                        window.location = '/members/' + user_data.login + '/dashbord/';
                     } else {
                        jQuery('.rh_form__response .rh_form__msg').empty();
                        jQuery('#login-message-user').append(user_data.error);
                        jQuery('.rh_form__response .rh_form__msg').fadeIn();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR, textStatus, errorThrown);

                }
            });
        }
    });
	
    $(function() {
        $('.width-block').matchHeight();
        $('.content-width').matchHeight();
        $('.resize-img-3').matchHeight();
        $('.user-item__wrap').matchHeight();
        $('.bb-course-title').matchHeight();
        $('.row-steps .et_pb_blurb_description').matchHeight();
        
        $('.row-ministers h4').matchHeight();
        $('.row-ministers .position').matchHeight();
        $('.row-ministers .description').matchHeight();
        $('.module-courses h5').matchHeight();
        $('.module-courses p').matchHeight();
    });
	
    jQuery('input[name=gender]').change(function() {
        jQuery('input[name=gender]').next().css('color', '#1F1F1F');
    });
    jQuery('#register_first-name, #register_last-name, #register_mobile-phone, #register_zip, #register_street, #password-signup-user, #register_city, #register_country, #register_email').focus(function() {
        let el = $(this);
        el.removeClass('wp-not-valid');
        el.next().remove();
    });
    
    // user signup
        jQuery('#signup-button-user').click(function(e) {
        e.preventDefault();
        let first_name = jQuery('#register_first-name');
        let last_name = jQuery('#register_last-name');        
        let mobile_phone = jQuery('#register_mobile-phone');
        let email = jQuery('#register_email2');
        let gender = jQuery('input[name=gender]:radio:checked');
        let country = jQuery('#register_country');
        let zip_code = jQuery('#register_zip');
        let city = jQuery('#register_city');
        let street = jQuery('#register_street');
        let signup_password = jQuery('#password-signup-user');

        first_name.removeClass('wp-not-valid');
        first_name.next().remove();
        last_name.removeClass('wp-not-valid');
        last_name.next().remove();
        mobile_phone.removeClass('wp-not-valid');
        mobile_phone.next().remove();
        email.removeClass('wp-not-valid');
        email.next().remove();        
        country.removeClass('wp-not-valid');
        country.next().remove();
        zip_code.removeClass('wp-not-valid');
        zip_code.next().remove();
        city.removeClass('wp-not-valid');
        city.next().remove();
        street.removeClass('wp-not-valid');
        street.next().remove();
        signup_password.removeClass('wp-not-valid');
        signup_password.next().remove();
        
        
        // проверка полей
        if (first_name.val() == "") {
            setTimeout(() => {
                first_name.addClass('wp-not-valid');
                first_name.parent().append('<span class="not-valid-field">The field is required</span>');
            }, 100);
        }
        if (last_name.val() == "") {
            setTimeout(() => {
                last_name.addClass('wp-not-valid');
                last_name.parent().append('<span class="not-valid-field">The field is required</span>');
            }, 100);
        }
        if (country.val() == "") {
            setTimeout(() => {
                country.addClass('wp-not-valid');
                country.parent().append('<span class="not-valid-field">The field is required</span>');
            }, 100);
        }
        if (zip_code.val() == "") {
            setTimeout(() => {
                zip_code.addClass('wp-not-valid');
                zip_code.parent().append('<span class="not-valid-field">The field is required</span>');
            }, 100);
        }
        if (city.val() == "") {
            setTimeout(() => {
                city.addClass('wp-not-valid');
                city.parent().append('<span class="not-valid-field">The field is required</span>');
            }, 100);
        }
        if (street.val() == "") {
            setTimeout(() => {
                street.addClass('wp-not-valid');
                street.parent().append('<span class="not-valid-field">The field is required</span>');
            }, 100);
        }
        if (mobile_phone.val() == "") {
            setTimeout(() => {
                mobile_phone.addClass('wp-not-valid');
                mobile_phone.parent().append('<span class="not-valid-field">The field is required</span>');
            }, 100);
        }
        if (gender.length == 0) {
            setTimeout(() => {
                jQuery('input[name=gender]').next().css('color', 'red');
            }, 100);
        }
        if (email.val() == "") {
            setTimeout(() => {
                email.addClass('wp-not-valid');
                email.parent().append('<span class="not-valid-field">The field is required</span>');
            }, 100);
        }

        let pattern = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        //let pattern2 = /^[0-9]/i;

        if (!pattern.test(email.val()) && email.val() !== "") {
            setTimeout(() => {
                email.addClass('wp-not-valid');
                email.parent().append('<span class="not-valid-field">Please enter correct field</span>');
            }, 100);
        }
        if (signup_password.val().length < 6) {
            setTimeout(() => {
                signup_password.addClass('wp-not-valid');
                signup_password.parent().append('<span class="not-valid-field">Password is too short</span>');
            }, 100);
        }
        if (first_name.val() !== "" && last_name.val() !== "" && city.val() !== "" && street.val() !== "" && mobile_phone.val() !== "" && zip_code.val() !== "" && email.val().length > 6 && pattern.test(email.val()) && signup_password.val() !== "" && country.val() !== "" && gender.length !== 0) {
            $.ajax({
                type: "POST",
                dataType: "html",
                url: ajax_posts.ajaxurl,
                data: {
                    first_name: first_name.val(),
                    last_name: last_name.val(),
                    mobile_phone: mobile_phone.val(),
                    signup_password: signup_password.val(),
                    city: city.val(),
                    street: street.val(),
                    zip_code: zip_code.val(),
                    country: country.val(),
                    gender: gender.val(),
                    email: email.val(),
                    action: 'signup_func'
                },
                success: function(data) {
                    let user_data = jQuery.parseJSON(data);
                    console.log(user_data);
                    if (user_data.hasOwnProperty('login')) {
                        window.location = '/members/' + user_data.login + '/dashbord/';
                    } else {                        
                        jQuery('.rh_form__response .rh_form__msg').empty();
                        jQuery('#singup-message-user').append(user_data.error);
                        jQuery('.rh_form__response .rh_form__msg').fadeIn();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR, textStatus, errorThrown);

                }
            });
        }
    });
    jQuery('#account-menu__toggle').click(function() {
        jQuery('.account__sitebar-menu').slideToggle();
    });
    $('#slider-main').owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        autoplay:true,
        autoplayTimeout:3000,
        // autoplayHoverPause:true,
        responsive:{
            0:{
                items:1
            },
        }
    });
    $('#slider-testimonial > div').owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1
            },
        }
    });

    $('#dashbord-slider').owlCarousel({
        // loop: true,
        margin: 0,
        nav: true,
        // autoplayHoverPause:true,
        responsive:{
            0:{
                items:1
            },
        }
    });

    $('#post-slider').owlCarousel({
        // loop: true,
        margin: 40,
        nav: true,
        // autoplayHoverPause:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2,
                margin: 25,
            },
            991:{
                items:3
            },
            2000:{
                items:4
            },
        }
    });
    setTimeout(() => {
         $('#post-slider').css('opacity', 1);
    }, 500);

    $('.et_pb_toggle_close').find('.et_pb_toggle_content').css('display', 'none');
    //$('.et_pb_accordion_item:eq').css('display', 'block');

    $('.et_pb_accordion_item').click(function(e) {
        e.preventDefault();
        $(this).toggleClass('et_pb_toggle_close');
        $(this).toggleClass('et_pb_toggle_open');
         $(this).find('.et_pb_toggle_content').slideToggle();
    });
    jQuery(".classform-select select").focus(function () {
        jQuery(this).parent().addClass('open');
    });
    jQuery(".classform-select select").focusout(function () {
        jQuery(this).parent().removeClass('open');
    });
    jQuery('#share-view').click(function(e) {
        //e.preventDefault();
        $('.popup-share').fadeToggle();
    });
    $('.popup-share').mouseleave(function(e) {
        //e.preventDefault();
         $('.popup-share').fadeOut();
    });
    let img1 = jQuery('.resize-img');
    let height = img1.width()/ 1.45;
    img1.height(height);
    img1.css('min-height', height);
    jQuery(window).resize(function(){
        let el = jQuery('.resize-img');
        let height = el.width()/ 1.45;
        el.height(height);
        el.css('min-height', height);
    });

    let img_minister = jQuery('.block-ministers img');
    let height_minister = img_minister.width()/ 1.089;
    img_minister.height(height_minister);
    img_minister.css('height', height_minister);
    jQuery(window).resize(function(){
        let el_minister = jQuery('.block-ministers img');
        let height_minister = el_minister.width()/ 1.089;
        el_minister.height(height_minister);
        el_minister.css('height', height_minister);
    });

    let img2 = jQuery('.img-carousel');
    let height2 = img2.width()/ (0.83);
    img2.height(height2);
    img2.css('min-height', height2);
    jQuery(window).resize(function(){
        let el = jQuery('.img-carousel');
        let height2 = el.width()/ (0.83);
        el.height(height2);
        el.css('min-height', height2);
    });
    
    let img3 = jQuery('.blog-sitebar-img');
    let height3 = img3.width()/ (1.4);
    img3.height(height3);
    jQuery(window).resize(function(){
        let el = jQuery('.blog-sitebar-img');
        let height3 = el.width()/ (1.4);
        el.height(height3);
    });
    let img4 = jQuery('.new-courses-img');
    let height4 = img4.width()/ (1.62);
    img4.height(height4);
    jQuery(window).resize(function(){
        let el = jQuery('.new-courses-img');
        let height4 = el.width()/ (1.62);
        el.height(height4);
    });
    
    let img5 = jQuery('.forum-list-img');
    let height5 = img5.width();
    img4.height(height5 - 20);
    jQuery(window).resize(function(){
        let el = jQuery('.forum-list-img');
        let height5 = el.width();
        el.height(height5 - 20);
    });
    $('#stories-more').click(function(e) {
        e.preventDefault();
        let el = $(this);
        let numPage = el.attr('data-pn');
        let all_page = el.data('all');
        console.log(all_page);
        console.log(numPage);
        console.log(el.data('lastid'));

        $.ajax({
            type: "POST",
            dataType: "html",
            url: ajax_posts.ajaxurl,
            data: {
                last_id: el.data('lastid'),
                numPage: numPage,
                action: 'add_stories_func'
            },
            success: function(data) {
                let $data = $(data);
                if ($data.length) {
                    $("#add-stories-row").append($data);
                    $("#stories-more").attr("disabled", false);
                } else {
                    $("#stories-more").attr("disabled", true);
                }
                numPage = parseInt(numPage);
                numPage++;
                $("#stories-more").attr('data-pn',  numPage);

                if (all_page < numPage) {
                    $("#stories-more").hide();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR, textStatus, errorThrown);
            }

        });
    });
    
    jQuery('#select-sortby').change(function() {
		let sort = jQuery(this).val();
		let urlBase = location.href.substring(0, location.href.lastIndexOf("/")+1);
		
        window.location = urlBase + '?ld-status=' + sort;

	});
    $('#btn-signup').click(function(e) {
        $(this).hide();
        $('#popup__form-1').hide();
        $('#popup__form-2').fadeIn();
        $('#btn-login').fadeIn();
        $('#login-form-popup').hide();
        $('#signup-form').fadeIn();
    });
    $('#btn-login').click(function(e) {
        $(this).hide();
        $('#popup__form-2').hide();
        $('#popup__form-1').fadeIn();
        $('#btn-signup').fadeIn();
        $('#signup-form').hide();
        $('#login-form-popup').fadeIn();
    });
    //register-now btn rosim page
    $('#register-now').click(function(e) {
        e.preventDefault();
        $('#btn-login').show();
        $('#btn-signup').hide();
        $('#custom-passreset').hide();
        $('#popup__form-1').hide();
        $('.popup-wrap').fadeIn();
        $('.popup-block').addClass('active');
        $('#signup-form').show();
    });
    // Comments  form
    $('#submit-comment').click(function(e) {
        e.preventDefault();
        let btn = $(this);
        let post_id = btn.data('postid');
        let name = $('#comment-name').val();
        let comment = $('#comment').val();
        if(comment != '' && name != '') {
            $.ajax({
                type: "POST",
                dataType: "html",
                url: ajax_posts.ajaxurl,
                data: {
                    post_id: post_id,
                    name: name,
                    comment: comment,
                    action: 'form_comment_add'
                },
                success: function(data) {
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR, textStatus, errorThrown);
                }

            });
        } else {
            $('.error__empty-fields').fadeIn();
            setTimeout(() => {
                $('.error__empty-fields').css('display', 'none');
            }, 3000);
        }
    });

	// uploud file
	var fileInput = document.querySelector(".input-file"),
		button = document.querySelector(".input-file-trigger");		
	if ($(".input-file-trigger").length) {
		button.addEventListener("keydown", function (event) {
			if (event.keyCode == 13 || event.keyCode == 32) {
				fileInput.focus();
			}
		});
		button.addEventListener("click", function (event) {
			fileInput.focus();
			return false;
		});
		var  files = [];
		var files_arr = [];

		fileInput.addEventListener("change", function (event) {
			let maxsize = 20971520;
			let allfilesize = (localStorage.getItem("allfilesize") * 1);
			let $input = $(this);
			files = this.files;
			let $file_name = [];		
			//console.group(files);

			for(let i = 0; i < files.length; i++){
				if(this.files[i].size < maxsize && allfilesize < maxsize && (allfilesize + this.files[i].size) < maxsize) {
					console.log(files);
					let file = files[0];
					let thumb = $('.item-logo img');
					let reader = new FileReader();

					reader.onload = function() {
						let url = reader.result;

						thumb.attr('src', url);
					};
					reader.readAsDataURL(file);
				} else if (this.files[i].size > maxsize) {
				alert('File too large');
				}
				else if (allfilesize > maxsize  || (allfilesize + this.files[i].size) > maxsize) {
				alert('The size of the attached files has exceeded 20MB');
				}
				else alert("File attach error");
			}
		});		
	}
	
    	$('.delete-img-gallery').click(function() {
		let el = $(this);
		let id = el.data('id');
		let val_delete_img;
		if ($('#delete-img').val() != '') {
			val_delete_img = $('#delete-img').val() + '|' + id;
		} else {
			val_delete_img = id;
		}
		
		$('#delete-img').val(val_delete_img);
		el.parent().remove();
	});

	$('.image-upload').change(function() {
		let el = $(this);
		let id = el.data('id');
		let val_delete_img;
		if ($('#delete-img').val() != '') {
			val_delete_img = $('#delete-img').val() + '|' + id;
		} else {
			val_delete_img = id;
		}
		$('#delete-img').val(val_delete_img);

	});
	
	$('.delete-img-this').click(function() {
		let el = $(this);
        let id = el.data('id');		
       	if ($('#delete-img').val() != '') {
			val_delete_img = $('#delete-img').val() + '|' + id;
		} else {
			val_delete_img = id;
		}
		$('#delete-img').val(val_delete_img);
        el.parent().remove();
	});
    // input file
			function initImageUpload(box) {
				let uploadField = box.querySelector(".image-upload");

				uploadField.addEventListener("change", getFile);

				function getFile(e) {
					let file = e.currentTarget.files[0];
					checkType(file);
				}

				function previewImage(file) {
					let thumb = box.querySelector(".js--image-preview"),
						reader = new FileReader();

					reader.onload = function() {
						thumb.style.backgroundImage = "url(" + reader.result + ")";
					};
					reader.readAsDataURL(file);
					thumb.className += " js--no-default";
				}

				function checkType(file) {
					let imageType = /image.*/;
					if (!file.type.match(imageType)) {
						throw "Datei ist kein Bild";
					} else if (!file) {
						throw "Kein Bild gewählt";
					} else {
						previewImage(file);
					}
				}
			}

			// initialize box-scope
			
				
				var boxes = document.querySelectorAll(".box");

				for (let i = 0; i < boxes.length; i++) {
					let box = boxes[i];
					initDropEffect(box);
					initImageUpload(box);
				}
	
			/// drop-effect
			function initDropEffect(box) {
				let area,
					drop,
					areaWidth,
					areaHeight,
					maxDistance,
					dropWidth,
					dropHeight,
					x,
					y;

				// get clickable area for drop effect
				area = box.querySelector(".js--image-preview");
				area.addEventListener("click", fireRipple);

				function fireRipple(e) {
					area = e.currentTarget;
					// create drop
					if (!drop) {
						drop = document.createElement("span");
						drop.className = "drop";
						this.appendChild(drop);
					}
					// reset animate class
					drop.className = "drop";

					// calculate dimensions of area (longest side)
					areaWidth = getComputedStyle(this, null).getPropertyValue("width");
					areaHeight = getComputedStyle(this, null).getPropertyValue("height");
					maxDistance = Math.max(parseInt(areaWidth, 10), parseInt(areaHeight, 10));

					// set drop dimensions to fill area
					drop.style.width = maxDistance + "px";
					drop.style.height = maxDistance + "px";

					// calculate dimensions of drop
					dropWidth = getComputedStyle(this, null).getPropertyValue("width");
					dropHeight = getComputedStyle(this, null).getPropertyValue("height");

					// calculate relative coordinates of click
					// logic: click coordinates relative to page - parent's position relative to page - half of self height/width to make it controllable from the center
					x = e.pageX - this.offsetLeft - parseInt(dropWidth, 10) / 2;
					y = e.pageY - this.offsetTop - parseInt(dropHeight, 10) / 2 - 30;

					// position drop and animate
					drop.style.top = y + "px";
					drop.style.left = x + "px";
					drop.className += " animate";
					e.stopPropagation();
				}
			}

			//end;
        jQuery('#add-more-img').click(function(e) {
            e.preventDefault();
            let num = jQuery('.box').length;
            num = num;
            let newElems = jQuery('<div class="box"></div>');
			newElems.append('<span class="delete-img delete-img-this">+</span>');
            newElems.append('<div class="js--image-preview"></div>');
            newElems.append('<div class="upload-options"><label><input type="file" class="image-upload new" accept="image/*" name="image-upload-' + num + '"></label></div>');
            jQuery('#add-more-img').before(newElems);

            jQuery(".image-upload.new").change(function(e) {
                let box = jQuery(this).parent().parent().parent();
                let uploadField = box.find(".image-upload");
                let file = e.currentTarget.files[0];
                let thumb = box.find(".js--image-preview");
                let reader = new FileReader();

                reader.onload = function() {
                    let url = "url(" + reader.result + ")";

                    thumb.css('background-image', url);
                };
                reader.readAsDataURL(file);
                thumb.addClass('js--no-default');
            });
            jQuery('.delete-img').click(function() {
                let el = jQuery(this);
                el.parent().remove();
            });
        });
        // add bg
        jQuery(".image-upload.new").change(function(e) {
            let box = jQuery(this).parent().parent().parent();
            let uploadField = box.find(".image-upload");
            let file = e.currentTarget.files[0];
            let thumb = box.find(".js--image-preview");
            let reader = new FileReader();

            reader.onload = function() {
                let url = "url(" + reader.result + ")";

                thumb.css('background-image', url);
            };
            reader.readAsDataURL(file);
            thumb.addClass('js--no-default');

        });
		$('#btn-file-1').click(function(e) {
            e.preventDefault();
            $('#file').trigger('click')
        });
		    jQuery('.add-gallery').click(function(e) {
            let el = jQuery(this);
            e.preventDefault();
            e.stopPropagation();
            let index = +(el.data('index'));
            // let index = 3;
            jQuery('#input-file-' + index).click();
            let value = jQuery('#input-file-' + index).val();


        });
        $('.add-gallery').click(function(e) {
            let el = $(this);
            e.preventDefault();
            el.next().click();
        });
    //end uploud file

    $('.select').each(function() {
    const _this = $(this),
        selectOption = _this.find('option'),
        selectOptionLength = selectOption.length,
        selectedOption = selectOption.filter(':selected'),
        duration = 450; 

    _this.hide();
    _this.wrap('<div class="select"></div>');
    $('<div>', {
        class: 'new-select',
        text: _this.children('option:disabled').text()
    }).insertAfter(_this);

    const selectHead = _this.next('.new-select');
    $('<div>', {
        class: 'new-select__list'
    }).insertAfter(selectHead);

    const selectList = selectHead.next('.new-select__list');
    for (let i = 1; i < selectOptionLength; i++) {
        $('<a>', {
            class: 'new-select__item',
            html: $('<span>', {
                text: selectOption.eq(i).text()
            })
        })
        .attr('href', selectOption.eq(i).data('href'))
        .appendTo(selectList);
    }

    const selectItem = selectList.find('.new-select__item');
    selectList.slideUp(0);
    selectHead.on('click', function() {
        if ( !$(this).hasClass('on') ) {
            $(this).addClass('on');
            selectList.slideDown(duration);

            selectItem.on('click', function() {
                let chooseItem = $(this).data('value');

                $('select').val(chooseItem).attr('selected', 'selected');
                selectHead.text( $(this).find('span').text() );

                selectList.slideUp(duration);
                selectHead.removeClass('on');
            });

        } else {
            $(this).removeClass('on');
            selectList.slideUp(duration);
        }
    });
});

});