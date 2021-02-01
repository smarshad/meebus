<?php

@session_start();

ob_start();

error_reporting(0);

if($_SESSION['aff']['affiliate_id']=='')

header('location:index.php');

include '../database/connect.php';
$name=$_SESSION['aff']['first_name'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Busbooking</title>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
 		<link type="text/css" href="css/purebus.css" rel="stylesheet" media="screen" />
        <link href="datepicker/ui-lightness/jquery-ui-1.8.17.custom.css" rel="stylesheet" type="text/css" />
        <link href="datepicker/jquery.ui.theme.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/libs/jquery-1.7.1.min.js" language="javascript" ></script>
        <link rel="stylesheet" type="text/css" href="css/style11.css"/>
        
        <style type="text/css">
.form-style-9{
    max-width: 700px;
    background: #FAFAFA;
    padding: 30px;
    margin: 50px auto;
    box-shadow: 1px 1px 25px rgba(0, 0, 0, 0.35);
    border-radius: 5px;
    border: 3px solid #305A72;
}
.form-style-9 ul{
    padding:0;
    margin:0;
    list-style:none;
}
.form-style-9 ul li{
    display: block;
    margin-bottom: 10px;
    min-height: 35px;
}
.form-style-9 ul li  .field-style{
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    padding: 8px;
    outline: none;
    border: 1px solid #B0CFE0;
    -webkit-transition: all 0.30s ease-in-out;
    -moz-transition: all 0.30s ease-in-out;
    -ms-transition: all 0.30s ease-in-out;
    -o-transition: all 0.30s ease-in-out;

}.form-style-9 ul li  .field-style:focus{
    box-shadow: 0 0 5px #B0CFE0;
    border:1px solid #B0CFE0;
}
.form-style-9 ul li .field-split{
    width: 49%;
}
.form-style-9 ul li .field-full{
    width: 100%;
}
.form-style-9 ul li input.align-left{
    float:left;
}
.form-style-9 ul li input.align-right{
    float:right;
}
.form-style-9 ul li textarea{
    width: 100%;
    height: 100px;
}
.form-style-9 ul li input[type="button"],
.form-style-9 ul li input[type="submit"] {
    -moz-box-shadow: inset 0px 1px 0px 0px #3985B1;
    -webkit-box-shadow: inset 0px 1px 0px 0px #3985B1;
    box-shadow: inset 0px 1px 0px 0px #3985B1;
    background-color: #216288;
    border: 1px solid #17445E;
    display: inline-block;
    cursor: pointer;
    color: #FFFFFF;
    padding: 8px 18px;
    text-decoration: none;
    font: 12px Arial, Helvetica, sans-serif;
}
.form-style-9 ul li input[type="button"]:hover,
.form-style-9 ul li input[type="submit"]:hover {
    background: linear-gradient(to bottom, #2D77A2 5%, #337DA8 100%);
    background-color: #28739E;
}
</style>
        
</head>

<body>


 <?php include "header.php";
 $idd=$_SESSION['aff']['affiliate_id'];
 ?>
 
 
 <div class="wrapper">  

                            <p align="center" style="color:#FF0000; padding:2%; font-size:large;"><?php echo $msg?></p>

                           
<form class="form-style-9" action="aff_profile_update.php"  method="post" id="register" name="register">

               <?php 

	$mqry   = "SELECT * FROM aff_login WHERE id='$idd'";
	$mem_rs = mysql_query($mqry);
	 while($row = mysql_fetch_object($mem_rs)) {
		$name =$row->name;
$email_id  =$row->email;
$password =$row->password;
$mobile_number= $row->mobile_number;
$balance =$row->balance;
$website =$row->website;
$age =$row->age;
$account_number=$row->account_number;
$pan_card=$row->pan_card;
$bank_name=$row->bank_name;
$ifsc=$row->ifsc;


	 }
	?>
    
<ul>
<li>
    <input type="text" name="name"  id="fname" value="<?php echo $name; ?>" class="field-style field-split align-left" placeholder="Name" />
    <input type="email" name="email" id="email_id" value="<?php echo $email_id; ?>" class="field-style field-split align-right" placeholder="Email" />

</li>
<li>
    <input type="text" name="password"  id="password" value="<?php echo $password; ?>" class="field-style field-split align-left" placeholder="Password " />
    <input type="text" name="mobile_number" id="mobile_number" value="<?php echo $mobile_number; ?>" class="field-style field-split align-right" placeholder="Mobile Number" />
</li>
<li>
    <input type="text" name="website" value="<?php echo $website; ?>" class="field-style field-split align-left" placeholder="Website " />
    <input type="text" name="age"  value="<?php echo $age; ?>" class="field-style field-split align-right" placeholder="Age" />
</li>
<li>
    <input type="text" name="account_number" id="account_number" class="field-style field-split align-left" placeholder="Account number" />
    <input type="text" name="pan_card" id="pan_card" class="field-style field-split align-right" placeholder="Pan card" />
</li>
<li>
    <input type="text" name="bank_name" id="bank_name" class="field-style field-split align-left" placeholder="Bank name" />
    <input type="text" name="ifsc_code"  id="ifsc" class="field-style field-split align-right" placeholder="IFSC" />
</li>

<li>
<input type="submit" value="Update" />
</li>
</ul>
</form>
                          
 
 
<!--<form action="aff_profile_update.php" method="post" id="register" name="register">
                                        <?php 

	$mqry   = "SELECT * FROM aff_login WHERE id='$idd'";
	$mem_rs = mysql_query($mqry);
	 while($row = mysql_fetch_object($mem_rs)) {
		$name =$row->name;
$email_id  =$row->email;
$password =$row->password;
$mobile_number= $row->mobile_number;
$balance =$row->balance;
$website =$row->website;
$age =$row->age;


	 }
	?>
                                          <div class="prof">
                        
                      <ul class="newusernew">
                        <li class="formnewname formnew">
                          <div class="colmn w350">
                           <label>Name : </label>
                         
                            
                             <input type="text" name="name" class="required" onclick="removestyle('fname')" id="fname" title="First Name" value="<?php echo $name; ?>" style="margin-top: -25px; margin-left: 180px;">
                           
                             <input type="hidden" name="idd" value="<?php echo $idd; ?>" />
                          </div>
                        </li>
                        
                        <li class="formnewname formnew">
                          <div class="colmn w350">
                            <label>Email-Id : </label>
                       
                            <input type="text" name="email" onclick="removestyle('email_id')" id="email_id" class="email" title="Email-id" value="<?php echo $email_id; ?>" readonly="readonly" style="margin-top: -25px; margin-left: 180px;"> <div id="mail_error" style="color: red; font-size: 13px;"> </div>
                          </div>
                          
                        </li>
                        <li class="formnewname formnew">
                          
                          <div class="colmn w350">
                            <label>Password : </label>
                       
                           <input type="text" style="margin-top: -25px; margin-left: 180px;" readonly="readonly" title="Password" value="<?php echo $password; ?>" class="required" id="password" onclick="removestyle('password')" name="password">
                          </div>
                        </li>

         
                      </ul>

<ul class="row_container">
                        <li class="formnewname formnew">
                          <div class="colmn w350">
                            <label>Mobile Number :</label>
                        
                            <div id="holder"> 
                             <input type="text" name="mobile_number" onclick="removestyle('mobile_number')" id="mobile_number" class="required" title="Mobile Number" value="<?php echo $mobile_number; ?>"  style="margin-top: -25px; margin-left: 180px;">
                             </div>
                             <div id="ajax_response" style="display: none;"></div>
                          </div>
                        </li>
                        <li class="formnewname formnew">
                          <div class="colmn w350">
                            <label>Website :</label>
                        
                            <input type="text" name="website"  class="required" title="website" value="<?php echo $website; ?>"  style="margin-top: -25px; margin-left: 180px;">
                          </div>
                          
                        </li>
                        <li class="formnewname formnew">
                          
                          <div class="colmn w350">
                            <label>Age</label>
                            
                            <input type="text" name="age" class="required" title="age" value="<?php echo $age; ?>"  style="margin-top: -25px; margin-left: 180px;">
                          </div>
                        </li>
                        
                        
                      </ul>

<br><br>

                      
</div>
             
                                       <div class="formnewsubmitagree formnew">

<input type="submit" name="submit" value="Update">
                                            
                                            
                                        </div>
                                    </form>-->

				</div>
               
</body>
<?php include 'footer.php'; ?>
</html>