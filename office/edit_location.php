<?php

include_once("includes/header.php");
	
if(isset($_REQUEST['id']))
{
	
	$memid=$_REQUEST['id'];
		
	$mqry="SELECT * FROM tbl_offices WHERE id=".$memid;
	//echo $company_qry ; exit ;
	
	$mem_rs=mysql_query($mqry);
	
	$data=mysql_fetch_array($mem_rs);
	
//	print_r($data) ; // exit ;
}

	if(isset($_REQUEST['sub_upd']))
	{
	
		trim(extract($_POST)) ;
		
		$sql = "update tbl_offices set off_name='$off_name',address='$address', city='$city', ph_no='$ph_no',	office_time='$office_time',	contact_person='$contact_person' where id ='$uid' ";
		
		//$sql="insert into tbl_offices (off_name,address,city,ph_no,office_time,contact_person) values('$off_name','$address','$city','$ph_no','$office_time','$contact_person')";

		
	
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
				<input type="text" name="off_name" id="off_name" value="<?php echo ucwords($data['off_name']) ; ?>" class="textbox2">
				
				<input type="hidden" name="uid" id="uid" value="<?php echo $memid; ?>">
				
				
				</td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Address</td>
				<td></td>
				<td><input type="text" name="address" id="address" value="<?php echo $data['address'] ; ?>" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>City</td>
				<td></td>
				<td><input type="text" name="city" id="city" value="<?php echo $data['city'] ; ?>" class="textbox2" ></td>
			</tr><tr><td colspan="3">&nbsp;</td></tr>
			<tr>
				<td>Mobile</td>
				<td></td>
				<td><input type="text" name="ph_no" id="ph_no" value="<?php echo $data['ph_no'] ; ?>" class="textbox2" ></td>
			</tr>
			<tr><td colspan="3">&nbsp;</td></tr>
			
			
			
		
			
			<tr>
				<td>Office Time</td>
				<td></td>
				<td><input type="text" name="office_time" id="office_time" value="<?php echo $data['office_time'] ; ?>" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Contact Person</td>
				<td></td>
				<td><input type="text" name="contact_person" id="contact_person" value="<?php echo $data['contact_person'] ; ?>"  class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			
			
			<tr>
				<td colspan="3" align="center">
				<!--<input type="button" name="sub_upd" id="sub_upd" value="Update" onClick="alert('This is Demo version !!!');">-->
					<input type="submit" name="sub_upd" id="sub_upd" value="Update" onClick="return validate_editlocation(this.form);">					
				</td>
			</tr>
		
		</table>	
		
		</form>
		
	</fieldset>
	
</body>