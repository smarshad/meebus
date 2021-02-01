<?php 

include_once("includes/header.php");


	if(isset($_REQUEST['submit']))	
	{

	trim(extract($_POST));

	$ptitle = $_POST['ptitle'];

	$ptype = $_POST['ptype'];

	$dtype = $_POST['dtype'];

	$date = date("Y-m-d",strtotime($_POST['date']));

	$date1 = date("Y-m-d",strtotime($_POST['date1'])); 

	$pamount = $_POST['pamount'];
	

	$ftime = $_POST['ftime'];
	
	$ttime = $_POST['ttime'];
	
	//echo "insert into  bus_promo (promo_title,promo_type,promo_atype,promo_value,promo_from,promo_to,promo_ftime,promo_ttime) values ('$ptitle','$ptype','$dtype','$ddtype','$date','$date1','$ftime','$ttime')"; exit;

	mysql_query("insert into  bus_promo (promo_title,promo_type,promo_atype,promo_value,promo_from,promo_to,promo_ftime,promo_ttime) values ('$ptitle','$ptype','$dtype','$pamount','$date','$date1','$ftime','$ttime')");
	header("location:promo_code.php");
}

?>


<link type="text/css" href="css/ui-lightness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-timepicker-addon.min.js"></script>	
<script type="text/javascript">


	$(function() {
	var dateFormat;
	try{
    dateFormat= $( ".selector" ).datepicker( "option", "dateFormat" );
	}
	catch(e){ }
	
		$('#date').datepicker({ 		
			numberOfMonths: 2, 
			showButtonPanel: false, 
			minDate: +0, 
			maxDate: '+3M +0D', 
			//showOn: 'button', 
			buttonImage: '../images/calendar_icon.gif', 
			buttonImageOnly: true, 
		    dateFormat: 'dd-mm-yy'
			
		});	
		$('#date1').datepicker({ 		
			numberOfMonths: 2, 
			showButtonPanel: false, 
			minDate: +0, 
			maxDate: '+3M +0D', 
			//showOn: 'button', 
			buttonImage: '../images/calendar_icon.gif', 
			buttonImageOnly: true, 
		    dateFormat: 'dd-mm-yy'
			
		});	
	});



function hide_value(){
	if($("#date").val() == "Select Date"){
		$("#date").val('');
	}
	if($("#date1").val() == "Select Date"){
		$("#date1").val('');
	}
}
				
function show_value(){
	if($("#date").val() == ""){
		$("#date").val('Select Date');
	}
	if($("#date1").val() == ""){
		$("#date1").val('Select Date');
	}
}

</script>

<script language="javascript">
	time_show("bt_0");
	time_show("dp_0");
</script>

<script type="text/javascript">
function time_show(idval)
{ //alert(idval);
	var var_id = '#'+idval ;
	$(var_id).timepicker({ampm: true, hourMin: 0, hourMax: 24 });
}

</script>

<script type="text/javascript">

