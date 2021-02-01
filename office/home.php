<?php

include_once("includes/header.php");
	
	
	$memid=$_SESSION['offid'];
		
	$mqry="SELECT * FROM tbl_courier_officers WHERE cid=".$memid;

	$mem_rs=mysql_query($mqry);
	
	$data=mysql_fetch_assoc($mem_rs);
	
	//echo "<pre>"; print_r($data) ; echo "</pre>"; // exit ;



	if(isset($_REQUEST['sub_upd']))
	{
	
		trim(extract($_POST)) ;
		
		//$sql = "update tbl_offices set off_name='$off_name',address='$address', city='$city', ph_no='$ph_no',	office_time='$office_time',	contact_person='$contact_person' where id ='$uid' ";
		$sql="update tbl_courier_officers set office_name='$officer_name',address='$address',email='$email',office_mobile='$ph_no',contactPerson_mobile='$mobile' where cid='$uid'";

		
	
	$upd = mysql_query($sql) ;
	
	if($upd)
	{
		header("location:home.php?us") ;
	}
	else if($upd)
	{
		header("location:home.php?ue") ;
	}
	
	}


?>




<body>

<fieldset class="table-bor">

	<legend><strong>Office Profile</strong></legend> 
	
		<form action="" method="post" name="usr_add">
	
			<table align="center" width="65%">
		
			<tr>
				<td width="140">Contact Person Name</td>
				<td width="23"></td>
				<td width="321">
				<input type="text" name="officer_name" id="officer_name" value="<?php echo ucwords($data['office_name']) ; ?>" class="textbox2">
				
				<input type="hidden" name="uid" id="uid" value="<?php echo $memid; ?>">
				
				
				</td>
			</tr>
			
			 <tr><td height="5" colspan="3"></td></tr>
			
			<tr>
				<td>Address</td>
				<td></td>
				<td><input type="text" name="address" id="address" value="<?php echo ucwords($data['address']) ; ?>" class="textbox2" ></td>
			</tr>
            <tr><td height="5" colspan="3"></td></tr>
			<tr>
				<td>Email</td>
				<td></td>
				<td><input type="text" name="email" id="email" value="<?php echo $data['email'] ; ?>" class="textbox2" ></td>
			</tr>
			
             <tr><td height="5" colspan="3"></td></tr>

			<tr>
				<td>Office Mobile</td>
				<td></td>
				<td><input type="text" name="ph_no" id="ph_no" value="<?php echo $data['office_mobile'] ; ?>" maxlength="10" class="textbox2"></td>
			</tr>
			
			 <tr><td height="5" colspan="3"></td></tr>
			
			<tr>
				<td>Mobile</td>
				<td></td>
				<td><input type="text" name="mobile" id="mobile" value="<?php echo $data['contactPerson_mobile'] ; ?>" maxlength="10" class="textbox2"></td>
			</tr>
			
			 <tr><td height="5" colspan="3"></td></tr>
			
			
			
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
<?php include "includes/footer.php"; ?>