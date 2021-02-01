<?php 
require("../../includes/functions.php");
require("../../includes/mysqlclass.php");

if(isset($_REQUEST['opt']) && isset($_REQUEST['val'])){
   $opt=mysql_real_escape_string($_REQUEST['opt']);
   $val=mysql_real_escape_string($_REQUEST['val']);
   $id=mysql_real_escape_string($_REQUEST['id']);
   
   if($opt=='add'){
   $sql="INSERT INTO bustypes (typeName,typeStatus) VALUES ('".$val."',1)";
   mysql_query($sql) or die(mysql_error());
   }
   elseif($opt=='del'){
   $sql="DELETE FROM bustypes WHERE typeID=".$val;
   mysql_query($sql) or die(mysql_error());
   }
    elseif($opt=='edit'){
   $sql="UPDATE bustypes SET typeName = '".$val."' WHERE typeID=".$id;
   mysql_query($sql) or die(mysql_error());
   }
    elseif($opt=='unblock'){
   $sql="UPDATE bustypes SET typeStatus = 0 WHERE typeID=".$val;
   mysql_query($sql) or die(mysql_error());
   }
    elseif($opt=='block'){
   $sql="UPDATE bustypes SET typeStatus = 1 WHERE typeID=".$val;
   mysql_query($sql) or die(mysql_error());
   }
   
   ?>
   <table width="194" border="0" cellspacing="5" cellpadding="5">
      <tr>
        <th width="50">Type</th>
		<th width="61" align="center">Action</th>
      </tr>
	  <?php
	$brs = $db->query("select * from bustypes order by typeName");
	while ($brow = $db->fetch_array($brs))
	{
	?>
      <tr align="center">
        <td><?php echo $brow['typeName']; ?></td>
		<td align="center">
		<?php if($brow['typeStatus'] == 1) { ?>
		<a href=# onclick='javascript:inactivetype(<?php echo $brow['typeID']; ?>)' title="Click to Block">
		<img src="../images/Active.png" border="0" /></a>
		<?php } else { ?>
		<a href=# onclick='javascript:activetype(<?php echo $brow['typeID']; ?>)' title="Click to Unblock">
		<img src="../images/inactive.png" border="0" /></a>
		<?php } ?>
		<a href=# onclick="edit_form('<?php echo $brow['typeID']; ?>','<?php echo $brow['typeName']; ?>');" title="Edit">
		<img src="../images/edit.png" border="0" /></a>
		<a href=# onclick='javascript:deltype(<?php echo $brow['typeID']; ?>)' title="Delete">
		<img src="../images/delete.png" border="0" /></a>&nbsp;&nbsp;
		
		</td>
      </tr>
	  <?php } ?>
    </table>
   <?php
}
?>