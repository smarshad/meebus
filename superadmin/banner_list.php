<?php 

include_once("includes/header.php");


	if(isset($_REQUEST['submit']))	
	{

	trim(extract($_POST));

	$ban_name = $_POST['ban_name'];

	$ban_width = $_POST['ban_width'];

	$ban_height = $_POST['ban_height'];


	$logo = $_POST['logo'];



	if($_FILES['logo']['name']=='')
	{
	//echo "update banner_ad set ban_name='$ban_name',ban_width ='$ban_width',ban_height='$ban_height' WHERE ban_id=1";
		mysql_query("update banner_ad set ban_name='$ban_name',ban_width ='$ban_width',ban_height='$ban_height' WHERE ban_id=1");
	}

	else
	{

		if(file_exists($logo))
	
		unlink($logo);
	
		$logoname=$_FILES['logo']['name'];
	
		$tmp_logo=$_FILES['logo']['tmp_name'];
	
		$dir="../images/".$logoname;
	
		move_uploaded_file($tmp_logo,$dir);

         //echo "update banner_ad set ban_name='$ban_name',ban_width ='$ban_width',ban_height='$ban_height',ban_image='$ 	logoname' WHERE ban_id=1"; exit;

mysql_query("update banner_ad set ban_name='$ban_name',ban_width ='$ban_width',ban_height='$ban_height',ban_image='$logoname' WHERE ban_id=1");

	}
	

	}

	$sel=mysql_fetch_array(mysql_query("select * from banner_ad"));

?>

<script type="text/javascript">

function validate()
{
//alert("hello");
if(document.getElementById('ban_name').value=="")
{
alert("Enter the Banner name");
document.getElementById('ban_name').focus();
return false;
}

if(document.getElementById('ban_width').value=="")
{
alert("Enter the banner width");
document.getElementById('ban_width').focus();
return false;
}

if(document.getElementById('ban_height').value=="")
{
alert("Enter the banner height");
document.getElementById('ban_height').focus();
return false;
}



if(document.getElementById('sitelogoname').value == "")
{
if(document.getElementById('logo').value != "")

	{
		var ss=document.getElementById('logo').value;
		var index=ss.lastIndexOf(".");				
		var sstring=ss.substring(index+1);
		var ssivanew=sstring.toLowerCase();
		if(ssivanew != "jpg" && ssivanew != "png" && ssivanew != "jpeg" && ssivanew != "gif" && ssivanew != "JPG" && ssivanew != "PNG" && ssivanew != "JPEG" && ssivanew != "GIF")
		{
			  alert("Upload jpg,png,jpeg,gif images only...");
			  document.getElementById('logo').value="";
			  document.getElementById('logo').focus();
			  return false;
		 }
	}
}

}

</script>


<fieldset class="table-bor">

<legend><strong>Banner Ads</strong></legend>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"> 

<form action="" name="settings" method="post" enctype="multipart/form-data" onsubmit="return validate();"> 

	<tr height="14px"><td colspan="3"></td></tr>
	
	<tr class="admintext"> 
	    <td width="330" height="45"></td>
        <td width="84" align="left" nowrap="nowrap" valign="middle"><strong>S.no</strong></td> 
		<td width="139" align="left" nowrap="nowrap" valign="middle"><strong>Banner Name</strong></td> 
		<td width="420" align="left" nowrap="nowrap" valign="middle"><strong>Action</strong></td>
		
	
	</tr> 
 <?php 
 $sel=mysql_fetch_array(mysql_query("select * from banner_ad where ban_id=1"));
 ?>
	<tr class="admintext"> 
	    <td height="45"></td>
        <td height="45">1</td>
		<td ><strong><?php echo $sel['ban_name']; ?></strong></td> 
		
		<td >
		<img src="images/edit.png" /> &nbsp;&nbsp;&nbsp;
		<img src="images/deletered.png" />
		</td> 
		
	
	</tr> 
	
	<tr height="3px"><td height="41" colspan="2"></td>
	</tr>

	
	
</form> 

</table> 

</fieldset>

<?php include "includes/footer.php"; ?>