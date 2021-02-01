<?php
session_start();
error_reporting(0); 

$myotpverifydata = $_POST["myotpverify"];
$passmobidata = $_SESSION['passmobi'];
$otpmobidata = $_SESSION['otpmobi'];

if($myotpverifydata == $otpmobidata){
    echo "OTP Verified. Login Successfully";
}else{
    echo "Something went wrong! Please enter valid otp";
}

?>
                