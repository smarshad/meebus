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
	
		<td width="119" height="30">&nbsp;</td> 
		
		<td width="250" align="left" nowrap="nowrap" valign="middle"><strong>Image Name</strong></td> 
		
		<td width="63" class="content1" align="center"><strong> :</strong></td> 
		
		<td width="526" align="left"> &nbsp;
		
			<font face="Verdana" style="font-size:12px "> 
		
				<input type="text" name="ban_name" id="ban_name" value="<?php echo $sel['ban_name'] ?>" class="textbox1" /> 
		
		  </font>
			
	  </td> 
	
	</tr> 
	
	<tr height="3px"><td colspan="3"></td></tr>

	<tr> 
	
		<td>&nbsp;</td> 
		
		<td align="left" nowrap="nowrap" class="admintext" valign="middle">
			<strong>Image width:</strong>
		</td> 
		
		<td width="63" class="content1" align="center"><strong> :</strong></td> 
		
		<td align="left"> &nbsp;
		
			<font face="Verdana" style="font-size:12px "> 
		
				<input type="text" name="ban_width" id="ban_width" value="<?php echo $sel['ban_width'] ?>" class="textbox1" />
		
			</font>
		</td> 
	
	</tr> 

		<td height="30">&nbsp;</td> 
		
		<td align="left" class="admintext" valign="middle"><strong>Image Height</strong></div></td> 
		
		<td width="63" class="content1" align="center"><strong> :</strong></td> 
		
		<td align="left"> &nbsp;
		
			<font face="Verdana" style="font-size:12px "> 
		
				<input type="text" name="ban_height" id="ban_height" value="<?php echo $sel['ban_height'] ?>" class="textbox1" /> 
		
			</font>
			
		</td> 
	
	</tr>


	
	<tr height="3px"><td colspan="3"></td></tr>

	<tr> 
	
		<td height="70">&nbsp;</td> 
		
		<td align="left" class="admintext" valign="middle"><strong>Existing Images </strong></td> 
		
		<td width="63" class="content1" align="center"><strong> :</strong></td> 
		
		<td align="left"> &nbsp;
		
			<font face="Verdana" style="font-size:12px "> 
		
				<img src="../images/<?php echo $sel['ban_image'] ?>" width="149" height="47" border="0" /> 
		
			</font>
			
		</td> 
	
	</tr> 
	
	<tr height="3px"><td colspan="3"></td></tr>

	<tr> 
	
		<td>&nbsp;</td> 
		
		<td align="left" class="admintext" valign="middle"><strong>Upload Image </strong></td> 
		
		<td width="63" class="content1" align="center"><strong> :</strong></td> 
		
		<td align="left"> &nbsp;
			
			<font face="Verdana" style="font-size:12px "> 
		
				<input type="file" name="logo" id="logo"/><input type="hidden" name="sitelogoname" id="sitelogoname" value="<?php echo $sel['ban_image'] ?>"/> 
		
			</font>
			
		</td> 
	
	</tr> 
	
	<tr height="3px"><td colspan="3"></td></tr>

	
	<tr> 
	
		<td colspan="4">&nbsp;</td> 
		
		</tr>	
		
		<tr> 
		
		<td height="27" colspan="4" align="center"> &nbsp;
			<input type="submit" name="submit" value="Save" class="submitlink" onclick="return chk_genvalidation()"/> 
			<!--<input type="button" name="submit" value="Save" class="submitlink" onclick="alert('This is Demo version !!!');"/> -->
		</td> 
	
	</tr> 
	
</form> 

</table> 

</fieldset>

<?php include "includes/footer.php"; ?>