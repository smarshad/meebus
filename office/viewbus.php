<?php
include "includes/header.php";
include_once('includes/function.php'); //pagination function

if(isset($_REQUEST['page'])) {
	$url = "?page=".$_REQUEST['page']."&";
} else {
	$url = "?";
}

//echo "<h2>Add Advantages</h2>";


if(isset($_REQUEST['delete1']))
{
mysql_query("update bus_delivery set bus_status=2 where bus_id='$_REQUEST[delete1]'");
header("location:viewbus.php?delete");
}

if(isset($_REQUEST['activ']))
{
mysql_query("update bus_delivery set bus_status=1 where bus_id='$_REQUEST[activ]'");
header("location:viewbus.php");
}



if(isset($_REQUEST['deactiv']))
{
mysql_query("update bus_delivery set bus_status=0 where bus_id='$_REQUEST[deactiv]'");
header("location:viewbus.php");
}


?>
<link rel="stylesheet" href="css/B_blue.css" type="text/css" />
<form name="advantage"  action="viewbus.php" method="post" onsubmit="return validate();">

<?php if(isset($_REQUEST['msgg']))
{?>
<h3 align="center">Added Successfullly</h3>
<?php }
?>
<?php if(isset($_REQUEST['delete']))
{?>
<h3 align="center">Deleted Successfullly</h3>
<?php }
?>

<?php if(isset($_REQUEST['updat']))
{?>
<h3 align="center">Updated Successfullly</h3>
<?php }
?>
<a href="addbuscity.php"><h3 align="right">Add+</h3></a>
<fieldset  style="border:1px #5AAADA solid;">
<legend><h2>Bus and Service Details</h2></legend>
<table width="98%">
<tr>
<th width="10%">Sl.no</th>
<th width="20%">State</th>
<th width="10%">STD Code</th>
<th width="15%">Phoneno</th>
<th width="15%">Status</th>
<th width="15%">Edit</th>
<th width="15%">Delete</th>
</tr>
<?php 
$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    			$limit = 15;
    			$startpoint = ($page * $limit) - $limit;

$resul=mysql_query("select * from bus_delivery where bus_status !=2 order by bus_id  LIMIT {$startpoint} , {$limit}");

$count=mysql_num_rows(mysql_query("select * from bus_delivery where bus_status !=2"));
$no=1;
while($roww=mysql_fetch_array($resul))
{

?>
<tr>
<td><?php echo $no+$startpoint; ?></td>
<td><?php echo $roww['bus_name']; ?></td>
<td><?php echo $roww['bus_code'];?></td>
<td><?php echo $roww['bus_phone']; ?></td>

<td>
<?php 
if($roww['bus_status']==0)
{?>
<a href="viewbus.php?activ=<?php echo $roww['bus_id']; ?>" onclick="if(confirm('Are you want to deactivate this record'))
{
 return true;
}
else
{
return false;
}">

<img src="images/act.png" />

</a>
<?php } ?>

<?php 
 if($roww['bus_status']== 1) {?>
 
<a href="viewbus.php?deactiv=<?php echo $roww['bus_id']; ?>" onclick="if(confirm('Are you want to activate this record'))
{
 return true;
}
else
{
return false;
}">

<img src="images/inact.png" />

</a>
<?php } ?>
</td>


<td><a href="bus_edit.php?updat=<?php echo $roww['bus_id'];?>"><img src="images/edit.png" onclick="if(confirm('Are you want to edit this record'))
{
 return true;
}
else
{
return false;
}"/></a></td>
<td><a href="viewbus.php?delete1=<?php echo $roww['bus_id']; ?>"><img src="images/deletered.png" onclick="if(confirm('Are you want to delete this record'))
{
 return true;
}
else
{
return false;
}"/></a></td>

</tr>
<?php $no++; } ?>
</table>
</fieldset>


</form>
<div style="float:right;">
<?php	echo pagination($count,$limit,$page); //pagination links ?>
</div>
<?php
include "includes/footer.php";
?>