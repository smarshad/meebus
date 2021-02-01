<?php
include "includes/header.php";

//echo "<h2>Add Advantages</h2>";

if(isset($_REQUEST['submit']))
{
$state=$_REQUEST['state'];
$code=$_REQUEST['code'];
$phone=$_REQUEST['phone'];

//echo "insert into bus_ticket (bus_name,bus_phone) values('$state','$phone')"; exit;
mysql_query("insert into bus_delivery (bus_name,bus_code,bus_phone) values('$state','$code','$phone')") or die(mysql_error());

header("location:viewbus.php?msgg");

}

?>
<script language="javascript">

function busvalidate()
{
if(document.getElementById('state').value=="")
{
alert("Select the state");
document.getElementById('state').value=="";
document.getElementById('state').focus();
return false;

}

if(document.getElementById('code').value=="")
{
alert("Enter the code");
document.getElementById('code').value=="";
document.getElementById('code').focus();
return false;

}

if(document.getElementById('phone').value=="")
{
alert("Enter the phoneno");
document.getElementById('phone').value=="";
document.getElementById('phone').focus();
return false;

}


}


</script>
<form name="advantage" id="advantage" action="addbuscity.php" method="post" onsubmit="return busvalidate();">


<fieldset style="border:1px #5AAADA solid;">
<legend><h2>Bus and Service Details</h2></legend>
<table>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td align="right"><span style="color:#FF0000;">*</span>mandatory Fields </td>
</tr>
<tr>
<td style="padding-top:20px;">
Add State <span style="color:#FF0000;">*</span>:</td>
<td style="padding-top:20px; padding-left:3px;">
<input type="text" name="state" id="state" />

</td>
</tr>

<tr>
<td style="padding-top:10px;">STD Code <span style="color:#FF0000;">*</span>:
</td>
<td style="padding-top:10px;"><input type="text" name="code" id="code" /></td>
</td>
</tr>
<tr>
<td style="padding-top:10px;">Phoneno <span style="color:#FF0000;">*</span>:</td>
<td style="padding-top:10px;"><input type="text" name="phone" id="phone" /></td>
</tr>
<tr>
<td>&nbsp;</td>
<td style="padding-top:10px;">
<input type="submit" name="submit" id="submit" />
</td>
</tr>



</table>
</fieldset>
</form>
<?php
include "includes/footer.php";
?>