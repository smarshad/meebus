<?php 
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
    <title>meeBUS</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Stylesheets -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/popup-body.css" rel="stylesheet">
    <link href="css/popup-rightbar.css" rel="stylesheet">

    <!-- Fav Icons -->
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->

</head>

<body>
<style>
	@media only screen and (min-device-width : 360px) and (max-device-width : 640px) {
	
	.booking-form col-md-3 bg-danger{
		width: 80%;
		margin: 10px 10px 10px 43px;
	}
	
}
</style>
    <div class="page-wrapper">
        <!-- main header -->
        <header class="main-header">
            <!-- Header upper -->
            <div class="header-upper">
                <div class="container clearfix">

                    <div class="float-left logo-outer">
                        <div class="logo"><a href="index.html"><img src="images/images/meebus.png" alt="" title=""></a></div>
                    </div>

                    <div class="float-right upper-right clearfix">

                        <div class="nav-outer clearfix">
                            <!-- Main Menu -->
                            <nav class="main-menu navbar-expand-lg">
                                <div class="navbar-header">
                                    <!-- Toggle Button -->
                                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                        aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>

                                <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                                    <ul class="navigation clearfix">
                                        <li><a href="javascript:void(0);" class="show-modal" data-toggle="modal" data-target="#MyPopup">Log In</a></li>
                                        <li><a href="register.html"><button type="button" style="color:#fff; border: 3px solid #fff; border-radius: 20px;" class="btn btn-outline-danger">Sign Up</button></a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
					</div>
				</div>
            </div>
        </header>

        <!--Main Slider-->
        <section class="main-slider">

            <div class="main-slider-carousel owl-carousel owl-theme">

                <div class="slide" style="background-image:url(images/images/HeroBanner.jpg)">
                    <div class="container">
                        <div class="content">
                            <div class="row">
								<div class="booking-form col-md-3 bg-danger" style="border-radius: 28px;">
									<form>
										<center><button disabled="disabled" class="btn btn-primary">Terminal</button>
										</center>
										<br>
										<div class="row">
											<div class="form-group" style="width: 83%; margin-left: 30px;">
												<input class="form-control" type="text" style="border-radius: 8px;" placeholder="Leaving From">
											</div>
										</div>
										<div class="row">
											<div class="form-group" style="width: 83%; margin-left: 30px;">
												<input class="form-control" type="text" style="border-radius: 8px;" placeholder="Going To">
											</div>
										</div>
										<div class="row">
											<div class="form-group" style="width: 83%; margin-left: 30px;">
												<input class="form-control" type="date" style="border-radius: 8px;" required>
											</div>
										</div>
										<div class="row">
											<div class="form-group" style="width: 83%; margin-left: 30px;">
												<input class="form-control" type="date" style="border-radius: 8px;" required>
											</div>
										</div>
										<div class="form-btn">
											<center>
												<button class="btn btn-outline-primary" style="border-radius: 50%;"><i
														class="fa fa-search"></i></button>
											</center>
										</div>
									</form>
								</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<form>
										<div class="row">
											<div class="form-group" style="padding: 100px 0px 0px 30px;">
												<input class="form-control" type="date" style="border-radius: 8px;" required>
											</div>
										</div>
									</form>
								</div>
							</div>
					    </div>
                    </div>
                </div>
          
    </div>


    </div>
    </section>
    <!--End Main Slider-->



    <!-- Services section -->
    <section class="services-section sp-one bg-danger">
        <div class="container">
            <div>
                <center>
                    <h1 style="color:white;">WHAT MAKES US UNIQUE</h1>
                </center>
                <br>
            </div>
            <div class="row">
                <div class="col-lg-1"></div>

                <div class="col-lg-2 ">
                    <div class="card text-white bg-primary mb-4" style="border-radius: 30px; background-color: #485C8F !important;">
                        <div class="card-body">
                            <br>
                            <center> <span class="text-white"><i class="fas fa-map-marker-alt fa-3x"></i></span>
                            </center>
                            <br>
                        </div>
                    </div>
                    <span class="text-white">
                        <h4 class="text-white">LIVE TRACKING</h4>
                      
                    </span>
                </div>
               <div class="col-lg-2"></div>
                <div class="col-lg-2 ">
                    <div class="card text-white bg-primary mb-4" style="border-radius: 30px; background-color: #485C8F !important;">
                        <div class="card-body">
                            <br>
                            <center> <span class="text-white"><i class="fas fa-bus fa-3x"></i></span>
                            </center>
                            <br>
                        </div>
                    </div>
                    <span class="text-white">
                        <h4 class="text-white">DISCOUNT MEE BUS</h4>
                        
                    </span>
                </div>
				<div class="col-lg-2"></div>
                <div class="col-lg-2 ">
                    <div class="card text-white bg-primary mb-4" style="border-radius: 30px; background-color: #485C8F !important;">
                        <div class="card-body">
                            <br>
                            <center> <span class="text-white"><i class="fas fa-utensils fa-3x"></i></span>
                            </center>
                            <br>
                    
                        </div>
                    </div>
                    <span class="text-white">
                        <h4 class="text-white">REST STOPS</h4>
                       
                    </span>
                </div>


            </div>
            <div class="outer-box">
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4"></div>
                    <div class="col-4"></div>
                </div>
                <p style="color:white;" align="justify">"Me Bus is largesr online bus ticketing pllateform,trusted b
                    over 6 million Indians.
                    With a sale of over 10,00,00,000 bus tickets via web,mobile,and over agents, it stands
                    at the top of the game in bus ticketing. Meebus operators on over 84000 routes abd is associated
                    with 2300
                    reputed bus operators. Try the best bus experience today"
                </p>
            </div>
        </div>
    </section>

    <section class="services-section">

        <div class="main-slider-carousel owl-carousel owl-theme">

            <div class="slide" style="background-image:url(images/images/imgoce.png)">
                <div class="container">
                    <div class="content row">
                        <div class="col-lg-4">
                            <div class="image-block mb-30 wow fadeInLeft" data-wow-duration="1.2s">
                                <div class="image" style="margin-top: 110px;"><img src="images/images/mobremov.png" alt=""></div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <br><br><br><br>
                            <div class="centered">
                                <h1 style="color:white;">CONVENIENCE ON-THE-GO.</h1>
                            </div>
                            <br>

                            <p style="color:white;" align="justify">
                                Exclusive feauture on mobile include <br>
                                MEEBUS NOW - when you need a bus in the next couple<br>
                                of hours. Board a on its way. <br> <br>
                                Boarding Point Navigation -Never lose your way while <br>
                                Travelling to your boarding point!<br> <br>
                                1-click Booking- Save your favourite payment option<br>
                                Securly on bus raja, and more.
                            </p>
                            <br>
                            <button class="btn btn-outline-light"><i class="fab fa-google-play"></i> Play Store</button> &nbsp;
                            <button class="btn btn-outline-light"><i class="fab fa-app-store-ios"></i> App Store</button>&nbsp;
                            <button class="btn btn-outline-light"><i class="fab fa-windows"></i> Window Store</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <section class="services-section">




        <div class="container">
            <div class="content row">
                <div class="col-12">
                    <center>
                        <div class="image"><img src="images/Capture.PNG" alt=""></div>
                    </center>
                </div>
                <div class="col-12">
                    <div class="centered">
                        <center>
                            <B>
                                <h1 style="color: #F85E5E;">WE PROMISED TO DELIEVER</h1>
                            </B>
                        </center>
                        <br>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="card text-white bg-danger mb-3" style="border-radius: 23px; background-color: #F85E5E !important;">

                                <div class="card-body">
                                    <br>
                                    <center> <span class="text-white"><i class="fas fa-weight-hanging fa-4x"></i></span>
                                    </center>
                                    <br>
                                    <h5 class="card-title text-white"></h5>
                                    <center>MAXIMUM CHOICE</center>
                                    </h5> <br>
                                    <p class="card-text" align="justify">We Give you the widest <br> number of travel
                                        options <br> across thousand of <br> routes.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="card text-white bg-danger mb-3" style="border-radius: 23px; background-color: #F85E5E !important;">

                                <div class="card-body">
                                    <br>
                                    <center> <span class="text-white"><i class="fas fa-headset fa-4x"></i></span>
                                    </center>
                                    <br>
                                    <h5 class="card-title text-white"></h5>
                                    <center>SUPERIOR CUSTOMER SERVICE</center>
                                    </h5> <br>
                                    <p class="card-text" align="justify">We put our experience and <br> relationship to
                                        good usr <br> and are avaliable to solve <br> your travel issues.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="card text-white bg-danger mb-3" style="border-radius: 23px; background-color: #F85E5E !important;">

                                <div class="card-body">
                                    <br>
                                    <center> <span class="text-white"><i class="fas fa-rupee-sign fa-4x"></i></span>
                                    </center>
                                    <br>
                                    <h5 class="card-title text-white"></h5>
                                    <center>LOWEST PRICES</center>
                                    </h5> <br>
                                    <p class="card-text" align="justify">We always give you the <br> lowest price with
                                        the best <br> partner offers.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="card text-white bg-danger mb-3" style="border-radius: 23px; background-color: #F85E5E !important;">

                                <div class="card-body">
                                    <br>
                                    <center> <span class="text-white"><i class="fas fa-gifts fa-4x"></i></span></center>
                                    <br>
                                    <h5 class="card-title text-white"></h5>
                                    <center>UNMATCHED BENEFITS</center>
                                    </h5> <br>
                                    <p class="card-text" align="justify">We are care of your travel <br> beyond
                                        ticketing by <br> providing you with <br> innovative and unique <br> benifits.
                                    </p>
                                </div>
                            </div>
                        </div>


                    </div><!-- /.row -->


