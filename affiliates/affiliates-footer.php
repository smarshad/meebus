<?php
session_start();
$sesid = session_id();
error_reporting(0);
date_default_timezone_set("Asia/Kolkata"); 

$_SESSION['utm_source'] = '';
$_SESSION['utm_medium'] = '';
$_SESSION['utm_campaign'] = '';

if(isset($_GET['utm_source']) && $_GET['utm_source']!='')
{
	$_SESSION['utm_source'] = $_GET['utm_source'];
}

if(isset($_GET['utm_medium']) && $_GET['utm_medium']!='')
{
	$_SESSION['utm_medium'] = $_GET['utm_medium'];
}
if(isset($_GET['utm_campaign']) && $_GET['utm_campaign']!='')
{
	$_SESSION['utm_campaign'] = $_GET['utm_campaign'];
}





//if(isset($_SESSION['google_data']['email'])) { echo $_SESSION['google_data']['email'];  }
$pageName='Bus';
include "database/connect.php";

$delDate = date('d/m/Y',time());
$delQry = "DELETE FROM coupon WHERE to_date='$delDate'";
$sql = mysql_query($delQry);
	
//$updateSS = "UPDATE coupon SET status='0' WHERE to_date='$delDate'"; $querySS1 = mysql_query($updateSS);

mysql_query("DELETE FROM temp_bus WHERE session_id='".$sesid."'");
mysql_query("DELETE FROM temp_bus1 WHERE session_id='".$sesid."'");

//$obj=new db_connect();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">

        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Online Bus Ticket Booking in Bangalore, Trichy, Madurai, Namakkal - Pure Bus</title>
        <meta name="description" content="Online Bus Ticket Booking in Bangalore, Tirunelveli, Trichy, Madurai, Kanyakumari, Thoothukudi, Viluppuram, Ooty, Pollachi, Thanjavur, Tirupur, Salem, Vellore, Erode, Tiruvannamalai. Online Bus Ticket Bookings in Mettur, Tenkasi, Mettupalayam, Komarapalayam, Rajapalayam, Krishnagiri, Palani. Online Bus Booking in Pudukkottai, Ramanathapuram, Dharmapuri, Nagapattinam. Bus Tickets Online in Dindigul, Manapparai, Karur, Kovilpatti, Gudiyatham, Gobichettipalayam, Book Bus Tickets Online in Neyveli, Arcot, Udumalaipettai, Sivakasi, Arakkonam, Paramakudi, Vaniyambadi, Aruppukottai, Thiruvarur" />
        <meta name="keywords" content="Urbus.com, online bus ticket booking in bangalore, salem, tirunelveli, trichy, namakkal, madurai, tirupur, kanyakumari" />
        <link rel="stylesheet" href="css/default-theme.css">
        <link href="css/purebus.css" rel="stylesheet" type="text/css">
		<link href="css/style_new.css" rel="stylesheet" type="text/css">
		<link href="css/beetle_combind_css.min.css" rel="stylesheet" />
        <link href="css_search/search.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="css/main_style.css"/>
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
        <link href=" /ui-lightness/jquery-ui-1.8.17.custom.css" rel="stylesheet" type="text/css" />
        <link href="datepicker/jquery.ui.theme.css" rel="stylesheet" type="text/css" />
        <link href="css/style_new.css" rel="stylesheet" type="text/css">
        
        <script type="text/javascript" src="js/libs/jquery-1.7.1.min.js" language="javascript" ></script>
        <script src="js/autosuggest_bus.js"></script>
        <script src="js/autosuggest_flight.js"></script>
        </head>
        <body<?php /*?> onload="return pause();"<?php */?>>
        <a href="https://plus.google.com/101920480961826941593" rel="publisher"></a>
       <!-- <a href="https://plus.google.com/u/0/104327660454763917507" rel="publisher"></a>-->
        <h1 style="display:none;">Online Bus Ticket Booking in Mettur, Tenkasi, Mettupalayam, Bangalore, Tirunelveli, Trichy, Madurai, Komarapalayam, Rajapalayam, Krishnagiri, Palani, Online Bus Ticket Bookings in Kanyakumari, Thoothukudi, Viluppuram, Ooty, Pollachi, Thanjavur, Tirupur, Salem, 
