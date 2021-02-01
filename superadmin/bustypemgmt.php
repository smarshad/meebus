<?php
include "includes/header.php";

if (isset($_REQUEST['subbus']))
{
	$db->query("insert into tbl_bus_type (type) values('".$_REQUEST['txtbus']."')");
	
}

?>

<fieldset class="table-bor">

	<legend><strong>Bus Type Management</strong></legend>


<table width="530" border="0" cellspacing="5" cellpadding="5">
  <tr>
    <td width="333" nowrap="nowrap">
	<div id="ad" style="visibility:visible; position:absolute;">
	<table border="0" cellspacing="5" cellpadding="5">
      <tr>
        <td nowrap="nowrap">Bus Type:<input type="text" id="txtbus" name="txtbus" /></td>
        <td nowrap="nowrap"><input type="submit" name="subbus" value="Add >>" onClick="return addtype();" /></td>
      </tr>
     </table>
	 </div>
	 <div id="edt" style="visibility:hidden; ">
	<table border="0" cellspacing="5" cellpadding="0">
	
      <tr>
        <td nowrap="nowrap">Bus Type:<input type="text" id="txtbustype" name="txtbustype" />
		<input type="hidden" id="txtbusid" name="txtbusid" />
		</td>
        <td nowrap="nowrap">
		<input type="submit" name="subbus" value="Edit >>" onClick="return edittype();" />
		<!--<input type="button" name="subbus" value="Edit &raquo;" onClick="alert('This is Demo version !!!');" />-->
		<input type="button" value="Cancel" onclick="edit_cancel()" />
		</td>
      </tr>
	  
     </table>
	 </div>
	</td>
    <td width="154" nowrap="nowrap">
	<div id="restype" style="display:block;">
	<table width="194" border="0" cellspacing="5" cellpadding="5">
      <tr>
        <th width="50">Type</th>
        <th width="61" align="center">Action</th>
      </tr>
	  <?php
	$brs = $db->query("select * from bustypes WHERE del_status=1 order by typeName");
	while ($brow = $db->fetch_array($brs))
	{
	 if($brow['typeName'] != ''){
	?>
      <tr align="center">
        <td nowrap="nowrap"><?php echo $brow['typeName']; ?></td>
		<td align="center">
		<?php if($brow['typeStatus'] == 1) { ?>
		<a href="javascript:void(0)" onclick='javascript:inactivetype(<?php echo $brow['typeID']; ?>)' title="Click to Block">
		<img src="../images/Active.png" border="0" /></a>
		<?php } else { ?>
		<a href="javascript:void(0)" onclick='javascript:activetype(<?php echo $brow['typeID']; ?>)' title="Click to Unblock">
		<img src="../images/inactive.png" border="0" /></a>
		<?php } ?>
		<a href="javascript:void(0)" onclick="edit_form('<?php echo $brow['typeID']; ?>','<?php echo $brow['typeName']; ?>');" title="Edit">
		<img src="../images/edit.png" border="0" /></a>
		<a href="javascript:void(0)" onclick='javascript:deltype(<?php echo $brow['typeID']; ?>)' title="Delete">
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
	 
</body>

<?php include "includes/footer.php";
?>


<script type="text/javascript">
function edit_form(id,name)
{ 
	document.getElementById('edt').style.visibility="visible";
	document.getElementById('ad').style.visibility="hidden";
	document.getElementById('edt').style.position = 'static' ;
	document.getElementById('txtbustype').value=name;
	document.getElementById('txtbusid').value=id;
}
function edit_cancel()
{ 
	document.getElementById('edt').style.visibility="hidden";
	document.getElementById('ad').style.visibility="visible";
	//document.getElementById('edt').style.position = 'static' ;
	document.getElementById('txtbustype').value="";
	//document.getElementById('txtbusid').value=id;
}

</script>