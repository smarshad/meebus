<?php include_once("includes/header.php"); ?>

<script src="../js/pagination.js" type="text/javascript"></script>

<?php 
$id=$_GET['id'];
$sql="SELECT * from adminlogin where admin_ID='$id'";
$res=mysql_query($sql);
$i=1; $r=mysql_fetch_array($res); ?>

<body onLoad="search_Usr();">

<fieldset class="table-bor">

  <legend><strong><?php echo $r['name']; ?></strong></legend> 
		
		<table width="50%" border="1" cellspacing="2" cellpadding="2" style="margin:0 auto;">
		  <tr>          
			<td height="33" colspan="2" align="left">Bus Type Management</td>
			<td width="38%" align="center"><input name="" type="checkbox" value="" checked>&nbsp;</td>
		  </tr>
		  <tr>
		    <td height="36" colspan="2" align="left">Blocking Management</td>
		    <td align="center"><input name="input" type="checkbox" value="" checked></td>
	      </tr>
		  <tr>
		    <td height="36" colspan="2" align="left">Passangers Management</td>
		    <td align="center"><input name="input2" type="checkbox" value="" checked></td>
	      </tr>
		  <tr>
		    <td height="36" colspan="2" align="left">Coupon Code</td>
		    <td align="center"><input name="input3" type="checkbox" value="" checked></td>
	      </tr>
		  <tr>
		    <td height="36" colspan="2" align="left">Ticket Booking</td>
		    <td align="center"><input name="input4" type="checkbox" value="" checked></td>
	      </tr>
		  <tr>
		    <td height="36" colspan="2" align="left">Promotional Code</td>
		    <td align="center"><input name="input5" type="checkbox" value="" checked></td>
	      </tr>
	    </table>
		
</fieldset>
</body>
<?php include "includes/footer.php"; ?>