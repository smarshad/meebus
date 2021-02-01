<?php include "includes/header.php"; ?>

<script type="text/javascript">
function val(){
var from=document.getElementById('fromid').value;
if(from!=''){
var d=document.getElementById('to_list');
var y=0;
	 for(i = 0;i < d.length;i++)
		{
		if(d[i].selected)
		  {
		   y=1;
		   break;
		  }  
		}
		
	if(y==0){
		alert('Please Select One Destination City');
		document.getElementById('to_list').focus();
		return false;	  
	}		
}
else{
    alert('Please Select One Source City');
	document.getElementById('fromid').focus();
	return false;
}
add_destination();
return false;
}
</script>
<fieldset class="table-bor">
	<legend><strong>Route Management</strong></legend>

<form action="" name="route_form" id="route_form" method="post">
<table width="50%" border="0" cellspacing="5" cellpadding="5" align="center">
  <tr>
    <td align="center">
<fieldset class="table-bor">
<legend>Select Source City</legend>
<select name="fromid" id="fromid" onchange="get_TO_city_list(this.value)">
<option value="" selected="selected">-- Select Source City --</option>
<?php 
$urs = $db->query("select * from cities where del_status!=0 order by city_name");
while ($urow = $db->fetch_array($urs))
{
?>
<option value="<?php echo $urow['id']; ?>" <?php if($_REQUEST['cityid'] == $urow['id']){ ?> selected="selected" <?php } ?>><?php echo $urow['city_name']; ?></option>
<?php
}
?>
</select>
</fieldset>	
	</td>
  </tr>
</table>
<div id="tolist">
<table width="50%" border="0" cellspacing="3" cellpadding="2" align="center">
  <tr>
    <td align="left" width="">
<fieldset class="table-bor">
<legend>Select Destination City</legend>
<select multiple="multiple" name="to_list" id="to_list" size="20">
<option value="">Please Choose Source City</option>
</select>
</fieldset>	
	</td>
    <td valign="top">
	<div id="list_dest">
    </div>
    </td>
  </tr>
</table>
</div>
</form>

</fieldset>

<?php
if(isset($_REQUEST['cityid'])){
$cityid=$_REQUEST['cityid'];
echo '<script type="text/javascript">
get_TO_city_list('.$cityid.');
</script>';
}
include "includes/footer.php";
?>