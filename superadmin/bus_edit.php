<?php
include "includes/header.php";


//echo "<h2>Add Advantages</h2>";
if(isset($_REQUEST['updat']))
{
$res=mysql_fetch_array(mysql_query("select * from bus_delivery where bus_id='$_REQUEST[updat]'"))or die(mysql_error());
}

//echo "testing"; 

if(isset($_REQUEST['submit']))
{
//echo "testing"; 
$state=$_REQUEST['state'];
$phone=$_REQUEST['phone'];
$code=$_REQUEST['code'];
//$edit=$_REQUEST['edit'];

mysql_query("update bus_delivery set bus_name ='$state',bus_code='$code',bus_phone='$phone' where bus_id='$_REQUEST[updat]'") or die(mysql_error());
//echo "update advantage set adv_advantages ='$advantage' where adv_id='$_REQUEST[edit]'"; exit;
header("location:viewbus.php?updat");

}

?>
<script language="javascript">

function busvalidate()
{
if(document.getElementById('state').value=="")
{
alert("Please enter the state");
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
<form name="advantage" action="" method="post" onsubmit="return busvalidate();">

<fieldset style="border:1px #5AAADA solid;">
<legend><h2>Edit Bus and Service Details</h2></legend>
<table>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td align="right"><span style="color:#FF0000;">*</span>mandatory Fields </td>
</tr>
<tr >
<td style="padding-top:30px;">
Add State <span style="color:#FF0000;">*</span>:</td>
<td style="padding-top:30px;">
<input type="text" value="<?php echo trim($res['bus_name']); ?>" name="state" id="state" />
</td>
</tr>
<tr>
<td>STD Code <span style="color:#FF0000;">*</span>:</td>
<td><input type="text" name="code" id="code" value="<?php echo $res['bus_code']; ?>" /></td>
</tr>
<tr>
<td style="padding-top:10px;">Phoneno <span style="color:#FF0000;">*</span>: </td>
<td style="padding-top:10px;"><input type="text" name="phone" id="phone" value="<?php echo $res['bus_phone']; ?>" />
</td>

</tr>

<tr>
<td>&nbsp;</td>
<input  type="hidden" name="updat" id="updat" value="<?php echo $_REQUEST['updat']; ?>" />
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