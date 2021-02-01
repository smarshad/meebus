<?php 

include_once("includes/header.php");


	if(isset($_REQUEST['submit']))	
	{

	trim(extract($_POST));

	$webname = $_POST['webname'];

	$webkeyword = $_POST['webkeyword'];

	$webdes = $_POST['webdes'];

	$site_team = $_POST['site_team'];

	$site_admin = $_POST['site_admin'];

	$site_com = $_POST['site_com'];
	
	$paginate_val=$_REQUEST['paginate_val'];

	$mail_url = $_POST['mail_url'];
	
	$smtp_server=$_REQUEST['smtp_server'];
	
	$smtp_username=$_REQUEST['smtp_username'];
	
	$smtp_password=$_REQUEST['smtp_password'];
	
	$month_count=$_REQUEST['month_count'];
	
	$days_count=$_REQUEST['days_count'];

	$logo = $_POST['logo'];

	$paypalid = $_POST['paypalid'];
	
	$tax=$_REQUEST['tax'];
	
	//$cc_rate=$_REQUEST['cc_rate'];
	
	$paypal_rate=$_REQUEST['paypal_rate'];

	

	if($_FILES['logo']['name']=='')
	{
		mysql_query("update generalsettings set website_name='$webname',website_keywords ='$webkeyword',website_desc='$webdes',website_team='$site_team',website_admin='$site_admin',website_url='$site_com',mail_url='$mail_url',paginate_value='$paginate_val',paypal_dmailid='$paypalid',smtp_server='$smtp_server',smtp_username='$smtp_username',smtp_password='$smtp_password',tax='$tax',bankrate_paypal='$paypal_rate',month_count='$month_count',days_count='$days_count' WHERE id=1");
	}

	else
	{

		if(file_exists($logo))
	
		unlink($logo);
	
		$logoname=$_FILES['logo']['name'];
	
		$tmp_logo=$_FILES['logo']['tmp_name'];
	
		$dir="../images/".$logoname;
	
		move_uploaded_file($tmp_logo,$dir);

      //echo "update generalsettings set website_name='$webname',website_keywords ='$webkeyword',website_desc='$webdes',website_team='$site_team',website_admin='$site_admin',website_url='$site_com',mail_url='$mail_url',paginate_value='$paginate_val',paypal_dmailid='$paypalid', site_logo='$logoname',smtp_server='$smtp_server',smtp_username='$smtp_username',smtp_password='$smtp_password',tax='$tax',bankrate_paypal='$paypal_rate',month_count='$month_count',days_count='$days_count' WHERE id=1"; exit;

	mysql_query("update generalsettings set website_name='$webname',website_keywords ='$webkeyword',website_desc='$webdes',website_team='$site_team',website_admin='$site_admin',website_url='$site_com',mail_url='$mail_url',paginate_value='$paginate_val',paypal_dmailid='$paypalid', site_logo='$logoname',smtp_server='$smtp_server',smtp_username='$smtp_username',smtp_password='$smtp_password',tax='$tax',bankrate_paypal='$paypal_rate',month_count='$month_count',days_count='$days_count' WHERE id=1");

	}
	

	}

	$sel=mysql_fetch_array(mysql_query("select * from generalsettings"));

?>

<script type="text/javascript">

