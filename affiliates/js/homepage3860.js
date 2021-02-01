$(function(){
	/* Registration */
	$('#register, #join-free').click(function(){
		initDialog('#register-dialog' , 'urbus Affiliate Registration');
		var $form	= $('#regForm'),
		newRules = {
				first_name: {	
					required: true
				},
				last_name: {
					required: true
				},
				email: {
					required: true,
					email: true,
					remote: "/api/auth/check_email"
				},
				password: {
					required: true,
					minlength: 6,
					maxlength : 20
				},
				confirm_password: {
					required: true,
					minlength: 6,
					maxlength : 20,
					equalTo: "#password"
				}
		},
		newMessages = {
					first_name: "Enter first name",
					last_name: "Enter last name",
					email: {
						required: "Please enter a valid email address",
						minlength: "Please enter a valid email address",
						remote: jQuery.format("{0} is already in use")
					},
					password: {
						required: "Please provide a password",
						rangelength: jQuery.format("Please entere 6-20 characters")
					},
					password_confirm: {
						required: "Please enter your password again",
						minlength: jQuery.format("Please enter your password again"),
						equalTo: "Passwords are not the same"
					}
		},
		submitAction = function() {
			registerBtnSubmitHandler($form);
		};
		formValidate($form , newRules , newMessages , submitAction);
	});

	/*
	* Handle the form submission for registration.
	*/
	function registerBtnSubmitHandler($form) {
		$.ajax({
			type: "POST",
			url: $form.attr('action'),
			data: $form.serialize(),
			beforeSend: function(){
				loadingStart('#register-dialog-loading');
			},
			complete: function(){
				loadingStop('#register-dialog-loading');
			},
			success: function(response) {
				if (response.success) {				// form submitted successfully
					closeAllTips();
					//set the value of email in next dialog before reseting the form values.
					$('#registerSuccessful-dialog .display-email').html($('#email').val());
					resetForm($form);
					initDialog('#registerSuccessful-dialog', 'Confirm Your Email Address');
				}else {
					$('[type=password]').val('');
					$('#registration-alert').html(response.data.error);
					$('#registration-alert').removeClass('hidden');
					Recaptcha.reload();
				}
			}
		});
	}

	/** 
	* Handle the resend email just after the registration dialog.
	*/
	$('#resend-mail-link').click(function(e){
		e.preventDefault();
		$('#registerSuccessful-dialog .loading-ico').removeClass('hidden');
		$.ajax({
			type: "POST",
			url: '/api/auth/resendActivationEmail',
			data : { email : $('#registerSuccessful-dialog .display-email').html()},
			success: function(data)
			{
				$('#registerSuccessful-dialog .loading-ico').addClass('hidden');
				if (data.success) {
					$('#mail-sent').html('<div class="alert alert-success">Mail Sent.</div>');
				}else {
					$('#mail-sent').html('<div class="alert alert-error">Error in sending Mail. Try Again.</div>');
				}
			}
			});	
	});

	/* Login related stuff */
	$('#login').click(function(){
		initDialog('#login-dialog' , 'urbus Affiliate login');
		var $form	= $('#loginForm'),
		newRules    = {
					login: {
						required: true,
						email: true,
						remote: "/api/auth/check_email/?disp=invert"
					},
					password: {
						required: true,
						minlength: 5
					}
		},
		newMessages = {
					login: {
						required: "Please enter a valid email address",
						minlength: "Please enter a valid email address",
						remote: jQuery.format("No Account with email {0}")
					},
					password: {
						required: "Provide a password",
						rangelength: jQuery.format("Enter at least {0} characters")
					}
					},
		submitAction = function() {
			loginBtnSbmtHandler($form);
		};
		formValidate($form , newRules , newMessages , submitAction);
	});

	/*
	* Handle the form submission for Login.
	*/
	function loginBtnSbmtHandler($form) {
		$.ajax({
			type: "POST",
			url: $form.attr('action'),
			data: $form.serialize(),
			beforeSend: function(){
				loadingStart('#login_loading');
			},
			complete: function(){
				loadingStop('#login_loading');
			},
			success: function(response) {
				if (response.success) {
					// redirect to the dashboard url set by server.
					window.location = '//'+ location.hostname + response.data.redirect_url;
				}else {
					$('#login-alert').html(response.data.error);
					$('#login-alert').show();
				}
			}
		});
	}

	$('#forgotPassword').click(function(){
		closeAllTips();
		initDialog('#forgotpassword-dialog' , 'Forgot Password - Enter Email');
		var $form	= $('#forgotPasswordForm'),
		newRules	= {
					email: {
						required: true,
						email: true,
						remote: "/api/auth/check_email/?disp=invert"
					}
		},
		newMessages = {
					email: {
						required: "Please enter a valid email address",
						minlength: "Please enter a valid email address",
						remote: jQuery.format("No account with email {0}")
					}
		},
		submitAction = function() {
			fgtPassBtnAction();
		};
		formValidate($form , newRules , newMessages , submitAction);
	});


	function fgtPassBtnAction(){
		var email = $('#forgotbtn-email').val();
		var code ;
		$.getJSON('/api/auth/getSecretQuestionForUser/?email=' + email, function(response){
			closeAllTips();
			$('#secretqa-dialog').html(response.data.html);
			code = response.data.code;
			initDialog('#secretqa-dialog' , 'Forgot Password - Answer Security Question');
			$('#forgotSecretQa').click(forgotSecurityQaBtnAction);
			var $form	= $('#secretQaForm'),
			newRules    = {
						security_answer: {
							required: true,
						}
			},
			newMessages = {
						security_answer: {
							required: "Security password cannot be blank",
						}
			},
			submitAction = function() {
				secretQaBtnAction(code,email, $form);
			};
			formValidate($form , newRules , newMessages , submitAction);
		});
		
	};
	
	function secretQaBtnAction(code, email, $form){
		$.ajax({
			type: "POST",
			url: '/api/auth/verifySecurityAnswer',
			data: $form.serialize() + "&code=" + code +"&email="+email,
			beforeSend: function(){
				loadingStart('#security_loading');
			},
			complete: function(){
				loadingStop('#security_loading');
			},
			success: function(response) {
				if (response.success) {
					$.ajax({
						type: 'POST',
						url:'/api/auth/forgotPassword',
						data: {login:email},
						success: function(response2){
							//loadingStop('#security_loading');
							closeAllTips();
							if (response2.success){
								initDialog('#passreset-dialog' , 'Forgot Password - Reset Password Email Sent');
							} else {
								alert(response2.data.error);
							}
						}
					});
				}else {
					$('#secretAnswerError').html(response.data.error);
					$('#secretAnswerError').show();
					resetForm($form);
				}
			}
		});		
	};

	$('#pass_email_resend_link').click(function(e){
		e.preventDefault();
		var email = $('#forgotbtn-email').val();
		$('#pass_email_resend_loading .loading-ico').removeClass('hidden');
		$.ajax({
			type: "POST",
			url: '/api/auth/forgotPassword',
			data : { login : email},
			success: function(data)
			{
				$('#pass_email_resend_loading .loading-ico').addClass('hidden');
				if (data.success) {
					$('#pass_reset_mail-sent').html('<div class="alert alert-success">Forgot Password Email Sent.</div>');
			   }else {
					$('#pass_reset_mail-sent').html('<div class="alert alert-error">Error in sending Mail. Try Again.</div>');
				}
			}
			});	
	});
	function forgotSecurityQaBtnAction(){
		closeAllTips();
		initDialog('#forgotsecurityans-dialog' , 'Forgot Security Answer');
	}
			

	//Close All Tooltip Dialog Function
	function closeAllTips()
	{
		$('*').qtip('hide');
	}
	//Get Email Id Which is Typed in the Forgot password screen
	function getEmailId(){
		var getEId = $('#forgotbtn-email').val();
		$('.display-email').html(getEId);
	}


	function resetForm($form) {
		var id = '#' + $form.attr('id');
		$form.validate().resetForm();
		$form[0].reset();
		$(id +  " div.error").removeClass("haserror , success");
	}

	$('.help-faq .ol-list li h3').click(function(){
		if($(this).next('.ans-section').is(':visible')){
			$('.help-faq .ol-list li .ans-section').slideUp( "slow" );
		} else{
			$('.help-faq .ol-list li .ans-section').slideUp( "slow" );
			$(this).next('.ans-section').slideDown( "slow" );
		}
	});

	$('.help-wrap h3').click(function(){
		$this = $(this);
		if($this.next('.help-ans').is(':visible')){
			$('.help-wrap .help-ans').slideUp();
			$('.arrow-down').css('backgroundPosition','-269px -127px')
		} else{
			$('.help-wrap .help-ans').slideUp();
			$this.next('.help-ans').slideDown();
			$('.arrow-down').css('backgroundPosition','-269px -127px')
			$this.find('.arrow-down').css('backgroundPosition','-269px -138px')
		}
	});
});