function validate()
{
//alert("hello");
if(document.getElementById('webname').value=="")
{
alert("Enter the Website name");
document.getElementById('webname').focus();
return false;
}

if(document.getElementById('webkeyword').value=="")
{
alert("Enter the Website Keywords");
document.getElementById('webkeyword').focus();
return false;
}

if(document.getElementById('webdes').value=="")
{
alert("Enter the Website Description");
document.getElementById('webdes').focus();
return false;
}

if(document.getElementById('site_team').value=="")
{
alert("Enter the Website Team");
document.getElementById('site_team').focus();
return false;
}

if(document.getElementById('site_admin').value=="")
{
alert("Enter the Website Admin Mail");
document.getElementById('site_admin').focus();
return false;
}

if(document.getElementById('site_com').value=="")
{
alert("Enter the Website Url");
document.getElementById('site_com').focus();
return false;
}

if(document.getElementById('mail_url').value=="")
{
alert("Enter the Mail Url");
document.getElementById('mail_url').focus();
return false;
}

if(document.getElementById('smtp_server').value=="")
{
alert("Enter the smtp server name");
document.getElementById('smtp_server').focus();
return false;
}

if(document.getElementById('smtp_username').value=="")
{
alert("Enter the smtp server Username");
document.getElementById('smtp_username').focus();
return false;
}

if(document.getElementById('smtp_password').value=="")
{
alert("Enter the smtp server password");
document.getElementById('smtp_password').focus();
return false;
}

if(document.getElementById('smtp_password').value=="")
{
alert("Enter the smtp server password");
document.getElementById('smtp_password').focus();
return false;
}

if(document.getElementById('tax').value=="")
{
alert("Enter the Tax Amount");
document.getElementById('tax').focus();
return false;
}


if(document.getElementById('paypal_rate').value=="")
{
alert("Enter the Bank rate of Paypal");
document.getElementById('paypal_rate').focus();
return false;
}


if((document.getElementById('month_count').value=="") && (document.getElementById('days_count').value==""))
{
alert("Choose the month and days");
document.getElementById('month_count').focus();
return false;
}



if(document.getElementById('sitelogoname').value == "")
{
if(document.getElementById('logo').value != "")

	{
		var ss=document.getElementById('logo').value;
		var index=ss.lastIndexOf(".");				
		var sstring=ss.substring(index+1);
		var ssivanew=sstring.toLowerCase();
		if(ssivanew != "jpg" && ssivanew != "png" && ssivanew != "jpeg" && ssivanew != "gif" && ssivanew != "JPG" && ssivanew != "PNG" && ssivanew != "JPEG" && ssivanew != "GIF")
		{
			  alert("Upload jpg,png,jpeg,gif images only...");
			  document.getElementById('logo').value="";
			  document.getElementById('logo').focus();
			  return false;
		 }
	}
}

}

</script>


<script type="text/javascript">
function showreturn(val)
{

if(val==1) {
document.getElementById('time_id').style.display="none";

}
else if(val==2)
{
document.getElementById('time_id').style.display="block";
}
else { }
}
</script>

<script type="text/javascript">
function showdiscount(val)
{
if(val==1) {
document.getElementById('amt_id').style.display="block";
document.getElementById('percen_id').style.display="none";

}
else if(val==2) 
{
document.getElementById('percen_id').style.display="block";
document.getElementById('amt_id').style.display="none";
}
else { }
}
</script>


<fieldset class="table-bor">

<legend><strong>Add New Promotional Code</strong></legend>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"> 

