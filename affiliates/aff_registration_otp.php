<?php
session_start();
ob_start();
unset($_SESSION['sc']);
include_once("../google/config.php");
include_once '../database/connect.php';
include_once("../google/includes/functions.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

       <title>Pure Bus</title>

       <link type="text/css" href="css/purebus.css" rel="stylesheet" media="screen" />

       <script type="text/javascript" src="js/jquery-1.8.3.js"></script>
       <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
       <style type="text/css"> 

                    .signup_content { width: 750px; margin: 0px auto; }

                    #login_blocknew{ color:#fff;}

                    #login_blocknew div{ float:left; width:200px; margin-right:20px!important;}

                    #login_blocknew p{ float:left; width:100%;  padding:0; margin:5px 0 0 0;}

                    #login_blocknew p .inputnewsn{ width:200px!important; height:30px; float:left; margin: 0 !important; padding: 0 !important;}

                    .forgotpasswordSN{float:right;   margin:5px 10px 30px 0;   padding:0; }

                    .forgotpasswordSN a{ color:#AF1910;  font-weight:bold; font-size:14px; position:relative; }

                    .forgotpasswordSN a:hover{ color:#F09508; text-decoration:underline; cursor:pointer;}

                    .forfotpassworddivshow{ border: 3px solid #C55039; background:#fff;  border-radius: 20px 20px 20px 20px;}



                    .closeNEWSN{ float:right;  margin:20px 0; background:#AF1910; color:#fff!important; font-weight:bold; font-size:16px; padding:10px 20px; display:block;}



                    .about_us_content_boxsan p{ color:#ED9809; font-weight:bold; font-size:17px; line-height:30px;background:url(../images/right.png) no-repeat left!important; padding-left:40px;}

                    .ui-datepicker select.ui-datepicker-month, .ui-datepicker select.ui-datepicker-year{ width:39%!important;}



                    .header{ background:none!important;}



                    .newusernew{height:auto; min-height:200px; margin-left:200px; margin-top:20px;  }



                    .formnew{ color:#333; font-size:14px; font-weight:bold; height:40px;}

                    .formnew input{ padding:10px; border:1px solid #999!important; border-radius: 3px;}

                    .formnew select{ padding:10px; border:1px solid #999!important; margin:0!important;}



                    .bigheadingnewblack{ color:#E24648; font-size:24px; margin-bottom:20px;}



                    .formnewaddress{ width:322px; padding:5px 0;  float:left; line-height:40px;}

                    .formnewaddress select{ margin-top:0px!important; }



                    .formnewpass{width:330px; float:left; line-height:40px; margin-bottom:10px; padding: 0;}

                    .formnewpass input{ width:141px; float:right; border-radius: 3px; margin:6px 0!important; padding:10px!important; }



                    .formnewname, .formnewemail, .formnewdateofbirth, .formnewmobile, .formnewsubmitagree{ width:100%; display:inline-block!important; margin:5px 0;}

                    .formnewsubmitagree input[type=checkbox] { border:none!important; height:10px; }



                    .formnewsubmitagree a{ text-decoration:none; color:#AF1910;}





                    .formnewdateofbirth input {

                        border: 1px solid #CCCCCC;

                        border-radius: 3px;

                       /* box-shadow: 0 0 5px #DDDDDD inset;*/

                        float: right !important;

                        /*margin-right: 8px;*/

                        padding: 10px !important;

                        width: 141px !important;

                    }

                    .formnewname input{ float:right!important;  width:141px!important; padding:10px!important; border-radius: 3px;}

                    .formnewemail input{ float:right!important;  width:141px!important; padding:10px!important; border-radius: 3px;}

                    .formnewname select{ float:none!important; width:63px!important; margin:0 10px!important; padding:9px;}

                    .formnewmobile input{ float:right!important;  width:141px!important; padding:10px!important;}



                    #ui-datepicker-div{ background:#AA320D!important; color:#fff!important; margin-left: -30px !important;}

                    .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{ color:#fff;}

                    .ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-widget-header .ui-state-highlight{color: #363636 !important;}



              </style>
              <script type="text/javascript">
			  function checkotp()
			  	  {
				  		$.post( "aff_otp_check.php?motp="+$('#motp').val()+"&eotp="+$('#eotp').val(), function( data ) {
							if(data=="1")
							{
								window.location = 'index.php';	
							}
							else 
							{
								$('#errorData').html('Please Enter Correct Email & Mobile OPT');
								return false;	
							}
});
			      }
			  </script>
      </head>
<body>  

    <?php include "header.php"; ?>

                    <div class="wrapper">  

                            <div class="signup_content"> 

                            <p align="center" style="color:#FF0000; padding:2%; font-size:large;"><?php echo $msg?></p>
                            <div class="newusernew" style="width:400px;">
                              <div class="bigheadingnewblack">New Registration OTP Verification</div>

                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="register" name="register">
                                        <div class="inputtext ac_det"><?php echo $error_var1; ?></div>
                                        <div class="formnewname formnew">

                                            Mobile OTP : <span style="color:#f00;">*</span>

                                            <input name="motp" type="text" class="required" required="required" id="motp"  title="Mobile OTP" placeholder="Enter Mobile OTP"/>

                                        </div>

                                        <div style="clear:both"></div>

                                       <?php /*?> <div class="formnewemail formnew">

                                            Email OTP : <span style="color:#f00;">*</span>

                                            <input name="eotp" type="text" id="eotp"  class="email" style=" margin-left:13px!important;" title="Email-id"   placeholder="Enter Email OTP"/>

                                        </div><?php */?>
                                        <div class="formnewsubmitagree formnew">

                                            <input type="button" value="submit" style="width: 110px; text-align: center; float:right; margin-right:8px; margin-left: 10px; margin-top:5px; background-color: #E24648; border: 0 !important; border-radius: 4px;" id="submit" name="submit" class="btn2 btn_blue w120" onclick="return checkotp();"/>
                                        </div>

										<div id="errorData" class="formnewsubmitagree formnew" style="color:#F00; text-align:center; font-size:large;"></div>

                                    </form>

									

                                    <div style="clear:both"></div>    

                                </div>                                

                     	</div>

                            <div style="clear:both"></div>

                    </div>

            <?php include 'footer.php'; ?>
   </body>
</html>