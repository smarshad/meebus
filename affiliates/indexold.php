<?php
ob_start();
@session_start();
//include_once("google/config.php");
include_once '../database/connect.php';
//include_once("google/includes/functions.php");

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
		<title>urbus Affiliate Program | Online Bus Ticket Booking , Hotel Booking, Flight Booking Affiliate</title>
		<meta content="Become a urbus Affiliate and Earn Commissions with India's largest real-time bus ticket portal. Join the Affiliate program for Free 
and start earning commissions for bus ticket booking." name="description" />
		<meta content="urbus affiliate program, Bus booking affiliate, urbus affiliate program, Bus ticket affiliate program,Bus affiliate partner program, Referral commission program" name="keywords" />
		<meta content="urbus.com" name="author" />
         <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon" />
		<meta content="global" name="distribution" />
		<meta content="general" name="rating" />
		<meta content="follow, index, all" name="robots" />
		<meta content="index,follow" name="googlebot" />
		<meta content="1 days" name="revisit-after" />
		<meta content="Public" name="doc-type" />
		<meta content="travel" name="classification" />
		<meta content="en" http-equiv="content-language" />
		<meta content="text/html; charset=utf-8" http-equiv="content-type" />
        <link href="css/reset3860.css?v=1" type="text/css" rel="stylesheet" />
        <link href="css/jquery.qtip3860.css?v=1" type="text/css" rel="stylesheet" />
        <link href="css/opensans3860.css?v=1" type="text/css" rel="stylesheet" />
        <link href="css/common3860.css?v=1" type="text/css" rel="stylesheet" />
		</head>
	<body class="home affilite-bg">

		<div class = "header clearfix">
			<div class="left logo">
				<a href="#" title="Online Bus Ticket Booking"><img src="../images/logo2.png" alt="urbus - Online Bus Ticket Booking" /></a>
			</div>
			<span class="seperator left"></span>
			<span class="affiliate-head left">Bus Affiliate Partner</span>
			<a href="javascript:void(0)" id="login" class="login-btn right">Login</a>
		</div>

		<div class="banner-content-wrap clearfix">
			<div class="affiliate-diagram-wrap wrap center clearfix">
				<div class="affiliate-block block-orange left">
					<span class="affiliate-sprite aff-num num-1"></span>
					<span class="affiliate-sprite aff-icon join"></span>
					<span class="aff-text">join us</span>
				</div>
				<div class="affiliate-block block-grey left">
					<span class="affiliate-sprite aff-num num-2"></span>
					<span class="affiliate-sprite aff-icon link"></span>
					<span class="aff-text1">link websites</span>
				</div>
				<div class="affiliate-block block-blue left">
					<span class="affiliate-sprite aff-num num-3"></span>
					<span class="affiliate-sprite aff-icon money"></span>
					<span class="aff-text">make money</span>
				</div>
			</div>
			<div class="affiliate-banner-btm">
				<div class="affiliate-btm-content wrap center clearfix">
					<span class="affiliate-sprite curly-braze-left left"></span>
					<div class="heading-wrap left">
						<h2>Do you own <span>Website?</span></h2>
						<h2>Make money by becoming <span>urbus Affiliate</span></h2>
					</div>
					<span class="affiliate-sprite curly-braze-right left"></span>
					<a href="javascript:void:0" class="join-btn right">
						<span class="join-arrow-wrap left">
							<span class="affiliate-sprite arrow-right"></span>
						</span>
						<span id="register" class="join-text-wrap left">join for free</span>
					</a>
				</div>
			</div>
			<a href="javascript:void(0)" id="affiliateScrollBtn" class="affiliate-sprite scroll-btn"></a>
		</div>

		<div class="description-wrap">
			<div class="wrap center description-content-wrap" id="affiliateScrollStop">
				<h2 class="txtCenter">urbus.com Bus Ticket Booking Affiliate Program: Help us to help you.</h2>
				<p>
					Affiliate with urbus.com, India's most trusted bus booking service and make easy money. All you got to do is register with us and add our widgets to your website or blog. It is that simple.  The best part about affiliating with urbus.com is that it is absolutely free.
				</p>
			</div>	
		</div>

		<div class="content-btm wrap center">
			<h2>
				<span class="affiliate-sprite help-icon"></span>
				Help &amp; FAQs
			</h2>

			<div class="help-wrap">
				<h3>
					What is urbus.com affiliate program and how does it work?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">The urbus.com affiliate program is a fantastic way of earning money through commission by placing urbus.com bus search widgets on your website. You could earn up to 5% each time a user searches for buses and makes a purchase on our site using your website's/blog's widget.</div>
				<h3>
					Who can I contact for more information or help?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">In case you have any queries, feel free to email us at <strong>affiliate@urbus.com</strong>. We will get back to you within 72 hours.</div>
				<h3>
					How does one become eligible to affiliate with urbus.com and when and how do I earn referral commission?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">For you to be eligible to affiliate with urbus.com, you need to run a website or a blog. In order to earn a referral commission, your website/blog visitor must click-through the search buses widget which redirects them to urbus.com website and book bus tickets in a single session. The referral fees will be paid only after the journey is completed.</div>
				<h3>
					How do I create a widget and add it to my website/blog?
					<span class="affiliate-sprite arrow-down"></span>					
				</h3>
				<div class="help-ans">
					<span>Creating a widget is quick and simple. All you got to do is register with urbus.com's affiliate program.  The steps are as follows:</span>
					<ul class="clearfix">
						<li>Go to the urbus.com affiliate page and click on register. Fill in your details, follow the instructions, register yourself and you're set.</li>
						<li>Log-in to your affiliate account and click the <strong>Affiliate Tools</strong> tab followed by the <strong>Create New Widget</strong> tab.</li>
						<li>Enter the required details, choose your desired widget dimension and size from the drop down box (the preview of the widget size can be seen at the bottom left of the page) and click on <strong>Create Widget</strong>.</li>
						<li>Go to the <strong>Manage Widgets</strong> tab and under the heading <strong>Action</strong>, click the <strong>Get Code</strong> option to render a Java script code.</li>
						<li>Copy the Java script code and paste it in the HTML code space of your website or blog page.</li>
						<li>The widget will appear on your blog.</li>
					</ul>
				</div>
				<h3>
					How does the widget work?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">The search buses widget is an advertisement for urbus.com on your website/ blog. The widget permits your site visitors to search for buses, select the routes and places they wish to travel along with the date of departure. Once the visitor clicks on search buses, s/he will be redirected to urbus.com and will be presented with a list of bus services as per their search requirements. The visitor can then book the bus journey of their choice, thus earning you commission through our generated revenue.</div>
				<h3>
					How do I find out which routes and journey date visitors selected?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">You can find the details in the <strong>Search Report</strong> section in the report section.</div>
				<h3>
					How many widgets can I feature on my website?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">There is no limit to number of widgets you can feature on your website. However as a practice, we do not recommend more than 3 widgets on a single page.</div>
				<h3>
					I own many websites. Can I implement widgets on all of them?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">Yes, you can implement widgets on any site that you own. However, we do ask that you comply with the policies outlined on the <strong>Terms and Conditions</strong> page.</div>
			</div>

			<h2>
				<span class="affiliate-sprite payout-icon"></span>
				Payouts
			</h2>

			<div class="help-wrap">
				<h3>
					How much can I earn via the urbus.com affiliate program?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">The commission you earn depends on the number of bus tickets and the cost of the bus tickets booked on urbus.com using the widget on your website. You earn a 5% commission for every bus ticket booked through your widget.</div>
				<h3>
					What are the payment methods?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">Affiliates are paid through Electronic Fund Transfer (EFT). urbus.com will accrue and withhold referral fees until the total amount due is at least Rs. 500.00. Accrued Payment is done once a month.</div>
				<h3>
					When is the payment made?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">We process payments by the last week of the following month. For instance, your June earnings would be paid by late July.</div>
				<h3>
					What are the details I have to provide to be able to receive payments?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">To receive payments, you need to fill out the details in the <strong>Payment Information</strong> section in <strong>Account Settings</strong>. We require all your necessary details (PAN, Payee Name and Mailing Address) to process the payment.</div>
				<h3>
					Are there any charges for my earnings?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">A 10% TDS is deducted on all payments made through Electronic Fund Transfer (EFT). Apart from this, there are no charges applicable.</div>
				<h3>
					What happens to my referral fees if they do not meet the minimum payment threshold?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">If the commission earned is less than Rs. 500, your fees will be rolled into the next month's total.</div>
				<h3>
					How do I keep track of my earnings and sales?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">The details of your earnings and sales are available in the Report section.</div>
				<h3>
					What if a bus booking is cancelled/partially cancelled by the customer or bus service is cancelled by the operator?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">In such a case, the user will be refunded as per refund policy of the website. However, the affiliate's account will not earn any commission on that transaction.</div>
				<h3>
					How do I view my payment history?
					<span class="affiliate-sprite arrow-down"></span>
				</h3>
				<div class="help-ans">Your payment history will be available on the <strong>Earning and Payments</strong> report on your account homepage.</div>				
			</div>

			<h3 class="affiliate-terms-link">Most Important - <a href="termsAndConditions.php" class="blk-link" target="_blank">Terms &amp; Conditions</a></h3>

		</div>
