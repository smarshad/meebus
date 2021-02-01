<?php

include_once("includes/header.php");
	


	if(isset($_REQUEST['sub_upd']))
	{
	
		trim(extract($_POST)) ;
		
		
		$sql="insert into tbl_courier_officers (officer_name,off_pwd,address,email,ph_no,office) values('$officer_name','$off_pwd','$address','$email','$ph_no','$office')";

		
	
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
				<input type="text" name="officer_name" id="officer_name" value="" class="textbox2">
				
				
				</td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Password</td>
				<td></td>
				<td><input type="text" name="off_pwd" id="off_pwd" value="<?php echo rand(); ?>" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Address</td>
				<td></td>
				<td><input type="text" name="address" id="address" value="" class="textbox2" ></td>
			</tr><tr><td colspan="3">&nbsp;</td></tr>
			<tr>
				<td>Email</td>
				<td></td>
				<td><input type="text" name="email" id="email" value="" class="textbox2" ></td>
			</tr>
			<tr><td colspan="3">&nbsp;</td></tr>
			
			
			
			
			
			<tr>
				<td>Mobile</td>
				<td></td>
				<td><input type="text" name="ph_no" id="ph_no" value="" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Office</td>
				<td></td>
				<td><select name='office'>
				<?php
				$sq=mysql_query("select * from tbl_offices");
				while($rw=mysql_fetch_array($sq)){ ?>
				<option value="<?php echo $rw['off_name'];?>"><?php echo $rw['off_name'];?> </option><?php } ?>
				
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