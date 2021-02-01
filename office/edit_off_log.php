<?php

include_once("includes/header.php");
	if(isset($_REQUEST['id']))
{
	
	$memid=$_REQUEST['id'];
		
	$mqry="SELECT * FROM tbl_courier_officers WHERE cid=".$memid;

	$mem_rs=mysql_query($mqry);
	
	$data=mysql_fetch_array($mem_rs);
	
//	print_r($data) ; // exit ;
}


	if(isset($_REQUEST['sub_upd']))
	{
	
		trim(extract($_POST)) ;
		
		//$sql = "update tbl_offices set off_name='$off_name',address='$address', city='$city', ph_no='$ph_no',	office_time='$office_time',	contact_person='$contact_person' where id ='$uid' ";
		$sql="update tbl_courier_officers set officer_name='$officer_name',address='$address',email='$email',ph_no='$ph_no',office='$office' where cid='$uid'";

		
	
	$upd = mysql_query($sql) ;
	
	if($upd)
	{
		header("location:add_login.php?us") ;
	}
	else if($upd)
	{
		header("location:add_login.php?ue") ;
	}
	
	}


?>




<body>

<fieldset class="table-bor">

	<legend><strong>Add Login Details</strong></legend> 
	
		<form action="" method="post" name="usr_add">
	
			<table align="center">
		
			<tr>
				<td width="140">Officer Name</td>
				<td width="23"></td>
				<td width="321">
				<input type="text" name="officer_name" id="officer_name" value="<?php echo ucwords($data['officer_name']) ; ?>" class="textbox2">
				
				<input type="hidden" name="uid" id="uid" value="<?php echo $memid; ?>">
				
				
				</td>
			</tr>
						
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Address</td>
				<td></td>
				<td><input type="text" name="address" id="address" value="<?php echo ucwords($data['address']) ; ?>" class="textbox2" ></td>
			</tr><tr><td colspan="3">&nbsp;</td></tr>
			<tr>
				<td>Email</td>
				<td></td>
				<td><input type="text" name="email" id="email" value="<?php echo $data['email'] ; ?>" class="textbox2" ></td>
			</tr>
			<tr><td colspan="3">&nbsp;</td></tr>
			
			
			
			
			
			<tr>
				<td>Mobile</td>
				<td></td>
				<td><input type="text" name="ph_no" id="ph_no" value="<?php echo $data['ph_no'] ; ?>" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Office</td>
				<td></td>
				<td><select name='office'>
				<?php
				$sq=mysql_query("select * from tbl_offices");
				while($rw=mysql_fetch_array($sq)){ ?>
				<option value="<?php echo $rw['off_name'];?>" <?php if($rw['off_name']==$data['office']){?>selected=selected<?php } ?>><?php echo $rw['off_name'];?> </option><?php } ?>
				
				</select></td>
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