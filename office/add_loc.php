<?php

include_once("includes/header.php");
	


	if(isset($_REQUEST['sub_upd']))
	{
	
		trim(extract($_POST)) ;
		
		
		$sql="insert into tbl_offices (off_name,address,city,ph_no,office_time,contact_person) values('$off_name','$address','$city','$ph_no','$office_time','$contact_person')";

		
	
	$upd = mysql_query($sql) ;
	
	if($upd)
	{
		header("location:add-location.php?us") ;
	}
	else if($upd)
	{
		header("location:add-location.php?ue") ;
	}
	
	}


?>




<body>

<fieldset class="table-bor">

	<legend><strong>Add Location Details</strong></legend> 
	
		<form action="" method="post" name="usr_add">
	
			<table align="center">
		
			<tr>
				<td width="140">Office Name</td>
				<td width="23"></td>
				<td width="321">
				<input type="text" name="off_name" id="off_name" value="" class="textbox2">
				
				
				</td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Address</td>
				<td></td>
				<td><input type="text" name="address" id="address" value="" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>City</td>
				<td></td>
				<td><input type="text" name="city" id="city" value="" class="textbox2" ></td>
			</tr><tr><td colspan="3">&nbsp;</td></tr>
			<tr>
				<td>Mobile</td>
				<td></td>
				<td><input type="text" name="ph_no" id="ph_no" value="" class="textbox2" ></td>
			</tr>
			<tr><td colspan="3">&nbsp;</td></tr>
			
			
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Office Time</td>
				<td></td>
				<td><input type="text" name="office_time" id="office_time" value="" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Contact Person</td>
				<td></td>
				<td><input type="text" name="contact_person" id="contact_person" value=""  class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			
			
			<tr>
				<td colspan="3" align="center">
				<!--<input type="button" name="sub_upd" id="sub_upd" value="Update" onClick="alert('This is Demo version !!!');">-->
					<input type="submit" name="sub_upd" id="sub_upd" value="Add" onClick="return validate_editlocation(this.form);">					
				</td>
			</tr>
		
		</table>	
		
		</form>
		
	</fieldset>
	
</body>