<?php
include "includes/header.php";

if(isset($_REQUEST['luxsubmit']))
{
//echo "gfdgdf";
$luxitem=$_REQUEST['luxitem'];

$ins=mysql_query("insert into bus_luxitem(lux_name,lux_status) values('$luxitem','0')");

if($ins)
{
header("location:luxitem.php");
}

}


?>
<script src="../js/pagination.js" type="text/javascript"></script>
<script type="text/javascript">
function editcancelfun(){	
	document.getElementById('luxitem').value="";	
	//document.getElementById('txtcity').focus();
	document.getElementById('addopt').style.display="block";
	document.getElementById('editopt').style.display="none";
}
</script>

<script type="text/javascript">

function luxitem()
{
if(document.getElementById('luxitem').value=="")
{
alert("Enter the Luxury Item");
document.getElementById('luxitem').focus();
return false;
}

}

</script>
<body onLoad="search_lux();">
<fieldset class="table-bor">
<legend><strong>LUXUXY ITEM</strong></legend>	
<table width="50%" border="0" cellspacing="1" cellpadding="1" align="center">
  <tr>
    <td valign="top" width="50%" nowrap="nowrap">
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
	
      <tr>
        <td nowrap="nowrap">
		    <div id="tit_div">Enter Luxury Item: </div>
		</td>
        <td nowrap="nowrap">
		<input name="luxitem" type="text" id="luxitem" value="" size="30" maxlength="100" class="textbox" />
		</td>
		<td nowrap="nowrap">
		<div id="addopt" style="display:block;">
		<input name="luxsubmit" type="submit" id="luxsubmit" value="Add &gt;&gt;" onClick="addlux()" />
		</div>
		<div id="editopt" style="display:none;">
		<input type="hidden" id="cid" name="cid">
		<!--<input name="frmsubmit" type="button" id="frmsubmit" value="Edit &raquo;" onClick="alert('This is Demo version !!!')" />-->
		<input name="frmsubmit" type="button" id="frmsubmit" value="Edit &raquo;" onClick="editlux()" />
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
    <br />Search: <input type="text" name="serach_lux" id="search_lux" onKeyUp="search_lux();"  class="textbox" />
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