<?php
	include_once("includes/header.php");
?>
<script src="../js/pagination.js" type="text/javascript"></script>
<body onLoad="search_SP_name();">
<fieldset class="table-bor">
		<legend><strong>Cancel Policies Management</strong></legend> 
		
		
		<table width="100%" border="0" cellspacing="2" cellpadding="5"  >
		
		<tr>
			<td colspan="4"></td>
			</tr>
		 
		
		<tr><td colspan="4">
		<div id="ad" style="visibility:visible; ">
		<table width="100%" border="0" cellspacing="2" cellpadding="5" style="border-bottom:#6AA6E8 1px solid; padding-bottom:10px;">
		
		<form name="form" action="" method="post" onSubmit="return validate_policy(this.form);">
		    <tr><td colspan="6">&nbsp;</td></tr>
			<tr>
			<td width="17%"> <strong>Service Provider</strong> </td>
			<!--<td width="17%"> Durtion for Cancellation </td>-->
			<td width="10%" > <strong>Time</strong> </td>
			<td width="17%"> <strong>Refundable Amount</strong> </td>
			
		</tr>
		<tr>
			
			 <td>
			<select name="service_provider" id="service_provider" class="combobox-small">
				<option value="0">Select</option>
				<?php  $qry = getServiceprovider();
				
					while($row=mysql_fetch_array($qry)) {
				
				 ?>
				 <option value="<?php echo $row['SP_id']; ?>"><?php echo $row['SP_name']; ?></option>
				 <?php } ?>
				</select></td>			
			
			<!--<td>
			<input type="hidden" name="duration" id="duration" value="Before" />
			Before
			    <select name="duration" id="duration"  class="combobox-small">
				<option value="0">Select</option>
				<option value="Before">Before</option>
				<option value="After">After</option>
				<option value="Within">Within</option>
				</select>
			</td>-->			
			
			<td width="21%">
			<input type="hidden" name="duration" id="duration" value="Before" />
			Before <input type="text" name="time" id="time" size="2"  maxlength="2"> in Hours</td>			
			<td width="21%"><input type="text" name="refund" id="refund" size="2" maxlength="2"> %</td>
			
		  </tr>
			 
			 <tr>
			 			 <td colspan="4" align="center">
						 <input type="submit" name="submit" id="submit"  value=" Submit " >
						 <input type="reset" name="reset" id="reset"  value=" Reset ">
						 </td>
			 </tr>
			</form>
			</table>
			</div>
			
			
			</td></tr>
		
		<tr><td colspan="4">
		<div id="restype">
		<table border="0" width="100%" cellpadding="7" cellspacing="3" style="padding-top:10px;">
		
		<tr>
			<td colspan="6">Type Service Provider Name : &nbsp;
			<input type="text" size="50" class="textbox2" onKeyUp="search_SP_name();" id="sp_search" /> <br></td>
			
		
			
		  </tr>
		
			
			
		
		
		</table>
		</div></td></tr></table>
		
		<br>
		
		<div id="loading"></div>
        <div id="container">		
            <div class="data">			
			</div>
            <div class="pagination"></div>			
        </div>
		<br />
		</fieldset>
</body>
<?php include "includes/footer.php"; ?>


