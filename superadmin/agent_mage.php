<?php include_once("includes/header.php"); ?>

<script src="../js/pagination.js" type="text/javascript"></script>

<body onLoad="search_Usr();">

<fieldset class="table-bor">

		<legend><strong>Agent Management</strong> <a href="agent_add.php" style="float:right;color:#fff;"> Add </a> </legend> 
		
		<table width="100%" border="1" cellspacing="2" cellpadding="2">
		  <tr>
			<td height="33" colspan="2" align="center">S. No</td>
			<td width="14%" align="center">Agent Name</td>
			<td width="12%" align="center">Agency Name</td>
            <td width="23%" align="center">Email</td>
            <td width="15%" align="center">Mobile Number</td>
            <td width="15%" align="center">Address</td>
            <td width="12%" align="center">Acoount Balance</td>
            <td width="9%" align="center">Status</td>
            <td width="9%" align="center">Active</td>
		  </tr>
<?php 
$sql="SELECT * from agents ";
$res=mysql_query($sql);

$i=1; while($r=mysql_fetch_array($res)) {?>
		  <tr>
		    <td height="36" colspan="2" align="center"><?php echo $i; $i++; ?></td>
		    <td align="center"><?php echo $r['agent_name']; ?></td>
            <td align="center"><?php echo $r['agency_name']; ?></td>
            <td align="center"><?php echo $r['email']; ?></td>
            <td align="center"><?php echo $r['mobile_phone']; ?></td>
            <td align="center"><?php echo $r['address']; ?><br><?php echo $r['city']; ?><br><?php echo $r['state']; ?></td>
            <td align="center"><?php echo $r['account_balance']; ?></td>
		    <td align="center"><?php if($r['status']=='yes') echo '<span style="color:#008000">Active</span>'; else echo '<span style="color:#FF0000">Inactive</span>'; ?></td>
            <td align="center"><a href="agent_edit.php?aid=<?php echo $r['agent_id'] ?>">Edit</a> / <a href="agent_delete.php">Delete</a></td>

	      </tr>
<?php } ?>
	    </table>

		</fieldset>
</body>
<?php include "includes/footer.php"; ?>