function validate()
{
//alert("hello");
if(document.getElementById('webname').value=="")
{
alert("Enter the Website name");
document.getElementById('webname').focus();
return false;
}

if(document.getElementById('webkeyword').value=="")
{
alert("Enter the Website Keywords");
document.getElementById('webkeyword').focus();
return false;
}

if(document.getElementById('webdes').value=="")
{
alert("Enter the Website Description");
document.getElementById('webdes').focus();
return false;
}

if(document.getElementById('site_team').value=="")
{
alert("Enter the Website Team");
document.getElementById('site_team').focus();
return false;
}

if(document.getElementById('site_admin').value=="")
{
alert("Enter the Website Admin Mail");
document.getElementById('site_admin').focus();
return false;
}

if(document.getElementById('site_com').value=="")
{
alert("Enter the Website Url");
document.getElementById('site_com').focus();
return false;
}

if(document.getElementById('mail_url').value=="")
{
alert("Enter the Mail Url");
document.getElementById('mail_url').focus();
return false;
}

if(document.getElementById('smtp_server').value=="")
{
alert("Enter the smtp server name");
document.getElementById('smtp_server').focus();
return false;
}

if(document.getElementById('smtp_username').value=="")
{
alert("Enter the smtp server Username");
document.getElementById('smtp_username').focus();
return false;
}

if(document.getElementById('smtp_password').value=="")
{
alert("Enter the smtp server password");
document.getElementById('smtp_password').focus();
return false;
}

if(document.getElementById('smtp_password').value=="")
{
alert("Enter the smtp server password");
document.getElementById('smtp_password').focus();
return false;
}

if(document.getElementById('tax').value=="")
{
alert("Enter the Tax Amount");
document.getElementById('tax').focus();
return false;
}


if(document.getElementById('paypal_rate').value=="")
{
alert("Enter the Bank rate of Paypal");
document.getElementById('paypal_rate').focus();
return false;
}


if((document.getElementById('month_count').value=="") && (document.getElementById('days_count').value==""))
{
alert("Choose the month and days");
document.getElementById('month_count').focus();
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

<legend><strong>General Settings</strong></legend>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"> 

<form action="" name="settings" method="post" enctype="multipart/form-data" onsubmit="return validate();"> 

	<tr height="14px"><td colspan="3"></td></tr>

	<tr class="admintext"> 
	
		<td width="119" height="30">&nbsp;</td> 
		
		<td width="250" align="left" nowrap="nowrap" valign="middle"><strong>Website Name</strong></td> 
		
		<td width="63" class="content1" align="center"><strong> :</strong></td> 
		
		<td width="526" align="left"> &nbsp;
		
			<font face="Verdana" style="font-size:12px "> 
		
				<input type="text" name="webname" id="webname" value="<?php echo $sel['website_name']; ?>" class="textbox1" /> 
		
		  </font>
			
	  </td> 
	
	</tr> 
	
	<tr height="3px"><td colspan="3"></td></tr>

	<tr> 
	
		<td>&nbsp;</td> 
		
		<td align="left" nowrap="nowrap" class="admintext" valign="middle">
			<strong>Website Keywords:</strong>
		</td> 
		
		<td width="63" class="content1" align="center"><strong> :</strong></td> 
		
		<td align="left"> &nbsp;
		
			<font face="Verdana" style="font-size:12px "> 
		
				<textarea name="webkeyword" id="webkeyword"><?php echo $sel['website_keywords']; ?></textarea> 
		
			</font>
		</td> 
	
	</tr> 
	
	<tr height="3px"><td colspan="3"></td></tr>

	<tr> 
	
		<td>&nbsp;</td> 
		
		<td align="left" class="admintext" valign="middle"><strong>Website Description </strong></div></td> 
		
		<td width="63" class="content1" align="center"><strong> :</strong></td> 
		
		<td align="left"> &nbsp;
			
			<font face="Verdana" style="font-size:12px "> 
		
				<textarea name="webdes" id="webdes"><?php echo $sel['website_desc']; ?></textarea> 
		
			</font>
			
		</td> 
	
	</tr> 

	<tr height="3px"><td colspan="3"></td></tr>
	
	<tr> 
	
		<td height="30">&nbsp;</td> 
		
		<td align="left" class="admintext" valign="middle"><strong>Website Team </strong></div></td> 
		
		<td width="63" class="content1" align="center"><strong> :</strong></td> 
		
		<td align="left"> &nbsp;
		
			<font face="Verdana" style="font-size:12px "> 
		
				<input type="text" name="site_team" id="site_team" value="<?php echo $sel['website_team']; ?>" class="textbox1" /> 
		
			</font>
			
		</td> 
		
	</tr> 
	
	<tr height="3px"><td colspan="3"></td></tr>

	<tr> 
	
		<td height="30">&nbsp;</td> 
		
		<td align="left" class="admintext" valign="middle"><strong>Website Admin </strong></div></td> 
		
		<td width="63" class="content1" align="center"><strong> :</strong></td> 
		
		<td align="left"> &nbsp;
		
			<font face="Verdana" style="font-size:12px "> 
		
				<input type="text" name="site_admin" id="site_admin" value="<?php echo $sel['website_admin']; ?>"class="textbox1" /> 
		
			</font>
			
		</td> 
	
	</tr>
	
	<tr height="3px"><td colspan="3"></td></tr>	 

	<tr> 
	
		<td height="30">&nbsp;</td> 
		
		<td align="left" class="admintext" valign="middle"><strong>Website url </strong></td> 
		
		<td width="63" class="content1" align="center"><strong> :</strong></td> 
		
		<td align="left"> &nbsp;
		
			<font face="Verdana" style="font-size:12px "> 
		
				<input type="text" name="site_com" id="site_com" value="<?php echo $sel['website_url']; ?>" class="textbox1" /> 
		
			</font>
			
		</td> 
	
	</tr> 
	
	<tr height="3px"><td colspan="3"></td></tr>
	
	<tr> 
	
		<td height="30">&nbsp;</td> 
		
		<td align="left" class="admintext" valign="middle"><strong>Mail url </strong></td> 
		
		<td width="63" class="content1" align="center"><strong> :</strong></td> 
		
		<td align="left"> &nbsp;
		
			<font face="Verdana" style="font-size:12px "> 
		
				<input type="text" name="mail_url" id="mail_url" value="<?php echo $sel['mail_url']; ?>" class="textbox1" /> 
		
			</font>
			
		</td> 
	
	</tr> 
	
	<tr> 
	
		<td height="30">&nbsp;</td> 
		
		<td align="left" class="admintext" valign="middle"><strong>Smtp Server </strong></td> 
		
		<td width="63" class="content1" align="center"><strong> :</strong></td> 
		
		<td align="left"> &nbsp;
		
			<font face="Verdana" style="font-size:12px "> 
		
				<input type="text" name="smtp_server" id="smtp_server" value="<?php echo $sel['smtp_server']; ?>" class="textbox1" /> 
		
			</font>
			
		</td> 
	
	</tr> 
	
	<tr> 
	
		<td height="30">&nbsp;</td> 
		
		<td align="left" class="admintext" valign="middle"><strong>Smtp Username </strong></td> 
		
		<td width="63" class="content1" align="center"><strong> :</strong></td> 
		
		<td align="left"> &nbsp;
		
			<font face="Verdana" style="font-size:12px "> 
		
				<input type="text" name="smtp_username" id="smtp_username" value="<?php echo $sel['smtp_username']; ?>" class="textbox1" /> 
		
			</font>
			
		</td> 
	
	</tr> 
	
	<tr> 
	
		<td height="30">&nbsp;</td> 
		
		<td align="left" class="admintext" valign="middle"><strong>Smtp Password </strong></td> 
		
		<td width="63" class="content1" align="center"><strong> :</strong></td> 
		
		<td align="left"> &nbsp;
		
			<font face="Verdana" style="font-size:12px "> 
		
				<input type="text" name="smtp_password" id="smtp_password" value="<?php echo $sel['smtp_password']; ?>" class="textbox1" /> 
		
			</font>
			
		</td> 
	
	</tr> 
	
	<tr> 
	
		<td height="30">&nbsp;</td> 
		
		<td align="left" class="admintext" valign="middle"><strong>Tax Amount</strong></td> 
		
		<td width="63" class="content1" align="center"><strong> :</strong></td> 
		
		<td align="left"> &nbsp;
		
			<font face="Verdana" style="font-size:12px "> 
		
				<input type="text" name="tax" id="tax" value="<?php echo $sel['tax']; ?>" class="textbox1" /> 
		
			</font>
			
		</td> 
	
	</tr> 
	
<!--	<tr> 
	
		<td height="30">&nbsp;</td> 
		
		<td align="left" class="admintext" valign="middle"><strong>CCAvenue Bank Rate</strong></td> 
		
		<td width="63" class="content1" align="center"><strong> :</strong></td> 
		
		<td align="left"> &nbsp;
		
			<font face="Verdana" style="font-size:12px "> 
		
				<input type="text" name="cc_rate" id="cc_rate" value="<?php // echo $sel['bankrate_ccavenue'] ?>" class="textbox1" /> 
		
			</font>
			
		</td> 
	
	</tr>--> 
	
	<tr> 
	
		<td height="30">&nbsp;</td> 
		
		<td align="left" class="admintext" valign="middle"><strong> Bank Rate </strong></td> 
		
		<td width="63" class="content1" align="center"><strong> :</strong></td> 
		
		<td align="left"> &nbsp;
		
			<font face="Verdana" style="font-size:12px "> 
		
				<input type="text" name="paypal_rate" id="paypal_rate" value="<?php echo $sel['bankrate_paypal']; ?>" class="textbox1" /> 
		
			</font>
			
		</td> 
	
	</tr> 
	<tr> 
	
		<td height="30">&nbsp;</td> 
		
		<td align="left" class="admintext" valign="middle"><strong>Automatic Days Count </strong></td> 
		
		<td width="63" class="content1" align="center"><strong> :</strong></td> 
		
		<td align="left"> &nbsp;
		
			<font face="Verdana" style="font-size:12px "> 
		
				<select name="month_count" id="month_count" style="width:90px;" class="text">
 	                       <option value="">Month</option>
							  <?php for($i=0; $i<=12; $i++) {  ?>

							  	<option value="<?php echo $i; ?>" <?php if($sel['month_count']==$i) {  ?> selected="selected" <?php } ?>><?php echo $i; ?></option>

							  			<?php } ?>	

							  </select>	
							  <select name="days_count" id="days_count" style="width:90px;" class="text">
                         <option value="">days</option>
							  <?php for($j=1; $j<=30; $j++) {  ?>

							   <option value="<?php echo $j; ?>" <?php if($sel['days_count']==$j) {  ?> selected="selected" <?php } ?>><?php echo $j; ?></option>

							  			<?php } ?>	

							  </select>	
		
			</font>
			
		</td> 
	
	</tr>
	
	<tr height="3px"><td colspan="3"></td></tr>

	<tr> 
	
	<tr> 
	
		<td height="30">&nbsp;</td> 
		
		<td align="left" class="admintext" valign="middle"><strong>Pagination Limit Value </strong></td> 
		
		<td width="63" class="content1" align="center"><strong> :</strong></td> 
		
		<td align="left"> &nbsp;
		
			<font face="Verdana" style="font-size:12px "> 
		
				<input type="text" name="paginate_val" id="paginate_val" value="<?php echo $sel['paginate_value'] ?>" class="textbox1" /> 
		
			</font>
			
		</td> 
	
	</tr>
	
	<tr height="3px"><td colspan="3"></td></tr>

	<tr> 
	
		<td height="70">&nbsp;</td> 
		
		<td align="left" class="admintext" valign="middle"><strong>Existing Site Logo </strong></td> 
		
		<td width="63" class="content1" align="center"><strong> :</strong></td> 
		
		<td align="left"> &nbsp;
		
			<font face="Verdana" style="font-size:12px "> 
		
				<img src="../images/<?php echo $sel['site_logo'] ?>" width="149" height="47" border="0" /> 
		
			</font>
			
		</td> 
	
	</tr> 
	
	<tr height="3px"><td colspan="3"></td></tr>

	<tr> 
	
		<td>&nbsp;</td> 
		
		<td align="left" class="admintext" valign="middle"><strong>Site Logo </strong></td> 
		
		<td width="63" class="content1" align="center"><strong> :</strong></td> 
		
		<td align="left"> &nbsp;
			
			<font face="Verdana" style="font-size:12px "> 
		
				<input type="file" name="logo" id="logo"/><input type="hidden" name="sitelogoname" id="sitelogoname" value="<?php echo $sel['site_logo'] ?>"/> 
		
			</font>
			
		</td> 
	
	</tr> 
	
	<tr height="3px"><td colspan="3"></td></tr>

	<tr> 
	
		<td>&nbsp;</td> 
		
		<td align="left" class="admintext" valign="middle"><strong>Paypal Email Id </strong></td> 
		
		<td width="63" class="content1" align="center"><strong> :</strong></td> 
		
		<td align="left"> &nbsp;
		
			<font face="Verdana" style="font-size:12px "> 
		
				<input type="text" name="paypalid" id="paypalid" value="<?php echo $sel['paypal_dmailid'] ?>" class="textbox1" /> 
		
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