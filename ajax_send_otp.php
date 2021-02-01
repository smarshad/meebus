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
$from = 'FIVEDU';
$sms_text = urlencode(''.$generateotp.' is your one time password and it is valid for the next 15 mins. Please do not share this OTP with anyone. Thank you, meeBus.');

$api_url = "http://byebyesms.com/app/smsapi/index.php?key=".$api_key."&campaign=7830&routeid=7&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text;

//Submit to server

$response = file_get_contents($api_url);

}
?>
                <div class="login-container" style="left: -15px;">
                    <div class="social FC DIB hidden">
                        <div class="margin-l-n image-mt-12" id="redbusImage"></div>
                        
                        <div class="server-error"></div>                    
                            <div class="M24A pos-rel W310 M0A">
                            <div class="server-error server-error-otp server-error-active success">Please Enter OTP(one time password):</div>
                            <?php print_r($_POST['code1']);?>
<form action='ajax_otp_verify.php' method='POST'>
                            <div class="inputContainer otpInputContainer clearfix otp-border-css">
                                <input type="text" name='code1' class="form-control IP" placeholder="Enter OTP" id="myotp" data-validate="required" data-message="Please enter the otp" maxlength="6" onkeypress="javascript:return isNumber(event);" size="50">
                                <span class="error-message-fixed"><?php $error;?> </span>       
                            </div>
                            <!--damn who make this site this is so annoying -->
                            
                            <input name='verify' type='submit' value='VERIFY OTP' id="verifyUser" class="action-button M12A verify-top-btn-css" onclick="verifyotp()">
                            <span id="progress-loader"></span>
</form>
                            <!-- <div class="resendOtpContainer m-b-10">
                                <span class="red-link signin-link"><a class="resend-otp-css" href="javascript:void(0);" id="resendOTP" style="color: rgb(226, 70, 72);">resend Otp</a></span>
                                <span class="resendOTPTimmer timer-new-css hide"><label id="retryAfterId" class="hide"> </label>(<label id="minutes">0</label>:<label id="seconds">0</label>)<div class="css-loader"></div></span>
                            </div>
                            <div class="mainSignIn other-way-box">OTHER WAYS TO SIGN IN</div> -->


                        </div>
                    </div>
                </div>
          