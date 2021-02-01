<?php include_once("includes/header.php"); ?>

<script src="../js/pagination.js" type="text/javascript"></script>

<body onLoad="search_Usr();">

<fieldset class="table-bor">

		<legend><strong>Admin Management</strong> <a href="add_newadmin.php" style="float:right;color:#fff;"> Add </a> </legend> 
		
		<table width="100%" border="1" cellspacing="2" cellpadding="2">
		  <tr>
			<td height="33" colspan="2" align="center">S. No</td>
			<td align="center">Admin Name</td>
			<td align="center">Usename</td>
			<td align="center">Status</td>
		  </tr>
<?php 
$sql="SELECT * from adminlogin";
$res=mysql_query($sql);

$i=1; while($r=mysql_fetch_array($res)) {?>
		  <tr>
		    <td height="36" colspan="2" align="center"><?php echo $i; $i++; ?></td>
		    <td align="center"><a href="edit-admin.php?id=<?php echo $r['admin_ID']; ?>"><?php echo $r['name']; ?></a></td>
		    <td align="center"><?php echo $r['admin_username']; ?></td>
		    <td align="center"><?php if($r['admin_status']==1) echo Active; else echo Inactive; ?></td>
	      </tr>
<?php } ?>
	    </table>
	
		</fieldset>
</body>
<?php include "includes/footer.php"; ?>