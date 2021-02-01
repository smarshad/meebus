<?php
include "includes/header.php";

echo "<h2>Add new bus</h2>";
?>
<table>
<tr>
<td>
<form method="post" name="frmsubmit" id="frmsubmit" action="addNewBusDb.php" enctype="application/x-www-form-urlencoded">
<table class="normal" border="0">
<?php
	/*$bagrs = $db->query("select * from tbl_agents where ag_status = 1 order by ag_company");
	
    echo "<td><select name='selagent' onchange=''><option value='0'>-- Select an Agent--</option>";
			while ($bagrow = $db->fetch_array($bagrs))
			{
				echo "<option value=$bagrow[agent_id]>$bagrow[ag_company]</option>";
			}
			echo "</select></td></tr>"; */
			
	?>
	<?php
			    $comp_sql="SELECT * FROM serviceprovider_info order by SP_name";
			    $c=mysql_query($comp_sql);
				if(mysql_num_rows($c)>0){
			    ?>
				<tr>
				<td>Select Travel Agency</td>
				<td>				
				<select name="companylist" id="companylist">
				<option value="0">Select a Travel Agency</option>
				<?php 
				    while($row=mysql_fetch_array($c)){					   
				?>				
				<option value="<?php echo $row['SP_id']; ?>" <?php if(isset($_REQUEST['sp_id'])){ ?> selected="selected" <?php } ?>><?php echo $row['SP_name']; ?></option>
				
				<?php } ?>				
				</select></td>
				</tr>
	<?php	
	}
	else {
	header("Location: home.php");
	}	
	$bTypeRs = $db->query("select * from bustypes where typeStatus=1 order by typeName");
		
	echo "<tr><td>Select the Bus type</td>";
	echo "<td><select  name='busType'>";  
	while ($bTypeRow = $db->fetch_array($bTypeRs))
	{
		echo "<option value=".$bTypeRow['typeID'].">".$bTypeRow['typeName']."</option>"; 
	}
	echo "</select><td></tr>";	

	$fromRs = $db->query("select * from cities");
		
	echo "<tr><td>From city</td><td>";
	echo "<select name='fromCity'>";  
	while ($fromRow = $db->fetch_array($fromRs))
	{
		echo "<option value='$fromRow[id]'>$fromRow[city_name]</option>"; 
	}
	echo "</select><td></tr>";
	
	$toRs = $db->query("select * from cities");
	
	echo "<tr><td>To city</td><td>";
	echo "<select name='toCity'>";  
	while ($toRow = $db->fetch_array($toRs))
	{
		echo "<option value='$toRow[id]'>$toRow[city_name]</option>"; 
	}
	echo "</select><td></tr>";
?>
<tr><td valign="top">Boarding Point </td><td><input name="txtboard_1" type="text" id="txtboard_1" size="20" maxlength="50" /><div class="err_msg"><span id='txtboard_adv' name='txtboard_adv' style='display:none;'>Please enter the valid Boarding Point</span></div></td></tr>

<tr>
  <td align="left">Time</td>
  <td align="left" valign="top"><input name="txttime_1" type="text" id="txttime_1" size="5" maxlength="5" />
    
    <select name="selslot" id="selslot">
      <option value="AM">AM</option>
      <option value="PM">PM</option>
    </select>    
    Ex:04:30 PM
	<div class="err_msg"><span id='txttime_basic' name='txttime_basic' style='display:none;'> Please enter the valid Time</span></div>
	</td>
</tr>
<tr><td valign="top">Dropping Point </td><td><input name="txtboard_2" type="text" id="txtboard_2" size="20" maxlength="50" /><div class="err_msg"><span id='txtboard_adv' name='txtboard_adv' style='display:none;'>Please enter the valid Dropping Point</span></div></td></tr>

<tr>
  <td align="left">Time</td>
  <td align="left" valign="top"><input name="txttime_2" type="text" id="txttime_2" size="5" maxlength="5" />
    
    <select name="selslot" id="selslot">
      <option value="AM">AM</option>
      <option value="PM">PM</option>
    </select>    
    Ex:04:30 PM
	<div class="err_msg"><span id='txttime_basic' name='txttime_basic' style='display:none;'> Please enter the valid Time</span></div>
	</td>
</tr>
<tr><td colspan="2" align="center"><div class="err_msg"><?php echo $errmsg; $errmsg = ""; ?></div><div class="suc_msg"><?php echo $sucmsg; $sucmsg = ""; ?></div> <!-- <input type="submit" name="subboard" value="Add >>" onclick="return callSofm(frmboard)"/>--> </td></tr>
<tr><td> Fare </td><td><input type="text" name="fare" id="fare" /></td></tr>
<tr><td> Seats </td><td><input type="text" name="seats" id="seats" /></td></tr>
<tr><td>Seats for admin </td><td><input type="text" name="adminSeats" id="adminSeats" /></td></tr>
<tr><td>Seats for agency </td><td><input type="text" name="agencySeats" id="agencySeats" /></td></tr>

<tr><td><div class="err_msg" id="errmsg"></div><input type="submit" name="subbus" value="Add >>" onClick="return chkaddbus();" /></td></tr>
</table>
<?php 
echo "<input type='hidden' name='agentId' id='agentId' value='$_REQUEST[agentId]'>";
echo "";
?>
</form>
</td>
</tr>
<tr>
<td>
sdfsd
</td>
</tr>
</table>
<?php
include "includes/footer.php";
?>