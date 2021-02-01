<?php
include "includes/header.php";


//echo "<h2>Add Advantages</h2>";
if(isset($_REQUEST['edit']))
{
$sel=mysql_fetch_array(mysql_query("select * from bus_advantage where adv_id='$_REQUEST[edit]'"))or die(mysql_error());
}

//echo "testing"; 

if(isset($_REQUEST['submit']))
{
//echo "testing"; 
$advantage=$_REQUEST['advantage'];
//$edit=$_REQUEST['edit'];

mysql_query("update bus_advantage set adv_advantages ='$advantage' where adv_id='$_REQUEST[edit]'") or die(mysql_error());
//echo "update advantage set adv_advantages ='$advantage' where adv_id='$_REQUEST[edit]'"; exit;
header("location:viewadvantage.php?update");

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
<form name="advantage" action="" method="post" onsubmit="return validate();">

<fieldset style="border:1px #5AAADA solid;">
<legend><h2>Edit Booking Advantages</h2></legend>
<table>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td align="right"><span style="color:#FF0000;">*</span>mandatory Fields </td>
</tr>
<tr>
<td style="padding-top:30px;">
Add Advantages <span style="color:#FF0000;">*</span>:</td>
<td style="padding-top:30px;">
<textarea name="advantage" id="advantage" style="width:300px; height:50px;"><?php echo $sel['adv_advantages']; ?></textarea>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<input  type="hidden" name="edit" id="edit" value="<?php echo $_REQUEST['edit']; ?>" />
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