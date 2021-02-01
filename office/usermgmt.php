<?php include_once("includes/header.php"); ?>

<script src="../js/pagination.js" type="text/javascript"></script>

<body onLoad="search_Usr();">

<fieldset class="table-bor">

		<legend><strong>User Management</strong></legend> 
		
		<table width="100%" border="0" cellspacing="2" cellpadding="5">
		  <tr>
			<td width="17%">Type any </td>
			<td width="44%">
			<input type="text" size="50" class="textbox2" onKeyUp="search_Usr();" id="usr_search" /> <br></td>
			
			<td colspan="4"></td>
			
		  </tr>
		  
		  <tr>
		  	<td></td>
			
			<td colspan="5">
				( Enter User Name, City, State, Pincode, Contact Nos, Email to search for a Details.)
			</td>
			
		  </tr>
			
			<tr><td colspan="6">
			
				<table width="100%">
					<tr>
			<td width="17%"> Gender </td>
			
			<td><select name="usr_gen" id="usr_gen" onChange="search_Usr();" class="combobox-small">
				<option value="0">All</option>
				<option value="f">Female</option>
				<option value="m">Male</option>
				</select></td>
				
			<td width="18%" align="center"> User Type </td>
			<td>
			    <select name="usr_type" id="usr_type" onChange="search_Usr();" class="combobox-small">
				<option value="0">All</option>
				
				<?php  					
					$sql = mysql_query("select * from usertypes where usertype_id not in(1,2)") ;
					
					while($getrow = mysql_fetch_array($sql))
					{
				?>
				<option value="<?php echo $getrow[0]; ?>"><?php echo $getrow[1] ; ?> </option>
				<?php } ?>				
				</select>
			</td>
			
			<td width="18%" align="center"> Status </td>
			<td width="21%"><select name="usr_status" id="usr_status" onChange="search_Usr();" class="combobox-small">
				<option value="2">All</option>
				<option value="1">Active</option>
				<option value="0">Inactive</option>
			  </select></td>
		  </tr>
			  </table>
			
			</td></tr>
		</table>
		
		<hr />

		<br>
		
		<div style="text-align:center;">
			<?php 
				if(isset($_REQUEST['s']))
				{ 
					$suc_st = "<font color='green'><strong>Status Changed</strong></font>"
				?>				
				<label><?php echo $suc_st; ?></label>
				<?php 
				}
				else if(isset($_REQUEST['e']))
				{ 
					$suc_st = "<font color='red'><strong>Status Cant Changed</strong></font>"
				?>				
				<label><?php echo $suc_st; ?></label>
				<?php 
				} 
				else if(isset($_REQUEST['ds']))
				{ 
					$suc_st = "<font color='green'><strong>User Deleted Succefully!!</strong></font>"
				?>				
				<label><?php echo $suc_st; ?></label>
				<?php 
				}
				else if(isset($_REQUEST['de']))
				{ 
					$suc_st = "<font color='red'><strong>Cant Delete the User!!</strong></font>"
				?>				
				<label><?php echo $suc_st; ?></label>
				<?php  }  
				else if(isset($_REQUEST['us']))
				{ 
					$suc_st = "<font color='green'><strong>User Details Updated Succefully!!</strong></font>"
				?>				
				<label><?php echo $suc_st; ?></label>
				<?php 
				}
				else if(isset($_REQUEST['ue']))
				{ 
					$suc_st = "<font color='red'><strong>Cant Updated the User!!</strong></font>"
				?>				
				<label><?php echo $suc_st; ?></label>
				<?php  }  ?>
		</div>
		
		<table>
			<tr>
				<td>
					<label id='errmsg' class="errmsg"></label>
					<label id='response' class="errmsg"></label>
				</td>
			</tr>
		</table>
<a href="add_user.php">Add User</a>
		<br>	
		
		<div id="loading"></div>
        <div id="container">		
            <div class="data">			
			</div>
            <div class="pagination"></div>			
        </div>
		<br />
		</fieldset>
</body>
<?php include "includes/footer.php"; ?>