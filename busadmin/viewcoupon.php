<?php
include "includes/header.php";
if(isset($_REQUEST['sp_id'])){
$sp_id=$_SESSION['SP_id'];
$bus_id=$_REQUEST['busid'];
//$sql="SELECT * FROM serviceprovider_info ORDER BY SP_id";
?>
<script src="../js/pagination.js" type="text/javascript"></script>
<body onLoad="viewcoupon();">
<fieldset class="table-bor">
<legend><strong>Discount Coupons for <?php echo get_bus_name($bus_id); ?></strong></legend>

<table width="100%">
	<tr>		
		<td width="7%">			
			<input type="hidden" id="search_str" name="search_str" value="<?php echo $_SESSION['SP_id']; ?>" onKeyUp="viewcoupon();" />		
	  </td>
	  <td width="31%">
	  Coupon : 
	     <select name="coupon" id="coupon" onChange="viewcoupon();">
	  <option value="-1">All</option>
	  <?php 
	       $coupon=mysql_query("SELECT * FROM bus_coupons where coup_bus='$bus_id' and coup_sp='$sp_id' ORDER BY coup_id") ; 
		   while($row=mysql_fetch_array($coupon)){
	   ?>
	   <option value="<?php echo $row['coup_id'] ?>"><?php echo $row['coup_unique']; ?></option>
	   <?php } ?>
	  </select>
	  </td>
	 
	  <td width="62%">Status: 
	    <select name="bus_status" id="bus_status" onChange="viewcoupon();">
	  <option value="-1">None</option>
	  <option value="0">Available</option>
	  <option value="1">Blocked</option>
	   <option value="2">Used Coupon</option>
	  </select></td>	
	</tr>
	<tr>
	<td colspan="3"><input type="hidden" name="sp_id" id="sp_id" value="<?php echo $_SESSION['SP_id']; ?>" />
	<input type="hidden" name="bus_id" id="bus_id" value="<?php echo $_REQUEST['busid']; ?>" />
	</td>
	</tr>
</table>
<hr />
	<div id="loading"></div>
	 <div id="container">
	  <div class="data" id="gan"></div>	
	 </div>	
<script type="text/javascript">
function submit_hidform(busid){
document.block2form.bus_id.value=busid;
document.block2form.submit();
}
</script>	 
<form name="block2form" id="block2form" action="block_seats.php" method="post">
<input type="hidden" id="sp_id" name="sp_id" value="<?php echo $_SESSION['SP_id']; ?>">
<input type="hidden" id="bus_id" name="bus_id" value="">
<input type="hidden" id="dat" name="dat" value="<?php echo date("d-m-Y"); ?>">
</form>
</fieldset>
<?php
include "includes/footer.php";
}
else {
 header("location:home.php");
}
?>
</body>