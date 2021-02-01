<?php
include "includes/header.php";
?>
<script src="../js/pagination.js" type="text/javascript"></script>
<body onLoad="searchpromo();">
<fieldset class="table-bor">
<legend><strong>Promotional Code  Management</strong></legend>

<table width="100%">
	<tr>		
		<td width="7%">			
			<input type="hidden" id="search_str" name="search_str" value="<?php echo $_REQUEST['sp_id']; ?>" onKeyUp="viewcoupon();" />		
	  </td>
	  <td width="31%">
	  Promotion Code : 
	     <select name="coupon" id="coupon" onChange="searchpromo();">
	  <option value="-1">All</option>
	  <?php 
	       $coupon=mysql_query("SELECT * FROM bus_promo ORDER BY promo_id") ; 
		   while($row=mysql_fetch_array($coupon)){
	   ?>
	   <option value="<?php echo $row['promo_id'] ?>"><?php echo $row['promo_title']; ?></option>
	   <?php } ?>
	  </select>
	  </td>
	 
	  <td width="62%">Status: 
	    <select name="bus_status" id="bus_status" onChange="searchpromo();">
	  <option value="-1">None</option>
	  <option value="0">Available</option>
	  <option value="1">Blocked</option>
	  
	  </select></td>	
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

?>
</body>