<iframe src="../affiliates-footer.php" height="350" width="100%" frameborder="0"></iframe>

	<div id="wrapper">			
			<div id="qtip-dialog-content" style="display: none;">
				Register Content Starts 
				<script type="text/javascript">
 var RecaptchaOptions = {
    theme : 'white'
 };
 </script>
<div id="register-dialog">
	<div id="registration-alert" class="alert alert-error hidden"></div>
	<form id="regForm" class="form pad10" action="aff_checklogin.php" >
		<fieldset>
			<div class="row clearfix">
				<label>Name</label>
				<div class="left field-div">
					<input type="text" name="fname" value="" id="fname" title="First Name" placeholder="First Name" class="small marR10"  />					
                    <input type="text" name="last_name" value="" id="last_name" title="Enter last name" placeholder="Last Name" class="small"  />					
                    <div class="error"></div>
				</div>
			</div>
			<div class="row clearfix">
				<label>Email</label>
				<div class="left field-div">
					<input type="text" name="email" value="" id="email" title="This will be used to sign-in to your affiliate account"  />					<div class="error"></div>
				</div>
			</div>
			<div class="row clearfix">
				<label>Password</label>
				<div class="left field-div">
					<input type="password" name="password" value="" id="password" maxlength="25" title="Please enter 6-20 characters"  />
					<div class="error"></div>
				</div>
			</div>
			<div class="row clearfix">
				<label>Confirm Password</label>
				<div class="left field-div">
					<input type="password" name="confirm_password" value="" id="confirm_password" maxlength="25" title="Please enter your password again"  />					<div class="error"></div>
				</div>
			</div>
			<div class="row clearfix">
				<label>Website URL</label>
				<div class="left field-div">
					<input type="text" name="websites" value="" id="websites" maxlength="50"  />					<div class="error"></div>
				</div>
			</div>
			
			<div class="row clearfix">
				<label>&nbsp;</label>
				<div class="left">
					<input type="submit"  class="btn-orange btn-bold">Register</button>
					<span id="register-dialog-loading" class="hidden loading-ico"></span>
					<p class="font11-gray padT15">By clicking on "Register" above, I agree to the <a href="termsAndConditions.php" target="_blank">urbus Affiliate Program Terms & Conditions</a>.</p>
				</div>
			</div>

		</fieldset>
	</form>