<form action="" name="settings" method="post" enctype="multipart/form-data" > 

	<tr height="14px"><td colspan="3"></td></tr>
	
	<tr>
		<td width="81" height="35">&nbsp;</td> 
		
		<td width="361" align="left" valign="middle" class="admintext"><strong>Promotion Title</strong></div></td> 
		
		<td width="48" class="content1" align="center"><strong> :</strong></td> 
		
		<td width="439" align="left"> &nbsp;
			
			<font face="Verdana" style="font-size:12px ">
			<input type="text" name="ptitle" id="ptitle"  />			
			</font>		
			</td>
		</tr>
		
		<tr height="14px"><td colspan="3"></td></tr>

	<tr class="admintext"> 
	
		<td width="120" height="30">&nbsp;</td> 
		
		<td width="263" align="left" nowrap="nowrap" valign="middle"><strong>Promotion Type</strong></td> 
		
		<td width="53" class="content1" align="center"><strong> :</strong></td> 
		
		<td width="537" align="left"> &nbsp;
		
			<font face="Verdana" style="font-size:12px "> 
		
				
				
				<input type="radio" name="ptype" id="period" value="1" onClick="showreturn(this.value);" />&nbsp;&nbsp;&nbsp;Period Based
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="ptype" id="time" value="2" onClick="showreturn(this.value);" />&nbsp;&nbsp;&nbsp;Booking Time based
		
		  </font>
			
	  </td> 
	
	</tr> 
	
	<tr height="3px"><td colspan="3"></td></tr>

	<tr> 
	
		<td height="31">&nbsp;</td> 
		
		<td align="left" nowrap="nowrap" class="admintext" valign="middle">
			<strong>Discount Type</strong>
		</td> 
		
		<td width="53" class="content1" align="center"><strong> :</strong></td> 
		
		<td align="left"> &nbsp;
		
			<font face="Verdana" style="font-size:12px "> 
		
				<input type="radio" name="dtype" id="dtype" value="1"  />&nbsp;&nbsp;&nbsp;Amount
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="dtype" id="dtype" value="2"  >&nbsp;&nbsp;&nbsp;Percentage
		 
		
			</font>
		</td> 
	
	</tr>
	
	<tr height="3px"><td colspan="3"></td></tr> 
	
	<tr>
		<td width="81" height="35">&nbsp;</td> 
		
		<td width="361" align="left" valign="middle" class="admintext"><strong>Promotion Value</strong></div></td> 
		
		<td width="48" class="content1" align="center"><strong> :</strong></td> 
		
		<td width="439" align="left"> &nbsp;
			
			<font face="Verdana" style="font-size:12px ">
			<input type="text" name="pamount" id="pamount"  />			
			</font>		
			</td>
		</tr>
	
	<tr height="3px"><td colspan="3"></td></tr> 
	
	<tr>
		<td width="98" height="40">&nbsp;</td> 
		
		<td width="312" align="left" valign="middle" class="admintext"><strong>Valid From date </strong></div></td> 
		
		<td width="48" class="content1" align="center"><strong> :</strong></td> 
		
		<td width="471" align="left"> &nbsp;
			
			<font face="Verdana" style="font-size:12px "><input type="text" name="date" id="date" readonly="readonly" class="textbox" value="Select Date" onFocus="hide_value();" onBlur="show_value();" /><input type="hidden" name="date_from" id="date_from" />			</font>		</td>
	</tr>
		
		<tr>
		<td width="98" height="33">&nbsp;</td> 
		
		<td width="312" align="left" valign="middle" class="admintext"><strong>Valid To date </strong></div></td> 
		
		<td width="48" class="content1" align="center"><strong> :</strong></td> 
		
		<td width="471" align="left"> &nbsp;
			
			<font face="Verdana" style="font-size:12px "><input type="text" name="date1" id="date1" readonly="readonly" class="textbox" value="Select Date" onFocus="hide_value();" onBlur="show_value();" /><input type="hidden" name="date_to" id="date_to" />			</font>		</td>
		</tr>
	
	<tr height="3px"><td colspan="3"></td></tr>
	
	

	<!--<tr> 
	<td colspan="4">
	
	    <table id="amt_id"  style="display:none;">
		<tr>
		<td width="81" height="35">&nbsp;</td> 
		
		<td width="361" align="left" valign="middle" class="admintext"><strong>Promotion Amount</strong></div></td> 
		
		<td width="48" class="content1" align="center"><strong> :</strong></td> 
		
		<td width="439" align="left"> &nbsp;
			
			<font face="Verdana" style="font-size:12px ">
			<input type="text" name="pamount" id="pamount"  />			
			</font>		
			</td>
		</tr>
		</table>
	</td>
	</tr>
	
	<tr height="3px"><td colspan="3"></td></tr>

	<tr> 
	<td colspan="4">
	
	    <table id="percen_id"  style="display:none;">
		
		<tr>
		<td width="80" height="35">&nbsp;</td> 
		
		<td width="392" align="left" valign="middle" class="admintext"><strong>Promotion Percentage </strong></div></td> 
		
		<td width="38" class="content1" align="center"><strong> :</strong></td> 
		
		<td width="419" align="left"> &nbsp;
			
			<font face="Verdana" style="font-size:12px ">
			<input type="text" name="ppercent" id="ppercent"  />	
			</font>		
			</td>
		</tr>
		
		</table>
	</td>
	</tr>-->
	
	<tr height="3px"><td colspan="3"></td></tr>

	<!--<tr> 
	<td colspan="4">
	
	    <table height="64" id="per_id"  style="display:none;">
		<tr>
		<td width="98" height="28">&nbsp;</td> 
		
		<td width="312" align="left" valign="middle" class="admintext"><strong>Valid From date </strong></div></td> 
		
		<td width="48" class="content1" align="center"><strong> :</strong></td> 
		
		<td width="471" align="left"> &nbsp;
			
			<font face="Verdana" style="font-size:12px "><input type="text" name="date" id="date" readonly="readonly" class="textbox" value="Select Date" onFocus="hide_value();" onBlur="show_value();" /><input type="hidden" name="date_from" id="date_from" />			</font>		</td>
		</tr>
		
		<tr>
		<td width="98">&nbsp;</td> 
		
		<td width="312" align="left" valign="middle" class="admintext"><strong>Valid To date </strong></div></td> 
		
		<td width="48" class="content1" align="center"><strong> :</strong></td> 
		
		<td width="471" align="left"> &nbsp;
			
			<font face="Verdana" style="font-size:12px "><input type="text" name="date1" id="date1" readonly="readonly" class="textbox" value="Select Date" onFocus="hide_value();" onBlur="show_value();" /><input type="hidden" name="date_to" id="date_to" />			</font>		</td>
		</tr>
		
		</table>
	</td>
	</tr>
	
	<tr height="3px"><td colspan="3"></td></tr>-->

	<tr> 
	<td colspan="4">
	
	    <table id="time_id"  style="display:none;">
		<!--<tr>
		<td width="84" height="28">&nbsp;</td> 
		
		<td width="358" align="left" valign="middle" class="admintext"><strong>Promotion Days </strong></div></td> 
		
		<td width="50" class="content1" align="center"><strong> :</strong></td> 
		
		<td width="437" align="left"> &nbsp;
			
			<font face="Verdana" style="font-size:12px ">
			<select name="pdays" id="pdays">
			<option value="">Select Days</option>
			<option value="8">All</option>
			<option value="1">Sunday</option>
			<option value="2">Monday</option>
			<option value="3">Tuesday</option>
			<option value="4">Wednesday</option>
			<option value="5">Thursday</option>
			<option value="6">Friday</option>
			<option value="7">Saturday</option>
			
			</select>
			
					</font>		</td>
		</tr>
