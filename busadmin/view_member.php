<?php  
include_once("includes/header.php");
	
if(isset($_REQUEST['memid']))
{
	
	$memid=$_REQUEST['memid'];
		
	$mqry="SELECT * FROM users WHERE user_id=".$memid;
	
	$mem_rs=mysql_query($mqry);
	
	$data=mysql_fetch_array($mem_rs);
	
}
else{
    header("location: passmgmt.php");
}

?>

<body>

<fieldset class="table-bor">

	<legend>User Details</legend> 
	
		<form action="edit_member.php" method="post">
	
			<table align="center">
		
			<tr>
				<td width="140"><strong>User Firstname</strong></td>
				<td width="23"></td>
				<td width="321"><?php if(!empty($data['user_firstname'])) { echo ucwords($data['user_firstname']); } else { echo "---"; } ?></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td><strong>User Lastname</strong></td>
				<td></td>
				<td><?php if(!empty($data['user_lastname'])) { echo ucwords($data['user_lastname']); } else { echo "---"; } ?></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td><strong>User Email</strong></td>
				<td></td>
				<td><?php echo $data['user_email']; ?></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td><strong>User Gender</strong></td>
				<td></td>
				<td>				
					<?php 
					 if(!empty($data['user_gender'])) {
					if($data['user_gender'] == 'f')
						echo "Female" ;
					else
						echo "Male" ;
					} else { echo "---"; }	
					?>
				</td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td><strong>Land No</strong></td>
				<td></td>
				<td><?php if(!empty($data['user_landno'])) { echo $data['user_landno']; } else { echo "---"; } ?></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td><strong>Mobile No</strong></td>
				<td></td>
				<td><?php if(!empty($data['user_mobileno'])) { echo $data['user_mobileno']; } else { echo "---"; } ?></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td><strong>Marital Status</strong>	</td>
				<td></td>
				<td>
					<?php 
					if(!empty($data['user_maritalstatus'])) {
					if($data['user_maritalstatus'] == 'm')
						echo "Married" ;
					else
						echo "Unmarried" ;
					 } else { echo "---"; }	
					?>
					
				</td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td><strong>Occupation</strong></td>
				<td></td>
				<td><?php if(!empty($data['user_occupation'])) { echo $data['user_occupation']; } else { echo "---"; } ?></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td><strong>Address Line1</strong>	</td>
				<td></td>
				<td><?php if(!empty($data['user_address1_1'])) { echo $data['user_address1_1']; } else { echo "---"; } ?>	</td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td><strong>Address Line2</strong></td>
				<td></td>
				<td><?php if(!empty($data['user_address1_2'])) { echo $data['user_address1_2'];  } else { echo "---"; } ?></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td><strong>City</strong></td>
				<td></td>
				<td><?php if(!empty($data['user_address1_city'])) { echo $data['user_address1_city']; } else { echo "---"; } ?></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td><strong>State</strong></td>
				<td></td>
				<td><?php if(!empty($data['user_address1_state'])) { echo $data['user_address1_state']; } else { echo "---"; } ?></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td><strong>Pincode</strong></td>
				<td></td>
				<td><?php  if(!empty($data['user_address1_pin'])) {  echo $data['user_address1_pin'];  } else { echo "---"; }?></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			
			<tr>
				<td><strong>Address 2</strong> </td>
				<td></td>
				<td><?php if(!empty($data['user_address2_1'])) { echo $data['user_address2_1']; } else { echo "---"; } ?>	</td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td><strong>Address 2</strong></td>
				<td></td>
				<td><?php if(!empty($data['user_address2_2'])) { echo $data['user_address2_2']; } else { echo "---"; } ?></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td><strong>City</strong></td>
				<td></td>
				<td><?php if(!empty($data['user_address2_city'])) { echo $data['user_address2_city']; } else { echo "---"; } ?></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td><strong>State</strong></td>
				<td></td>
				<td><?php if(!empty($data['user_address2_state'])) { echo $data['user_address2_state']; } else { echo "---"; } ?></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td><strong>Pincode</strong></td>
				<td></td>
				<td><?php if(!empty($data['user_address2_pin'])) { echo $data['user_address2_pin']; } else { echo "---"; } ?></td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td><strong>User Type</strong></td>
				<td></td>
				<td>
					<?php 
			
						$utype = $data['user_typeID']; 
						
						$sql = mysql_fetch_array(mysql_query("select * from usertypes where usertype_id='$utype'")) ;
						
						echo $sql['usertype_name'] ;
					?>
				</td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td><strong>Status</strong></td>
				<td></td>
				<td>
				<?php				
				
					$sp_status = $data['user_status'] ;
				
					if($sp_status==1)
					{
					   echo "<img src='../images/Active.png' />";					   					
					}
					else if($sp_status==0)
					{
					   echo "<img src='../images/inactive.png' />";
					}
		
				?>
				</td>
			</tr>
			
			<tr><td colspan="3">&nbsp;</td></tr>
			
			<tr>
				<td colspan="3" align="center">
					<!--<a href="usermgmt.php">Back</a>-->
					<a href="javascript:void(0)" onClick="history.go(-1);">Back</a>
						&nbsp; &nbsp;
				</td>
			</tr>
		
		</table>	
		
		</form>
		
	</fieldset>
	
</body>