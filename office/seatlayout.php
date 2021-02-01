<?php
include "includes/header.php";
?>
<fieldset class="table-bor">
	<legend><strong>Seat Layout Management</strong></legend>
    
    <table width="100%" border="0" cellspacing="5" cellpadding="5">
  <tr>
    <td width="333" nowrap="nowrap">
	<table border="0" cellspacing="5" cellpadding="5">
      <tr>
        <td nowrap="nowrap">Seat Type:<input type="text" id="txtbus" name="txtbus" /></td>
        <td nowrap="nowrap"><input type="submit" name="subbus" value="Add >>" onClick="return addtype();" /></td>
        
      </tr>
      <tr>
      <td nowrap="nowrap">Upper:<input type="radio"  name="upper" value="1" >Yes</input>
        <input type="radio" name="upper" value="0" checked>No</input>
		
		</td>
        </tr>
        <tr>
      <td nowrap="nowrap" id="upper_left_col">Upper Left Column:<input type="text"  name="upper_left_col" /></td>
        </tr>
        <tr>
      <td nowrap="nowrap" id="upper_left_row">Upper Left Row:<input type="text"  name="upper_left_row" /></td>
        </tr>
         <tr>
      <td nowrap="nowrap">Upper Right Column:<input type="radio"  name="upper" value="1" >Yes</input>
        <input type="radio" name="upper" value="0" checked>No</input>
		
		</td>
        </tr>
        <tr>
      <td nowrap="nowrap">Upper Right Row:<input type="radio"  name="upper" value="1" >Yes</input>
        <input type="radio" name="upper" value="0" checked>No</input>
		
		</td>
        </tr>
     </table>

	<table border="0" cellspacing="5" cellpadding="0">
	
      <tr>
        <td nowrap="nowrap">Seat Type:<input type="text" id="txtbustype" name="txtbustype" />
		<input type="hidden" id="txtbusid" name="txtbusid" />
		</td>
        <td nowrap="nowrap">
		<input type="submit" name="subbus" value="Edit >>" onClick="return edittype();" />
		<!--<input type="button" name="subbus" value="Edit &raquo;" onClick="alert('This is Demo version !!!');" />-->
		<input type="button" value="Cancel" onclick="edit_cancel()" />
		</td>
      </tr>
	  
     </table>

	</td>
    <td width="154" nowrap="nowrap">
	<div id="restype" style="display:block;">
	<table width="194" border="0" cellspacing="5" cellpadding="5">
      <tr>
        <th width="50">Type</th>
        <th width="61" align="center">Action</th>
      </tr>
	  <?php
	$brs = $db->query("select * from busstructuretypes WHERE structureStatus=1 order by structureType");
	while ($brow = $db->fetch_array($brs))
	{
	 if($brow['structureType'] != ''){
	?>
      <tr align="center">
        <td nowrap="nowrap"><?php echo $brow['structureType']; ?></td>
		<td align="center">
		<?php if($brow['structureStatus'] == 1) { ?>
		<a href="javascript:void(0)" onclick='javascript:inactivetype(<?php echo $brow['structureID']; ?>)' title="Click to Block">
		<img src="../images/Active.png" border="0" /></a>
		<?php } else { ?>
		<a href="javascript:void(0)" onclick='javascript:activetype(<?php echo $brow['structureID']; ?>)' title="Click to Unblock">
		<img src="../images/inactive.png" border="0" /></a>
		<?php } ?>
		<a href="javascript:void(0)" onclick="edit_form('<?php echo $brow['structureID']; ?>','<?php echo $brow['structureType']; ?>');" title="Edit">
		<img src="../images/edit.png" border="0" /></a>
		<a href="javascript:void(0)" onclick='javascript:deltype(<?php echo $brow['structureID']; ?>)' title="Delete">
		<!--<a href="javascript:void(0)" onclick='javascript:alert("This is Demo version !!!")' title="Delete">-->
		<img src="../images/delete.png" border="0" /></a>&nbsp;&nbsp;
		
		</td>
      </tr>
	  <?php } } ?>
    </table>
	</div>
	</td>
  </tr>
</table>
    
</fieldset>