-->		
		<tr>
		<td width="84" height="33">&nbsp;</td> 
		
		<td width="388" align="left" valign="middle" class="admintext"><strong>Time From</strong></div></td> 
		
		<td width="43" class="content1" align="center"><strong> :</strong></td> 
		
		<td width="414" align="left"> &nbsp;
			
			<font face="Verdana" style="font-size:12px ">
			<input type="text" name="ftime" id="ftime" class="textbox" value="Choose Time" onFocus="time_show(this.id);" style="cursor:pointer;" readonly  />			</font>		</td>
		</tr>
		
		<tr>
		<td width="84" height="35">&nbsp;</td> 
		
		<td width="388" align="left" valign="middle" class="admintext"><strong>Time To</strong></div></td> 
		
		<td width="43" class="content1" align="center"><strong> :</strong></td> 
		
		<td width="414" align="left"> &nbsp;
			
			<font face="Verdana" style="font-size:12px ">
			<input type="text" name="ttime" id="ttime" class="textbox" value="Choose Time" onFocus="time_show(this.id);" style="cursor:pointer;" readonly  />			</font>		</td>
		</tr>
		
		</table>
	</td>
	</tr>  
	
	<tr height="3px"><td colspan="3"></td></tr>

	<tr> 
	
		<td colspan="4">&nbsp;</td> 
		
		</tr>	
		
		<tr> 
		
		<td height="27" colspan="4" align="center"> &nbsp;
			<input type="submit" name="submit" value="Save" class="submitlink" onclick="return chk_genvalidation()"/> 
			<!--<input type="button" name="submit" value="Save" class="submitlink" onclick="alert('This is Demo version !!!');"/> -->
		</td> 
	
	</tr> 
	
</form> 

</table> 

</fieldset>

<?php include "includes/footer.php"; ?>