<br>
<br>
<br>
<br>

                </div>
            </div>

        </div>

        </div>
    </section>

    <section class="services">

        <div style="background-image: url(images/images/region_page-dw.jpg); border-radius: 26px;">
            <div class="container">
                <br><br>
                <div class="row">
                    <div class="col-lg-1 "></div>
                    <div class="col-lg-2 ">
                        <div class="card text-white bg-danger mb-4" style="background-color: #B55F6F !important; border-radius: 29px; border-color: #FFF; border: 4px solid;">
                            <div class="card-body">
                                <br>
                                <center> <span class="text-white"><i class="fas fa-weight-hanging fa-3x"></i></span>
                                </center>
                                <br>
                            </div>
                        </div>
                        <span class="text-white">
                            <h1 class="text-white">100000</h1>
                            ROUTES
                        </span>
                    </div>
                    <div class="col-lg-2"></div>

                    <div class="col-lg-2 ">
                        <div class="card text-white bg-danger mb-4" style="background-color: #B55F6F !important; border-radius: 29px; border-color: #FFF; border: 4px solid;">
                            <div class="card-body">
                                <br>
                                <center> <span class="text-white"><i class="fas fa-headset fa-3x"></i></span>
                                </center>
                                <br>
                            </div>
                        </div>
                        <span class="text-white">
                            <h1 class="text-white">300+</h1>
                            HOSTED OPERATORS
                        </span>
                    </div>
                    <div class="col-lg-2"></div>

                    <div class="col-lg-2 ">
                        <div class="card text-white bg-danger mb-4" style="background-color: #B55F6F !important; border-radius: 29px; border-color: #FFF; border: 4px solid;">
                            <div class="card-body">
                                <br>
                                <center> <span class="text-white"><i class="fas fa-bus fa-3x"></i></span>
                                </center>
                                <br>
                            </div>
                        </div>
                        <span class="text-white">
                            <h1 class="text-white">2500</h1>
                            BUS OPERATORS
                        </span>
                    </div>
                </div>
                
                <br>
                <br>
            </div>
        </div>

        <div class="bg-danger text-white">
            <br><br>
            <div class="row">
                <div class="col-lg-3 col-6">
                    <center>
                        <h2 class="text-white">Top Bus Routes</h2>
                        <a href="" class="text-white">Hyderabad to Banglore Bus</a> <br>
                        <a href="" class="text-white">Banglore to Chennai Bus</a><br>
                        <a href="" class="text-white">Pune to Banglore Bus</a><br>
                        <a href="" class="text-white">Mumbai to Banglore Bus</a>
                    </center>
                </div>
                <div class="col-lg-3 col-6">
                    <center class="text-white">
                        <h2 class="text-white">Top Cities</h2>
                        <a href="" class="text-white">Banglore Bus Ticket</a> <br>
                        <a href="" class="text-white">Banglore Bus Ticket</a> <br>
                        <a href="" class="text-white">Chennai Bus Ticket</a> <br>
                        <a href="" class="text-white">Pune Bus Ticket</a>
                    </center>
                </div>
                <div class="col-lg-3 col-6">
                    <center class="text-white">
                        <h2 class="text-white">Top RTC's</h2>
                        <a href="" class="text-white">APSRTS</a> <br>
                        <a href="" class="text-white">MSRTC</a> <br>
                        <a href="" class="text-white">HRTC</a> <br>
                        <a href="" class="text-white">UPSRTC</a>
                    </center>
                </div>
                <div class="col-lg-3 col-6">
                    <center class="text-white">
                        <h2 class="text-white">Other</h2>
                        <a href="" class="text-white">GSRTC</a> <br>
                        <a href="" class="text-white">RSRTS</a> <br>
                        <a href="" class="text-white">KTTC</a> <br>
                        <a href="" class="text-white">PEPSU</a>
                    </center>
                </div>
            </div>
            <br><br>
        </div>
    </section>

    <section class="services bg-primary">

        <div class="text-white bg-primary container">
            <br>
            <center>
                <h1 class="text-white"> TOP OPERATORS</h1>
            </center>
            <br><br>
            <div class="row">
                <div class="col-lg-3 col-6">
                    <a href="" class="text-white">Top Operatoprs</a><br>
                    <a href="" class="text-white">SRS Travels</a><br>
                    <a href="" class="text-white">Evacay Bus</a><br>
                    <a href="" class="text-white">Kallada Travels</a><br>
                    <a href="" class="text-white">KNV Travels</a><br>
                    <a href="" class="text-white">Orange Travels</a><br>
                    <a href="" class="text-white">Parveen Travels</a><br>
                    <a href="" class="text-white">Rajdhani Travels</a><br>
                    <a href="" class="text-white">VRL Travels</a><br>
                     <a href="" class="text-white">Character  Speed bus</a><br>
                       
                   
                </div>
                <div class="col-lg-3 col-6">
                    
                    <a href="" class="text-white">Bengal Tiger</a><br>
                    <a href="" class="text-white">SRM Travels</a><br>
                    <a href="" class="text-white">Infant Jesus</a><br>
                    <a href="" class="text-white">Patel Travels</a><br>
                    <a href="" class="text-white">JBT Travels</a><br>
                    <a href="" class="text-white">Shatabdi Travels</a><br>
                    <a href="" class="text-white">Eagle Travels</a><br>
                    <a href="" class="text-white">kanker Roadways</a><br>
                    <a href="" class="text-white">Komitla</a><br>
                     <a href="" class="text-white">Shri Krishna Travels</a><br>
                        
                   
                </div>
                <div class="col-lg-3 col-6">
                    
                        
                    <a href="" class="text-white">hamsafar Travels</a><br>
                    <a href="" class="text-white">mahesagar Travels</a><br>
                    <a href="" class="text-white">Raj Express</a><br>
                    <a href="" class="text-white">Sharma Travels</a><br>
                    <a href="" class="text-white">Shrinath Travels</a><br>
                    <a href="" class="text-white">Universal Travels</a><br>
                    <a href="" class="text-white">Verma Travels</a><br>
                    <a href="" class="text-white">Gujarat Travels</a><br>
                    <a href="" class="text-white">Madurai Radha Travels</a><br>
                     <a href="" class="text-white">patel Tour and Travels</a><br>
                  
                </div>
                <div class="col-lg-3 col-6">
                   
                    <a href="" class="text-white">paulo Travels</a><br>
                    <a href="" class="text-white">Royal Travels</a><br>
                    <a href="" class="text-white">Amarnath Travels</a><br>
                    <a href="" class="text-white">Vaibhav Travels</a><br>
                    <a href="" class="text-white">ganesh Travels</a><br>
                    <a href="" class="text-white">Jabbar Travels</a><br>
                    <a href="" class="text-white">Jain Travels</a><br>
                    <a href="" class="text-white">Manish Travels</a><br>
                    <a href="" class="text-white">Pradhan Travels</a><br>
                     <a href="" class="text-white">YBM Travels</a><br>
                    
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <center> <button class="btn btn-outline-light" style="border-radius: 20px;">MORE <i class="fas fa-arrow-right"></i></button></center>
            <br>
            <br>
            <br>
        </div>
    </section>





    <!-- Main footer -->
    <div class="row d-flex" style="background-color: #DC3545;">
        <div class="col-md-4">
            <h1 style="color: white; font-style: bold; margin-top: 100px; margin-left: 40px;">ABOUT MEEBUS</h1>
            <h2>
            <ui style="margin-left: 40px; color: white; font-family: 'Times New Roman', Times, serif;">
                <li style="margin-left: 40px; color: white; font-family: 'Times New Roman', Times, serif;">About US</li>
                <li style="margin-left: 40px; color: white; font-family: 'Times New Roman', Times, serif;">Content US</li>
                <li style="margin-left: 40px; color: white; font-family: 'Times New Roman', Times, serif;">Sitemap</li>
                <li style="margin-left: 40px; color: white; font-family: 'Times New Roman', Times, serif;">Careears</li>
               
            </ui>
            </h2>

        </div>
        <div class="col-md-4 d-flex justify-content-end">
            <center style="margin-top: 200px;">
                <img src="images/images/meebus.png">
                <h5 class="mt-5" style="color: white;font-variant: normal; align-items: center;">
                    meeBus is the World's Largest online bus ticket booking services tursted by over8 million happy customer globlly.meeBus offers bus ticket booking thrugth its website ,iso and android mobile apps for all major routes. 
                </h5>
            </center>
            
        </div>
        <div class="col-md-4" >
            <h1 style="color: white; font-style: bold; margin-top: 100px; margin-left: 40px; align-self: flex-end;">INFO</h1>
            <h2>
            <ui style="margin-left: 40px; color: white; font-family: 'Times New Roman', Times, serif;">
                <li style="margin-left: 40px; color: white; font-family: 'Times New Roman', Times, serif;">T & C</li>
                <li style="margin-left: 40px; color: white; font-family: 'Times New Roman', Times, serif;">Privacy Policy</li>
                <li style="margin-left: 40px; color: white; font-family: 'Times New Roman', Times, serif;">FAQ</li>
                <li style="margin-left: 40px; color: white; font-family: 'Times New Roman', Times, serif;">Insurance Partener</li>
               
            </ui>
            </h2>

        </div>

    </div>
    <!--End pagewrapper-->

    <!-- Scroll Top Button -->
    <button class="scroll-top scroll-to-target" data-target="html">
        <span class="fa fa-angle-up"></span>
    </button>