</div>
				<div id = "registerSuccessful-dialog">
	<div id="mail-sent"></div>
	<div class="font14">
		<p>Congratulations for signing up for urbus Affiliate Program.</p>
		<p class="padT15">We have send a confirmation email to <strong class="display-email"></strong>.</p>
		<p class="padT15">In order to complete your registration, Please confirm your email address.</p>

		<h5 class="padT40">Didn&#39;t receive our email?</h5>
		<ol class="number-list">
			<li>Check your spam box</li>
			<li>Resend confirmation email to <span class="display-email"></span>. <a href="#"  id="resend-mail-link" class="font13-blue">Resend now</a></li>
			<span class="hidden loading-ico"></span>
		</ol>
	</div>
</div>
				
<div id="login-dialog">
	<div id ="login-alert" class="hidden alert alert-danger"></div>
	<form id="loginForm" class="form pad10" action="http://affiliates.urbus.com/api/auth/login">
		<fieldset>
			<div class="row clearfix">
				<label>Email</label>
				<div class="left field-div hideSuccess">
					<input type="text" name="login" value="" id="login" title="Please enter your registered email address"  />					<div class="error"></div>
				</div>
			</div>
			<div class="row clearfix">
				<label>Password</label>
				<div class="left field-div">
					<input type="password" name="password" value="" id="login-password" title="Password"  />					<div class="error"></div>
				</div>
			</div>
			<div class="row clearfix">
				<label>&nbsp;</label>
				<div class="left">
					<button class="btn-orange btn-bold">Login</button>
					<span id="login_loading" class="hidden loading-ico"></span>
					<a href="#" id="forgotPassword" class="font13-blue marL15">Forgot Password?</a>
				</div>
			</div>
		</fieldset>
	</form>
