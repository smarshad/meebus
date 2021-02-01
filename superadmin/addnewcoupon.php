<?php
include "includes/header.php";
 
 $sp_id=$_REQUEST['sp_id'];
 $bus_id=$_REQUEST['busid']; 
?>
<a href="busDetails.php?sp_id=<?php echo $sp_id; ?>"><?php echo get_SP_name($sp_id); ?></a>&nbsp; >> &nbsp;<?php echo get_bus_name($bus_id); ?>&nbsp; >> &nbsp;<strong>Add New Promotional code</strong>
<?php 
if(isset($_REQUEST['addcoup'])){

extract($_POST);

$date_from=date("Y-m-d",strtotime($_REQUEST['date_from']));	
$date_to=date("Y-m-d",strtotime($_REQUEST['date_to']));

//echo "INSERT INTO `bus_coupons` ( `coup_unique` ,`coup_sp` ,`coup_bus` ,`coup_perc` , `coup_date`, `coup_date1`) VALUES ('$coupon',  '$sp_id',  '$bus_id',  '$percent', '$date_from', '$date_to' )"; exit;

	mysql_query("INSERT INTO `bus_coupons` ( `coup_unique` ,`coup_sp` ,`coup_bus` ,`coup_perc` , `coup_date`, `coup_date1`) VALUES ('$coupon',  '$sp_id',  '$bus_id',  '$percent', '$date_from', '$date_to' )");

header("location:viewcoupon.php?sp_id=$sp_id&busid=$bus_id");	
}

?>
<style type="text/css">
.divscroll {
width:250px;
height:100px;
background-color:#FFFFFF;
border:1px solid #CCCCCC;
overflow:auto;


}
.clr {
	clear:both;
	}


</style>
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
<script type="text/javascript">
function validate_form()
{
if(document.getElementById('percent').value=="")
{
document.getElementById('per_err').innerHTML="Please enter the Discount Percentage";
document.getElementById('percent').value="";
document.getElementById('percent').focus();
return false;
}
if(document.getElementById('date').value=="Select Date")
{
document.getElementById('date_err').innerHTML="Please select the Discount From date";
document.getElementById('date').value="";
document.getElementById('date').focus();
return false;
}
else
{
document.getElementById('date_from').value=document.getElementById('date').value;
}

if(document.getElementById('date1').value=="Select Date")
{
document.getElementById('date_err1').innerHTML="Please select the Discount To date";
document.getElementById('date1').value="";
document.getElementById('date1').focus();
return false;
}
else
{
document.getElementById('date_to').value=document.getElementById('date1').value;
}

var dat=document.getElementById('date').value;
var dat1=document.getElementById('date1').value;

if(dat>=dat1)
{
document.getElementById('date_err1').innerHTML="Please select To date greater than From date";
document.getElementById('date1').value="";
document.getElementById('date1').focus();
return false;
}
}
</script>

<link type="text/css" href="css/ui-lightness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-timepicker-addon.min.js"></script>	

<fieldset class="table-bor">
<legend></legend>
<form action="" method="post" onSubmit="return validate_form()">
<table width="666" align="center">
	<tr>	
		<td></td>
		
		<td></td>
	
	</tr>
	
	<tr><td colspan="2"><br /></td></tr>
		
	<tr>
	
		<td width="211" height="47">Coupon code</td>
		
		<td width="345" style="color:#00CC00;">
		<?php echo $randomnumber="COUP".rand(0,9999)."ON".rand(0,999)."CODE"; ?>
			<input type="hidden" name="coupon" id="coupon" class="textbox" value="<?php echo $randomnumber; ?>"/>	
		   
	  </td>
	</tr>
	
	<tr>
		
		<td width="211">Discount Percentage <span style="color:#FF0000;">*</span></td>
		
		<td width="345">
			<input type="text" name="percent" id="percent" class="textbox"/>	
			 <span id="per_err" style="color:#FF3300"></span>
	  </td>
	
	</tr>
	
	
	<tr><td colspan="2"><br /></td></tr>
	<tr>
		
		<td width="211">Discount From<span style="color:#FF0000;">*</span></td>
		
		<td width="345">
			<input type="text" name="date" id="date" readonly="readonly" class="textbox" value="Select Date" onFocus="hide_value();" onBlur="show_value();" />	<input type="hidden" name="date_from" id="date_from" />
			 <span id="date_err" style="color:#FF3300"></span>
	  </td>
	
	</tr>
	
	
	<tr><td colspan="2"><br /></td></tr>
	<tr>
		
		<td width="211">Discount To <span style="color:#FF0000;">*</span></td>
		
		<td width="345">
			<input type="text" name="date1" id="date1" readonly="readonly" class="textbox" value="Select Date" onFocus="hide_value();" onBlur="show_value();" /><input type="hidden" name="date_to" id="date_to" />
			 <span id="date_err1" style="color:#FF3300"></span>
	  </td>
	
	</tr>
	
	
	<tr><td colspan="2"><br /></td></tr>
	
	<tr>
	
		<td colspan="2" style="padding-left:150px;"> 
		
			<!--<input type="submit" name="subbus" value="Add >>" onClick="add_validbus()" />-->
				<input type="submit" name="addcoup" value="Add Coupon >>"  />
	    </td>
	
	</tr>
	
	<tr><td colspan="2"><br /></td></tr>
	
	<tr>
		
		<td colspan="2" align="left">
		
			<div>
			
		
		  
		    </div>
		
		</td>
	
	</tr>
	
</table>
</form>
</fieldset>
<script language="javascript">
	time_show("bt_0");
	time_show("dp_0");
</script>
<?php include "includes/footer.php";  ?>