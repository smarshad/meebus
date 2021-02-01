<?php
session_start();
error_reporting(0); 
if(isset($_POST['passengermobile'])){
$passmobile = $_POST["passengermobile"];
$generateotp = rand(100000,999999);

$_SESSION['passmobi']=$passmobile;
$_SESSION['otpmobi']=$generateotp;

$api_key = '55D2290263C756';
$contacts = $passmobile;
$from = 'SMSMSG';
$sms_text = urlencode(''.$generateotp.' is your one time password and it is valid for the next 15 mins. Please do not share this OTP with anyone. Thank you, meeBus.');

$api_url = "http://byebyesms.com/app/smsapi/index.php?key=".$api_key."&campaign=7830&routeid=7&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text;

//Submit to server

$response = file_get_contents( $api_url);
}
?>
                <div class="login-container" style="left: -15px;">
                    <div class="social FC DIB hidden">
                        <div class="margin-l-n image-mt-12" id="redbusImage"></div>
                        <div class="new-signin-header m-l-44">Sign in to avail exciting discounts and cashbacks!!</div>
                        <div class="server-error"></div>                    
                            <div class="M24A pos-rel W310 M0A">
                            <div class="server-error server-error-otp server-error-active success">To continue, please enter OTP sent to verify mobile number</div>
                            <div class="inputContainer clearfix">
                                <div class="otp-screen-mobile-lbl">Mobile Number</div>
                                <div class="clear-both">
                                    <span class="plus-symbol-ph-code">+91 <?php echo $passmobile; ?></span>
                                    <!-- <input type="text" class="IP" id="vphoneCode" maxlength="5" data-validate="required|number" data-message="Please enter a valid phone code|Please enter a valid phone code" autofocus="autofocus" readonly="">
                                    <input type="text" class="IP verMobile" id="otpMobileNo" maxlength="15" data-validate="required|internationalphone" data-message="Please enter your email id or phone number|not a valid email id or phone number" readonly=""> -->
                                    <div class="mainSignIn change-lbl">CHANGE</div>
                                </div>
                            </div>

                            <div class="inputContainer otpInputContainer clearfix otp-border-css">
                                <input type="text" class="IP" placeholder="Enter OTP" id="myotp" data-validate="required" data-message="Please enter the otp" maxlength="6" onkeypress="javascript:return isNumber(event);">
                                <span class="error-message-fixed">error</span>       
                            </div>
                            
                            <button id="verifyUser" class="action-button M12A verify-top-btn-css" onclick="verifyotp()">VERIFY OTP</button>
                            <span id="progress-loader"></span>

                            <div class="resendOtpContainer m-b-10">
                                <span class="red-link signin-link"><a class="resend-otp-css" href="javascript:void(0);" id="resendOTP" style="color: rgb(226, 70, 72);">resend Otp</a></span>
                                <span class="resendOTPTimmer timer-new-css hide"><label id="retryAfterId" class="hide"> </label>(<label id="minutes">0</label>:<label id="seconds">0</label>)<div class="css-loader"></div></span>
                            </div>
                            <div class="mainSignIn other-way-box">OTHER WAYS TO SIGN IN</div>


                        </div>
                    </div>
                </div>
          