Vellore, Erode, Tiruvannamalai</h1>
<h2 style="display:none;">Book Bus Tickets Online in Neyveli, Arcot, Udumalaipettai, Sivakasi, Arakkonam, Paramakudi, Vaniyambadi, Aruppukottai, Thiruvarur, Online Bus Ticket Booking in Bangalore, Tirunelveli, Trichy, Madurai, Kanyakumari, Thoothukudi, Viluppuram, Ooty, Pollachi, Thanjavur, Tirupur, Salem, 
Vellore, Erode, Tiruvannamalai.</h2>
<p style="display:none;">we are provides <b> Online Bus Ticket Bookings in Neyveli, Arcot, Udumalaipettai, Sivakasi, Arakkonam, Paramakudi, Vaniyambadi, Aruppukottai, Thiruvarur</b>, Online Bus Booking in Pudukkottai, 
Ramanathapuram, Dharmapuri, Nagapattinam. <i>Bus Tickets Online in Dindigul, Manapparai, Karur, Kovilpatti, Gudiyatham, Gobichettipalayam.</i></p>
<style type="text/css">
		@font-face {
			font-family: 'mbk_web_font';
			src:url('//static10.mobikwik.com/target/desktop/style/font/mbk_web_font.eot?v=1.0.385') format('embedded-opentype'),
				url('//static10.mobikwik.com/target/desktop/style/font/mbk_web_font.ttf?v=1.0.385') format('truetype'),
				url('//static10.mobikwik.com/target/desktop/style/font/mbk_web_font.woff?v=1.0.385') format('woff'),
				url('//static10.mobikwik.com/target/desktop/style/font/mbk_web_font.svg?v=1.0.385') format('svg');
			font-weight: normal;
			font-style: normal;
		}
.overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
   z-index:100000;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
   z-index:100000;
}

.popup {
  margin: 100px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 100%;
  height:100%;
  position: relative;
  transition: all 5s ease-in-out;
  z-index:100000;
}

.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
   z-index:100000;
}
.popup .close {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
   z-index:100000;
}
.popup .close:hover {
  color: #06D85F;
  
}
.popup .content {
  max-height:85%;
  overflow:hidden;
   z-index:100000;
}

@media screen and (max-width: 1200px){
  .box{
    width: 100%;
  }
  .popup{
    width:100%;
  }
}
</style>
<style type="text/css">

#SigninBlock label { width: 10em; float: left;}
#SigninBlock label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }
#SigninBlock  a { color:#999; text-decoration:none; cursor:pointer; font-size: 12px; }
#SigninBlock label { display: block; }
#SigninBlock form { margin: 15px 5px; text-align:left; font-size:12px !important; text-align:center !important; width:98%; }
/*#SigninBlock form input[type=text] { padding:5px; width:90%; border:solid 1px #CCCCCC; margin-bottom:5px;color: #565656; font-weight: 200}*/
/*#SigninBlock form input[type=password] { padding:5px; width:90%; border:solid 1px #CCCCCC; margin-bottom:5px;color: #565656; font-weight: 200}*/
#SigninBlock form#SigninBlock form3 { margin: 2px; text-align:left; font-size:12px !important; text-align:center !important; }
/*#SigninBlock form input[type=submit] { padding:3px 20px 3px 20px; margin:10px; border:none; font-size:14px !important;}*/
#SigninBlock form input[type=submit] { font-weight: bold;font-size: 14px; padding:10px; width:150px; display:block; margin-top:10px; margin-bottom:10px; color:#fff; margin-left:auto; margin-right:auto; background:#cf000b; border: solid 1px #b00009;}
#SigninBlock footer { /*font-size:12px;*/ }
#SigninBlock form a { color:#39c9fe;font-size:14px !important; text-align:center; }
#SigninBlock form img{ margin-top:10px;}
#SigninBlock form input.regFiled{/* padding:2px; width:90%; border:solid 1px #CCCCCC; margin-bottom:2px;color: #565656; font-weight: 200*/}
input.error{ border:solid 1px #ff0000 !important;}
#SigninBlock .errortxt{ font-size:12px; text-align:left; padding:0px 5px; color:#C00; display:none;}
#SigninBlock .regTd{padding-right:10px; text-align:right; width:50%;}
#SigninBlock .error-msg {   background: none repeat scroll 0 0 #FDE4E1; border: 1px solid #FBD3C6; color: #CB4721; font-size: 11px; margin: 2px; padding: 2px 4px; text-align: center;}
#SigninBlock .success-msg { background: none repeat scroll 0 0 #D5FFC6;  border: 1px solid #C0F0B9; color: #48A41C; font-size: 11px; margin: 2px; padding: 2px 4px; text-align: center; }
#SigninBlock h1 { color: #343434;  font-size: 14px;  margin: 15px 0 0px;  padding: 0;}
#SigninBlock { /*color: #808080; font-size: 9px; line-height: 15px; right: 10px;*/font-size:14px; }


.overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}

.popup {
  margin:100px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 30%;
  height: auto;
  position: relative;
  transition: all 5s ease-in-out;
}

.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}
.popup .close {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup .close:hover {
  color: #06D85F;
}
.popup .content {
  height:85%;
  overflow: auto;
}

@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  .popup{
    width: 70%;
  }
}

#LoginF  p {text-align:center; margin-top:20px; margin-bottom:20px;font-size: 16px }
#LoginF  p span{ font-weight:bold; color:#cf000b; text-align:center;}
#LoginF  p strong { font-weight:bold;}

</style>
<?php include("footer.php"); ?>
