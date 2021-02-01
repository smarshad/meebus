<?php

include_once("includes/header.php");
	


	if(isset($_REQUEST['sub_upd']))
	{
	
		trim(extract($_POST)) ;
		
		//echo $uname ; exit ;
		$sql="insert into users (user_email,user_firstname,user_lastname,user_gender,user_landno,user_mobileno,	user_maritalstatus,user_occupation,user_address1_1,user_address1_2,user_address1_city,user_address1_state,user_address1_pin,user_address2_1,user_address2_2,user_address2_city,user_address2_state,user_address2_pin,user_typeID,user_status,user_password) values('$uemail','$uname','$lname','$ugen','$uland','$umob','$umet','$uocc','$uadd1','$uadd1_2','$ucity1','$ustate1',	'$upin1','$uadd2_1','$uadd2_2','$ucity2','$ustate2','$upin2','$utype','$ustatus','$user_password')";

		//$sql = "update users set user_email='$uemail',user_firstname='$uname', user_lastname='$lname', user_gender='$ugen',	user_landno='$uland',	user_mobileno='$umob',	user_maritalstatus ='$umet',	user_occupation='$uocc',user_address1_1='$uadd1',	user_address1_2='$uadd1_2',	user_address1_city='$ucity1', user_address1_state='$ustate1',	user_address1_pin = '$upin1',	user_address2_1='$uadd2_1',	user_address2_2='$uadd2_2',	user_address2_city='$ucity2', user_address2_state='$ustate2',	user_address2_pin='$upin2',user_typeID='$utype',user_status ='$ustatus',user_password='$user_password' where user_id ='$uid' ";
		
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
	
		<form action="" method="post" name="usr_add">
	
			<table align="center">
		
			<tr>
				<td width="140">User Firstname</td>
				<td width="23"></td>
				<td width="321">
				<input type="text" name="uname" id="uname" value="" class="textbox2">
				
				
				</td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>User Lastname</td>
				<td></td>
				<td><input type="text" name="lname" id="lname" value="" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>User Email</td>
				<td></td>
				<td><input type="text" name="uemail" id="uemail" value="" class="textbox2" ></td>
			</tr><tr><td colspan="3">&nbsp;</td></tr>
			<tr>
				<td>User Password</td>
				<td></td>
				<td><input type="text" name="user_password" id="user_password" value="" class="textbox2" ></td>
			</tr>
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>User Gender</td>
				<td></td>
				<td>				
										
				<select name="ugen" id="ugen" class="combobox-small" style="width:236px; height:25px;">
				
				<option value="f" >Female</option>
				<option value="m" >Male</option>
				</select>
				</td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Land No</td>
				<td></td>
				<td><input type="text" name="uland" id="uland" value="" onKeyPress="return numbersonly(this, event)" maxlength="10" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Mobile No</td>
				<td></td>
				<td><input type="text" name="umob" id="umob" value="" maxlength="13" onKeyPress="return numbersonly(this, event)" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Marital Status	</td>
				<td></td>
				<td>				
					<select name="umet" id="umet" class="combobox-small" style="width:236px; height:25px;">		
							
					<option value="M" >Married</option>
					<option value="U" >Unmarried</option>
					</select>
										
				</td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Occupation</td>
				<td></td>
				<td><input type="text" name="uocc" id="uocc" value="" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Address Line1	</td>
				<td></td>
				<td><input type="text" name="uadd1" id="uadd1" value="" class="textbox2">	</td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Address Line2</td>
				<td></td> 
				<td><input type="text" name="uadd1_2" id="uadd1_2" value="" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>City</td>
				<td></td>
				<td><input type="text" name="ucity1" id="ucity1" value="" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>State</td>
				<td></td> 
				<td><input type="text" name="ustate1" id="ustate1" value="" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Pincode</td>
				<td></td>
				<td><input type="text" name="upin1" id="upin1" value="" maxlength="6" onKeyPress="return numbersonly(this, event)" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			
			<tr>
				<td>Address 2 </td>
				<td></td>   
				<td><input type="text" name="uadd2" id="uadd2" value="" class="textbox2">	</td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Address 2</td>
				<td></td>
				<td><input type="text" name="uadd2_2" id="uadd2_2" value="" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>  
				<td>City</td>
				<td></td>
				<td><input type="text" name="ucity2" id="ucity2" value="" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>State</td>
				<td></td>
				<td><input type="text" name="ustate2" id="ustate2" value="" class="textbox2"></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td>Pincode</td>
				<td></td>
				<td><input type="text" name="upin2" id="upin2" value="" class="textbox2" maxlength="6" onKeyPress="return numbersonly(this, event)"></td>
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
											
					<option value="<?php echo $sql['usertype_id']; ?>" > <?php echo  $sql['usertype_name']; ?> </option>
				
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
				
				<option value="1" >Active</option>
				<option value="0" >Inactive</option>
				</select>
								
				</td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td colspan="3" align="center">
				<!--<input type="button" name="sub_upd" id="sub_upd" value="Update" onClick="alert('This is Demo version !!!');">-->
					<input type="submit" name="sub_upd" id="sub_upd" value="Add" onClick="return validate_editprofile(this.form);">					
				</td>
			</tr>
		
		</table>	
		
		</form>
		
	</fieldset>
	
</body>