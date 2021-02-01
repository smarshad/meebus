<?php include_once("includes/header.php"); ?>

<script src="../js/pagination.js" type="text/javascript"></script>

<body onLoad="sms_log();">

<fieldset class="table-bor">

		<legend><strong>SMS Management</strong></legend> 
		
		<table width="100%" border="1" cellspacing="2" cellpadding="5">
		 
			
			<tr><td colspan="6">
			
				<table width="100%">
					<tr>
			<td width="17%"> Filter By </td>
			
			<td><select name="filter" id="filter" onChange="sms_log();" class="combobox-small">
			<option value="0">All</option>
				<option value="1">ToDay</option>
				<option value="2">Last Week</option>
				<option value="3">Last Month</option>
				</select></td>
				
			<td width="18%" align="center"> Bus Name </td>
			<td>
			    <select name="bus" id="bus" onChange="sms_log();" class="combobox-small">
				<option value="0">All</option>
				
				<?php  					
					$sql = mysql_query("select * from businfo where Bus_status='1'") ;
					
					while($getrow = mysql_fetch_array($sql))
					{
				?>
				<option value="<?php echo $getrow['Bus_id']; ?>"><?php echo $getrow['Bus_name'] ; ?> </option>
				<?php } ?>				
				</select>
			</td>
			
			
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