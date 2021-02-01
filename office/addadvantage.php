<?php
include "includes/header.php";



//echo "<h2>Add Advantages</h2>";

if(isset($_REQUEST['submit']))
{
$advantage=$_REQUEST['advantage'];
mysql_query("insert into bus_advantage (adv_advantages) values('$advantage')") or die(mysql_error());

header("location:viewadvantage.php?msg");

}

?>

<script language="javascript">

function validate()
{
if(document.getElementById('advantage').value == "")
{
alert("Enter the advantage");
document.getElementById('advantage').value=="";
document.getElementById('advantage').focus();
return false;

}


}


</script>
<form name="myform"  action="" method="post" onsubmit="return validate();">

<fieldset style="border:1px #5AAADA solid;">
<legend><h2>Add Booking Advantages</h2></legend>
<table>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td align="right"><span style="color:#FF0000;">*</span>mandatory Fields </td>
</tr>
<tr>
<tr >
<td style="padding-top:10px;">
Add Advantages <span style="color:#FF0000;">*</span>:</td>
<td style="padding-top:30px;"><textarea name="advantage" id="advantage"></textarea>
</td>
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