<div id="MyPopup" class="modal fade" role="dialog">
        <div class="modal-dialog">
    <!-- Modal content-->
    <div class="wrapper">
    <div class="box box--bg" style="margin-top: 100px;;">
      <div class="box-left">
        <div class="menu"><i class="fa fa-arrow-left" aria-hidden="true"></i><span></span></div>
        <div class="box__bg"></div>
      </div>
      <div class="modal-content">
      <div class="box-right">
      	<div class="signin-module" id="otpdatas">
                <div class="login-container" style="left: -25px;">
                    <div class="social FC DIB">
                        <div class="margin-l-n image-mt-12" id="redbusImage"></div>
                        <div class="new-signin-header m-l-44">Sign in to avail exciting discounts and cashbacks!!</div>
                        <div class="server-error"></div>
                        <div class="mobileInputContainer clearfix contact-box">
                            <div class="phone_select_box clearfix">
                                <ul id="selectedPhCode" data-cntrycode="IND" class="select_input_code">+ 91</ul>
                                <span class="icon icon-down"></span>
                            </div>
                            
                            <div class="mobileInput clearfix">
                                <input type="text" class="IP" placeholder="Enter your mobile number" id="mobileNoInp" data-validate="required|internationalphone" data-message="Please enter valid mobile number|Please enter valid mobile number" maxlength="10" onkeypress="javascript:return isNumber(event);">
                                <span class="error-message-fixed error-message-full top-fix">error</span>
                            </div>
                        </div>
                        
                        <div id="otp-container" class="otpContainer clearfix border-r-3 otp-margin-fix" onclick="get_passenger_mobile();"><span class="f-w-b">GENERATE OTP </span>(One Time Password)</div>
                        <span id="otp-progress-loader" class=""></span>
                            <div class="text-social-acc">
                            <span class="or-text">OR, </span>
                            <span>Connect using social accounts</span>
                            </div>
                            <div class="w-106">
                                <div class="social-acc-box margin-g" id="customBtn">
                                    <div class="customGPlusSignIn">
                                        <div class="facebook-logo m-t-0">
                                            <img src="images/icons-8-google.svg" width="20" height="20">
                                        </div>
                                        <div class="google-text">&nbsp;&nbsp;&nbsp;&nbsp;Google</div>
                                    </div>
                                </div>
                                <div class="social-acc-box" id="newFbId">
                                    <div class="facebook-logo">
                                        <img src="images/facebook-icon.svg" width="20" height="20">
                                    </div>
                                    <div class="facebook-text">&nbsp;&nbsp;&nbsp;&nbsp;Facebook</div>
                                </div>
                            </div>                         
                            <div class="info-social-acc-msg hide">We will not post anything on your account</div>
                            <div class="signin-screen"></div>
                            <div class="paddingTerms signin-terms">By signing up, you agree to<br>our <a target="_blank" href="#">Terms &amp; Conditions</a> and <a target="_blank" href="#">Privacy Policy</a></div>

                    </div>
                         
                </div>
            </div>
      </div>
    </div>
  </div>
  </div>
