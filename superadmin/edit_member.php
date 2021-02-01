<?php

include_once("includes/header.php");
	
if(isset($_REQUEST['memid']))
{
	
	$memid=$_REQUEST['memid'];
		
	$mqry="SELECT * FROM users WHERE user_id=".$memid;
	//echo $company_qry ; exit ;
	
	$mem_rs=mysql_query($mqry);
	
	$data=mysql_fetch_array($mem_rs);
	
//	print_r($data) ; // exit ;
}

	if(isset($_REQUEST['sub_upd']))
	{
	
		trim(extract($_POST)) ;
		
		//echo $uname ; exit ;
		
		$sql = "update users set user_email='$uemail',user_firstname='$uname', user_lastname='$lname', user_gender='$ugen',	user_landno='$uland',	user_mobileno='$umob',	user_maritalstatus ='$umet',	user_occupation='$uocc',user_address1_1='$uadd1',	user_address1_2='$uadd1_2',	user_address1_city='$ucity1', user_address1_state='$ustate1',	user_address1_pin = '$upin1',	user_address2_1='$uadd2_1',	user_address2_2='$uadd2_2',	user_address2_city='$ucity2', user_address2_state='$ustate2',	user_address2_pin='$upin2',user_typeID='$utype',user_status ='$ustatus' where user_id ='$uid' ";
		
	//	echo $sql ; exit ;
	
	$upd = mysql_query($sql) ;
	
	if($upd)
	{
		header("location:usermgmt.php?us") ;
	}
	else if($upd)
	{
		header("location:usermgmt.php?ue") ;
	}
	
	}


?>




<body>

<fieldset class="table-bor">

	<legend><strong>User Details</strong></legend> 
	
		<form action="edit_member.php" method="post" name="usr_edit">
	
			<table align="center">
		
			<tr>
				<td width="140">User Firstname</td>
				<td width="23"></td>
				<td width="321">
				<input type="text" name="uname" id="uname" value="<?php echo ucwords($data['user_firstname']) ; ?>" class="textbox2">
				
				<input type="hidden" name="uid" id="uid" value="<?php echo $memid; ?>">
				</td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>User Lastname</td>
				<td></td>
				<td><input type="text" name="lname" id="lname" value="<?php echo ucwords($data['user_lastname']) ; ?>" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>User Email</td>
				<td></td>
				<td><input type="text" name="uemail" id="uemail" value="<?php echo $data['user_email']; ?>" class="textbox2" readonly=""></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>User Gender</td>
				<td></td>
				<td>				
										
				<select name="ugen" id="ugen" class="combobox-small" style="width:236px; height:25px;">
				
				<option value="f" <?php if($data['user_gender'] == 'f') { ?> selected="selected" <?php } ?>>Female</option>
				<option value="m" <?php if($data['user_gender'] == 'm') { ?> selected="selected" <?php } ?>>Male</option>
				</select>
				</td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Land No</td>
				<td></td>
				<td><input type="text" name="uland" id="uland" value="<?php echo $data['user_landno']; ?>" onKeyPress="return numbersonly(this, event)" maxlength="10" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Mobile No</td>
				<td></td>
				<td><input type="text" name="umob" id="umob" value="<?php echo $data['user_mobileno']; ?>" maxlength="13" onKeyPress="return numbersonly(this, event)" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Marital Status	</td>
				<td></td>
				<td>				
					<select name="umet" id="umet" class="combobox-small" style="width:236px; height:25px;">		
							
					<option value="M" <?php if($data['user_maritalstatus'] == 'M') { ?> selected="selected" <?php } ?>>Married</option>
					<option value="U" <?php if($data['user_maritalstatus'] == 'U') { ?> selected="selected" <?php } ?>>Unmarried</option>
					</select>
										
				</td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Occupation</td>
				<td></td>
				<td><input type="text" name="uocc" id="uocc" value="<?php echo $data['user_occupation']; ?>" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Address Line1	</td>
				<td></td>
				<td><input type="text" name="uadd1" id="uadd1" value="<?php echo $data['user_address1_1']; ?>" class="textbox2">	</td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Address Line2</td>
				<td></td> 
				<td><input type="text" name="uadd1_2" id="uadd1_2" value="<?php echo $data['user_address1_2']; ?>" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>City</td>
				<td></td>
				<td><input type="text" name="ucity1" id="ucity1" value="<?php echo $data['user_address1_city']; ?>" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>State</td>
				<td></td> 
				<td><input type="text" name="ustate1" id="ustate1" value="<?php echo $data['user_address1_state']; ?>" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Pincode</td>
				<td></td>
				<td><input type="text" name="upin1" id="upin1" value="<?php echo $data['user_address1_pin']; ?>" maxlength="6" onKeyPress="return numbersonly(this, event)" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			
			<tr>
				<td>Address 2 </td>
				<td></td>   
				<td><input type="text" name="uadd2" id="uadd2" value="<?php echo $data['user_address2_1']; ?>" class="textbox2">	</td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Address 2</td>
				<td></td>
				<td><input type="text" name="uadd2_2" id="uadd2_2" value="<?php echo $data['user_address2_2']; ?>" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>  
				<td>City</td>
				<td></td>
				<td><input type="text" name="ucity2" id="ucity2" value="<?php echo $data['user_address2_city']; ?>" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>State</td>
				<td></td>
				<td><input type="text" name="ustate2" id="ustate2" value="<?php echo $data['user_address2_state']; ?>" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Pincode</td>
				<td></td>
				<td><input type="text" name="upin2" id="upin2" value="<?php echo $data['user_address2_pin']; ?>" class="textbox2" maxlength="6" onKeyPress="return numbersonly(this, event)"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>User Type</td>
				<td></td>
				<td>
					
					<select name="utype" id="utype" class="combobox-small" style="width:236px; height:25px;">			
					
					<?php 
			
						$utype = $data['user_typeID']; 
						
						$qry = mysql_query("select * from usertypes") ;
						
						//echo $sql['usertype_name'] ; usertype_id
						while($sql = mysql_fetch_array($qry))
						{
					?>
											
					<option value="<?php echo $sql['usertype_id']; ?>" <?php if($sql['usertype_id'] == $data['user_typeID']) { ?> selected="selected" <?php } ?> > <?php echo  $sql['usertype_name']; ?> </option>
				
					<?php } ?>
					</select>
					
					
				</td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Status</td>
				<td></td>
				<td>
				
				<select name="ustatus" id="ustatus" class="combobox-small" style="width:236px; height:25px;">
				
				<option value="1" <?php if($data['user_status'] == 1) { ?> selected="selected" <?php } ?>>Active</option>
				<option value="0" <?php if($data['user_status'] == 0) { ?> selected="selected" <?php } ?>>Inactive</option>
				</select>
								
				</td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td colspan="3" align="center">
				<!--<input type="button" name="sub_upd" id="sub_upd" value="Update" onClick="alert('This is Demo version !!!');">-->
					<input type="submit" name="sub_upd" id="sub_upd" value="Update" onClick="return validate_editprofile(this.form);">					
				</td>
			</tr>
		
		</table>	
		
		</form>
		
	</fieldset>
	
</body>