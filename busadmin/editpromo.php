<?php 

include_once("includes/header.php");

$promoid=$_REQUEST['promoid'];

$res=mysql_fetch_array(mysql_query("select * from bus_promo where promo_id='$promoid'"));

	if(isset($_REQUEST['submit']))	
	{

	trim(extract($_POST));

	$ptitle = $_POST['ptitle'];

	$ptype = $_POST['ptype'];

	$dtype = $_POST['dtype'];

	$date = date("Y-m-d",strtotime($_POST['date']));

	$date1 = date("Y-m-d",strtotime($_POST['date1'])); 

	$pamount = $_POST['pamount'];
	
	$ppercent=$_REQUEST['ppercent'];
	
	$ftime = $_POST['ftime'];
	
	$ttime = $_POST['ttime'];
	
	
	
	//echo "insert into  bus_promo (promo_title,promo_type,promo_atype,promo_value,promo_from,promo_to,promo_ftime,promo_ttime) values ('$ptitle','$ptype','$dtype','$ddtype','$date','$date1','$ftime','$ttime')"; exit;

	mysql_query("update bus_promo set promo_title='$ptitle',promo_type='$ptype',promo_atype='$dtype',promo_value='$pamount',promo_from='$date',promo_to='$date1',promo_ftime='$ftime',promo_ttime='$ttime' where promo_id='$promoid'");
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
function showreturn(val)
{
//alert(val);
if(val==1) {
document.getElementById('time_id1').style.display="none";
document.getElementById('time_id').style.display="none";
}
else if(val==2)
{
document.getElementById('time_id1').style.display="block";
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
			<input type="text" name="ptitle" id="ptitle" value="<?php echo $res['promo_title']; ?>"  />			
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
		
				
				
				<input type="radio" name="ptype" id="period" value="1" onClick="showreturn(this.value);" <?php if($res['promo_type']==1) { ?> checked="checked" <?php } ?> />&nbsp;&nbsp;&nbsp;Period Based
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="ptype" id="time" value="2" onClick="showreturn(this.value);" <?php if($res['promo_type']==2) { ?> checked="checked" <?php } ?> />&nbsp;&nbsp;&nbsp;Booking Time based
		
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
		
				<input type="radio" name="dtype" id="dtype" value="1" <?php if($res['promo_atype']==1) { ?> checked="checked" <?php } ?> />&nbsp;&nbsp;&nbsp;Amount
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="dtype" id="dtype" value="2" <?php if($res['promo_atype']==2) { ?> checked="checked" <?php } ?> />&nbsp;&nbsp;&nbsp;Percentage
		 
		
			</font>
		</td> 
	
	</tr>
	
	<tr height="3px"><td colspan="3"></td></tr> 
	
	
	<tr>
		<td width="81" height="35">&nbsp;</td> 
		
		<td width="389" align="left" valign="middle" class="admintext"><strong>Promotion Value</strong></div></td> 
		
		<td width="40" class="content1" align="center"><strong> :</strong></td> 
		
		<td width="419" align="left"> &nbsp;
			
			<font face="Verdana" style="font-size:12px ">
			<input type="text" name="pamount" id="pamount" value="<?php echo $res['promo_value']; ?>"  />			
			</font>		
			</td>
		</tr>
		
		<tr height="3px"><td colspan="3"></td></tr> 
	
	<tr>
		<td width="98" height="40">&nbsp;</td> 
		
		<td width="312" align="left" valign="middle" class="admintext"><strong>Valid From date </strong></div></td> 
		
		<td width="48" class="content1" align="center"><strong> :</strong></td> 
		
		<td width="471" align="left"> &nbsp;
			
			<font face="Verdana" style="font-size:12px "><input type="text" name="date" id="date" readonly="readonly" class="textbox" value="<?php echo $res['promo_from']; ?>" onFocus="hide_value();" onBlur="show_value();" /><input type="hidden" name="date_from" id="date_from" />			</font>		</td>
	</tr>
		
		<tr>
		<td width="98" height="33">&nbsp;</td> 
		
		<td width="312" align="left" valign="middle" class="admintext"><strong>Valid To date </strong></div></td> 
		
		<td width="48" class="content1" align="center"><strong> :</strong></td> 
		
		<td width="471" align="left"> &nbsp;
			
			<font face="Verdana" style="font-size:12px "><input type="text" name="date1" id="date1" readonly="readonly" class="textbox" value="<?php echo $res['promo_to']; ?>" onFocus="hide_value();" onBlur="show_value();" /><input type="hidden" name="date_to" id="date_to" />			</font>		</td>
		</tr>
	
	<tr height="3px"><td colspan="3"></td></tr>

<?php /*?><?php if($res['promo_atype']==1) { ?>
	<tr> 
	<td colspan="4">
	
	    <table id="amt_id" >
		<tr>
		<td width="81" height="35">&nbsp;</td> 
		
		<td width="389" align="left" valign="middle" class="admintext"><strong>Promotion Amount</strong></div></td> 
		
		<td width="40" class="content1" align="center"><strong> :</strong></td> 
		
		<td width="419" align="left"> &nbsp;
			
			<font face="Verdana" style="font-size:12px ">
			<input type="text" name="pamount" id="pamount" value="<?php echo $res['promo_value']; ?>"  />			
			</font>		
			</td>
		</tr>
		</table>
	</td>
	</tr>
	
	<tr height="3px"><td colspan="3"></td></tr>
<?php } ?><?php */?>

<?php /*?><?php if($res['promo_atype']==2) { ?>
	<tr> 
	<td colspan="4">
	
	    <table id="percen_id">
		
		<tr>
		<td width="80" height="35">&nbsp;</td> 
		
		<td width="392" align="left" valign="middle" class="admintext"><strong>Promotion Percentage </strong></div></td> 
		
		<td width="38" class="content1" align="center"><strong> :</strong></td> 
		
		<td width="419" align="left"> &nbsp;
			
			<font face="Verdana" style="font-size:12px ">
			<input type="text" name="ppercent" id="ppercent" value="<?php echo $res['promo_value']; ?>"  />	
			</font>		
			</td>
		</tr>
		
		</table>
	</td>
	</tr>
	
	<tr height="3px"><td colspan="3"></td></tr>
<?php } ?><?php */?>
	
<?php if($res['promo_type']==2) { ?>
	<tr> 
	<td colspan="4">
	
	    <table id="time_id">
		
		<tr>
		<td width="84" height="33">&nbsp;</td> 
		
		<td width="388" align="left" valign="middle" class="admintext"><strong>Time From</strong></div></td> 
		
		<td width="43" class="content1" align="center"><strong> :</strong></td> 
		
		<td width="414" align="left"> &nbsp;
			
			<font face="Verdana" style="font-size:12px ">
			<input type="text" name="ftime" id="ftime" class="textbox" value="<?php echo $res['promo_ftime']; ?>" onFocus="time_show(this.id);" style="cursor:pointer;"  readonly  />			</font>		</td>
		</tr>
		
		<tr>
		<td width="84" height="35">&nbsp;</td> 
		
		<td width="388" align="left" valign="middle" class="admintext"><strong>Time To</strong></div></td> 
		
		<td width="43" class="content1" align="center"><strong> :</strong></td> 
		
		<td width="414" align="left"> &nbsp;
			
			<font face="Verdana" style="font-size:12px ">
			<input type="text" name="ttime" id="ttime" class="textbox" value="<?php echo $res['promo_ttime']; ?>" onFocus="time_show(this.id);" style="cursor:pointer;" readonly  />			</font>		</td>
		</tr>
		
		</table>
	</td>
	</tr>  
	
	<tr height="3px"><td colspan="3"></td></tr>
<?php } ?>


<tr> 
	<td colspan="4">
	
	    <table id="time_id1"  style="display:none;">
		
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
			<input type="submit" name="submit" value="Update" class="submitlink" onclick="return chk_genvalidation()"/> 
			<!--<input type="button" name="submit" value="Save" class="submitlink" onclick="alert('This is Demo version !!!');"/> -->
		</td> 
	
	</tr> 
	
</form> 

</table> 

</fieldset>

<?php include "includes/footer.php"; ?>