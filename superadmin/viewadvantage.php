<?php
include "includes/header.php";
include_once('includes/function.php');
if(isset($_REQUEST['page'])) {
	$url = "?page=".$_REQUEST['page']."&";
} else {
	$url = "?";
}


//echo "<h2>Add Advantages</h2>";


if(isset($_REQUEST['delete']))
{
mysql_query("update bus_advantage set adv_status=2 where adv_id='$_REQUEST[delete]'");
header("location:viewadvantage.php?del");
}

if(isset($_REQUEST['active']))
{
mysql_query("update bus_advantage set adv_status=1 where adv_id='$_REQUEST[active]'");
header("location:viewadvantage.php");
}



if(isset($_REQUEST['deactive']))
{
mysql_query("update bus_advantage set adv_status=0 where adv_id='$_REQUEST[deactive]'");
header("location:viewadvantage.php");
}


?>
<link rel="stylesheet" href="css/B_blue.css" type="text/css" />
<form name="advantage" id="advantage" action="" method="post" onsubmit="return validate();">

<?php if(isset($_REQUEST['msg']))
{?>
<h3 align="center">Added Successfullly</h3>
<?php }
?>
<?php if(isset($_REQUEST['del']))
{?>
<h3 align="center">Deleted Successfullly</h3>
<?php }
?>

<?php if(isset($_REQUEST['update']))
{?>
<h3 align="center">Updated Successfullly</h3>
<?php }
?>
<a href="addadvantage.php"><h3 align="right">Add+</h3></a>
<fieldset  style="border:1px #5AAADA solid;">
<legend><h2>List of Advantages</h2></legend>
<table width="98%">
<tr>
<th width="10%">Sl.no</th>
<th width="30%">List Of Advantages</th>
<th width="20%">Status</th>
<th width="20%">Edit</th>
<th width="20%">Delete</th>
</tr>
<?php 
$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    			$limit = 15;
    			$startpoint = ($page * $limit) - $limit;
				
$result=mysql_query("select * from bus_advantage where adv_status !=2 order by adv_id  LIMIT {$startpoint} , {$limit}");

$count=mysql_num_rows(mysql_query("select * from advantage where adv_status !=2 "));
$no=1;
while($row=mysql_fetch_array($result))
{

?>
<tr>
<td><?php echo $no+$startpoint; ?></td>
<td><?php echo substr($row['adv_advantages'],0,30); 
      if(strlen($row['adv_advantages'])>30)
{
 echo "...";
 }
?></td>
<?php /*?><?php echo substr($career_data['career_description'],0,100); 
								
								if(strlen($career_data['career_description']) > 100) {
									echo "...";
								}
								
							?><?php */?>
<td>
<?php 
if($row['adv_status']==0)
{?>
<a href="viewadvantage.php?active=<?php echo $row['adv_id']; ?>" onclick="if(confirm('Are you want to deactivate this record'))
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
 if($row['adv_status']== 1) {?>
 
<a href="viewadvantage.php?deactive=<?php echo $row['adv_id']; ?>" onclick="if(confirm('Are you want to activate this record'))
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


<td><a href="editadvantage.php?edit=<?php echo $row['adv_id'];?>"><img src="images/edit.png" onclick="if(confirm('Are you want to edit this record'))
{
 return true;
}
else
{
return false;
}"/></a></td>
<td><a href="viewadvantage.php?delete=<?php echo $row['adv_id']; ?>"><img src="images/deletered.png" onclick="if(confirm('Are you want to delete this record'))
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