</div>				Login Content Ends 

				Forgot Password Content Starts 
				<div id="forgotpassword-dialog">
	<form id="forgotPasswordForm" class="form pad10">
		<fieldset>
			<div class="font14 padB25">
				To request a new password, please enter your registered email with urbus Affiliate program
			</div>
			<div class="row clearfix">
				<label>Email</label>
				<div class="left field-div">
					<input id="forgotbtn-email" title="Email" type="text" name="email" placeholder="Please enter your registered email address" />
					<div class="error"></div>
				</div>
			</div>
			<div class="row clearfix">
				<label>&nbsp;</label>
				<div class="left">
					<button class="btn-orange btn-bold">Submit</button>
				</div>
			</div>
		</fieldset>
	</form>
</div>				Forgot Password Content Ends 

				Secret QA Content Starts 
				<div id="secretqa-dialog"></div>
				Secret QA Content Ends 

				Password Reset Email Sent Content Starts 
				<div id="passreset-dialog">
	<div id="pass_reset_mail-sent"></div>
	<div class="font14">
		<span id="pass_email_resend_loading" class="hidden loading-ico"></span>
		<p>We have sent an email to <strong class="display-email"></strong> with instructions to reset your password.</p>
		<p class="padT10">Please click on the link in the email to reset your password.</p>
		<h5 class="padT40">Didn&#39;t receive our email?</h5>
		<ol class="number-list">
			<li>Check your spam box</li>
			<li>Resend email to <span class="display-email"></span>. <a href="#" id="pass_email_resend_link" class="font13-blue">Resend now</a></li>
		</ol>
	</div>
</div>				Password Reset Email Sent Content Ends 

			Forgot Security Answer Content Starts 
			<div id="forgotsecurityans-dialog">
				<div class="font14">
					<p>You are requested to get in touch with <strong>affiliate@urbus.com</strong> to retrieve your account details. </p>
					<p class="padT10">We regret for the inconvenience caused. Thank you for your patience.</p>
				</div>
			</div>

		</div>
	</div> 
			<script type="text/javascript" src="js/jquery-1.8.3.min3860.js?v=1" ></script>
			<script type="text/javascript" src="js/jquery.qtip3860.js?v=1" ></script>
			<script type="text/javascript" src="js/jquery.placeholder3860.js?v=1" ></script>
			<script type="text/javascript" src="js/jquery.validate3860.js?v=1" ></script>
			<script type="text/javascript" src="js/common3860.js?v=1" ></script>
			<script type="text/javascript" src="js/homepage3860.js?v=1" ></script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('#affiliateScrollBtn').click(function(){
				$('html, body').animate({
			        scrollTop: $('#affiliateScrollStop').offset().top
			    }, 500);
			});
		});
	</script>
	
</body>
</html>