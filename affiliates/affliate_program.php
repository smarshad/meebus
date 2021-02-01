<?php
include "../database/connect.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">

        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Online Bus Ticket Booking, Book Volvo AC Bus Tickets, Reservation</title>
       
<link type="text/css" href="../css/style.css" rel="stylesheet" />		
		<link type="text/css" href="../css/jquery.ui.theme.css" rel="stylesheet" />
		<link type="text/css" href="../css/jquery.ui.core.css" rel="stylesheet" />
		<link type="text/css" href="../css/jquery.ui.datepicker.css" rel="stylesheet" />

		<script type="text/javascript" src="../js/jquery-1.4.2.js"></script>
		<script type="text/javascript" src="../js/jquery.ui.core.js"></script>
		<script type="text/javascript" src="../js/ajaxfrm.js"></script>
		<script type="text/javascript" src="../js/jquery.ui.datepicker.js"></script>
		<script type="text/javascript" src="../js/validate.js"></script>	
		<script type="text/javascript" src="../js/validate1.js"></script>	
		<script type="text/javascript" src="../js/pagination.js"></script>	
		
		<!-- Code Start Here -->
		
		<script type="text/javascript" src="../js/code.js"></script>	
		<script type="text/javascript" src="../js/user.js"></script>	
		
		<!-- Code Ends Here -->
		
		
		<script src="../js/AC_RunActiveContent.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../css/index.css" />
<script type="text/javascript">
function dat_val()
{
//alert("hello");
if(document.getElementById('tag').value!="")
{

document.getElementById('dat').style.display='block';
document.getElementById('datepicker').focus();
return false;

}



}

</script>

<script type="text/javascript">
function validate()
{
//alert("hello");
if(document.getElementById('ter_from').value=="")
{
alert("please enter the source value");
document.getElementById('ter_from').focus();
return false;

}

if(document.getElementById('tag').value=="")
{
alert("please enter the Destination value");
document.getElementById('tag').focus();
return false;

}

if((document.getElementById('ter_from').value!="") && (document.getElementById('tag').value!="") &&(document.getElementById('datepicker').value==""))
{
//alert("Please choose Date of Journey");
document.getElementById('datepicker').focus();
return false;
}

var date=document.getElementById('datepicker').value;
var date1=document.getElementById('datepicker1').value;
if(document.getElementById('datepicker1').value!="")
{
if(date>=date1)
{
alert('Please select Return date greater than Journey date');
document.getElementById('datepicker1').value="";
document.getElementById('datepicker1').focus();
return false;
}
}
}

</script>




        </head>
<div class="form_wrapper">
                    <h4 class="title">Search for Bus</h4>
                    <form action="../results.php" method="post" target="_blank">
                      <ul class="row_container h335  ">
<h5 style="color: #999; padding: 10px 17px 0px !important; font-size:14px;">
   <p class="fon">
   <input type="radio" name="triptype" value="1" onclick="return showhide('0');" checked>&nbsp;&nbsp;One Way </p>
  <br>
  <p class="fon" style="float: right; margin-top: -30px;">
  <input type="radio" name="triptype" value="roundtrip"  onclick="return showhide('1');">&nbsp;&nbsp;Round Trip </p>
</h5>
                        <li class="row w330">
                          <div class="colmnl dom" >
                            <label>Origin </label>
                            <br />
                            <input type="hidden" name="aff_id" value="<?php echo $_GET['aff_id'];?>">
                            <input type="text" placeholder="Leaving From" autocomplete="off" class="w518" title="Origin" id="originid" name="ter_from">
                            <script type="text/javascript">
                                new actb('originid', custom_array_bus);													  
                             </script> 
                          </div>
                        </li>
                        <li class="row w330">
                          <div class="colmnl">
                            <label>Destination</label>
                            <br />
                            <input type="text" placeholder="Going To" autocomplete="off" title="Destination" class="w518" id="destinationid" name="tag">
                            <script type="text/javascript">
                                                            new actb('destinationid', custom_array_bus);													  
                                                        </script> 
                          </div>
                        </li>
                        <li class="row searchbus" style="margin-left: 7px;">
                          <div class="colmn1">
                            <label>Depart Date</label>
                            <br />
                            <input id="datepicker" name="datepicker" type="text" onfocus="if(this.value=='Date of Journey')this.value='';" onblur="if(this.value=='')this.value='Date of Journey';" class="hasDatepicker">
                          </div>
                        </li>
						<li class="row searchbus returnfield" style="display:none;">
                          <div class="colmn1">
                            <label>Return Date (Optional)</label>
                            <br />
                            <input type="text" class="w200 date_icon date" placeholder="Return" id="checkout"  autocomplete="off" name="return_date" />
                          </div>
                        </li>
                        <li class="row">
                          <div class="colmnl">
                            <input type="submit" value="Search Bus" class="btn-medium solid_orange btnBus">
                          </div>
                        </li>

                      </ul>
                    </form>
                  </div>




               