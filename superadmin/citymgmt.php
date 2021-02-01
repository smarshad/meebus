<?php
include "includes/header.php";
?>
<script src="../js/pagination.js" type="text/javascript"></script>
<script type="text/javascript">
function editcancelfun(){	
	document.getElementById('txtcity').value="";	
	//document.getElementById('txtcity').focus();
	document.getElementById('addopt').style.display="block";
	document.getElementById('editopt').style.display="none";
}
</script>
<body onLoad="search_city();">
<fieldset class="table-bor">
<legend><strong>City Management</strong></legend>	
<table width="50%" border="0" cellspacing="1" cellpadding="1" align="center">
  <tr>
    <td valign="top" width="50%" nowrap="nowrap">
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
      <tr>
        <td nowrap="nowrap">
		    <div id="tit_div">Enter New City: </div>
		</td>
        <td nowrap="nowrap">
		<input name="txtcity" type="text" id="txtcity" value="" size="30" maxlength="100" class="textbox" />
		</td>
		<td nowrap="nowrap">
		<div id="addopt" style="display:block;">
		<input name="frmsubmit" type="submit" id="frmsubmit" value="Add &gt;&gt;" onClick="addCity()" />
		</div>
		<div id="editopt" style="display:none;">
		<input type="hidden" id="cid" name="cid">
		<!--<input name="frmsubmit" type="button" id="frmsubmit" value="Edit &raquo;" onClick="alert('This is Demo version !!!')" />-->
		<input name="frmsubmit" type="button" id="frmsubmit" value="Edit &raquo;" onClick="editCity()" />
		<input type="button" value="cancel" onClick="editcancelfun()">
		</div>
		</td>
      </tr>
    </table>
	</td>
  </tr>
</table>
<hr/>
<table width="50%" border="0" cellspacing="1" cellpadding="1" align="center">
  <tr>
    <br />Search: <input type="text" name="serach_city" id="search_city" onKeyUp="search_city();"  class="textbox" />
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>   
	<div id="loading"></div>
	 <div id="container">
	 &nbsp;
	  <div class="data" id="gan"></div>	
	 </div>	
  </tr>
</table>
<div class="pagination"></div>
</fieldset>
</body>
<?php include "includes/footer.php"; ?>