</div>
</div>


    <!-- jequery plugins -->

    <script src="js/jquery.js"></script>
    <script src="js/popover.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/wow.js"></script>
    <script src="js/owl.js"></script>
    <script src="js/validate.js"></script>
    <script src="js/mixitup.js"></script>
    <script src="js/isotope.js"></script>
    <script src="js/appear.js"></script>
    <script src="js/jquery.fancybox.js"></script>
    <script src="js/jquery.background-video.js"></script>
    <script src="js/jquery.mCustomScrollbar.min.js"></script>

    <script src="js/script.js"></script>


 

<script type="text/javascript">
    $(function () {
        $("#btnClosePopup").click(function () {
            $("#MyPopup").modal("hide");
        });
    });
    
    function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
        return false;
        return true;
    } 

    function get_passenger_mobile(){
    var passengermobile = document.getElementById('mobileNoInp').value;
    if(passengermobile == ""){
        alert('Please enter your mobile number');
    }else if(passengermobile.length != 10){
        alert('Please enter valid mobile number');
    }else{
            $.ajax({
            url: 'ajax_send_otp.php',
            type: 'post',
            data: { passengermobile: passengermobile },
            success: function(data){
                 $('#otpdatas').html(data); 
            }
            });
        }
    }

    function verifyotp(){
       var myotpverify = document.getElementById('myotp').value; 
       if(myotpverify == ""){
        alert('Please enter your otp number');
    }else if(myotpverify.length != 6){
        alert('Please enter valid 6 digit otp number');
    }else{
        $.ajax({
            url: 'ajax_otp_verify.php',
            type: 'post',
            data: { myotpverify: myotpverify },
            success: function(data){
                 alert(data);
            }
            });
        }
    }
</script>

</body>

</html>