<?php
ob_start();
session_start();
require "../config/config.php";
if (!isset($_SESSION['accessing_LogID']) || !isset($_SESSION['accessing_type']))
{ 
	header("location:index.php");
}
else{

     if(isset($_REQUEST['sp_id'])){ 
	  $gan=chk_SP_area(mysql_real_escape_string($_REQUEST['sp_id']),$_SESSION['SP_id']);
	    if($gan=='0'){
		     //header("location: home.php");
		  }
	 }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Urbus :: Bus Admin Panel</title>

		<link type="text/css" href="css/jquery.ui.theme.css" rel="stylesheet" />
		<link type="text/css" href="css/jquery.ui.core.css" rel="stylesheet" />
		<link type="text/css" href="css/jquery.ui.datepicker.css" rel="stylesheet" />

		<link href="css/admincss.css" rel="stylesheet" type="text/css" />
	
		<script src="../js/adminajaxfrm.js" type="text/javascript"></script>
		
		<script src="../js/add_delRow.js" type="text/javascript"></script>
		
		<script src="../js/field_validations.js" type="text/javascript"></script>
		
		<script src="../js/jquery.min.js" type="text/javascript"></script>
		
		<script type="text/javascript" src="../js/jquery-1.4.2.js"></script>
		
		<script type="text/javascript" src="../js/jquery.ui.core.js"></script>
		
		<script type="text/javascript" src="../js/jquery.ui.datepicker.js"></script>
		
		<link href="../css/pagination.css" rel="stylesheet" type="text/css" /> 
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">  		
    	<script type="text/javascript" src="js/new_add.js"></script>
		<script type="text/javascript" language="javascript"> 

function chk_genvalidation()
{}

function AllowcharNum(e)
    {
    var keyVal =(window.event) ? event.keyCode : e.keyCode;
if (window.event) 
   keyVal = window.event.keyCode;

         if((window.event.shiftKey))
        {
                    if((keyVal > 48 && keyVal < 57))
                    {
                    return false;
                    }
                    else if((keyVal > 96 && keyVal < 105))
                    {
                    return false;
                    }
                    else if((keyVal == 46))
                    {
                    return false;
                    }
                    else if((keyVal == 8))
                    {
                    return false;
                    }
                    else
                    {
                    return false;
                    }
        }
        else
        {
                        if((keyVal > 48 && keyVal < 57))
                        {
                        return true;
                        }
                        else if((keyVal > 96 && keyVal < 105))
                        {
                        return true;
                        }
                        else if((keyVal == 46))
                        {
                        return true;
                        }
                        else if((keyVal == 8))
                        {
                        return true;
                        }
                         else if((keyVal == 57))
                        {
                        return true;
                        }
                        else if((keyVal == 48))
                        {
                        return true;
                        }
                        else if((keyVal > 65 && keyVal < 90))
                        {
                        return true;
                        } 
                        else if(keyVal==65)                       
                        {
                         return true;
                        }
                        else if(keyVal==90)                       
                        {
                         return true;
                        }
                        else if((keyVal == 16))
                        {
                        return false;
                        }
						else if((keyVal == 9))
						{
						 return true;
						}
                        else
                        {
                        return false;
                        }
        }
	}
</script>
<script type="text/javascript">

function validate_busseats(){
var form=document.seat_form;
for(var i=0; i<form.elements.length; i++)
{
 if(form.elements[i].value==''){
    alert('Please Enter Seat Number');    
	document.getElementById(form.elements[i].name).focus();
	return false;
   }
  else{
  //document.getElementById(form.elements[i].name+'_err').style.display='none';
  } 
}
   return false;  
   } 
</script>
<style type="text/css">

/*Credits: Dynamic Drive CSS Library */
/*URL: http://www.dynamicdrive.com/style/ */

a.ovalbutton{
background: #5AADDD;
display: block;
float: left;
font: normal 13px Tahoma; /* Change 13px as desired */
line-height: 16px; /* This value + 4px + 4px (top and bottom padding of SPAN) must equal height of button background (default is 24px) */
height: 24px; /* Height of button background height */
padding-left: 11px; /* Width of left menu image */
text-decoration: none;
border-radius: 3px;
}

a:link.ovalbutton, a:visited.ovalbutton, a:active.ovalbutton{
color: #fff; /*button text color*/
}

a.ovalbutton span{
background: #5AADDD;
display: block;
color: #fff;
padding: 4px 11px 4px 0; /*Set 11px below to match value of 'padding-left' value above*/
}

a.ovalbutton:hover{ /* Hover state CSS */
background-position: bottom left;
}

a.ovalbutton:hover span{ /* Hover state CSS */
background-position: bottom right;
color: black;
}

.buttonwrapper{ /* Container you can use to surround a CSS button to clear float */
overflow: hidden; /*See: http://www.quirksmode.org/css/clearing.html */
width: 100%;
}

/*.txtbox{
background-color:#FFFFFF; 
border:1px solid #CCCCCC; 
font-size: 11px; 
color: black; 	
height: 14px; 
padding:2px;
}
.txtbox1{
background-color:#FF99CC; 
border:1px solid #CCCCCC; 
font-size: 11px; 
color: black; 	
height: 14px; 
padding:2px;
}*/
</style>
</head>

<body>
<div class="bus-header">
	<div class="bus-container">
    	<img src="../images/buslogo.png" alt="busbooking" border="0" class="logo" />
        <div class="head-right">
			<ul>
				<li class="user_thumb"><a href="#"><span class="icon"><img src="images/user_thumb.png" alt="User" height="30" width="30"></span></a></li>
				<li class="user_info"><span class="user_name"><?php echo ucfirst($_SESSION['SP_name']); ?></span><span><a href="changepass.php">Change Password</a></span></li>
				<li class="logout"><a href="logout.php"><span class="icon"><img src="images/logout.png" alt="logout" height="30" width="30"></span></a></li>
				</ul>
			</div>
    </div>
</div>

<div class="bus-container cf">
    <div class="left-menu">
    	<?php include("includes/left_menu.php"); ?> 
    </div>
	<div class="right-content">